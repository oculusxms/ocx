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

namespace Plugin\Example\Admin\Events;
use Oculus\Engine\Container;
use Oculus\Engine\Plugin;

class Adminevent extends Plugin {
    public function __construct(Container $app) {
        parent::__construct($app);
        parent::setPlugin('example');
    }
    
    // Add call back methods for events below
    public function editProduct($data) {
        
        // triggered on admin_edit_product
        
        $this->response->redirect($this->url->link('tool/errorlog', 'token=' . $this->session->data['token'], 'SSL'));
    }
}
