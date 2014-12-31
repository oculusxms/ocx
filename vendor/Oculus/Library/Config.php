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

class Config {
    private $data = array();
    
    public function get($key) {
        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }
    
    public function set($key, $value) {
        $this->data[$key] = $value;
    }
    
    public function has($key) {
        return isset($this->data[$key]);
    }
}
