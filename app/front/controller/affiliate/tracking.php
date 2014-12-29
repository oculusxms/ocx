<?php

namespace Front\Controller\Affiliate;
use Oculus\Engine\Controller;

class Tracking extends Controller { 
	public function index() {
		if (!$this->affiliate->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('affiliate/tracking', '', 'SSL');

			$this->response->redirect($this->url->link('affiliate/login', '', 'SSL'));
		}

		$data = $this->theme->language('affiliate/tracking');
		
		$this->javascript->register('typeahead.min', 'bootstrap.min');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('text_account', 'affiliate/account', NULL, true, 'SSL');
		$this->breadcrumb->add('heading_title', 'affiliate/tracking', NULL, true, 'SSL');

		$data['text_description'] = sprintf($this->language->get('text_description'), $this->config->get('config_name'));

		$data['code'] = $this->affiliate->getCode();

		$data['continue'] = $this->url->link('affiliate/account', '', 'SSL');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$this->theme->set_controller('header', 'shop/header');
		$this->theme->set_controller('footer', 'shop/footer');
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('affiliate/tracking', $data));		
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->theme->model('catalog/product');

			$filter = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);

			$results = $this->model_catalog_product->getProducts($filter);

			foreach ($results as $result) {
				$json[] = array(
					'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'link' => str_replace('&amp;', '&', $this->url->link('catalog/product', 'product_id=' . $result['product_id'] . '&tracking=' . $this->affiliate->getCode()))			
				);	
			}
		}
		
		$json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);

		$this->response->setOutput(json_encode($json));
	}
}