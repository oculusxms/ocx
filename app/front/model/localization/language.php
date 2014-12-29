<?php

namespace Front\Model\Localization;
use Oculus\Engine\Model;

class Language extends Model {
	public function getLanguage($language_id) {
		$key = 'language.' . $language_id; 
		$cachefile = $this->cache->get($key);
		
		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}language 
				WHERE language_id = '" . (int)$language_id . "'
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

	public function getLanguages() {
		$key = 'languages.all.' . (int)$this->config->get('config_store_id'); 
		$cachefile = $this->cache->get($key);

		if (is_bool($cachefile)):		
			$language_data = array();

			$query = $this->db->query("SELECT * FROM {$this->db->prefix}language ORDER BY sort_order, name");

			foreach ($query->rows as $result):
				$language_data[$result['code']] = array(
					'language_id' => $result['language_id'],
					'name'        => $result['name'],
					'code'        => $result['code'],
					'locale'      => $result['locale'],
					'image'       => $result['image'],
					'directory'   => $result['directory'],
					'filename'    => $result['filename'],
					'sort_order'  => $result['sort_order'],
					'status'      => $result['status']
				);
			endforeach;
			
			$cachefile = $language_data;
			$this->cache->set($key, $cachefile);
		endif;

		return $cachefile;
	}
}