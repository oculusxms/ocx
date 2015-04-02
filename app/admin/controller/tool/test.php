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

namespace Admin\Controller\Tool;
use Oculus\Engine\Controller;
use Oculus\Library\Template;
use Oculus\Library\Text;

class Test extends Controller {
    public function index() {
        $data = $this->theme->language('tool/test');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        if (isset($this->session->data['success'])):
            $data['success'] = $this->session->data['success'];
            
            unset($this->session->data['success']);
        else:
            $data['success'] = '';
        endif;
        
        $this->breadcrumb->add('lang_heading_title', 'tool/test');

        

        
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('tool/test', $data));
    }

    public function email_test($data, $message) {
        $search = array(
            '!order_id!',
            '!status!',
            '!link!',
            '!comment!'
        );

        $replace = array(
            $data['order_id'],
            $data['status'],
            $data['link'],
            $data['comment']
        );

        foreach ($message as $key => $value):
            $message[$key] = str_replace($search, $replace, $value);
        endforeach;
        //$this->theme->test($message);
        return $message;
    }
}
