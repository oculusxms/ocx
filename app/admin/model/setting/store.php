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

class Store extends Model {
    public function addStore($data) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}store 
			SET 
				name = '" . $this->db->escape($data['config_name']) . "', 
				`url` = '" . $this->db->escape($data['config_url']) . "', 
				`ssl` = '" . $this->db->escape($data['config_ssl']) . "'
		");
        
        $store_id = $this->db->getLastId();
        
        $this->cache->delete('stores');
        
        $this->theme->trigger('admin_add_store', array('store_id' => $store_id));
        
        return $store_id;
    }
    
    public function editStore($store_id, $data) {
        $this->db->query("
			UPDATE {$this->db->prefix}store 
			SET 
				name = '" . $this->db->escape($data['config_name']) . "', 
				`url` = '" . $this->db->escape($data['config_url']) . "', 
				`ssl` = '" . $this->db->escape($data['config_ssl']) . "' 
			WHERE store_id = '" . (int)$store_id . "'
		");
        
        $this->cache->delete('stores');
        
        $this->theme->trigger('admin_edit_store', array('store_id' => $store_id));
    }
    
    public function deleteStore($store_id) {
        $this->db->query("DELETE FROM {$this->db->prefix}store WHERE store_id = '" . (int)$store_id . "'");
        
        $this->cache->delete('stores');
        
        $this->theme->trigger('admin_delete_store', array('store_id' => $store_id));
    }
    
    public function getStore($store_id) {
        $query = $this->db->query("
			SELECT DISTINCT * 
			FROM {$this->db->prefix}store 
			WHERE store_id = '" . (int)$store_id . "'
		");
        
        return $query->row;
    }
    
    public function getStores($data = array()) {
        $store_data = $this->cache->get('store');
        
        if (!$store_data) {
            $query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}store 
				ORDER BY url");
            
            $store_data = $query->rows;
            
            $this->cache->set('store', $store_data);
        }
        
        return $store_data;
    }
    
    public function getTotalStores() {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}store");
        
        return $query->row['total'];
    }
    
    public function getTotalStoresByLayoutId($layout_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}setting 
			WHERE `key` = 'config_layout_id' 
			AND `value` = '" . (int)$layout_id . "' 
			AND store_id != '0'
		");
        
        return $query->row['total'];
    }
    
    public function getTotalStoresByLanguage($language) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}setting 
			WHERE `key` = 'config_language' 
			AND `value` = '" . $this->db->escape($language) . "' 
			AND store_id != '0'
		");
        
        return $query->row['total'];
    }
    
    public function getTotalStoresByCurrency($currency) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}setting 
			WHERE `key` = 'config_currency' 
			AND `value` = '" . $this->db->escape($currency) . "' 
			AND store_id != '0'
		");
        
        return $query->row['total'];
    }
    
    public function getTotalStoresByCountryId($country_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}setting 
			WHERE `key` = 'config_country_id' 
			AND `value` = '" . (int)$country_id . "' 
			AND store_id != '0'
		");
        
        return $query->row['total'];
    }
    
    public function getTotalStoresByZoneId($zone_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}setting 
			WHERE `key` = 'config_zone_id' 
			AND `value` = '" . (int)$zone_id . "' 
			AND store_id != '0'
		");
        
        return $query->row['total'];
    }
    
    public function getTotalStoresByCustomerGroupId($customer_group_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}setting 
			WHERE `key` = 'config_customer_group_id' 
			AND `value` = '" . (int)$customer_group_id . "' 
			AND store_id != '0'
		");
        
        return $query->row['total'];
    }
    
    public function getTotalStoresByPageId($page_id) {
        $account_query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}setting 
			WHERE `key` = 'config_account_id' 
			AND `value` = '" . (int)$page_id . "' 
			AND store_id != '0'
		");
        
        $checkout_query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}setting 
			WHERE `key` = 'config_checkout_id' 
			AND `value` = '" . (int)$page_id . "' 
			AND store_id != '0'
		");
        
        return ($account_query->row['total'] + $checkout_query->row['total']);
    }
    
    public function getTotalStoresByOrderStatusId($order_status_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}setting 
			WHERE `key` = 'config_order_status_id' 
			AND `value` = '" . (int)$order_status_id . "' 
			AND store_id != '0'
		");
        
        return $query->row['total'];
    }
}
