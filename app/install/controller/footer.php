<?php

namespace Install\Controller;
use Oculus\Engine\Controller;

class Footer extends Controller {
	public function index() {
		return $this->theme->view('footer');
	}
}