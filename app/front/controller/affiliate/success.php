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

namespace Front\Controller\Affiliate;
use Oculus\Engine\Controller;

class Success extends Controller {
    public function index() {
        $data = $this->theme->language('affiliate/success');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->breadcrumb->add('lang_text_account', 'affiliate/account', null, true, 'SSL');
        $this->breadcrumb->add('lang_text_success', 'affiliate/success', null, true, 'SSL');
        
        $data['text_message'] = sprintf($this->language->get('lang_text_approval'), $this->config->get('config_name'), $this->url->link('content/contact'));
        
        $data['continue'] = $this->url->link('affiliate/account', '', 'SSL');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('common/success', $data));
    }
}
