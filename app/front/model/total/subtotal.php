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

class Subtotal extends Model {
    public function getTotal(&$total_data, &$total, &$taxes) {
        $this->language->load('total/subtotal');
        
        $sub_total = $this->cart->getSubTotal();
        
        if (isset($this->session->data['vouchers']) && $this->session->data['vouchers']) {
            foreach ($this->session->data['vouchers'] as $voucher) {
                $sub_total+= $voucher['amount'];
            }
        }
        
        $total_data[] = array('code' => 'subtotal', 'title' => $this->language->get('text_subtotal'), 'text' => $this->currency->format($sub_total), 'value' => $sub_total, 'sort_order' => $this->config->get('subtotal_sort_order'));
        
        $total+= $sub_total;
    }
}
