<?php

namespace Front\Model\Payment;
use Oculus\Engine\Model;
 
class Freecheckout extends Model {
	public function getMethod($address, $total) {
		$this->language->load('payment/freecheckout');

		if ($total == 0) {
			$status = true;
		} else {
			$status = false;
		}

		$method_data = array();

		if ($status) {  
			$method_data = array( 
				'code'       => 'freecheckout',
				'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('freecheckout_sort_order')
			);
		}

		return $method_data;
	}
}