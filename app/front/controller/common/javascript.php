<?php

namespace Front\Controller\Common;
use Oculus\Engine\Controller;

class Javascript extends Controller {
	
	public function index() {
		$scripts = $this->javascript->fetch();
		$data    = $scripts['data'];
		
		$data['scripts'] = $scripts['files'];
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		return $this->theme->view('common/javascript', $data);
	}
	
	public function runner() {
		$this->javascript->register('jquery.min')
			->register('migrate.min', 'jquery.min')
			->register('underscore.min', 'migrate.min')
			->register('cookie.min', 'underscore.min')
			->register('touchswipe.min', 'cookie.min')
			->register('bootstrap.min', 'cookie.min')
			->register('jstz.min', 'bootstrap.min')
			->register('plugin.min', 'jstz.min')
			->register('video.min', 'plugin.min')
			->register('youtube', 'video.min')
			->register('calendar', 'plugin.min')
			->register('common.min', NULL, true);
			
		$this->theme->listen(__CLASS__, __FUNCTION__);
	}
	
	public function render() {
		$key  = $this->request->get['js'];
		$file = $this->filecache->get($key);
		
		header('Content-Type: application/javascript');
		echo $file;
	}
}