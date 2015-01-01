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

class Returns extends Controller {
    private $error = array();
    
    public function index() {
        $this->language->load('sale/returns');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('sale/returns');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function insert() {
        $this->language->load('sale/returns');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('sale/returns');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_returns->addReturn($this->request->post);
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_return_id'])) {
                $url.= '&filter_return_id=' . $this->request->get['filter_return_id'];
            }
            
            if (isset($this->request->get['filter_order_id'])) {
                $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }
            
            if (isset($this->request->get['filter_customer'])) {
                $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_product'])) {
                $url.= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_model'])) {
                $url.= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_return_status_id'])) {
                $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
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
            
            $this->response->redirect($this->url->link('sale/returns', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function update() {
        $this->language->load('sale/returns');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('sale/returns');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_returns->editReturn($this->request->get['return_id'], $this->request->post);
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_return_id'])) {
                $url.= '&filter_return_id=' . $this->request->get['filter_return_id'];
            }
            
            if (isset($this->request->get['filter_order_id'])) {
                $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }
            
            if (isset($this->request->get['filter_customer'])) {
                $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_product'])) {
                $url.= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_model'])) {
                $url.= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_return_status_id'])) {
                $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
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
            
            $this->response->redirect($this->url->link('sale/returns', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function delete() {
        $this->language->load('sale/returns');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('sale/returns');
        
        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $return_id) {
                $this->model_sale_returns->deleteReturn($return_id);
            }
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_return_id'])) {
                $url.= '&filter_return_id=' . $this->request->get['filter_return_id'];
            }
            
            if (isset($this->request->get['filter_order_id'])) {
                $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }
            
            if (isset($this->request->get['filter_customer'])) {
                $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_product'])) {
                $url.= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_model'])) {
                $url.= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_return_status_id'])) {
                $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
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
            
            $this->response->redirect($this->url->link('sale/returns', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    protected function getList() {
        $data = $this->theme->language('sale/returns');
        
        if (isset($this->request->get['filter_return_id'])) {
            $filter_return_id = $this->request->get['filter_return_id'];
        } else {
            $filter_return_id = null;
        }
        
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
        
        if (isset($this->request->get['filter_product'])) {
            $filter_product = $this->request->get['filter_product'];
        } else {
            $filter_product = null;
        }
        
        if (isset($this->request->get['filter_model'])) {
            $filter_model = $this->request->get['filter_model'];
        } else {
            $filter_model = null;
        }
        
        if (isset($this->request->get['filter_return_status_id'])) {
            $filter_return_status_id = $this->request->get['filter_return_status_id'];
        } else {
            $filter_return_status_id = null;
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
            $sort = 'r.return_id';
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
        
        if (isset($this->request->get['filter_return_id'])) {
            $url.= '&filter_return_id=' . $this->request->get['filter_return_id'];
        }
        
        if (isset($this->request->get['filter_order_id'])) {
            $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }
        
        if (isset($this->request->get['filter_customer'])) {
            $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_product'])) {
            $url.= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_model'])) {
            $url.= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_return_status_id'])) {
            $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
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
        
        $this->breadcrumb->add('heading_title', 'sale/returns', $url);
        
        $data['insert'] = $this->url->link('sale/returns/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('sale/returns/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        $data['returns'] = array();
        
        $filter = array('filter_return_id' => $filter_return_id, 'filter_order_id' => $filter_order_id, 'filter_customer' => $filter_customer, 'filter_product' => $filter_product, 'filter_model' => $filter_model, 'filter_return_status_id' => $filter_return_status_id, 'filter_date_added' => $filter_date_added, 'filter_date_modified' => $filter_date_modified, 'sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $this->config->get('config_admin_limit'), 'limit' => $this->config->get('config_admin_limit'));
        
        $return_total = $this->model_sale_returns->getTotalReturns($filter);
        
        $results = $this->model_sale_returns->getReturns($filter);
        
        foreach ($results as $result) {
            $action = array();
            
            $action[] = array('text' => $this->language->get('text_view'), 'href' => $this->url->link('sale/returns/info', 'token=' . $this->session->data['token'] . '&return_id=' . $result['return_id'] . $url, 'SSL'));
            
            $action[] = array('text' => $this->language->get('text_edit'), 'href' => $this->url->link('sale/returns/update', 'token=' . $this->session->data['token'] . '&return_id=' . $result['return_id'] . $url, 'SSL'));
            
            $data['returns'][] = array('return_id' => $result['return_id'], 'order_id' => $result['order_id'], 'customer' => $result['customer'], 'product' => $result['product'], 'model' => $result['model'], 'status' => $result['status'], 'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])), 'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])), 'selected' => isset($this->request->post['selected']) && in_array($result['return_id'], $this->request->post['selected']), 'action' => $action);
        }
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->session->data['error'])) {
            $data['error_warning'] = $this->session->data['error'];
            
            unset($this->session->data['error']);
        } elseif (isset($this->error['warning'])) {
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
        
        if (isset($this->request->get['filter_return_id'])) {
            $url.= '&filter_return_id=' . $this->request->get['filter_return_id'];
        }
        
        if (isset($this->request->get['filter_order_id'])) {
            $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }
        
        if (isset($this->request->get['filter_customer'])) {
            $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_product'])) {
            $url.= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_model'])) {
            $url.= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_return_status_id'])) {
            $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
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
        
        $data['sort_return_id'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . '&sort=r.return_id' . $url, 'SSL');
        $data['sort_order_id'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . '&sort=r.order_id' . $url, 'SSL');
        $data['sort_customer'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
        $data['sort_product'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . '&sort=product' . $url, 'SSL');
        $data['sort_model'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . '&sort=model' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . '&sort=r.date_added' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . '&sort=r.date_modified' . $url, 'SSL');
        
        $url = '';
        
        if (isset($this->request->get['filter_return_id'])) {
            $url.= '&filter_return_id=' . $this->request->get['filter_return_id'];
        }
        
        if (isset($this->request->get['filter_order_id'])) {
            $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }
        
        if (isset($this->request->get['filter_customer'])) {
            $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_product'])) {
            $url.= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_model'])) {
            $url.= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_return_status_id'])) {
            $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
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
        
        $data['pagination'] = $this->theme->paginate($return_total, $page, $this->config->get('config_admin_limit'), $this->language->get('text_pagination'), $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL'));
        
        $data['filter_return_id'] = $filter_return_id;
        $data['filter_order_id'] = $filter_order_id;
        $data['filter_customer'] = $filter_customer;
        $data['filter_product'] = $filter_product;
        $data['filter_model'] = $filter_model;
        $data['filter_return_status_id'] = $filter_return_status_id;
        $data['filter_date_added'] = $filter_date_added;
        $data['filter_date_modified'] = $filter_date_modified;
        
        $this->theme->model('localization/returnstatus');
        
        $data['return_statuses'] = $this->model_localization_returnstatus->getReturnStatuses();
        
        $data['sort'] = $sort;
        $data['order'] = $order;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('sale/return_list', $data));
    }
    
    protected function getForm() {
        $data = $this->theme->language('sale/returns');
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['order_id'])) {
            $data['error_order_id'] = $this->error['order_id'];
        } else {
            $data['error_order_id'] = '';
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
        
        if (isset($this->error['product'])) {
            $data['error_product'] = $this->error['product'];
        } else {
            $data['error_product'] = '';
        }
        
        if (isset($this->error['model'])) {
            $data['error_model'] = $this->error['model'];
        } else {
            $data['error_model'] = '';
        }
        
        $url = '';
        
        if (isset($this->request->get['filter_return_id'])) {
            $url.= '&filter_return_id=' . $this->request->get['filter_return_id'];
        }
        
        if (isset($this->request->get['filter_order_id'])) {
            $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }
        
        if (isset($this->request->get['filter_customer'])) {
            $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_product'])) {
            $url.= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_model'])) {
            $url.= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_return_status_id'])) {
            $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
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
        
        $this->breadcrumb->add('heading_title', 'sale/returns', $url);
        
        if (!isset($this->request->get['return_id'])) {
            $data['action'] = $this->url->link('sale/returns/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('sale/returns/update', 'token=' . $this->session->data['token'] . '&return_id=' . $this->request->get['return_id'] . $url, 'SSL');
        }
        
        $data['cancel'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        if (isset($this->request->get['return_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $return_info = $this->model_sale_returns->getReturn($this->request->get['return_id']);
        }
        
        if (isset($this->request->post['order_id'])) {
            $data['order_id'] = $this->request->post['order_id'];
        } elseif (!empty($return_info)) {
            $data['order_id'] = $return_info['order_id'];
        } else {
            $data['order_id'] = '';
        }
        
        if (isset($this->request->post['date_ordered'])) {
            $data['date_ordered'] = $this->request->post['date_ordered'];
        } elseif (!empty($return_info)) {
            $data['date_ordered'] = $return_info['date_ordered'];
        } else {
            $data['date_ordered'] = '';
        }
        
        if (isset($this->request->post['customer'])) {
            $data['customer'] = $this->request->post['customer'];
        } elseif (!empty($return_info)) {
            $data['customer'] = $return_info['customer'];
        } else {
            $data['customer'] = '';
        }
        
        if (isset($this->request->post['customer_id'])) {
            $data['customer_id'] = $this->request->post['customer_id'];
        } elseif (!empty($return_info)) {
            $data['customer_id'] = $return_info['customer_id'];
        } else {
            $data['customer_id'] = '';
        }
        
        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        } elseif (!empty($return_info)) {
            $data['firstname'] = $return_info['firstname'];
        } else {
            $data['firstname'] = '';
        }
        
        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        } elseif (!empty($return_info)) {
            $data['lastname'] = $return_info['lastname'];
        } else {
            $data['lastname'] = '';
        }
        
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($return_info)) {
            $data['email'] = $return_info['email'];
        } else {
            $data['email'] = '';
        }
        
        if (isset($this->request->post['telephone'])) {
            $data['telephone'] = $this->request->post['telephone'];
        } elseif (!empty($return_info)) {
            $data['telephone'] = $return_info['telephone'];
        } else {
            $data['telephone'] = '';
        }
        
        if (isset($this->request->post['product'])) {
            $data['product'] = $this->request->post['product'];
        } elseif (!empty($return_info)) {
            $data['product'] = $return_info['product'];
        } else {
            $data['product'] = '';
        }
        
        if (isset($this->request->post['product_id'])) {
            $data['product_id'] = $this->request->post['product_id'];
        } elseif (!empty($return_info)) {
            $data['product_id'] = $return_info['product_id'];
        } else {
            $data['product_id'] = '';
        }
        
        if (isset($this->request->post['model'])) {
            $data['model'] = $this->request->post['model'];
        } elseif (!empty($return_info)) {
            $data['model'] = $return_info['model'];
        } else {
            $data['model'] = '';
        }
        
        if (isset($this->request->post['quantity'])) {
            $data['quantity'] = $this->request->post['quantity'];
        } elseif (!empty($return_info)) {
            $data['quantity'] = $return_info['quantity'];
        } else {
            $data['quantity'] = '';
        }
        
        if (isset($this->request->post['opened'])) {
            $data['opened'] = $this->request->post['opened'];
        } elseif (!empty($return_info)) {
            $data['opened'] = $return_info['opened'];
        } else {
            $data['opened'] = '';
        }
        
        if (isset($this->request->post['return_reason_id'])) {
            $data['return_reason_id'] = $this->request->post['return_reason_id'];
        } elseif (!empty($return_info)) {
            $data['return_reason_id'] = $return_info['return_reason_id'];
        } else {
            $data['return_reason_id'] = '';
        }
        
        $this->theme->model('localization/returnreason');
        
        $data['return_reasons'] = $this->model_localization_returnreason->getReturnReasons();
        
        if (isset($this->request->post['return_action_id'])) {
            $data['return_action_id'] = $this->request->post['return_action_id'];
        } elseif (!empty($return_info)) {
            $data['return_action_id'] = $return_info['return_action_id'];
        } else {
            $data['return_action_id'] = '';
        }
        
        $this->theme->model('localization/returnaction');
        
        $data['return_actions'] = $this->model_localization_returnaction->getReturnActions();
        
        if (isset($this->request->post['comment'])) {
            $data['comment'] = $this->request->post['comment'];
        } elseif (!empty($return_info)) {
            $data['comment'] = $return_info['comment'];
        } else {
            $data['comment'] = '';
        }
        
        if (isset($this->request->post['return_status_id'])) {
            $data['return_status_id'] = $this->request->post['return_status_id'];
        } elseif (!empty($return_info)) {
            $data['return_status_id'] = $return_info['return_status_id'];
        } else {
            $data['return_status_id'] = '';
        }
        
        $this->theme->model('localization/returnstatus');
        
        $data['return_statuses'] = $this->model_localization_returnstatus->getReturnStatuses();
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('sale/return_form', $data));
    }
    
    public function info() {
        $this->theme->model('sale/returns');
        
        if (isset($this->request->get['return_id'])) {
            $return_id = $this->request->get['return_id'];
        } else {
            $return_id = 0;
        }
        
        $return_info = $this->model_sale_returns->getReturn($return_id);
        
        if ($return_info) {
            $data = $this->theme->language('sale/returns');
            
            $this->theme->setTitle($this->language->get('heading_title'));
            
            $url = '';
            
            if (isset($this->request->get['filter_return_id'])) {
                $url.= '&filter_return_id=' . $this->request->get['filter_return_id'];
            }
            
            if (isset($this->request->get['filter_order_id'])) {
                $url.= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }
            
            if (isset($this->request->get['filter_customer'])) {
                $url.= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_product'])) {
                $url.= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_model'])) {
                $url.= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_return_status_id'])) {
                $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
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
            
            $this->breadcrumb->add('heading_title', 'sale/returns', $url);
            
            $data['cancel'] = $this->url->link('sale/returns', 'token=' . $this->session->data['token'] . $url, 'SSL');
            
            $this->theme->model('sale/order');
            
            $order_info = $this->model_sale_order->getOrder($return_info['order_id']);
            
            $data['token'] = $this->session->data['token'];
            
            $data['return_id'] = $return_info['return_id'];
            $data['order_id'] = $return_info['order_id'];
            
            if ($return_info['order_id'] && $order_info) {
                $data['order'] = $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $return_info['order_id'], 'SSL');
            } else {
                $data['order'] = '';
            }
            
            $data['date_ordered'] = date($this->language->get('date_format_short'), strtotime($return_info['date_ordered']));
            $data['firstname'] = $return_info['firstname'];
            $data['lastname'] = $return_info['lastname'];
            
            if ($return_info['customer_id']) {
                $data['customer'] = $this->url->link('people/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $return_info['customer_id'], 'SSL');
            } else {
                $data['customer'] = '';
            }
            
            $data['email'] = $return_info['email'];
            $data['telephone'] = $return_info['telephone'];
            
            $this->theme->model('localization/returnstatus');
            
            $return_status_info = $this->model_localization_returnstatus->getReturnStatus($return_info['return_status_id']);
            
            if ($return_status_info) {
                $data['return_status'] = $return_status_info['name'];
            } else {
                $data['return_status'] = '';
            }
            
            $data['date_added'] = date($this->language->get('date_format_short'), strtotime($return_info['date_added']));
            $data['date_modified'] = date($this->language->get('date_format_short'), strtotime($return_info['date_modified']));
            $data['product'] = $return_info['product'];
            $data['model'] = $return_info['model'];
            $data['quantity'] = $return_info['quantity'];
            
            $this->theme->model('localization/returnreason');
            
            $return_reason_info = $this->model_localization_returnreason->getReturnReason($return_info['return_reason_id']);
            
            if ($return_reason_info) {
                $data['return_reason'] = $return_reason_info['name'];
            } else {
                $data['return_reason'] = '';
            }
            
            $data['opened'] = $return_info['opened'] ? $this->language->get('text_yes') : $this->language->get('text_no');
            $data['comment'] = nl2br($return_info['comment']);
            
            $this->theme->model('localization/returnaction');
            
            $data['return_actions'] = $this->model_localization_returnaction->getReturnActions();
            
            $data['return_action_id'] = $return_info['return_action_id'];
            
            $data['return_statuses'] = $this->model_localization_returnstatus->getReturnStatuses();
            
            $data['return_status_id'] = $return_info['return_status_id'];
            
            $this->theme->loadjs('javascript/sale/return_info', $data);
            
            $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
            
            $data = $this->theme->render_controllers($data);
            
            $this->response->setOutput($this->theme->view('sale/return_info', $data));
        } else {
            $data = $this->theme->language('error/not_found');
            
            $this->theme->setTitle($this->language->get('heading_title'));
            
            $this->breadcrumb->add('heading_title', 'error/notfound');
            
            $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
            
            $data = $this->theme->render_controllers($data);
            
            $this->response->setOutput($this->theme->view('error/not_found', $data));
        }
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'sale/returns')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (($this->encode->strlen($this->request->post['firstname']) < 1) || ($this->encode->strlen($this->request->post['firstname']) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }
        
        if (($this->encode->strlen($this->request->post['lastname']) < 1) || ($this->encode->strlen($this->request->post['lastname']) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }
        
        if (($this->encode->strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }
        
        if (($this->encode->strlen($this->request->post['telephone']) < 3) || ($this->encode->strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('error_telephone');
        }
        
        if (($this->encode->strlen($this->request->post['product']) < 1) || ($this->encode->strlen($this->request->post['product']) > 255)) {
            $this->error['product'] = $this->language->get('error_product');
        }
        
        if (($this->encode->strlen($this->request->post['model']) < 1) || ($this->encode->strlen($this->request->post['model']) > 64)) {
            $this->error['model'] = $this->language->get('error_model');
        }
        
        if (empty($this->request->post['return_reason_id'])) {
            $this->error['reason'] = $this->language->get('error_reason');
        }
        
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'sale/returns')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    public function action() {
        $this->language->load('sale/returns');
        
        $json = array();
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if (!$this->user->hasPermission('modify', 'sale/returns')) {
                $json['error'] = $this->language->get('error_permission');
            }
            
            if (!$json) {
                $this->theme->model('sale/returns');
                
                $json['success'] = $this->language->get('text_success');
                
                $this->model_sale_returns->editReturnAction($this->request->get['return_id'], $this->request->post['return_action_id']);
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function history() {
        $data = $this->theme->language('sale/returns');
        
        $data['error'] = '';
        $data['success'] = '';
        
        $this->theme->model('sale/returns');
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if (!$this->user->hasPermission('modify', 'sale/returns')) {
                $data['error'] = $this->language->get('error_permission');
            }
            
            if (!$data['error']) {
                $this->model_sale_returns->addReturnHistory($this->request->get['return_id'], $this->request->post);
                
                $data['success'] = $this->language->get('text_success');
            }
        }
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $data['histories'] = array();
        
        $results = $this->model_sale_returns->getReturnHistories($this->request->get['return_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result) {
            $data['histories'][] = array('notify' => $result['notify'] ? $this->language->get('text_yes') : $this->language->get('text_no'), 'status' => $result['status'], 'comment' => nl2br($result['comment']), 'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])));
        }
        
        $history_total = $this->model_sale_returns->getTotalReturnHistories($this->request->get['return_id']);
        
        $data['pagination'] = $this->theme->paginate($history_total, $page, 10, $this->language->get('text_pagination'), $this->url->link('sale/returns/history', 'token=' . $this->session->data['token'] . '&return_id=' . $this->request->get['return_id'] . '&page={page}', 'SSL'));
        
        $this->theme->loadjs('javascript/sale/return_history', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        $this->response->setOutput($this->theme->view('sale/return_history', $data));
    }
}
