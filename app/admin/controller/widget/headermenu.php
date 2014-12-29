<?php

namespace Admin\Controller\Widget;
use Oculus\Engine\Controller;

class Headermenu extends Controller {
	private $error = array(); 

	public function index() {   
		$data = $this->theme->language('widget/headermenu');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('headermenu', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$this->breadcrumb->add('text_widget', 'module/widget');
		$this->breadcrumb->add('heading_title', 'widget/headermenu');
		
		$data['action'] = $this->url->link('widget/headermenu', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL');

		$data['widgets'] = array();

		if (isset($this->request->post['headermenu_widget'])) {
			$data['widgets'] = $this->request->post['headermenu_widget'];
		} elseif ($this->config->get('headermenu_widget')) { 
			$data['widgets'] = $this->config->get('headermenu_widget');
		}

		$this->theme->model('module/menu');

		$data['menus'] = array();

		$menus = $this->model_module_menu->getMenus();
		
		foreach($menus as $menu):
			$data['menus'][] = array(
				'menu_id' 	=> $menu['menu_id'],
				'name' 		=> $menu['name']
			);
		endforeach;

		$this->theme->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->theme->loadjs('javascript/widget/headermenu', $data);
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('widget/headermenu', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'widget/headermenu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;	
	}
}