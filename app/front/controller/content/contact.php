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

namespace Front\Controller\Content;
use Oculus\Engine\Controller;
use Oculus\Library\Mail;
use Oculus\Library\Template;
use Front\Controller\Tool\Captcha;

class Contact extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('content/contact');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            unset($this->session->data['captcha']);
            
            $this->theme->language('mail/contact');

            $message  = $this->language->get('text_admin_message') . "\n\n";
            $message .= $this->language->get('text_name') . ' ' . $this->request->post['name'] . "\n";
            $message .= $this->language->get('text_email') . ' ' . $this->request->post['email'] . "\n";
            $message .= $this->language->get('text_enquiry') . "\n\n";
            $message .= strip_tags(html_entity_decode($this->request->post['enquiry'], ENT_QUOTES, 'UTF-8')) . "\n\n";

            $text = sprintf($this->language->get('email_template'), $message);

            $subject = html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8');

            $template = new Template($this->app);
            $template->data = $this->theme->language('mail/contact', $data);
            $template->data['title'] = $this->language->get('heading_title');
            $template->data['name'] = $this->request->post['name'];
            $template->data['email'] = $this->request->post['email'];
            $template->data['enquiry'] = html_entity_decode(str_replace("\n", "<br />", $this->request->post['enquiry']), ENT_QUOTES, 'UTF-8');
            
            $html = $template->fetch('mail/contact_admin');
            
            $this->mailer->build(
                $subject,
                $this->config->get('config_email'),
                $this->config->get('config_owner'),
                $text,
                false
            );

            $this->mailer->setFrom($this->config->get('config_email'), $this->language->get('email_title_server'));
            $this->mailer->send();
            
            unset($message);
            unset($text);
            unset($html);

            $message  = $this->language->get('entry_enquiry_customer') . "\n\n";
            $message .= $this->language->get('text_name') . ' ' . $this->request->post['name'] . "\n";
            $message .= $this->language->get('text_email') . ' ' . $this->request->post['email'] . "\n";
            $message .= $this->language->get('text_enquiry') . "\n\n";
            $message .= strip_tags(html_entity_decode($this->request->post['enquiry'], ENT_QUOTES, 'UTF-8')) . "\n\n";
            $message .= $this->language->get('entry_footer') . "\n\n";

            $text = sprintf($this->language->get('email_template'), $message);
            
            $html = $template->fetch('mail/contact');

            $this->mailer->build(
                $subject,
                $this->request->post['email'],
                $this->request->post['name'],
                $text,
                false,
                true
            );
            
            $this->response->redirect($this->url->link('content/contact/success'));
        }
        
        $this->breadcrumb->add('heading_title', 'content/contact');
        
        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }
        
        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
        }
        
        if (isset($this->error['enquiry'])) {
            $data['error_enquiry'] = $this->error['enquiry'];
        } else {
            $data['error_enquiry'] = '';
        }
        
        if (isset($this->error['captcha'])) {
            $data['error_captcha'] = $this->error['captcha'];
        } else {
            $data['error_captcha'] = '';
        }
        
        $data['action'] = $this->url->link('content/contact');
        $data['store'] = $this->config->get('config_name');
        $data['address'] = nl2br($this->config->get('config_address'));
        $data['telephone'] = $this->config->get('config_telephone');
        
        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } else {
            $data['name'] = $this->customer->getFirstName() . ' ' . $this->customer->getLastName();
        }
        
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } else {
            $data['email'] = $this->customer->getEmail();
        }
        
        if (isset($this->request->post['enquiry'])) {
            $data['enquiry'] = $this->request->post['enquiry'];
        } else {
            $data['enquiry'] = '';
        }
        
        if (isset($this->request->post['captcha'])) {
            $data['captcha'] = $this->request->post['captcha'];
        } else {
            $data['captcha'] = '';
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('content/contact', $data));
    }
    
    public function success() {
        $data = $this->theme->language('content/contact');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->breadcrumb->add('heading_title', 'content/contact');
        
        $data['continue'] = $this->url->link('shop/home');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('common/success', $data));
    }
    
    protected function validate() {
        if (($this->encode->strlen($this->request->post['name']) < 3) || ($this->encode->strlen($this->request->post['name']) > 32)) {
            $this->error['name'] = $this->language->get('error_name');
        }
        
        if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }
        
        if (($this->encode->strlen($this->request->post['enquiry']) < 10) || ($this->encode->strlen($this->request->post['enquiry']) > 3000)) {
            $this->error['enquiry'] = $this->language->get('error_enquiry');
        }
        
        if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
            $this->error['captcha'] = $this->language->get('error_captcha');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    public function captcha() {
        $captcha = new Captcha();
        
        $this->session->data['captcha'] = $captcha->getCode();
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $captcha->showImage();
    }
}
