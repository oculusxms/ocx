<?php

namespace Front\Controller\Account;
use Oculus\Engine\Controller;

class Reward extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/reward', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$data = $this->theme->language('account/reward');
		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('text_account', 'account/dashboard', NULL, true, 'SSL');
		$this->breadcrumb->add('text_reward', 'account/reward', NULL, true, 'SSL');

		$this->theme->model('account/reward');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}		

		$data['rewards'] = array();

		$filter = array(				  
			'sort'  => 'date_added',
			'order' => 'DESC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$reward_total = $this->model_account_reward->getTotalRewards($filter);

		$results = $this->model_account_reward->getRewards($filter);

		foreach ($results as $result) {
			$data['rewards'][] = array(
				'order_id'    => $result['order_id'],
				'points'      => $result['points'],
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'href'        => $this->url->link('account/order/info', 'order_id=' . $result['order_id'], 'SSL')
			);
		}	
		
		$data['pagination'] = $this->theme->paginate(
			$reward_total,
			$page,
			10,
			$this->language->get('text_pagination'),
			$this->url->link('account/reward', 'page={page}', 'SSL')
		);

		$data['total'] = (int)$this->customer->getRewardPoints();

		$data['continue'] = $this->url->link('account/dashboard', '', 'SSL');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$this->theme->set_controller('header', 'shop/header');
		$this->theme->set_controller('footer', 'shop/footer');
		
		$data = $this->theme->render_controllers($data);
		
		$this->response->setOutput($this->theme->view('account/reward', $data));	
	} 		
}