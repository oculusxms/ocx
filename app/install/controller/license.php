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

namespace Install\Controller;
use Oculus\Engine\Controller;

class License extends Controller {
    public function index() {
        
        $this->theme->setTitle('OCX Install || Step 1 - License');
        
        if (!is_readable($this->get('path.application') . 'ocx.sql')):
            $this->response->redirect($this->url->link('welcome'));
        endif;
        
        $data['action'] = $this->url->link('preinstallation');
        
        $data['header'] = $this->theme->controller('header');
        $data['footer'] = $this->theme->controller('footer');
        
        $this->response->setOutput($this->theme->view('license', $data));
    }
}
