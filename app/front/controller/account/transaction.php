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

namespace Front\Controller\Account;
use Oculus\Engine\Controller;

class Transaction extends Controller {
    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/transaction', '', 'SSL');
            
            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }
        
        $data = $this->theme->language('account/transaction');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->breadcrumb->add('lang_text_account', 'account/dashboard', null, true, 'SSL');
        $this->breadcrumb->add('lang_text_transaction', 'account/transaction', null, true, 'SSL');
        
        $this->theme->model('account/transaction');
        
        $data['column_amount'] = sprintf($this->language->get('lang_column_amount'), $this->config->get('config_currency'));
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        
        $data['transactions'] = array();
        
        $filter = array('sort' => 'date_added', 'order' => 'DESC', 'start' => ($page - 1) * 10, 'limit' => 10);
        
        $transaction_total = $this->model_account_transaction->getTotalTransactions($filter);
        
        $results = $this->model_account_transaction->getTransactions($filter);
        
        foreach ($results as $result) {
            $data['transactions'][] = array('amount' => $this->currency->format($result['amount'], $this->config->get('config_currency')), 'description' => $result['description'], 'date_added' => date($this->language->get('lang_date_format_short'), strtotime($result['date_added'])));
        }
        
        $data['pagination'] = $this->theme->paginate($transaction_total, $page, 10, $this->language->get('lang_text_pagination'), $this->url->link('account/transaction', 'page={page}', 'SSL'));
        
        $data['total'] = $this->currency->format($this->customer->getBalance());
        
        $data['continue'] = $this->url->link('account/dashboard', '', 'SSL');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('account/transaction', $data));
    }
}
