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

class Fedex extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('shipping/fedex');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('fedex', $this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $this->response->redirect($this->url->link('module/shipping', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['key'])) {
            $data['error_key'] = $this->error['key'];
        } else {
            $data['error_key'] = '';
        }
        
        if (isset($this->error['password'])) {
            $data['error_password'] = $this->error['password'];
        } else {
            $data['error_password'] = '';
        }
        
        if (isset($this->error['account'])) {
            $data['error_account'] = $this->error['account'];
        } else {
            $data['error_account'] = '';
        }
        
        if (isset($this->error['meter'])) {
            $data['error_meter'] = $this->error['meter'];
        } else {
            $data['error_meter'] = '';
        }
        
        if (isset($this->error['postcode'])) {
            $data['error_postcode'] = $this->error['postcode'];
        } else {
            $data['error_postcode'] = '';
        }
        
        $this->breadcrumb->add('lang_text_shipping', 'module/shipping');
        $this->breadcrumb->add('lang_heading_title', 'shipping/fedex');
        
        $data['action'] = $this->url->link('shipping/fedex', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['cancel'] = $this->url->link('module/shipping', 'token=' . $this->session->data['token'], 'SSL');
        
        if (isset($this->request->post['fedex_key'])) {
            $data['fedex_key'] = $this->request->post['fedex_key'];
        } else {
            $data['fedex_key'] = $this->config->get('fedex_key');
        }
        
        if (isset($this->request->post['fedex_password'])) {
            $data['fedex_password'] = $this->request->post['fedex_password'];
        } else {
            $data['fedex_password'] = $this->config->get('fedex_password');
        }
        
        if (isset($this->request->post['fedex_account'])) {
            $data['fedex_account'] = $this->request->post['fedex_account'];
        } else {
            $data['fedex_account'] = $this->config->get('fedex_account');
        }
        
        if (isset($this->request->post['fedex_meter'])) {
            $data['fedex_meter'] = $this->request->post['fedex_meter'];
        } else {
            $data['fedex_meter'] = $this->config->get('fedex_meter');
        }
        
        if (isset($this->request->post['fedex_postcode'])) {
            $data['fedex_postcode'] = $this->request->post['fedex_postcode'];
        } else {
            $data['fedex_postcode'] = $this->config->get('fedex_postcode');
        }
        
        if (isset($this->request->post['fedex_test'])) {
            $data['fedex_test'] = $this->request->post['fedex_test'];
        } else {
            $data['fedex_test'] = $this->config->get('fedex_test');
        }
        
        if (isset($this->request->post['fedex_service'])) {
            $data['fedex_service'] = $this->request->post['fedex_service'];
        } elseif ($this->config->has('fedex_service')) {
            $data['fedex_service'] = $this->config->get('fedex_service');
        } else {
            $data['fedex_service'] = array();
        }
        
        $data['services'] = array();
        
        $data['services'][] = array('text' => $this->language->get('lang_text_europe_first_international_priority'), 'value' => 'EUROPE_FIRST_INTERNATIONAL_PRIORITY');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_1_day_freight'), 'value' => 'FEDEX_1_DAY_FREIGHT');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_2_day'), 'value' => 'FEDEX_2_DAY');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_2_day_am'), 'value' => 'FEDEX_2_DAY_AM');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_2_day_freight'), 'value' => 'FEDEX_2_DAY_FREIGHT');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_3_day_freight'), 'value' => 'FEDEX_3_DAY_FREIGHT');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_express_saver'), 'value' => 'FEDEX_EXPRESS_SAVER');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_first_freight'), 'value' => 'FEDEX_FIRST_FREIGHT');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_freight_economy'), 'value' => 'FEDEX_FREIGHT_ECONOMY');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_freight_priority'), 'value' => 'FEDEX_FREIGHT_PRIORITY');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_fedex_ground'), 'value' => 'FEDEX_GROUND');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_first_overnight'), 'value' => 'FIRST_OVERNIGHT');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_ground_home_delivery'), 'value' => 'GROUND_HOME_DELIVERY');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_international_economy'), 'value' => 'INTERNATIONAL_ECONOMY');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_international_economy_freight'), 'value' => 'INTERNATIONAL_ECONOMY_FREIGHT');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_international_first'), 'value' => 'INTERNATIONAL_FIRST');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_international_priority'), 'value' => 'INTERNATIONAL_PRIORITY');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_international_priority_freight'), 'value' => 'INTERNATIONAL_PRIORITY_FREIGHT');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_priority_overnight'), 'value' => 'PRIORITY_OVERNIGHT');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_smart_post'), 'value' => 'SMART_POST');
        
        $data['services'][] = array('text' => $this->language->get('lang_text_standard_overnight'), 'value' => 'STANDARD_OVERNIGHT');
        
        if (isset($this->request->post['fedex_dropoff_type'])) {
            $data['fedex_dropoff_type'] = $this->request->post['fedex_dropoff_type'];
        } else {
            $data['fedex_dropoff_type'] = $this->config->get('fedex_dropoff_type');
        }
        
        if (isset($this->request->post['fedex_packaging_type'])) {
            $data['fedex_packaging_type'] = $this->request->post['fedex_packaging_type'];
        } else {
            $data['fedex_packaging_type'] = $this->config->get('fedex_packaging_type');
        }
        
        if (isset($this->request->post['fedex_rate_type'])) {
            $data['fedex_rate_type'] = $this->request->post['fedex_rate_type'];
        } else {
            $data['fedex_rate_type'] = $this->config->get('fedex_rate_type');
        }
        
        if (isset($this->request->post['fedex_destination_type'])) {
            $data['fedex_destination_type'] = $this->request->post['fedex_destination_type'];
        } else {
            $data['fedex_destination_type'] = $this->config->get('fedex_destination_type');
        }
        
        if (isset($this->request->post['fedex_display_time'])) {
            $data['fedex_display_time'] = $this->request->post['fedex_display_time'];
        } else {
            $data['fedex_display_time'] = $this->config->get('fedex_display_time');
        }
        
        if (isset($this->request->post['fedex_display_weight'])) {
            $data['fedex_display_weight'] = $this->request->post['fedex_display_weight'];
        } else {
            $data['fedex_display_weight'] = $this->config->get('fedex_display_weight');
        }
        
        if (isset($this->request->post['fedex_weight_class_id'])) {
            $data['fedex_weight_class_id'] = $this->request->post['fedex_weight_class_id'];
        } else {
            $data['fedex_weight_class_id'] = $this->config->get('fedex_weight_class_id');
        }
        
        $this->theme->model('localization/weightclass');
        
        $data['weight_classes'] = $this->model_localization_weightclass->getWeightClasses();
        
        if (isset($this->request->post['fedex_tax_class_id'])) {
            $data['fedex_tax_class_id'] = $this->request->post['fedex_tax_class_id'];
        } else {
            $data['fedex_tax_class_id'] = $this->config->get('fedex_tax_class_id');
        }
        
        $this->theme->model('localization/taxclass');
        
        $data['tax_classes'] = $this->model_localization_taxclass->getTaxClasses();
        
        if (isset($this->request->post['fedex_geo_zone_id'])) {
            $data['fedex_geo_zone_id'] = $this->request->post['fedex_geo_zone_id'];
        } else {
            $data['fedex_geo_zone_id'] = $this->config->get('fedex_geo_zone_id');
        }
        
        $this->theme->model('localization/geozone');
        
        $data['geo_zones'] = $this->model_localization_geozone->getGeoZones();
        
        if (isset($this->request->post['fedex_status'])) {
            $data['fedex_status'] = $this->request->post['fedex_status'];
        } else {
            $data['fedex_status'] = $this->config->get('fedex_status');
        }
        
        if (isset($this->request->post['fedex_sort_order'])) {
            $data['fedex_sort_order'] = $this->request->post['fedex_sort_order'];
        } else {
            $data['fedex_sort_order'] = $this->config->get('fedex_sort_order');
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('shipping/fedex', $data));
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'shipping/fedex')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        if (!$this->request->post['fedex_key']) {
            $this->error['key'] = $this->language->get('lang_error_key');
        }
        
        if (!$this->request->post['fedex_password']) {
            $this->error['password'] = $this->language->get('lang_error_password');
        }
        
        if (!$this->request->post['fedex_account']) {
            $this->error['account'] = $this->language->get('lang_error_account');
        }
        
        if (!$this->request->post['fedex_meter']) {
            $this->error['meter'] = $this->language->get('lang_error_meter');
        }
        
        if (!$this->request->post['fedex_postcode']) {
            $this->error['postcode'] = $this->language->get('lang_error_postcode');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
