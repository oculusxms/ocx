<?php

namespace Admin\Controller\Tool;
use Oculus\Engine\Controller;
      
class Test extends Controller {   
	public function index() { 
		$data = $this->theme->language('tool/test');

		$this->theme->setTitle($this->language->get('heading_title'));

		if (isset($this->session->data['success'])):
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		else:
			$data['success'] = '';
		endif;
		
		$this->breadcrumb->add('heading_title', 'tool/test');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$data = $this->theme->render_controllers($data);
		
		$this->response->setOutput($this->theme->view('tool/test', $data));
	}
}