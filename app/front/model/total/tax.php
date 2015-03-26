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

class Tax extends Model {
    public function getTotal(&$total_data, &$total, &$taxes) {
        foreach ($taxes as $key => $value):
            if ($value > 0):
                $total_data[] = array(
                    'code'       => 'tax', 
                    'title'      => $this->tax->getRateName($key), 
                    'text'       => $this->currency->format($value), 
                    'value'      => $value, 
                    'sort_order' => $this->config->get('tax_sort_order')
                );
                
                $total+= $value;
            endif;
        endforeach;
    }
}
