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

class Credit extends Model {
    public function getCredits($data = array()) {
        $sql = "
			SELECT * 
			FROM `{$this->db->prefix}customer_credit` 
			WHERE customer_id = '" . (int)$this->customer->getId() . "'";
        
        $sort_data = array('amount', 'description', 'date_added');
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)):
            $sql.= " ORDER BY {$data['sort']}";
        else:
            $sql.= " ORDER BY date_added";
        endif;
        
        if (isset($data['order']) && ($data['order'] == 'DESC')):
            $sql.= " DESC";
        else:
            $sql.= " ASC";
        endif;
        
        if (isset($data['start']) || isset($data['limit'])):
            if ($data['start'] < 0):
                $data['start'] = 0;
            endif;
            
            if ($data['limit'] < 1):
                $data['limit'] = 20;
            endif;
            
            $sql.= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        endif;
        
        $query = $this->db->query($sql);
        
        return $query->rows;
    }
    
    public function getTotalCredits() {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM `{$this->db->prefix}customer_credit` 
			WHERE customer_id = '" . (int)$this->customer->getId() . "'
		");
        
        return $query->row['total'];
    }
    
    public function getTotalAmount() {
        $query = $this->db->query("
			SELECT SUM(amount) AS total 
			FROM `{$this->db->prefix}customer_credit` 
			WHERE customer_id = '" . (int)$this->customer->getId() . "' 
			GROUP BY customer_id
		");
        
        if ($query->num_rows):
            return $query->row['total'];
        else:
            return 0;
        endif;
    }
}
