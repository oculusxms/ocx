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

class Blogcategory extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('widget/blogcategory');
        $this->theme->setTitle($this->language->get('doc_title'));
        $this->theme->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('blogcategory', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $this->breadcrumb->add('text_widget', 'module/widget');
        $this->breadcrumb->add('heading_title', 'widget/blogcategory');
        
        $data['action'] = $this->url->link('widget/blogcategory', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['widgets'] = array();
        
        if (isset($this->request->post['blogcategory_widget'])) {
            $data['widgets'] = $this->request->post['blogcategory_widget'];
        } elseif ($this->config->get('blogcategory_widget')) {
            $data['widgets'] = $this->config->get('blogcategory_widget');
        }
        
        $this->theme->model('design/layout');
        
        $data['layouts'] = $this->model_design_layout->getLayouts();
        
        $this->theme->loadjs('javascript/widget/blogcategory', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('widget/blogcategory', $data));
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'widget/blogcategory')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
