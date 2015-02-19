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

namespace Front\Controller\Affiliate;
use Oculus\Engine\Controller;

class Transaction extends Controller {
    public function index() {
        if (!$this->affiliate->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('affiliate/transaction', '', 'SSL');
            
            $this->response->redirect($this->url->link('affiliate/login', '', 'SSL'));
        }
        
        $data = $this->theme->language('affiliate/transaction');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->breadcrumb->add('lang_text_account', 'affiliate/account', null, true, 'SSL');
        $this->breadcrumb->add('lang_text_transaction', 'affiliate/transaction', null, true, 'SSL');
        
        $this->theme->model('affiliate/transaction');
        
        $data['column_amount'] = sprintf($this->language->get('lang_column_amount'), $this->config->get('config_currency'));
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $data['transactions'] = array();
        
        $filter = array('sort' => 't.date_added', 'order' => 'DESC', 'start' => ($page - 1) * 10, 'limit' => 10);
        
        $transaction_total = $this->model_affiliate_transaction->getTotalTransactions($filter);
        
        $results = $this->model_affiliate_transaction->getTransactions($filter);
        
        foreach ($results as $result) {
            $data['transactions'][] = array('amount' => $this->currency->format($result['amount'], $this->config->get('config_currency')), 'description' => $result['description'], 'date_added' => date($this->language->get('lang_date_format_short'), strtotime($result['date_added'])));
        }
        
        $data['pagination'] = $this->theme->paginate($transaction_total, $page, 10, $this->language->get('lang_text_pagination'), $this->url->link('affiliate/transaction', 'page={page}', 'SSL'));
        
        $data['balance'] = $this->currency->format($this->model_affiliate_transaction->getBalance());
        
        $data['continue'] = $this->url->link('affiliate/account', '', 'SSL');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('affiliate/transaction', $data));
    }
}
