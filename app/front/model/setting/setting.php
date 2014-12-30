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

namespace Front\Model\Setting;
use Oculus\Engine\Model;

class Setting extends Model {
    public function getSetting($group, $store_id = 0) {
        $key = $group . '.setting.' . $store_id;
        $rows = $this->cache->get($key);
        
        $data = array();
        
        if (is_bool($rows)):
            $query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}setting 
				WHERE store_id = '" . (int)$store_id . "' 
				AND `group` = '" . $this->db->escape($group) . "'
			");
            
            $rows = $query->rows;
            $this->cache->set($key, $rows);
        endif;
        
        foreach ($rows as $result):
            if (!$result['serialized']):
                $data[$result['key']] = $result['value'];
            else:
                $data[$result['key']] = unserialize($result['value']);
            endif;
        endforeach;
        
        return $data;
    }
}
