<?php

namespace Admin\Controller\Module;
use Oculus\Engine\Controller;

class Payment extends Controller {
	public function index() {
		$data = $this->theme->language('module/payment');
		$this->theme->setTitle($this->language->get('heading_payment')); 

		$this->breadcrumb->add('heading_payment', 'module/payment');
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->session->data['error'])) {
			$data['error'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} else {
			$data['error'] = '';
		}

		$this->theme->model('setting/module');

		$modules = $this->model_setting_module->getInstalled('payment');

		foreach ($modules as $key => $value) {
			$theme_file = $this->theme->path . 'controller/payment/' . $value . '.php';
			$core_file  = $this->app['path.application'] . 'controller/payment/' . $value . '.php';
			
			if (!is_readable($theme_file) && !is_readable($core_file)) {
				$this->model_setting_module->uninstall('payment', $value);

				unset($modules[$key]);
			}
		}

		$data['modules'] = array();

		$files = $this->theme->getFiles('payment');
		
		if ($files) {
			foreach ($files as $file) {
				$module = strtolower(basename($file, '.php'));

				$data = $this->theme->language('payment/' . $module, $data);

				$action = array();

				if (!in_array($module, $modules)) {
					$action[] = array(
						'text' => $this->language->get('text_install'),
						'href' => $this->url->link('module/payment/install', 'token=' . $this->session->data['token'] . '&module=' . $module, 'SSL')
					);
				} else {
					$action[] = array(
						'text' => $this->language->get('text_edit'),
						'href' => $this->url->link('payment/' . $module . '', 'token=' . $this->session->data['token'], 'SSL')
					);

					$action[] = array(
						'text' => $this->language->get('text_uninstall'),
						'href' => $this->url->link('module/payment/uninstall', 'token=' . $this->session->data['token'] . '&module=' . $module, 'SSL')
					);
				}

				$data['modules'][] = array(
					'name'       => $this->language->get('heading_title'),
					'status'     => $this->config->get($module . '_status') ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
					'sort_order' => $this->config->get($module . '_sort_order'),
					'action'     => $action
				);
			}
		}
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('module/payment', $data));
	}

	public function install() {
		$this->language->load('module/payment');

		if (!$this->user->hasPermission('modify', 'module/payment')) {
			$this->session->data['error'] = $this->language->get('error_permission');
			
			$this->theme->listen(__CLASS__, __FUNCTION__); 

			$this->response->redirect($this->url->link('module/payment', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			$this->theme->model('setting/module');

			$this->model_setting_module->install('payment', $this->request->get['module']);

			$this->theme->model('people/user_group');

			$this->model_people_user_group->addPermission($this->user->getId(), 'access', 'payment/' . $this->request->get['module']);
			$this->model_people_user_group->addPermission($this->user->getId(), 'modify', 'payment/' . $this->request->get['module']);

			if (is_readable($this->theme->path . 'controller/payment/' .  $this->request->get['module'] . '.php')):
				$class = 'Theme\Admin\\' . $this->theme->name . '\Controller\Payment\\' . ucfirst($this->request->get['module']);
			else:
				$class = 'Admin\Controller\Payment\\' . ucfirst($this->request->get['module']);
			endif;
			
			$class = new $class($this->app);

			if (method_exists($class, 'install')) {
				$class->install();
			}
			
			$this->theme->listen(__CLASS__, __FUNCTION__);

			$this->response->redirect($this->url->link('module/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}

	public function uninstall() {
		$this->language->load('module/payment');

		if (!$this->user->hasPermission('modify', 'module/payment')) {
			$this->session->data['error'] = $this->language->get('error_permission');
			
			$this->theme->listen(__CLASS__, __FUNCTION__); 

			$this->response->redirect($this->url->link('module/payment', 'token=' . $this->session->data['token'], 'SSL'));
		} else {		
			$this->theme->model('setting/module');
			$this->theme->model('setting/setting');

			$this->model_setting_module->uninstall('payment', $this->request->get['module']);
			$this->model_setting_setting->deleteSetting($this->request->get['module']);

			if (is_readable($this->theme->path . 'controller/payment/' .  $this->request->get['module'] . '.php')):
				$class = 'Theme\Admin\\' . $this->theme->name . '\Controller\Payment\\' . ucfirst($this->request->get['module']);
			else:
				$class = 'Admin\Controller\Payment\\' . ucfirst($this->request->get['module']);
			endif;
			
			$class = new $class($this->app);

			if (method_exists($class, 'uninstall')) {
				$class->uninstall();
			}
			
			$this->theme->listen(__CLASS__, __FUNCTION__);

			$this->response->redirect($this->url->link('module/payment', 'token=' . $this->session->data['token'], 'SSL'));	
		}			
	}
}