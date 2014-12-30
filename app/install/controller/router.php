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
use Oculus\Engine\Action;
use Oculus\Service\ActionService;

class Router extends Controller {
    public function index() {
        
        $method = null;
        
        if (!empty($this->request->get['_route_'])):
            $parts = explode('/', $this->request->get['_route_']);
            
            // Native Routes
            if (!isset($this->request->get['route'])):
                $file = $parts[0];
                
                if (count($parts) > 1) $method = $parts[1];
                
                if (is_readable($this->get('path.application') . 'controller/' . $file . '.php')):
                    $this->request->get['route'] = $file;
                else:
                    $this->request->get['route'] = 'notfound';
                endif;
            endif;
            
            unset($parts);
        endif;
        
        if (isset($this->request->get['route'])):
            return new Action(new ActionService($this->app, $this->request->get['route'], array('method' => $method)));
        endif;
    }
}
