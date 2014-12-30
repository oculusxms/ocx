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

class Css extends Controller {
    public function index() {
        $key = $this->request->get['css'];
        $file = $this->filecache->get($key);
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        header('Content-type: text/css');
        
        echo $file;
    }
}
