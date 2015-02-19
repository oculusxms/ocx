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

namespace Admin\Controller\People;
use Oculus\Engine\Controller;

class Affiliate extends Controller {
    private $error = array();
    
    public function index() {
        $this->language->load('people/affiliate');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('people/affiliate');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function insert() {
        $this->language->load('people/affiliate');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('people/affiliate');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_people_affiliate->addAffiliate($this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_name'])) {
                $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_email'])) {
                $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
            }
            
            if (isset($this->request->get['filter_approved'])) {
                $url.= '&filter_approved=' . $this->request->get['filter_approved'];
            }
            
            if (isset($this->request->get['filter_date_added'])) {
                $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
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
            
            $this->response->redirect($this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function update() {
        $this->language->load('people/affiliate');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('people/affiliate');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_people_affiliate->editAffiliate($this->request->get['affiliate_id'], $this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_name'])) {
                $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_email'])) {
                $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
            }
            
            if (isset($this->request->get['filter_approved'])) {
                $url.= '&filter_approved=' . $this->request->get['filter_approved'];
            }
            
            if (isset($this->request->get['filter_date_added'])) {
                $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
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
            
            $this->response->redirect($this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function delete() {
        $this->language->load('people/affiliate');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('people/affiliate');
        
        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $affiliate_id) {
                $this->model_people_affiliate->deleteAffiliate($affiliate_id);
            }
            
            $this->session->data['success'] = $this->language->get('lang_text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_name'])) {
                $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_email'])) {
                $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
            }
            
            if (isset($this->request->get['filter_approved'])) {
                $url.= '&filter_approved=' . $this->request->get['filter_approved'];
            }
            
            if (isset($this->request->get['filter_date_added'])) {
                $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
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
            
            $this->response->redirect($this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function approve() {
        $this->language->load('people/affiliate');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('people/affiliate');
        
        if (!$this->user->hasPermission('modify', 'people/affiliate')) {
            $this->error['warning'] = $this->language->get('lang_error_permission');
        } elseif (isset($this->request->post['selected'])) {
            $approved = 0;
            
            foreach ($this->request->post['selected'] as $affiliate_id) {
                $affiliate_info = $this->model_people_affiliate->getAffiliate($affiliate_id);
                
                if ($affiliate_info && !$affiliate_info['approved']) {
                    $this->model_people_affiliate->approve($affiliate_id);
                    
                    $approved++;
                }
            }
            
            $this->session->data['success'] = sprintf($this->language->get('lang_text_approved'), $approved);
            
            $url = '';
            
            if (isset($this->request->get['filter_name'])) {
                $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_email'])) {
                $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
            }
            
            if (isset($this->request->get['filter_approved'])) {
                $url.= '&filter_approved=' . $this->request->get['filter_approved'];
            }
            
            if (isset($this->request->get['filter_date_added'])) {
                $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
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
            
            $this->response->redirect($this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    protected function getList() {
        $data = $this->theme->language('people/affiliate');
        
        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }
        
        if (isset($this->request->get['filter_email'])) {
            $filter_email = $this->request->get['filter_email'];
        } else {
            $filter_email = null;
        }
        
        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }
        
        if (isset($this->request->get['filter_approved'])) {
            $filter_approved = $this->request->get['filter_approved'];
        } else {
            $filter_approved = null;
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }
        
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
        
        if (isset($this->request->get['filter_name'])) {
            $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_email'])) {
            $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if (isset($this->request->get['filter_approved'])) {
            $url.= '&filter_approved=' . $this->request->get['filter_approved'];
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
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
        
        $this->breadcrumb->add('lang_heading_title', 'people/affiliate', $url);
        
        $data['approve'] = $this->url->link('people/affiliate/approve', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['insert'] = $this->url->link('people/affiliate/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('people/affiliate/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        $data['affiliates'] = array();
        
        $filter = array('filter_name' => $filter_name, 'filter_email' => $filter_email, 'filter_status' => $filter_status, 'filter_approved' => $filter_approved, 'filter_date_added' => $filter_date_added, 'sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $this->config->get('config_admin_limit'), 'limit' => $this->config->get('config_admin_limit'));
        
        $affiliate_total = $this->model_people_affiliate->getTotalAffiliates($filter);
        
        $results = $this->model_people_affiliate->getAffiliates($filter);
        
        foreach ($results as $result) {
            $action = array();
            
            $action[] = array('text' => $this->language->get('lang_text_edit'), 'href' => $this->url->link('people/affiliate/update', 'token=' . $this->session->data['token'] . '&affiliate_id=' . $result['affiliate_id'] . $url, 'SSL'));
            
            $data['affiliates'][] = array('affiliate_id' => $result['affiliate_id'], 'name' => $result['name'], 'email' => $result['email'], 'balance' => $this->currency->format($result['balance'], $this->config->get('config_currency')), 'status' => ($result['status'] ? $this->language->get('lang_text_enabled') : $this->language->get('lang_text_disabled')), 'approved' => ($result['approved'] ? $this->language->get('lang_text_yes') : $this->language->get('lang_text_no')), 'date_added' => date($this->language->get('lang_date_format_short'), strtotime($result['date_added'])), 'selected' => isset($this->request->post['selected']) && in_array($result['affiliate_id'], $this->request->post['selected']), 'action' => $action);
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
        
        if (isset($this->request->get['filter_name'])) {
            $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_email'])) {
            $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if (isset($this->request->get['filter_approved'])) {
            $url.= '&filter_approved=' . $this->request->get['filter_approved'];
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }
        
        if ($order == 'ASC') {
            $url.= '&order=DESC';
        } else {
            $url.= '&order=ASC';
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $data['sort_name'] = $this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
        $data['sort_email'] = $this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . '&sort=a.email' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . '&sort=a.status' . $url, 'SSL');
        $data['sort_approved'] = $this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . '&sort=a.approved' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . '&sort=a.date_added' . $url, 'SSL');
        
        $url = '';
        
        if (isset($this->request->get['filter_name'])) {
            $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_email'])) {
            $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if (isset($this->request->get['filter_approved'])) {
            $url.= '&filter_approved=' . $this->request->get['filter_approved'];
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        $data['pagination'] = $this->theme->paginate($affiliate_total, $page, $this->config->get('config_admin_limit'), $this->language->get('lang_text_pagination'), $this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL'));
        
        $data['filter_name'] = $filter_name;
        $data['filter_email'] = $filter_email;
        $data['filter_status'] = $filter_status;
        $data['filter_approved'] = $filter_approved;
        $data['filter_date_added'] = $filter_date_added;
        
        $data['sort'] = $sort;
        $data['order'] = $order;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('people/affiliate_list', $data));
    }
    
    protected function getForm() {
        $data = $this->theme->language('people/affiliate');
        
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
        
        if (isset($this->error['password'])) {
            $data['error_password'] = $this->error['password'];
        } else {
            $data['error_password'] = '';
        }
        
        if (isset($this->error['confirm'])) {
            $data['error_confirm'] = $this->error['confirm'];
        } else {
            $data['error_confirm'] = '';
        }
        
        if (isset($this->error['address_1'])) {
            $data['error_address_1'] = $this->error['address_1'];
        } else {
            $data['error_address_1'] = '';
        }
        
        if (isset($this->error['city'])) {
            $data['error_city'] = $this->error['city'];
        } else {
            $data['error_city'] = '';
        }
        
        if (isset($this->error['postcode'])) {
            $data['error_postcode'] = $this->error['postcode'];
        } else {
            $data['error_postcode'] = '';
        }
        
        if (isset($this->error['country'])) {
            $data['error_country'] = $this->error['country'];
        } else {
            $data['error_country'] = '';
        }
        
        if (isset($this->error['zone'])) {
            $data['error_zone'] = $this->error['zone'];
        } else {
            $data['error_zone'] = '';
        }
        
        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }
        
        $url = '';
        
        if (isset($this->request->get['filter_name'])) {
            $url.= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_email'])) {
            $url.= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if (isset($this->request->get['filter_approved'])) {
            $url.= '&filter_approved=' . $this->request->get['filter_approved'];
        }
        
        if (isset($this->request->get['filter_date_added'])) {
            $url.= '&filter_date_added=' . $this->request->get['filter_date_added'];
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
        
        $this->breadcrumb->add('lang_heading_title', 'people/affiliate', $url);
        
        if (!isset($this->request->get['affiliate_id'])) {
            $data['action'] = $this->url->link('people/affiliate/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('people/affiliate/update', 'token=' . $this->session->data['token'] . '&affiliate_id=' . $this->request->get['affiliate_id'] . $url, 'SSL');
        }
        
        $data['cancel'] = $this->url->link('people/affiliate', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        if (isset($this->request->get['affiliate_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $affiliate_info = $this->model_people_affiliate->getAffiliate($this->request->get['affiliate_id']);
        }
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->request->get['affiliate_id'])) {
            $data['affiliate_id'] = $this->request->get['affiliate_id'];
        } else {
            $data['affiliate_id'] = 0;
        }
        
        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        } elseif (!empty($affiliate_info)) {
            $data['firstname'] = $affiliate_info['firstname'];
        } else {
            $data['firstname'] = '';
        }
        
        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        } elseif (!empty($affiliate_info)) {
            $data['lastname'] = $affiliate_info['lastname'];
        } else {
            $data['lastname'] = '';
        }
        
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($affiliate_info)) {
            $data['email'] = $affiliate_info['email'];
        } else {
            $data['email'] = '';
        }
        
        if (isset($this->request->post['telephone'])) {
            $data['telephone'] = $this->request->post['telephone'];
        } elseif (!empty($affiliate_info)) {
            $data['telephone'] = $affiliate_info['telephone'];
        } else {
            $data['telephone'] = '';
        }
        
        if (isset($this->request->post['company'])) {
            $data['company'] = $this->request->post['company'];
        } elseif (!empty($affiliate_info)) {
            $data['company'] = $affiliate_info['company'];
        } else {
            $data['company'] = '';
        }
        
        if (isset($this->request->post['address_1'])) {
            $data['address_1'] = $this->request->post['address_1'];
        } elseif (!empty($affiliate_info)) {
            $data['address_1'] = $affiliate_info['address_1'];
        } else {
            $data['address_1'] = '';
        }
        
        if (isset($this->request->post['address_2'])) {
            $data['address_2'] = $this->request->post['address_2'];
        } elseif (!empty($affiliate_info)) {
            $data['address_2'] = $affiliate_info['address_2'];
        } else {
            $data['address_2'] = '';
        }
        
        if (isset($this->request->post['city'])) {
            $data['city'] = $this->request->post['city'];
        } elseif (!empty($affiliate_info)) {
            $data['city'] = $affiliate_info['city'];
        } else {
            $data['city'] = '';
        }
        
        if (isset($this->request->post['postcode'])) {
            $data['postcode'] = $this->request->post['postcode'];
        } elseif (!empty($affiliate_info)) {
            $data['postcode'] = $affiliate_info['postcode'];
        } else {
            $data['postcode'] = '';
        }
        
        if (isset($this->request->post['country_id'])) {
            $data['country_id'] = $this->request->post['country_id'];
        } elseif (!empty($affiliate_info)) {
            $data['country_id'] = $affiliate_info['country_id'];
        } else {
            $data['country_id'] = '';
        }
        
        $this->theme->model('localization/country');
        
        $data['countries'] = $this->model_localization_country->getCountries();
        
        if (isset($this->request->post['zone_id'])) {
            $data['zone_id'] = $this->request->post['zone_id'];
        } elseif (!empty($affiliate_info)) {
            $data['zone_id'] = $affiliate_info['zone_id'];
        } else {
            $data['zone_id'] = '';
        }
        
        if (isset($this->request->post['code'])) {
            $data['code'] = $this->request->post['code'];
        } elseif (!empty($affiliate_info)) {
            $data['code'] = $affiliate_info['code'];
        } else {
            $data['code'] = uniqid();
        }
        
        if (isset($this->request->post['commission'])) {
            $data['commission'] = $this->request->post['commission'];
        } elseif (!empty($affiliate_info)) {
            $data['commission'] = $affiliate_info['commission'];
        } else {
            $data['commission'] = $this->config->get('config_commission');
        }
        
        if (isset($this->request->post['tax'])) {
            $data['tax'] = $this->request->post['tax'];
        } elseif (!empty($affiliate_info)) {
            $data['tax'] = $affiliate_info['tax'];
        } else {
            $data['tax'] = '';
        }
        
        if (isset($this->request->post['payment'])) {
            $data['payment'] = $this->request->post['payment'];
        } elseif (!empty($affiliate_info)) {
            $data['payment'] = $affiliate_info['payment'];
        } else {
            $data['payment'] = 'check';
        }
        
        if (isset($this->request->post['check'])) {
            $data['check'] = $this->request->post['check'];
        } elseif (!empty($affiliate_info)) {
            $data['check'] = $affiliate_info['check'];
        } else {
            $data['check'] = '';
        }
        
        if (isset($this->request->post['paypal'])) {
            $data['paypal'] = $this->request->post['paypal'];
        } elseif (!empty($affiliate_info)) {
            $data['paypal'] = $affiliate_info['paypal'];
        } else {
            $data['paypal'] = '';
        }
        
        if (isset($this->request->post['bank_name'])) {
            $data['bank_name'] = $this->request->post['bank_name'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_name'] = $affiliate_info['bank_name'];
        } else {
            $data['bank_name'] = '';
        }
        
        if (isset($this->request->post['bank_branch_number'])) {
            $data['bank_branch_number'] = $this->request->post['bank_branch_number'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_branch_number'] = $affiliate_info['bank_branch_number'];
        } else {
            $data['bank_branch_number'] = '';
        }
        
        if (isset($this->request->post['bank_swift_code'])) {
            $data['bank_swift_code'] = $this->request->post['bank_swift_code'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_swift_code'] = $affiliate_info['bank_swift_code'];
        } else {
            $data['bank_swift_code'] = '';
        }
        
        if (isset($this->request->post['bank_account_name'])) {
            $data['bank_account_name'] = $this->request->post['bank_account_name'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_account_name'] = $affiliate_info['bank_account_name'];
        } else {
            $data['bank_account_name'] = '';
        }
        
        if (isset($this->request->post['bank_account_number'])) {
            $data['bank_account_number'] = $this->request->post['bank_account_number'];
        } elseif (!empty($affiliate_info)) {
            $data['bank_account_number'] = $affiliate_info['bank_account_number'];
        } else {
            $data['bank_account_number'] = '';
        }
        
        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($affiliate_info)) {
            $data['status'] = $affiliate_info['status'];
        } else {
            $data['status'] = 1;
        }
        
        if (isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        } else {
            $data['password'] = '';
        }
        
        if (isset($this->request->post['confirm'])) {
            $data['confirm'] = $this->request->post['confirm'];
        } else {
            $data['confirm'] = '';
        }
        
        $this->theme->loadjs('javascript/people/affiliate_form', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('people/affiliate_form', $data));
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'people/affiliate')) {
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
        
        $affiliate_info = $this->model_people_affiliate->getAffiliateByEmail($this->request->post['email']);
        
        if (!isset($this->request->get['affiliate_id'])) {
            if ($affiliate_info) {
                $this->error['warning'] = $this->language->get('lang_error_exists');
            }
        } else {
            if ($affiliate_info && ($this->request->get['affiliate_id'] != $affiliate_info['affiliate_id'])) {
                $this->error['warning'] = $this->language->get('lang_error_exists');
            }
        }
        
        if (($this->encode->strlen($this->request->post['telephone']) < 3) || ($this->encode->strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('lang_error_telephone');
        }
        
        if ($this->request->post['password'] || (!isset($this->request->get['affiliate_id']))) {
            if (($this->encode->strlen($this->request->post['password']) < 4) || ($this->encode->strlen($this->request->post['password']) > 20)) {
                $this->error['password'] = $this->language->get('lang_error_password');
            }
            
            if ($this->request->post['password'] != $this->request->post['confirm']) {
                $this->error['confirm'] = $this->language->get('lang_error_confirm');
            }
        }
        
        if (($this->encode->strlen($this->request->post['address_1']) < 3) || ($this->encode->strlen($this->request->post['address_1']) > 128)) {
            $this->error['address_1'] = $this->language->get('lang_error_address_1');
        }
        
        if (($this->encode->strlen($this->request->post['city']) < 2) || ($this->encode->strlen($this->request->post['city']) > 128)) {
            $this->error['city'] = $this->language->get('lang_error_city');
        }
        
        $this->theme->model('localization/country');
        
        $country_info = $this->model_localization_country->getCountry($this->request->post['country_id']);
        
        if ($country_info && $country_info['postcode_required'] && ($this->encode->strlen($this->request->post['postcode']) < 2) || ($this->encode->strlen($this->request->post['postcode']) > 10)) {
            $this->error['postcode'] = $this->language->get('lang_error_postcode');
        }
        
        if ($this->request->post['country_id'] == '') {
            $this->error['country'] = $this->language->get('lang_error_country');
        }
        
        if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
            $this->error['zone'] = $this->language->get('lang_error_zone');
        }
        
        if (!$this->request->post['code']) {
            $this->error['code'] = $this->language->get('lang_error_code');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'people/affiliate')) {
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
            
            $json = array('country_id' => $country_info['country_id'], 'name' => $country_info['name'], 'iso_code_2' => $country_info['iso_code_2'], 'iso_code_3' => $country_info['iso_code_3'], 'address_format' => $country_info['address_format'], 'postcode_required' => $country_info['postcode_required'], 'zone' => $this->model_localization_zone->getZonesByCountryId($this->request->get['country_id']), 'status' => $country_info['status']);
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
    
    public function transaction() {
        $data = $this->theme->language('people/affiliate');
        
        $this->theme->model('people/affiliate');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'people/affiliate')) {
            $this->model_people_affiliate->addTransaction($this->request->get['affiliate_id'], $this->request->post['description'], $this->request->post['amount']);
            
            $data['success'] = $this->language->get('lang_text_success');
        } else {
            $data['success'] = '';
        }
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'people/affiliate')) {
            $data['error_warning'] = $this->language->get('lang_error_permission');
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $data['transactions'] = array();
        
        $results = $this->model_people_affiliate->getTransactions($this->request->get['affiliate_id'], ($page - 1) * 10, 10);
        
        foreach ($results as $result) {
            $data['transactions'][] = array('amount' => $this->currency->format($result['amount'], $this->config->get('config_currency')), 'description' => $result['description'], 'date_added' => date($this->language->get('lang_date_format_short'), strtotime($result['date_added'])));
        }
        
        $data['balance'] = $this->currency->format($this->model_people_affiliate->getTransactionTotal($this->request->get['affiliate_id']), $this->config->get('config_currency'));
        
        $transaction_total = $this->model_people_affiliate->getTotalTransactions($this->request->get['affiliate_id']);
        
        $data['pagination'] = $this->theme->paginate($transaction_total, $page, $this->config->get('config_admin_limit'), $this->language->get('lang_text_pagination'), $this->url->link('people/affiliate/transaction', 'token=' . $this->session->data['token'] . '&affiliate_id=' . $this->request->get['affiliate_id'] . '&page={page}', 'SSL'));
        
        $this->theme->loadjs('javascript/people/affiliate_transaction', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data['javascript'] = $this->theme->controller('common/javascript');
        
        $this->response->setOutput($this->theme->view('people/affiliate_transaction', $data));
    }
    
    public function autocomplete() {
        $json = array();
        
        if (isset($this->request->get['filter_name'])) {
            $this->theme->model('people/affiliate');
            
            $filter = array('filter_name' => $this->request->get['filter_name'], 'start' => 0, 'limit' => 20);
            
            $results = $this->model_people_affiliate->getAffiliates($filter);
            
            foreach ($results as $result) {
                $json[] = array('affiliate_id' => $result['affiliate_id'], 'name' => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'));
            }
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }
}
