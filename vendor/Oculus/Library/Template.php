<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|   
|   (c) Vince Kronlein <vince@ocx.io>
|   
|   For the full copyright and license information, please view the LICENSE
|   file that was distributed with this source code.
|   
*/

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Template extends LibraryService {
    public $data = array();
    private $path;
    
    public function __construct(Container $app, $directory = '') {
        parent::__construct($app);
        
        if ($directory):
            $this->path = $directory;
        else:
            $this->path = $app['theme']->path . 'view/';
        endif;
    }
    
    public function fetch($filename) {
        $file = $this->path . $filename . '.tpl';
        
        if (is_readable($file)):
            extract($this->data);
            ob_start();
            require $file;
            $content = ob_get_clean();
            
            return $content;
        else:
            trigger_error('Error: Could not load template ' . $file . '!');
        endif;
    }
}
