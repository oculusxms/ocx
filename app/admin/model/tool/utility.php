<?php

namespace Admin\Model\Tool;
use Oculus\Engine\Model;

class Utility extends Model {

	public function findSlugByName ($slug) {
		$query = $this->db->query ("
			SELECT query 
			FROM {$this->db->prefix}route 
			WHERE slug = '" . $this->db->escape($slug) . "'
		");
		
		if ($query->num_rows)
			return $query->row['query'];
		
	}
}
