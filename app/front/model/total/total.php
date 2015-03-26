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

class Total extends Model {
    public function getTotal(&$total_data, &$total, &$taxes) {
        $this->language->load('total/total');
        
        $total_data[] = array(
			'code'       => 'total', 
			'title'      => $this->language->get('lang_text_total'), 
			'text'       => $this->currency->format(max(0, $total)), 
			'value'      => max(0, $total), 
			'sort_order' => $this->config->get('total_sort_order')
        );
    }
}
