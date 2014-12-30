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


namespace Front\Controller\Account;
use Oculus\Engine\Controller;

class Logout extends Controller {
    public function index() {
        if ($this->customer->isLogged()) {
            
            $customer_id = $this->customer->getId();
            
            $this->customer->logout();
            $this->cart->clear();
            
            unset($this->session->data['wishlist']);
            unset($this->session->data['shipping_address_id']);
            unset($this->session->data['shipping_country_id']);
            unset($this->session->data['shipping_zone_id']);
            unset($this->session->data['shipping_postcode']);
            unset($this->session->data['shipping_method']);
            unset($this->session->data['shipping_methods']);
            unset($this->session->data['payment_address_id']);
            unset($this->session->data['payment_country_id']);
            unset($this->session->data['payment_zone_id']);
            unset($this->session->data['payment_method']);
            unset($this->session->data['payment_methods']);
            unset($this->session->data['comment']);
            unset($this->session->data['order_id']);
            unset($this->session->data['coupon']);
            unset($this->session->data['reward']);
            unset($this->session->data['voucher']);
            unset($this->session->data['vouchers']);
            
            $this->theme->trigger('customer_logout', array('customer_id' => $customer_id));
            
            $this->response->redirect($this->url->link('account/logout', '', 'SSL'));
        }
        
        $data = $this->theme->language('account/logout');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        if ($this->customer->isLogged()):
            $this->breadcrumb->add('text_account', 'account/dashboard', null, true, 'SSL');
        endif;
        
        $this->breadcrumb->add('text_logout', 'account/logout', null, true, 'SSL');
        
        $data['continue'] = $this->url->link('shop/home');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('common/success', $data));
    }
}
