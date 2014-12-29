<?php

namespace Front\Controller\Widget;
use Oculus\Engine\Controller;
  
class Footerblocks extends Controller {
	private $items = array();

	public function index() {
		$this->theme->model('design/layout');
		$this->theme->model('setting/menu');

		if (isset($this->request->get['route'])):
			$route = (string)$this->request->get['route'];
		else:
			$route = $this->theme->style . '/home';
		endif;

		$layout_id = $this->model_design_layout->getLayout($route);

		/**
		 * All routes for footers should be either shop/ or content/ by default.
		 * Split the route and use the first piece with trailing slash
		 * and fetch all ids for the layout slug.
		 */

		$routes   = explode('/', $route);
		$layout   = $routes[0] . '/';

		$layouts  = $this->model_setting_menu->getLayouts($layout);

		switch($routes[0]):
			case 'account':
			case 'affiliate':
			case 'content':
			case 'error':
			case 'feed':
			case 'tool':
				$position = 'content_footer';
				break;
			case 'catalog':
			case 'checkout':
			case 'shop':
			case 'payment':
				$position = 'shop_footer';
				break;
			default:
				$position = 'content_footer';
		endswitch;

		
		$data['menu_blocks'] = array();
		$menus 				 = array();
		$widgets 			 = array();
		$all_widgets		 = array();

		$all_widgets = $this->config->get('footerblocks_widget');
		
		if ($all_widgets):
			foreach ($all_widgets as $widget):
				if ($widget['position'] === $position and $widget['layout_id'] === $layout_id and $widget['status']):
					$widgets[] = $widget;
				endif;
			endforeach;
		endif;

		if (empty($widgets) and $all_widgets):
			$layout_id = $this->model_setting_menu->getDefault();

			foreach ($all_widgets as $widget):
				if ($widget['position'] === $position and $widget['layout_id'] === $layout_id and $widget['status']):
					$widgets[] = $widget;
				endif;
			endforeach;
		endif;

		if ($widgets):
			foreach ($widgets as $widget):
				if ($widget['layout_id'] == $layout_id and $widget['position'] == $position and $widget['status']):
					$menus[] = $this->model_setting_menu->getMenu($widget['menu_id']);
				endif;
			endforeach;
		endif;
				
		/**
		 * adjust boostrap column widths based on
		 * total of blocks to be rendered.
		 * @var int $count
		 * @var int $class
		 */
		
		$count = count($menus);
		switch ($count):
			case 1:
				$class = 12;
				break;
			case 2:
				$class = 6;
				break;
			case 3:
				$class = 4;
				break;
			case 4:
				$class = 3;
				break;
			case $count > 4:
				$class = 3;
				break;
		endswitch;

		foreach ($menus as $menu):
			$block 						= array();
			$this->items[$menu['type']] = $menu['items'];
			$block['class'] 			= $class;
			$block['menu_name']  		= $menu['name'];
			$block['menu_items'] 		= $this->{$menu['type']}();
			$data['menu_blocks'][] 		= $block;
		endforeach;

		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		return $this->theme->view('widget/footerblocks', $data);
	}

	private function product_category () {
		$this->theme->model('catalog/category');
		
		$menu_items = array();
		
		$categories = $this->model_catalog_category->getCategories(0);
		
		foreach ($categories as $category):
			$children_data = array();

			$children = $this->model_catalog_category->getCategories($category['category_id']);

			foreach ($children as $child):
				if (in_array($child['category_id'], $this->items['product_category'])):
					$children_data[] = array(
						'id'	=> $child['category_id'],
						'name'  => $child['name'],
						'href'  => $this->url->link('catalog/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				endif;				
			endforeach;

			if (in_array($category['category_id'], $this->items['product_category'])):
				$menu_items[] = array(
					'id'		=> $category['category_id'],
					'name'     	=> $category['name'],
					'children' 	=> $children_data,
					'column'   	=> $category['column'] ? $category['column'] : 1,
					'href'     	=> $this->url->link('catalog/category', 'path=' . $category['category_id'])
				);
			endif;
		endforeach;
		
		return $menu_items;
	}

	private function content_category () {
		$this->theme->model('content/category');

		$menu_items = array();

		$categories = $this->model_content_category->getCategories(0);

		foreach ($categories as $category):
			$children_data = array();

			$children = $this->model_content_category->getCategories($category['category_id']);

			foreach ($children as $child):
				if (in_array($child['category_id'], $this->items['content_category'])):
					$children_data[] = array(
						'id'	=> $child['category_id'],
						'name'  => $child['name'],
						'href'  => $this->url->link('content/category', 'bpath=' . $category['category_id'] . '_' . $child['category_id'])
					);
				endif;				
			endforeach;

			if (in_array($category['category_id'], $this->items['content_category'])):
				$menu_items[] = array(
					'id'	   	=> $category['category_id'],
					'name'     	=> $category['name'],
					'children' 	=> $children_data,
					'column'   	=> $category['column'] ? $category['column'] : 1,
					'href'     	=> $this->url->link('content/category', 'bpath=' . $category['category_id'])
				);
			endif;
		endforeach;

		return $menu_items;
	}

	private function page() {
		$this->theme->model('content/page');

		$menu_items = array();

		$pages = $this->model_content_page->getPages();

		foreach ($pages as $page):
			if (in_array($page['page_id'], $this->items['page'])):
				$menu_items[] = array(
					'name' 	=> $page['title'],
					'href'  => $this->url->link('content/page', 'page_id=' . $page['page_id'])
				);
			endif;
		endforeach;

		return $menu_items;
	}

	private function post() {
		$this->theme->model('content/post');

		$menu_items = array();

		$posts = $this->model_content_post->getPosts();
		
		foreach ($posts as $post):
			if (in_array($post['post_id'], $this->items['post'])):
				$menu_items[] = array(
					'name' 	=> $post['name'],
					'href'  => $this->url->link('content/post', 'post_id=' . $post['post_id'])
				);
			endif;
		endforeach;

		return $menu_items;
	}

	private function custom() {
		/**
		 * custom hack for changing Dashboard/Login text
		 * safe to remove.
		 */
		$this->theme->language('shop/footer');

		$menu_items = array();

		$items = $this->items['custom'];

		foreach ($items as $item):
			$link = array();

			/**
			 * custom hack for changing Dashboard/Login text
			 * safe to remove.
			 */
			if ($item['name'] === $this->language->get('text_dashboard')):
				$item['name'] = ($this->customer->isLogged()) ? $this->language->get('text_dashboard') : $this->language->get('text_login');
			endif;

			if (strpos($item['href'], 'http') === false and strpos($item['href'], 'https') === false):
				$link['href'] = $this->url->link($item['href']);
				$link['name'] = $item['name'];
			else:
				$link['external'] = $this->url->external($item['href'], $item['name']);
			endif;
			$menu_items[] = $link;
		endforeach;
		
		return $menu_items;
	}
}