<?php 

namespace Front\Controller\Account;
use Oculus\Engine\Controller;

class Dashboard extends Controller { 
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/dashboard', '', 'SSL');
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		
		$data = $this->theme->language('account/dashboard');
		$this->theme->model('account/customer');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('text_account', 'account/dashboard', NULL, true, 'SSL');

		// let's find out if our member has their profile
		// and address filled in, if not, lets nag them.
		$this->checkProfile();
		
		if (isset($this->session->data['success'])):
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		else:
			$data['success'] = '';
		endif;

		if (isset($this->session->data['warning'])):
			$data['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		elseif(isset($this->error['warning'])):
			$data['warning'] = $this->error['warning'];
		else:
			$data['warning'] = '';
		endif;

		$data['edit'] 			= $this->url->link('account/edit', '', 'SSL');
		$data['password'] 		= $this->url->link('account/password', '', 'SSL');
		$data['address'] 		= $this->url->link('account/address', '', 'SSL');
		$data['wishlist'] 		= $this->url->link('account/wishlist');
		$data['order'] 			= $this->url->link('account/order', '', 'SSL');
		$data['return'] 		= $this->url->link('account/returns', '', 'SSL');
		$data['transaction'] 	= $this->url->link('account/transaction', '', 'SSL');
		$data['newsletter'] 	= $this->url->link('account/newsletter', '', 'SSL');
		$data['recurring'] 		= $this->url->link('account/recurring', '', 'SSL');
		$data['waitlist'] 		= $this->url->link('account/waitlist', '', 'SSL');


		if ($this->config->get('reward_status')):
			$data['reward'] = $this->url->link('account/reward', '', 'SSL');
		else:
			$data['reward'] = false;
		endif;
		
		if ($this->config->get('config_download')):
			$data['download'] = $this->url->link('account/download', '', 'SSL');
		else:
			$data['download'] = false;
		endif;
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$this->theme->set_controller('header', 'shop/header');
		$this->theme->set_controller('footer', 'shop/footer');
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('account/dashboard', $data));
	}

	private function checkProfile() {
		$this->theme->language('account/dashboard');

		$warning = '';
		
		if (!$this->session->data['profile_complete'])
			$warning .= sprintf($this->language->get('complete_profile'), $this->url->link('account/edit', '', 'SSL'));

		if (!$this->session->data['address_complete']):
			if ($warning !== '') $warning .= '<br>';

			$warning .= sprintf(
					$this->language->get('complete_address'), 
					$this->url->link('account/address/update', 'address_id=' . $this->customer->getAddressId(), 'SSL')
				);		
		endif;
		
		if ($warning !== '') $this->error['warning'] = $warning;
		
		return !$this->error;
	}
}
