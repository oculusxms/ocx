<?php

namespace Front\Controller\Widget;
use Oculus\Engine\Controller;
  
class Affiliate extends Controller {
	public function index() {
		$data = $this->theme->language('widget/affiliate');

		$data['logged'] = $this->affiliate->isLogged();
		$data['register'] = $this->url->link('affiliate/register', '', 'SSL');
		$data['login'] = $this->url->link('affiliate/login', '', 'SSL');
		$data['logout'] = $this->url->link('affiliate/logout', '', 'SSL');
		$data['forgotten'] = $this->url->link('affiliate/forgotten', '', 'SSL');
		$data['account'] = $this->url->link('affiliate/account', '', 'SSL');
		$data['edit'] = $this->url->link('affiliate/edit', '', 'SSL');
		$data['password'] = $this->url->link('affiliate/password', '', 'SSL');
		$data['payment'] = $this->url->link('affiliate/payment', '', 'SSL');
		$data['tracking'] = $this->url->link('affiliate/tracking', '', 'SSL');
		$data['transaction'] = $this->url->link('affiliate/transaction', '', 'SSL');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		return $this->theme->view('widget/affiliate', $data);
	}
}