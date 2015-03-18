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

namespace Front\Model\Account;
use Oculus\Engine\Model;

class Affiliate extends Model {

	public function getSettings($customer_id) {
		$data = array();

		$query = $this->db->query("
			SELECT DISTINCT * 
			FROM {$this->db->prefix}customer 
			WHERE customer_id = '" . (int)$customer_id . "'
		");

		$data['username']            = $query->row['username'];
		$data['affiliate_status']    = $query->row['affiliate_status'];
		$data['company']             = $query->row['company'];
		$data['website']             = $query->row['website'];
		$data['code']                = $query->row['code'];
		$data['commission']          = $query->row['commission'];
		$data['tax_id']              = $query->row['tax_id'];
		$data['payment_method']      = $query->row['payment_method'];
		$data['cheque']              = $query->row['cheque'];
		$data['paypal']              = $query->row['paypal'];
		$data['bank_name']           = $query->row['bank_name'];
		$data['bank_branch_number']  = $query->row['bank_branch_number'];
		$data['bank_swift_code']     = $query->row['bank_swift_code'];
		$data['bank_account_name']   = $query->row['bank_account_name'];
		$data['bank_account_number'] = $query->row['bank_account_number'];

		return $data;
	}
}
