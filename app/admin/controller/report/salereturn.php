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

class Salereturn extends Controller {
    public function index() {
        $data = $this->theme->language('report/sale_return');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        if (isset($this->request->get['filter_date_start'])) {
            $filter_date_start = $this->request->get['filter_date_start'];
        } else {
            $filter_date_start = '';
        }
        
        if (isset($this->request->get['filter_date_end'])) {
            $filter_date_end = $this->request->get['filter_date_end'];
        } else {
            $filter_date_end = '';
        }
        
        if (isset($this->request->get['filter_group'])) {
            $filter_group = $this->request->get['filter_group'];
        } else {
            $filter_group = 'week';
        }
        
        if (isset($this->request->get['filter_return_status_id'])) {
            $filter_return_status_id = $this->request->get['filter_return_status_id'];
        } else {
            $filter_return_status_id = 0;
        }
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $url = '';
        
        if (isset($this->request->get['filter_date_start'])) {
            $url.= '&filter_date_start=' . $this->request->get['filter_date_start'];
        }
        
        if (isset($this->request->get['filter_date_end'])) {
            $url.= '&filter_date_end=' . $this->request->get['filter_date_end'];
        }
        
        if (isset($this->request->get['filter_group'])) {
            $url.= '&filter_group=' . $this->request->get['filter_group'];
        }
        
        if (isset($this->request->get['filter_return_status_id'])) {
            $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
        }
        
        if (isset($this->request->get['page'])) {
            $url.= '&page=' . $this->request->get['page'];
        }
        
        $this->breadcrumb->add('lang_heading_title', 'report/salereturn', $url);
        
        $this->theme->model('report/returns');
        
        $data['returns'] = array();
        
        $filter = array(
            'filter_date_start'       => $filter_date_start, 
            'filter_date_end'         => $filter_date_end, 
            'filter_group'            => $filter_group, 
            'filter_return_status_id' => $filter_return_status_id, 
            'start'                   => ($page - 1) * $this->config->get('config_admin_limit'), 
            'limit'                   => $this->config->get('config_admin_limit')
        );
        
        $return_total = $this->model_report_returns->getTotalReturns($filter);
        
        $results = $this->model_report_returns->getReturns($filter);
        
        foreach ($results as $result) {
            $data['returns'][] = array(
                'date_start' => date($this->language->get('lang_date_format_short'), strtotime($result['date_start'])), 
                'date_end'   => date($this->language->get('lang_date_format_short'), strtotime($result['date_end'])), 
                'returns'    => $result['returns']
            );
        }
        
        $data['token'] = $this->session->data['token'];
        
        $this->theme->model('localization/returnstatus');
        
        $data['return_statuses'] = $this->model_localization_returnstatus->getReturnStatuses();
        
        $data['groups'] = array();
        
        $data['groups'][] = array(
            'text'  => $this->language->get('lang_text_year'), 
            'value' => 'year'
        );
        
        $data['groups'][] = array(
            'text'  => $this->language->get('lang_text_month'), 
            'value' => 'month'
        );
        
        $data['groups'][] = array(
            'text'  => $this->language->get('lang_text_week'), 
            'value' => 'week'
        );
        
        $data['groups'][] = array(
            'text'  => $this->language->get('lang_text_day'), 
            'value' => 'day'
        );
        
        $url = '';
        
        if (isset($this->request->get['filter_date_start'])) {
            $url.= '&filter_date_start=' . $this->request->get['filter_date_start'];
        }
        
        if (isset($this->request->get['filter_date_end'])) {
            $url.= '&filter_date_end=' . $this->request->get['filter_date_end'];
        }
        
        if (isset($this->request->get['filter_group'])) {
            $url.= '&filter_group=' . $this->request->get['filter_group'];
        }
        
        if (isset($this->request->get['filter_return_status_id'])) {
            $url.= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
        }
        
        $data['pagination'] = $this->theme->paginate(
            $return_total, 
            $page, 
            $this->config->get('config_admin_limit'), 
            $this->language->get('lang_text_pagination'), 
            $this->url->link('report/salereturn', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL')
        );
        
        $data['filter_date_start']       = $filter_date_start;
        $data['filter_date_end']         = $filter_date_end;
        $data['filter_group']            = $filter_group;
        $data['filter_return_status_id'] = $filter_return_status_id;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('report/sale_return', $data));
    }
}
