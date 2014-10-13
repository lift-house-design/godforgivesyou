<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends App_Controller
{
	public function __construct()
	{
		$this->models[] = 'confessions';
		$this->models[] = 'content';
		$this->models[] = 'blog';
		parent::__construct();
		$this->asides['topbar'] = 'topbar';
		$this->asides['footer'] = 'footer';
		$this->asides['signup'] = 'signup';
		$this->asides['notifications'] = 'notifications';
		
		// use min_css and min_js when possible to load assets through minify
		//$this->min_js[] = 'application.js';		
		//$this->min_css[] = 'application.css';
		//$this->min_js[] = '/plugins/select/jquery.customSelect.min.js';	
		$this->min_js[] = '/plugins/videojs/video.js';		
		$this->min_js[] = '/plugins/bigvideo/lib/imagesloaded.js';	
		$this->min_js[] = '/plugins/bigvideo/lib/bigvideo.js';		
		$this->css[] = '/plugins/bigvideo/css/bigvideo.css';
		/*
			LessCSS should only be used for development. 
			When you are ready to deploy, compile your less files into css files.
			Then remove any included .less files so that less.js will not be loaded.
		*/
		//$this->less_css[] = 'application.less';

		if(!empty($this->user->data['status']))
			if($this->user->data['status'] === 'unconfirmed')
				$this->notifications[] = 'Your email address is unconfirmed.<br/><a href="/verify/resend">Resend Confirmation Link to '.$this->user->data['email'].'</a>';
			elseif($this->user->data['status'] === 'banned')
				die("You are banned :(");
	}

	/* Ad hoc pages */

	public function index()
	{
		$this->data['content'] = $this->content->get('home');
		$this->data['confessions'] = $this->confessions->top_confessions(4);
		config_merge('meta',array(
			'title' => 'PHP Project Template - Go Nuts!',
			'description' => 'Holy Cow This is amazing!'
		));
	}

	public function forgive()
	{
		$user = empty($this->user->data['id']) ? 0 : $this->user->data['id'];

		$this->data['confessions'] = $this->confessions->confessions_forgive($user,5);
	}

	public function forgive_confession()
	{
		if(empty($this->user->data['id']))
			$this->_json('You aren\'t even logged in, bro.');
		$user = $this->user->data['id'];
		$id = $this->input->post('id');
		$type = $this->input->post('type');

		if(empty($id) || empty($type))
			$this->_json('What?');
		$this->confessions->forgive($user, $id, $type);
		$this->_json('Good job, buddy.');
	}

	public function send_prayer()
	{
		if(empty($this->user->data['id']))
			$this->_json('You aren\'t even logged in, bro.');
		$user = $this->user->data['id'];

		$id = $this->input->post('id');
		$type = $this->input->post('type');

		if(empty($id) || empty($type))
			$this->_json('What?');
		$this->confessions->send_prayer($user, $id, $type);
		$this->_json('Good job, buddy.');
	}

	public function prayers($start=0, $count=5)
	{
		list(
			$this->data['prayers'],
			$this->data['prev'],
			$this->data['next']
		) = $this->confessions->prayers($start,$count);
		$this->data['start'] = $start;
		$this->data['count'] = $count;
	}

	public function prayer($id)
	{
		list(
			$this->data['prayer'],
			$this->data['prev'],
			$this->data['next']
		) = $this->confessions->prayer($id);
	}

	public function pray()
	{
		$this->min_js[] = '/plugins/slick/slick/slick.min.js';	
		$this->css[] = '/plugins/slick/slick/slick.css';	

		$post = $this->input->post();
		if($post)
		{
			$err = '';
			if(strlen($post['text']) < 10)
				$err = "That's a short prayer...";
			if(!$this->confessions->is_bg($post['bg']))
				$err = 'You did not select a background. If you want to recommend another image, feel free to <a target="_blank" href="/contact">send us a link through the contact page</a>.';
			if(!$err)
				$err = $this->__botcheck($post);
			if($err)
				$this->_json(['error' => $err]);

			$post['user'] = empty($this->user->data['id']) ? 0 : $this->user->data['id'];

			$id = $this->confessions->add_prayer($post);
			$this->_json(['id' => $id]);
		}

		$this->data['backgrounds'] = $this->confessions->bgs();

		// recent prayers
		list(
			$this->data['prayers'],
			$this->data['prev'],
			$this->data['next']
		) = $this->confessions->prayers(0,3);
	}

	public function ask()
	{
		$this->min_js[] = '/plugins/slick/slick/slick.min.js';	
		$this->css[] = '/plugins/slick/slick/slick.css';	

		$post = $this->input->post();
		if($post)
		{
			$err = '';
			if(strlen($post['text']) < 10)
				$err = "That's a short confession...";
			if(!$this->confessions->is_bg($post['bg']))
				$err = 'You did not select a background. If you want to recommend another image, feel free to <a target="_blank" href="/contact">send us a link through the contact page</a>.';
			if(!$err)
				$err = $this->__botcheck($post);
			if($err)
				$this->_json(['error' => $err]);

			$post['user'] = empty($this->user->data['id']) ? 0 : $this->user->data['id'];

			$id = $this->confessions->add($post);
			$this->_json(['id' => $id]);
		}

		$this->data['backgrounds'] = $this->confessions->bgs();

		// recent confessions
		list(
			$this->data['confessions'],
			$this->data['prev'],
			$this->data['next']
		) = $this->confessions->confessions(0,3);
	}

	public function top_confessions()
	{
		$this->data['confessions'] = $this->confessions->top_confessions(20);
	}

	public function top_prayers()
	{
		$this->data['prayers'] = $this->confessions->top_prayers(20);
	}

	public function confessions($start=0, $count=5)
	{
		list(
			$this->data['confessions'],
			$this->data['prev'],
			$this->data['next']
		) = $this->confessions->confessions($start,$count);
		$this->data['start'] = $start;
		$this->data['count'] = $count;
	}

	public function confession($id)
	{
		list(
			$this->data['confession'],
			$this->data['prev'],
			$this->data['next']
		) = $this->confessions->confession($id);
	}

	public function make_thumbs()
	{
		$this->load->library('upload');
		$bgs = $this->confessions->bgs();
		foreach($bgs as $b)
		{
			copy(__DIR__.'/../../assets/img/bgs/'.$b['file'], __DIR__.'/../../assets/img/bgs/thumb/'.$b['file']);
			$this->upload->img_to_png(__DIR__.'/../../assets/img/bgs/thumb/'.$b['file'], 240);
		}
	}

	public function verify_email($code)
	{
		$user_data = $this->db->where('confirm_code', $code)->get('user')->row_array();
		if(!empty($user_data))
		{
			if($user_data['status'] === 'unconfirmed')
			{
				// legit
				$this->session->set_userdata('user',$user_data);
				$this->user->data = $user_data;

				$this->db->where('email', $user_data['email'])->update('user', [
					'last_login' => date('Y-m-d H:i:s'),
					'status' => 'confirmed'
				]);
			}
			$this->notifications[] = "Your email has been confirmed.";
		}
		else
		{
			if(!empty($this->user->data['id']))
			{
				// logged in, resend;
				$email = $this->user->data['email'];
				$verification = sha1(time().$email);
			
				$this->db->where('email', $email)
					->update('user', ['confirm_code' => $verification ]);
				
				$base_url = $this->config->item('base_path');
			
				$what = send_email(
					'GodForgivesYou.com Account Verification',
					"Visit the link below to verify your email<br/><br/><a href=\"$base_url/verify/$verification\">$base_url/verify/$verification</a>",
					$email
				);
				$this->errors[] = "This link has expired. A new link has been emailed to $email";
			}
			else
			{
				$this->errors[] = "This link has expired. A new link has been emailed to $email";
			}
		}

		$this->view = 'site/index';
		$this->index();
	}

	/* * * * * * * * * * * * * * * * * * *
	 * Some cool functions worth saving. *
	 * * * * * * * * * * * * * * * * * * */

	// this was used for slang.org CMS pages. Should build a CMS system with it.
	public function content($page)
	{
		$this->data['content'] = $this->content->get($page);
		$this->data['page'] = $page;

		$meta = $this->content->get_meta($page);
		config_merge('meta',$meta);
	}

	private function __botcheck(&$post)
	{
		$err = 'Are you a robot?';
		foreach($post as $name => $val)
			if(stripos($name, '00') === 0 && strlen($name) == 42)
			{
				if($this->db->where('name',$name)->get('bot_check')->row_array())
				{
					$err = 'Your message has already been sent!';
					break;
				}
				$k = 0;
				for($i = 0; $i < strlen($name); $i++)
					$k += $i * ord($name[$i]);
				unset($post[$name]);
				if($val == $k)
				{
					$err = '';
					if(rand(0,10) == 10)
						$this->db->query('delete from bot_check where time <  date_sub(now(), interval 7 day)');
					$this->db->insert('bot_check', array('name' => $name));
				}
			}
		return $err;
	}

	public function contact()
	{
		$this->data['content'] = $this->content->get('contact');
	//	$this->data['body_class'] = 'bg5';
		$this->load->library('valid');

		// validation rules
		$rules = array(
			array('name', 'fullname'),
			array('phone', 'phone'),
			array('email', 'email'),
			//array('contact_method', ''),
			array('message', '')
		);

		// did we get some datas?
		$post = $this->input->post();
		if(!$post) // nope
		{
			$this->valid->fill_empty($this->data, $rules);
			return;
		}
		$err = $this->valid->validate($post, $rules);

		/* bot check */
		if(!$err)
			$err = $this->__botcheck($post);

		if($err)
		{
			if($err == 'Your message has already been sent!')
			{
				$post = array();
				$this->valid->fill_empty($this->data, $rules);
			}

			$this->errors[] = $err;
			$this->data = array_merge($this->data, $post);
			return;
		}

		// send email
		$message = '';
		foreach($post as $i => $p)
			$message .= $this->valid->label($i) . ": $p <br/>";
		
		$what = send_email(
			'Message from '.$post['name'],
			$message,
			$this->config->item('contact_recipient')
		);
		$this->valid->make_empty($this->data, $rules);
		$this->notifications[] = 'Your message has been received! You will be contacted shortly.';
	}

	// robots.txt generator
	public function robots()
	{
		$this->view = false;
		header("Content-type: text/plain; charset=utf-8"); 
		echo "Sitemap: " . $this->config->item('base_path') . "/sitemap.xml";

		// Do not index sites in development
		if($this->config->item('environment') !== 'production')
			echo "\nUser-agent: *\nDisallow: /";
	}

	// this is used to verify google webmaster tools
	public function google_verification($code)
	{
		$this->view = false;
		if(trim(strtolower($this->config->item('google_site_verification'))) === 'yes')
			echo "google-site-verification: google$code.html";
		else
			echo "Google Site Verification must be enabled through the administration page.";
	}

	public function _sitemap_urls()
	{
		$base_url = 'http://'.$_SERVER['HTTP_HOST'];

		// initialize home page as top of the pyramid
		$urls = array(
			array(
				'url' => $base_url,
				'text' => $this->config->item('title','meta'),
				'children' => array()
			)
		);

		// top level
		$top = array(
			'contact' => 'Contact',
			'sitemap' => 'Site Map'
		);

		// CMS pages
		$cms = $this->content->get_all();
		foreach($cms as $c)
		{
			if($c['type'] === 'aside') continue;
			$top[$c['name']] = $c['title'] ? $c['title'] : page_to_human($c['name']);
		}
		
		foreach($top as $page => $text)
		{
			$children = array();
			if($page == 'blog')
			{
				$blogs = $this->blog->get_all();
				foreach($blogs as $blog)
					$children[] = array(
						'url' => $base_url . '/blog/view/' . $blog['id'],
						'text' => $blog['name'],
						'children' => array()
					);
			}
			$urls[0]['children'][] = array(
				'url' => $base_url . '/' . $page,
				'text' => $text,
				'children' => $children
			);
		}

		return $urls;
	}

	public function _sitemap_flatten($urls, $priority=1)
	{
		$out = array();
		$yesterday = date('Y-m-d',time()-86400*2);
		$lastweek = date('Y-m-d',time()-86400*8);

		foreach($urls as $u)
		{
			$out[] = array(
				'loc' => $u['url'],
				'lastmod' => $yesterday,
				'changefreq' => 'daily',
				'priority' => $priority
			);
			if(!empty($u['children']))
			{
				$children = $this->_sitemap_flatten($u['children'],$priority - 0.1);
				$out = array_merge($out, $children);
			}
		}
		return $out;
	}

	public function sitemap_xml()
	{
		$this->view = false;
		$this->load->library('xml');

		$urls = $this->_sitemap_urls();
		$urls = $this->_sitemap_flatten($urls);

		header("Content-type: text/xml; charset=utf-8"); 
		echo $this->xml->get_sitemap($urls);
	}

	/* human readable sitemap */
	public function sitemap()
	{
		$this->data['urls'] = $this->_sitemap_urls();
	}

	/* write some text on an image (from slang.org) */
	/* save this shit up in dat file system fo da fastness dawg */
	public function image($type,$id)
	{
		$this->view = false;

		if(file_exists(__DIR__."/../../assets/img/$type/$id.png"))
		{
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: /assets/img/$type/$id.png");
			die;
		}

		$data = $this->confessions->image_data($type,$id);

		if(!$data)
		{
			header('Content-Type: text/html');
			echo "file not found :/";
			exit;
		}

		header('Content-Type: image/png');

		// Create the image
		$im = imagecreatefrompng ( 'assets/img/bgs/'.$data['file'] );

		// font settings
		$font_angle = 0;
		$font_file = 'assets/fonts/Roboto.ttf';

		// Create some colors
		$white = imagecolorallocate($im, 247, 246, 244);
		$black = imagecolorallocate($im, 0,0,0);
		$black2 = imagecolorallocatealpha($im, 0,0,0,80);
		$black3 = imagecolorallocatealpha($im, 0,0,0,120);

		// The text to draw
		$text = $data['text'];

		// calculate font size, word wrap and position
		$wordwrap = 200;
		$font_size = 60;
		$new_text = $text;
		$tries = 0;
		do{
			$new_text = wordwrap($text, $wordwrap);
			$bounds = imagettfbbox ( $font_size, $font_angle, $font_file , $new_text );
			if($bounds[2] < 500 && rand(1,$tries) < 500)
				if($bounds[1] < 300)
					$font_size++;
				else
					$wordwrap++;
			elseif($bounds[2] > 560)
				if($bounds[1] > 340 || rand(1,$tries) > 500)
					$font_size--;
				else
					$wordwrap--;
			elseif($bounds[1] > 340)
				if($bounds[2] > 560 || rand(1,$tries) > 500)
					$font_size--;
				else
					$wordwrap--;
		}while(($bounds[2] > 560 || $bounds[2] < 500 || $bounds[1] > 340) && $tries++ < 1000);

		$x = 300 - $bounds[2] / 2;
		$y = 24 + floor($font_size);
		$text = $new_text;
		
		// Text with shadow
		imagealphablending($im, true);
		imagettftext($im, $font_size, $font_angle, $x+3, $y+3, $black3, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x-3, $y+3, $black3, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x-3, $y-3, $black3, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x+3, $y-3, $black3, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x, $y+3, $black3, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x, $y-3, $black3, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x-3, $y, $black3, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x+3, $y, $black3, $font_file, $text);

		imagettftext($im, $font_size, $font_angle, $x+2, $y+2, $black2, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x-2, $y+2, $black2, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x-2, $y-2, $black2, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x+2, $y-2, $black2, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x, $y+2, $black2, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x, $y-2, $black2, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x-2, $y, $black2, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x+2, $y, $black2, $font_file, $text);

		imagettftext($im, $font_size, $font_angle, $x+1, $y+1, $black, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x-1, $y+1, $black, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x-1, $y-1, $black, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x+1, $y-1, $black, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x, $y+1, $black, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x, $y-1, $black, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x-1, $y, $black, $font_file, $text);
		imagettftext($im, $font_size, $font_angle, $x+1, $y, $black, $font_file, $text);
		
		imagettftext($im, $font_size, $font_angle, $x, $y, $white, $font_file, $text);

		imagepng($im, __DIR__."/../../assets/img/$type/$id.png", 9);
		imagedestroy($im);

		if(file_exists(__DIR__."/../../assets/img/$type/$id.png"))
		{
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: /assets/img/$type/$id.png");
			die;
		}
	}

	public function captcha($w, $h)
	{
		$this->load->model('captcha');
		// captcha word should be set before this is used. see captcha_model
		$this->view = false;
		$this->captcha->out(
			$this->captcha->get_word(),
			intval($w), 
			intval($h)
		);
	}
}

/* End of file site.php */
/* Location: ./application/controllers/site.php */