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

namespace Front\Controller\Widget;
use Oculus\Engine\Controller;

class Blogsearch extends Controller {
    public function index($setting) {
        $data = $this->theme->language('widget/blogsearch');
        
        $data['heading_title'] = $this->language->get('heading_title');
        
        // Search
        if (isset($this->request->get['filter_name'])) {
            $data['filter_name'] = $this->request->get['filter_name'];
        } else {
            $data['filter_name'] = '';
        }
        
        $this->theme->loadjs('javascript/widget/blogsearch', $data);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        return $this->theme->view('widget/blogsearch', $data);
    }
}
