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

class Affiliate extends Controller {

	private $error = array();
	private $post_errors = array(
        'code',
        'tax_id',
        'payment',
        'cheque',
        'paypal',
        'bank_name',
        'bank_account_name',
        'bank_account_number'
    );

	public function index() {
		if (!$this->customer->isLogged()):
            $this->session->data['redirect'] = $this->url->link('account/affiliate', '', 'SSL');
            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        endif;
        
        $data = $this->theme->language('account/affiliate');
        $this->theme->model('account/affiliate');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->breadcrumb->add('lang_text_account', 'account/dashboard', null, true, 'SSL');
        $this->breadcrumb->add('lang_heading_title', 'account/affiliate', null, true, 'SSL');

         if (isset($this->session->data['success'])):
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        else:
            $data['success'] = '';
        endif;
        
        if (isset($this->session->data['warning'])):
            $data['warning'] = $this->session->data['warning'];
            unset($this->session->data['warning']);
        elseif (isset($this->error['warning'])):
            $data['warning'] = $this->error['warning'];
        else:
            $data['warning'] = '';
        endif;

        $data['action'] = $this->url->link('account/affiliate/update', '', 'SSL');

		if ($this->request->server['REQUEST_METHOD'] != 'POST'):
			$customer_info = $this->model_account_affiliate->getSettings($this->customer->getId());
		endif;

		foreach ($this->post_errors as $error):
            if (isset($this->error[$error])):
                $data['error_' . $error] = $this->error[$error];
            else:
                $data['error_' . $error] = '';
            endif;
        endforeach;

        $defaults = array(
			'affiliate_status'    => 0,
			'company'             => '',
			'website'             => '',
			'code'                => uniqid(),
			'commission'          => $this->config->get('config_commission'),
			'tax_id'              => '',
			'payment_method'      => '',
			'cheque'              => '',
			'paypal'              => '',
			'bank_name'           => '',
			'bank_branch_number'  => '',
			'bank_swift_code'     => '',
			'bank_account_name'   => '',
			'bank_account_number' => ''
        );

        foreach ($defaults as $key => $value):
            if (isset($this->request->post[$key])):
                $data[$key] = $this->request->post[$key];
            elseif (!empty($customer_info)):
                $data[$key] = $customer_info[$key];
            else:
                $data[$key] = $value;
            endif;
        endforeach;

        $base_url = $this->app['http.server'] . $this->customer->getUsername();

        $data['lang_text_description'] = sprintf($this->language->get('lang_text_description'), $base_url);
        

        $this->theme->loadjs('javascript/account/affiliate', $data);

        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('account/affiliate', $data));
	}

	public function update() {
		if (!$this->customer->isLogged()):
            $this->session->data['redirect'] = $this->url->link('account/affiliate', '', 'SSL');
            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        endif;

		$customer_id = $this->customer->getId();

		$this->theme->language('account/affiliate');
        $this->theme->model('account/affiliate');

        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()):
        	$this->model_account_affiliate->editSettings($customer_id, $this->request->post);

        	$this->session->data['success'] = $this->language->get('lang_text_success');
        	$this->response->redirect($this->url->link('account/affiliate', '', 'SSL'));
        endif;

        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->index();
	}

	public function register() {
		if (!$this->customer->isLogged()):
            $this->session->data['redirect'] = $this->url->link('account/affiliate', '', 'SSL');
            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        endif;

        $customer_id = $this->customer->getId();

		$this->theme->language('account/affiliate');
        $this->theme->model('account/affiliate');

        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
       
	}

	public function autocomplete() {
        $json = array();
        
        if (isset($this->request->get['filter_name'])):
            $this->theme->model('catalog/product');
            
            $filter = array(
				'filter_name' => $this->request->get['filter_name'], 
				'start'       => 0, 
				'limit'       => 20
            );
            
            $results = $this->model_catalog_product->getProducts($filter);
            
            foreach ($results as $result):
                $json[] = array(
                	'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 
                	'link' => str_replace('&amp;', '&', $this->url->link('catalog/product', 'product_id=' . $result['product_id'] . '&z=' . $this->customer->getCode()))
                );
            endforeach;
        endif;
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }

	public function validate() {

	}
}