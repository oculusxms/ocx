<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|   
|   (c) Vince Kronlein <vince@ocx.io>
|   
|   For the full copyright and license information, please view the LICENSE
|   file that was distributed with this source code.
|   
*/

namespace Install\Controller;
use Oculus\Engine\Controller;

class Welcome extends Controller {
    private $error;
    
    public function index() {
        
        $this->theme->setTitle('OCX Installer');
        
        if (!is_readable($this->get('path.application') . 'ocx.sql')):
            $this->error['warning'] = 'Your SQL file, ocx.sql cannot be found.  Please upload a new version of ocx.sql to your <br>app/install directory and reload this page.';
        endif;
        
        if (isset($this->error['warning'])):
            $data['error_warning'] = $this->error['warning'];
        else:
            $data['error_warning'] = '';
        endif;
        
        $data['action'] = $this->url->link('license');
        
        $data['header'] = $this->theme->controller('header');
        $data['footer'] = $this->theme->controller('footer');
        
        $this->response->setOutput($this->theme->view('welcome', $data));
    }
}
