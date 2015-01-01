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


namespace Front\Controller\Account;
use Oculus\Engine\Controller;

class Register extends Controller {
    private $error = array();
    
    public function index() {
        if ($this->customer->isLogged()) {
            $this->response->redirect($this->url->link('account/dashboard', '', 'SSL'));
        }
        
        $data = $this->theme->language('account/register');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('account/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_account_customer->addCustomer($this->request->post);
            
            $this->customer->login($this->request->post['email'], $this->request->post['password']);
            
            unset($this->session->data['guest']);
            
            $this->response->redirect($this->url->link('account/success'));
        }
        
        $this->breadcrumb->add('text_register', 'account/register', null, true, 'SSL');
        
        $data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', 'SSL'));
        
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
        
        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
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
        
        $data['action'] = $this->url->link('account/register', '', 'SSL');
        
        if (isset($this->request->post['username'])) {
            $data['username'] = $this->request->post['username'];
        } else {
            $data['username'] = '';
        }
        
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } else {
            $data['email'] = '';
        }
        
        $this->theme->model('account/customergroup');
        
        $data['customer_groups'] = array();
        
        if (is_array($this->config->get('config_customer_group_display'))) {
            $customer_groups = $this->model_account_customergroup->getCustomerGroups();
            
            foreach ($customer_groups as $customer_group) {
                if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
                    $data['customer_groups'][] = $customer_group;
                }
            }
        }
        
        if (isset($this->request->post['customer_group_id'])) {
            $data['customer_group_id'] = $this->request->post['customer_group_id'];
        } else {
            $data['customer_group_id'] = $this->config->get('config_customer_group_id');
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
        
        if ($this->config->get('config_account_id')) {
            $this->theme->model('content/page');
            
            $page_info = $this->model_content_page->getPage($this->config->get('config_account_id'));
            if ($page_info) {
                $data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('content/page/info', 'page_id=' . $this->config->get('config_account_id'), 'SSL'), $page_info['title'], $page_info['title']);
            } else {
                $data['text_agree'] = '';
            }
        } else {
            $data['text_agree'] = '';
        }
        
        if (isset($this->request->post['agree'])) {
            $data['agree'] = $this->request->post['agree'];
        } else {
            $data['agree'] = false;
        }
        
        $this->theme->loadjs('javascript/account/register', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('account/register', $data));
    }
    
    protected function validate() {
        if (($this->encode->strlen($this->request->post['username']) < 3) || ($this->encode->strlen($this->request->post['username']) > 16)) {
            $this->error['username'] = $this->language->get('error_username');
        }
        
        if (($this->encode->strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }
        
        if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
            $this->error['warning'] = $this->language->get('error_exists');
        }
        
        if ($this->model_account_customer->getTotalCustomersByUsername($this->request->post['username'])) {
            $this->error['warning'] = $this->language->get('error_uexists');
        }
        
        if (($this->encode->strlen($this->request->post['password']) < 4) || ($this->encode->strlen($this->request->post['password']) > 20)) {
            $this->error['password'] = $this->language->get('error_password');
        }
        
        if ($this->request->post['confirm'] != $this->request->post['password']) {
            $this->error['confirm'] = $this->language->get('error_confirm');
        }
        
        if ($this->config->get('config_account_id')) {
            $this->theme->model('content/page');
            
            $page_info = $this->model_content_page->getPage($this->config->get('config_account_id'));
            
            if ($page_info && !isset($this->request->post['agree'])) {
                $this->error['warning'] = sprintf($this->language->get('error_agree'), $page_info['title']);
            }
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    public function username() {
        $json = array();
        
        $this->theme->language('account/register');
        $this->theme->model('account/customer');
        
        if (($this->encode->strlen($this->request->get['username']) < 3) || ($this->encode->strlen($this->request->get['username']) > 16)):
            $json['error'] = $this->language->get('error_username');
        endif;
        
        if ($this->model_account_customer->getTotalCustomersByUsername($this->request->get['username'])):
            $json['error'] = $this->language->get('error_uexists');
        endif;
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function email() {
        $json = array();
        
        $this->theme->language('account/register');
        $this->theme->model('account/customer');
        
        if (($this->encode->strlen($this->request->get['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->get['email'])):
            $json['error'] = $this->language->get('error_email');
        endif;
        
        if ($this->model_account_customer->getTotalCustomersByEmail($this->request->get['email'])):
            $json['error'] = $this->language->get('error_exists');
        endif;
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function password() {
        $json = array();
        
        $this->theme->language('account/register');
        $this->theme->model('account/customer');
        
        if (($this->encode->strlen($this->request->get['password']) < 4) || ($this->encode->strlen($this->request->get['password']) > 20)):
            $json['error'] = $this->language->get('error_password');
        endif;
        
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
}
