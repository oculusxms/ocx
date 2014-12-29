<?php

namespace Front\Model\Payment;
use Oculus\Engine\Model;
 
class Authorizenet extends Model {
	public function getMethod($address, $total) {
		$this->language->load('payment/authorizenet');

		$query = $this->db->query("SELECT * FROM {$this->db->prefix}zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('authorizenet_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if ($this->config->get('authorizenet_total') > 0 && $this->config->get('authorizenet_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('authorizenet_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}	

		$method_data = array();

		if ($status) {  
			$method_data = array(
				'code'       => 'authorizenet',
				'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('authorizenet_sort_order')
			);
		}

		return $method_data;
	}
}