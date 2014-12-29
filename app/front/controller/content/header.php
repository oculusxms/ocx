<?php

namespace Front\Controller\Content;
use Oculus\Engine\Controller;

class Header extends Controller {
	public function index() {
		$data['title'] = $this->theme->getTitle();

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (isset($this->session->data['error']) && !empty($this->session->data['error'])) {
			$data['error'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} else {
			$data['error'] = '';
		}
		
		$this->css->register('ocx')
			->register('plugin', 'ocx')
			->register('blog', 'plugin')
			->register('calendar', 'blog')
			->register('video', 'calendar', true);

		$data['base'] 		 = $server;
		$data['description'] = $this->theme->getDescription();
		$data['keywords'] 	 = $this->theme->getKeywords();
		$data['links'] 		 = $this->theme->getLinks();
		$data['lang'] 		 = $this->language->get('code');
		$data['direction'] 	 = $this->language->get('direction');
		$data['name'] 		 = $this->config->get('config_name');

		if ($this->config->get('config_icon') && file_exists($this->app['path.image'] . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if ($this->config->get('config_logo') && file_exists($this->app['path.image'] . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		// add our social graph here
		// set open graph props dynamically
		if (isset($this->request->get['_route_'])):
			$canonical_route = $this->request->get['_route_'];
		else:
			$canonical_route = '';
		endif;
		
		$this->theme->setCanonical($data['base'] . $canonical_route);
		$this->theme->setOgTitle($data['title']);
		$this->theme->setOgSite($this->config->get('config_name'));
		$this->theme->setOgUrl($data['base'] . $canonical_route);
		
		// set these as defaults, but these need to be updated in each controller
		// to set specific types and images when needed.
		
		if(!$this->theme->getOgType()):
			$this->theme->setOgType('website');
		endif;
		
		// og:image should always be at least 200px by 200px
		if (!$this->theme->getOgImage()):
			$this->theme->setOgImage($server . 'image/data/site-thumb.png');
		endif;
		
		// og:description set to meta description if not present
		if (!$this->theme->getOgDescription()):
			$this->theme->setOgDescription($data['description']);
		endif;
		
		// push these now to the header file
		$data['canonical'] 		= $this->theme->getCanonical();
		$data['og_image'] 		= $this->theme->getOgImage();
		$data['og_type'] 		= $this->theme->getOgType();
		$data['og_site_name'] 	= $this->theme->getOgSite();
		$data['og_title'] 		= $this->theme->getOgTitle();
		$data['og_url'] 		= $this->theme->getOgUrl();
		$data['og_description'] = $this->theme->getOgDescription();			

		$data = $this->theme->language('content/header', $data);

		$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['text_welcome']  = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		$data['text_logged']   = sprintf($this->language->get('text_logged'), $this->url->link('account/dashboard', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		if ($this->theme->style === 'shop'):
			$data['home'] 			= $this->url->link('shop/home');
			$data['alternate'] 		= $this->url->link('content/home');
			$data['text_alternate'] = $this->language->get('text_blog');
			$data['text_nav'] 		= $this->language->get('nav_blog');
		else:
			$data['home'] 			= $this->url->link('content/home');
			$data['alternate'] 		= $this->url->link('shop/home');
			$data['text_alternate'] = $this->language->get('text_shop');
			$data['text_nav'] 		= $this->language->get('nav_shop');
		endif;

		$data['blog_link'] = false;

		if ($this->config->get('config_home_page')):
			$data['blog_link'] = $this->url->link('content/home');
		endif;

		$homeroute 				= false;
		$data['schema_type'] 	= 'Article';

		if (!isset($this->request->get['route']) || $this->request->get['route'] == 'content/home'):
			$homeroute = true;
		endif;

		if ($homeroute):
			$data['schema_type'] = 'Website';
		endif;
		
		$data['wishlist'] 		= $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] 		= $this->customer->isLogged();
		$data['account'] 		= $this->url->link('account/dashboard', '', 'SSL');
		$data['shopping_cart'] 	= $this->url->link('checkout/cart');
		$data['checkout'] 		= $this->url->link('checkout/checkout', '', 'SSL');
		
		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// A dirty hack to try to set a cookie for the multi-store feature
		$this->theme->model('setting/store');

		$data['stores'] = array();

		if ($this->config->get('config_shared') && $status) {
			$data['stores'][] = $server . 'asset/' . strtolower($this->theme->name) . '/js/crossdomain.php?session_id=' . $this->session->getId();

			$stores = $this->model_setting_store->getStores();

			foreach ($stores as $store) {
				$data['stores'][] = $store['url'] . 'asset/' . strtolower($this->theme->name) . '/js/crossdomain.php?session_id=' . $this->session->getId();
			}
		}

		// Search		
		if (isset($this->request->get['search'])) {
			$data['search'] = $this->request->get['search'];
		} else {
			$data['search'] = '';
		}

		// Menu
		// $this->theme->model('catalog/category');

		// $this->theme->model('catalog/product');

		// $data['categories'] = array();

		// $categories = $this->model_catalog_category->getCategories(0);

		// foreach ($categories as $category) {
		// 	if ($category['top']) {
		// 		// Level 2
		// 		$children_data = array();

		// 		$children = $this->model_catalog_category->getCategories($category['category_id']);

		// 		foreach ($children as $child) {
		// 			$filter = array(
		// 				'filter_category_id'  => $child['category_id'],
		// 				'filter_sub_category' => true
		// 			);

		// 			$product_total = $this->model_catalog_product->getTotalProducts($filter);

		// 			$children_data[] = array(
		// 				'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
		// 				'href'  => $this->url->link('catalog/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
		// 			);						
		// 		}

		// 		// Level 1
		// 		$data['categories'][] = array(
		// 			'name'     => $category['name'],
		// 			'children' => $children_data,
		// 			'column'   => $category['column'] ? $category['column'] : 1,
		// 			'href'     => $this->url->link('catalog/category', 'path=' . $category['category_id'])
		// 		);
		// 	}
		// }
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data['css_link'] = $this->url->link('common/css', '&css=' . $this->css->compile(), 'SSL');
		
		$data['language'] 	= $this->theme->controller('widget/language');
		$data['currency'] 	= $this->theme->controller('widget/currency');
		$data['cart'] 		= $this->theme->controller('shop/cart');
		$data['menu'] 		= $this->theme->controller('widget/headermenu');

		return $this->theme->view('content/header', $data);
	} 	
}