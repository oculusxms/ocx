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

class Javascript extends LibraryService {
    
    private $registered = array();
    private $queued = array();
    private $complete = array();
    private $controllers = array();
    private $script_data = array();
    private $last_file;
    private $directory;
    private $script_directory;
    public $cache_key;
    
    public function __construct(Container $app) {
        parent::__construct($app);
        
        $this->directory = $app['path.asset'] . $app['theme.name'] . '/js/';
        $this->script_directory = $app['path.theme'] . $app['theme.name'] . '/view/';
    }
    
    public function register($name, $dep = null, $last = false) {
        if ((array_key_exists($dep, $this->registered) || !isset($dep)) && !$last):
            if (is_readable($this->directory . $name . '.js')):
                $this->registered[basename($name) ] = array('file' => $name . '.js',);
            endif;
        elseif ($last):
            $this->last_file = $name;
        else:
            if (is_readable($this->directory . $name . '.js')):
                $this->queued[] = array('name' => $name, 'file' => $name . '.js', 'dep' => $dep, 'last' => $last);
            endif;
        endif;
        
        $this->collate();
        
        return $this;
    }
    
    private function collate() {
        if (!empty($this->queued)):
            foreach ($this->queued as $key => $script):
                if (array_key_exists($script['dep'], $this->registered)):
                    $this->registered[basename($script['name']) ] = array('file' => $script['file']);
                    unset($this->queued[$key]);
                endif;
            endforeach;
        endif;
    }
    
    public function compile() {
        $cache = parent::$app['filecache'];
        
        $this->collate();
        unset($this->queued);
        
        if (isset($this->last_file)):
            $this->registered[$this->last_file] = array('file' => $this->last_file . '.js');
            unset($this->last_file);
        endif;
        
        foreach ($this->registered as $script):
            $this->complete[] = $script['file'];
        endforeach;
        
        $prefix = parent::$app['active.fascade'];
        $key = 'javascript.' . $prefix . '.' . md5(str_replace('.js', '', implode('|', $this->complete)));
        
        $this->cache_key = md5($key);
        
        $cachefile = $cache->get($this->cache_key);
        
        if (is_bool($cachefile) || !parent::$app['config_cache_status']):
            $cached = '';
            
            foreach ($this->complete as $file):
                $cached.= file_get_contents($this->directory . '/' . $file);
            endforeach;
            
            $cachefile = $cached;
            $cache->set($this->cache_key, $cachefile);
        endif;
        
        unset($this->registered);
        
        return $this->cache_key;
    }
    
    public function reset() {
        $this->registered = array();
        $this->queued = array();
        $this->complete = array();
        $this->last_file = '';
    }
    
    public function load($file, $data, $path = '') {
        $session = parent::$app['session'];
        
        $script_path = ($path) ? $path : $this->script_directory;
        
        if (!empty($this->script_data)):
            $this->script_data = array_merge($this->script_data, $data);
        else:
            $this->script_data = $data;
        endif;
        
        $this->controllers[] = $script_path . $file . '.js';
    }
    
    public function fetch() {
        return array('data' => $this->script_data, 'files' => $this->controllers);
    }
}
