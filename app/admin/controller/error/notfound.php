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

namespace Admin\Controller\Error;
use Oculus\Engine\Controller;

class Notfound extends Controller {
    public function index() {
        $data = $this->theme->language('error/not_found');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->breadcrumb->add('heading_title', 'error/notfound');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('error/not_found', $data));
    }
}
