<?php

namespace Front\Model\Payment;
use Oculus\Engine\Model;
use Oculus\Library\Log as Log;

class Payflowiframe extends Model {
	public function getMethod($address, $total) {
		$this->language->load('payment/payflowiframe');

		$query = $this->db->query("SELECT * FROM {$this->db->prefix}zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('payflowiframe_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if ($this->config->get('payflowiframe_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('payflowiframe_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		$method_data = array();

		if ($status) {
			$method_data = array(
				'code' => 'payflowiframe',
				'title' => $this->language->get('text_title'),
				'sort_order' => $this->config->get('payflowiframe_sort_order')
			);
		}

		return $method_data;
	}

	public function getOrderId($secure_token_id) {
		$result = $this->db->query("SELECT `order_id` FROM `{$this->db->prefix}paypal_payflow_iframe_order` WHERE `secure_token_id` = '" . $this->db->escape($secure_token_id) . "'")->row;

		if ($result) {
			$order_id = $result['order_id'];
		} else {
			$order_id = false;
		}

		return $order_id;
	}

	public function addOrder($order_id, $secure_token_id) {
		$this->db->query("INSERT INTO `{$this->db->prefix}paypal_payflow_iframe_order` SET `order_id` = '" . (int)$order_id . "', `secure_token_id` = '" . $this->db->escape($secure_token_id) . "'");
	}

	public function updateOrder($data) {
		$this->db->query("
			UPDATE `{$this->db->prefix}paypal_payflow_iframe_order`
			SET `transaction_reference` = '" . $this->db->escape($data['transaction_reference']) . "',
				`transaction_type` = '" . $this->db->escape($data['transaction_type']) . "',
				`complete` = " . (int)$data['complete'] ."
			WHERE `secure_token_id` = '" . $this->db->escape($data['secure_token_id']) . "'
		");
	}

	public function call($data) {
		$default_parameters = array(
			'USER' => $this->config->get('payflowiframe_user'),
			'VENDOR' => $this->config->get('payflowiframe_vendor'),
			'PWD' => $this->config->get('payflowiframe_password'),
			'PARTNER' => $this->config->get('payflowiframe_partner'),
			'BUTTONSOURCE' => 'OCX_Cart_PFP',
		);

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

	public function addTransaction($data) {
		$this->db->query("
			INSERT INTO {$this->db->prefix}paypal_payflow_iframe_order_transaction
			SET order_id = " . (int)$data['order_id'] . ",
				transaction_reference = '" . $this->db->escape($data['transaction_reference']) . "',
				transaction_type = '" . $this->db->escape($data['type']) . "',
				`time` = NOW(),
				`amount` = '" . $this->db->escape($data['amount']) .  "'
		");
	}

	public function log($message) {
		if ($this->config->get('payflowiframe_debug')) {
			$log = new Log('payflow-iframe.log');
			$log->write($message);
		}
	}
}