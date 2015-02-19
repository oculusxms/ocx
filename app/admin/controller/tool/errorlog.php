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

namespace Admin\Controller\Tool;
use Oculus\Engine\Controller;

class Errorlog extends Controller {
    
    public function index() {
        $data = $this->theme->language('tool/error_log');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        
        $this->breadcrumb->add('lang_heading_title', 'tool/errorlog');
        
        $data['clear'] = $this->url->link('tool/errorlog/clear', 'token=' . $this->session->data['token'], 'SSL');
        
        $file = $this->app['path.logs'] . $this->config->get('config_error_filename');
        
        if (file_exists($file)) {
            $data['log'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
        } else {
            $data['log'] = '';
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('tool/error_log', $data));
    }
    
    public function clear() {
        $this->language->load('tool/error_log');
        
        $file = $this->app['path.logs'] . $this->config->get('config_error_filename');
        
        $handle = fopen($file, 'w+');
        
        fclose($handle);
        
        $this->session->data['success'] = $this->language->get('lang_text_success');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->response->redirect($this->url->link('tool/errorlog', 'token=' . $this->session->data['token'], 'SSL'));
    }
}
