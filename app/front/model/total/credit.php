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

namespace Front\Model\Total;
use Oculus\Engine\Model;

class Credit extends Model {
    public function getTotal(&$total_data, &$total, &$taxes) {
        if ($this->config->get('credit_status')) {
            $this->language->load('total/credit');
            
            $balance = 0;
            
            if ($this->customer->isLogged()):
                $balance = $this->customer->getBalance();
            endif;
            
            if ((float)$balance) {
                if ($balance > $total) {
                    $credit = $total;
                } else {
                    $credit = $balance;
                }
                
                if ($credit > 0) {
                    $total_data[] = array('code' => 'credit', 'title' => $this->language->get('lang_text_credit'), 'text' => $this->currency->format(-$credit), 'value' => - $credit, 'sort_order' => $this->config->get('credit_sort_order'));
                    
                    $total-= $credit;
                }
            }
        }
    }
    
    public function confirm($order_info, $order_total) {
        $this->language->load('total/credit');
        
        if ($order_info['customer_id']) {
            $this->db->query("
				INSERT INTO {$this->db->prefix}customer_transaction 
				SET 
					customer_id = '" . (int)$order_info['customer_id'] . "', 
					order_id = '" . (int)$order_info['order_id'] . "', 
					description = '" . $this->db->escape(sprintf($this->language->get('lang_text_order_id'), (int)$order_info['order_id'])) . "', 
					amount = '" . (float)$order_total['value'] . "', 
					date_added = NOW()
			");
        }
    }
}
