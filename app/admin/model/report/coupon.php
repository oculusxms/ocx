<?php

namespace Admin\Model\Report;
use Oculus\Engine\Model;

class Coupon extends Model {
	public function getCoupons($data = array()) {
		$sql = "SELECT ch.coupon_id, c.name, c.code, COUNT(DISTINCT ch.order_id) AS `orders`, SUM(ch.amount) AS total FROM `{$this->db->prefix}coupon_history` ch LEFT JOIN `{$this->db->prefix}coupon` c ON (ch.coupon_id = c.coupon_id)"; 

		$implode = array();
		
		if (!empty($data['filter_date_start'])) {
			$implode[] = "DATE(ch.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$implode[] = "DATE(ch.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}

		if ($implode) {
			$sql .= " WHERE {implode(" && ", $implode)}";
		}
				
		$sql .= " GROUP BY ch.coupon_id ORDER BY total DESC";
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}	
	
	public function getTotalCoupons($data = array()) {
		$sql = "SELECT COUNT(DISTINCT coupon_id) AS total FROM `{$this->db->prefix}coupon_history`";
		
		$implode = array();
		
		if (!empty($data['filter_date_start'])) {
			$implode[] = "DATE(date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$implode[] = "DATE(date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}

		if ($implode) {
			$sql .= " WHERE {implode(" && ", $implode)}";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];	
	}		
}