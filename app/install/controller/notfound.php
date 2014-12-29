<?php

namespace Install\Controller;
use Oculus\Engine\Controller;

class Notfound extends Controller {
	public function index() {
		
		$this->theme->setTitle('WHOOPS! Can\'t Find That Here');
		
		$data['header'] = $this->theme->controller('header');
		$data['footer'] = $this->theme->controller('footer');

		$this->response->setOutput($this->theme->view('notfound', $data));
	}
}