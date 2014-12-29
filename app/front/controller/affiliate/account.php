<?php

namespace Front\Controller\Affiliate;
use Oculus\Engine\Controller; 

class Account extends Controller { 
	public function index() {
		if (!$this->affiliate->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('affiliate/account', '', 'SSL');

			$this->response->redirect($this->url->link('affiliate/login', '', 'SSL'));
		}

		$data = $this->theme->language('affiliate/account');

		$this->breadcrumb->add('text_account', 'affiliate/account', NULL, true, 'SSL');
		
		$this->theme->setTitle($this->language->get('heading_title'));

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['edit'] 		 = $this->url->link('affiliate/edit', '', 'SSL');
		$data['password'] 	 = $this->url->link('affiliate/password', '', 'SSL');
		$data['payment'] 	 = $this->url->link('affiliate/payment', '', 'SSL');
		$data['tracking'] 	 = $this->url->link('affiliate/tracking', '', 'SSL');
		$data['transaction'] = $this->url->link('affiliate/transaction', '', 'SSL');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$this->theme->set_controller('header', 'shop/header');
		$this->theme->set_controller('footer', 'shop/footer');
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('affiliate/account', $data));
	}
}