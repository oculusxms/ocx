<?php

namespace Install\Model;
use Oculus\Engine\Model;
use Oculus\Driver\Database\Dbmmsql;
use Oculus\Driver\Database\Dbmpdo;
use Oculus\Driver\Database\Dbmysqli;
use Oculus\Driver\Database\Dbpostgre;
use Oculus\Library\Db;

class Install extends Model {
	public function database($data) {
		$driver = 'Oculus\Driver\Database\\' . 'Db' . $data['db_driver'];
		$db = new Db(new $driver($data['db_host'], $data['db_user'], $data['db_password'], $data['db_name'], $data['db_prefix']), $this->app);
				
		$file = $this->app['path.application'] . 'ocx.sql';
		
		if (!file_exists($file)):
			exit('Could not load sql file: ' . $file); 
		endif;
		
		$lines = file($file);
		
		if ($lines):
			$sql = '';
			foreach($lines as $line):
				if ($line && (substr($line, 0, 2) != '--') && (substr($line, 0, 1) != '#')):
					$sql .= $line;
					if (preg_match('/;\s*$/', $line)):
						$sql = str_replace("DROP TABLE IF EXISTS `ocx_", "DROP TABLE IF EXISTS `" . $data['db_prefix'], $sql);
						$sql = str_replace("CREATE TABLE `ocx_", "CREATE TABLE `" . $data['db_prefix'], $sql);
						$sql = str_replace("INSERT INTO `ocx_", "INSERT INTO `" . $data['db_prefix'], $sql);
						$db->query($sql);
						$sql = '';
					endif;
				endif;
			endforeach;
			
			$db->query("SET CHARACTER SET utf8");
			$db->query("SET @@session.sql_mode = 'MYSQL40'");
			$db->query("
				DELETE FROM {$data['db_prefix']}user 
				WHERE user_id = '1'
			");
		
			$db->query("
				INSERT INTO `" . $data['db_prefix'] . "user` 
				SET 
					user_id = '1', 
					user_group_id = '1', 
					username = '" . $db->escape($data['username']) . "', 
					salt = '" . $db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', 
					password = '" . $db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', 
					status = '1', 
					email = '" . $db->escape($data['email']) . "', 
					date_added = NOW()
			");

			$db->query("
				DELETE FROM {$data['db_prefix']}setting 
				WHERE `key` = 'config_email'
			");
			
			$db->query("
				INSERT INTO {$data['db_prefix']}setting 
				SET 
					`group` = 'config', 
					`key` = 'config_email', 
					value = '" . $db->escape($data['email']) . "'
			");
			
			// $db->query("
			// 	DELETE FROM `" . $data['db_prefix'] . "setting` 
			// 	WHERE `key` = 'config_url'
			// ");
			
			// $db->query("
			// 	INSERT INTO `" . $data['db_prefix'] . "setting` 
			// 	SET 
			// 		`group` = 'config', 
			// 		`key` = 'config_url', 
			// 		value = '" . $db->escape(HTTP_OCX) . "'
			// ");
			
			$db->query("
				DELETE FROM {$data['db_prefix']}setting 
				WHERE `key` = 'config_encryption'
			");
			
			$db->query("
				INSERT INTO {$data['db_prefix']}setting 
				SET 
					`group` = 'config', 
					`key` = 'config_encryption', 
					value = '" . $db->escape(md5(mt_rand())) . "'
			");
			
			$db->query("
				UPDATE {$data['db_prefix']}product 
				SET `viewed` = '0'
			");
			
		endif;		
	}	
}