<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|	
|	(c) Vince Kronlein <vince@ocx.io>
|	
|	For the full copyright and license information, please view the LICENSE
|	file that was distributed with this source code.
|	
*/

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
    
    public function flush_cache() {
        return $this->cache->flush_cache();
    }
}
