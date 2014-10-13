<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends App_Controller
{
	//protected $layout='layouts/administration';
	protected $authenticate = 'administrator';

	public function __construct()
	{
		$this->models[] = 'content';
		$this->models[] = 'blog';

		parent::__construct();

		$this->asides['topbar'] = 'topbar';
		$this->asides['footer'] = 'footer';
		$this->asides['notifications'] = 'notifications';
		$this->js[] = '/plugins/tinymce/js/tinymce/tinymce.min.js';
		$this->min_js[] = '/plugins/fancybox2/jquery.fancybox.pack.js';
		$this->min_js[] = '/plugins/jquery-ui/js/jquery-ui-1.10.3.custom.min.js';
		$this->min_css[] = '/plugins/jquery-ui/css/smoothness/jquery-ui.min.css';
		$this->min_js[] = 'admin.js';
		//$this->less_css[] = 'admin.less';
		$this->min_css[] = 'admin.css';
	}
	
	public function index()
	{
		try{
			$post = $this->input->post();
			if(is_array($post))
				$post = array_map('trim', $post);
			
			if(isset($post['action']))
			{
				$action = $post['action'];
				unset($post['action']);

				if($action === 'Save Content')
				{
					$this->content->update($post);
				}
				elseif($action === 'Add New Page')
				{
					$this->content->insert($post);
				}
				elseif($action === 'Delete Page')
				{
					$this->content->delete($post['name']);
				}
				elseif($action === 'Save Configuration')
				{
					$this->configuration->save($post);
				}
				elseif($action === 'Save Color Scheme')
				{
					$this->configuration->set_colors($post);
				}
				elseif($action === 'Save Social Media')
				{
					$this->configuration->set_social_media($post);
				}
			}
		}
		catch(Exception $e)
		{
			$this->errors[] = $e->getMessage();
		}

		$this->data['content'] = $this->content->get_all();
		$this->data['configuration'] = $this->configuration->get_all();
		$this->data['colors'] = $this->configuration->get_colors();
		$this->data['social_media'] = $this->configuration->get_social_media();
	}

	public function blog()
	{
		$this->layout = 'blank';
		$this->authenticate = 'blogger';
		$this->data['blogs'] = $this->blog->get_all();
	}

	public function blog_add()
	{
		$this->layout = 'blank';
		$this->authenticate = 'blogger';
		$this->load->library('valid');
		$post = $this->input->post();
		if(empty($post))
			redirect('/admin/blog/');
		$err = $this->valid->validate(
			$post,
			array(
				array('name',''),
				array('content','')
			)
		);
		
		
		if($err)
		{
			$this->data = array_merge($this->data, $post);
			$this->errors[] = $err;
		}
		else
		{
			$this->blog->create($post['name'], $post['content']);
			$this->notifications[] = 'Blog Posted!';
		}

		$this->blog();
		$this->view = 'admin/blog';
	}

	public function blog_edit($id)
	{
		$this->layout = 'blank';
		$this->authenticate = 'blogger';
		$this->load->library('valid');
		$post = $this->input->post();
		if(empty($post))
		{
			$blog = $this->blog->get($id);
			$this->data = array_merge($this->data, $blog);
			return;
		}
		$err = $this->valid->validate(
			$post,
			array(
				array('name',''),
				array('content','')
			)
		);
		if($err)
		{
			$this->data = array_merge($this->data, $post);
			$this->data['id'] = $id;
			$this->errors[] = $err;
		}
		else
		{
			$this->db->where('id',$id)->update('blog',$post);
			$this->notifications[] = 'Changes Saved!';
		}

		$this->blog();
		$this->view = 'admin/blog';
	}

	public function blog_delete($id)
	{
		$this->layout = 'blank';
		$this->authenticate = 'blogger';
		$this->db->where('id',$id)->delete('blog');
		$this->notifications[] = 'Blog Deleted!';
		$this->blog();
		$this->view = 'admin/blog';
	}
}

/* End of file administration.php */
/* Location: ./application/controllers/administration/administration.php */