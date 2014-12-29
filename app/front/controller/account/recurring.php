<?php

namespace Front\Controller\Account;
use Oculus\Engine\Controller;

class Recurring extends Controller {
	public function index() {
		if (!$this->customer->isLogged()):
			$this->session->data['redirect'] = $this->url->link('account/order', '', 'SSL');
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		endif;

		$data = $this->theme->language('account/recurring');
		$this->theme->model('account/recurring');
		$this->theme->setTitle($this->language->get('heading_title'));

		$url = '';

		if (isset($this->request->get['page'])):
			$url .= '&page=' . $this->request->get['page'];
		endif;

		$this->breadcrumb->add('text_account', 'account/dashboard', $url, true, 'SSL');
		$this->breadcrumb->add('heading_title', 'account/recurring', $url, true, 'SSL');

		if (isset($this->request->get['page'])):
			$page = $this->request->get['page'];
		else:
			$page = 1;
		endif;

		$data['orders'] = array();

		$recurring_total = $this->model_account_recurring->getTotalRecurring();
		$results 		 = $this->model_account_recurring->getAllProfiles(($page - 1) * 10, 10);

		$data['recurrings'] = array();

		if ($results):
			foreach ($results as $result):
				$data['recurrings'][] = array(
					'id' 			=> $result['order_recurring_id'],
					'name'    		=> $result['product_name'],
					'status'    	=> $result['status'],
					'date_added' 	=> date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'href'      	=> $this->url->link('account/recurring/info', 'recurring_id=' . $result['order_recurring_id'], 'SSL'),
				);
			endforeach;
		endif;

		$data['status_types'] = array(
			1 => $this->language->get('text_status_inactive'),
			2 => $this->language->get('text_status_active'),
			3 => $this->language->get('text_status_suspended'),
			4 => $this->language->get('text_status_cancelled'),
			5 => $this->language->get('text_status_expired'),
			6 => $this->language->get('text_status_pending'),
		);

		$data['pagination'] = $this->theme->paginate(
			$recurring_total,
			$page,
			10,
			$this->language->get('text_pagination'),
			$this->url->link('account/recurring', 'page={page}', 'SSL')
		);

		$data['continue'] = $this->url->link('account/account', '', 'SSL');

		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$this->theme->set_controller('header', 'shop/header');
		$this->theme->set_controller('footer', 'shop/footer');
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('account/recurring_list', $data));
	}

	public function info() {
		$data = $this->theme->language('account/recurring');
		$this->theme->model('account/recurring');

		if (isset($this->request->get['recurring_id'])):
			$recurring_id = $this->request->get['recurring_id'];
		else:
			$recurring_id = 0;
		endif;

		if (!$this->customer->isLogged()):
			$this->session->data['redirect'] = $this->url->link('account/recurring/info', 'recurring_id=' . $recurring_id, 'SSL');
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		endif;

		if (isset($this->session->data['error'])):
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		else:
			$data['error_warning'] = '';
		endif;

		if (isset($this->session->data['success'])):
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		else:
			$data['success'] = '';
		endif;

		$recurring = $this->model_account_recurring->getProfile($this->request->get['recurring_id']);

		$data['status_types'] = array(
			1 => $this->language->get('text_status_inactive'),
			2 => $this->language->get('text_status_active'),
			3 => $this->language->get('text_status_suspended'),
			4 => $this->language->get('text_status_cancelled'),
			5 => $this->language->get('text_status_expired'),
			6 => $this->language->get('text_status_pending'),
		);

		$data['transaction_types'] = array(
			0 => $this->language->get('text_transaction_date_added'),
			1 => $this->language->get('text_transaction_payment'),
			2 => $this->language->get('text_transaction_outstanding_payment'),
			3 => $this->language->get('text_transaction_skipped'),
			4 => $this->language->get('text_transaction_failed'),
			5 => $this->language->get('text_transaction_cancelled'),
			6 => $this->language->get('text_transaction_suspended'),
			7 => $this->language->get('text_transaction_suspended_failed'),
			8 => $this->language->get('text_transaction_outstanding_failed'),
			9 => $this->language->get('text_transaction_expired'),
		);

		if ($recurring):
			$recurring['transactions'] 	= $this->model_account_recurring->getProfileTransactions($this->request->get['recurring_id']);
			$recurring['date_added'] 	= date($this->language->get('date_format_short'), strtotime($recurring['date_added']));
			$recurring['product_link'] 	= $this->url->link('product/product', 'product_id=' . $recurring['product_id'], 'SSL');
			$recurring['order_link'] 	= $this->url->link('account/order/info', 'order_id=' . $recurring['order_id'], 'SSL');

			$this->theme->setTitle($this->language->get('text_recurring'));

			$this->breadcrumb->add('text_account', 'account/dashboard', '', true, 'SSL');

			$url = '';

			if (isset($this->request->get['page'])):
				$url .= '&page=' . $this->request->get['page'];
			endif;

			$this->breadcrumb->add('heading_title', 'account/recurring', $url, true, 'SSL');
			$this->breadcrumb->add('text_recurring', 'account/recurring/info', 'recurring_id=' . $this->request->get['recurring_id'] . $url, true, 'SSL');

			$data['recurring'] = $recurring;

			$this->theme->loadjs('javascript/account/recurring_info', $data);
			
			$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
			
			$this->theme->set_controller('header', 'shop/header');
			$this->theme->set_controller('footer', 'shop/footer');
			$this->theme->set_controller('buttons', 'payment/' . $recurring['payment_code'] . '/recurringButtons');
			
			$data = $this->theme->render_controllers($data);

			$this->response->setOutput($this->theme->view('account/recurring_info', $data));

		else:
			$this->response->redirect($this->url->link('account/recurring', '', 'SSL'));
		endif;
	}
}
