<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|	
|	(c) Vince Kronlein <vince@ocx.io>
|	
|	For the full copyright and license information, please view the LICENSE
|	file that was distributed with this source code.
|	
*/

namespace Admin\Controller\People;
use Oculus\Engine\Controller;

class Customer extends Controller {
    private $error = array();
    
    public function index() {
        $this->language->load('people/customer');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('people/customer');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function insert() {
        $this->language->load('people/customer');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_people_customer->addCustomer($this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_username'])) {
                $url.= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_name'])) {
                $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_email'])) {
                $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_customer_group_id'])) {
                $url.= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
            }
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function update() {
        $this->language->load('people/customer');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_people_customer->editCustomer($this->request->get['customer_id'], $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_username'])) {
                $url.= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_name'])) {
                $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_email'])) {
                $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_customer_group_id'])) {
                $url.= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
            }
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function delete() {
        $this->language->load('people/customer');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('people/customer');
        
        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $customer_id) {
                $this->model_people_customer->deleteCustomer($customer_id);
            }
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_username'])) {
                $url.= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_name'])) {
                $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_email'])) {
                $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_customer_group_id'])) {
                $url.= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
            }
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function approve() {
        $this->language->load('people/customer');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('people/customer');
        
        if (!$this->user->hasPermission('modify', 'people/customer')) {
            $this->error['warning'] = $this->language->get('error_permission');
        } elseif (isset($this->request->post['selected'])) {
            $approved = 0;
            
            foreach ($this->request->post['selected'] as $customer_id) {
                $customer_info = $this->model_people_customer->getCustomer($customer_id);
                
                if ($customer_info && !$customer_info['approved']) {
                    $this->model_people_customer->approve($customer_id);
                    
                    $approved++;
                }
            }
            
            $this->session->data['success'] = sprintf($this->language->get('text_approved'), $approved);
            
            $url = '';
            
            if (isset($this->request->get['filter_username'])) {
                $url.= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_name'])) {
                $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_email'])) {
                $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_customer_group_id'])) {
                $url.= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
            }
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    protected function getList() {
        $data = $this->theme->language('people/customer');
        
        if (isset($this->request->get['filter_username'])) {
            $filter_username = $this->request->get['filter_username'];
        } else {
            $filter_username = null;
        }
        
        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }
        
        if (isset($this->request->get['filter_email'])) {
            $filter_email = $this->request->get['filter_email'];
        } else {
            $filter_email = null;
        }
        
        if (isset($this->request->get['filter_customer_group_id'])) {
            $filter_customer_group_id = $this->request->get['filter_customer_group_id'];
        } else {
            $filter_customer_group_id = null;
        }
        
        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'username';
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
        
        if (isset($this->request->get['filter_username'])) {
            $url.= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_name'])) {
            $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_email'])) {
            $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_customer_group_id'])) {
            $url.= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $this->breadcrumb->add('heading_title', 'people/customer', $url);
        
        $data['approve'] = $this->url->link('people/customer/approve', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['insert'] = $this->url->link('people/customer/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('people/customer/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        $data['customers'] = array();
        
        $filter = array('filter_username' => $filter_username, 'filter_name' => $filter_name, 'filter_email' => $filter_email, 'filter_customer_group_id' => $filter_customer_group_id, 'filter_status' => $filter_status, 'sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $this->config->get('config_admin_limit'), 'limit' => $this->config->get('config_admin_limit'));
        
        $customer_total = $this->model_people_customer->getTotalCustomers($filter);
        
        $results = $this->model_people_customer->getCustomers($filter);
        
        foreach ($results as $result) {
            $action = array();
            
            $action[] = array('text' => $this->language->get('text_edit'), 'href' => $this->url->link('people/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, 'SSL'));
            
            $data['customers'][] = array('customer_id' => $result['customer_id'], 'username' => $result['username'], 'name' => $result['name'], 'email' => $result['email'], 'customer_group' => $result['customer_group'], 'status' => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')), 'approved' => ($result['approved'] ? $this->language->get('text_yes') : $this->language->get('text_no')), 'ip' => $result['ip'], 'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])), 'selected' => isset($this->request->post['selected']) && in_array($result['customer_id'], $this->request->post['selected']), 'action' => $action);
        }
        
        $data['token'] = $this->session->data['token'];
        
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
        
        if (isset($this->request->get['filter_username'])) {
            $url.= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_name'])) {
            $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_email'])) {
            $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_customer_group_id'])) {
            $url.= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if ($order == 'ASC') {
            $url.= '&order=DESC';
        } else {
            $url.= '&order=ASC';
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $data['sort_username'] = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=username' . $url, 'SSL');
        $data['sort_name'] = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
        $data['sort_email'] = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=c.email' . $url, 'SSL');
        $data['sort_customer_group'] = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=customer_group' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, 'SSL');
        
        $url = '';
        
        if (isset($this->request->get['filter_username'])) {
            $url.= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_name'])) {
            $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_email'])) {
            $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_customer_group_id'])) {
            $url.= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        $data['pagination'] = $this->theme->paginate($customer_total, $page, $this->config->get('config_admin_limit'), $this->language->get('text_pagination'), $this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL'));
        
        $data['filter_username'] = $filter_username;
        $data['filter_name'] = $filter_name;
        $data['filter_email'] = $filter_email;
        $data['filter_customer_group_id'] = $filter_customer_group_id;
        $data['filter_status'] = $filter_status;
        
        $this->theme->model('people/customergroup');
        
        $data['customer_groups'] = $this->model_people_customergroup->getCustomerGroups();
        
        $this->theme->model('setting/store');
        
        $data['stores'] = $this->model_setting_store->getStores();
        
        $data['sort'] = $sort;
        $data['order'] = $order;
        
        $this->theme->loadjs('javascript/people/customer_list', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('people/customer_list', $data));
    }
    
    protected function getForm() {
        $data = $this->theme->language('people/customer');
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->request->get['customer_id'])) {
            $data['customer_id'] = $this->request->get['customer_id'];
        } else {
            $data['customer_id'] = 0;
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['username'])) {
            $data['error_username'] = $this->error['username'];
        } else {
            $data['error_username'] = '';
        }
        
        if (isset($this->error['firstname'])) {
            $data['error_firstname'] = $this->error['firstname'];
        } else {
            $data['error_firstname'] = '';
        }
        
        if (isset($this->error['lastname'])) {
            $data['error_lastname'] = $this->error['lastname'];
        } else {
            $data['error_lastname'] = '';
        }
        
        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
        }
        
        if (isset($this->error['telephone'])) {
            $data['error_telephone'] = $this->error['telephone'];
        } else {
            $data['error_telephone'] = '';
        }
        
        if (isset($this->error['password'])) {
            $data['error_password'] = $this->error['password'];
        } else {
            $data['error_password'] = '';
        }
        
        if (isset($this->error['confirm'])) {
            $data['error_confirm'] = $this->error['confirm'];
        } else {
            $data['error_confirm'] = '';
        }
        
        if (isset($this->error['address_firstname'])) {
            $data['error_address_firstname'] = $this->error['address_firstname'];
        } else {
            $data['error_address_firstname'] = '';
        }
        
        if (isset($this->error['address_lastname'])) {
            $data['error_address_lastname'] = $this->error['address_lastname'];
        } else {
            $data['error_address_lastname'] = '';
        }
        
        if (isset($this->error['address_tax_id'])) {
            $data['error_address_tax_id'] = $this->error['address_tax_id'];
        } else {
            $data['error_address_tax_id'] = '';
        }
        
        if (isset($this->error['address_address_1'])) {
            $data['error_address_address_1'] = $this->error['address_address_1'];
        } else {
            $data['error_address_address_1'] = '';
        }
        
        if (isset($this->error['address_city'])) {
            $data['error_address_city'] = $this->error['address_city'];
        } else {
            $data['error_address_city'] = '';
        }
        
        if (isset($this->error['address_postcode'])) {
            $data['error_address_postcode'] = $this->error['address_postcode'];
        } else {
            $data['error_address_postcode'] = '';
        }
        
        if (isset($this->error['address_country'])) {
            $data['error_address_country'] = $this->error['address_country'];
        } else {
            $data['error_address_country'] = '';
        }
        
        if (isset($this->error['address_zone'])) {
            $data['error_address_zone'] = $this->error['address_zone'];
        } else {
            $data['error_address_zone'] = '';
        }
        
        $url = '';
        
        if (isset($this->request->get['filter_username'])) {
            $url.= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_name'])) {
            $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_email'])) {
            $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_customer_group_id'])) {
            $url.= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $this->breadcrumb->add('heading_title', 'people/customer', $url);
        
        if (!isset($this->request->get['customer_id'])) {
            $data['action'] = $this->url->link('people/customer/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('people/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $url, 'SSL');
        }
        
        $data['cancel'] = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $customer_info = $this->model_people_customer->getCustomer($this->request->get['customer_id']);
        }
        
        if (isset($this->request->post['username'])) {
            $data['username'] = $this->request->post['username'];
        } elseif (!empty($customer_info)) {
            $data['username'] = $customer_info['username'];
        } else {
            $data['username'] = '';
        }
        
        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        } elseif (!empty($customer_info)) {
            $data['firstname'] = $customer_info['firstname'];
        } else {
            $data['firstname'] = '';
        }
        
        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        } elseif (!empty($customer_info)) {
            $data['lastname'] = $customer_info['lastname'];
        } else {
            $data['lastname'] = '';
        }
        
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($customer_info)) {
            $data['email'] = $customer_info['email'];
        } else {
            $data['email'] = '';
        }
        
        if (isset($this->request->post['telephone'])) {
            $data['telephone'] = $this->request->post['telephone'];
        } elseif (!empty($customer_info)) {
            $data['telephone'] = $customer_info['telephone'];
        } else {
            $data['telephone'] = '';
        }
        
        if (isset($this->request->post['newsletter'])) {
            $data['newsletter'] = $this->request->post['newsletter'];
        } elseif (!empty($customer_info)) {
            $data['newsletter'] = $customer_info['newsletter'];
        } else {
            $data['newsletter'] = '';
        }
        
        $this->theme->model('people/customergroup');
        
        $data['customer_groups'] = $this->model_people_customergroup->getCustomerGroups();
        
        if (isset($this->request->post['customer_group_id'])) {
            $data['customer_group_id'] = $this->request->post['customer_group_id'];
        } elseif (!empty($customer_info)) {
            $data['customer_group_id'] = $customer_info['customer_group_id'];
        } else {
            $data['customer_group_id'] = $this->config->get('config_customer_group_id');
        }
        
        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($customer_info)) {
            $data['status'] = $customer_info['status'];
        } else {
            $data['status'] = 1;
        }
        
        if (isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        } else {
            $data['password'] = '';
        }
        
        if (isset($this->request->post['confirm'])) {
            $data['confirm'] = $this->request->post['confirm'];
        } else {
            $data['confirm'] = '';
        }
        
        $this->theme->model('localization/country');
        
        $data['countries'] = $this->model_localization_country->getCountries(array('filter_status' => 1));
        
        if (isset($this->request->post['address'])) {
            $data['addresses'] = $this->request->post['address'];
        } elseif (isset($this->request->get['customer_id'])) {
            $data['addresses'] = $this->model_people_customer->getAddresses($this->request->get['customer_id']);
        } else {
            $data['addresses'] = array();
        }
        
        if (isset($this->request->post['address_id'])) {
            $data['address_id'] = $this->request->post['address_id'];
        } elseif (!empty($customer_info)) {
            $data['address_id'] = $customer_info['address_id'];
        } else {
            $data['address_id'] = '';
        }
        
        $data['ips'] = array();
        
        if (!empty($customer_info)) {
            $results = $this->model_people_customer->getIpsByCustomerId($this->request->get['customer_id']);
            
            foreach ($results as $result) {
                $ban_ip_total = $this->model_people_customer->getTotalBanIpsByIp($result['ip']);
                
                $data['ips'][] = array('ip' => $result['ip'], 'total' => $this->model_people_customer->getTotalCustomersByIp($result['ip']), 'date_added' => date('d/m/y', strtotime($result['date_added'])), 'filter_ip' => $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&filter_ip=' . $result['ip'], 'SSL'), 'ban_ip' => $ban_ip_total);
            }
        }
        
        $this->theme->loadjs('javascript/people/customer_form', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('people/customer_form', $data));
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'people/customer')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (($this->encode->strlen($this->request->post['username']) < 3) || ($this->encode->strlen($this->request->post['username']) > 16)) {
            $this->error['username'] = $this->language->get('error_username');
        }
        
        if (($this->encode->strlen($this->request->post['firstname']) < 1) || ($this->encode->strlen($this->request->post['firstname']) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }
        
        if (($this->encode->strlen($this->request->post['lastname']) < 1) || ($this->encode->strlen($this->request->post['lastname']) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }
        
        if (($this->encode->strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }
        
        $customer_info = $this->model_people_customer->getCustomerByEmail($this->request->post['username'], $this->request->post['email']);
        
        if (!isset($this->request->get['customer_id'])) {
            if ($customer_info) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        } else {
            if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        }
        
        if (($this->encode->strlen($this->request->post['telephone']) < 3) || ($this->encode->strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('error_telephone');
        }
        
        if ($this->request->post['password'] || (!isset($this->request->get['customer_id']))) {
            if (($this->encode->strlen($this->request->post['password']) < 4) || ($this->encode->strlen($this->request->post['password']) > 20)) {
                $this->error['password'] = $this->language->get('error_password');
            }
            
            if ($this->request->post['password'] != $this->request->post['confirm']) {
                $this->error['confirm'] = $this->language->get('error_confirm');
            }
        }
        
        $address_required = false;
        
        if (isset($this->request->post['address']) && $address_required) {
            foreach ($this->request->post['address'] as $key => $value) {
                if (($this->encode->strlen($value['firstname']) < 1) || ($this->encode->strlen($value['firstname']) > 32)) {
                    $this->error['address_firstname'][$key] = $this->language->get('error_firstname');
                }
                
                if (($this->encode->strlen($value['lastname']) < 1) || ($this->encode->strlen($value['lastname']) > 32)) {
                    $this->error['address_lastname'][$key] = $this->language->get('error_lastname');
                }
                
                if (($this->encode->strlen($value['address_1']) < 3) || ($this->encode->strlen($value['address_1']) > 128)) {
                    $this->error['address_address_1'][$key] = $this->language->get('error_address_1');
                }
                
                if (($this->encode->strlen($value['city']) < 2) || ($this->encode->strlen($value['city']) > 128)) {
                    $this->error['address_city'][$key] = $this->language->get('error_city');
                }
                
                $this->theme->model('localization/country');
                
                $country_info = $this->model_localization_country->getCountry($value['country_id']);
                
                if ($country_info) {
                    if ($country_info['postcode_required'] && ($this->encode->strlen($value['postcode']) < 2) || ($this->encode->strlen($value['postcode']) > 10)) {
                        $this->error['address_postcode'][$key] = $this->language->get('error_postcode');
                    }
                    
                    if ($this->config->get('config_vat') && $value['tax_id'] && ($this->vat->validate($country_info['iso_code_2'], $value['tax_id']) == 'invalid')) {
                        $this->error['address_tax_id'][$key] = $this->language->get('error_vat');
                    }
                }
                
                if ($value['country_id'] == '') {
                    $this->error['address_country'][$key] = $this->language->get('error_country');
                }
                
                if (!isset($value['zone_id']) || $value['zone_id'] == '') {
                    $this->error['address_zone'][$key] = $this->language->get('error_zone');
                }
            }
        }
        
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'people/customer')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    public function login() {
        $json = array();
        
        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }
        
        $this->theme->model('people/customer');
        
        $customer_info = $this->model_people_customer->getCustomer($customer_id);
        
        if ($customer_info) {
            $token = md5(mt_rand());
            
            $this->model_people_customer->editToken($customer_id, $token);
            
            if (isset($this->request->get['store_id'])) {
                $store_id = $this->request->get['store_id'];
            } else {
                $store_id = 0;
            }
            
            $this->theme->model('setting/store');
            
            $store_info = $this->model_setting_store->getStore($store_id);
            
            if ($store_info) {
                $json['redirect'] = $store_info['url'] . 'account/login&token=' . $token;
            } else {
                $json['redirect'] = $this->app['http.public'] . 'account/login&token=' . $token;
            }
            
            $this->response->setOutput(json_encode($json));
        } else {
            $data = $this->theme->language('error/not_found');
            
            $this->theme->setTitle($this->language->get('heading_title'));
            
            $this->breadcrumb->add('heading_title', 'error/notfound');
            
            $data = $this->theme->render_controllers($data);
            
            $this->response->setOutput($this->theme->view('error/not_found', $data));
        }
    }
    
    public function history() {
        $data = $this->theme->language('people/customer');
        
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'people/customer')) {
            $this->model_people_customer->addHistory($this->request->get['customer_id'], $this->request->post['comment']);
            
            $data['success'] = $this->language->get('text_success');
        } else {
            $data['success'] = '';
        }
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'people/customer')) {
            $data['error_warning'] = $this->language->get('error_permission');
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $data['histories'] = array();
        
        $results = $this->model_people_customer->getHistories($this->request->get['customer_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result) {
            $data['histories'][] = array('comment' => $result['comment'], 'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])));
        }
        
        $transaction_total = $this->model_people_customer->getTotalHistories($this->request->get['customer_id']);
        
        $data['pagination'] = $this->theme->paginate($transaction_total, $page, 10, $this->language->get('text_pagination'), $this->url->link('people/customer/history', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL'));
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->response->setOutput($this->theme->view('people/customer_history', $data));
    }
    
    public function transaction() {
        $data = $this->theme->language('people/customer');
        
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'people/customer')) {
            $this->model_people_customer->addTransaction($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['amount']);
            
            $data['success'] = $this->language->get('text_success');
        } else {
            $data['success'] = '';
        }
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'people/customer')) {
            $data['error_warning'] = $this->language->get('error_permission');
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $data['transactions'] = array();
        
        $results = $this->model_people_customer->getTransactions($this->request->get['customer_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result) {
            $data['transactions'][] = array('amount' => $this->currency->format($result['amount'], $this->config->get('config_currency')), 'description' => $result['description'], 'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])));
        }
        
        $data['balance'] = $this->currency->format($this->model_people_customer->getTransactionTotal($this->request->get['customer_id']), $this->config->get('config_currency'));
        
        $transaction_total = $this->model_people_customer->getTotalTransactions($this->request->get['customer_id']);
        
        $data['pagination'] = $this->theme->paginate($transaction_total, $page, 10, $this->language->get('text_pagination'), $this->url->link('people/customer/transaction', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL'));
        
        $this->theme->loadjs('javascript/people/customer_transaction', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        $this->response->setOutput($this->theme->view('people/customer_transaction', $data));
    }
    
    public function reward() {
        $data = $this->theme->language('people/customer');
        
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'people/customer')) {
            $this->model_people_customer->addReward($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['points']);
            
            $data['success'] = $this->language->get('text_success');
        } else {
            $data['success'] = '';
        }
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'people/customer')) {
            $data['error_warning'] = $this->language->get('error_permission');
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $data['rewards'] = array();
        
        $results = $this->model_people_customer->getRewards($this->request->get['customer_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result) {
            $data['rewards'][] = array('points' => $result['points'], 'description' => $result['description'], 'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])));
        }
        
        $data['balance'] = $this->model_people_customer->getRewardTotal($this->request->get['customer_id']);
        
        $reward_total = $this->model_people_customer->getTotalRewards($this->request->get['customer_id']);
        
        $data['pagination'] = $this->theme->paginate($reward_total, $page, 10, $this->language->get('text_pagination'), $this->url->link('people/customer/reward', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL'));
        
        $this->theme->loadjs('javascript/people/customer_reward', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        $this->response->setOutput($this->theme->view('people/customer_reward', $data));
    }
    
    public function addBanIP() {
        $this->language->load('people/customer');
        
        $json = array();
        
        if (isset($this->request->post['ip'])) {
            if (!$this->user->hasPermission('modify', 'people/customer')) {
                $json['error'] = $this->language->get('error_permission');
            } else {
                $this->theme->model('people/customer');
                
                $this->model_people_customer->addBanIP($this->request->post['ip']);
                
                $json['success'] = $this->language->get('text_success');
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function removeBanIP() {
        $this->language->load('people/customer');
        
        $json = array();
        
        if (isset($this->request->post['ip'])) {
            if (!$this->user->hasPermission('modify', 'people/customer')) {
                $json['error'] = $this->language->get('error_permission');
            } else {
                $this->theme->model('people/customer');
                
                $this->model_people_customer->removeBanIP($this->request->post['ip']);
                
                $json['success'] = $this->language->get('text_success');
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function autocomplete() {
        $json = array();
        
        if (isset($this->request->get['filter_username']) || isset($this->request->get['filter_name']) || isset($this->request->get['filter_email'])) {
            $this->theme->model('people/customer');
            
            $filter_username = (isset($this->request->get['filter_username'])) ? $this->request->get['filter_username'] : null;
            $filter_name = (isset($this->request->get['filter_name'])) ? $this->request->get['filter_name'] : null;
            $filter_email = (isset($this->request->get['filter_email'])) ? $this->request->get['filter_email'] : null;
            
            $filter = array('filter_username' => $filter_username, 'filter_name' => $filter_name, 'filter_email' => $filter_email, 'start' => 0, 'limit' => 20);
            
            $results = $this->model_people_customer->getCustomers($filter);
            
            foreach ($results as $result) {
                $json[] = array('customer_id' => $result['customer_id'], 'customer_group_id' => $result['customer_group_id'], 'username' => $result['username'], 'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 'customer_group' => $result['customer_group'], 'firstname' => $result['firstname'], 'lastname' => $result['lastname'], 'email' => $result['email'], 'telephone' => $result['telephone'], 'address' => $this->model_people_customer->getAddresses($result['customer_id']));
            }
        }
        
        $sort_order = array();
        
        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }
        
        array_multisort($sort_order, SORT_ASC, $json);
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function country() {
        $json = array();
        
        $this->theme->model('localization/country');
        
        $country_info = $this->model_localization_country->getCountry($this->request->get['country_id']);
        
        if ($country_info) {
            $this->theme->model('localization/zone');
            
            $json = array('country_id' => $country_info['country_id'], 'name' => $country_info['name'], 'iso_code_2' => $country_info['iso_code_2'], 'iso_code_3' => $country_info['iso_code_3'], 'address_format' => $country_info['address_format'], 'postcode_required' => $country_info['postcode_required'], 'zone' => $this->model_localization_zone->getZonesByCountryId($this->request->get['country_id']), 'status' => $country_info['status']);
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function address() {
        $json = array();
        
        if (!empty($this->request->get['address_id'])) {
            $this->theme->model('people/customer');
            
            $json = $this->model_people_customer->getAddress($this->request->get['address_id']);
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
}
