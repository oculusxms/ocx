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

namespace Front\Controller\Payment;
use Oculus\Engine\Controller;

class Check extends Controller {
    public function index() {
        $data = $this->theme->language('payment/check');
        
        $data['payable'] = $this->config->get('check_payable');
        $data['address'] = nl2br($this->config->get('config_address'));
        
        $data['continue'] = $this->url->link('checkout/success');
        
        $this->theme->loadjs('javascript/payment/check', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        return $this->theme->view('payment/check', $data);
    }
    
    public function confirm() {
        $data = $this->theme->language('payment/check');
        
        $this->theme->model('checkout/order');
        
        $comment = $this->language->get('lang_text_payable') . "\n";
        $comment.= $this->config->get('check_payable') . "\n\n";
        $comment.= $this->language->get('lang_text_address') . "\n";
        $comment.= $this->config->get('config_address') . "\n\n";
        $comment.= $this->language->get('lang_text_payment') . "\n";
        
        $data['comment'] = $comment;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('check_order_status_id'), $data['comment'], true);
    }
}
