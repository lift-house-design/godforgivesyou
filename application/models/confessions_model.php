<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
/* For CMS */
class Confessions_model extends App_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function top_confessions()
	{
		$res = $this->db->query("
			select c.*, (select count(id) from forgives where confession=c.id and type='forgive') as forgive_count from confessions c where c.spam='No' order by forgive_count desc limit 10
		")->result_array();
		$this->add_forgive_counts($res);
		return $res;
	}

	public function top_prayers()
	{
		$res = $this->db->query("
			select c.*, (select count(id) from prayers_for where prayer=c.id and type='prayer') as forgive_count from prayers c where c.spam='No' order by forgive_count desc limit 10
		")->result_array();
		$this->add_prayer_counts($res);
		return $res;
	}

	public function bgs()
	{
		return $this->db->get('backgrounds')->result_array();
	}

	public function is_bg($id)
	{
		$res = $this->db->select('id')->where('id', $id)->get('backgrounds')->row_array();
		return !empty($res);
	}

	public function add_forgive_counts(&$res)
	{
		foreach($res as $i => $row)
			$res[$i]['forgives'] = $this->count_forgives($row['id']);
	}

	public function add_prayer_counts(&$res)
	{
		foreach($res as $i => $row)
			$res[$i]['prayers_for'] = $this->count_prayers_for($row['id']);
	}

	public function count_forgives($id)
	{
		$id = intval($id);
		$res = $this->db->query("select count(f.id) as count, f.type from forgives f, user u where confession=$id and f.user=u.id and u.status='confirmed' group by type")->result_array();
		$out = [];
		foreach($res as $row)
			$out[$row['type']] = $row['count'];
		return array_merge([ 'forgive' => 0 ,'condemn' => 0, 'ignore' => 0, 'spam' => 0 ], $out);
	}

	public function count_prayers_for($id)
	{
		$id = intval($id);
		$res = $this->db->query("select count(f.id) as count, f.type from prayers_for f, user u where prayer=$id and f.user=u.id and u.status='confirmed' group by type")->result_array();
		$out = [];
		foreach($res as $row)
			$out[$row['type']] = $row['count'];
		return array_merge([ 'prayer' => 0, 'ignore' => 0, 'spam' => 0 ], $out);
	}

	/* mark something spam if count(spams) > 5 and % spam > 50 */
	private function mark_spam($id, $table='confessions')
	{
		if($table == 'confessions')
		{
			$f = $this->count_forgives($id);
			if($f['spam'] > 5 && $f['spam'] / array_sum($f) > 0.5)
				$spam = 'Yes';
			else
				$spam = 'No';
			$this->db->where('id', $id)->update('confessions', ['spam' => $spam]);
		}
		elseif($table == 'prayers')
		{
			$f = $this->count_prayers_for($id);
			if($f['spam'] > 5 && $f['spam'] / array_sum($f) > 0.5)
				$spam = 'Yes';
			else
				$spam = 'No';
			$this->db->where('id', $id)->update('prayers', ['spam' => $spam]);
		}
	}

	public function forgive($user, $id, $type)
	{
		$user = intval($user);
		$id = intval($id);
		if(!$user || !$id || !in_array($type, ['forgive','condemn','ignore','spam']))
			return;

		$res = $this->db->where('user', $user)
			->where('confession', $id)
			->get('forgives')->row_array();
		
		if(empty($res))
		{
			$this->db->insert('forgives', [
				'user' => $user,
				'confession' => $id,
				'type' => $type
			]);
			$this->mark_spam($id);
		}
	}

	public function send_prayer($user, $id, $type)
	{
		$user = intval($user);
		$id = intval($id);
		if(!$user || !$id || !in_array($type, ['pray','ignore','spam']))
			return;

		$res = $this->db->where('user', $user)
			->where('prayer', $id)
			->get('prayers_for')->row_array();
		
		if(empty($res))
		{
			$this->db->insert('prayers_for', [
				'user' => $user,
				'prayer' => $id,
				'type' => $type
			]);
			$this->mark_spam($id, 'prayers');
		}
	}

	public function confessions_forgive($user, $count)
	{
		$user = intval($user);
		$count = intval($count);
		$res = $this->db->query(
				"select * from confessions 
					where id not in(select confession from forgives where user=$user)
					order by rand()
					limit $count"
			)
			->result_array();
		$this->add_forgive_counts($res);
		return $res;
	}

	public function add($post)
	{
		$post['text'] = strip_tags($post['text']);
		$this->db->insert('confessions', $post);
		return $this->db->insert_id();		
	}

	public function confession($id)
	{
		$prev = false;
		$next = false;
		$res = $this->db->select('text,id')
			->where('id',$id)
			->get('confessions')
			->row_array();
		if(!empty($res))
		{
			$next_res = $this->db->select('id')
			->where('id <',$id)
			->order_by('id','desc')
			->limit(1)
			->get('confessions')
			->row_array();
			if(!empty($next_res['id']))
				$next = $next_res['id'];

			$prev_res = $this->db->select('id')
			->where('id >',$id)
			->order_by('id')
			->limit(1)
			->get('confessions')
			->row_array();
			if(!empty($prev_res['id']))
				$prev = $prev_res['id'];
			
			$res['forgives'] = $this->count_forgives($res['id']);
		}
		return [$res, $prev, $next];
	}

	public function confessions($start, $limit)
	{
		$prev = $start ? true : false;
		$next = false;
		$res = $this->db->select('text,id')
			->where('spam','No')
			->order_by('id','desc')
			->get('confessions', $limit + 1, $start)
			->result_array();
		if(count($res) > $limit)
		{
			unset($res[count($res) - 1]);
			$next = true;
		}
		$this->add_forgive_counts($res);
		return [$res, $prev, $next];
	}

	public function add_prayer($post)
	{
		$post['text'] = strip_tags($post['text']);
		$this->db->insert('prayers', $post);
		return $this->db->insert_id();		
	}

	public function prayers($start, $limit)
	{
		$prev = $start ? true : false;
		$next = false;
		$res = $this->db->select('text,id')
			->where('spam','No')
			->order_by('id','desc')
			->get('prayers', $limit + 1, $start)
			->result_array();
		if(count($res) > $limit)
		{
			unset($res[count($res) - 1]);
			$next = true;
		}
		$this->add_prayer_counts($res);
		return [$res, $prev, $next];
	}

	public function prayer($id)
	{
		$prev = false;
		$next = false;
		$res = $this->db->select('text,id')
			->where('id',$id)
			->get('prayers')
			->row_array();
		if(!empty($res))
		{
			$next_res = $this->db->select('id')
				->where('id <',$id)
				->order_by('id','desc')
				->limit(1)
				->get('prayers')
				->row_array();
			if(!empty($next_res['id']))
				$next = $next_res['id'];

			$prev_res = $this->db->select('id')
				->where('id >',$id)
				->order_by('id')
				->limit(1)
				->get('prayers')
				->row_array();
			if(!empty($prev_res['id']))
				$prev = $prev_res['id'];

			$res['prayers_for'] = $this->count_prayers_for($res['id']);
		}
		return [$res, $prev, $next];
	}

	public function image_data($type, $id)
	{
		if(!in_array($type, ['prayers','confessions']))
			return false;

		return $this->db->select('text,file')
			->where($type.'.id',$id)
			->join('backgrounds', 'backgrounds.id=bg')
			->get($type)
			->row_array();
	}
}