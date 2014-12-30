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

class Voucher extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('account/voucher');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        if (!isset($this->session->data['vouchers'])) {
            $this->session->data['vouchers'] = array();
        }
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->session->data['vouchers'][mt_rand() ] = array('description' => sprintf($this->language->get('text_for'), $this->currency->format($this->currency->convert($this->request->post['amount'], $this->currency->getCode(), $this->config->get('config_currency'))), $this->request->post['to_name']), 'to_name' => $this->request->post['to_name'], 'to_email' => $this->request->post['to_email'], 'from_name' => $this->request->post['from_name'], 'from_email' => $this->request->post['from_email'], 'voucher_theme_id' => $this->request->post['voucher_theme_id'], 'message' => $this->request->post['message'], 'amount' => $this->currency->convert($this->request->post['amount'], $this->currency->getCode(), $this->config->get('config_currency')));
            
            $this->response->redirect($this->url->link('account/voucher/success'));
        }
        
        $this->breadcrumb->add('text_account', 'account/dashboard', null, true, 'SSL');
        $this->breadcrumb->add('text_voucher', 'account/voucher', null, true, 'SSL');
        
        $data['entry_amount'] = sprintf($this->language->get('entry_amount'), $this->currency->format($this->config->get('config_voucher_min')), $this->currency->format($this->config->get('config_voucher_max')));
        
        $data['button_continue'] = $this->language->get('button_continue');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['to_name'])) {
            $data['error_to_name'] = $this->error['to_name'];
        } else {
            $data['error_to_name'] = '';
        }
        
        if (isset($this->error['to_email'])) {
            $data['error_to_email'] = $this->error['to_email'];
        } else {
            $data['error_to_email'] = '';
        }
        
        if (isset($this->error['from_name'])) {
            $data['error_from_name'] = $this->error['from_name'];
        } else {
            $data['error_from_name'] = '';
        }
        
        if (isset($this->error['from_email'])) {
            $data['error_from_email'] = $this->error['from_email'];
        } else {
            $data['error_from_email'] = '';
        }
        
        if (isset($this->error['theme'])) {
            $data['error_theme'] = $this->error['theme'];
        } else {
            $data['error_theme'] = '';
        }
        
        if (isset($this->error['amount'])) {
            $data['error_amount'] = $this->error['amount'];
        } else {
            $data['error_amount'] = '';
        }
        
        $data['action'] = $this->url->link('account/voucher', '', 'SSL');
        
        if (isset($this->request->post['to_name'])) {
            $data['to_name'] = $this->request->post['to_name'];
        } else {
            $data['to_name'] = '';
        }
        
        if (isset($this->request->post['to_email'])) {
            $data['to_email'] = $this->request->post['to_email'];
        } else {
            $data['to_email'] = '';
        }
        
        if (isset($this->request->post['from_name'])) {
            $data['from_name'] = $this->request->post['from_name'];
        } elseif ($this->customer->isLogged()) {
            $data['from_name'] = $this->customer->getFirstName() . ' ' . $this->customer->getLastName();
        } else {
            $data['from_name'] = '';
        }
        
        if (isset($this->request->post['from_email'])) {
            $data['from_email'] = $this->request->post['from_email'];
        } elseif ($this->customer->isLogged()) {
            $data['from_email'] = $this->customer->getEmail();
        } else {
            $data['from_email'] = '';
        }
        
        $this->theme->model('checkout/voucher_theme');
        
        $data['voucher_themes'] = $this->model_checkout_voucher_theme->getVoucherThemes();
        
        if (isset($this->request->post['voucher_theme_id'])) {
            $data['voucher_theme_id'] = $this->request->post['voucher_theme_id'];
        } else {
            $data['voucher_theme_id'] = '';
        }
        
        if (isset($this->request->post['message'])) {
            $data['message'] = $this->request->post['message'];
        } else {
            $data['message'] = '';
        }
        
        if (isset($this->request->post['amount'])) {
            $data['amount'] = $this->request->post['amount'];
        } else {
            $data['amount'] = $this->currency->format(25, $this->config->get('config_currency'), false, false);
        }
        
        if (isset($this->request->post['agree'])) {
            $data['agree'] = $this->request->post['agree'];
        } else {
            $data['agree'] = false;
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('account/voucher', $data));
    }
    
    public function success() {
        $data = $this->theme->language('account/voucher');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->breadcrumb->add('heading_title', 'account/voucher', null, true, 'SSL');
        
        $data['continue'] = $this->url->link('checkout/cart');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('common/success', $data));
    }
    
    protected function validate() {
        if ((utf8_strlen($this->request->post['to_name']) < 1) || (utf8_strlen($this->request->post['to_name']) > 64)) {
            $this->error['to_name'] = $this->language->get('error_to_name');
        }
        
        if ((utf8_strlen($this->request->post['to_email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['to_email'])) {
            $this->error['to_email'] = $this->language->get('error_email');
        }
        
        if ((utf8_strlen($this->request->post['from_name']) < 1) || (utf8_strlen($this->request->post['from_name']) > 64)) {
            $this->error['from_name'] = $this->language->get('error_from_name');
        }
        
        if ((utf8_strlen($this->request->post['from_email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['from_email'])) {
            $this->error['from_email'] = $this->language->get('error_email');
        }
        
        if (!isset($this->request->post['voucher_theme_id'])) {
            $this->error['theme'] = $this->language->get('error_theme');
        }
        
        if (($this->currency->convert($this->request->post['amount'], $this->currency->getCode(), $this->config->get('config_currency')) < $this->config->get('config_voucher_min')) || ($this->currency->convert($this->request->post['amount'], $this->currency->getCode(), $this->config->get('config_currency')) > $this->config->get('config_voucher_max'))) {
            $this->error['amount'] = sprintf($this->language->get('error_amount'), $this->currency->format($this->config->get('config_voucher_min')), $this->currency->format($this->config->get('config_voucher_max')) . ' ' . $this->currency->getCode());
        }
        
        if (!isset($this->request->post['agree'])) {
            $this->error['warning'] = $this->language->get('error_agree');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
