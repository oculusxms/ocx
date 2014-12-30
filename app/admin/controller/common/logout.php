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

namespace Admin\Controller\Common;
use Oculus\Engine\Controller;

class Logout extends Controller {
    public function index() {
        $this->user->logout();
        
        unset($this->session->data['token']);
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->response->redirect($this->app['config_ssl']);
    }
}
