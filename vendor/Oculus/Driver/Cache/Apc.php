<?php

namespace Oculus\Driver\Cache;
use Oculus\Service\LibraryService;

class Apc extends LibraryService {
	private $expire;
	private $cache;

	public function __construct($expire, $app) {
		parent::__construct($app);
		
		$this->expire = $expire;
	}

	public function get($key) {
		if (!parent::$app['config_cache_status']):
			return false;
		endif;

		return apc_fetch(parent::$app['cache.prefix'] . $key);
	}

	public function set($key, $value) {
		if (!parent::$app['config_cache_status']):
			return false;
		endif;

		return apc_store(parent::$app['cache.prefix'] . $key, $value, $this->expire);
	}

	public function delete($key) {
		apc_delete(parent::$app['cache.prefix'] . $key);
	}
	
	public function flush_cache() {
		apc_clear_cache();
	}
	
	public function getExpire() {
		return $this->expire;	
	}
}
