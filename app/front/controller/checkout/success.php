<?php

namespace Front\Controller\Checkout;
use Oculus\Engine\Controller;

class Success extends Controller { 
	public function index() { 	
		if (isset($this->session->data['order_id'])) {
			$this->cart->clear();

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);	
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
			unset($this->session->data['totals']);
		}	

		$data = $this->theme->language('checkout/success');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('text_basket', 'checkout/cart');
		$this->breadcrumb->add('text_checkout', 'checkout/checkout', NULL, true, 'SSL');
		$this->breadcrumb->add('text_success', 'checkout/success');
		
		if ($this->customer->isLogged()) {
			$data['text_message'] = sprintf($this->language->get('text_customer'), $this->url->link('account/dashboard', '', 'SSL'), $this->url->link('account/order', '', 'SSL'), $this->url->link('account/download', '', 'SSL'), $this->url->link('content/contact'));
		} else {
			$data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('content/contact'));
		}

		$data['continue'] = $this->url->link('shop/home');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$this->theme->set_controller('header', 'shop/header');
		$this->theme->set_controller('footer', 'shop/footer');
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('common/success', $data));
	}
}