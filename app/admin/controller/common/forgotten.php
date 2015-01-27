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

namespace Admin\Controller\Common;
use Oculus\Engine\Controller;

class Forgotten extends Controller {
    private $error = array();
    
    public function index() {
        if ($this->user->isLogged()) {
            $this->response->redirect($this->url->link('common/dashboard', '', 'SSL'));
        }
        
        if (!$this->config->get('config_password')) {
            $this->response->redirect($this->url->link('common/login', '', 'SSL'));
        }
        
        $data = $this->theme->language('common/forgotten');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('people/user');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $data = $this->theme->language('mail/forgotten', $data);
            
            $code = sha1(uniqid(mt_rand(), true));
            
            $this->model_people_user->editCode($this->request->post['email'], $code);

            // NEW MAILER
            // admin_forgotten_email
            
            // $subject = sprintf($this->language->get('text_subject'), $this->config->get('config_name'));
            
            // $message = sprintf($this->language->get('text_greeting'), $this->config->get('config_name')) . "\n\n";
            // $message.= sprintf($this->language->get('text_change'), $this->config->get('config_name')) . "\n\n";
            // $message.= $this->url->link('common/reset', 'code=' . $code, 'SSL') . "\n\n";
            // $message.= sprintf($this->language->get('text_ip'), $this->request->server['REMOTE_ADDR']) . "\n\n";
            
            // $mail = new Mail();
            // $mail->protocol = $this->config->get('config_mail_protocol');
            // $mail->parameter = $this->config->get('config_mail_parameter');
            // $mail->hostname = $this->config->get('config_smtp_host');
            // $mail->username = $this->config->get('config_smtp_username');
            // $mail->password = $this->config->get('config_smtp_password');
            // $mail->port = $this->config->get('config_smtp_port');
            // $mail->timeout = $this->config->get('config_smtp_timeout');
            // $mail->setTo($this->request->post['email']);
            // $mail->setFrom($this->config->get('config_email'));
            // $mail->setSender($this->config->get('config_name'));
            // $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
            // $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            // $mail->send();
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $this->response->redirect($this->url->link('common/login', '', 'SSL'));
        }
        
        $this->breadcrumb->add('text_forgotten', 'common/forgotten');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $data['action'] = $this->url->link('common/forgotten', '', 'SSL');
        
        $data['cancel'] = $this->url->link('common/login', '', 'SSL');
        
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } else {
            $data['email'] = '';
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('common/forgotten', $data));
    }
    
    protected function validate() {
        if (!isset($this->request->post['email'])) {
            $this->error['warning'] = $this->language->get('error_email');
        } elseif (!$this->model_people_user->getTotalUsersByEmail($this->request->post['email'])) {
            $this->error['warning'] = $this->language->get('error_email');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
