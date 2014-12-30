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

namespace Front\Model\Tool;
use Oculus\Engine\Model;

class Online extends Model {
    public function whosonline($ip, $customer_id, $url, $referer) {
        $this->db->query("DELETE FROM `{$this->db->prefix}customer_online` WHERE (UNIX_TIMESTAMP(`date_added`) + 3600) < UNIX_TIMESTAMP(NOW())");
        
        $this->db->query("REPLACE INTO `{$this->db->prefix}customer_online` SET `ip` = '" . $this->db->escape($ip) . "', `customer_id` = '" . (int)$customer_id . "', `url` = '" . $this->db->escape($url) . "', `referer` = '" . $this->db->escape($referer) . "', `date_added` = NOW()");
    }
}
