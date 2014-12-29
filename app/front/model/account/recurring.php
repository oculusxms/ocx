<?php

namespace Front\Model\Account;
use Oculus\Engine\Model;

class Recurring extends Model {

	private $recurring_status = array(
		0 => 'Inactive',
		1 => 'Active',
		2 => 'Suspended',
		3 => 'Cancelled',
		4 => 'Expired / Complete'
	);

	private $transaction_type = array(
		0 => 'Created',
		1 => 'Payment',
		2 => 'Outstanding payment',
		3 => 'Payment skipped',
		4 => 'Payment failed',
		5 => 'Cancelled',
		6 => 'Suspended',
		7 => 'Suspended from failed payment',
		8 => 'Outstanding payment failed',
		9 => 'Expired',
	);

	public function getProfile($id) {
		$result = $this->db->query("
			SELECT 
				`or`.*,
				`o`.`payment_method`,
				`o`.`payment_code`,
				`o`.`currency_code` 
			FROM `{$this->db->prefix}order_recurring` `or` 
			LEFT JOIN `{$this->db->prefix}order` `o` 
			ON `or`.`order_id` = `o`.`order_id` 
			WHERE `or`.`order_recurring_id` = '".(int)$id."' 
			AND `o`.`customer_id` = '".(int)$this->customer->getId()."' LIMIT 1
		");

		if ($result->num_rows):
			$profile = $result->row;
			return $profile;
		else:
			return false;
		endif;
	}

	public function getProfileByRef($ref) {
		$query = $this->db->query("
			SELECT * 
			FROM `{$this->db->prefix}order_recurring` 
			WHERE `reference` = '".$this->db->escape($ref)."' 
			LIMIT 1
		");

		if ($query->num_rows) {
			return $query->row;
		} else {
			return false;
		}
	}

	public function getProfileTransactions($id) {

		$profile = $this->getProfile($id);

		$results = $this->db->query("
			SELECT * 
			FROM `{$this->db->prefix}order_recurring_transaction` 
			WHERE `order_recurring_id` = '".(int)$id."'
		");

		if ($results->num_rows):
			$transactions = array();

			foreach ($results->rows as $transaction):
				$transaction['amount'] = $this->currency->format($transaction['amount'], $profile['currency_code'], 1);
				$transactions[] = $transaction;
			endforeach;

			return $transactions;
		else:
			return false;
		endif;
	}

	public function getAllProfiles($start = 0, $limit = 20) {
		if ($start < 0):
			$start = 0;
		endif;

		if ($limit < 1):
			$limit = 1;
		endif;

		$result = $this->db->query("
			SELECT 
				`or`.*,
				`o`.`payment_method`,
				`o`.`currency_id`,
				`o`.`currency_value` 
			FROM `{$this->db->prefix}order_recurring` `or` 
			LEFT JOIN `{$this->db->prefix}order` `o` 
				ON `or`.`order_id` = `o`.`order_id` 
			WHERE `o`.`customer_id` = '".(int)$this->customer->getId()."' 
			ORDER BY `o`.`order_id` 
			DESC LIMIT " . (int)$start . "," . (int)$limit);

		if ($result->num_rows > 0):
			$profiles = array();

			foreach ($result->rows as $profile):
				$profiles[] = $profile;
			endforeach;

			return $profiles;
		else:
			return false;
		endif;
	}

	public function getTotalRecurring() {
		$query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM `{$this->db->prefix}order_recurring` `or` 
			LEFT JOIN `{$this->db->prefix}order` `o` 
				ON `or`.`order_id` = `o`.`order_id` 
			WHERE `o`.`customer_id` = '" . (int)$this->customer->getId() . "'
		");

		return $query->row['total'];
	}
}
