<?php

namespace Front\Model\Design;
use Oculus\Engine\Model;

class Layout extends Model {	
	public function getLayout($route) {
		$key = 'layoutid.' . str_replace('/', '.', $route);
		$cachefile = $this->cache->get($key);

		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}layout_route 
				WHERE '" . $this->db->escape($route) . "' 
				LIKE CONCAT(route, '%') 
				AND store_id = '" . (int)$this->config->get('config_store_id') . "' 
				ORDER BY route DESC LIMIT 1");
			
			if ($query->num_rows):
				$cachefile = $query->row['layout_id'];
				$this->cache->set($key, $cachefile);
			else:
				$this->cache->set($key, 0);
				return 0;
			endif;

		endif;

		return $cachefile;
	}
}
