<?php

namespace Front\Controller\Error;
use Oculus\Engine\Controller;

class Permission extends Controller {
	
	public function index() {
		$data = $this->theme->language('error/permission');

		$this->theme->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['route'])) {
			$routes = $this->request->get;

			unset($routes['_route_']);

			$route = $routes['route'];

			unset($routes['route']);

			$url = '';

			if ($routes) {
				$url = '&' . urldecode(http_build_query($routes, '', '&'));
			}	

			if (isset($this->request->server['https']) && (($this->request->server['https'] == 'on') || ($this->request->server['https'] == '1'))) {
				$connection = 'ssl';
			} else {
				$connection = 'nonssl';
			}
			
			$this->breadcrumb->add('heading_title', $route, $url, true, $connection);
		}

		$data['continue'] = $this->url->link($this->theme->style . '/home');

		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('error/permission', $data));
	}
}
