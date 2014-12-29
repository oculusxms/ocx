<?php

namespace Front\Controller\Common;
use Oculus\Engine\Controller;

class Breadcrumb extends Controller {	
	public function index() {
		
		$data['breadcrumbs'] = $this->breadcrumb->fetch();
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		return $this->theme->view('common/breadcrumb', $data);
	}
}