<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|	
|	(c) Vince Kronlein <vince@ocx.io>
|	
|	For the full copyright and license information, please view the LICENSE
|	file that was distributed with this source code.
|	
*/

namespace Admin\Controller\Setting;
use Oculus\Engine\Controller;

class Help extends Controller {

	public function index() {
		$data = $this->theme->language('setting/help');

		$this->theme->setTitle($this->language->get('lang_heading_title'));

		$this->breadcrumb->add('lang_heading_title', 'setting/help');

		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('setting/help', $data));
	}
}
