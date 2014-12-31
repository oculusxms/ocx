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
use Oculus\Service\PluginServiceModel;

class Event extends LibraryService {
    
    private $events = array();
    
    public function __construct(Container $app, PluginServiceModel $model) {
        parent::__construct($app);
        
        $this->model = $model;
        $this->registerEvents();
    }
    
    public function registerEvents() {
        $events = $this->model->getEventHandlers();
        
        foreach ($events as $event):
            $handlers = unserialize($event['handlers']);
            
            foreach ($handlers as $handler):
                if (!array_key_exists($event['event'], $this->events)):
                    $this->events[$event['event']] = array();
                endif;
                
                if (is_string($handler)):
                    $this->events[$event['event']][] = $handler;
                endif;
            endforeach;
        endforeach;
        
        parent::$app['plugin_events'] = $this->events;
    }
    
    /**
     * TODO
     */
    public function unregisterEvents() {
    }
    
    public function trigger($event, $data = array()) {
        if (!array_key_exists($event, $this->events)):
            return true;
        endif;
        
        foreach ($this->events[$event] as $handler):
            $parts = explode('/', $handler);
            $method = array_pop($parts);
            
            foreach ($parts as $key => $part):
                $parts[$key] = $this->format($part);
            endforeach;
            
            $path = implode('\\', $parts);
            
            $class = 'Plugin\\' . $path;
            $class = new $class(parent::$app);
            
            if (is_callable(array($class, $method))):
                return call_user_func_array(array($class, $method), $data);
            endif;
        endforeach;
        
        return true;
    }
    
    private function format($file) {
        return ucfirst(str_replace('_', '', strtolower($file)));
    }
}
