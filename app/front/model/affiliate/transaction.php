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

namespace Front\Model\Affiliate;
use Oculus\Engine\Model;

class Transaction extends Model {
    public function getTransactions($data = array()) {
        $sql = "
			SELECT * 
			FROM `{$this->db->prefix}affiliate_transaction` 
			WHERE affiliate_id = '" . (int)$this->affiliate->getId() . "'";
        
        $sort_data = array('amount', 'description', 'date_added');
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql.= " ORDER BY {$data['sort']}";
        } else {
            $sql.= " ORDER BY date_added";
        }
        
        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql.= " DESC";
        } else {
            $sql.= " ASC";
        }
        
        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }
            
            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }
            
            $sql.= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        
        $query = $this->db->query($sql);
        
        return $query->rows;
    }
    
    public function getTotalTransactions() {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM `{$this->db->prefix}affiliate_transaction` 
			WHERE affiliate_id = '" . (int)$this->affiliate->getId() . "'
		");
        
        return $query->row['total'];
    }
    
    public function getBalance() {
        $query = $this->db->query("
			SELECT SUM(amount) AS total 
			FROM `{$this->db->prefix}affiliate_transaction` 
			WHERE affiliate_id = '" . (int)$this->affiliate->getId() . "' 
			GROUP BY affiliate_id
		");
        
        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }
}
