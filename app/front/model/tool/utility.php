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

namespace Front\Model\Tool;
use Oculus\Engine\Model;

class Utility extends Model {
	public function getUnreadCustomerNotifications($customer_id) {
		$query = $this->db->query("
			SELECT COUNT(notification_id) AS total 
			FROM {$this->db->prefix}customer_inbox 
			WHERE customer_id = '" . (int)$customer_id . "' 
			AND is_read = '0'");

		return $query->row['total'];
	}

	public function getUnreadAffiliateNotifications($affiliate_id) {
		$query = $this->db->query("
			SELECT COUNT(notification_id) AS total 
			FROM {$this->db->prefix}affiliate_inbox 
			WHERE affiliate_id = '" . (int)$affiliate_id . "' 
			AND is_read = '0'");

		return $query->row['total'];
	}
}
