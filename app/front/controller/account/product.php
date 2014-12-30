<?php

namespace Front\Controller\Account;
use Oculus\Engine\Controller;

class Product extends Controller {

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/product', '', 'SSL');
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$data = $this->theme->language('account/product');
		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('text_dashboard', 'account/dashboard', '', true, 'SSL');
		$this->breadcrumb->add('heading_title', 'account/product', '', true, 'SSL');

		$products = $this->customer->getCustomerProducts();

		$results = array();
		
		if (!empty($products)):
			$this->theme->model('account/product');
			foreach ($products as $product):
				$results[] = $this->model_account_product->getProduct($product['product_id'], $this->customer->getId());
			endforeach;
		else:
			return $this->response->redirect($this->url->link('account/dashboard', '', 'SSL'));
		endif;

		$this->theme->model('tool/image');

		$total = count($results);

		$data['products'] = array();
		
		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			} else {
				$image = false;
			}

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}

			if ((float)$result['special']) {
				$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$special = false;
			}	

			if ($this->config->get('config_tax')) {
				$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
			} else {
				$tax = false;
			}				

			if ($this->config->get('config_review_status')) {
				$rating = (int)$result['rating'];
			} else {
				$rating = false;
			}

			$data['products'][] = array(
				'product_id'  => $result['product_id'],
				'event_id'	  => $result['event_id'],
				'thumb'       => $image,
				'name'        => $result['name'],
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
				'price'       => $price,
				'special'     => $special,
				'tax'         => $tax,
				'rating'      => $result['rating'],
				'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
				'href'        => $this->url->link('catalog/product', 'product_id=' . $result['product_id'])
			);
		}

		$data['continue'] = $this->url->link('account/dashboard', '', 'SSL');

		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('account/customer_product', $data));
	}
}
