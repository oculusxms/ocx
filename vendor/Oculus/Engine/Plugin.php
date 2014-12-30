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
use Oculus\Engine\Controller;
use Oculus\Library\Db;
use Oculus\Service\PluginServiceModel;
use Oculus\Engine\FrontView;
use Oculus\Engine\View;

class Plugin extends Controller {
    private $plugins = array();
    private $controllers = array();
    private $files = array();
    private $hooks = array();
    private $events = array();
    private $locale;
    protected $app;
    protected $directory;
    protected $plugin_name;
    
    public function __construct(Container $app) {
        parent::__construct($app);
        
        $this->locale = $app['active.fascade'] . '/';
        
        /**
         * We need to manage the path for plugins since
         * our ADMIN_FASCADE may not be named "admin".
         * Plugin admin areas should always be named "admin".
         */
        if (($app['active.fascade'] === ADMIN_FASCADE) && (ADMIN_FASCADE !== 'admin')):
            $this->locale = str_replace($app['active.fascade'], 'admin', $this->locale);
        endif;
        
        $this->directory = $app['path.plugin'];
        
        $files = glob($this->directory . '*', GLOB_ONLYDIR);
        
        foreach ($files as $file):
            $this->plugins[] = $file;
        endforeach;
        
        unset($files);
        
        $files = glob($this->directory . '*/*/controller/*.php');
        
        foreach ($files as $key => $file):
            $path = str_replace($this->app['path.plugin'], '', rtrim($file, '.php'));
            $slugs = explode('/', $path);
            if ($slugs[0] !== end($slugs)):
                $this->controllers[] = $this->app['prefix.plugin'] . '/' . $slugs[0] . '/' . end($slugs);
            endif;
        endforeach;
        
        unset($files);
        
        $this->app = $app;
    }
    
    public function set($key, $value) {
        $this->app[$key] = $value;
    }
    
    public function setPlugin($plugin) {
        $this->plugin_name = $plugin;
    }
    
    public function install($plugin) {
        $class = 'Plugin\\' . $this->format($plugin) . '\Register';
        $controller = new $class($this->app);
        
        if (is_callable(array($controller, 'add'))):
            $controller->add();
        endif;
    }
    
    public function uninstall($plugin) {
        $class = 'Plugin\\' . $this->format($plugin) . '\Register';
        $controller = new $class($this->app);
        
        if (is_callable(array($controller, 'remove'))):
            $controller->remove();
        endif;
    }
    
    public function listen($class, $method, $data = array()) {
        return $this->app['hooks']->listen($class, $method, $data);
    }
    
    public function trigger($event, $data = array()) {
        return $this->app['events']->trigger($event, $data);
    }
    
    public function getPlugins() {
        return $this->plugins;
    }
    
    public function getControllers() {
        return $this->controllers;
    }
    
    private function format($file) {
        return ucfirst(str_replace('_', '', strtolower($file)));
    }
    
    public function model($model) {
        $items = $this->build_model($model);
        $key = $items['key'];
        
        if (!$this->app->offsetExists($key)):
            $class = $items['class'];
            
            $this->app[$key] = function ($app) use ($class) {
                return new $class($app);
            };
        endif;
    }
    
    public function language($plugin, $data = array()) {
        $_ = array();
        
        $language = $this->app['language'];
        $locale = $language->getDirectory();
        
        $plugin_locale = (isset($this->plugin_name)) ? $this->plugin_name : $plugin;
        
        $lang = $language->fetch();
        
        if (!empty($data)):
            $lang = array_merge($lang, $data);
        endif;
        
        $file = $this->directory . $plugin_locale . '/' . $this->locale . 'language/' . $locale . '/' . $plugin . '.php';
        
        if (is_readable($file)):
            require ($file);
        endif;
        
        foreach ($_ as $key => $value):
            $language->set($key, $value);
        endforeach;
        
        return array_merge($lang, $_);
    }
    
    public function view($template, $data = array()) {
        $dir = $this->directory . $this->plugin_name . '/' . $this->locale;
        $view = new View($dir);
        
        return $view->render($template, $data);
    }
    
    private function build_model($model) {
        $data = array();
        $data['key'] = 'model_' . str_replace('/', '_', $model);
        
        $parts = explode('/', $model);
        $path = '';
        
        foreach ($parts as $part):
            $path.= ucfirst(str_replace('_', '', $part)) . '/';
        endforeach;
        
        $path = str_replace('/', '\\', rtrim($path, '/'));
        
        if (is_readable($this->directory . $this->plugin_name . '/' . $this->locale . 'model/' . $model . '.php')):
            $class = 'Plugin\\' . ucfirst($this->plugin_name) . $this->app['prefix.fascade'] . 'Model\\' . $path;
        else:
            return $this->app['theme']->model($model);
        endif;
        
        $data['class'] = $class;
        
        return $data;
    }
}
