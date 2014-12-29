<?php

namespace Admin\Controller\Design;
use Oculus\Engine\Controller;

class Customfield extends Controller {
	private $error = array();  

	public function index() {
		$this->language->load('design/custom_field');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->theme->model('design/customfield');
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getList();
	}

	public function insert() {
		$this->language->load('design/custom_field');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->theme->model('design/customfield');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_customfield->addCustomField($this->request->post);

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

			$this->response->redirect($this->url->link('design/customfield', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getForm();
	}

	public function update() {
		$this->language->load('design/custom_field');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->theme->model('design/customfield');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_customfield->editCustomField($this->request->get['custom_field_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('design/customfield', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getForm();
	}

	public function delete() {
		$this->language->load('design/custom_field');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->theme->model('design/customfield');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $custom_field_id) {
				$this->model_design_customfield->deleteCustomField($custom_field_id);
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

			$this->response->redirect($this->url->link('design/customfield', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getList();
	}

	protected function getList() {
		$data = $this->theme->language('design/custom_field');
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'cfd.name';
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

		$this->breadcrumb->add('heading_title', 'design/customfield', $url);
		
		$data['insert'] = $this->url->link('design/customfield/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('design/customfield/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['custom_fields'] = array();

		$filter = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$custom_field_total = $this->model_design_customfield->getTotalCustomFields();

		$results = $this->model_design_customfield->getCustomFields($filter);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('design/customfield/update', 'token=' . $this->session->data['token'] . '&custom_field_id=' . $result['custom_field_id'] . $url, 'SSL')
			);

			$type = '';

			switch ($result['type']) {
				case 'select':
					$type = $this->language->get('text_select');
					break;
				case 'radio':
					$type = $this->language->get('text_radio');
					break;
				case 'checkbox':
					$type = $this->language->get('text_checkbox');
					break;
				case 'input':
					$type = $this->language->get('text_input');
					break;
				case 'text':
					$type = $this->language->get('text_text');
					break;
				case 'textarea':
					$type = $this->language->get('text_textarea');
					break;
				case 'file':
					$type = $this->language->get('text_file');
					break;
				case 'date':
					$type = $this->language->get('text_date');
					break;																														
				case 'datetime':
					$type = $this->language->get('text_datetime');
					break;	
				case 'time':
					$type = $this->language->get('text_time');
					break;																	
			}

			$location = '';

			switch ($result['location']) {
				case 'customer':
					$location = $this->language->get('text_customer');
					break;
				case 'address':
					$location = $this->language->get('text_address');
					break;
				case 'payment_address':
					$location = $this->language->get('text_payment_address');
					break;
				case 'shipping_address':
					$location = $this->language->get('text_shipping_address');
					break;										
			}			

			$data['custom_fields'][] = array(
				'custom_field_id' => $result['custom_field_id'],
				'name'            => $result['name'],
				'type'            => $type,
				'location'        => $location,
				'sort_order'      => $result['sort_order'],
				'selected'        => isset($this->request->post['selected']) && in_array($result['custom_field_id'], $this->request->post['selected']),
				'action'          => $action
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

		$data['sort_name'] = $this->url->link('design/customfield', 'token=' . $this->session->data['token'] . '&sort=cfd.name' . $url, 'SSL');
		$data['sort_type'] = $this->url->link('design/customfield', 'token=' . $this->session->data['token'] . '&sort=cf.type' . $url, 'SSL');
		$data['sort_location'] = $this->url->link('design/customfield', 'token=' . $this->session->data['token'] . '&sort=cf.name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('design/customfield', 'token=' . $this->session->data['token'] . '&sort=cf.sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$data['pagination'] = $this->theme->paginate(
			$custom_field_total,
			$page,
			$this->config->get('config_admin_limit'),
			$this->language->get('text_pagination'),
			$this->url->link('design/customfield', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL')
		);

		$data['sort']  = $sort;
		$data['order'] = $order;
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('design/custom_field_list', $data));
	}

	protected function getForm() {
		$data = $this->theme->language('design/custom_field');
		
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

		if (isset($this->error['custom_field_value'])) {
			$data['error_custom_field_value'] = $this->error['custom_field_value'];
		} else {
			$data['error_custom_field_value'] = array();
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

		$this->breadcrumb->add('heading_title', 'design/customfield', $url);
		
		if (!isset($this->request->get['custom_field_id'])) {
			$data['action'] = $this->url->link('design/customfield/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else { 
			$data['action'] = $this->url->link('design/customfield/update', 'token=' . $this->session->data['token'] . '&custom_field_id=' . $this->request->get['custom_field_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('design/customfield', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['custom_field_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$custom_field_info = $this->model_design_customfield->getCustomField($this->request->get['custom_field_id']);
		}

		$data['token'] = $this->session->data['token'];

		$this->theme->model('localization/language');

		$data['languages'] = $this->model_localization_language->getLanguages();

		if (isset($this->request->post['custom_field_description'])) {
			$data['custom_field_description'] = $this->request->post['custom_field_description'];
		} elseif (isset($this->request->get['custom_field_id'])) {
			$data['custom_field_description'] = $this->model_design_customfield->getCustomFieldDescriptions($this->request->get['custom_field_id']);
		} else {
			$data['custom_field_description'] = array();
		}	

		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($custom_field_info)) {
			$data['type'] = $custom_field_info['type'];
		} else {
			$data['type'] = '';
		}

		if (isset($this->request->post['value'])) {
			$data['value'] = $this->request->post['value'];
		} elseif (!empty($custom_field_info)) {
			$data['value'] = $custom_field_info['value'];
		} else {
			$data['value'] = '';
		}

		if (isset($this->request->post['required'])) {
			$data['required'] = $this->request->post['required'];
		} elseif (!empty($custom_field_info)) {
			$data['required'] = $custom_field_info['required'];
		} else {
			$data['required'] = '';
		}

		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($custom_field_info)) {
			$data['location'] = $custom_field_info['location'];
		} else {
			$data['location'] = '';
		}

		if (isset($this->request->post['position'])) {
			$data['position'] = $this->request->post['position'];
		} elseif (!empty($custom_field_info)) {
			$data['position'] = $custom_field_info['position'];
		} else {
			$data['position'] = '';
		}	

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($custom_field_info)) {
			$data['sort_order'] = $custom_field_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if (isset($this->request->post['custom_field_value'])) {
			$custom_field_values = $this->request->post['custom_field_value'];
		} elseif (isset($this->request->get['custom_field_id'])) {
			$custom_field_values = $this->model_design_customfield->getCustomFieldValueDescriptions($this->request->get['custom_field_id']);
		} else {
			$custom_field_values = array();
		}

		$data['custom_field_values'] = array();

		foreach ($custom_field_values as $custom_field_value) {
			$data['custom_field_values'][] = array(
				'custom_field_value_id'          => $custom_field_value['custom_field_value_id'],
				'custom_field_value_description' => $custom_field_value['custom_field_value_description'],
				'sort_order'                     => $custom_field_value['sort_order']
			);
		}
		
		$this->theme->loadjs('javascript/design/custom_field_form', $data);
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('design/custom_field_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'design/customfield')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['custom_field_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 128)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if (($this->request->post['type'] == 'select' || $this->request->post['type'] == 'radio' || $this->request->post['type'] == 'checkbox') && !isset($this->request->post['custom_field_value'])) {
			$this->error['warning'] = $this->language->get('error_type');
		}

		if (isset($this->request->post['custom_field_value'])) {
			foreach ($this->request->post['custom_field_value'] as $custom_field_value_id => $custom_field_value) {
				foreach ($custom_field_value['custom_field_value_description'] as $language_id => $custom_field_value_description) {
					if ((utf8_strlen($custom_field_value_description['name']) < 1) || (utf8_strlen($custom_field_value_description['name']) > 128)) {
						$this->error['custom_field_value'][$custom_field_value_id][$language_id] = $this->language->get('error_custom_field_value'); 
					}					
				}
			}	
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'design/customfield')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->theme->model('sale/product');

		foreach ($this->request->post['selected'] as $custom_field_id) {
			$product_total = $this->model_sale_product->getTotalProductsByCustomFieldId($custom_field_id);

			if ($product_total) {
				$this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);
			}
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;
	}	
}