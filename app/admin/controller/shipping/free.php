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

namespace Admin\Controller\Shipping;
use Oculus\Engine\Controller;

class Free extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('shipping/free');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('free', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $this->response->redirect($this->url->link('module/shipping', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $this->breadcrumb->add('text_shipping', 'module/shipping');
        $this->breadcrumb->add('heading_title', 'shipping/free');
        
        $data['action'] = $this->url->link('shipping/free', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['cancel'] = $this->url->link('module/shipping', 'token=' . $this->session->data['token'], 'SSL');
        
        if (isset($this->request->post['free_total'])) {
            $data['free_total'] = $this->request->post['free_total'];
        } else {
            $data['free_total'] = $this->config->get('free_total');
        }
        
        if (isset($this->request->post['free_geo_zone_id'])) {
            $data['free_geo_zone_id'] = $this->request->post['free_geo_zone_id'];
        } else {
            $data['free_geo_zone_id'] = $this->config->get('free_geo_zone_id');
        }
        
        $this->theme->model('localization/geozone');
        
        $data['geo_zones'] = $this->model_localization_geozone->getGeoZones();
        
        if (isset($this->request->post['free_status'])) {
            $data['free_status'] = $this->request->post['free_status'];
        } else {
            $data['free_status'] = $this->config->get('free_status');
        }
        
        if (isset($this->request->post['free_sort_order'])) {
            $data['free_sort_order'] = $this->request->post['free_sort_order'];
        } else {
            $data['free_sort_order'] = $this->config->get('free_sort_order');
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('shipping/free', $data));
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'shipping/free')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
