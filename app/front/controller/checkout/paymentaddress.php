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

namespace Front\Controller\Checkout;
use Oculus\Engine\Controller;

class Paymentaddress extends Controller {
    public function index() {
        $data = $this->theme->language('checkout/checkout');
        
        if (isset($this->session->data['payment_address_id'])) {
            $data['address_id'] = $this->session->data['payment_address_id'];
        } else {
            $data['address_id'] = $this->customer->getAddressId();
        }
        
        $data['addresses'] = array();
        
        $this->theme->model('account/address');
        
        $data['addresses'] = $this->model_account_address->getAddresses();
        
        $this->theme->model('account/customergroup');
        
        $customer_group_info = $this->model_account_customergroup->getCustomerGroup($this->customer->getGroupId());
        
        if ($customer_group_info) {
            $data['company_id_display'] = $customer_group_info['company_id_display'];
        } else {
            $data['company_id_display'] = '';
        }
        
        if ($customer_group_info) {
            $data['company_id_required'] = $customer_group_info['company_id_required'];
        } else {
            $data['company_id_required'] = '';
        }
        
        if ($customer_group_info) {
            $data['tax_id_display'] = $customer_group_info['tax_id_display'];
        } else {
            $data['tax_id_display'] = '';
        }
        
        if ($customer_group_info) {
            $data['tax_id_required'] = $customer_group_info['tax_id_required'];
        } else {
            $data['tax_id_required'] = '';
        }
        
        if (isset($this->session->data['payment_country_id'])) {
            $data['country_id'] = $this->session->data['payment_country_id'];
        } else {
            $data['country_id'] = $this->config->get('config_country_id');
        }
        
        if (isset($this->session->data['payment_zone_id'])) {
            $data['zone_id'] = $this->session->data['payment_zone_id'];
        } else {
            $data['zone_id'] = '';
        }
        
        $data['params'] = htmlentities('{"zone_id":"' . $data['zone_id'] . '","select":"' . $this->language->get('text_select') . '","none":"' . $this->language->get('text_none') . '"}');
        
        $this->theme->model('localization/country');
        
        $data['countries'] = $this->model_localization_country->getCountries();
        
        $this->theme->loadjs('javascript/checkout/payment_address', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        $this->response->setOutput($this->theme->view('checkout/payment_address', $data));
    }
    
    public function validate() {
        $this->theme->language('checkout/checkout');
        
        $json = array();
        
        // Validate if customer is logged in.
        if (!$this->customer->isLogged()) {
            $json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
        }
        
        // Validate cart has products and has stock.
        if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
            $json['redirect'] = $this->url->link('checkout/cart');
        }
        
        // Validate minimum quantity requirments.
        $products = $this->cart->getProducts();
        
        foreach ($products as $product) {
            $product_total = 0;
            
            foreach ($products as $product_2) {
                if ($product_2['product_id'] == $product['product_id']) {
                    $product_total+= $product_2['quantity'];
                }
            }
            
            if ($product['minimum'] > $product_total) {
                $json['redirect'] = $this->url->link('checkout/cart');
                
                break;
            }
        }
        
        if (!$json) {
            if (isset($this->request->post['payment_address']) && $this->request->post['payment_address'] == 'existing') {
                $this->theme->model('account/address');
                $this->theme->model('account/customergroup');
                
                if (empty($this->request->post['address_id'])) {
                    $json['error']['warning'] = $this->language->get('error_address');
                } elseif (!in_array($this->request->post['address_id'], array_keys($this->model_account_address->getAddresses()))) {
                    $json['error']['warning'] = $this->language->get('error_address');
                } else {
                    
                    // Default Payment Address
                    $this->theme->model('account/address');
                    
                    $address_info = $this->model_account_address->getAddress($this->request->post['address_id']);
                    
                    if ($address_info) {
                        $this->theme->model('account/customer_group');
                        
                        $customer_group_info = $this->model_account_customergroup->getCustomerGroup($this->customer->getGroupId());
                        
                        // Company ID
                        if ($customer_group_info['company_id_display'] && $customer_group_info['company_id_required'] && !$address_info['company_id']) {
                            $json['error']['warning'] = $this->language->get('error_company_id');
                        }
                        
                        // Tax ID
                        if ($customer_group_info['tax_id_display'] && $customer_group_info['tax_id_required'] && !$address_info['tax_id']) {
                            $json['error']['warning'] = $this->language->get('error_tax_id');
                        }
                    }
                }
                
                if (!$json) {
                    $this->session->data['payment_address_id'] = $this->request->post['address_id'];
                    
                    if ($address_info) {
                        $this->session->data['payment_country_id'] = $address_info['country_id'];
                        $this->session->data['payment_zone_id'] = $address_info['zone_id'];
                    } else {
                        unset($this->session->data['payment_country_id']);
                        unset($this->session->data['payment_zone_id']);
                    }
                }
            } else {
                if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
                    $json['error']['firstname'] = $this->language->get('error_firstname');
                }
                
                if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
                    $json['error']['lastname'] = $this->language->get('error_lastname');
                }
                
                // Customer Group
                
                $customer_group_info = $this->model_account_customergroup->getCustomerGroup($this->customer->getGroupId());
                
                if ($customer_group_info) {
                    
                    // Company ID
                    if ($customer_group_info['company_id_display'] && $customer_group_info['company_id_required'] && empty($this->request->post['company_id'])) {
                        $json['error']['company_id'] = $this->language->get('error_company_id');
                    }
                    
                    // Tax ID
                    if ($customer_group_info['tax_id_display'] && $customer_group_info['tax_id_required'] && empty($this->request->post['tax_id'])) {
                        $json['error']['tax_id'] = $this->language->get('error_tax_id');
                    }
                }
                
                if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128)) {
                    $json['error']['address_1'] = $this->language->get('error_address_1');
                }
                
                if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 32)) {
                    $json['error']['city'] = $this->language->get('error_city');
                }
                
                $this->theme->model('localization/country');
                
                $country_info = $this->model_localization_country->getCountry($this->request->post['country_id']);
                
                if ($country_info) {
                    if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
                        $json['error']['postcode'] = $this->language->get('error_postcode');
                    }
                    
                    if ($this->config->get('config_vat') && !empty($this->request->post['tax_id']) && (vat_validation($country_info['iso_code_2'], $this->request->post['tax_id']) == 'invalid')) {
                        $json['error']['tax_id'] = $this->language->get('error_vat');
                    }
                }
                
                if ($this->request->post['country_id'] == '') {
                    $json['error']['country'] = $this->language->get('error_country');
                }
                
                if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
                    $json['error']['zone'] = $this->language->get('error_zone');
                }
                
                if (!$json) {
                    
                    // Default Payment Address
                    $this->theme->model('account/address');
                    
                    $this->session->data['payment_address_id'] = $this->model_account_address->addAddress($this->request->post);
                    $this->session->data['payment_country_id'] = $this->request->post['country_id'];
                    $this->session->data['payment_zone_id'] = $this->request->post['zone_id'];
                }
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
}
