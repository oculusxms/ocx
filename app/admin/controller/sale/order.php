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

namespace Admin\Controller\Sale;
use Oculus\Engine\Controller;

class Order extends Controller {
    private $error = array();
    
    public function index() {
        $this->language->load('sale/order');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('sale/order');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function insert() {
        $this->language->load('sale/order');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('sale/order');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_order->addOrder($this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_order_id'])) {
                $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }
            
            if (isset($this->request->get['filter_customer'])) {
                $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_order_status_id'])) {
                $url.= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
            }
            
            if (isset($this->request->get['filter_total'])) {
                $url.= '&filter_total=' . $this->request->get['filter_total'];
            }
            
            if (isset($this->request->get['filter_date_added'])) {
                $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }
            
            if (isset($this->request->get['filter_date_modified'])) {
                $url.= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
            }
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function update() {
        $this->language->load('sale/order');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('sale/order');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_order->editOrder($this->request->get['order_id'], $this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_order_id'])) {
                $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }
            
            if (isset($this->request->get['filter_customer'])) {
                $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_order_status_id'])) {
                $url.= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
            }
            
            if (isset($this->request->get['filter_total'])) {
                $url.= '&filter_total=' . $this->request->get['filter_total'];
            }
            
            if (isset($this->request->get['filter_date_added'])) {
                $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }
            
            if (isset($this->request->get['filter_date_modified'])) {
                $url.= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
            }
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function delete() {
        $this->language->load('sale/order');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('sale/order');
        
        if (isset($this->request->post['selected']) && ($this->validateDelete())) {
            foreach ($this->request->post['selected'] as $order_id) {
                $this->model_sale_order->deleteOrder($order_id);
            }
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_order_id'])) {
                $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }
            
            if (isset($this->request->get['filter_customer'])) {
                $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_order_status_id'])) {
                $url.= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
            }
            
            if (isset($this->request->get['filter_total'])) {
                $url.= '&filter_total=' . $this->request->get['filter_total'];
            }
            
            if (isset($this->request->get['filter_date_added'])) {
                $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }
            
            if (isset($this->request->get['filter_date_modified'])) {
                $url.= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
            }
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    protected function getList() {
        $data = $this->theme->language('sale/order');
        //$this->theme->test($this->session->data);
        if (isset($this->request->get['filter_order_id'])) {
            $filter_order_id = $this->request->get['filter_order_id'];
        } else {
            $filter_order_id = null;
        }
        
        if (isset($this->request->get['filter_customer'])) {
            $filter_customer = $this->request->get['filter_customer'];
        } else {
            $filter_customer = null;
        }
        
        if (isset($this->request->get['filter_order_status_id'])) {
            $filter_order_status_id = $this->request->get['filter_order_status_id'];
        } else {
            $filter_order_status_id = null;
        }
        
        if (isset($this->request->get['filter_total'])) {
            $filter_total = $this->request->get['filter_total'];
        } else {
            $filter_total = null;
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }
        
        if (isset($this->request->get['filter_date_modified'])) {
            $filter_date_modified = $this->request->get['filter_date_modified'];
        } else {
            $filter_date_modified = null;
        }
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'o.order_id';
        }
        
        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $url = '';
        
        if (isset($this->request->get['filter_order_id'])) {
            $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }
        
        if (isset($this->request->get['filter_customer'])) {
            $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_order_status_id'])) {
            $url.= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
        }
        
        if (isset($this->request->get['filter_total'])) {
            $url.= '&filter_total=' . $this->request->get['filter_total'];
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }
        
        if (isset($this->request->get['filter_date_modified'])) {
            $url.= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
        }
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $this->breadcrumb->add('lang_heading_title', 'sale/order', $url);
        
        $data['invoice'] = $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'], 'SSL');
        $data['insert']  = $this->url->link('sale/order/insert', 'token=' . $this->session->data['token'], 'SSL');
        $data['delete']  = $this->url->link('sale/order/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        $data['orders'] = array();
        
        $filter = array(
            'filter_order_id'        => $filter_order_id, 
            'filter_customer'        => $filter_customer, 
            'filter_order_status_id' => $filter_order_status_id, 
            'filter_total'           => $filter_total, 
            'filter_date_added'      => $filter_date_added, 
            'filter_date_modified'   => $filter_date_modified, 
            'sort'                   => $sort, 
            'order'                  => $order, 
            'start'                  => ($page - 1) * $this->config->get('config_admin_limit'), 
            'limit'                  => $this->config->get('config_admin_limit')
        );
        
        $order_total = $this->model_sale_order->getTotalOrders($filter);
        
        $results = $this->model_sale_order->getOrders($filter);
        
        foreach ($results as $result) {
            $action = array();
            
            $action[] = array(
                'text' => $this->language->get('lang_text_view'), 
                'href' => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
            );
            
            if (strtotime($result['date_added']) > strtotime('-' . (int)$this->config->get('config_order_edit') . ' day')) {
                $action[] = array(
                    'text' => $this->language->get('lang_text_edit'), 
                    'href' => $this->url->link('sale/order/update', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
                );
            }
            
            $data['orders'][] = array(
                'order_id'      => $result['order_id'], 
                'customer'      => $result['customer'], 
                'status'        => $result['status'], 
                'total'         => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']), 
                'date_added'    => date($this->language->get('lang_date_format_short'), strtotime($result['date_added'])), 
                'date_modified' => date($this->language->get('lang_date_format_short'), strtotime($result['date_modified'])), 
                'selected'      => isset($this->request->post['selected']) && in_array($result['order_id'], $this->request->post['selected']), 
                'action'        => $action
            );
        }
        
        $data['token'] = $this->session->data['token'];
        
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
        
        if (isset($this->request->get['filter_order_id'])) {
            $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }
        
        if (isset($this->request->get['filter_customer'])) {
            $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_order_status_id'])) {
            $url.= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
        }
        
        if (isset($this->request->get['filter_total'])) {
            $url.= '&filter_total=' . $this->request->get['filter_total'];
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }
        
        if (isset($this->request->get['filter_date_modified'])) {
            $url.= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
        }
        
        if ($order == 'ASC') {
            $url.= '&order=DESC';
        } else {
            $url.= '&order=ASC';
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $data['sort_order']         = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.order_id' . $url, 'SSL');
        $data['sort_customer']      = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
        $data['sort_status']        = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
        $data['sort_total']         = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.total' . $url, 'SSL');
        $data['sort_date_added']    = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_added' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_modified' . $url, 'SSL');
        
        $url = '';
        
        if (isset($this->request->get['filter_order_id'])) {
            $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }
        
        if (isset($this->request->get['filter_customer'])) {
            $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_order_status_id'])) {
            $url.= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
        }
        
        if (isset($this->request->get['filter_total'])) {
            $url.= '&filter_total=' . $this->request->get['filter_total'];
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }
        
        if (isset($this->request->get['filter_date_modified'])) {
            $url.= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
        }
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        $data['pagination'] = $this->theme->paginate(
            $order_total, 
            $page, 
            $this->config->get('config_admin_limit'), 
            $this->language->get('lang_text_pagination'), 
            $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL')
        );
        
        $data['filter_order_id']        = $filter_order_id;
        $data['filter_customer']        = $filter_customer;
        $data['filter_order_status_id'] = $filter_order_status_id;
        $data['filter_total']           = $filter_total;
        $data['filter_date_added']      = $filter_date_added;
        $data['filter_date_modified']   = $filter_date_modified;
        
        $this->theme->model('localization/orderstatus');
        
        $data['order_statuses'] = $this->model_localization_orderstatus->getOrderStatuses();
        
        $data['sort']  = $sort;
        $data['order'] = $order;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('sale/order_list', $data));
    }
    
    public function getForm() {
        $data = $this->theme->language('sale/order');
        
        $this->theme->model('people/customer');
        
        $this->javascript->register('ajaxupload.min', 'jquery');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['firstname'])) {
            $data['error_firstname'] = $this->error['firstname'];
        } else {
            $data['error_firstname'] = '';
        }
        
        if (isset($this->error['lastname'])) {
            $data['error_lastname'] = $this->error['lastname'];
        } else {
            $data['error_lastname'] = '';
        }
        
        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
        }
        
        if (isset($this->error['telephone'])) {
            $data['error_telephone'] = $this->error['telephone'];
        } else {
            $data['error_telephone'] = '';
        }
        
        if (isset($this->error['payment_firstname'])) {
            $data['error_payment_firstname'] = $this->error['payment_firstname'];
        } else {
            $data['error_payment_firstname'] = '';
        }
        
        if (isset($this->error['payment_lastname'])) {
            $data['error_payment_lastname'] = $this->error['payment_lastname'];
        } else {
            $data['error_payment_lastname'] = '';
        }
        
        if (isset($this->error['payment_address_1'])) {
            $data['error_payment_address_1'] = $this->error['payment_address_1'];
        } else {
            $data['error_payment_address_1'] = '';
        }
        
        if (isset($this->error['payment_city'])) {
            $data['error_payment_city'] = $this->error['payment_city'];
        } else {
            $data['error_payment_city'] = '';
        }
        
        if (isset($this->error['payment_postcode'])) {
            $data['error_payment_postcode'] = $this->error['payment_postcode'];
        } else {
            $data['error_payment_postcode'] = '';
        }
        
        if (isset($this->error['payment_tax_id'])) {
            $data['error_payment_tax_id'] = $this->error['payment_tax_id'];
        } else {
            $data['error_payment_tax_id'] = '';
        }
        
        if (isset($this->error['payment_country'])) {
            $data['error_payment_country'] = $this->error['payment_country'];
        } else {
            $data['error_payment_country'] = '';
        }
        
        if (isset($this->error['payment_zone'])) {
            $data['error_payment_zone'] = $this->error['payment_zone'];
        } else {
            $data['error_payment_zone'] = '';
        }
        
        if (isset($this->error['payment_method'])) {
            $data['error_payment_method'] = $this->error['payment_method'];
        } else {
            $data['error_payment_method'] = '';
        }
        
        if (isset($this->error['shipping_firstname'])) {
            $data['error_shipping_firstname'] = $this->error['shipping_firstname'];
        } else {
            $data['error_shipping_firstname'] = '';
        }
        
        if (isset($this->error['shipping_lastname'])) {
            $data['error_shipping_lastname'] = $this->error['shipping_lastname'];
        } else {
            $data['error_shipping_lastname'] = '';
        }
        
        if (isset($this->error['shipping_address_1'])) {
            $data['error_shipping_address_1'] = $this->error['shipping_address_1'];
        } else {
            $data['error_shipping_address_1'] = '';
        }
        
        if (isset($this->error['shipping_city'])) {
            $data['error_shipping_city'] = $this->error['shipping_city'];
        } else {
            $data['error_shipping_city'] = '';
        }
        
        if (isset($this->error['shipping_postcode'])) {
            $data['error_shipping_postcode'] = $this->error['shipping_postcode'];
        } else {
            $data['error_shipping_postcode'] = '';
        }
        
        if (isset($this->error['shipping_country'])) {
            $data['error_shipping_country'] = $this->error['shipping_country'];
        } else {
            $data['error_shipping_country'] = '';
        }
        
        if (isset($this->error['shipping_zone'])) {
            $data['error_shipping_zone'] = $this->error['shipping_zone'];
        } else {
            $data['error_shipping_zone'] = '';
        }
        
        if (isset($this->error['shipping_method'])) {
            $data['error_shipping_method'] = $this->error['shipping_method'];
        } else {
            $data['error_shipping_method'] = '';
        }
        
        $url = '';
        
        if (isset($this->request->get['filter_order_id'])) {
            $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }
        
        if (isset($this->request->get['filter_customer'])) {
            $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_order_status_id'])) {
            $url.= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
        }
        
        if (isset($this->request->get['filter_total'])) {
            $url.= '&filter_total=' . $this->request->get['filter_total'];
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }
        
        if (isset($this->request->get['filter_date_modified'])) {
            $url.= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
        }
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $this->breadcrumb->add('lang_heading_title', 'sale/order', $url);
        
        if (!isset($this->request->get['order_id'])) {
            $data['action'] = $this->url->link('sale/order/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('sale/order/update', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . $url, 'SSL');
        }
        
        $data['cancel'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        if (isset($this->request->get['order_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
        }
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->request->get['order_id'])) {
            $data['order_id'] = $this->request->get['order_id'];
        } else {
            $data['order_id'] = 0;
        }
        
        if (isset($this->request->post['store_id'])) {
            $data['store_id'] = $this->request->post['store_id'];
        } elseif (!empty($order_info)) {
            $data['store_id'] = $order_info['store_id'];
        } else {
            $data['store_id'] = '';
        }
        
        $this->theme->model('setting/store');
        
        $data['stores'] = $this->model_setting_store->getStores();
        
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $data['store_url'] = $this->app['https.public'];
        } else {
            $data['store_url'] = $this->app['http.public'];
        }
        
        if (isset($this->request->post['customer'])) {
            $data['customer'] = $this->request->post['customer'];
        } elseif (!empty($order_info)) {
            $data['customer'] = $order_info['customer'];
        } else {
            $data['customer'] = '';
        }
        
        if (isset($this->request->post['customer_id'])) {
            $data['customer_id'] = $this->request->post['customer_id'];
        } elseif (!empty($order_info)) {
            $data['customer_id'] = $order_info['customer_id'];
        } else {
            $data['customer_id'] = '';
        }
        
        if (isset($this->request->post['customer_group_id'])) {
            $data['customer_group_id'] = $this->request->post['customer_group_id'];
        } elseif (!empty($order_info)) {
            $data['customer_group_id'] = $order_info['customer_group_id'];
        } else {
            $data['customer_group_id'] = '';
        }
        
        $this->theme->model('people/customergroup');
        
        $data['customer_groups'] = $this->model_people_customergroup->getCustomerGroups();
        
        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        } elseif (!empty($order_info)) {
            $data['firstname'] = $order_info['firstname'];
        } else {
            $data['firstname'] = '';
        }
        
        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        } elseif (!empty($order_info)) {
            $data['lastname'] = $order_info['lastname'];
        } else {
            $data['lastname'] = '';
        }
        
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($order_info)) {
            $data['email'] = $order_info['email'];
        } else {
            $data['email'] = '';
        }
        
        if (isset($this->request->post['telephone'])) {
            $data['telephone'] = $this->request->post['telephone'];
        } elseif (!empty($order_info)) {
            $data['telephone'] = $order_info['telephone'];
        } else {
            $data['telephone'] = '';
        }
        
        if (isset($this->request->post['affiliate_id'])) {
            $data['affiliate_id'] = $this->request->post['affiliate_id'];
        } elseif (!empty($order_info)) {
            $data['affiliate_id'] = $order_info['affiliate_id'];
        } else {
            $data['affiliate_id'] = '';
        }
        
        if (isset($this->request->post['affiliate'])) {
            $data['affiliate'] = $this->request->post['affiliate'];
        } elseif (!empty($order_info)) {
            $data['affiliate'] = ($order_info['affiliate_id'] ? $order_info['affiliate_firstname'] . ' ' . $order_info['affiliate_lastname'] : '');
        } else {
            $data['affiliate'] = '';
        }
        
        if (isset($this->request->post['order_status_id'])) {
            $data['order_status_id'] = $this->request->post['order_status_id'];
        } elseif (!empty($order_info)) {
            $data['order_status_id'] = $order_info['order_status_id'];
        } else {
            $data['order_status_id'] = '';
        }
        
        $this->theme->model('localization/orderstatus');
        
        $data['order_statuses'] = $this->model_localization_orderstatus->getOrderStatuses();
        
        if (isset($this->request->post['comment'])) {
            $data['comment'] = $this->request->post['comment'];
        } elseif (!empty($order_info)) {
            $data['comment'] = $order_info['comment'];
        } else {
            $data['comment'] = '';
        }
        
        $this->theme->model('people/customer');
        
        if (isset($this->request->post['customer_id'])) {
            $data['addresses'] = $this->model_people_customer->getAddresses($this->request->post['customer_id']);
        } elseif (!empty($order_info)) {
            $data['addresses'] = $this->model_people_customer->getAddresses($order_info['customer_id']);
        } else {
            $data['addresses'] = array();
        }
        
        if (isset($this->request->post['payment_firstname'])) {
            $data['payment_firstname'] = $this->request->post['payment_firstname'];
        } elseif (!empty($order_info)) {
            $data['payment_firstname'] = $order_info['payment_firstname'];
        } else {
            $data['payment_firstname'] = '';
        }
        
        if (isset($this->request->post['payment_lastname'])) {
            $data['payment_lastname'] = $this->request->post['payment_lastname'];
        } elseif (!empty($order_info)) {
            $data['payment_lastname'] = $order_info['payment_lastname'];
        } else {
            $data['payment_lastname'] = '';
        }
        
        if (isset($this->request->post['payment_company'])) {
            $data['payment_company'] = $this->request->post['payment_company'];
        } elseif (!empty($order_info)) {
            $data['payment_company'] = $order_info['payment_company'];
        } else {
            $data['payment_company'] = '';
        }
        
        if (isset($this->request->post['payment_company_id'])) {
            $data['payment_company_id'] = $this->request->post['payment_company_id'];
        } elseif (!empty($order_info)) {
            $data['payment_company_id'] = $order_info['payment_company_id'];
        } else {
            $data['payment_company_id'] = '';
        }
        
        if (isset($this->request->post['payment_tax_id'])) {
            $data['payment_tax_id'] = $this->request->post['payment_tax_id'];
        } elseif (!empty($order_info)) {
            $data['payment_tax_id'] = $order_info['payment_tax_id'];
        } else {
            $data['payment_tax_id'] = '';
        }
        
        if (isset($this->request->post['payment_address_1'])) {
            $data['payment_address_1'] = $this->request->post['payment_address_1'];
        } elseif (!empty($order_info)) {
            $data['payment_address_1'] = $order_info['payment_address_1'];
        } else {
            $data['payment_address_1'] = '';
        }
        
        if (isset($this->request->post['payment_address_2'])) {
            $data['payment_address_2'] = $this->request->post['payment_address_2'];
        } elseif (!empty($order_info)) {
            $data['payment_address_2'] = $order_info['payment_address_2'];
        } else {
            $data['payment_address_2'] = '';
        }
        
        if (isset($this->request->post['payment_city'])) {
            $data['payment_city'] = $this->request->post['payment_city'];
        } elseif (!empty($order_info)) {
            $data['payment_city'] = $order_info['payment_city'];
        } else {
            $data['payment_city'] = '';
        }
        
        if (isset($this->request->post['payment_postcode'])) {
            $data['payment_postcode'] = $this->request->post['payment_postcode'];
        } elseif (!empty($order_info)) {
            $data['payment_postcode'] = $order_info['payment_postcode'];
        } else {
            $data['payment_postcode'] = '';
        }
        
        if (isset($this->request->post['payment_country_id'])) {
            $data['payment_country_id'] = $this->request->post['payment_country_id'];
        } elseif (!empty($order_info)) {
            $data['payment_country_id'] = $order_info['payment_country_id'];
        } else {
            $data['payment_country_id'] = '';
        }
        
        if (isset($this->request->post['payment_zone_id'])) {
            $data['payment_zone_id'] = $this->request->post['payment_zone_id'];
        } elseif (!empty($order_info)) {
            $data['payment_zone_id'] = $order_info['payment_zone_id'];
        } else {
            $data['payment_zone_id'] = '';
        }
        
        if (isset($this->request->post['payment_method'])) {
            $data['payment_method'] = $this->request->post['payment_method'];
        } elseif (!empty($order_info)) {
            $data['payment_method'] = $order_info['payment_method'];
        } else {
            $data['payment_method'] = '';
        }
        
        if (isset($this->request->post['payment_code'])) {
            $data['payment_code'] = $this->request->post['payment_code'];
        } elseif (!empty($order_info)) {
            $data['payment_code'] = $order_info['payment_code'];
        } else {
            $data['payment_code'] = '';
        }
        
        if (isset($this->request->post['shipping_firstname'])) {
            $data['shipping_firstname'] = $this->request->post['shipping_firstname'];
        } elseif (!empty($order_info)) {
            $data['shipping_firstname'] = $order_info['shipping_firstname'];
        } else {
            $data['shipping_firstname'] = '';
        }
        
        if (isset($this->request->post['shipping_lastname'])) {
            $data['shipping_lastname'] = $this->request->post['shipping_lastname'];
        } elseif (!empty($order_info)) {
            $data['shipping_lastname'] = $order_info['shipping_lastname'];
        } else {
            $data['shipping_lastname'] = '';
        }
        
        if (isset($this->request->post['shipping_company'])) {
            $data['shipping_company'] = $this->request->post['shipping_company'];
        } elseif (!empty($order_info)) {
            $data['shipping_company'] = $order_info['shipping_company'];
        } else {
            $data['shipping_company'] = '';
        }
        
        if (isset($this->request->post['shipping_address_1'])) {
            $data['shipping_address_1'] = $this->request->post['shipping_address_1'];
        } elseif (!empty($order_info)) {
            $data['shipping_address_1'] = $order_info['shipping_address_1'];
        } else {
            $data['shipping_address_1'] = '';
        }
        
        if (isset($this->request->post['shipping_address_2'])) {
            $data['shipping_address_2'] = $this->request->post['shipping_address_2'];
        } elseif (!empty($order_info)) {
            $data['shipping_address_2'] = $order_info['shipping_address_2'];
        } else {
            $data['shipping_address_2'] = '';
        }
        
        if (isset($this->request->post['shipping_city'])) {
            $data['shipping_city'] = $this->request->post['shipping_city'];
        } elseif (!empty($order_info)) {
            $data['shipping_city'] = $order_info['shipping_city'];
        } else {
            $data['shipping_city'] = '';
        }
        
        if (isset($this->request->post['shipping_postcode'])) {
            $data['shipping_postcode'] = $this->request->post['shipping_postcode'];
        } elseif (!empty($order_info)) {
            $data['shipping_postcode'] = $order_info['shipping_postcode'];
        } else {
            $data['shipping_postcode'] = '';
        }
        
        if (isset($this->request->post['shipping_country_id'])) {
            $data['shipping_country_id'] = $this->request->post['shipping_country_id'];
        } elseif (!empty($order_info)) {
            $data['shipping_country_id'] = $order_info['shipping_country_id'];
        } else {
            $data['shipping_country_id'] = '';
        }
        
        if (isset($this->request->post['shipping_zone_id'])) {
            $data['shipping_zone_id'] = $this->request->post['shipping_zone_id'];
        } elseif (!empty($order_info)) {
            $data['shipping_zone_id'] = $order_info['shipping_zone_id'];
        } else {
            $data['shipping_zone_id'] = '';
        }
        
        $this->theme->model('localization/country');
        
        $data['countries'] = $this->model_localization_country->getCountries();
        
        if (isset($this->request->post['shipping_method'])) {
            $data['shipping_method'] = $this->request->post['shipping_method'];
        } elseif (!empty($order_info)) {
            $data['shipping_method'] = $order_info['shipping_method'];
        } else {
            $data['shipping_method'] = '';
        }
        
        if (isset($this->request->post['shipping_code'])) {
            $data['shipping_code'] = $this->request->post['shipping_code'];
        } elseif (!empty($order_info)) {
            $data['shipping_code'] = $order_info['shipping_code'];
        } else {
            $data['shipping_code'] = '';
        }
        
        if (isset($this->request->post['order_product'])) {
            $order_products = $this->request->post['order_product'];
        } elseif (isset($this->request->get['order_id'])) {
            $order_products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);
        } else {
            $order_products = array();
        }
        
        $this->theme->model('catalog/product');
        
        $this->javascript->register('ajaxupload.min', 'jquery');
        
        $data['order_products'] = array();
        
        foreach ($order_products as $order_product) {
            if (isset($order_product['order_option'])) {
                $order_option = $order_product['order_option'];
            } elseif (isset($this->request->get['order_id'])) {
                $order_option = $this->model_sale_order->getOrderOptions($this->request->get['order_id'], $order_product['order_product_id']);
            } else {
                $order_option = array();
            }
            
            if (isset($order_product['order_download'])) {
                $order_download = $order_product['order_download'];
            } elseif (isset($this->request->get['order_id'])) {
                $order_download = $this->model_sale_order->getOrderDownloads($this->request->get['order_id'], $order_product['order_product_id']);
            } else {
                $order_download = array();
            }
            
            $data['order_products'][] = array(
                'order_product_id' => $order_product['order_product_id'], 
                'product_id'       => $order_product['product_id'], 
                'name'             => $order_product['name'], 
                'model'            => $order_product['model'], 
                'option'           => $order_option, 
                'download'         => $order_download, 
                'quantity'         => $order_product['quantity'], 
                'price'            => number_format($order_product['price'], 2), 
                'total'            => number_format($order_product['total'], 2), 
                'tax'              => $order_product['tax'], 
                'reward'           => $order_product['reward']
            );
        }
        
        if (isset($this->request->post['order_giftcard'])) {
            $data['order_giftcards'] = $this->request->post['order_giftcard'];
        } elseif (isset($this->request->get['order_id'])) {
            $data['order_giftcards'] = $this->model_sale_order->getOrderGiftcards($this->request->get['order_id']);
        } else {
            $data['order_giftcards'] = array();
        }
        
        $this->theme->model('sale/giftcardtheme');
        
        $data['giftcard_themes'] = $this->model_sale_giftcardtheme->getGiftcardThemes();
        
        if (isset($this->request->post['order_total'])) {
            $data['order_totals'] = $this->request->post['order_total'];
        } elseif (isset($this->request->get['order_id'])) {
            $data['order_totals'] = $this->model_sale_order->getOrderTotals($this->request->get['order_id']);
        } else {
            $data['order_totals'] = array();
        }
        
        $this->theme->loadjs('javascript/sale/order_form', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('sale/order_form', $data));
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        if (($this->encode->strlen($this->request->post['firstname']) < 1) || ($this->encode->strlen($this->request->post['firstname']) > 32)) {
            $this->error['firstname'] = $this->language->get('lang_error_firstname');
        }
        
        if (($this->encode->strlen($this->request->post['lastname']) < 1) || ($this->encode->strlen($this->request->post['lastname']) > 32)) {
            $this->error['lastname'] = $this->language->get('lang_error_lastname');
        }
        
        if (($this->encode->strlen($this->request->post['email']) > 96) || (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email']))) {
            $this->error['email'] = $this->language->get('lang_error_email');
        }
        
        if (($this->encode->strlen($this->request->post['telephone']) < 3) || ($this->encode->strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('lang_error_telephone');
        }
        
        if (($this->encode->strlen($this->request->post['payment_firstname']) < 1) || ($this->encode->strlen($this->request->post['payment_firstname']) > 32)) {
            $this->error['payment_firstname'] = $this->language->get('lang_error_firstname');
        }
        
        if (($this->encode->strlen($this->request->post['payment_lastname']) < 1) || ($this->encode->strlen($this->request->post['payment_lastname']) > 32)) {
            $this->error['payment_lastname'] = $this->language->get('lang_error_lastname');
        }
        
        if (($this->encode->strlen($this->request->post['payment_address_1']) < 3) || ($this->encode->strlen($this->request->post['payment_address_1']) > 128)) {
            $this->error['payment_address_1'] = $this->language->get('lang_error_address_1');
        }
        
        if (($this->encode->strlen($this->request->post['payment_city']) < 3) || ($this->encode->strlen($this->request->post['payment_city']) > 128)) {
            $this->error['payment_city'] = $this->language->get('lang_error_city');
        }
        
        $this->theme->model('localization/country');
        
        $country_info = $this->model_localization_country->getCountry($this->request->post['payment_country_id']);
        
        if ($country_info) {
            if ($country_info['postcode_required'] && ($this->encode->strlen($this->request->post['payment_postcode']) < 2) || ($this->encode->strlen($this->request->post['payment_postcode']) > 10)) {
                $this->error['payment_postcode'] = $this->language->get('lang_error_postcode');
            }
            
            if ($this->config->get('config_vat') && $this->request->post['payment_tax_id'] && ($this->vat->validate($country_info['iso_code_2'], $this->request->post['payment_tax_id']) == 'invalid')) {
                $this->error['payment_tax_id'] = $this->language->get('lang_error_vat');
            }
        }
        
        if ($this->request->post['payment_country_id'] == '') {
            $this->error['payment_country'] = $this->language->get('lang_error_country');
        }
        
        if (!isset($this->request->post['payment_zone_id']) || $this->request->post['payment_zone_id'] == '') {
            $this->error['payment_zone'] = $this->language->get('lang_error_zone');
        }
        
        if (!isset($this->request->post['payment_method']) || $this->request->post['payment_method'] == '') {
            $this->error['payment_method'] = $this->language->get('lang_error_payment');
        }
        
        // Check if any products require shipping
        $shipping = false;
        
        if (isset($this->request->post['order_product'])) {
            $this->theme->model('catalog/product');
            
            foreach ($this->request->post['order_product'] as $order_product) {
                $product_info = $this->model_catalog_product->getProduct($order_product['product_id']);
                
                if ($product_info && $product_info['shipping']) {
                    $shipping = true;
                }
            }
        }
        
        if ($shipping) {
            if (($this->encode->strlen($this->request->post['shipping_firstname']) < 1) || ($this->encode->strlen($this->request->post['shipping_firstname']) > 32)) {
                $this->error['shipping_firstname'] = $this->language->get('lang_error_firstname');
            }
            
            if (($this->encode->strlen($this->request->post['shipping_lastname']) < 1) || ($this->encode->strlen($this->request->post['shipping_lastname']) > 32)) {
                $this->error['shipping_lastname'] = $this->language->get('lang_error_lastname');
            }
            
            if (($this->encode->strlen($this->request->post['shipping_address_1']) < 3) || ($this->encode->strlen($this->request->post['shipping_address_1']) > 128)) {
                $this->error['shipping_address_1'] = $this->language->get('lang_error_address_1');
            }
            
            if (($this->encode->strlen($this->request->post['shipping_city']) < 3) || ($this->encode->strlen($this->request->post['shipping_city']) > 128)) {
                $this->error['shipping_city'] = $this->language->get('lang_error_city');
            }
            
            $this->theme->model('localization/country');
            
            $country_info = $this->model_localization_country->getCountry($this->request->post['shipping_country_id']);
            
            if ($country_info && $country_info['postcode_required'] && ($this->encode->strlen($this->request->post['shipping_postcode']) < 2) || ($this->encode->strlen($this->request->post['shipping_postcode']) > 10)) {
                $this->error['shipping_postcode'] = $this->language->get('lang_error_postcode');
            }
            
            if ($this->request->post['shipping_country_id'] == '') {
                $this->error['shipping_country'] = $this->language->get('lang_error_country');
            }
            
            if (!isset($this->request->post['shipping_zone_id']) || $this->request->post['shipping_zone_id'] == '') {
                $this->error['shipping_zone'] = $this->language->get('lang_error_zone');
            }
            
            if (!$this->request->post['shipping_method']) {
                $this->error['shipping_method'] = $this->language->get('lang_error_shipping');
            }
        }
        
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('lang_error_warning');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    public function country() {
        $json = array();
        
        $this->theme->model('localization/country');
        
        $country_info = $this->model_localization_country->getCountry($this->request->get['country_id']);
        
        if ($country_info) {
            $this->theme->model('localization/zone');
            
            $json = array(
                'country_id'        => $country_info['country_id'], 
                'name'              => $country_info['name'], 
                'iso_code_2'        => $country_info['iso_code_2'], 
                'iso_code_3'        => $country_info['iso_code_3'], 
                'address_format'    => $country_info['address_format'], 
                'postcode_required' => $country_info['postcode_required'], 
                'zone'              => $this->model_localization_zone->getZonesByCountryId($this->request->get['country_id']), 
                'status'            => $country_info['status']
            );
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function info() {
        $this->theme->model('sale/order');
        
        if (isset($this->request->get['order_id'])) {
            $order_id = $this->request->get['order_id'];
        } else {
            $order_id = 0;
        }
        
        $order_info = $this->model_sale_order->getOrder($order_id);
        
        if ($order_info) {
            $data = $this->theme->language('sale/order');
            
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['error_warning'] = '';
            }
            
            $this->theme->setTitle($this->language->get('lang_heading_title'));
            
            $data['token'] = $this->session->data['token'];
            
            $url = '';
            
            if (isset($this->request->get['filter_order_id'])) {
                $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }
            
            if (isset($this->request->get['filter_customer'])) {
                $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_order_status_id'])) {
                $url.= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
            }
            
            if (isset($this->request->get['filter_total'])) {
                $url.= '&filter_total=' . $this->request->get['filter_total'];
            }
            
            if (isset($this->request->get['filter_date_added'])) {
                $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }
            
            if (isset($this->request->get['filter_date_modified'])) {
                $url.= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
            }
            
            if (isset($this->request->get['sort'])) {
                $url.= '&sort=' . $this->request->get['sort'];
            }
            
            if (isset($this->request->get['order'])) {
                $url.= '&order=' . $this->request->get['order'];
            }
            
            if (isset($this->request->get['page'])) {
                $url.= '&page=' . $this->request->get['page'];
            }
            
            $this->breadcrumb->add('lang_heading_title', 'sale/order', $url);
            
            $data['invoice'] = $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            $data['cancel']  = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');
            
            $data['order_id'] = $this->request->get['order_id'];
            
            if ($order_info['invoice_no']) {
                $data['invoice_no'] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
            } else {
                $data['invoice_no'] = '';
            }
            
            $data['store_name'] = $order_info['store_name'];
            $data['store_url']  = $order_info['store_url'];
            $data['firstname']  = $order_info['firstname'];
            $data['lastname']   = $order_info['lastname'];
            
            if ($order_info['customer_id']) {
                $data['customer'] = $this->url->link('people/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $order_info['customer_id'], 'SSL');
            } else {
                $data['customer'] = '';
            }
            
            $this->theme->model('people/customergroup');
            
            $customer_group_info = $this->model_people_customergroup->getCustomerGroup($order_info['customer_group_id']);
            
            if ($customer_group_info) {
                $data['customer_group'] = $customer_group_info['name'];
            } else {
                $data['customer_group'] = '';
            }
            
            $data['email']           = $order_info['email'];
            $data['telephone']       = $order_info['telephone'];
            $data['comment']         = nl2br($order_info['comment']);
            $data['shipping_method'] = $order_info['shipping_method'];
            $data['payment_method']  = $order_info['payment_method'];
            $data['total']           = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value']);
            
            if ($order_info['total'] < 0) {
                $data['credit'] = $order_info['total'];
            } else {
                $data['credit'] = 0;
            }
            
            $this->theme->model('people/customer');
            
            $data['credit_total']        = $this->model_people_customer->getTotalCreditsByOrderId($this->request->get['order_id']);
            $data['reward']              = $order_info['reward'];
            $data['reward_total']        = $this->model_people_customer->getTotalCustomerRewardsByOrderId($this->request->get['order_id']);
            $data['affiliate_firstname'] = $order_info['affiliate_firstname'];
            $data['affiliate_lastname']  = $order_info['affiliate_lastname'];
            
            if ($order_info['affiliate_id']) {
                $data['affiliate'] = $this->url->link('people/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $order_info['affiliate_id'], 'SSL');
            } else {
                $data['affiliate'] = '';
            }
            
            $data['commission']       = $this->currency->format($order_info['commission'], $order_info['currency_code'], $order_info['currency_value']);
            $data['commission_total'] = $this->model_people_customer->getTotalCommissionsByOrderId($this->request->get['order_id']);
            
            $this->theme->model('localization/orderstatus');
            
            $order_status_info = $this->model_localization_orderstatus->getOrderStatus($order_info['order_status_id']);
            
            if ($order_status_info) {
                $data['order_status'] = $order_status_info['name'];
            } else {
                $data['order_status'] = '';
            }
            
            $data['ip']                 = $order_info['ip'];
            $data['forwarded_ip']       = $order_info['forwarded_ip'];
            $data['user_agent']         = $order_info['user_agent'];
            $data['accept_language']    = $order_info['accept_language'];
            $data['date_added']         = date($this->language->get('lang_date_format_short'), strtotime($order_info['date_added']));
            $data['date_modified']      = date($this->language->get('lang_date_format_short'), strtotime($order_info['date_modified']));
            $data['payment_firstname']  = $order_info['payment_firstname'];
            $data['payment_lastname']   = $order_info['payment_lastname'];
            $data['payment_company']    = $order_info['payment_company'];
            $data['payment_company_id'] = $order_info['payment_company_id'];
            $data['payment_tax_id']     = $order_info['payment_tax_id'];
            $data['payment_address_1']  = $order_info['payment_address_1'];
            $data['payment_address_2']  = $order_info['payment_address_2'];
            $data['payment_city']       = $order_info['payment_city'];
            $data['payment_postcode']   = $order_info['payment_postcode'];
            $data['payment_zone']       = $order_info['payment_zone'];
            $data['payment_zone_code']  = $order_info['payment_zone_code'];
            $data['payment_country']    = $order_info['payment_country'];
            $data['shipping_firstname'] = $order_info['shipping_firstname'];
            $data['shipping_lastname']  = $order_info['shipping_lastname'];
            $data['shipping_company']   = $order_info['shipping_company'];
            $data['shipping_address_1'] = $order_info['shipping_address_1'];
            $data['shipping_address_2'] = $order_info['shipping_address_2'];
            $data['shipping_city']      = $order_info['shipping_city'];
            $data['shipping_postcode']  = $order_info['shipping_postcode'];
            $data['shipping_zone']      = $order_info['shipping_zone'];
            $data['shipping_zone_code'] = $order_info['shipping_zone_code'];
            $data['shipping_country']   = $order_info['shipping_country'];
            
            $data['products'] = array();
            
            $products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);
            
            foreach ($products as $product) {
                $option_data = array();
                
                $options = $this->model_sale_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']);
                
                foreach ($options as $option) {
                    if ($option['type'] != 'file') {
                        $option_data[] = array(
                            'name'  => $option['name'], 
                            'value' => $option['value'], 
                            'type'  => $option['type']
                        );
                    } else {
                        $option_data[] = array(
                            'name'  => $option['name'], 
                            'value' => $this->encode->substr($option['value'], 0, $this->encode->strrpos($option['value'], '.')), 
                            'type'  => $option['type'], 
                            'href'  => $this->url->link('sale/order/download', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . '&order_option_id=' . $option['order_option_id'], 'SSL')
                        );
                    }
                }
                
                $data['products'][] = array(
                    'order_product_id' => $product['order_product_id'], 
                    'product_id'       => $product['product_id'], 
                    'name'             => $product['name'], 
                    'model'            => $product['model'], 
                    'option'           => $option_data, 
                    'quantity'         => $product['quantity'], 
                    'price'            => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']), 
                    'total'            => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']), 
                    'href'             => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $product['product_id'], 'SSL')
                );
            }
            
            $data['giftcards'] = array();
            
            $giftcards = $this->model_sale_order->getOrderGiftcards($this->request->get['order_id']);
            
            foreach ($giftcards as $giftcard) {
                $data['giftcards'][] = array(
                    'description' => $giftcard['description'], 
                    'amount'      => $this->currency->format($giftcard['amount'], $order_info['currency_code'], $order_info['currency_value']), 
                    'href'        => $this->url->link('sale/giftcard/update', 'token=' . $this->session->data['token'] . '&giftcard_id=' . $giftcard['giftcard_id'], 'SSL')
                );
            }
            
            $data['totals'] = $this->model_sale_order->getOrderTotals($this->request->get['order_id']);
            
            $data['downloads'] = array();
            
            foreach ($products as $product) {
                $results = $this->model_sale_order->getOrderDownloads($this->request->get['order_id'], $product['order_product_id']);
                
                foreach ($results as $result) {
                    $data['downloads'][] = array(
                        'name'      => $result['name'], 
                        'filename'  => $result['mask'], 
                        'remaining' => $result['remaining']
                    );
                }
            }
            
            $data['order_statuses']  = $this->model_localization_orderstatus->getOrderStatuses();
            $data['order_status_id'] = $order_info['order_status_id'];
            
            // Fraud
            $this->theme->model('sale/fraud');
            
            $fraud_info = $this->model_sale_fraud->getFraud($order_info['order_id']);
            
            if ($fraud_info) {
                $data['country_match'] = $fraud_info['country_match'];
                
                if ($fraud_info['country_code']) {
                    $data['country_code'] = $fraud_info['country_code'];
                } else {
                    $data['country_code'] = '';
                }
                
                $data['high_risk_country'] = $fraud_info['high_risk_country'];
                $data['distance'] = $fraud_info['distance'];
                
                if ($fraud_info['ip_region']) {
                    $data['ip_region'] = $fraud_info['ip_region'];
                } else {
                    $data['ip_region'] = '';
                }
                
                if ($fraud_info['ip_city']) {
                    $data['ip_city'] = $fraud_info['ip_city'];
                } else {
                    $data['ip_city'] = '';
                }
                
                $data['ip_latitude'] = $fraud_info['ip_latitude'];
                $data['ip_longitude'] = $fraud_info['ip_longitude'];
                
                if ($fraud_info['ip_isp']) {
                    $data['ip_isp'] = $fraud_info['ip_isp'];
                } else {
                    $data['ip_isp'] = '';
                }
                
                if ($fraud_info['ip_org']) {
                    $data['ip_org'] = $fraud_info['ip_org'];
                } else {
                    $data['ip_org'] = '';
                }
                
                $data['ip_asnum'] = $fraud_info['ip_asnum'];
                
                if ($fraud_info['ip_user_type']) {
                    $data['ip_user_type'] = $fraud_info['ip_user_type'];
                } else {
                    $data['ip_user_type'] = '';
                }
                
                if ($fraud_info['ip_country_confidence']) {
                    $data['ip_country_confidence'] = $fraud_info['ip_country_confidence'];
                } else {
                    $data['ip_country_confidence'] = '';
                }
                
                if ($fraud_info['ip_region_confidence']) {
                    $data['ip_region_confidence'] = $fraud_info['ip_region_confidence'];
                } else {
                    $data['ip_region_confidence'] = '';
                }
                
                if ($fraud_info['ip_city_confidence']) {
                    $data['ip_city_confidence'] = $fraud_info['ip_city_confidence'];
                } else {
                    $data['ip_city_confidence'] = '';
                }
                
                if ($fraud_info['ip_postal_confidence']) {
                    $data['ip_postal_confidence'] = $fraud_info['ip_postal_confidence'];
                } else {
                    $data['ip_postal_confidence'] = '';
                }
                
                if ($fraud_info['ip_postal_code']) {
                    $data['ip_postal_code'] = $fraud_info['ip_postal_code'];
                } else {
                    $data['ip_postal_code'] = '';
                }
                
                $data['ip_accuracy_radius'] = $fraud_info['ip_accuracy_radius'];
                
                if ($fraud_info['ip_net_speed_cell']) {
                    $data['ip_net_speed_cell'] = $fraud_info['ip_net_speed_cell'];
                } else {
                    $data['ip_net_speed_cell'] = '';
                }
                
                $data['ip_metro_code'] = $fraud_info['ip_metro_code'];
                $data['ip_area_code'] = $fraud_info['ip_area_code'];
                
                if ($fraud_info['ip_time_zone']) {
                    $data['ip_time_zone'] = $fraud_info['ip_time_zone'];
                } else {
                    $data['ip_time_zone'] = '';
                }
                
                if ($fraud_info['ip_region_name']) {
                    $data['ip_region_name'] = $fraud_info['ip_region_name'];
                } else {
                    $data['ip_region_name'] = '';
                }
                
                if ($fraud_info['ip_domain']) {
                    $data['ip_domain'] = $fraud_info['ip_domain'];
                } else {
                    $data['ip_domain'] = '';
                }
                
                if ($fraud_info['ip_country_name']) {
                    $data['ip_country_name'] = $fraud_info['ip_country_name'];
                } else {
                    $data['ip_country_name'] = '';
                }
                
                if ($fraud_info['ip_continent_code']) {
                    $data['ip_continent_code'] = $fraud_info['ip_continent_code'];
                } else {
                    $data['ip_continent_code'] = '';
                }
                
                if ($fraud_info['ip_corporate_proxy']) {
                    $data['ip_corporate_proxy'] = $fraud_info['ip_corporate_proxy'];
                } else {
                    $data['ip_corporate_proxy'] = '';
                }
                
                $data['anonymous_proxy'] = $fraud_info['anonymous_proxy'];
                $data['proxy_score'] = $fraud_info['proxy_score'];
                
                if ($fraud_info['is_trans_proxy']) {
                    $data['is_trans_proxy'] = $fraud_info['is_trans_proxy'];
                } else {
                    $data['is_trans_proxy'] = '';
                }
                
                $data['free_mail'] = $fraud_info['free_mail'];
                $data['carder_email'] = $fraud_info['carder_email'];
                
                if ($fraud_info['high_risk_username']) {
                    $data['high_risk_username'] = $fraud_info['high_risk_username'];
                } else {
                    $data['high_risk_username'] = '';
                }
                
                if ($fraud_info['high_risk_password']) {
                    $data['high_risk_password'] = $fraud_info['high_risk_password'];
                } else {
                    $data['high_risk_password'] = '';
                }
                
                $data['bin_match'] = $fraud_info['bin_match'];
                
                if ($fraud_info['bin_country']) {
                    $data['bin_country'] = $fraud_info['bin_country'];
                } else {
                    $data['bin_country'] = '';
                }
                
                $data['bin_name_match'] = $fraud_info['bin_name_match'];
                
                if ($fraud_info['bin_name']) {
                    $data['bin_name'] = $fraud_info['bin_name'];
                } else {
                    $data['bin_name'] = '';
                }
                
                $data['bin_phone_match'] = $fraud_info['bin_phone_match'];
                
                if ($fraud_info['bin_phone']) {
                    $data['bin_phone'] = $fraud_info['bin_phone'];
                } else {
                    $data['bin_phone'] = '';
                }
                
                if ($fraud_info['customer_phone_in_billing_location']) {
                    $data['customer_phone_in_billing_location'] = $fraud_info['customer_phone_in_billing_location'];
                } else {
                    $data['customer_phone_in_billing_location'] = '';
                }
                
                $data['ship_forward'] = $fraud_info['ship_forward'];
                
                if ($fraud_info['city_postal_match']) {
                    $data['city_postal_match'] = $fraud_info['city_postal_match'];
                } else {
                    $data['city_postal_match'] = '';
                }
                
                if ($fraud_info['ship_city_postal_match']) {
                    $data['ship_city_postal_match'] = $fraud_info['ship_city_postal_match'];
                } else {
                    $data['ship_city_postal_match'] = '';
                }
                
                $data['score']             = $fraud_info['score'];
                $data['explanation']       = $fraud_info['explanation'];
                $data['risk_score']        = $fraud_info['risk_score'];
                $data['queries_remaining'] = $fraud_info['queries_remaining'];
                $data['maxmind_id']        = $fraud_info['maxmind_id'];
                $data['error']             = $fraud_info['error'];
            } else {
                $data['maxmind_id'] = '';
            }
            
            $data['payment_action'] = $this->theme->controller('payment/' . $order_info['payment_code'] . '/orderAction');
            
            $this->theme->loadjs('javascript/sale/order_info', $data);
            
            $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
            
            $data = $this->theme->render_controllers($data);
            
            $this->response->setOutput($this->theme->view('sale/order_info', $data));
        } else {
            $data = $this->theme->language('error/not_found');
            
            $this->theme->setTitle($this->language->get('lang_heading_title'));
            
            $this->breadcrumb->add('lang_heading_title', 'error/notfound');
            
            $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
            
            $data = $this->theme->render_controllers($data);
            
            $this->response->setOutput($this->theme->view('error/not_found', $data));
        }
    }
    
    public function createInvoiceNo() {
        $this->language->load('sale/order');
        
        $json = array();
        
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $json['error'] = $this->language->get('lang_error_permission');
        } elseif (isset($this->request->get['order_id'])) {
            $this->theme->model('sale/order');
            
            $invoice_no = $this->model_sale_order->createInvoiceNo($this->request->get['order_id']);
            
            if ($invoice_no) {
                $json['invoice_no'] = $invoice_no;
            } else {
                $json['error'] = $this->language->get('lang_error_action');
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function addCredit() {
        $this->language->load('sale/order');
        
        $json = array();
        
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $json['error'] = $this->language->get('lang_error_permission');
        } elseif (isset($this->request->get['order_id'])) {
            $this->theme->model('sale/order');
            
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
            
            if ($order_info && $order_info['customer_id']) {
                $this->theme->model('people/customer');
                
                $credit_total = $this->model_people_customer->getTotalCreditsByOrderId($this->request->get['order_id']);
                
                if (!$credit_total) {
                    $this->model_people_customer->addCredit($order_info['customer_id'], $this->language->get('lang_text_order_id') . ' #' . $this->request->get['order_id'], $order_info['total'], $this->request->get['order_id']);
                    
                    $json['success'] = $this->language->get('lang_text_credit_added');
                } else {
                    $json['error'] = $this->language->get('lang_error_action');
                }
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function removeCredit() {
        $this->language->load('sale/order');
        
        $json = array();
        
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $json['error'] = $this->language->get('lang_error_permission');
        } elseif (isset($this->request->get['order_id'])) {
            $this->theme->model('sale/order');
            
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
            
            if ($order_info && $order_info['customer_id']) {
                $this->theme->model('people/customer');
                
                $this->model_people_customer->deleteCredit($this->request->get['order_id']);
                
                $json['success'] = $this->language->get('lang_text_credit_removed');
            } else {
                $json['error'] = $this->language->get('lang_error_action');
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function addReward() {
        $this->language->load('sale/order');
        
        $json = array();
        
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $json['error'] = $this->language->get('lang_error_permission');
        } elseif (isset($this->request->get['order_id'])) {
            $this->theme->model('sale/order');
            
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
            
            if ($order_info && $order_info['customer_id']) {
                $this->theme->model('people/customer');
                
                $reward_total = $this->model_people_customer->getTotalCustomerRewardsByOrderId($this->request->get['order_id']);
                
                if (!$reward_total) {
                    $this->model_people_customer->addReward($order_info['customer_id'], $this->language->get('lang_text_order_id') . ' #' . $this->request->get['order_id'], $order_info['reward'], $this->request->get['order_id']);
                    
                    $json['success'] = $this->language->get('lang_text_reward_added');
                } else {
                    $json['error'] = $this->language->get('lang_error_action');
                }
            } else {
                $json['error'] = $this->language->get('lang_error_action');
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function removeReward() {
        $this->language->load('sale/order');
        
        $json = array();
        
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $json['error'] = $this->language->get('lang_error_permission');
        } elseif (isset($this->request->get['order_id'])) {
            $this->theme->model('sale/order');
            
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
            
            if ($order_info && $order_info['customer_id']) {
                $this->theme->model('people/customer');
                
                $this->model_people_customer->deleteReward($this->request->get['order_id']);
                
                $json['success'] = $this->language->get('lang_text_reward_removed');
            } else {
                $json['error'] = $this->language->get('lang_error_action');
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function addCommission() {
        $this->language->load('sale/order');
        
        $json = array();
        
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $json['error'] = $this->language->get('lang_error_permission');
        } elseif (isset($this->request->get['order_id'])) {
            $this->theme->model('sale/order');
            
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
            
            if ($order_info && $order_info['affiliate_id']) {
                $this->theme->model('people/customer');
                
                $affiliate_total = $this->model_people_customer->getTotalCommissionsByOrderId($this->request->get['order_id']);
                
                if (!$affiliate_total) {
                    $this->model_people_customer->addCommission($order_info['affiliate_id'], $this->language->get('lang_text_order_id') . ' #' . $this->request->get['order_id'], $order_info['commission'], $this->request->get['order_id']);
                    
                    $json['success'] = $this->language->get('lang_text_commission_added');
                } else {
                    $json['error'] = $this->language->get('lang_error_action');
                }
            } else {
                $json['error'] = $this->language->get('lang_error_action');
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function removeCommission() {
        $this->language->load('sale/order');
        
        $json = array();
        
        if (!$this->user->hasPermission('modify', 'sale/order')) {
            $json['error'] = $this->language->get('lang_error_permission');
        } elseif (isset($this->request->get['order_id'])) {
            $this->theme->model('sale/order');
            
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
            
            if ($order_info && $order_info['affiliate_id']) {
                $this->theme->model('people/customer');
                
                $this->model_people_customer->deleteCommission($this->request->get['order_id']);
                
                $json['success'] = $this->language->get('lang_text_commission_removed');
            } else {
                $json['error'] = $this->language->get('lang_error_action');
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function history() {
        $data = $this->theme->language('sale/order');
        
        $data['error'] = '';
        $data['success'] = '';
        
        $this->theme->model('sale/order');
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if (!$this->user->hasPermission('modify', 'sale/order')) {
                $data['error'] = $this->language->get('lang_error_permission');
            }
            
            if (!$data['error']) {
                $this->model_sale_order->addOrderHistory($this->request->get['order_id'], $this->request->post);
                
                $data['success'] = $this->language->get('lang_text_success');
            }
        }
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $data['histories'] = array();
        
        $results = $this->model_sale_order->getOrderHistories($this->request->get['order_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result) {
            $data['histories'][] = array(
                'notify'     => $result['notify'] ? $this->language->get('lang_text_yes') : $this->language->get('lang_text_no'), 
                'status'     => $result['status'], 
                'comment'    => nl2br($result['comment']), 
                'date_added' => date($this->language->get('lang_date_format_short'), strtotime($result['date_added']))
            );
        }
        
        $history_total = $this->model_sale_order->getTotalOrderHistories($this->request->get['order_id']);
        
        $data['pagination'] = $this->theme->paginate(
            $history_total, 
            $page, 
            10, 
            $this->language->get('lang_text_pagination'), 
            $this->url->link('sale/order/history', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . '&page={page}', 'SSL')
        );
        
        $this->theme->loadjs('javascript/sale/order_history', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        $this->response->setOutput($this->theme->view('sale/order_history', $data));
    }
    
    public function download() {
        $this->theme->model('sale/order');
        
        if (isset($this->request->get['order_option_id'])) {
            $order_option_id = $this->request->get['order_option_id'];
        } else {
            $order_option_id = 0;
        }
        
        $option_info = $this->model_sale_order->getOrderOption($this->request->get['order_id'], $order_option_id);
        
        if ($option_info && $option_info['type'] == 'file') {
            $file = $this->app['path.download'] . $option_info['value'];
            $mask = basename($this->encode->substr($option_info['value'], 0, $this->encode->strrpos($option_info['value'], '.')));
            
            if (!headers_sent()) {
                if (file_exists($file)) {
                    header('Content-Type: application/octet-stream');
                    header('Content-Description: File Transfer');
                    header('Content-Disposition: attachment; filename="' . ($mask ? $mask : basename($file)) . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    
                    readfile($file, 'rb');
                } else {
                    trigger_error('Error: Could not find file ' . $file . '!');
                }
            } else {
                trigger_error('Error: Headers already sent out!');
            }
        } else {
            $data = $this->theme->language('error/not_found');
            
            $this->theme->setTitle($this->language->get('lang_heading_title'));
            
            $this->breadcrumb->add('lang_heading_title', 'error/notfound');
            
            $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
            
            $data = $this->theme->render_controllers($data);
            
            $this->response->setOutput($this->theme->view('error/not_found', $data));
        }
    }
    
    public function upload() {
        $this->language->load('sale/order');
        
        $json = array();
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if (!empty($this->request->files['file']['name'])) {
                $filename = html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8');
                
                if (($this->encode->strlen($filename) < 3) || ($this->encode->strlen($filename) > 128)) {
                    $json['error'] = $this->language->get('lang_error_filename');
                }
                
                // Allowed file extension types
                $allowed = array();
                
                $filetypes = explode("\n", str_replace(array("\r\n", "\r"), "\n", $this->config->get('config_file_extension_allowed')));
                
                foreach ($filetypes as $filetype) {
                    $allowed[] = trim($filetype);
                }
                
                if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
                    $json['error'] = $this->language->get('lang_error_filetype');
                }
                
                // Allowed file mime types
                $allowed = array();
                
                $filetypes = explode("\n", str_replace(array("\r\n", "\r"), "\n", $this->config->get('config_file_mime_allowed')));
                foreach ($filetypes as $filetype) {
                    $allowed[] = trim($filetype);
                }
                
                if (!in_array($this->request->files['file']['type'], $allowed)) {
                    $json['error'] = $this->language->get('lang_error_filetype');
                }
                
                // Check to see if any PHP files are trying to be uploaded
                $content = file_get_contents($this->request->files['file']['tmp_name']);
                
                if (preg_match('/\<\?php/i', $content)) {
                    $json['error'] = $this->language->get('lang_error_filetype');
                }
                
                if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
                    $json['error'] = $this->language->get('lang_error_upload_' . $this->request->files['file']['error']);
                }
            } else {
                $json['error'] = $this->language->get('lang_error_upload');
            }
            
            if (!isset($json['error'])) {
                if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
                    $file = basename($filename) . '.' . md5(mt_rand());
                    
                    $json['file'] = $file;
                    
                    move_uploaded_file($this->request->files['file']['tmp_name'], $this->app['path.download'] . $file);
                }
                
                $json['success'] = $this->language->get('lang_text_upload');
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }

    public function shipping() {
        $this->theme->model('setting/module');
        
        $modules = $this->model_setting_module->getAll('shipping');
        $this->theme->test($modules);
        foreach ($modules as $key => $value) {
            $theme_file = $this->theme->path . 'controller/shipping/' . $value . '.php';
            $core_file = $this->app['path.application'] . 'controller/shipping/' . $value . '.php';
            
            if (!is_readable($theme_file) && !is_readable($core_file)) {
                $this->model_setting_module->uninstall('shipping', $value);
                
                unset($modules[$key]);
            }
        }
    }
    
    public function invoice() {
        $data = $this->theme->language('sale/order');
        
        $this->css->reset();
        $this->css->register('invoice.min');
        
        $data['title'] = $this->language->get('lang_heading_title');
        
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $data['base'] = $this->app['https.server'];
        } else {
            $data['base'] = $this->app['http.server'];
        }
        
        $data['language'] = $this->language->get('lang_code');
        
        $this->theme->model('sale/order');
        
        $this->theme->model('setting/setting');
        
        $data['orders'] = array();
        
        $orders = array();
        
        if (isset($this->request->post['selected'])) {
            $orders = $this->request->post['selected'];
        } elseif (isset($this->request->get['order_id'])) {
            $orders[] = $this->request->get['order_id'];
        }
        
        foreach ($orders as $order_id) {
            $order_info = $this->model_sale_order->getOrder($order_id);
            
            if ($order_info) {
                $store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);
                
                if ($store_info) {
                    $store_address = $store_info['config_address'];
                    $store_email = $store_info['config_email'];
                    $store_telephone = $store_info['config_telephone'];
                } else {
                    $store_address = $this->config->get('config_address');
                    $store_email = $this->config->get('config_email');
                    $store_telephone = $this->config->get('config_telephone');
                }
                
                if ($order_info['invoice_no']) {
                    $invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
                } else {
                    $invoice_no = '';
                }
                
                if ($order_info['shipping_address_format']) {
                    $format = $order_info['shipping_address_format'];
                } else {
                    $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
                }
                
                $find = array(
                    '{firstname}', 
                    '{lastname}', 
                    '{company}', 
                    '{address_1}', 
                    '{address_2}', 
                    '{city}', 
                    '{postcode}', 
                    '{zone}', 
                    '{zone_code}', 
                    '{country}'
                );
                
                $replace = array(
                    'firstname' => $order_info['shipping_firstname'], 
                    'lastname'  => $order_info['shipping_lastname'], 
                    'company'   => $order_info['shipping_company'], 
                    'address_1' => $order_info['shipping_address_1'], 
                    'address_2' => $order_info['shipping_address_2'], 
                    'city'      => $order_info['shipping_city'], 
                    'postcode'  => $order_info['shipping_postcode'], 
                    'zone'      => $order_info['shipping_zone'], 
                    'zone_code' => $order_info['shipping_zone_code'], 
                    'country'   => $order_info['shipping_country']
                );
                
                $shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
                
                if ($order_info['payment_address_format']) {
                    $format = $order_info['payment_address_format'];
                } else {
                    $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
                }
                
                $find = array(
                    '{firstname}', 
                    '{lastname}', 
                    '{company}', 
                    '{address_1}', 
                    '{address_2}', 
                    '{city}', 
                    '{postcode}', 
                    '{zone}', 
                    '{zone_code}', 
                    '{country}'
                );
                
                $replace = array(
                    'firstname' => $order_info['payment_firstname'], 
                    'lastname'  => $order_info['payment_lastname'], 
                    'company'   => $order_info['payment_company'], 
                    'address_1' => $order_info['payment_address_1'], 
                    'address_2' => $order_info['payment_address_2'], 
                    'city'      => $order_info['payment_city'], 
                    'postcode'  => $order_info['payment_postcode'], 
                    'zone'      => $order_info['payment_zone'], 
                    'zone_code' => $order_info['payment_zone_code'], 
                    'country'   => $order_info['payment_country']
                );
                
                $payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
                
                $product_data = array();
                
                $products = $this->model_sale_order->getOrderProducts($order_id);
                
                foreach ($products as $product) {
                    $option_data = array();
                    
                    $options = $this->model_sale_order->getOrderOptions($order_id, $product['order_product_id']);
                    
                    foreach ($options as $option) {
                        if ($option['type'] != 'file') {
                            $value = $option['value'];
                        } else {
                            $value = $this->encode->substr($option['value'], 0, $this->encode->strrpos($option['value'], '.'));
                        }
                        
                        $option_data[] = array(
                            'name'  => $option['name'], 
                            'value' => $value
                        );
                    }
                    
                    $product_data[] = array(
                        'name'     => $product['name'], 
                        'model'    => $product['model'], 
                        'option'   => $option_data, 
                        'quantity' => $product['quantity'], 
                        'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']), 
                        'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
                    );
                }
                
                $giftcard_data = array();
                
                $giftcards = $this->model_sale_order->getOrderGiftcards($order_id);
                
                foreach ($giftcards as $giftcard) {
                    $giftcard_data[] = array(
                        'description' => $giftcard['description'], 
                        'amount'      => $this->currency->format($giftcard['amount'], $order_info['currency_code'], $order_info['currency_value'])
                    );
                }
                
                $total_data = $this->model_sale_order->getOrderTotals($order_id);
                
                $data['orders'][] = array(
                    'order_id'           => $order_id, 
                    'invoice_no'         => $invoice_no, 
                    'date_added'         => date($this->language->get('lang_date_format_short'), strtotime($order_info['date_added'])), 
                    'store_name'         => $order_info['store_name'], 
                    'store_url'          => rtrim($order_info['store_url'], '/'), 
                    'store_address'      => nl2br($store_address), 
                    'store_email'        => $store_email, 
                    'store_telephone'    => $store_telephone, 
                    'email'              => $order_info['email'], 
                    'telephone'          => $order_info['telephone'], 
                    'shipping_address'   => $shipping_address, 
                    'shipping_method'    => $order_info['shipping_method'], 
                    'payment_address'    => $payment_address, 
                    'payment_company_id' => $order_info['payment_company_id'], 
                    'payment_tax_id'     => $order_info['payment_tax_id'], 
                    'payment_method'     => $order_info['payment_method'], 
                    'product'            => $product_data, 
                    'giftcard'           => $giftcard_data, 
                    'total'              => $total_data, 
                    'comment'            => nl2br($order_info['comment'])
                );
            }
        }
        
        $this->css->compile();
        
        $data['css_link'] = $this->url->link('common/css', '', 'SSL');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->response->setOutput($this->theme->view('sale/order_invoice', $data));
    }
}
