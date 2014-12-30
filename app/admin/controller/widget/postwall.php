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

namespace Admin\Controller\Widget;
use Oculus\Engine\Controller;

class Postwall extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('widget/postwall');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('postwall_widget', $this->request->post);
            $this->cache->delete('posts.masonry');
            $this->session->data['success'] = $this->language->get('text_success');
            
            if (!empty($this->request->get['continue'])) {
                $this->response->redirect($this->url->link('widget/postwall', 'token=' . $this->session->data['token'], 'SSL'));
            } else {
                $this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
            }
        }
        
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['asterisk'])) {
            $data['error_asterisk'] = $this->error['asterisk'];
        } else {
            $data['error_asterisk'] = array();
        }
        
        $data['breadcrumbs'] = array();
        
        $this->breadcrumb->add('text_widget', 'module/widget');
        $this->breadcrumb->add('heading_title', 'widget/postwall');
        
        $data['action'] = $this->url->link('widget/postwall', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['widgets'] = array();
        
        if (isset($this->request->post['postwall_widget'])) {
            $data['widgets'] = $this->request->post['postwall_widget'];
        } elseif ($this->config->get('postwall_widget')) {
            $data['widgets'] = $this->config->get('postwall_widget');
        }
        
        $data['post_types'] = array('latest' => $this->language->get('text_latest'), 'featured' => $this->language->get('text_featured'));
        
        $this->theme->model('design/layout');
        
        $data['layouts'] = $this->model_design_layout->getLayouts();
        
        $this->theme->loadjs('javascript/widget/postwall', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('widget/postwall', $data));
    }
    
    private function validate() {
        if (!$this->user->hasPermission('modify', 'widget/postwall')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (isset($this->request->post['postwall_widget'])) {
            foreach ($this->request->post['postwall_widget'] as $key => $value) {
                if ($value['span'] == 1 && $value['description']) {
                    $this->error['asterisk'][$key]['description'] = $this->language->get('error_asterisk');
                }
                
                if ($value['span'] == 1 && $value['button']) {
                    $this->error['asterisk'][$key]['button'] = $this->language->get('error_asterisk');
                }
            }
        }
        
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_span');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
