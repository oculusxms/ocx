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

namespace Admin\Model\Sale;
use Oculus\Engine\Model;

class Fraud extends Model {
    public function getFraud($order_id) {
        $query = $this->db->query("SELECT * FROM `{$this->db->prefix}order_fraud` WHERE order_id = '" . (int)$order_id . "'");
        
        return $query->row;
    }
}
