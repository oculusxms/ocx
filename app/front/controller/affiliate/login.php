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

class Login extends Controller {
    private $error = array();
    
    public function index() {
        if ($this->affiliate->isLogged()):
            $this->response->redirect($this->url->link('affiliate/account', '', 'SSL'));
        endif;
        
        $data = $this->theme->language('affiliate/login');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $this->theme->model('affiliate/affiliate');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->post['email']) && isset($this->request->post['password']) && $this->validate()):
            if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false || strpos($this->request->post['redirect'], $this->config->get('config_ssl')) !== false)):
                $this->response->redirect(str_replace('&amp;', '&', $this->request->post['redirect']));
            else:
                $this->response->redirect($this->url->link('affiliate/account', '', 'SSL'));
            endif;
        endif;
        
        if ($this->affiliate->isLogged()):
            $this->breadcrumb->add('lang_text_account', 'affiliate/account', null, true, 'SSL');
        endif;

        $this->breadcrumb->add('lang_text_login', 'affiliate/login', null, true, 'SSL');
        
        $data['text_description'] = sprintf($this->language->get('lang_text_description'), $this->config->get('config_name'), $this->config->get('config_name'), $this->config->get('config_commission') . '%');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        $data['action']    = $this->url->link('affiliate/login', '', 'SSL');
        $data['register']  = $this->url->link('affiliate/register', '', 'SSL');
        $data['forgotten'] = $this->url->link('affiliate/forgotten', '', 'SSL');
        
        if (isset($this->request->post['redirect'])):
            $data['redirect'] = $this->request->post['redirect'];
        elseif (isset($this->session->data['redirect'])):
            $data['redirect'] = $this->session->data['redirect'];
            unset($this->session->data['redirect']);
        else:
            $data['redirect'] = '';
        endif;
        
        if (isset($this->session->data['success'])):
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        else:
            $data['success'] = '';
        endif;
        
        if (isset($this->request->post['email'])):
            $data['email'] = $this->request->post['email'];
        else:
            $data['email'] = '';
        endif;
        
        if (isset($this->request->post['password'])):
            $data['password'] = $this->request->post['password'];
        else:
            $data['password'] = '';
        endif;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('affiliate/login', $data));
    }
    
    protected function validate() {
        if (!$this->affiliate->login($this->request->post['email'], $this->request->post['password'])):
            $this->error['warning'] = $this->language->get('lang_error_login');
        endif;
        
        $affiliate_info = $this->model_affiliate_affiliate->getAffiliateByEmail($this->request->post['email']);
        
        if ($affiliate_info && !$affiliate_info['approved']):
            $this->error['warning'] = $this->language->get('lang_error_approved');
        endif;
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
