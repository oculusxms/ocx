<?php

namespace Front\Model\Setting;
use Oculus\Engine\Model;

class Module extends Model {
	function getModules($type) {
		$key = 'modules.' . $type;
		$cachefile = $this->cache->get($key);

		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}module 
				WHERE `type` = '" . $this->db->escape($type) . "'
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