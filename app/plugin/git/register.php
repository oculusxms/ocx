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

namespace Plugin\Git;
use Oculus\Engine\Container;
use Oculus\Engine\Plugin;

class Register extends Plugin {
    public function __construct(Container $app) {
        parent::__construct($app);
        parent::setPlugin('git');
    }
}
