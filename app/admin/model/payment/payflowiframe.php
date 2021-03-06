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

namespace Admin\Model\Payment;
use Oculus\Engine\Model;
use Oculus\Library\Log;

class PayflowiFrame extends Model {
    public function install() {
        $this->db->query("
			CREATE TABLE `{$this->db->prefix}paypal_payflow_iframe_order` (
				`order_id` int(11) DEFAULT NULL,
				`secure_token_id` varchar(255) NOT NULL,
				`transaction_reference` varchar(255) DEFAULT NULL,
				`transaction_type` varchar(1) DEFAULT NULL,
				`complete` tinyint(4) NOT NULL DEFAULT '0',
				PRIMARY KEY(`order_id`),
				KEY `secure_token_id` (`secure_token_id`)
			) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci");
        
        $this->db->query("
			CREATE TABLE `{$this->db->prefix}paypal_payflow_iframe_order_transaction` (
				`order_id` int(11) NOT NULL,
				`transaction_reference` varchar(255) NOT NULL,
				`transaction_type` char(1) NOT NULL,
				`time` datetime NOT NULL,
				`amount` decimal(10,4) DEFAULT NULL,
				PRIMARY KEY (`transaction_reference`),
				KEY `order_id` (`order_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
    }
    
    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `{$this->db->prefix}paypal_payflow_iframe_order`;");
        $this->db->query("DROP TABLE IF EXISTS `{$this->db->prefix}paypal_payflow_iframe_order_transaction`;");
    }
    
    public function log($message) {
        if ($this->config->get('payflowiframe_debug')) {
            $log = new Log('payflow-iframe.log');
            $log->write($message);
        }
    }
    
    public function getOrder($order_id) {
        $result = $this->db->query("SELECT * FROM {$this->db->prefix}paypal_payflow_iframe_order WHERE order_id = " . (int)$order_id);
        
        if ($result->num_rows) {
            $order = $result->row;
        } else {
            $order = false;
        }
        
        return $order;
    }
    
    public function updateOrderStatus($order_id, $status) {
        $this->db->query("
			UPDATE {$this->db->prefix}paypal_payflow_iframe_order
			SET `complete` = " . (int)$status . "
			WHERE order_id = '" . (int)$order_id . "'
		");
    }
    
    public function addTransaction($data) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}paypal_payflow_iframe_order_transaction
			SET order_id = " . (int)$data['order_id'] . ",
				transaction_reference = '" . $this->db->escape($data['transaction_reference']) . "',
				transaction_type = '" . $this->db->escape($data['type']) . "',
				`time` = NOW(),
				`amount` = '" . $this->db->escape($data['amount']) . "'
		");
    }
    
    public function getTransactions($order_id) {
        return $this->db->query("
			SELECT *
			FROM {$this->db->prefix}paypal_payflow_iframe_order_transaction
			WHERE order_id = " . (int)$order_id . "
			ORDER BY `time` ASC")->rows;
    }
    
    public function getTransaction($transaction_reference) {
        $result = $this->db->query("
			SELECT *
			FROM {$this->db->prefix}paypal_payflow_iframe_order_transaction
			WHERE transaction_reference = '" . $this->db->escape($transaction_reference) . "'")->row;
        
        if ($result) {
            $transaction = $result;
        } else {
            $transaction = false;
        }
        
        return $transaction;
    }
    
    public function call($data) {
        $default_parameters = array('USER' => $this->config->get('payflowiframe_user'), 'VENDOR' => $this->config->get('payflowiframe_vendor'), 'PWD' => $this->config->get('payflowiframe_password'), 'PARTNER' => $this->config->get('payflowiframe_partner'), 'BUTTONSOURCE' => 'OCX_Cart_PFP',);
        
        $call_parameters = array_merge($data, $default_parameters);
        
        if ($this->config->get('payflowiframe_test')) {
            $url = 'https://pilot-payflowpro.paypal.com';
        } else {
            $url = 'https://payflowpro.paypal.com';
        }
        
        $query_params = array();
        
        foreach ($call_parameters as $key => $value) {
            $query_params[] = $key . '=' . utf8_decode($value);
        }
        
        $this->log('Call data: ' . implode('&', $query_params));
        
        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, implode('&', $query_params));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($curl);
        
        $this->log('Response data: ' . $response);
        
        $response_params = array();
        parse_str($response, $response_params);
        
        return $response_params;
    }
}
