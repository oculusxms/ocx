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
        if ($this->affiliate->isLogged()) {
            $this->affiliate->logout();
            
            $this->response->redirect($this->url->link('affiliate/logout', '', 'SSL'));
        }
        
        $data = $this->theme->language('affiliate/logout');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->breadcrumb->add('text_account', 'affiliate/account', null, true, 'SSL');
        $this->breadcrumb->add('text_logout', 'affiliate/logout', null, true, 'SSL');
        
        $data['continue'] = $this->url->link('shop/home');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('common/success', $data));
    }
}
