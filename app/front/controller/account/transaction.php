<?php

namespace Front\Controller\Account;
use Oculus\Engine\Controller;

class Transaction extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/transaction', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$data = $this->theme->language('account/transaction');
		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('text_account', 'account/dashboard', NULL, true, 'SSL');
		$this->breadcrumb->add('text_transaction', 'account/transaction', NULL, true, 'SSL');

		$this->theme->model('account/transaction');

		$data['column_amount'] = sprintf($this->language->get('column_amount'), $this->config->get('config_currency'));

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}		

		$data['transactions'] = array();

		$filter = array(				  
			'sort'  => 'date_added',
			'order' => 'DESC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$transaction_total = $this->model_account_transaction->getTotalTransactions($filter);

		$results = $this->model_account_transaction->getTransactions($filter);

		foreach ($results as $result) {
			$data['transactions'][] = array(
				'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')),
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}	
		
		$data['pagination'] = $this->theme->paginate(
			$transaction_total,
			$page,
			10,
			$this->language->get('text_pagination'),
			$this->url->link('account/transaction', 'page={page}', 'SSL')
		);

		$data['total'] = $this->currency->format($this->customer->getBalance());

		$data['continue'] = $this->url->link('account/dashboard', '', 'SSL');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$this->theme->set_controller('header', 'shop/header');
		$this->theme->set_controller('footer', 'shop/footer');
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('account/transaction', $data));	
	} 		
}