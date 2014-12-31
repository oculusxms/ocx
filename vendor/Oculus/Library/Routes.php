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

class Routes extends LibraryService {
    
    public function __construct(Container $app) {
        parent::__construct($app);
        
        $this->generate();
    }
    
    public function generate() {
        $db = parent::$app['db'];
        $cache = parent::$app['cache'];
        
        $key = 'default.store.routes';
        $cachefile = $cache->get($key);
        
        if (is_bool($cachefile)):
            $query = $db->query("
				SELECT * 
				FROM {$db->prefix}route 
				GROUP BY route, route_id
			");
            
            $routes = array();
            
            foreach ($query->rows as $route):
                if (!array_key_exists($route['route'], $routes)):
                    $routes[$route['route']][] = array('query' => $route['query'], 'slug' => $route['slug']);
                else:
                    $items = array('query' => $route['query'], 'slug' => $route['slug']);
                    
                    $routes[$route['route']][] = $items;
                endif;
            endforeach;
            
            $cachefile = $routes;
            $cache->set($key, $cachefile);
        endif;
        
        parent::$app['routes'] = $cachefile;
        parent::$app['custom_routes'] = $this->custom_routes();
    }
    
    public function custom_routes() {
        $routes = array();
        
        if (parent::$app->offsetExists('custom.routes')):
            $routes = parent::$app['custom.routes'];
        endif;
        
        return $routes;
    }
}
