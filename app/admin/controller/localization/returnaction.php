<?php

namespace Admin\Controller\Localization;
use Oculus\Engine\Controller;
 
class Returnaction extends Controller { 
	private $error = array();

	public function index() {
		$this->language->load('localization/return_action');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('localization/returnaction');
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getList();
	}

	public function insert() {
		$this->language->load('localization/return_action');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('localization/returnaction');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localization_returnaction->addReturnAction($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localization/returnaction', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getForm();
	}

	public function update() {
		$this->language->load('localization/return_action');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('localization/returnaction');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localization_returnaction->editReturnAction($this->request->get['return_action_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localization/returnaction', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getForm();
	}

	public function delete() {
		$this->language->load('localization/return_action');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('localization/returnaction');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $return_action_id) {
				$this->model_localization_returnaction->deleteReturnAction($return_action_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localization/returnaction', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getList();
	}

	protected function getList() {
		$data = $this->theme->language('localization/return_action');
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->breadcrumb->add('heading_title', 'localization/returnaction', $url);
		
		$data['insert'] = $this->url->link('localization/returnaction/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('localization/returnaction/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	

		$data['return_actions'] = array();

		$filter = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$return_action_total = $this->model_localization_returnaction->getTotalReturnActions();

		$results = $this->model_localization_returnaction->getReturnActions($filter);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('localization/returnaction/update', 'token=' . $this->session->data['token'] . '&return_action_id=' . $result['return_action_id'] . $url, 'SSL')
			);

			$data['return_actions'][] = array(
				'return_action_id' => $result['return_action_id'],
				'name'             => $result['name'],
				'selected'         => isset($this->request->post['selected']) && in_array($result['return_action_id'], $this->request->post['selected']),
				'action'           => $action
			);
		}	

		if (isset($this->error['warning'])) {
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

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('localization/returnaction', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$data['pagination'] = $this->theme->paginate(
			$return_action_total,
			$page,
			$this->config->get('config_admin_limit'),
			$this->language->get('text_pagination'),
			$this->url->link('localization/returnaction', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL')
		);

		$data['sort']  = $sort;
		$data['order'] = $order;
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('localization/return_action_list', $data));
	}

	protected function getForm() {
		$data = $this->theme->language('localization/return_action');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->breadcrumb->add('heading_title', 'localization/returnaction', $url);
		
		if (!isset($this->request->get['return_action_id'])) {
			$data['action'] = $this->url->link('localization/returnaction/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('localization/returnaction/update', 'token=' . $this->session->data['token'] . '&return_action_id=' . $this->request->get['return_action_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('localization/returnaction', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->theme->model('localization/language');

		$data['languages'] = $this->model_localization_language->getLanguages();

		if (isset($this->request->post['return_action'])) {
			$data['return_action'] = $this->request->post['return_action'];
		} elseif (isset($this->request->get['return_action_id'])) {
			$data['return_action'] = $this->model_localization_returnaction->getReturnActionDescriptions($this->request->get['return_action_id']);
		} else {
			$data['return_action'] = array();
		}
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('localization/return_action_form', $data));	
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localization/returnaction')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['return_action'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 32)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localization/returnaction')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->theme->model('sale/returns');

		foreach ($this->request->post['selected'] as $return_action_id) {
			$return_total = $this->model_sale_returns->getTotalReturnsByReturnActionId($return_action_id);

			if ($return_total) {
				$this->error['warning'] = sprintf($this->language->get('error_return'), $return_total);
			}  
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;
	}
}