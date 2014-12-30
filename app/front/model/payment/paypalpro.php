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

namespace Front\Model\Payment;
use Oculus\Engine\Model;

class Paypalpro extends Model {
    public function getMethod($address, $total) {
        $this->language->load('payment/paypalpro');
        
        $query = $this->db->query("SELECT * FROM {$this->db->prefix}zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('paypalpro_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
        
        if ($this->config->get('paypalpro_total') > 0 && $this->config->get('paypalpro_total') > $total) {
            $status = false;
        } elseif (!$this->config->get('paypalpro_geo_zone_id')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }
        
        $method_data = array();
        
        if ($status) {
            $method_data = array('code' => 'paypalpro', 'title' => $this->language->get('text_title'), 'sort_order' => $this->config->get('paypalpro_sort_order'));
        }
        
        return $method_data;
    }
}
