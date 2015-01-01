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

namespace Front\Controller\Affiliate;
use Oculus\Engine\Controller;

class Register extends Controller {
    private $error = array();
    
    public function index() {
        if ($this->affiliate->isLogged()) {
            $this->response->redirect($this->url->link('affiliate/account', '', 'SSL'));
        }
        
        $data = $this->theme->language('affiliate/register');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('affiliate/affiliate');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_affiliate_affiliate->addAffiliate($this->request->post);
            $this->affiliate->login($this->request->post['email'], $this->request->post['password']);
            
            $this->response->redirect($this->url->link('affiliate/success'));
        }
        
        $this->breadcrumb->add('text_account', 'affiliate/account', null, true, 'SSL');
        $this->breadcrumb->add('text_register', 'affiliate/register', null, true, 'SSL');
        
        $data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('affiliate/login', '', 'SSL'));
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
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
        
        if (isset($this->error['address_1'])) {
            $data['error_address_1'] = $this->error['address_1'];
        } else {
            $data['error_address_1'] = '';
        }
        
        if (isset($this->error['city'])) {
            $data['error_city'] = $this->error['city'];
        } else {
            $data['error_city'] = '';
        }
        
        if (isset($this->error['postcode'])) {
            $data['error_postcode'] = $this->error['postcode'];
        } else {
            $data['error_postcode'] = '';
        }
        
        if (isset($this->error['country'])) {
            $data['error_country'] = $this->error['country'];
        } else {
            $data['error_country'] = '';
        }
        
        if (isset($this->error['zone'])) {
            $data['error_zone'] = $this->error['zone'];
        } else {
            $data['error_zone'] = '';
        }
        
        $data['action'] = $this->url->link('affiliate/register', '', 'SSL');
        
        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        } else {
            $data['firstname'] = '';
        }
        
        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        } else {
            $data['lastname'] = '';
        }
        
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } else {
            $data['email'] = '';
        }
        
        if (isset($this->request->post['telephone'])) {
            $data['telephone'] = $this->request->post['telephone'];
        } else {
            $data['telephone'] = '';
        }
        
        if (isset($this->request->post['company'])) {
            $data['company'] = $this->request->post['company'];
        } else {
            $data['company'] = '';
        }
        
        if (isset($this->request->post['website'])) {
            $data['website'] = $this->request->post['website'];
        } else {
            $data['website'] = '';
        }
        
        if (isset($this->request->post['address_1'])) {
            $data['address_1'] = $this->request->post['address_1'];
        } else {
            $data['address_1'] = '';
        }
        
        if (isset($this->request->post['address_2'])) {
            $data['address_2'] = $this->request->post['address_2'];
        } else {
            $data['address_2'] = '';
        }
        
        if (isset($this->request->post['postcode'])) {
            $data['postcode'] = $this->request->post['postcode'];
        } else {
            $data['postcode'] = '';
        }
        
        if (isset($this->request->post['city'])) {
            $data['city'] = $this->request->post['city'];
        } else {
            $data['city'] = '';
        }
        
        if (isset($this->request->post['country_id'])) {
            $data['country_id'] = $this->request->post['country_id'];
        } else {
            $data['country_id'] = $this->config->get('config_country_id');
        }
        
        if (isset($this->request->post['zone_id'])) {
            $data['zone_id'] = $this->request->post['zone_id'];
        } else {
            $data['zone_id'] = '';
        }
        
        $data['params'] = htmlentities('{"zone_id":"' . $data['zone_id'] . '","select":"' . $this->language->get('text_select') . '","none":"' . $this->language->get('text_none') . '"}');
        
        $this->theme->model('localization/country');
        
        $data['countries'] = $this->model_localization_country->getCountries();
        
        if (isset($this->request->post['tax'])) {
            $data['tax'] = $this->request->post['tax'];
        } else {
            $data['tax'] = '';
        }
        
        if (isset($this->request->post['payment'])) {
            $data['payment'] = $this->request->post['payment'];
        } else {
            $data['payment'] = 'check';
        }
        
        if (isset($this->request->post['check'])) {
            $data['check'] = $this->request->post['check'];
        } else {
            $data['check'] = '';
        }
        
        if (isset($this->request->post['paypal'])) {
            $data['paypal'] = $this->request->post['paypal'];
        } else {
            $data['paypal'] = '';
        }
        
        if (isset($this->request->post['bank_name'])) {
            $data['bank_name'] = $this->request->post['bank_name'];
        } else {
            $data['bank_name'] = '';
        }
        
        if (isset($this->request->post['bank_branch_number'])) {
            $data['bank_branch_number'] = $this->request->post['bank_branch_number'];
        } else {
            $data['bank_branch_number'] = '';
        }
        
        if (isset($this->request->post['bank_swift_code'])) {
            $data['bank_swift_code'] = $this->request->post['bank_swift_code'];
        } else {
            $data['bank_swift_code'] = '';
        }
        
        if (isset($this->request->post['bank_account_name'])) {
            $data['bank_account_name'] = $this->request->post['bank_account_name'];
        } else {
            $data['bank_account_name'] = '';
        }
        
        if (isset($this->request->post['bank_account_number'])) {
            $data['bank_account_number'] = $this->request->post['bank_account_number'];
        } else {
            $data['bank_account_number'] = '';
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
        
        if ($this->config->get('config_affiliate_id')) {
            $this->theme->model('content/page');
            
            $page_info = $this->model_content_page->getPage($this->config->get('config_affiliate_id'));
            
            if ($page_info) {
                $data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('content/page/info', 'page_id=' . $this->config->get('config_affiliate_id'), 'SSL'), $page_info['title'], $page_info['title']);
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
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('affiliate/register', $data));
    }
    
    protected function validate() {
        if (($this->encode->strlen($this->request->post['firstname']) < 1) || ($this->encode->strlen($this->request->post['firstname']) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }
        
        if (($this->encode->strlen($this->request->post['lastname']) < 1) || ($this->encode->strlen($this->request->post['lastname']) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }
        
        if (($this->encode->strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }
        
        if ($this->model_affiliate_affiliate->getTotalAffiliatesByEmail($this->request->post['email'])) {
            $this->error['warning'] = $this->language->get('error_exists');
        }
        
        if (($this->encode->strlen($this->request->post['telephone']) < 3) || ($this->encode->strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('error_telephone');
        }
        
        if (($this->encode->strlen($this->request->post['address_1']) < 3) || ($this->encode->strlen($this->request->post['address_1']) > 128)) {
            $this->error['address_1'] = $this->language->get('error_address_1');
        }
        
        if (($this->encode->strlen($this->request->post['city']) < 2) || ($this->encode->strlen($this->request->post['city']) > 128)) {
            $this->error['city'] = $this->language->get('error_city');
        }
        
        $this->theme->model('localization/country');
        
        $country_info = $this->model_localization_country->getCountry($this->request->post['country_id']);
        
        if ($country_info && $country_info['postcode_required'] && ($this->encode->strlen($this->request->post['postcode']) < 2) || ($this->encode->strlen($this->request->post['postcode']) > 10)) {
            $this->error['postcode'] = $this->language->get('error_postcode');
        }
        
        if ($this->request->post['country_id'] == '') {
            $this->error['country'] = $this->language->get('error_country');
        }
        
        if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
            $this->error['zone'] = $this->language->get('error_zone');
        }
        
        if (($this->encode->strlen($this->request->post['password']) < 4) || ($this->encode->strlen($this->request->post['password']) > 20)) {
            $this->error['password'] = $this->language->get('error_password');
        }
        
        if ($this->request->post['confirm'] != $this->request->post['password']) {
            $this->error['confirm'] = $this->language->get('error_confirm');
        }
        
        if ($this->config->get('config_affiliate_id')) {
            $this->theme->model('content/page');
            
            $page_info = $this->model_content_page->getPage($this->config->get('config_affiliate_id'));
            
            if ($page_info && !isset($this->request->post['agree'])) {
                $this->error['warning'] = sprintf($this->language->get('error_agree'), $page_info['title']);
            }
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
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
