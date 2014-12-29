<?php

namespace Front\Controller\Widget;
use Oculus\Engine\Controller;

class Blogfeatured extends Controller {
	public function index($setting) {
		static $widget = 0;
		
		$data = $this->theme->language('widget/blogfeatured');
		
		$data['setting'] = $setting;
		
		$this->theme->model('content/post');
		$this->theme->model('tool/image');

		$data['posts'] = array();

		$posts = explode(',', $this->config->get('blogfeatured_post'));		

		if (empty($setting['limit'])) {
			$setting['limit'] = 5;
		}
		
		$posts = array_slice($posts, 0, (int)$setting['limit']);
		
		foreach ($posts as $post_id) {
			$post_info = $this->model_content_post->getPost($post_id);
			
			if ($post_info) {
				if ($post_info['image']) {
					$image 	= $this->model_tool_image->resize($post_info['image'], $setting['image_width'], $setting['image_height'], 'h');
				} else {
					$image 	= $this->model_tool_image->resize('placeholder.png', $setting['image_width'], $setting['image_height'], 'h');
				}
					
				$data['posts'][] = array(
					'post_id' 		    => $post_info['post_id'],
					'thumb'   	 		=> $image,
					'name'    	 		=> $post_info['name'],
					'href'    	 		=> $this->url->link('content/post', 'post_id=' . $post_info['post_id'])
				);
			}
		}
		
		$data['widget'] = $widget++;
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		return $this->theme->view('widget/blogfeatured', $data);
	}
}