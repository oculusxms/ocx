<?php

namespace Front\Model\Setting;
use Oculus\Engine\Model;

class Store extends Model {
	public function getStores($data = array()) {
		$key = 'stores.' . (int)$this->config->get('config_store_id');
		$cachefile = $this->cache->get($key);
	
		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}store 
				ORDER BY url
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