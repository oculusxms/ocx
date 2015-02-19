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

class Weight extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('shipping/weight');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('weight', $this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $this->response->redirect($this->url->link('module/shipping', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $this->breadcrumb->add('lang_text_shipping', 'module/shipping');
        $this->breadcrumb->add('lang_heading_title', 'shipping/weight');
        
        $data['action'] = $this->url->link('shipping/weight', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['cancel'] = $this->url->link('module/shipping', 'token=' . $this->session->data['token'], 'SSL');
        
        $this->theme->model('localization/geozone');
        
        $geo_zones = $this->model_localization_geozone->getGeoZones();
        
        foreach ($geo_zones as $geo_zone) {
            if (isset($this->request->post['weight_' . $geo_zone['geo_zone_id'] . '_rate'])) {
                $data['weight_' . $geo_zone['geo_zone_id'] . '_rate'] = $this->request->post['weight_' . $geo_zone['geo_zone_id'] . '_rate'];
            } else {
                $data['weight_' . $geo_zone['geo_zone_id'] . '_rate'] = $this->config->get('weight_' . $geo_zone['geo_zone_id'] . '_rate');
            }
            
            if (isset($this->request->post['weight_' . $geo_zone['geo_zone_id'] . '_status'])) {
                $data['weight_' . $geo_zone['geo_zone_id'] . '_status'] = $this->request->post['weight_' . $geo_zone['geo_zone_id'] . '_status'];
            } else {
                $data['weight_' . $geo_zone['geo_zone_id'] . '_status'] = $this->config->get('weight_' . $geo_zone['geo_zone_id'] . '_status');
            }
        }
        
        $data['geo_zones'] = $geo_zones;
        
        if (isset($this->request->post['weight_tax_class_id'])) {
            $data['weight_tax_class_id'] = $this->request->post['weight_tax_class_id'];
        } else {
            $data['weight_tax_class_id'] = $this->config->get('weight_tax_class_id');
        }
        
        $this->theme->model('localization/taxclass');
        
        $data['tax_classes'] = $this->model_localization_taxclass->getTaxClasses();
        
        if (isset($this->request->post['weight_status'])) {
            $data['weight_status'] = $this->request->post['weight_status'];
        } else {
            $data['weight_status'] = $this->config->get('weight_status');
        }
        
        if (isset($this->request->post['weight_sort_order'])) {
            $data['weight_sort_order'] = $this->request->post['weight_sort_order'];
        } else {
            $data['weight_sort_order'] = $this->config->get('weight_sort_order');
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('shipping/weight', $data));
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'shipping/weight')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
