<?php 

namespace Front\Controller\Shop;
use Oculus\Engine\Controller;
 
class Home extends Controller {
	public function index() {
		$this->theme->setTitle($this->config->get('config_title'));
		$this->theme->setDescription($this->config->get('config_meta_description'));

		$this->theme->setOgType('product');
		$this->theme->setOgDescription(html_entity_decode($this->config->get('config_meta_description'), ENT_QUOTES, 'UTF-8'));

		$data['heading_title']  = $this->config->get('config_title');
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
		
		$this->theme->set_controller('header', 'shop/header');
		$this->theme->set_controller('footer', 'shop/footer');
		$this->theme->unset_controller('breadcrumb');
		
		$data = $this->theme->render_controllers($data);
		
		$this->response->setOutput($this->theme->view('shop/home', $data));
	}
}