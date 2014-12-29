<?php

namespace Admin\Controller\Common;
use Oculus\Engine\Controller;
 
class Header extends Controller {
	public function index() {
		$data['title'] = $this->theme->getTitle(); 

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))):
			$data['base'] = $this->app['https.server'];
		else:
			$data['base'] = $this->app['http.server'];
		endif;

		$data['links'] 		= $this->theme->getLinks();	
		$data['lang'] 		= $this->language->get('code');
		$data['direction'] 	= $this->language->get('direction');
		
		$this->css->register('ocx.min')
			->register('editor.min', 'ocx.min');

		$data = $this->theme->language('common/header', $data);

		if (!$this->user->isLogged() || 
			!isset($this->request->get['token']) || 
			!isset($this->session->data['token']) || 
			($this->request->get['token'] != $this->session->data['token'])):
			
			$data['logged'] = '';
			$data['dashboard'] = $this->url->link('common/login', '', 'SSL');
		else:
			$data['logged'] = true;	
		endif;
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$data['menu'] = $this->theme->controller('common/menu');

		$data['css_link'] = $this->url->link('common/css', '&css=' . $this->css->compile(), 'SSL');

		return $this->theme->view('common/header', $data);
	}
}