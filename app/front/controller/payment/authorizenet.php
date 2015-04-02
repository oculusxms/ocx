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

namespace Front\Controller\Payment;
use Oculus\Engine\Controller;

class Authorizenet extends Controller {
    public function index() {
        $data = $this->theme->language('payment/authorizenet');
        
        $data['months'] = array();
        
        for ($i = 1; $i <= 12; $i++) {
            $data['months'][] = array('text' => strftime('%B', mktime(0, 0, 0, $i, 1, 2000)), 'value' => sprintf('%02d', $i));
        }
        
        $today = getdate();
        
        $data['year_expire'] = array();
        
        for ($i = $today['year']; $i < $today['year'] + 11; $i++) {
            $data['year_expire'][] = array('text' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)), 'value' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)));
        }
        
        $this->theme->loadjs('javascript/payment/authorizenet', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        return $this->theme->view('payment/authorizenet', $data);
    }
    
    public function send() {
        if ($this->config->get('authorizenet_server') == 'live') {
            $url = 'https://secure.authorize.net/gateway/transact.dll';
        } elseif ($this->config->get('authorizenet_server') == 'test') {
            $url = 'https://test.authorize.net/gateway/transact.dll';
        }
        
        $this->theme->model('checkout/order');
        
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        
        $send = array();
        
        $send['x_login'] = $this->config->get('authorizenet_login');
        $send['x_tran_key'] = $this->config->get('authorizenet_key');
        $send['x_version'] = '3.1';
        $send['x_delim_data'] = 'true';
        $send['x_delim_char'] = ',';
        $send['x_encap_char'] = '"';
        $send['x_relay_response'] = 'false';
        $send['x_first_name'] = html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');
        $send['x_last_name'] = html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
        $send['x_company'] = html_entity_decode($order_info['payment_company'], ENT_QUOTES, 'UTF-8');
        $send['x_address'] = html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8');
        $send['x_city'] = html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8');
        $send['x_state'] = html_entity_decode($order_info['payment_zone'], ENT_QUOTES, 'UTF-8');
        $send['x_zip'] = html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8');
        $send['x_country'] = html_entity_decode($order_info['payment_country'], ENT_QUOTES, 'UTF-8');
        $send['x_phone'] = $order_info['telephone'];
        $send['x_customer_ip'] = $this->request->server['REMOTE_ADDR'];
        $send['x_email'] = $order_info['email'];
        $send['x_description'] = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');
        $send['x_amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], 1.00000, false);
        $send['x_currency_code'] = $this->currency->getCode();
        $send['x_method'] = 'CC';
        $send['x_type'] = ($this->config->get('authorizenet_method') == 'capture') ? 'AUTH_CAPTURE' : 'AUTH_ONLY';
        $send['x_card_num'] = str_replace(' ', '', $this->request->post['cc_number']);
        $send['x_exp_date'] = $this->request->post['cc_expire_date_month'] . $this->request->post['cc_expire_date_year'];
        $send['x_card_code'] = $this->request->post['cc_cvv2'];
        $send['x_invoice_num'] = $this->session->data['order_id'];
        $send['x_solution_id'] = 'A1000015';
        
        /* Customer Shipping Address Fields */
        $send['x_ship_to_first_name'] = html_entity_decode($order_info['shipping_firstname'], ENT_QUOTES, 'UTF-8');
        $send['x_ship_to_last_name'] = html_entity_decode($order_info['shipping_lastname'], ENT_QUOTES, 'UTF-8');
        $send['x_ship_to_company'] = html_entity_decode($order_info['shipping_company'], ENT_QUOTES, 'UTF-8');
        $send['x_ship_to_address'] = html_entity_decode($order_info['shipping_address_1'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['shipping_address_2'], ENT_QUOTES, 'UTF-8');
        $send['x_ship_to_city'] = html_entity_decode($order_info['shipping_city'], ENT_QUOTES, 'UTF-8');
        $send['x_ship_to_state'] = html_entity_decode($order_info['shipping_zone'], ENT_QUOTES, 'UTF-8');
        $send['x_ship_to_zip'] = html_entity_decode($order_info['shipping_postcode'], ENT_QUOTES, 'UTF-8');
        $send['x_ship_to_country'] = html_entity_decode($order_info['shipping_country'], ENT_QUOTES, 'UTF-8');
        
        if ($this->config->get('authorizenet_mode') == 'test') {
            $send['x_test_request'] = 'true';
        }
        
        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_PORT, 443);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($send, '', '&'));
        
        $response = curl_exec($curl);
        
        $json = array();
        
        if (curl_error($curl)) {
            $json['error'] = 'CURL ERROR: ' . curl_errno($curl) . '::' . curl_error($curl);
            
            $this->log->write('AUTHNET AIM CURL ERROR: ' . curl_errno($curl) . '::' . curl_error($curl));
        } elseif ($response) {
            $i = 1;
            
            $response_info = array();
            
            $results = explode(',', $response);
            
            foreach ($results as $result) {
                $response_info[$i] = trim($result, '"');
                
                $i++;
            }
            
            if ($response_info[1] == '1') {
                if (strtoupper($response_info[38]) == strtoupper(md5($this->config->get('authorizenet_hash') . $this->config->get('authorizenet_login') . $response_info[7] . $this->currency->format($order_info['total'], $order_info['currency_code'], 1.00000, false)))) {
                    $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('config_order_status_id'));
                    
                    $message = '';
                    
                    if (isset($response_info['5'])) {
                        $message.= 'Authorization Code: ' . $response_info['5'] . "\n";
                    }
                    
                    if (isset($response_info['6'])) {
                        $message.= 'AVS Response: ' . $response_info['6'] . "\n";
                    }
                    
                    if (isset($response_info['7'])) {
                        $message.= 'Transaction ID: ' . $response_info['7'] . "\n";
                    }
                    
                    if (isset($response_info['39'])) {
                        $message.= 'Card Code Response: ' . $response_info['39'] . "\n";
                    }
                    
                    if (isset($response_info['40'])) {
                        $message.= 'Cardholder Authentication Verification Response: ' . $response_info['40'] . "\n";
                    }
                    
                    $this->model_checkout_order->update($this->session->data['order_id'], $this->config->get('authorizenet_order_status_id'), $message);
                }
                
                $json['success'] = $this->url->link('checkout/success', '', 'SSL');
            } else {
                $json['error'] = $response_info[4];
            }
        } else {
            $json['error'] = 'Empty Gateway Response';
            
            $this->log->write('AUTHNET AIM CURL ERROR: Empty Gateway Response');
        }
        
        curl_close($curl);
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
}
