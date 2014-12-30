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

class Recurring extends Model {
    
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
			WHERE `or`.`order_recurring_id` = '" . (int)$id . "' 
			AND `o`.`customer_id` = '" . (int)$this->customer->getId() . "' LIMIT 1
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
			WHERE `reference` = '" . $this->db->escape($ref) . "' 
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
			WHERE `order_recurring_id` = '" . (int)$id . "'
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
			WHERE `o`.`customer_id` = '" . (int)$this->customer->getId() . "' 
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
