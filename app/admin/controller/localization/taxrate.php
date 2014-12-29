<?php

namespace Admin\Controller\Localization;
use Oculus\Engine\Controller;

class Taxrate extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('localization/tax_rate');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('localization/taxrate');
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getList(); 
	}

	public function insert() {
		$this->language->load('localization/tax_rate');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('localization/taxrate');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localization_taxrate->addTaxRate($this->request->post);
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

			$this->response->redirect($this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getForm();
	}

	public function update() {
		$this->language->load('localization/tax_rate');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('localization/taxrate');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localization_taxrate->editTaxRate($this->request->get['tax_rate_id'], $this->request->post);
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

			$this->response->redirect($this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getForm();
	}

	public function delete() {
		$this->language->load('localization/tax_rate');
		$this->theme->setTitle($this->language->get('heading_title'));
		$this->theme->model('localization/taxrate');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $tax_rate_id) {
				$this->model_localization_taxrate->deleteTaxRate($tax_rate_id);
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

			$this->response->redirect($this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getList();
	}

	protected function getList() {
		$data = $this->theme->language('localization/tax_rate');
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'tr.name';
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

		$this->breadcrumb->add('heading_title', 'localization/taxrate', $url);
		
		$data['insert'] = $this->url->link('localization/taxrate/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('localization/taxrate/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');		

		$data['tax_rates'] = array();

		$filter = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$tax_rate_total = $this->model_localization_taxrate->getTotalTaxRates();

		$results = $this->model_localization_taxrate->getTaxRates($filter);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('localization/taxrate/update', 'token=' . $this->session->data['token'] . '&tax_rate_id=' . $result['tax_rate_id'] . $url, 'SSL')
			);

			$data['tax_rates'][] = array(
				'tax_rate_id'   => $result['tax_rate_id'],
				'name'          => $result['name'],
				'rate'          => $result['rate'],
				'type'          => ($result['type'] == 'F' ? $this->language->get('text_amount') : $this->language->get('text_percent')),				
				'geo_zone'      => $result['geo_zone'],
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'selected'      => isset($this->request->post['selected']) && in_array($result['tax_rate_id'], $this->request->post['selected']),
				'action'        => $action				
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

		$data['sort_name'] 			= $this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . '&sort=tr.name' . $url, 'SSL');
		$data['sort_rate'] 			= $this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . '&sort=tr.rate' . $url, 'SSL');
		$data['sort_type'] 			= $this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . '&sort=tr.type' . $url, 'SSL');
		$data['sort_geo_zone'] 		= $this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . '&sort=gz.name' . $url, 'SSL');
		$data['sort_date_added'] 	= $this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . '&sort=tr.date_added' . $url, 'SSL');
		$data['sort_date_modified'] = $this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . '&sort=tr.date_modified' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$data['pagination'] = $this->theme->paginate(
			$tax_rate_total,
			$page,
			$this->config->get('config_admin_limit'),
			$this->language->get('text_pagination'),
			$this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL')
		);

		$data['sort']  = $sort;
		$data['order'] = $order;
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('localization/tax_rate_list', $data));
	}

	protected function getForm() {
		$data = $this->theme->language('localization/tax_rate');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['rate'])) {
			$data['error_rate'] = $this->error['rate'];
		} else {
			$data['error_rate'] = '';
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

		$this->breadcrumb->add('heading_title', 'localization/taxrate', $url);
		
		if (!isset($this->request->get['tax_rate_id'])) {
			$data['action'] = $this->url->link('localization/taxrate/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('localization/taxrate/update', 'token=' . $this->session->data['token'] . '&tax_rate_id=' . $this->request->get['tax_rate_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('localization/taxrate', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['tax_rate_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$tax_rate_info = $this->model_localization_taxrate->getTaxRate($this->request->get['tax_rate_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($tax_rate_info)) {
			$data['name'] = $tax_rate_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['rate'])) {
			$data['rate'] = $this->request->post['rate'];
		} elseif (!empty($tax_rate_info)) {
			$data['rate'] = $tax_rate_info['rate'];
		} else {
			$data['rate'] = '';
		}

		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($tax_rate_info)) {
			$data['type'] = $tax_rate_info['type'];
		} else {
			$data['type'] = '';
		}

		if (isset($this->request->post['tax_rate_customer_group'])) {
			$data['tax_rate_customer_group'] = $this->request->post['tax_rate_customer_group'];
		} elseif (isset($this->request->get['tax_rate_id'])) {
			$data['tax_rate_customer_group'] = $this->model_localization_taxrate->getTaxRateCustomerGroups($this->request->get['tax_rate_id']);
		} else {
			$data['tax_rate_customer_group'] = array();
		}	

		$this->theme->model('people/customergroup');

		$data['customer_groups'] = $this->model_people_customergroup->getCustomerGroups();

		if (isset($this->request->post['geo_zone_id'])) {
			$data['geo_zone_id'] = $this->request->post['geo_zone_id'];
		} elseif (!empty($tax_rate_info)) {
			$data['geo_zone_id'] = $tax_rate_info['geo_zone_id'];
		} else {
			$data['geo_zone_id'] = '';
		}

		$this->theme->model('localization/geozone');

		$data['geo_zones'] = $this->model_localization_geozone->getGeoZones();
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('localization/tax_rate_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localization/taxrate')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->request->post['rate']) {
			$this->error['rate'] = $this->language->get('error_rate');
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localization/taxrate')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->theme->model('localization/taxclass');

		foreach ($this->request->post['selected'] as $tax_rate_id) {
			$tax_rule_total = $this->model_localization_taxclass->getTotalTaxRulesByTaxRateId($tax_rate_id);

			if ($tax_rule_total) {
				$this->error['warning'] = sprintf($this->language->get('error_tax_rule'), $tax_rule_total);
			}
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;
	}	
}