<?php

namespace Front\Model\Localization;
use Oculus\Engine\Model;

class Country extends Model {
	public function getCountry($country_id) {
		$key = 'country.' . $country_id;
		$cachefile = $this->cache->get($key);
		
		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}country 
				WHERE country_id = '" . (int)$country_id . "' 
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
	
	public function getCountries() {
		$key = 'countries.all';
		$cachefile = $this->cache->get($key);
		
		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}country 
				WHERE status = '1' 
				ORDER BY name ASC
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