<?php

namespace Admin\Controller\Total;
use Oculus\Engine\Controller;
 
class Subtotal extends Controller { 
	private $error = array(); 

	public function index() { 
		$data = $this->theme->language('total/subtotal');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('subtotal', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('module/total', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$this->breadcrumb->add('text_total', 'module/total');
		$this->breadcrumb->add('heading_title', 'total/subtotal');
		
		$data['action'] = $this->url->link('total/subtotal', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('module/total', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['subtotal_status'])) {
			$data['subtotal_status'] = $this->request->post['subtotal_status'];
		} else {
			$data['subtotal_status'] = $this->config->get('subtotal_status');
		}

		if (isset($this->request->post['subtotal_sort_order'])) {
			$data['subtotal_sort_order'] = $this->request->post['subtotal_sort_order'];
		} else {
			$data['subtotal_sort_order'] = $this->config->get('subtotal_sort_order');
		}
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('total/subtotal', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'total/subtotal')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;	
	}
}