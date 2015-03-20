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
    
    private $error   = array();
    
    private $filters = array(
        'filter_username',
        'filter_name',
        'filter_email',
        'filter_customer_group_id',
        'filter_status',
        'filter_affiliate',
        'sort',
        'order',
        'page'
    );
    
    private $post_errors = array(
        'warning',
        'username',
        'firstname',
        'lastname',
        'email',
        'telephone',
        'password',
        'confirm',
        'address_firstname',
        'address_lastname',
        'address_tax_id',
        'address_address_1',
        'address_city',
        'address_postcode',
        'address_country',
        'address_zone',
        'code',
        'commission',
        'tax_id',
        'payment',
        'cheque',
        'paypal',
        'bank_name',
        'account_name',
        'account_number'
    );
    
    public function index() {
        $this->language->load('people/customer');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('people/customer');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function insert() {
        $this->language->load('people/customer');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()):
            $this->model_people_customer->addCustomer($this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $url = $this->filter->uri($this->filters);
            
            $this->response->redirect($this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        endif;
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function update() {
        $this->language->load('people/customer');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()):
            $this->model_people_customer->editCustomer($this->request->get['customer_id'], $this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $url = $this->filter->uri($this->filters);
            
            $this->response->redirect($this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        endif;
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function delete() {
        $this->language->load('people/customer');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('people/customer');
        
        if (isset($this->request->post['selected']) && $this->validateDelete()):
            foreach ($this->request->post['selected'] as $customer_id):
                $this->model_people_customer->deleteCustomer($customer_id);
            endforeach;
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $url = $this->filter->uri($this->filters);
            
            $this->response->redirect($this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        endif;
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function approve() {
        $this->language->load('people/customer');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('people/customer');
        
        if (!$this->user->hasPermission('modify', 'people/customer')):
            $this->error['warning'] = $this->language->get('lang_error_permission');
        elseif (isset($this->request->post['selected'])):
            $approved = 0;
            
            foreach ($this->request->post['selected'] as $customer_id):
                $customer_info = $this->model_people_customer->getCustomer($customer_id);
                
                if ($customer_info && !$customer_info['approved']):
                    $this->model_people_customer->approve($customer_id);
                    $approved++;
                endif;
            endforeach;
            
            $this->session->data['success'] = sprintf($this->language->get('lang_text_approved'), $approved);
            
            $url = $this->filter->uri($this->filters);
            
            $this->response->redirect($this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        endif;
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    protected function getList() {
        $data = $this->theme->language('people/customer');
        
        $url = $this->filter->uri($this->filters);

        $this->breadcrumb->add('lang_heading_title', 'people/customer', $url);
        
        $data['approve'] = $this->url->link('people/customer/approve', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['insert']  = $this->url->link('people/customer/insert',  'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete']  = $this->url->link('people/customer/delete',  'token=' . $this->session->data['token'] . $url, 'SSL');
        
        $filter_default = array(
            'sort'  => 'username',
            'order' => 'ASC',
            'page'  => 1
        );

        $filter = $this->filter->map($this->filters, $filter_default);

        $page = $filter['page'];
        
        $filter['start'] = ($page - 1) * $this->config->get('config_admin_limit');
        $filter['limit'] = $this->config->get('config_admin_limit');
        
        $db_filter = $filter;
        unset ($db_filter['page']);

        $customer_total  = $this->model_people_customer->getTotalCustomers($db_filter);
        $results         = $this->model_people_customer->getCustomers($db_filter);

        $data['customers'] = array();
        
        foreach ($results as $result):
            $action = array();
            
            $action[] = array(
                'text' => $this->language->get('lang_text_edit'), 
                'href' => $this->url->link('people/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, 'SSL')
            );
            
            $data['customers'][] = array(
                'customer_id'    => $result['customer_id'], 
                'username'       => $result['username'], 
                'name'           => $result['name'], 
                'email'          => $result['email'], 
                'customer_group' => $result['customer_group'], 
                'status'         => ($result['status'] ? $this->language->get('lang_text_enabled') : $this->language->get('lang_text_disabled')), 
                'approved'       => ($result['approved'] ? $this->language->get('lang_text_yes') : $this->language->get('lang_text_no')), 
                'ip'             => $result['ip'], 
                'date_added'     => date($this->language->get('lang_date_format_short'), strtotime($result['date_added'])), 
                'selected'       => isset($this->request->post['selected']) && in_array($result['customer_id'], $this->request->post['selected']), 
                'action'         => $action
            );
        endforeach;
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->error['warning'])):
            $data['error_warning'] = $this->error['warning'];
        else:
            $data['error_warning'] = '';
        endif;
        
        if (isset($this->session->data['success'])):
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        else:
            $data['success'] = '';
        endif;

        $sort = $this->filter->unsort($this->filters);
        $url  = $this->filter->uri($sort);
        
        if ($filter['order'] == 'ASC'):
            $url .= '&order=DESC';
        else:
            $url .= '&order=ASC'; 
        endif;
        
        $data['sort_username']       = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=username' . $url, 'SSL');
        $data['sort_name']           = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
        $data['sort_email']          = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=c.email' . $url, 'SSL');
        $data['sort_customer_group'] = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=customer_group' . $url, 'SSL');
        $data['sort_status']         = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, 'SSL');
        
        $paging = $this->filter->unpage($this->filters);
        $url    = $this->filter->uri($paging);
        
        $data['pagination'] = $this->theme->paginate(
            $customer_total, 
            $page, 
            $this->config->get('config_admin_limit'), 
            $this->language->get('lang_text_pagination'), 
            $this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL')
        );
        
        $data['filter_username']          = $filter['filter_username'];
        $data['filter_name']              = $filter['filter_name'];
        $data['filter_email']             = $filter['filter_email'];
        $data['filter_customer_group_id'] = $filter['filter_customer_group_id'];
        $data['filter_status']            = $filter['filter_status'];
        
        $this->theme->model('people/customergroup');
        
        $data['customer_groups'] = $this->model_people_customergroup->getCustomerGroups();
        
        $this->theme->model('setting/store');
        
        $data['stores'] = $this->model_setting_store->getStores();
        
        $data['sort']   = $filter['sort'];
        $data['order']  = $filter['order'];
        
        $this->theme->loadjs('javascript/people/customer_list', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('people/customer_list', $data));
    }
    
    protected function getForm() {
        $data = $this->theme->language('people/customer');
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->request->get['customer_id'])):
            $data['customer_id'] = $this->request->get['customer_id'];
        else:
            $data['customer_id'] = 0;
        endif;

        foreach ($this->post_errors as $error):
            if (isset($this->error[$error])):
                $data['error_' . $error] = $this->error[$error];
            else:
                $data['error_' . $error] = '';
            endif;
        endforeach;
        
        $url = $this->filter->uri($this->filters);
        
        $this->breadcrumb->add('lang_heading_title', 'people/customer', $url);
        
        if (!isset($this->request->get['customer_id'])):
            $data['action'] = $this->url->link('people/customer/insert', 'token=' . $data['token'] . $url, 'SSL');
        else:
            $data['action'] = $this->url->link('people/customer/update', 'token=' . $data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $url, 'SSL');
        endif;
        
        $data['cancel'] = $this->url->link('people/customer', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')):
            $customer_info = $this->model_people_customer->getCustomer($this->request->get['customer_id']);
        endif;

        $defaults = array(
            'username'          => '',
            'firstname'         => '',
            'lastname'          => '',
            'email'             => '',
            'telephone'         => '',
            'newsletter'        => '',
            'customer_group_id' => $this->config->get('config_customer_group_id'),
            'is_affiliate'      => false,
            'status'            => 1,
            'address_id'        => ''
        );
        
        foreach ($defaults as $key => $value):
            if (isset($this->request->post[$key])):
                $data[$key] = $this->request->post[$key];
            elseif (!empty($customer_info)):
                $data[$key] = $customer_info[$key];
            else:
                $data[$key] = $value;
            endif;
        endforeach;
        
        $this->theme->model('people/customergroup');
        $data['customer_groups'] = $this->model_people_customergroup->getCustomerGroups();

        if (isset($this->request->post['affiliate'])):
            $data['affiliate'] = $this->request->post['affiliate'];
        elseif (!empty($customer_info)):
            $data['affiliate'] = $this->model_people_customer->getAffiliateDetails($this->request->get['customer_id']);
        else:
            $data['affiliate'] = array();
        endif;

        if (isset($this->request->post['password'])):
            $data['password'] = $this->request->post['password'];
        else:
            $data['password'] = '';
        endif;
        
        if (isset($this->request->post['confirm'])):
            $data['confirm'] = $this->request->post['confirm'];
        else:
            $data['confirm'] = '';
        endif;
        
        $this->theme->model('localization/country');
        
        $data['countries'] = $this->model_localization_country->getCountries(array('filter_status' => 1));
        
        if (isset($this->request->post['address'])):
            $data['addresses'] = $this->request->post['address'];
        elseif (!empty($customer_info)):
            $data['addresses'] = $this->model_people_customer->getAddresses($this->request->get['customer_id']);
        else:
            $data['addresses'] = array();
        endif;
        
        $data['ips'] = array();
        
        if (!empty($customer_info)):
            $results = $this->model_people_customer->getIpsByCustomerId($this->request->get['customer_id']);
            
            foreach ($results as $result):
                $ban_ip_total = $this->model_people_customer->getTotalBanIpsByIp($result['ip']);
                
                $data['ips'][] = array(
                    'ip'         => $result['ip'], 
                    'total'      => $this->model_people_customer->getTotalCustomersByIp($result['ip']), 
                    'date_added' => date($this->language->get('lang_date_format_short'), strtotime($result['date_added'])), 
                    'filter_ip'  => $this->url->link('people/customer', 'token=' . $this->session->data['token'] . '&filter_ip=' . $result['ip'], 'SSL'), 
                    'ban_ip'     => $ban_ip_total
                );
            endforeach;
        endif;
        
        $this->theme->loadjs('javascript/people/customer_form', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('people/customer_form', $data));
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'people/customer')):
            $this->error['warning'] = $this->language->get('lang_error_permission');
        endif;
        
        if (($this->encode->strlen($this->request->post['username']) < 3) || ($this->encode->strlen($this->request->post['username']) > 16)):
            $this->error['username'] = $this->language->get('lang_error_username');
        endif;
        
        if (($this->encode->strlen($this->request->post['firstname']) < 1) || ($this->encode->strlen($this->request->post['firstname']) > 32)):
            $this->error['firstname'] = $this->language->get('lang_error_firstname');
        endif;
        
        if (($this->encode->strlen($this->request->post['lastname']) < 1) || ($this->encode->strlen($this->request->post['lastname']) > 32)):
            $this->error['lastname'] = $this->language->get('lang_error_lastname');
        endif;
        
        if (($this->encode->strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])):
            $this->error['email'] = $this->language->get('lang_error_email');
        endif;
        
        $customer_info = $this->model_people_customer->getCustomerByEmail($this->request->post['username'], $this->request->post['email']);
        
        if (!isset($this->request->get['customer_id'])):
            if ($customer_info):
                $this->error['warning'] = $this->language->get('lang_error_exists');
            endif;
        else:
            if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])):
                $this->error['warning'] = $this->language->get('lang_error_exists');
            endif;
        endif;
        
        if (($this->encode->strlen($this->request->post['telephone']) < 3) || ($this->encode->strlen($this->request->post['telephone']) > 32)):
            $this->error['telephone'] = $this->language->get('lang_error_telephone');
        endif;
        
        if ($this->request->post['password'] || (!isset($this->request->get['customer_id']))):
            if (($this->encode->strlen($this->request->post['password']) < 4) || ($this->encode->strlen($this->request->post['password']) > 20)):
                $this->error['password'] = $this->language->get('lang_error_password');
            endif;
            
            if ($this->request->post['password'] != $this->request->post['confirm']):
                $this->error['confirm'] = $this->language->get('lang_error_confirm');
            endif;
        endif;
        
        $address_required = false;
        
        if (isset($this->request->post['address']) && $address_required):
            foreach ($this->request->post['address'] as $key => $value):
                if (($this->encode->strlen($value['firstname']) < 1) || ($this->encode->strlen($value['firstname']) > 32)):
                    $this->error['address_firstname'][$key] = $this->language->get('lang_error_firstname');
                endif;
                
                if (($this->encode->strlen($value['lastname']) < 1) || ($this->encode->strlen($value['lastname']) > 32)):
                    $this->error['address_lastname'][$key] = $this->language->get('lang_error_lastname');
                endif;
                
                if (($this->encode->strlen($value['address_1']) < 3) || ($this->encode->strlen($value['address_1']) > 128)):
                    $this->error['address_address_1'][$key] = $this->language->get('lang_error_address_1');
                endif;
                
                if (($this->encode->strlen($value['city']) < 2) || ($this->encode->strlen($value['city']) > 128)):
                    $this->error['address_city'][$key] = $this->language->get('lang_error_city');
                endif;
                
                $this->theme->model('localization/country');
                
                $country_info = $this->model_localization_country->getCountry($value['country_id']);
                
                if ($country_info):
                    if ($country_info['postcode_required'] && ($this->encode->strlen($value['postcode']) < 2) || ($this->encode->strlen($value['postcode']) > 10)):
                        $this->error['address_postcode'][$key] = $this->language->get('lang_error_postcode');
                    endif;
                    
                    if ($this->config->get('config_vat') && $value['tax_id'] && ($this->vat->validate($country_info['iso_code_2'], $value['tax_id']) == 'invalid')):
                        $this->error['address_tax_id'][$key] = $this->language->get('lang_error_vat');
                    endif;
                endif;
                
                if ($value['country_id'] == ''):
                    $this->error['address_country'][$key] = $this->language->get('lang_error_country');
                endif;
                
                if (!isset($value['zone_id']) || $value['zone_id'] == ''):
                    $this->error['address_zone'][$key] = $this->language->get('lang_error_zone');
                endif;
            endforeach;
        endif;

        // check affiliate goodies
        if (isset($this->request->post['affiliate'])):
            // check all our parameters for validity
            if ($this->encode->strlen($this->request->post['affiliate']['code']) < 1):
                $this->error['code'] = $this->language->get('lang_error_code');
            endif;
            
            if ($this->encode->strlen($this->request->post['affiliate']['commission']) < 1):
                $this->error['commission'] = $this->language->get('lang_error_commission');
            endif;

            if ($this->encode->strlen($this->request->post['affiliate']['tax_id']) < 1):
                $this->error['tax_id'] = $this->language->get('lang_error_tax_id');
            endif;

            if (!$this->request->post['affiliate']['payment_method']):
                $this->error['payment'] = $this->language->get('lang_error_payment');
            else:
                if ($this->request->post['affiliate']['payment_method'] == 'cheque' && $this->encode->strlen($this->request->post['affiliate']['cheque']) < 1):
                    $this->error['cheque'] = $this->language->get('lang_error_cheque');
                endif;

                if ($this->request->post['affiliate']['payment_method'] == 'paypal' && $this->encode->strlen($this->request->post['affiliate']['paypal']) < 1):
                    $this->error['paypal'] = $this->language->get('lang_error_paypal');
                endif;

                if ($this->request->post['affiliate']['payment_method'] == 'bank' && $this->encode->strlen($this->request->post['affiliate']['bank_name']) < 1):
                    $this->error['bank_name'] = $this->language->get('lang_error_bank_name');
                endif;

                if ($this->request->post['affiliate']['payment_method'] == 'bank' && $this->encode->strlen($this->request->post['affiliate']['bank_account_name']) < 1):
                    $this->error['account_name'] = $this->language->get('lang_error_account_name');
                endif;

                if ($this->request->post['affiliate']['payment_method'] == 'bank' && $this->encode->strlen($this->request->post['affiliate']['bank_account_number']) < 1):
                    $this->error['account_number'] = $this->language->get('lang_error_account_number');
                endif;
            endif;
        endif;
        
        if ($this->error && !isset($this->error['warning'])):
            $this->error['warning'] = $this->language->get('lang_error_warning');
        endif;
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'people/customer')):
            $this->error['warning'] = $this->language->get('lang_error_permission');
        endif;
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    public function login() {
        $json = array();
        
        if (isset($this->request->get['customer_id'])):
            $customer_id = $this->request->get['customer_id'];
        else:
            $customer_id = 0;
        endif;
        
        $this->theme->model('people/customer');
        
        $customer_info = $this->model_people_customer->getCustomer($customer_id);
        
        if ($customer_info):
            $token = md5(mt_rand());
            
            $this->model_people_customer->editToken($customer_id, $token);
            
            if (isset($this->request->get['store_id'])):
                $store_id = $this->request->get['store_id'];
            else:
                $store_id = 0;
            endif;
            
            $this->theme->model('setting/store');
            
            $store_info = $this->model_setting_store->getStore($store_id);
            
            if ($store_info):
                $json['redirect'] = $store_info['url'] . 'account/login&token=' . $token;
            else:
                $json['redirect'] = $this->app['http.public'] . 'account/login&token=' . $token;
            endif;
            
            $this->response->setOutput(json_encode($json));
        else:
            $data = $this->theme->language('error/not_found');
            $this->theme->setTitle($this->language->get('lang_heading_title'));
            $this->breadcrumb->add('lang_heading_title', 'error/notfound');
            $data = $this->theme->render_controllers($data);
            $this->response->setOutput($this->theme->view('error/not_found', $data));
        endif;
    }
    
    public function history() {
        $data = $this->theme->language('people/customer');
        
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'people/customer')):
            $this->model_people_customer->addHistory($this->request->get['customer_id'], $this->request->post['comment']);
            $data['success'] = $this->language->get('lang_text_success');
        else:
            $data['success'] = '';
        endif;
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'people/customer')):
            $data['error_warning'] = $this->language->get('lang_error_permission');
        else:
            $data['error_warning'] = '';
        endif;
        
        if (isset($this->request->get['page'])):
            $page = $this->request->get['page'];
        else:
            $page = 1;
        endif;
        
        $data['histories'] = array();
        
        $results = $this->model_people_customer->getHistories($this->request->get['customer_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result):
            $data['histories'][] = array(
                'comment'    => $result['comment'], 
                'date_added' => date($this->language->get('lang_date_format_short'), strtotime($result['date_added']))
            );
        endforeach;
        
        $history_total = $this->model_people_customer->getTotalHistories($this->request->get['customer_id']);
        
        $data['pagination'] = $this->theme->paginate(
            $history_total, 
            $page, 
            10, 
            $this->language->get('lang_text_pagination'), 
            $this->url->link('people/customer/history', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL')
        );
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->response->setOutput($this->theme->view('people/customer_history', $data));
    }
    
    public function credit() {
        $data = $this->theme->language('people/customer');
        
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'people/customer')):
            $this->model_people_customer->addCredit($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['amount']);
            $data['success'] = $this->language->get('lang_text_credit_success');
        else:
            $data['success'] = '';
        endif;
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'people/customer')):
            $data['error_warning'] = $this->language->get('lang_error_permission');
        else:
            $data['error_warning'] = '';
        endif;
        
        if (isset($this->request->get['page'])):
            $page = $this->request->get['page'];
        else:
            $page = 1;
        endif;
        
        $data['credits'] = array();
        
        $results = $this->model_people_customer->getCredits($this->request->get['customer_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result):
            $data['credits'][] = array(
                'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')), 
                'description' => $result['description'], 
                'date_added'  => date($this->language->get('lang_date_format_short'), strtotime($result['date_added']))
            );
        endforeach;
        
        $data['balance'] = $this->currency->format($this->model_people_customer->getCreditTotal($this->request->get['customer_id']), $this->config->get('config_currency'));
        
        $credit_total = $this->model_people_customer->getTotalCredits($this->request->get['customer_id']);
        
        $data['pagination'] = $this->theme->paginate(
            $credit_total, 
            $page, 
            10, 
            $this->language->get('lang_text_pagination'), 
            $this->url->link('people/customer/credit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL')
        );
        
        $this->theme->loadjs('javascript/people/customer_alert', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        $this->response->setOutput($this->theme->view('people/customer_credit', $data));
    }

    public function commission() {
        $data = $this->theme->language('people/customer');
        
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'people/customer')):
            $this->model_people_customer->addCommission($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['amount']);
            $data['success'] = $this->language->get('lang_text_commission_success');
        else:
            $data['success'] = '';
        endif;
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'people/customer')):
            $data['error_warning'] = $this->language->get('lang_error_permission');
        else:
            $data['error_warning'] = '';
        endif;
        
        if (isset($this->request->get['page'])):
            $page = $this->request->get['page'];
        else:
            $page = 1;
        endif;
        
        $data['commissions'] = array();
        
        $results = $this->model_people_customer->getCommissions($this->request->get['customer_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result):
            $data['commissions'][] = array(
                'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')), 
                'description' => $result['description'], 
                'date_added'  => date($this->language->get('lang_date_format_short'), strtotime($result['date_added']))
            );
        endforeach;
        
        $data['balance'] = $this->currency->format($this->model_people_customer->getCommissionTotal($this->request->get['customer_id']), $this->config->get('config_currency'));
        
        $commission_total = $this->model_people_customer->getTotalCommissions($this->request->get['customer_id']);
        
        $data['pagination'] = $this->theme->paginate(
            $commission_total, 
            $page, 
            $this->config->get('config_admin_limit'), 
            $this->language->get('lang_text_pagination'), 
            $this->url->link('people/customer/commission', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL')
        );
        
        $this->theme->loadjs('javascript/people/customer_alert', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        $this->response->setOutput($this->theme->view('people/customer_commission', $data));
    }
    
    public function reward() {
        $data = $this->theme->language('people/customer');
        
        $this->theme->model('people/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'people/customer')):
            $this->model_people_customer->addReward($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['points']);
            $data['success'] = $this->language->get('lang_text_reward_success');
        else:
            $data['success'] = '';
        endif;
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'people/customer')):
            $data['error_warning'] = $this->language->get('lang_error_permission');
        else:
            $data['error_warning'] = '';
        endif;
        
        if (isset($this->request->get['page'])):
            $page = $this->request->get['page'];
        else:
            $page = 1;
        endif;
        
        $data['rewards'] = array();
        
        $results = $this->model_people_customer->getRewards($this->request->get['customer_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result):
            $data['rewards'][] = array(
                'points'      => $result['points'], 
                'description' => $result['description'], 
                'date_added'  => date($this->language->get('lang_date_format_short'), strtotime($result['date_added']))
            );
        endforeach;
        
        $data['balance'] = $this->model_people_customer->getRewardTotal($this->request->get['customer_id']);
        
        $reward_total = $this->model_people_customer->getTotalRewards($this->request->get['customer_id']);
        
        $data['pagination'] = $this->theme->paginate(
            $reward_total, 
            $page, 
            10, 
            $this->language->get('lang_text_pagination'), 
            $this->url->link('people/customer/reward', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL')
        );
        
        $this->theme->loadjs('javascript/people/customer_alert', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        $this->response->setOutput($this->theme->view('people/customer_reward', $data));
    }
    
    public function addBanIP() {
        $this->language->load('people/customer');
        
        $json = array();
        
        if (isset($this->request->post['ip'])):
            if (!$this->user->hasPermission('modify', 'people/customer')):
                $json['error'] = $this->language->get('lang_error_permission');
            else:
                $this->theme->model('people/customer');
                
                $this->model_people_customer->addBanIP($this->request->post['ip']);
                
                $json['success'] = $this->language->get('lang_text_success');
            endif;
        endif;
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function removeBanIP() {
        $this->language->load('people/customer');
        
        $json = array();
        
        if (isset($this->request->post['ip'])):
            if (!$this->user->hasPermission('modify', 'people/customer')):
                $json['error'] = $this->language->get('lang_error_permission');
            else:
                $this->theme->model('people/customer');
                
                $this->model_people_customer->removeBanIP($this->request->post['ip']);
                
                $json['success'] = $this->language->get('lang_text_success');
            endif;
        endif;
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function autocomplete() {
        $json = array();
        
        if (isset($this->request->get['filter_username']) || isset($this->request->get['filter_name']) || isset($this->request->get['filter_email'])):
            $this->theme->model('people/customer');
            
            $filter_username = (isset($this->request->get['filter_username'])) ? $this->request->get['filter_username'] : null;
            $filter_name     = (isset($this->request->get['filter_name'])) ? $this->request->get['filter_name'] : null;
            $filter_email    = (isset($this->request->get['filter_email'])) ? $this->request->get['filter_email'] : null;
            
            $filter = array(
                'filter_username' => $filter_username, 
                'filter_name'     => $filter_name, 
                'filter_email'    => $filter_email, 
                'start'           => 0, 
                'limit'           => 20
            );
            
            $results = $this->model_people_customer->getCustomers($filter);
            
            foreach ($results as $result):
                $json[] = array(
                    'customer_id'       => $result['customer_id'], 
                    'customer_group_id' => $result['customer_group_id'], 
                    'username'          => $result['username'], 
                    'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 
                    'customer_group'    => $result['customer_group'], 
                    'firstname'         => $result['firstname'], 
                    'lastname'          => $result['lastname'], 
                    'email'             => $result['email'], 
                    'telephone'         => $result['telephone'], 
                    'address'           => $this->model_people_customer->getAddresses($result['customer_id'])
                );
            endforeach;
        endif;
        
        $sort_order = array();
        
        foreach ($json as $key => $value):
            $sort_order[$key] = $value['name'];
        endforeach;
        
        array_multisort($sort_order, SORT_ASC, $json);
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function country() {
        $json = array();
        
        $this->theme->model('localization/country');
        
        $country_info = $this->model_localization_country->getCountry($this->request->get['country_id']);
        
        if ($country_info):
            $this->theme->model('localization/zone');
            
            $json = array(
                'country_id'        => $country_info['country_id'], 
                'name'              => $country_info['name'], 
                'iso_code_2'        => $country_info['iso_code_2'], 
                'iso_code_3'        => $country_info['iso_code_3'], 
                'address_format'    => $country_info['address_format'], 
                'postcode_required' => $country_info['postcode_required'], 
                'zone'              => $this->model_localization_zone->getZonesByCountryId($this->request->get['country_id']), 
                'status'            => $country_info['status']
            );
        endif;
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function address() {
        $json = array();
        
        if (!empty($this->request->get['address_id'])):
            $this->theme->model('people/customer');
            $json = $this->model_people_customer->getAddress($this->request->get['address_id']);
        endif;
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
}
