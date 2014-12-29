<?php

namespace Admin\Controller\Common;
use Oculus\Engine\Controller;
       
class Logout extends Controller {   
	public function index() { 
		$this->user->logout();
		
		unset($this->session->data['token']);
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->response->redirect($this->app['config_ssl']);
	}
}