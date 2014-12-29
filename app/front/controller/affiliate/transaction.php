<?php

namespace Front\Controller\Affiliate;
use Oculus\Engine\Controller;

class Transaction extends Controller {
	public function index() {
		if (!$this->affiliate->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('affiliate/transaction', '', 'SSL');

			$this->response->redirect($this->url->link('affiliate/login', '', 'SSL'));
		}

		$data = $this->theme->language('affiliate/transaction');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('text_account', 'affiliate/account', NULL, true, 'SSL');
		$this->breadcrumb->add('text_transaction', 'affiliate/transaction', NULL, true, 'SSL');

		$this->theme->model('affiliate/transaction');

		$data['column_amount'] = sprintf($this->language->get('column_amount'), $this->config->get('config_currency'));

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}		

		$data['transactions'] = array();

		$filter = array(				  
			'sort'  => 't.date_added',
			'order' => 'DESC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$transaction_total = $this->model_affiliate_transaction->getTotalTransactions($filter);

		$results = $this->model_affiliate_transaction->getTransactions($filter);

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
			$this->url->link('affiliate/transaction', 'page={page}', 'SSL')
		);

		$data['balance'] = $this->currency->format($this->model_affiliate_transaction->getBalance());

		$data['continue'] = $this->url->link('affiliate/account', '', 'SSL');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$this->theme->set_controller('header', 'shop/header');
		$this->theme->set_controller('footer', 'shop/footer');
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('affiliate/transaction', $data));		
	} 		
}