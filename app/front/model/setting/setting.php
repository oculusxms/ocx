<?php

namespace Front\Model\Setting;
use Oculus\Engine\Model;
 
class Setting extends Model {
	public function getSetting($group, $store_id = 0) {
		$key  = $group . '.setting.' . $store_id;
		$rows = $this->cache->get($key);

		$data = array(); 

		if (is_bool($rows)):		
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}setting 
				WHERE store_id = '" . (int)$store_id . "' 
				AND `group` = '" . $this->db->escape($group) . "'
			");

			$rows = $query->rows;
			$this->cache->set($key, $rows);
		endif;
		
		foreach ($rows as $result):
			if (!$result['serialized']):
				$data[$result['key']] = $result['value'];
			else:
				$data[$result['key']] = unserialize($result['value']);
			endif;
		endforeach;

		return $data;
	}
}