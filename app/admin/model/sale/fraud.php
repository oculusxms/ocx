<?php

namespace Admin\Model\Sale;
use Oculus\Engine\Model;

class Fraud extends Model {
	public function getFraud($order_id) {
		$query = $this->db->query("SELECT * FROM `{$this->db->prefix}order_fraud` WHERE order_id = '" . (int)$order_id . "'");
	
		return $query->row;
	}
}