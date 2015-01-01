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

namespace Admin\Controller\Common;
use Oculus\Engine\Controller;
use Oculus\Engine\Action;
use Oculus\Service\ActionService;

class Reset extends Controller {
    private $error = array();
    
    public function index() {
        if ($this->user->isLogged()) {
            $this->response->redirect($this->url->link('common/dashboard', '', 'SSL'));
        }
        
        if (!$this->config->get('config_password')) {
            $this->response->redirect($this->url->link('common/login', '', 'SSL'));
        }
        
        if (isset($this->request->get['code'])) {
            $code = $this->request->get['code'];
        } else {
            $code = '';
        }
        
        $this->theme->model('people/user');
        
        $user_info = $this->model_people_user->getUserByCode($code);
        
        if ($user_info) {
            $data = $this->theme->language('common/reset');
            
            if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                $this->model_people_user->editPassword($user_info['user_id'], $this->request->post['password']);
                
                $this->session->data['success'] = $this->language->get('text_success');
                
                $this->response->redirect($this->url->link('common/login', '', 'SSL'));
            }
            
            $this->breadcrumb->add('text_reset', 'common/reset');
            
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
            
            $data['action'] = $this->url->link('common/reset', 'code=' . $code, 'SSL');
            
            $data['cancel'] = $this->url->link('common/login', '', 'SSL');
            
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
            
            $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
            
            $data = $this->theme->render_controllers($data);
            
            $this->response->setOutput($this->theme->view('common/reset', $data));
        } else {
            $this->theme->model('setting/setting');
            
            $this->model_setting_setting->editSettingValue('config', 'config_password', '0');
            
            $this->theme->listen(__CLASS__, __FUNCTION__);
            
            return new Action(new ActionService($this->app, 'common/login'));
        }
    }
    
    protected function validate() {
        if (($this->encode->strlen($this->request->post['password']) < 4) || ($this->encode->strlen($this->request->post['password']) > 20)) {
            $this->error['password'] = $this->language->get('error_password');
        }
        
        if ($this->request->post['confirm'] != $this->request->post['password']) {
            $this->error['confirm'] = $this->language->get('error_confirm');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
