<?php

namespace Admin\Controller\Widget;
use Oculus\Engine\Controller;

class Event extends Controller {

	private $error = array(); 
	
	public function index() {   
		$data = $this->theme->language('widget/event');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('event', $this->request->post);		
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
		}

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

   		$this->breadcrumb->add('text_widget', 'module/widget');
   		$this->breadcrumb->add('heading_title', 'widget/event');
		
		$data['action'] = $this->url->link('widget/event', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL');

		$data['widgets'] = array();
		
		if (isset($this->request->post['event_widget'])) {
			$data['widgets'] = $this->request->post['event_widget'];
		} elseif ($this->config->get('event_widget')) { 
			$data['widgets'] = $this->config->get('event_widget');
		}	
		
		$this->theme->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$this->theme->loadjs('javascript/widget/event', $data);

		$data = $this->theme->render_controllers($data);
				
		$this->response->setOutput($this->theme->view('widget/event', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'widget/event')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error;
	}
}
