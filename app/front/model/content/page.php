<?php

namespace Front\Model\Content;
use Oculus\Engine\Model;

class Page extends Model {
	public function getPage($page_id) {
		$key = 'page.' . $page_id;
		$cachefile = $this->cache->get($key);

		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT DISTINCT * 
				FROM {$this->db->prefix}page i 
				LEFT JOIN {$this->db->prefix}page_description id 
					ON (i.page_id = id.page_id) 
				LEFT JOIN {$this->db->prefix}page_to_store i2s 
					ON (i.page_id = i2s.page_id) 
				WHERE i.page_id = '" . (int)$page_id . "' 
				AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' 
				AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' 
				AND i.status = '1'
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
	
	public function getPages() {
		$key = 'pages.all.' . (int)$this->config->get('config_store_id');
		$cachefile = $this->cache->get($key);

		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}page i 
				LEFT JOIN {$this->db->prefix}page_description id 
					ON (i.page_id = id.page_id) 
				LEFT JOIN {$this->db->prefix}page_to_store i2s 
					ON (i.page_id = i2s.page_id) 
				WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' 
				AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' 
				AND i.status = '1' 
				ORDER BY i.sort_order, LCASE(id.title) ASC
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
	
	public function getPageLayoutId($page_id) {
		$key = 'page.layoutid.' . $page_id;
		$cachefile = $this->cache->get($key);

		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}page_to_layout 
				WHERE page_id = '" . (int)$page_id . "' 
				AND store_id = '" . (int)$this->config->get('config_store_id') . "'
			");

			if ($query->num_rows):
				$cachefile = $query->row['layout_id'];
				$this->cache->set($key, $cachefile);
			else:
				$this->cache->set($key, (int)0);
				return 0;
			endif;
			
		endif;

		return $cachefile;
	}	
}