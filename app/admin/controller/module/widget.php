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

namespace Admin\Controller\Module;
use Oculus\Engine\Controller;

class Widget extends Controller {
    public function index() {
        $data = $this->theme->language('module/widget');
        $this->theme->setTitle($this->language->get('lang_heading_widget'));
        
        $this->breadcrumb->add('lang_heading_widget', 'module/widget');
        
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        
        if (isset($this->session->data['error'])) {
            $data['error'] = $this->session->data['error'];
            
            unset($this->session->data['error']);
        } else {
            $data['error'] = '';
        }
        
        $this->theme->model('setting/module');
        
        $modules = $this->model_setting_module->getInstalled('widget');
        
        foreach ($modules as $key => $value) {
            $theme_file = $this->theme->path . 'controller/widget/' . $value . '.php';
            $core_file = $this->app['path.application'] . 'controller/widget/' . $value . '.php';
            
            if (!is_readable($theme_file) && !is_readable($core_file)) {
                $this->model_setting_module->uninstall('widget', $value);
                
                unset($modules[$key]);
            }
        }
        
        $data['modules'] = array();
        
        $files = $this->theme->getFiles('widget');
        
        if ($files) {
            foreach ($files as $file) {
                $module = strtolower(basename($file, '.php'));
                
                $data = $this->theme->language('widget/' . $module, $data);
                
                $action = array();
                
                if (!in_array($module, $modules)) {
                    $action[] = array('text' => $this->language->get('lang_text_install'), 'href' => $this->url->link('module/widget/install', 'token=' . $this->session->data['token'] . '&module=' . $module, 'SSL'));
                } else {
                    $action[] = array('text' => $this->language->get('lang_text_edit'), 'href' => $this->url->link('widget/' . $module . '', 'token=' . $this->session->data['token'], 'SSL'));
                    
                    $action[] = array('text' => $this->language->get('lang_text_uninstall'), 'href' => $this->url->link('module/widget/uninstall', 'token=' . $this->session->data['token'] . '&module=' . $module, 'SSL'));
                }
                
                $data['modules'][] = array('name' => $this->language->get('lang_heading_title'), 'action' => $action);
            }
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('module/widget', $data));
    }
    
    public function install() {
        $this->language->load('module/widget');
        
        if (!$this->user->hasPermission('modify', 'module/widget')) {
            $this->session->data['error'] = $this->language->get('lang_error_permission');
            
            $this->theme->listen(__CLASS__, __FUNCTION__);
            
            $this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
        } else {
            $this->theme->model('setting/module');
            
            $this->model_setting_module->install('widget', $this->request->get['module']);
            
            $this->theme->model('people/user_group');
            
            $this->model_people_user_group->addPermission($this->user->getId(), 'access', 'widget/' . $this->request->get['module']);
            $this->model_people_user_group->addPermission($this->user->getId(), 'modify', 'widget/' . $this->request->get['module']);
            
            if (is_readable($this->theme->path . 'controller/widget/' . $this->request->get['module'] . '.php')):
                $class = 'Theme\Admin\\' . $this->theme->name . '\Controller\Widget\\' . ucfirst($this->request->get['module']);
            else:
                $class = 'Admin\Controller\Widget\\' . ucfirst($this->request->get['module']);
            endif;
            $class = new $class($this->app);
            
            if (method_exists($class, 'install')) {
                $class->install();
            }
            
            $this->theme->listen(__CLASS__, __FUNCTION__);
            
            $this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }
    
    public function uninstall() {
        $this->language->load('module/widget');
        
        if (!$this->user->hasPermission('modify', 'module/widget')) {
            $this->session->data['error'] = $this->language->get('lang_error_permission');
            
            $this->theme->listen(__CLASS__, __FUNCTION__);
            
            $this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
        } else {
            $this->theme->model('setting/module');
            $this->theme->model('setting/setting');
            
            $this->model_setting_module->uninstall('widget', $this->request->get['module']);
            $this->model_setting_setting->deleteSetting($this->request->get['module']);
            
            if (is_readable($this->theme->path . 'controller/widget/' . $this->request->get['module'] . '.php')):
                $class = 'Theme\Admin\\' . $this->theme->name . '\Controller\Widget\\' . ucfirst($this->request->get['module']);
            else:
                $class = 'Admin\Controller\Widget\\' . ucfirst($this->request->get['module']);
            endif;
            
            $class = new $class($this->app);
            
            if (method_exists($class, 'uninstall')) {
                $class->uninstall();
            }
            
            $this->theme->listen(__CLASS__, __FUNCTION__);
            
            $this->response->redirect($this->url->link('module/widget', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }
}
