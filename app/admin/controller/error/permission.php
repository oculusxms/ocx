<?php

namespace Admin\Controller\Error;
use Oculus\Engine\Controller;
   
class Permission extends Controller {    
	public function index() { 
		$data = $this->theme->language('error/permission');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('heading_title', 'error/permission');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('error/permission', $data));
	}
}