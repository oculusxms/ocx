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

class Currency extends Controller {
    private $error = array();
    
    public function index() {
        $this->language->load('localization/currency');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('localization/currency');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function insert() {
        $this->language->load('localization/currency');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('localization/currency');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_localization_currency->addCurrency($this->request->post);
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
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
            
            $this->response->redirect($this->url->link('localization/currency', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function update() {
        $this->language->load('localization/currency');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('localization/currency');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_localization_currency->editCurrency($this->request->get['currency_id'], $this->request->post);
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
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
            
            $this->response->redirect($this->url->link('localization/currency', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function delete() {
        $this->language->load('localization/currency');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('localization/currency');
        
        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $currency_id) {
                $this->model_localization_currency->deleteCurrency($currency_id);
            }
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
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
            
            $this->response->redirect($this->url->link('localization/currency', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    protected function getList() {
        $data = $this->theme->language('localization/currency');
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'title';
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
        
        $this->breadcrumb->add('lang_heading_title', 'localization/currency', $url);
        
        $data['insert'] = $this->url->link('localization/currency/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('localization/currency/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        $data['currencies'] = array();
        
        $filter = array('sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $this->config->get('config_admin_limit'), 'limit' => $this->config->get('config_admin_limit'));
        
        $currency_total = $this->model_localization_currency->getTotalCurrencies();
        
        $results = $this->model_localization_currency->getCurrencies($filter);
        
        foreach ($results as $result) {
            $action = array();
            
            $action[] = array('text' => $this->language->get('lang_text_edit'), 'href' => $this->url->link('localization/currency/update', 'token=' . $this->session->data['token'] . '&currency_id=' . $result['currency_id'] . $url, 'SSL'));
            
            $data['currencies'][] = array('currency_id' => $result['currency_id'], 'title' => $result['title'] . (($result['code'] == $this->config->get('config_currency')) ? $this->language->get('lang_text_default') : null), 'code' => $result['code'], 'value' => $result['value'], 'date_modified' => date($this->language->get('lang_date_format_short'), strtotime($result['date_modified'])), 'selected' => isset($this->request->post['selected']) && in_array($result['currency_id'], $this->request->post['selected']), 'action' => $action);
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
        
        $data['sort_title'] = $this->url->link('localization/currency', 'token=' . $this->session->data['token'] . '&sort=title' . $url, 'SSL');
        $data['sort_code'] = $this->url->link('localization/currency', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
        $data['sort_value'] = $this->url->link('localization/currency', 'token=' . $this->session->data['token'] . '&sort=value' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('localization/currency', 'token=' . $this->session->data['token'] . '&sort=date_modified' . $url, 'SSL');
        
        $url = '';
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        $data['pagination'] = $this->theme->paginate($currency_total, $page, $this->config->get('config_admin_limit'), $this->language->get('lang_text_pagination'), $this->url->link('localization/currency', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL'));
        
        $data['sort'] = $sort;
        $data['order'] = $order;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('localization/currency_list', $data));
    }
    
    protected function getForm() {
        $data = $this->theme->language('localization/currency');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = '';
        }
        
        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
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
        
        $this->breadcrumb->add('lang_heading_title', 'localization/currency', $url);
        
        if (!isset($this->request->get['currency_id'])) {
            $data['action'] = $this->url->link('localization/currency/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('localization/currency/update', 'token=' . $this->session->data['token'] . '&currency_id=' . $this->request->get['currency_id'] . $url, 'SSL');
        }
        
        $data['cancel'] = $this->url->link('localization/currency', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        if (isset($this->request->get['currency_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $currency_info = $this->model_localization_currency->getCurrency($this->request->get['currency_id']);
        }
        
        if (isset($this->request->post['title'])) {
            $data['title'] = $this->request->post['title'];
        } elseif (!empty($currency_info)) {
            $data['title'] = $currency_info['title'];
        } else {
            $data['title'] = '';
        }
        
        if (isset($this->request->post['code'])) {
            $data['code'] = $this->request->post['code'];
        } elseif (!empty($currency_info)) {
            $data['code'] = $currency_info['code'];
        } else {
            $data['code'] = '';
        }
        
        if (isset($this->request->post['symbol_left'])) {
            $data['symbol_left'] = $this->request->post['symbol_left'];
        } elseif (!empty($currency_info)) {
            $data['symbol_left'] = $currency_info['symbol_left'];
        } else {
            $data['symbol_left'] = '';
        }
        
        if (isset($this->request->post['symbol_right'])) {
            $data['symbol_right'] = $this->request->post['symbol_right'];
        } elseif (!empty($currency_info)) {
            $data['symbol_right'] = $currency_info['symbol_right'];
        } else {
            $data['symbol_right'] = '';
        }
        
        if (isset($this->request->post['decimal_place'])) {
            $data['decimal_place'] = $this->request->post['decimal_place'];
        } elseif (!empty($currency_info)) {
            $data['decimal_place'] = $currency_info['decimal_place'];
        } else {
            $data['decimal_place'] = '';
        }
        
        if (isset($this->request->post['value'])) {
            $data['value'] = $this->request->post['value'];
        } elseif (!empty($currency_info)) {
            $data['value'] = $currency_info['value'];
        } else {
            $data['value'] = '';
        }
        
        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($currency_info)) {
            $data['status'] = $currency_info['status'];
        } else {
            $data['status'] = '';
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('localization/currency_form', $data));
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'localization/currency')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        if (($this->encode->strlen($this->request->post['title']) < 3) || ($this->encode->strlen($this->request->post['title']) > 32)) {
            $this->error['title'] = $this->language->get('lang_error_title');
        }
        
        if ($this->encode->strlen($this->request->post['code']) != 3) {
            $this->error['code'] = $this->language->get('lang_error_code');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'localization/currency')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        $this->theme->model('setting/store');
        $this->theme->model('sale/order');
        
        foreach ($this->request->post['selected'] as $currency_id) {
            $currency_info = $this->model_localization_currency->getCurrency($currency_id);
            
            if ($currency_info) {
                if ($this->config->get('config_currency') == $currency_info['code']) {
                    $this->error['warning'] = $this->language->get('lang_error_default');
                }
                
                $store_total = $this->model_setting_store->getTotalStoresByCurrency($currency_info['code']);
                
                if ($store_total) {
                    $this->error['warning'] = sprintf($this->language->get('lang_error_store'), $store_total);
                }
            }
            
            $order_total = $this->model_sale_order->getTotalOrdersByCurrencyId($currency_id);
            
            if ($order_total) {
                $this->error['warning'] = sprintf($this->language->get('lang_error_order'), $order_total);
            }
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
