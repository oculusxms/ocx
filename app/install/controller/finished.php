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

namespace Install\Controller;
use Oculus\Engine\Controller;

class Finished extends Controller {
    public function index() {
        
        $this->theme->setTitle('OCX Install || Step 4 - Finished');
        
        $data['manager'] = 'http://' . $this->request->server['SERVER_NAME'] . '/' . ADMIN_FASCADE;
        $data['home']    = 'http://' . $this->request->server['SERVER_NAME'];
        
        $name = date('m-d-Y-h.i.s', time()) . '.sql';
        
        if (is_readable($this->get('path.application') . 'ocx.sql')):
            copy($this->get('path.application') . 'ocx.sql', $this->get('path.application') . $name);
            unlink($this->get('path.application') . 'ocx.sql');
        endif;
        
        $data['removed'] = true;
        
        if (is_readable($this->get('path.application') . 'ocx.sql')):
            $data['removed'] = false;
        endif;
        
        $data['header'] = $this->theme->controller('header');
        $data['footer'] = $this->theme->controller('footer');
        
        $this->response->setOutput($this->theme->view('finished', $data));
    }
}
