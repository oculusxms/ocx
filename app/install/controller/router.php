<?php

namespace Install\Controller;
use Oculus\Engine\Controller;
use Oculus\Engine\Action;
use Oculus\Service\ActionService;

class Router extends Controller {
	public function index() {
		
		$method = null;

		if (!empty($this->request->get['_route_'])):
			$parts = explode('/', $this->request->get['_route_']);
			
			// Native Routes
			if (!isset($this->request->get['route'])):
				$file = $parts[0];
				
				if (count($parts) > 1) $method = $parts[1];
				
				if (is_readable($this->get('path.application') . 'controller/' . $file . '.php')):
					$this->request->get['route'] = $file;
				else:
					$this->request->get['route'] = 'notfound';
				endif;
			endif;
			
			unset($parts);
		
		endif;
		
		if (isset($this->request->get['route'])):
			return new Action(new ActionService($this->app, $this->request->get['route'], array('method' => $method)));
		endif;
	}
}