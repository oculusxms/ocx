<?php

namespace Front\Model\Checkout;
use Oculus\Engine\Model;
 
class Vouchertheme extends Model {
	public function getVoucherTheme($voucher_theme_id) {
		$key = md5('voucher.themeid.' . $voucher_theme_id);
		$cachefile = $this->cache->get($key);
		
		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}voucher_theme vt 
				LEFT JOIN {$this->db->prefix}voucher_theme_description vtd 
				ON (vt.voucher_theme_id = vtd.voucher_theme_id) 
				WHERE vt.voucher_theme_id = '" . (int)$voucher_theme_id . "' 
				AND vtd.language_id = '" . (int)$this->config->get('config_language_id') . "'
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
		
	public function getVoucherThemes($data = array()) {
		if (!empty($data)):
			$key = 'voucher.themes.all.' . md5(serialize($data));
			$cachefile = $this->cache->get($key);
			
			if (is_bool($cachefile)):
				$sql = "
					SELECT * 
					FROM {$this->db->prefix}voucher_theme vt 
					LEFT JOIN {$this->db->prefix}voucher_theme_description vtd 
						ON (vt.voucher_theme_id = vtd.voucher_theme_id) 
					WHERE vtd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
					ORDER BY vtd.name";	
				
				if (isset($data['order']) && ($data['order'] == 'DESC')):
					$sql .= " DESC";
				else:
					$sql .= " ASC";
				endif;
				
				if (isset($data['start']) || isset($data['limit'])):
					if ($data['start'] < 0):
						$data['start'] = 0;
					endif;
	
					if ($data['limit'] < 1):
						$data['limit'] = 20;
					endif;
				
					$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
				endif;
				
				$query = $this->db->query($sql);
				
				if ($query->num_rows):
					$cachefile = $query->rows;
					$this->cache->set($key, $cachefile);
				else:
					$this->cache->set($key, array());
					return array();
				endif;
			endif;
			unset($key);
		else:
			$key = 'voucher.themes.all.' . (int)$this->config->get('config_store_id');
			$cachefile = $this->cache->get($key);
		
			if (is_bool($cachefile)):
				$query = $this->db->query("
					SELECT * 
					FROM {$this->db->prefix}voucher_theme vt 
					LEFT JOIN {$this->db->prefix}voucher_theme_description vtd 
						ON (vt.voucher_theme_id = vtd.voucher_theme_id) 
					WHERE vtd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
					ORDER BY vtd.name
				");
	
				if ($query->num_rows):
					$cachefile = $query->rows;
					$this->cache->set($key, $cachefile);
				else:
					$this->cache->set($key, array());
					return array();
				endif;
			endif;		
		endif;
		
		return $cachefile;
	}
}