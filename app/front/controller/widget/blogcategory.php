<?php

namespace Front\Controller\Widget;
use Oculus\Engine\Controller;
 
class Blogcategory extends Controller {
	public function index($setting) {
		$data = $this->theme->language('widget/blogcategory');
		
    	$data['heading_title'] = $this->language->get('heading_title');
		
		if (isset($this->request->get['bpath'])) {
			$parts = explode('_', (string)$this->request->get['bpath']);
		} else {
			$parts = array();
		}
		
		if (isset($parts[0])) {
			$data['blog_category_id'] = $parts[0];
		} else {
			$data['blog_category_id'] = 0;
		}
		
		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}
							
		$this->theme->model('content/category');
		
		$data['blog_categories'] = array();

		$blog_categories = $this->model_content_category->getCategories(0);

		foreach ($blog_categories as $blog_category) {

			$children_data = array();

			$children = $this->model_content_category->getCategories($blog_category['category_id']);

			foreach ($children as $child) {
				$children_data[] = array(
					'category_id' => $child['category_id'],
					'name'        => $child['name'],
					'href'        => $this->url->link('content/category', 'bpath=' . $blog_category['category_id'] . '_' . $child['category_id'])	
				);		
			}

			$data['blog_categories'][] = array(
				'category_id' 	=> $blog_category['category_id'],
				'name'        	=> $blog_category['name'],
				'children'    	=> $children_data,
				'href'        	=> $this->url->link('content/category', 'bpath=' . $blog_category['category_id'])
			);	
		}
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		return $this->theme->view('widget/blogcategory', $data);
  	}
}