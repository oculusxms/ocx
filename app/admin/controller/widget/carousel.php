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

class Carousel extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('widget/carousel');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('carousel', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['image'])) {
            $data['error_image'] = $this->error['image'];
        } else {
            $data['error_image'] = array();
        }
        
        $this->breadcrumb->add('text_widget', 'module/widget');
        $this->breadcrumb->add('heading_title', 'widget/carousel');
        
        $data['action'] = $this->url->link('widget/carousel', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['widgets'] = array();
        
        if (isset($this->request->post['carousel_widget'])) {
            $data['widgets'] = $this->request->post['carousel_widget'];
        } elseif ($this->config->get('carousel_widget')) {
            $data['widgets'] = $this->config->get('carousel_widget');
        }
        
        $this->theme->model('design/layout');
        
        $data['layouts'] = $this->model_design_layout->getLayouts();
        
        $this->theme->model('design/banner');
        
        $data['banners'] = $this->model_design_banner->getBanners();
        
        $this->theme->loadjs('javascript/widget/carousel', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('widget/carousel', $data));
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'widget/carousel')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (isset($this->request->post['carousel_widget'])) {
            foreach ($this->request->post['carousel_widget'] as $key => $value) {
                if (!$value['width'] || !$value['height']) {
                    $this->error['image'][$key] = $this->language->get('error_image');
                }
            }
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
