<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
/* For CMS */
class Content_model extends App_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function update($data)
	{
		$old_name = $data['old_name'];
		unset($data['old_name']);


		if(empty($data['name']))
			$data['name'] = $old_name;
		$data['name'] = strtolower($data['name']);
		$data['name'] = preg_replace('/[^a-z0-9-_]/','_',$data['name']);
		$this->unfuck_wysiwyg($data['content']);

		if($old_name !== $data['name'])
		{
			$res = $this->db->where('name',$data['name'])->select('name')->get('content')->row_array();
			if($res)
				throw new Exception("Page '{$data['name']}' already exists");
		}
		
		$res = $this->db->where('name', $old_name)->update('content', $data);
	}

	public function insert($data)
	{
		$data['name'] = strtolower($data['name']);
		$data['name'] = preg_replace('/[^a-z0-9-_]/','_',$data['name']);
		$this->unfuck_wysiwyg($data['content']);

		$res = $this->db->where('name',$data['name'])->select('name')->get('content')->row_array();
		if($res)
			throw new Exception("Page '{$data['name']}' already exists");
		
		$res = $this->db->insert('content', $data);
	}

	public function delete($name)
	{
		$this->db->where('name',$name)->where('type','page')->delete('content');
	}

	public function get($name)
	{
		$res = $this->db->where('name',$name)->select('content')->get('content')->row_array();
		if(!$res)
			return '';
		return $res['content'];
	}

	public function get_all()
	{
		$res = $this->db->get('content')->result_array();
		return $res;
	}

	public function get_pages()
	{
		$res = $this->db->select('name,footer,topbar')->get('content')->result_array();
		return $res;
	}

	public function get_meta($name)
	{
		$res = $this->db->where('name',$name)->select('title,description')->get('content')->row_array();
		if(!$res)
			return array();
		return $res;
	}

	public function unfuck_wysiwyg(&$content)
	{
		$content = preg_replace('/([\'";])\s*color\s*\:[^";\']+([\'";])/','$1$2',$content);
		$content = preg_replace('/([\'";])\s*mso\-[^\s:]+\s*\:[^";\']+([\'";])/','$1$2',$content);
	}
}