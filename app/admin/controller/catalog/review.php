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

class Review extends Controller {
    private $error = array();
    
    public function index() {
        $this->language->load('catalog/review');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('catalog/review');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    public function insert() {
        $this->language->load('catalog/review');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('catalog/review');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_review->addReview($this->request->post);
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
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
            
            $this->response->redirect($this->url->link('catalog/review', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function update() {
        $this->language->load('catalog/review');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('catalog/review');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_review->editReview($this->request->get['review_id'], $this->request->post);
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
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
            
            $this->response->redirect($this->url->link('catalog/review', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getForm();
    }
    
    public function delete() {
        $this->language->load('catalog/review');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('catalog/review');
        
        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $review_id) {
                $this->model_catalog_review->deleteReview($review_id);
            }
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            $url = '';
            
            if (isset($this->request->get['filter_status'])) {
                $url.= '&filter_status=' . $this->request->get['filter_status'];
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
            
            $this->response->redirect($this->url->link('catalog/review', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->getList();
    }
    
    protected function getList() {
        $data = $this->theme->language('catalog/review');
        
        if (isset($this->request->get['filter_status'])):
            $filter_status = $this->request->get['filter_status'];
        else:
            $filter_status = 1;
        endif;
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'r.date_added';
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
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
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
        
        $this->breadcrumb->add('heading_title', 'catalog/review', $url);
        
        $data['insert'] = $this->url->link('catalog/review/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('catalog/review/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        $data['reviews'] = array();
        
        $filter = array('filter_status' => $filter_status, 'sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $this->config->get('config_admin_limit'), 'limit' => $this->config->get('config_admin_limit'));
        
        $review_total = $this->model_catalog_review->getTotalReviews($filter);
        
        $results = $this->model_catalog_review->getReviews($filter);
        
        foreach ($results as $result) {
            $action = array();
            
            $action[] = array('text' => $this->language->get('text_edit'), 'href' => $this->url->link('catalog/review/update', 'token=' . $this->session->data['token'] . '&review_id=' . $result['review_id'] . $url, 'SSL'));
            
            $data['reviews'][] = array('review_id' => $result['review_id'], 'name' => $result['name'], 'author' => $result['author'], 'rating' => $result['rating'], 'status' => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')), 'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])), 'selected' => isset($this->request->post['selected']) && in_array($result['review_id'], $this->request->post['selected']), 'action' => $action);
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
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if ($order == 'ASC') {
            $url.= '&order=DESC';
        } else {
            $url.= '&order=ASC';
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $data['sort_product'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
        $data['sort_author'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'] . '&sort=r.author' . $url, 'SSL');
        $data['sort_rating'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'] . '&sort=r.rating' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'] . '&sort=r.date_added' . $url, 'SSL');
        
        $url = '';
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
        }
        
        if (isset($this->request->get['sort'])) {
            $url.= '&sort=' . $this->request->get['sort'];
        }
        
        if (isset($this->request->get['order'])) {
            $url.= '&order=' . $this->request->get['order'];
        }
        
        $data['pagination'] = $this->theme->paginate($review_total, $page, $this->config->get('config_admin_limit'), $this->language->get('text_pagination'), $this->url->link('catalog/review', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL'));
        
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['filter_status'] = $filter_status;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('catalog/review_list', $data));
    }
    
    protected function getForm() {
        $data = $this->theme->language('catalog/review');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['product'])) {
            $data['error_product'] = $this->error['product'];
        } else {
            $data['error_product'] = '';
        }
        
        if (isset($this->error['author'])) {
            $data['error_author'] = $this->error['author'];
        } else {
            $data['error_author'] = '';
        }
        
        if (isset($this->error['text'])) {
            $data['error_text'] = $this->error['text'];
        } else {
            $data['error_text'] = '';
        }
        
        if (isset($this->error['rating'])) {
            $data['error_rating'] = $this->error['rating'];
        } else {
            $data['error_rating'] = '';
        }
        
        $url = '';
        
        if (isset($this->request->get['filter_status'])) {
            $url.= '&filter_status=' . $this->request->get['filter_status'];
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
        
        $this->breadcrumb->add('heading_title', 'catalog/review', $url);
        
        if (!isset($this->request->get['review_id'])) {
            $data['action'] = $this->url->link('catalog/review/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('catalog/review/update', 'token=' . $this->session->data['token'] . '&review_id=' . $this->request->get['review_id'] . $url, 'SSL');
        }
        
        $data['cancel'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        if (isset($this->request->get['review_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $review_info = $this->model_catalog_review->getReview($this->request->get['review_id']);
        }
        
        $data['token'] = $this->session->data['token'];
        
        $this->theme->model('catalog/product');
        
        if (isset($this->request->post['product_id'])) {
            $data['product_id'] = $this->request->post['product_id'];
        } elseif (!empty($review_info)) {
            $data['product_id'] = $review_info['product_id'];
        } else {
            $data['product_id'] = '';
        }
        
        if (isset($this->request->post['product'])) {
            $data['product'] = $this->request->post['product'];
        } elseif (!empty($review_info)) {
            $data['product'] = $review_info['product'];
        } else {
            $data['product'] = '';
        }
        
        if (isset($this->request->post['author'])) {
            $data['author'] = $this->request->post['author'];
        } elseif (!empty($review_info)) {
            $data['author'] = $review_info['author'];
        } else {
            $data['author'] = '';
        }
        
        if (isset($this->request->post['text'])) {
            $data['text'] = $this->request->post['text'];
        } elseif (!empty($review_info)) {
            $data['text'] = $review_info['text'];
        } else {
            $data['text'] = '';
        }
        
        if (isset($this->request->post['rating'])) {
            $data['rating'] = $this->request->post['rating'];
        } elseif (!empty($review_info)) {
            $data['rating'] = $review_info['rating'];
        } else {
            $data['rating'] = '';
        }
        
        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($review_info)) {
            $data['status'] = $review_info['status'];
        } else {
            $data['status'] = '';
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('catalog/review_form', $data));
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'catalog/review')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (!$this->request->post['product_id']) {
            $this->error['product'] = $this->language->get('error_product');
        }
        
        if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 64)) {
            $this->error['author'] = $this->language->get('error_author');
        }
        
        if (utf8_strlen($this->request->post['text']) < 1) {
            $this->error['text'] = $this->language->get('error_text');
        }
        
        if (!isset($this->request->post['rating'])) {
            $this->error['rating'] = $this->language->get('error_rating');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
    
    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'catalog/review')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
