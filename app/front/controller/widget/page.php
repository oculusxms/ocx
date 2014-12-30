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

class Page extends Controller {
    public function index() {
        $data = $this->theme->language('widget/page');
        
        $this->theme->model('content/page');
        
        $data['pages'] = array();
        
        foreach ($this->model_content_page->getPages() as $result) {
            $data['pages'][] = array('title' => $result['title'], 'href' => $this->url->link('content/page', 'page_id=' . $result['page_id']));
        }
        
        $data['contact'] = $this->url->link('content/contact');
        $data['sitemap'] = $this->url->link('content/sitemap');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        return $this->theme->view('widget/page', $data);
    }
}
