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

class Logout extends Controller {
    public function index() {
        if ($this->affiliate->isLogged()):
            $this->affiliate->logout();
        endif;
        
        $data = $this->theme->language('affiliate/logout');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        if ($this->affiliate->isLogged()):
            $this->breadcrumb->add('lang_text_account', 'affiliate/account', null, true, 'SSL');
        endif;
        
        $this->breadcrumb->add('lang_text_logout', 'affiliate/logout', null, true, 'SSL');
        
        if ($this->theme->style = 'content'):
            $route = 'content/home';
        else:
            $route = 'shop/home';
        endif;

        $data['continue']     = $this->url->link($route);
        $data['text_message'] = $this->language->get('lang_text_message');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('common/success', $data));
    }
}
