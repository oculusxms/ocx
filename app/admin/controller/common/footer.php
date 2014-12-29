<?php

namespace Admin\Controller\Common;
use Oculus\Engine\Controller;

class Footer extends Controller {   
	public function index() {
		$data = $this->theme->language('common/footer');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$data['javascript']  = $this->theme->controller('common/javascript');
		$data['text_footer'] = sprintf($this->language->get('text_footer'), VERSION);

		$data['js_link'] = $this->url->link('common/javascript/render', '&js=' . $this->javascript->compile(), 'SSL');
		
		return $this->theme->view('common/footer', $data);
	}
}
