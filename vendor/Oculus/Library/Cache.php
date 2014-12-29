<?php

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Cache extends LibraryService {
	private $cache;

	public function __construct($cache, Container $app) {
		$this->cache = $cache;
	}

	public function get($key) {
		return $this->cache->get($key);
	}

	public function set($key, $value) {
		return $this->cache->set($key, $value);
	}

	public function delete($key) {
		return $this->cache->delete($key);
	}
	
	public function flush_cache () {
		return $this->cache->flush_cache();
	}
}
