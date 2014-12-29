<?php

namespace Admin\Model\Setting;
use Oculus\Engine\Model;

class Module extends Model {
	public function getInstalled($type) {
		$module_data = array();

		$query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}module 
			WHERE `type` = '" . $this->db->escape($type) . "'
		");

		foreach ($query->rows as $result):
			$module_data[] = $result['code'];
		endforeach;

		return $module_data;
	}

	public function install($type, $code) {
		$this->db->query("
			INSERT INTO {$this->db->prefix}module 
			SET 
				`type` = '" . $this->db->escape($type) . "', 
				`code` = '" . $this->db->escape($code) . "'
		");
	}

	public function uninstall($type, $code) {
		$this->db->query("
			DELETE 
			FROM {$this->db->prefix}module 
			WHERE `type` = '" . $this->db->escape($type) . "' 
			AND `code` = '" . $this->db->escape($code) . "'
		");
	}

	public function sql($sql) {
		$query = '';

		foreach($lines as $line):
			if ($line && (substr($line, 0, 2) != '--') && (substr($line, 0, 1) != '#')):
				$query .= $line;

				if (preg_match('/;\s*$/', $line)):
					$query = str_replace("DROP TABLE IF EXISTS `ocx_", "DROP TABLE IF EXISTS `" . DB_PREFIX, $query);
					$query = str_replace("CREATE TABLE `ocx_", "CREATE TABLE `" . DB_PREFIX, $query);
					$query = str_replace("INSERT INTO `ocx_", "INSERT INTO `" . DB_PREFIX, $query);

					$result = mysql_query($query, $connection); 

					if (!$result):
						die(mysql_error());
					endif;

					$query = '';
				endif;
			endif;
		endforeach;		
	}
}