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

namespace Admin\Model\Setting;
use Oculus\Engine\Model;

class Setting extends Model {
    public function getSetting($group, $store_id = 0) {
        $data = array();
        
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}setting 
			WHERE store_id = '" . (int)$store_id . "' 
			AND `group` = '" . $this->db->escape($group) . "'
		");
        
        foreach ($query->rows as $result) {
            if (!$result['serialized']) {
                $data[$result['key']] = $result['value'];
            } else {
                $data[$result['key']] = unserialize($result['value']);
            }
        }
        
        return $data;
    }
    
    public function editSetting($group, $data, $store_id = 0) {
        $this->deleteSetting($group, $store_id);
        
        foreach ($data as $key => $value):
            if (!is_array($value)):
                $this->db->query("
					INSERT INTO {$this->db->prefix}setting 
					SET 
						store_id = '" . (int)$store_id . "', 
						`group` = '" . $this->db->escape($group) . "', 
						`key` = '" . $this->db->escape($key) . "', 
						`value` = '" . $this->db->escape($value) . "'
				");
            else:
                $this->db->query("
					INSERT INTO {$this->db->prefix}setting 
					SET 
						store_id = '" . (int)$store_id . "', 
						`group` = '" . $this->db->escape($group) . "', 
						`key` = '" . $this->db->escape($key) . "', 
						`value` = '" . $this->db->escape(serialize($value)) . "', 
						serialized = '1'
				");
            endif;
        endforeach;
        
        $this->cache->delete('default');
    }
    
    public function deleteSetting($group, $store_id = 0) {
        $this->db->query("
			DELETE FROM {$this->db->prefix}setting 
			WHERE store_id = '" . (int)$store_id . "' 
			AND `group` = '" . $this->db->escape($group) . "'
		");
        
        $this->cache->delete('default');
    }
    
    public function getSettingValue($group = '', $key = '', $value = '', $store_id = 0) {
        $query = $this->db->query("
			SELECT `value` 
			FROM {$this->db->prefix}setting 
			WHERE `group` = '" . $this->db->escape($group) . "' 
			AND `key` = '" . $this->db->escape($key) . "' 
			AND store_id = '" . (int)$store_id . "'");
        
        if ($query->num_rows):
            return true;
        else:
            return false;
        endif;
    }
    
    public function editSettingValue($group = '', $key = '', $value = '', $store_id = 0) {
        if (!is_array($value)) {
            $this->db->query("
				UPDATE {$this->db->prefix}setting 
				SET 
					`value` = '" . $this->db->escape($value) . "' 
				WHERE `group` = '" . $this->db->escape($group) . "' 
				AND `key` = '" . $this->db->escape($key) . "' 
				AND store_id = '" . (int)$store_id . "'
			");
        } else {
            $this->db->query("
				UPDATE {$this->db->prefix}setting 
				SET 
					`value` = '" . $this->db->escape(serialize($value)) . "' 
				WHERE `group` = '" . $this->db->escape($group) . "' 
				AND `key` = '" . $this->db->escape($key) . "' 
				AND store_id = '" . (int)$store_id . "', 
				serialized = '1'
			");
        }
        
        $this->cache->delete('default');
    }
}
