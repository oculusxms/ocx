<?php

namespace Front\Controller\Widget;
use Oculus\Engine\Controller;
 
class Blogsearch extends Controller {
	public function index($setting) {
		$data = $this->theme->language('widget/blogsearch');
		
    	$data['heading_title'] = $this->language->get('heading_title');
		
		// Search
		if (isset($this->request->get['filter_name'])) {
			$data['filter_name'] = $this->request->get['filter_name'];
		} else {
			$data['filter_name'] = '';
		}
		
		$this->theme->loadjs('javascript/widget/blogsearch', $data);
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		return $this->theme->view('widget/blogsearch', $data);
  	}
}