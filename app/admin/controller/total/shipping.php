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

class Shipping extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('total/shipping');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('shipping', $this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $this->response->redirect($this->url->link('module/total', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $this->breadcrumb->add('lang_text_total', 'module/total');
        $this->breadcrumb->add('lang_heading_title', 'total/shipping');
        
        $data['action'] = $this->url->link('total/shipping', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('module/total', 'token=' . $this->session->data['token'], 'SSL');
        
        if (isset($this->request->post['shipping_estimator'])) {
            $data['shipping_estimator'] = $this->request->post['shipping_estimator'];
        } else {
            $data['shipping_estimator'] = $this->config->get('shipping_estimator');
        }
        
        if (isset($this->request->post['shipping_status'])) {
            $data['shipping_status'] = $this->request->post['shipping_status'];
        } else {
            $data['shipping_status'] = $this->config->get('shipping_status');
        }
        
        if (isset($this->request->post['shipping_sort_order'])) {
            $data['shipping_sort_order'] = $this->request->post['shipping_sort_order'];
        } else {
            $data['shipping_sort_order'] = $this->config->get('shipping_sort_order');
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('total/shipping', $data));
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'total/shipping')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
