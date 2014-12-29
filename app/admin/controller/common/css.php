<?php

namespace Admin\Controller\Common;
use Oculus\Engine\Controller;

class Css extends Controller {
	public function index() {
		$key  = $this->request->get['css'];
		$file = $this->filecache->get($key);
		
		$this->theme->listen(__CLASS__, __FUNCTION__);
		
		header('Content-type: text/css');
		
		echo $file;		
	}
}