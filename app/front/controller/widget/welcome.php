<?php

namespace Front\Controller\Widget;
use Oculus\Engine\Controller;
 
class Welcome extends Controller {
	public function index($setting) {
		$data = $this->theme->language('widget/welcome');
		
		$data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));

		$data['message'] = html_entity_decode($setting['description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		return $this->theme->view('widget/welcome', $data);
	}
}