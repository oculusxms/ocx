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

namespace Admin\Controller\Report;
use Oculus\Engine\Controller;

class Productviewed extends Controller {
    public function index() {
        $data = $this->theme->language('report/product_viewed');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $url = '';
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $this->breadcrumb->add('heading_title', 'report/productviewed', $url);
        
        $this->theme->model('report/product');
        
        $filter = array('start' => ($page - 1) * $this->config->get('config_admin_limit'), 'limit' => $this->config->get('config_admin_limit'));
        
        $product_viewed_total = $this->model_report_product->getTotalProductsViewed($filter);
        
        $product_views_total = $this->model_report_product->getTotalProductViews();
        
        $data['products'] = array();
        
        $results = $this->model_report_product->getProductsViewed($filter);
        
        foreach ($results as $result) {
            if ($result['viewed']) {
                $percent = round($result['viewed'] / $product_views_total * 100, 2);
            } else {
                $percent = 0;
            }
            
            $data['products'][] = array('name' => $result['name'], 'model' => $result['model'], 'viewed' => $result['viewed'], 'percent' => $percent . '%');
        }
        
        $url = '';
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $data['reset'] = $this->url->link('report/productviewed/reset', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        
        $data['pagination'] = $this->theme->paginate($product_viewed_total, $page, $this->config->get('config_admin_limit'), $this->language->get('text_pagination'), $this->url->link('report/productviewed', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL'));
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('report/product_viewed', $data));
    }
    
    public function reset() {
        $this->language->load('report/product_viewed');
        $this->theme->model('report/product');
        $this->model_report_product->reset();
        
        $this->session->data['success'] = $this->language->get('text_success');
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->response->redirect($this->url->link('report/productviewed', 'token=' . $this->session->data['token'], 'SSL'));
    }
}
