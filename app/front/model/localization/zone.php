<?php

namespace Front\Model\Localization;
use Oculus\Engine\Model;

class Zone extends Model {
	public function getZone($zone_id) {
		$key = 'zone.' . $zone_id;
		$cachefile = $this->cache->get($key);
		
		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}zone 
				WHERE zone_id = '" . (int)$zone_id . "' 
				AND status = '1'
			");
			if ($query->num_rows):
				$cachefile = $query->row;
				$this->cache->set($key, $cachefile);
			else:
				$this->cache->set($key, array());
				return array();
			endif;
		endif;
		
		return $cachefile;
	}		
	
	public function getZonesByCountryId($country_id) {
		$key = 'zones.country.' . $country_id;
		$cachefile = $this->cache->get($key);
		
		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}zone 
				WHERE country_id = '" . (int)$country_id . "' 
				AND status = '1' 
				ORDER BY name
			");
	
			if ($query->num_rows):
				$cachefile = $query->rows;
				$this->cache->set($key, $cachefile);
			else:
				$this->cache->set($key, array());
				return array();
			endif;
		endif;
	
		return $cachefile;
	}
}