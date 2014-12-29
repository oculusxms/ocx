<?php

namespace Admin\Controller\Widget;
use Oculus\Engine\Controller;

class Blogfeatured extends Controller {
	private $error = array(); 
	
	public function index() {   
		$data = $this->theme->language('widget/blogfeatured');
		$this->theme->setTitle($this->language->get('doc_title'));
		$this->theme->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {			
			$this->model_setting_setting->editSetting('blogfeatured', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = array();
		}
		
		$this->breadcrumb->add('text_widget', 'module/widget');
		$this->breadcrumb->add('heading_title', 'widget/blogfeatured');
		
		$data['action'] = $this->url->link('widget/blogfeatured', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['token']  = $this->session->data['token'];

		if (isset($this->request->post['blogfeatured_post'])) {
			$data['blogfeatured_post'] = $this->request->post['blogfeatured_post'];
		} else {
			$data['blogfeatured_post'] = $this->config->get('blogfeatured_post');
		}	
				
		$this->theme->model('content/post');
				
		if (isset($this->request->post['blogfeatured_post'])) {
			$posts = explode(',', $this->request->post['blogfeatured_post']);
		} else {		
			$posts = explode(',', $this->config->get('blogfeatured_post'));
		}
		
		$data['posts'] = array();
		
		foreach ($posts as $post_id) {
			$post_info = $this->model_content_post->getPost($post_id);
			
			if ($post_info) {
				$data['posts'][] = array(
					'post_id'    => $post_info['post_id'],
					'name'       => $post_info['name']
				);
			}
		}	
			
		$data['widgets'] = array();
		
		if (isset($this->request->post['blogfeatured_widget'])) {
			$data['widgets'] = $this->request->post['blogfeatured_widget'];
		} elseif ($this->config->get('blogfeatured_widget')) { 
			$data['widgets'] = $this->config->get('blogfeatured_widget');
		}		
				
		$this->theme->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->theme->loadjs('javascript/widget/blogfeatured', $data);

		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('widget/blogfeatured', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'widget/blogfeatured')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (isset($this->request->post['blogfeatured_widget'])) {
			foreach ($this->request->post['blogfeatured_widget'] as $key => $value) {
				if (!$value['image_width'] || !$value['image_height']) {
					$this->error['image'][$key] = $this->language->get('error_image');
				}
			}
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);
				
		return !$this->error;	
	}
}