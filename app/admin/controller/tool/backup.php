<?php

namespace Admin\Controller\Tool;
use Oculus\Engine\Controller;

class Backup extends Controller { 
	private $error = array();

	public function index() {		
		$data = $this->theme->language('tool/backup');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('tool/backup');

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->user->hasPermission('modify', 'tool/backup')) {
			if (is_uploaded_file($this->request->files['import']['tmp_name'])) {
				$content = file_get_contents($this->request->files['import']['tmp_name']);
			} else {
				$content = false;
			}

			if ($content) {
				$this->model_tool_backup->restore($content);
				$this->session->data['success'] = $this->language->get('text_success');

				$this->response->redirect($this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$this->error['warning'] = $this->language->get('error_empty');
			}
		}

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$this->breadcrumb->add('heading_title', 'tool/backup');
		
		$data['restore'] = $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');
		$data['backup']  = $this->url->link('tool/backup/backup', 'token=' . $this->session->data['token'], 'SSL');
		$data['tables']  = $this->model_tool_backup->getTables();
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('tool/backup', $data));
	}

	public function backup() {
		$this->language->load('tool/backup');

		if (!isset($this->request->post['backup'])) {
			$this->session->data['error'] = $this->language->get('error_backup');
			
			$this->theme->listen(__CLASS__, __FUNCTION__);

			$this->response->redirect($this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL'));
		} elseif ($this->user->hasPermission('modify', 'tool/backup')) {
			$this->response->addheader('Pragma: public');
			$this->response->addheader('Expires: 0');
			$this->response->addheader('Content-Description: File Transfer');
			$this->response->addheader('Content-Type: application/octet-stream');
			$this->response->addheader('Content-Disposition: attachment; filename=' . date('Y-m-d_H-i-s', time()).'_backup.sql');
			$this->response->addheader('Content-Transfer-Encoding: binary');

			$this->theme->model('tool/backup');
			
			$this->theme->listen(__CLASS__, __FUNCTION__);

			$this->response->setOutput($this->model_tool_backup->backup($this->request->post['backup']));
		} else {
			$this->session->data['error'] = $this->language->get('error_permission');
			
			$this->theme->listen(__CLASS__, __FUNCTION__);

			$this->response->redirect($this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL'));			
		}
	}
}