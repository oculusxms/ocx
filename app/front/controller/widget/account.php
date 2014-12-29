<?php

namespace Front\Controller\Widget;
use Oculus\Engine\Controller;
  
class Account extends Controller {
	public function index() {
		$data = $this->theme->language('widget/account');

		$data['logged'] 		= $this->customer->isLogged();
		$data['register'] 		= $this->url->link('account/register', '', 'SSL');
		$data['login'] 			= $this->url->link('account/login', '', 'SSL');
		$data['logout'] 		= $this->url->link('account/logout', '', 'SSL');
		$data['forgotten'] 		= $this->url->link('account/forgotten', '', 'SSL');
		$data['account'] 		= $this->url->link('account/dashboard', '', 'SSL');
		$data['edit'] 			= $this->url->link('account/edit', '', 'SSL');
		$data['password'] 		= $this->url->link('account/password', '', 'SSL');
		$data['address'] 		= $this->url->link('account/address', '', 'SSL');
		$data['wishlist'] 		= $this->url->link('account/wishlist');
		$data['order'] 			= $this->url->link('account/order', '', 'SSL');
		$data['download'] 		= ($this->config->get('config_download')) ? $this->url->link('account/download', '', 'SSL') : false;
		$data['reward'] 		= ($this->config->get('reward_status')) ? $this->url->link('account/reward', '', 'SSL') : false;
		$data['return'] 		= $this->url->link('account/returns', '', 'SSL');
		$data['transaction'] 	= $this->url->link('account/transaction', '', 'SSL');
		$data['newsletter'] 	= $this->url->link('account/newsletter', '', 'SSL');
		$data['recurring'] 		= $this->url->link('account/recurring', '', 'SSL');

		if (!empty($this->customer->getCustomerProducts())):
			$data['product'] = $this->url->link('account/product', '', 'SSL');
		else:
			$data['product'] =  false;
		endif;
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		return $this->theme->view('widget/account', $data);
	}
}