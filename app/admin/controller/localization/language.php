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

namespace Admin\Controller\Localization;
use Oculus\Engine\Controller;

class Language extends Controller {
    private $error = array();
    
    public function index() {
        $this->language->load('localization/language');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('localization/language');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function insert() {
        $this->language->load('localization/language');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('localization/language');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_localization_language->addLanguage($this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('localization/language', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function update() {
        $this->language->load('localization/language');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('localization/language');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_localization_language->editLanguage($this->request->get['language_id'], $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('localization/language', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function delete() {
        $this->language->load('localization/language');
        $this->theme->setTitle($this->language->get('heading_title'));
        $this->theme->model('localization/language');
        
        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $language_id) {
                $this->model_localization_language->deleteLanguage($language_id);
            }
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('localization/language', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    protected function getList() {
        $data = $this->theme->language('localization/language');
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'name';
        }
        
        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $url = '';
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $this->breadcrumb->add('heading_title', 'localization/language', $url);
        
        $data['insert'] = $this->url->link('localization/language/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('localization/language/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        $data['languages'] = array();
        
        $filter = array('sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $this->config->get('config_admin_limit'), 'limit' => $this->config->get('config_admin_limit'));
        
        $language_total = $this->model_localization_language->getTotalLanguages();
        
        $results = $this->model_localization_language->getLanguages($filter);
        
        foreach ($results as $result) {
            $action = array();
            
            $action[] = array('text' => $this->language->get('text_edit'), 'href' => $this->url->link('localization/language/update', 'token=' . $this->session->data['token'] . '&language_id=' . $result['language_id'] . $url, 'SSL'));
            
            $data['languages'][] = array('language_id' => $result['language_id'], 'name' => $result['name'] . (($result['code'] == $this->config->get('config_language')) ? $this->language->get('text_default') : null), 'code' => $result['code'], 'sort_order' => $result['sort_order'], 'selected' => isset($this->request->post['selected']) && in_array($result['language_id'], $this->request->post['selected']), 'action' => $action);
        }
        
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
        
        $url = '';
        
        if ($order == 'ASC') {
            $url.= '&order=DESC';
        } else {
            $url.= '&order=ASC';
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $data['sort_name'] = $this->url->link('localization/language', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
        $data['sort_code'] = $this->url->link('localization/language', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
        $data['sort_sort_order'] = $this->url->link('localization/language', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');
        
        $url = '';
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        $data['pagination'] = $this->theme->paginate($language_total, $page, $this->config->get('config_admin_limit'), $this->language->get('text_pagination'), $this->url->link('localization/language', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL'));
        
        $data['sort'] = $sort;
        $data['order'] = $order;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('localization/language_list', $data));
    }
    
    protected function getForm() {
        $data = $this->theme->language('localization/language');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }
        
        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }
        
        if (isset($this->error['locale'])) {
            $data['error_locale'] = $this->error['locale'];
        } else {
            $data['error_locale'] = '';
        }
        
        if (isset($this->error['image'])) {
            $data['error_image'] = $this->error['image'];
        } else {
            $data['error_image'] = '';
        }
        
        if (isset($this->error['directory'])) {
            $data['error_directory'] = $this->error['directory'];
        } else {
            $data['error_directory'] = '';
        }
        
        if (isset($this->error['filename'])) {
            $data['error_filename'] = $this->error['filename'];
        } else {
            $data['error_filename'] = '';
        }
        
        $url = '';
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $this->breadcrumb->add('heading_title', 'localization/language', $url);
        
        if (!isset($this->request->get['language_id'])) {
            $data['action'] = $this->url->link('localization/language/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('localization/language/update', 'token=' . $this->session->data['token'] . '&language_id=' . $this->request->get['language_id'] . $url, 'SSL');
        }
        
        $data['cancel'] = $this->url->link('localization/language', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        if (isset($this->request->get['language_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $language_info = $this->model_localization_language->getLanguage($this->request->get['language_id']);
        }
        
        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($language_info)) {
            $data['name'] = $language_info['name'];
        } else {
            $data['name'] = '';
        }
        
        if (isset($this->request->post['code'])) {
            $data['code'] = $this->request->post['code'];
        } elseif (!empty($language_info)) {
            $data['code'] = $language_info['code'];
        } else {
            $data['code'] = '';
        }
        
        if (isset($this->request->post['locale'])) {
            $data['locale'] = $this->request->post['locale'];
        } elseif (!empty($language_info)) {
            $data['locale'] = $language_info['locale'];
        } else {
            $data['locale'] = '';
        }
        
        if (isset($this->request->post['image'])) {
            $data['image'] = $this->request->post['image'];
        } elseif (!empty($language_info)) {
            $data['image'] = $language_info['image'];
        } else {
            $data['image'] = '';
        }
        
        if (isset($this->request->post['directory'])) {
            $data['directory'] = $this->request->post['directory'];
        } elseif (!empty($language_info)) {
            $data['directory'] = $language_info['directory'];
        } else {
            $data['directory'] = '';
        }
        
        if (isset($this->request->post['filename'])) {
            $data['filename'] = $this->request->post['filename'];
        } elseif (!empty($language_info)) {
            $data['filename'] = $language_info['filename'];
        } else {
            $data['filename'] = '';
        }
        
        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($language_info)) {
            $data['sort_order'] = $language_info['sort_order'];
        } else {
            $data['sort_order'] = '';
        }
        
        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($language_info)) {
            $data['status'] = $language_info['status'];
        } else {
            $data['status'] = 1;
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('localization/language_form', $data));
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'localization/language')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (($this->encode->strlen($this->request->post['name']) < 3) || ($this->encode->strlen($this->request->post['name']) > 32)) {
            $this->error['name'] = $this->language->get('error_name');
        }
        
        if ($this->encode->strlen($this->request->post['code']) < 2) {
            $this->error['code'] = $this->language->get('error_code');
        }
        
        if (!$this->request->post['locale']) {
            $this->error['locale'] = $this->language->get('error_locale');
        }
        
        if (!$this->request->post['directory']) {
            $this->error['directory'] = $this->language->get('error_directory');
        }
        
        if (!$this->request->post['filename']) {
            $this->error['filename'] = $this->language->get('error_filename');
        }
        
        if (($this->encode->strlen($this->request->post['image']) < 3) || ($this->encode->strlen($this->request->post['image']) > 32)) {
            $this->error['image'] = $this->language->get('error_image');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'localization/language')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $this->theme->model('setting/store');
        $this->theme->model('sale/order');
        
        foreach ($this->request->post['selected'] as $language_id) {
            $language_info = $this->model_localization_language->getLanguage($language_id);
            
            if ($language_info) {
                if ($this->config->get('config_language') == $language_info['code']) {
                    $this->error['warning'] = $this->language->get('error_default');
                }
                
                if ($this->config->get('config_admin_language') == $language_info['code']) {
                    $this->error['warning'] = $this->language->get('error_admin');
                }
                
                $store_total = $this->model_setting_store->getTotalStoresByLanguage($language_info['code']);
                
                if ($store_total) {
                    $this->error['warning'] = sprintf($this->language->get('error_store'), $store_total);
                }
            }
            
            $order_total = $this->model_sale_order->getTotalOrdersByLanguageId($language_id);
            
            if ($order_total) {
                $this->error['warning'] = sprintf($this->language->get('error_order'), $order_total);
            }
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
