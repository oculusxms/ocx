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

namespace Admin\Model\Localization;
use Oculus\Engine\Model;

class Zone extends Model {
    public function addZone($data) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}zone 
			SET 
				status = '" . (int)$data['status'] . "', 
				name = '" . $this->db->escape($data['name']) . "', 
				code = '" . $this->db->escape($data['code']) . "', 
				country_id = '" . (int)$data['country_id'] . "'
		");
        
        $this->cache->delete('zone');
        $this->cache->delete('zones');
    }
    
    public function editZone($zone_id, $data) {
        $this->db->query("
			UPDATE {$this->db->prefix}zone 
			SET 
				status = '" . (int)$data['status'] . "', 
				name = '" . $this->db->escape($data['name']) . "', 
				code = '" . $this->db->escape($data['code']) . "', 
				country_id = '" . (int)$data['country_id'] . "' 
			WHERE zone_id = '" . (int)$zone_id . "'
		");
        
        $this->cache->delete('zone');
        $this->cache->delete('zones');
    }
    
    public function changeStatus($zone_id, $status) {
        $this->db->query("
			UPDATE {$this->db->prefix}zone 
			SET 
				status = '" . (int)$status . "' 
			WHERE zone_id = '" . (int)$zone_id . "'
		");
        
        $this->cache->delete('zone');
        $this->cache->delete('zones');
    }
    
    public function deleteZone($zone_id) {
        $this->db->query("DELETE FROM {$this->db->prefix}zone WHERE zone_id = '" . (int)$zone_id . "'");
        
        $this->cache->delete('zone');
        $this->cache->delete('zones');
    }
    
    public function getZone($zone_id) {
        $query = $this->db->query("
			SELECT DISTINCT * 
			FROM {$this->db->prefix}zone 
			WHERE zone_id = '" . (int)$zone_id . "'
		");
        
        return $query->row;
    }
    
    public function getZones($data = array()) {
        $sql = "
			SELECT *, 
				z.name, 
				c.name AS country 
			FROM {$this->db->prefix}zone z 
			LEFT JOIN {$this->db->prefix}country c 
				ON (z.country_id = c.country_id)";
        
        $sort_data = array('c.name', 'z.name', 'z.code');
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql.= " ORDER BY {$data['sort']}";
        } else {
            $sql.= " ORDER BY c.name";
        }
        
        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql.= " DESC";
        } else {
            $sql.= " ASC";
        }
        
        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }
            
            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }
            
            $sql.= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        
        $query = $this->db->query($sql);
        
        return $query->rows;
    }
    
    public function getZonesByCountryId($country_id) {
        $zone_data = $this->cache->get('zone.' . (int)$country_id);
        
        if (!$zone_data) {
            $query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}zone 
				WHERE country_id = '" . (int)$country_id . "' 
				AND status = '1' 
				ORDER BY name
			");
            
            $zone_data = $query->rows;
            
            $this->cache->set('zone.' . (int)$country_id, $zone_data);
        }
        
        return $zone_data;
    }
    
    public function findZonesByCountryId($country_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}zone 
			WHERE country_id = '" . (int)$country_id . "' 
			ORDER BY name
		");
        
        return $query->rows;
    }
    
    public function getTotalZones() {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}zone");
        
        return $query->row['total'];
    }
    
    public function getTotalZonesByCountryId($country_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}zone 
			WHERE country_id = '" . (int)$country_id . "'
		");
        
        return $query->row['total'];
    }
}
