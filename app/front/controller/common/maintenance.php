<?php

namespace Front\Controller\Common;
use Oculus\Engine\Controller;
use Oculus\Engine\Action;
use Oculus\Service\ActionService;
use Oculus\Library\User;

class Maintenance extends Controller {
	public function index() {
		if ($this->config->get('config_maintenance')) {
			$route = '';

			if (isset($this->request->get['route'])) {
				$part = explode('/', $this->request->get['route']);

				if (isset($part[0])) {
					$route .= $part[0];
				}			
			}

			// Show site if logged in as admin
			$this->user = new User($this->app);
			
			$this->theme->listen(__CLASS__, __FUNCTION__);

			if (($route != 'payment') && !$this->user->isLogged()) {
				return new Action(new ActionService($this->app, 'common/maintenance/info'));
			}						
		}
	}

	public function info() {
		$data = $this->theme->language('common/maintenance');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('text_maintenance', 'common/maintenance');
		
		$data['message'] = $this->language->get('text_message');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('common/maintenance', $data));
	}
}