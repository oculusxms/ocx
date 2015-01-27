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
use Oculus\Library\Mail;
use Oculus\Library\Template;

class Forgotten extends Controller {
    private $error = array();
    
    public function index() {
        if ($this->customer->isLogged()) {
            $this->response->redirect($this->url->link('account/dashboard', '', 'SSL'));
        }
        
        $data = $this->theme->language('account/forgotten');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('account/customer');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $data = $this->theme->language('mail/forgotten', $data);
            
            $customer = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);

            $to_name  = $customer['firstname'] . ' ' . $customer['lastname'];

            $password = substr(sha1(uniqid(mt_rand(), true)), 0, 10);
            
            $this->model_account_customer->editPassword($this->request->post['email'], $password);

            // NEW MAILER
            // public_customer_forgotten
            
            // $template = new Template($this->app);
            // $template->data = $this->theme->language('mail/forgotten', $data);
            
            // $template->data['title'] = sprintf($this->language->get('text_greeting'), $this->config->get('config_name'));
            // $template->data['password'] = $password;
            // $template->data['account_login'] = $this->url->link('account/login', '', 'SSL');
            
            // $html = $template->fetch('mail/customer_forgotten');
            
            // $subject = sprintf($this->language->get('text_subject'), $this->config->get('config_name'));
            
            // $message = sprintf($this->language->get('text_greeting'), $this->config->get('config_name')) . "\n\n";
            // $message.= $this->language->get('text_new_password') . "\n\n";
            // $message.= $password;

            // $text = sprintf($this->language->get('email_template'), $message);
            
            // $this->mailer->build(
            //     html_entity_decode($subject, ENT_QUOTES, 'UTF-8'), 
            //     $this->request->post['email'], 
            //     $to_name,
            //     $text,
            //     $html,
            //     true
            // );
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }
        
        $this->breadcrumb->add('text_forgotten', 'account/forgotten', null, true, 'SSL');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $data['action'] = $this->url->link('account/forgotten', '', 'SSL');
        
        $data['back'] = $this->url->link('account/login', '', 'SSL');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('account/forgotten', $data));
    }
    
    protected function validate() {
        if (!isset($this->request->post['email'])) {
            $this->error['warning'] = $this->language->get('error_email');
        } elseif (!$this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
            $this->error['warning'] = $this->language->get('error_email');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
