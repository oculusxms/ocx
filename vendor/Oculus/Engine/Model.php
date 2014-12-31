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

namespace Oculus\Engine;
use Oculus\Engine\Container;

abstract class Model {
    
    protected $app;
    
    public function __construct(Container $app) {
        $this->app = $app;
    }
    
    public function __get($key) {
        return $this->app[$key];
    }
    
    public function __set($key, $value) {
        $this->app[$key] = $value;
    }
}
