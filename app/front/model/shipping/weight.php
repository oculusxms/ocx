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

namespace Front\Model\Shipping;
use Oculus\Engine\Model;

class Weight extends Model {
    public function getQuote($address) {
        $this->language->load('shipping/weight');
        
        $quote_data = array();
        
        $query = $this->db->query("
            SELECT * 
            FROM {$this->db->prefix}geo_zone ORDER BY name"
        );
        
        foreach ($query->rows as $result):
            if ($this->config->get('weight_' . $result['geo_zone_id'] . '_status')):
                $query = $this->db->query("
                    SELECT * 
                    FROM {$this->db->prefix}zone_to_geo_zone 
                    WHERE geo_zone_id = '" . (int)$result['geo_zone_id'] . "' 
                    AND country_id    = '" . (int)$address['country_id'] . "' 
                    AND (zone_id      = '" . (int)$address['zone_id'] . "' OR zone_id = '0')"
                );
                
                if ($query->num_rows):
                    $status = true;
                else:
                    $status = false;
                endif;
            else:
                $status = false;
            endif;
            
            if ($status):
                $cost   = '';
                $weight = $this->cart->getWeight();
                $rates  = explode(',', $this->config->get('weight_' . $result['geo_zone_id'] . '_rate'));
                
                foreach ($rates as $rate):
                    $data = explode(':', $rate);
                    
                    if ($data[0] >= $weight):
                        if (isset($data[1])):
                            $cost = $data[1];
                        endif;
                        break;
                    endif;
                endforeach;
                
                if ((string)$cost != ''):
                    $quote_data['weight_' . $result['geo_zone_id']] = array(
                        'code'         => 'weight.weight_' . $result['geo_zone_id'], 
                        'title'        => $result['name'] . '  (' . $this->language->get('lang_text_weight') . ' ' . $this->weight->format($weight, $this->config->get('config_weight_class_id')) . ')', 
                        'cost'         => $cost, 
                        'tax_class_id' => $this->config->get('weight_tax_class_id'), 
                        'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('weight_tax_class_id'), $this->config->get('config_tax')))
                    );
                endif;
            endif;
        endforeach;
        
        $method_data = array();
        
        if ($quote_data):
            $method_data = array(
                'code'       => 'weight', 
                'title'      => $this->language->get('lang_text_title'), 
                'quote'      => $quote_data, 
                'sort_order' => $this->config->get('weight_sort_order'), 
                'error'      => false
            );
        endif;
        
        return $method_data;
    }
}
