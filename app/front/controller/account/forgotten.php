<?php

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

			$password = substr(sha1(uniqid(mt_rand(), true)), 0, 10);

			$this->model_account_customer->editPassword($this->request->post['email'], $password);
			
			$template = new Template($this->app);
			$template->data = $this->theme->language('mail/forgotten', $data);

			$template->data['title'] 			= sprintf($this->language->get('text_greeting'), $this->config->get('config_name'));
			$template->data['password'] 		= $password;
			$template->data['account_login'] 	= $this->url->link('account/login', '', 'SSL');

			$html = $template->fetch('mail/customer_forgotten');

			$subject = sprintf($this->language->get('text_subject'), $this->config->get('config_name'));

			$message  = sprintf($this->language->get('text_greeting'), $this->config->get('config_name')) . "\n\n";
			$message .= $this->language->get('text_password') . "\n\n";
			$message .= $password;

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');				
			$mail->setTo($this->request->post['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender($this->config->get('config_name'));
			$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml($html);
			$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			$mail->send();

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->breadcrumb->add('text_forgotten', 'account/forgotten', NULL, true, 'SSL');
		
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