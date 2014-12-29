<?php

namespace Admin\Controller\Widget;
use Oculus\Engine\Controller;

class Latest extends Controller {
	private $error = array(); 

	public function index() {   
		$data = $this->theme->language('widget/latest');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('latest', $this->request->post);		
			$this->cache->delete('products.latest');
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = array();
		}

		$this->breadcrumb->add('text_widget', 'module/widget');
		$this->breadcrumb->add('heading_title', 'widget/latest');
		
		$data['action'] = $this->url->link('widget/latest', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL');

		$data['widgets'] = array();

		if (isset($this->request->post['latest_widget'])) {
			$data['widgets'] = $this->request->post['latest_widget'];
		} elseif ($this->config->get('latest_widget')) { 
			$data['widgets'] = $this->config->get('latest_widget');
		}				

		$this->theme->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->theme->loadjs('javascript/widget/latest', $data);
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('widget/latest', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'widget/latest')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['latest_widget'])) {
			foreach ($this->request->post['latest_widget'] as $key => $value) {
				if (!$value['image_width'] || !$value['image_height']) {
					$this->error['image'][$key] = $this->language->get('error_image');
				}
			}
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);		

		return !$this->error;	
	}
}