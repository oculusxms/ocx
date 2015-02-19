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

namespace Front\Controller\Affiliate;
use Oculus\Engine\Controller;

class Payment extends Controller {
    
    public function index() {
        if (!$this->affiliate->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('affiliate/payment', '', 'SSL');
            
            $this->response->redirect($this->url->link('affiliate/login', '', 'SSL'));
        }
        
        $data = $this->theme->language('affiliate/payment');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('affiliate/affiliate');
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $this->model_affiliate_affiliate->editPayment($this->request->post);
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $this->response->redirect($this->url->link('affiliate/account', '', 'SSL'));
        }
        
        $this->breadcrumb->add('lang_text_account', 'affiliate/account', null, true, 'SSL');
        $this->breadcrumb->add('lang_text_payment', 'affiliate/payment', null, true, 'SSL');
        
        $data['action'] = $this->url->link('affiliate/payment', '', 'SSL');
        
        if ($this->request->server['REQUEST_METHOD'] != 'POST') {
            $affiliate_info = $this->model_affiliate_affiliate->getAffiliate($this->affiliate->getId());
        }
        
        if (isset($this->request->post['tax'])) {
            $data['tax'] = $this->request->post['tax'];
        } elseif (!empty($affiliate_info)) {
            $data['tax'] = $affiliate_info['tax'];
        } else {
            $data['tax'] = '';
        }
        
        if (isset($this->request->post['payment'])) {
            $data['payment'] = $this->request->post['payment'];
        } elseif (!empty($affiliate_info)) {
            $data['payment'] = $affiliate_info['payment'];
        } else {
            $data['payment'] = 'check';
        }
        
        if (isset($this->request->post['check'])) {
            $data['check'] = $this->request->post['check'];
        } elseif (!empty($affiliate_info)) {
            $data['check'] = $affiliate_info['check'];
        } else {
            $data['check'] = '';
        }
        
        if (isset($this->request->post['paypal'])) {
            $data['paypal'] = $this->request->post['paypal'];
        } elseif (!empty($affiliate_info)) {
            $data['paypal'] = $affiliate_info['paypal'];
        } else {
            $data['paypal'] = '';
        }
        
        if (isset($this->request->post['bank_name'])) {
            $data['bank_name'] = $this->request->post['bank_name'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_name'] = $affiliate_info['bank_name'];
        } else {
            $data['bank_name'] = '';
        }
        
        if (isset($this->request->post['bank_branch_number'])) {
            $data['bank_branch_number'] = $this->request->post['bank_branch_number'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_branch_number'] = $affiliate_info['bank_branch_number'];
        } else {
            $data['bank_branch_number'] = '';
        }
        
        if (isset($this->request->post['bank_swift_code'])) {
            $data['bank_swift_code'] = $this->request->post['bank_swift_code'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_swift_code'] = $affiliate_info['bank_swift_code'];
        } else {
            $data['bank_swift_code'] = '';
        }
        
        if (isset($this->request->post['bank_account_name'])) {
            $data['bank_account_name'] = $this->request->post['bank_account_name'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_account_name'] = $affiliate_info['bank_account_name'];
        } else {
            $data['bank_account_name'] = '';
        }
        
        if (isset($this->request->post['bank_account_number'])) {
            $data['bank_account_number'] = $this->request->post['bank_account_number'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_account_number'] = $affiliate_info['bank_account_number'];
        } else {
            $data['bank_account_number'] = '';
        }
        
        $data['back'] = $this->url->link('affiliate/account', '', 'SSL');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('affiliate/payment', $data));
    }
}
