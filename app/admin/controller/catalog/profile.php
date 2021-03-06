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

namespace Admin\Controller\Catalog;
use Oculus\Engine\Controller;

class Profile extends Controller {
    private $error = array();
    
    public function index() {
        $this->language->load('catalog/profile');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('catalog/profile');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function insert() {
        $this->language->load('catalog/profile');
        $this->theme->model('catalog/profile');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_profile->addProfile($this->request->post);
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $this->response->redirect($this->url->link('catalog/profile', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function update() {
        $this->language->load('catalog/profile');
        $this->theme->model('catalog/profile');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_profile->updateProfile($this->request->get['profile_id'], $this->request->post);
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $this->response->redirect($this->url->link('catalog/profile', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function delete() {
        $this->language->load('catalog/profile');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('catalog/profile');
        
        if (isset($this->request->post['profile_ids']) && $this->validateDelete()) {
            foreach ($this->request->post['profile_ids'] as $profile_id) {
                $this->model_catalog_profile->deleteProfile($profile_id);
            }
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $this->response->redirect($this->url->link('catalog/profile', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function copy() {
        $this->language->load('catalog/profile');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('catalog/profile');
        
        if (isset($this->request->post['profile_ids']) && $this->validateCopy()) {
            foreach ($this->request->post['profile_ids'] as $profile_id) {
                $this->model_catalog_profile->copyProfile($profile_id);
            }
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $this->response->redirect($this->url->link('catalog/profile', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    protected function getList() {
        $data = $this->theme->language('catalog/profile');
        
        $this->breadcrumb->add('lang_heading_title', 'catalog/profile');
        
        $data['profiles'] = array();
        
        $profiles = $this->model_catalog_profile->getProfiles();
        
        foreach ($profiles as $profile) {
            $action = array();
            
            $action[] = array('href' => $this->url->link('catalog/profile/update', 'token=' . $this->session->data['token'] . '&profile_id=' . $profile['profile_id'], 'SSL'), 'name' => $this->language->get('lang_text_edit'),);
            
            $data['profiles'][] = array('profile_id' => $profile['profile_id'], 'name' => $profile['name'], 'sort_order' => $profile['sort_order'], 'action' => $action,);
        }
        
        $data['insert'] = $this->url->link('catalog/profile/insert', 'token=' . $this->session->data['token'], 'SSL');
        $data['copy'] = $this->url->link('catalog/profile/copy', 'token=' . $this->session->data['token'], 'SSL');
        $data['delete'] = $this->url->link('catalog/profile/delete', 'token=' . $this->session->data['token'], 'SSL');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        
        $data['pagination'] = '';
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('catalog/profile_list', $data));
    }
    
    protected function getForm() {
        $data = $this->theme->language('catalog/profile');
        
        $this->theme->model('localization/language');
        
        $this->breadcrumb->add('lang_heading_title', 'catalog/profile');
        
        if (!isset($this->request->get['profile_id'])) {
            $data['action'] = $this->url->link('catalog/profile/insert', 'token=' . $this->session->data['token'], 'SSL');
        } else {
            $data['action'] = $this->url->link('catalog/profile/update', 'token=' . $this->session->data['token'] . '&profile_id=' . $this->request->get['profile_id'], 'SSL');
        }
        
        $data['cancel'] = $this->url->link('catalog/profile', 'token=' . $this->session->data['token'], 'SSL');
        $data['token'] = $this->session->data['token'];
        $data['languages'] = $this->model_localization_language->getLanguages();
        $data['sort_order'] = '0';
        
        $data['frequencies'] = $this->model_catalog_profile->getFrequencies();
        
        if (isset($this->request->get['profile_id'])) {
            $profile = $this->model_catalog_profile->getProfile($this->request->get['profile_id']);
        } else {
            $profile = array();
        }
        
        if (isset($this->request->post['profile_description'])) {
            $data['profile_description'] = $this->request->post['profile_description'];
        } elseif (!empty($profile)) {
            $data['profile_description'] = $this->model_catalog_profile->getProfileDescription($profile['profile_id']);
        } else {
            $data['profile_description'] = array();
        }
        
        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($profile)) {
            $data['sort_order'] = $profile['sort_order'];
        } else {
            $data['sort_order'] = 0;
        }
        
        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($profile)) {
            $data['status'] = $profile['status'];
        } else {
            $data['status'] = 0;
        }
        
        if (isset($this->request->post['price'])) {
            $data['price'] = $this->request->post['price'];
        } elseif (!empty($profile)) {
            $data['price'] = $profile['price'];
        } else {
            $data['price'] = 0;
        }
        
        if (isset($this->request->post['frequency'])) {
            $data['frequency'] = $this->request->post['frequency'];
        } elseif (!empty($profile)) {
            $data['frequency'] = $profile['frequency'];
        } else {
            $data['frequency'] = '';
        }
        
        if (isset($this->request->post['duration'])) {
            $data['duration'] = $this->request->post['duration'];
        } elseif (!empty($profile)) {
            $data['duration'] = $profile['duration'];
        } else {
            $data['duration'] = 0;
        }
        
        if (isset($this->request->post['cycle'])) {
            $data['cycle'] = $this->request->post['cycle'];
        } elseif (!empty($profile)) {
            $data['cycle'] = $profile['cycle'];
        } else {
            $data['cycle'] = 1;
        }
        
        if (isset($this->request->post['trial_status'])) {
            $data['trial_status'] = $this->request->post['trial_status'];
        } elseif (!empty($profile)) {
            $data['trial_status'] = $profile['trial_status'];
        } else {
            $data['trial_status'] = 0;
        }
        
        if (isset($this->request->post['trial_price'])) {
            $data['trial_price'] = $this->request->post['trial_price'];
        } elseif (!empty($profile)) {
            $data['trial_price'] = $profile['trial_price'];
        } else {
            $data['trial_price'] = 0.00;
        }
        
        if (isset($this->request->post['trial_frequency'])) {
            $data['trial_frequency'] = $this->request->post['trial_frequency'];
        } elseif (!empty($profile)) {
            $data['trial_frequency'] = $profile['trial_frequency'];
        } else {
            $data['trial_frequency'] = '';
        }
        
        if (isset($this->request->post['trial_duration'])) {
            $data['trial_duration'] = $this->request->post['trial_duration'];
        } elseif (!empty($profile)) {
            $data['trial_duration'] = $profile['trial_duration'];
        } else {
            $data['trial_duration'] = '0';
        }
        
        if (isset($this->request->post['trial_cycle'])) {
            $data['trial_cycle'] = $this->request->post['trial_cycle'];
        } elseif (!empty($profile)) {
            $data['trial_cycle'] = $profile['trial_cycle'];
        } else {
            $data['trial_cycle'] = '1';
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = array();
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('catalog/profile_form', $data));
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'catalog/profile')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        foreach ($this->request->post['profile_description'] as $language_id => $value) {
            if (($this->encode->strlen($value['name']) < 3) || ($this->encode->strlen($value['name']) > 255)) {
                $this->error['name'][$language_id] = $this->language->get('lang_error_name');
            }
        }
        
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('lang_error_warning');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'catalog/profile')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateCopy() {
        if (!$this->user->hasPermission('modify', 'catalog/profile')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
