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

namespace Plugin\Example\Admin\Controller;
use Oculus\Engine\Container;
use Oculus\Engine\Plugin;

class Example extends Plugin {
    public function __construct(Container $app) {
        parent::__construct($app);
        parent::setPlugin('example');
    }
    
    public function index() {
        $data = $this->language('example');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->breadcrumb->add('text_plugin', 'module/plugin');
        $this->breadcrumb->add('heading_title', 'plugin/example');
        
        $data['header'] = $this->theme->controller('common/header');
        $data['breadcrumb'] = $this->theme->controller('common/breadcrumb');
        $data['footer'] = $this->theme->controller('common/footer');
        
        $this->response->setOutput($this->view('example', $data));
    }
}
