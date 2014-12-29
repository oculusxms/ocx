<?php

namespace Install\Controller;
use Oculus\Engine\Controller;

class Header extends Controller {
	public function index() {
		$data['title'] = $this->theme->getTitle();
		$data['base'] = $this->get('http.server');
		
		$data['home'] = $this->url->link('');

		return $this->theme->view('header', $data);
	}
}