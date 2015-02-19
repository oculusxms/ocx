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

class Affiliate extends Controller {
    public function index() {
        $data = $this->theme->language('widget/affiliate');
        
        $data['logged']       = $this->affiliate->isLogged();
        $data['register']     = $this->url->link('affiliate/register', '', 'SSL');
        $data['login']        = $this->url->link('affiliate/login', '', 'SSL');
        $data['logout']       = $this->url->link('affiliate/logout', '', 'SSL');
        $data['forgotten']    = $this->url->link('affiliate/forgotten', '', 'SSL');
        $data['notification'] = $this->url->link('affiliate/notification', '', 'SSL');
        $data['account']      = $this->url->link('affiliate/account', '', 'SSL');
        $data['edit']         = $this->url->link('affiliate/edit', '', 'SSL');
        $data['password']     = $this->url->link('affiliate/password', '', 'SSL');
        $data['payment']      = $this->url->link('affiliate/payment', '', 'SSL');
        $data['tracking']     = $this->url->link('affiliate/tracking', '', 'SSL');
        $data['transaction']  = $this->url->link('affiliate/transaction', '', 'SSL');

        $this->theme->model('tool/utility');

        $data['unread'] = $this->model_tool_utility->getUnreadAffiliateNotifications($this->affiliate->getId());
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        return $this->theme->view('widget/affiliate', $data);
    }
}
