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


namespace Front\Controller\Error;
use Oculus\Engine\Controller;

class Notfound extends Controller {
    public function index() {
        $data = $this->theme->language('error/notfound');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        if (isset($this->request->get['route'])) {
            $routes = $this->request->get;
            
            unset($routes['_route_']);
            
            $route = $routes['route'];
            
            unset($routes['route']);
            
            $url = '';
            
            if ($routes) {
                $url = '&' . urldecode(http_build_query($routes, '', '&'));
            }
            
            if (isset($this->request->server['https']) && (($this->request->server['https'] == 'on') || ($this->request->server['https'] == '1'))) {
                $connection = 'ssl';
            } else {
                $connection = 'nonssl';
            }
            
            $this->breadcrumb->add('heading_title', $route, $url, true, $connection);
        }
        
        $this->response->addheader($this->request->server['SERVER_PROTOCOL'] . '/1.1 404 not found');
        
        $data['continue'] = $this->url->link('shop/home');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('error/notfound', $data));
    }
}
