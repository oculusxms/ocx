<?php

namespace Admin\Controller\Report;
use Oculus\Engine\Controller;

class Customercredit extends Controller {
	public function index() {     
		$data = $this->theme->language('report/customer_credit');
		$this->theme->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['filter_date_start'])) {
			$filter_date_start = $this->request->get['filter_date_start'];
		} else {
			$filter_date_start = '';
		}

		if (isset($this->request->get['filter_date_end'])) {
			$filter_date_end = $this->request->get['filter_date_end'];
		} else {
			$filter_date_end = '';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_date_start'])) {
			$url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
		}

		if (isset($this->request->get['filter_date_end'])) {
			$url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->breadcrumb->add('heading_title', 'report/customercredit', $url);
		
		$this->theme->model('report/customer');

		$data['customers'] = array();

		$filter = array(
			'filter_date_start'	=> $filter_date_start, 
			'filter_date_end'	=> $filter_date_end, 
			'start'             => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'             => $this->config->get('config_admin_limit')
		);

		$customer_total = $this->model_report_customer->getTotalCredit($filter); 

		$results = $this->model_report_customer->getCredit($filter);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('people/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, 'SSL')
			);

			$data['customers'][] = array(
				'customer'       => $result['customer'],
				'email'          => $result['email'],
				'customer_group' => $result['customer_group'],
				'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'total'          => $this->currency->format($result['total'], $this->config->get('config_currency')),
				'action'         => $action
			);
		}

		$data['token'] = $this->session->data['token'];

		$url = '';

		if (isset($this->request->get['filter_date_start'])) {
			$url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
		}

		if (isset($this->request->get['filter_date_end'])) {
			$url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
		}
		
		$data['pagination'] = $this->theme->paginate(
			$customer_total,
			$page,
			$this->config->get('config_admin_limit'),
			$this->language->get('text_pagination'),
			$this->url->link('report/customercredit', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL')
		);

		$data['filter_date_start'] 	= $filter_date_start;
		$data['filter_date_end'] 	= $filter_date_end;	
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);	

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('report/customer_credit', $data));
	}
}