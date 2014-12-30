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

namespace Admin\Controller\Total;
use Oculus\Engine\Controller;

class Credit extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('total/credit');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('credit', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $this->response->redirect($this->url->link('module/total', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $this->breadcrumb->add('text_total', 'module/total');
        $this->breadcrumb->add('heading_title', 'total/credit');
        
        $data['action'] = $this->url->link('total/credit', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('module/total', 'token=' . $this->session->data['token'], 'SSL');
        
        if (isset($this->request->post['credit_status'])) {
            $data['credit_status'] = $this->request->post['credit_status'];
        } else {
            $data['credit_status'] = $this->config->get('credit_status');
        }
        
        if (isset($this->request->post['credit_sort_order'])) {
            $data['credit_sort_order'] = $this->request->post['credit_sort_order'];
        } else {
            $data['credit_sort_order'] = $this->config->get('credit_sort_order');
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('total/credit', $data));
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'total/credit')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
