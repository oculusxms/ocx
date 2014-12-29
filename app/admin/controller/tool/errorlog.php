<?php

namespace Admin\Controller\Tool;
use Oculus\Engine\Controller;

class Errorlog extends Controller { 
	private $error = array();

	public function index() {		
		$data = $this->theme->language('tool/error_log');

		$this->theme->setTitle($this->language->get('heading_title'));

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$this->breadcrumb->add('heading_title', 'tool/errorlog');
		
		$data['clear'] = $this->url->link('tool/errorlog/clear', 'token=' . $this->session->data['token'], 'SSL');

		$file = $this->app['path.logs'] . $this->config->get('config_error_filename');

		if (file_exists($file)) {
			$data['log'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
		} else {
			$data['log'] = '';
		}
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('tool/error_log', $data));
	}

	public function clear() {
		$this->language->load('tool/error_log');

		$file = $this->app['path.logs'] . $this->config->get('config_error_filename');

		$handle = fopen($file, 'w+'); 

		fclose($handle); 			

		$this->session->data['success'] = $this->language->get('text_success');
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->response->redirect($this->url->link('tool/errorlog', 'token=' . $this->session->data['token'], 'SSL'));		
	}
}