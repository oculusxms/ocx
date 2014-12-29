<?php

namespace Oculus\Engine;

use Oculus\Engine\Container;
use Oculus\Engine\Action;
use Oculus\Service\ActionService;
use Oculus\Engine\Front;
use Oculus\Engine\Plugin;
use Oculus\Service\PluginServiceModel;
use Oculus\Engine\Theme;
use Oculus\Driver\Cache\Apc;
use Oculus\Driver\Cache\Asset;
use Oculus\Driver\Cache\File;
use Oculus\Driver\Cache\Mem;
use Oculus\Driver\Database\Dbmmsql;
use Oculus\Driver\Database\Dbmpdo;
use Oculus\Driver\Database\Dbmysqli;
use Oculus\Driver\Database\Dbpostgre;
use Oculus\Library\Affiliate;
use Oculus\Library\Breadcrumb;
use Oculus\Library\Cache;
use Oculus\Library\Cart;
use Oculus\Library\Config;
use Oculus\Library\Css;
use Oculus\Library\Currency;
use Oculus\Library\Customer;
use Oculus\Library\Db;
use Oculus\Library\Encryption;
use Oculus\Library\Error;
use Oculus\Library\Event;
use Oculus\Library\Hook;
use Oculus\Library\Javascript;
use Oculus\Library\Language;
use Oculus\Library\Length;
use Oculus\Library\Log;
use Oculus\Library\Pagination;
use Oculus\Library\Request;
use Oculus\Library\Response;
use Oculus\Library\Routes;
use Oculus\Library\Session;
use Oculus\Library\Tax;
use Oculus\Library\Url;
use Oculus\Library\User;
use Oculus\Library\Weight;

class Application {

	public function __construct() {
		$this->data = new Container;
	}

	public function buildConfigRequest(array $config) {
		$configuration = array();

		foreach ($config['base'] as $key => $value):
			$configuration[$key] = $value;
		endforeach;

		unset($config['base']);

		/**
		 * Let's detect our app fascade according to our request variables;
		 * We need to hard set a route for this $request so we can pass it
		 * to our IoC Request object. 
		 */
		$request = new Request($this->data);
		$route 	 = null;
		$face 	 = FRONT_FASCADE;
		//var_dump($request);exit;
		if (isset($request->get['_route_'])):
			$paths = explode('/', $request->get['_route_']);
			
			/**
			 * The only fascade that should never exist in $paths
			 * is 'front', so our fascade should be easy to detect.
			 */
			if (array_key_exists($paths[0], $config)):
				$face = $paths[0];
				/**
				 * Set route with the alias removed
				 */
				array_shift($paths);
				
				if (!empty($paths)):
					if ($face === FRONT_FASCADE):
						$route = implode('/', $paths);
					else:
						$route = null;
					endif;
				endif;
			else:
				$route = $request->get['_route_'];
			endif;
		endif;
		
		// Add fascade to config
		$configuration['active.fascade'] = $face;
		
		/**
		 * Let's adjust the request to adhere to our fascade.
		 */

		$request->server['SCRIPT_NAME'] = str_replace(PUBLIC_DIR, '', $request->server['SCRIPT_NAME']);
		$request->server['PHP_SELF'] 	= str_replace(PUBLIC_DIR, '', $request->server['PHP_SELF']);
		
		if (!$route):
			unset($request->get['_route_']);
			unset($request->request['_route_']);
			unset($request->server['REDIRECT_QUERY_STRING']);
			$request->server['QUERY_STRING'] = '';
			$request->server['REQUEST_URI'] = '/';
		else:
			$request->get['_route_'] = $route;
			$request->request['_route_'] = $route;
			$request->server['REDIRECT_QUERY_STRING'] = '_route_=' . $route;
			$request->server['QUERY_STRING'] = '_route_=' . $route;
			$request->server['REQUEST_URI'] = '/' . $route;
		endif;

		/**
		 * Let's find and remove our pre-render controllers for this fascade.
		 * Instead of settings those via the loop below, we'll remove them
		 * and give them a specific parameter name so we can accurately
		 * access them in our Theme class.
		 */

		if (is_array($config[$face]['pre_render'])):
			$this->data['pre.controllers'] = $config[$face]['pre_render'];
			unset($config[$face]['pre_render']);
		endif;

		/**
		 * Let's find and remove our pre-actions for this fascade.
		 * Instead of settings those via the loop below, we'll remove them
		 * and give them a specific parameter name so we can accurately
		 * access them in our Front class.
		 */
		
		if (is_array($config[$face]['pre_actions'])):
			$this->data['pre.actions'] = $config[$face]['pre_actions'];
			unset($config[$face]['pre_actions']);
		endif;

		/**
		 * Let's find and remove our custom routes for the front fascade.
		 * Instead of settings those via the loop below, we'll remove them
		 * and give them a specific parameter name so we can accurately
		 * access them in our Routes class.
		 */
		
		if (is_array($config[FRONT_FASCADE]['custom.routes'])):
			$this->data['custom.routes'] = $config[FRONT_FASCADE]['custom.routes'];
			unset($config[FRONT_FASCADE]['custom.routes']);
		endif;

		/**
		 * Add remaining config to configuration array
		 */
		
		foreach ($config[$face] as $key => $value):
			$configuration[$key] = $value;
		endforeach;

		unset($config);

		$this->data['request'] = function($data) use ($request) {
			return $request;
		};

		unset($request);

		$this->buildDatabase();

		/**
		 * Our configuration array now contains all of our base
		 * config settings and fascade specific settings.
		 * Let's pass it to the buildSettings method and add our
		 * database configs and then push it to our session.
		 */
		$this->buildSettings($configuration);
	}

	protected function buildSettings ($configuration) {
		/**
		 * We'll alias all of our config settings with 'config_' and
		 * set them along with our fascade params into the container
		 * as parameters, then we'll add them to the session on the
		 * front fascade so they don't need to be queried again.
		 */
		
		$db = $this->data['db'];
		
		if ($configuration['active.fascade'] === FRONT_FASCADE):
			if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))):
				$store_query = $db->query("
					SELECT * 
					FROM {$db->prefix}store 
					WHERE 
						REPLACE(`ssl`, 'www.', '') = '" 
							. $db->escape('https://' 
							. str_replace('www.', '', $_SERVER['HTTP_HOST']) 
							. rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'
				");
				
				if ($store_query->num_rows):
					$configuration['config_store_id'] = $store_query->row['store_id'];
					$configuration['config_url'] 	  = $store_query->row['url'];
					$configuration['config_ssl'] 	  = $store_query->row['ssl'];
				else:
					$configuration['config_store_id'] = 0;
					$configuration['config_url'] = $configuration['http.server'];
					$configuration['config_ssl'] = $configuration['https.server'];
				endif;

				$image_url = $configuration['https.server'] . 'image/';
				
			else:
				$store_query = $db->query("
					SELECT * 
					FROM {$db->prefix}store 
					WHERE 
						REPLACE(`url`, 'www.', '') = '" 
							. $db->escape('http://' 
							. str_replace('www.', '', $_SERVER['HTTP_HOST']) 
							. rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'
				");

				if ($store_query->num_rows):
					$configuration['config_store_id'] = $store_query->row['store_id'];
					$configuration['config_url'] 	  = $store_query->row['url'];
					$configuration['config_ssl'] 	  = $store_query->row['ssl'];
				else:
					$configuration['config_store_id'] = 0;
					$configuration['config_url'] = $configuration['http.server'];
					$configuration['config_ssl'] = $configuration['https.server'];
				endif;
				
				$image_url = $configuration['http.server'] . 'image/';
				
			endif;

			define('IMAGE_URL', $image_url);
			
		else:
			$configuration['config_store_id'] = 0;
			$configuration['config_url'] = $configuration['http.server'];
			$configuration['config_ssl'] = $configuration['https.server'];

			define('IMAGE_URL', $configuration['config_url'] . 'image/');
		endif;

		$query = $db->query("
			SELECT * 
			FROM {$db->prefix}setting 
			WHERE store_id = '0' 
			OR store_id = '" . (int)$configuration['config_store_id'] . "' 
			ORDER BY store_id ASC
		");

		$settings = $query->rows;

		foreach ($settings as $setting):
			if (!$setting['serialized']):
				$configuration[$setting['key']] = $setting['value'];
			else:
				$configuration[$setting['key']] = unserialize($setting['value']);
			endif;
		endforeach;

		$this->data['config'] =  function ($data) use ($configuration) {
			/**
			 * Our Config object is just a wrapper for config settings.
			 */
			$config = new Config;

			foreach ($configuration as $key => $value):
				$config->set($key, $value);
			endforeach;

			return $config;
		};

		/**
		 * Now we have all of our settings, let's add them to the container.
		 */
		
		foreach ($configuration as $key => $value):
			$this->data[$key] = $value;
		endforeach;

		$this->setClasses($configuration['active.fascade']);
	}

	protected function buildDatabase() {
		$this->data['db'] = function ($data) {	
			$driver = 'Oculus\Driver\Database\\' . DB_DRIVER;
			return new Db(new $driver(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PREFIX), $data);
		};
	}

	protected function setClasses ($fascade) {
		$this->baseClasses();

		switch ($fascade):
			case INSTALL_FASCADE:
				$this->installClasses();
				break;
			case ADMIN_FASCADE:
				$this->adminClasses();
				break;
			case FRONT_FASCADE:
				$this->frontClasses();
				break;
		endswitch;

		/**
		 * Now that all our classes are built fire up our theme 
		 * and get it ready to be rendered.
		 */
		$this->buildTheme();
	}

	protected function baseClasses() {
		// cache
		$this->data['cache'] = function ($data) {
			switch ($data['config_cache_type_id']):
				case 'apc':
					$driver = new Apc($data['cache.time'], $data);
					break;
				case 'mem':
					$driver = new Mem($data['cache.time'], $data);
					$driver->connect();
					break;
				case 'file':
				default:
					$driver = new File($data['cache.time'], $data);
					break;
			endswitch;

			return new Cache($driver, $data);
		};
		
		// url
		$this->data['url'] = function ($data) {
			$url 	= $data['config_url'];
			$secure = $data['config_secure'];
			$ssl 	= $data['config_ssl'];

			return new Url($url, $secure ? $ssl : $url, $data);	
		};

		// log
		$this->data['log'] = function ($data) {
			return new Log($data['config_error_filename'], $data['path.logs'], $data);
		};
		
		// response
		$this->data['response'] = function ($data) {
			$response = new Response($data);
			$response->addHeader('Content-Type: text/html; charset=utf-8');
			$response->setCompression($data['config_compression']);

			return $response;
		};
		
		// session
		$session = new Session($this->data);
		$this->data['session'] = function ($data) use ($session) {
			switch($data['active.fascade']):
				case ADMIN_FASCADE:
					$session->admin_session();
					break;
				case FRONT_FASCADE:
					$session->front_session();
					break;
			endswitch;

			return $session;
		};

		// language
		$key = 'default.store.language';
		$languages = $this->data['cache']->get($key);

		if (!$languages):
			$languages = array();

			$query = $this->data['db']->query("
				SELECT * 
				FROM `{$this->data['db']->prefix}language` 
				WHERE status = '1'
			"); 

			foreach ($query->rows as $result):
				$languages[$result['code']] = $result;
			endforeach;

			$this->data['cache']->set($key, $languages);
		endif;
		unset($key);

		$detect = '';

		if (isset($this->data['request']->server['HTTP_ACCEPT_LANGUAGE']) && $this->data['request']->server['HTTP_ACCEPT_LANGUAGE']):
			$browser_languages = explode(',', $this->data['request']->server['HTTP_ACCEPT_LANGUAGE']);
			
			foreach ($browser_languages as $browser_language):
				foreach ($languages as $key => $value):
					if ($value['status']):
						$locale = explode(',', $value['locale']);

						if (in_array($browser_language, $locale)):
							$detect = $key;
						endif;
					endif;
				endforeach;
			endforeach;
		endif;

		if (isset($this->data['session']->data['language']) && array_key_exists($this->data['session']->data['language'], $languages) 
			&& $languages[$this->data['session']->data['language']]['status']):
			$code = $this->data['session']->data['language'];
		elseif (isset($this->data['request']->cookie['language']) && array_key_exists($this->data['request']->cookie['language'], $languages) 
			&& $languages[$this->data['request']->cookie['language']]['status']):
			$code = $this->data['request']->cookie['language'];
		elseif ($detect):
			$code = $detect;
		else:
			$code = $this->data['config_language'];
		endif;

		if (!isset($this->data['session']->data['language']) || $this->data['session']->data['language'] != $code):
			$this->data['session']->data['language'] = $code;
		endif;

		if (!isset($this->data['request']->cookie['language']) || $this->data['request']->cookie['language'] != $code):  
			setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $this->data['request']->server['HTTP_HOST']);
		endif;

		$this->data['config_language_id'] = $languages[$code]['language_id'];
		$this->data['config_language'] 	  = $languages[$code]['code'];

		$this->data['config']->set('config_language_id', $languages[$code]['language_id']);

		$language = new Language($languages[$code]['directory'], $this->data['path.language'], $this->data);
		$language->load($languages[$code]['filename']);	

		$this->data['language'] = function ($data) use ($language) {
			return $language;
		};

		// currency
		$this->data['currency'] = function ($data) {
			return new Currency($data);
		};
		
		// weight
		$this->data['weight'] = function ($data) {
			return new Weight($data);
		};
		
		// length
		$this->data['length'] = function ($data) {
			return new Length($data);
		};
		
		// breadcrumb
		$this->data['breadcrumb'] = function ($data) {
			return new Breadcrumb($data);
		};
		
		// file cache
		$this->data['filecache'] = function ($data) {
			return new Cache(new Asset(31536000, $data), $data); // 1 year in seconds to match htaccess rules
		};
	}

	protected function installClasses() {
		// assemble only the classes needed for upgrade.
	}

	protected function adminClasses() {
		// Image Upload Url for Summernote Editor
		if ($this->data['config_secure']):
			$img_url = $this->data['https.public'] . 'image/data/'; 
		else:
			$img_url = $this->data['http.public']  . 'image/data/';
		endif;

		define('PUBLIC_IMAGE', $img_url);
		// END
		
		$store_id = ($this->data['config_store_id']) ?: 0;
		
		$this->data['user'] = function($data) {
			return new User($data);
		};	
	}

	protected function frontClasses() {
		// Image Upload Url for Summernote Editor
		if ($this->data['config_secure']):
			$img_url = $this->data['https.server'] . 'image/'; 
		else:
			$img_url = $this->data['http.server']  . 'image/';
		endif;

		define('PUBLIC_IMAGE', $img_url);
		// END
		
		// customer
		$this->data['customer'] = function ($data) {
			return new Customer($data);
		};

		// affiliate
		$this->data['affiliate'] = function ($data) {
			return new Affiliate($data);
		};

		// tracking cookie --- this will change
		if (isset($this->data['request']->get['tracking'])):
			setcookie('tracking', $this->data['request']->get['tracking'], time() + 3600 * 24 * 1000, '/');
		endif;

		/**
		 * Routing is cached in the Routes class so we should call it
		 * every time before we set it to the container so that we
		 * can add the actual routes as a parameter;
		 */
		$routing = new Routes($this->data);

		$this->data['routing'] = function ($data) use ($routing) {
			return $routing;
		};

		// tax
		$this->data['tax'] = function ($data) {
			return new Tax($data);
		};

		// cart
		$this->data['cart'] = function ($data) {
			return new Cart($data);
		};

		// encryption
		$this->data['encryption'] = function ($data) {
			return new Encryption($data['config_encryption'], $data);
		};
	}

	/**
	 * Our theme is the central piece of our datalication where
	 * everything comes together.
	 * 
	 * Here we determine all our actual controllers that are
	 * needed so we can keep our Action and Theme class tidy.
	 */
	protected function buildTheme() {
		/**
		 * Grab our theme name by active.fascade
		 */
		switch($this->data['active.fascade']):
			case FRONT_FASCADE:
				$theme_name = $this->data['config_theme'];
				break;
			case ADMIN_FASCADE:
				$theme_name = $this->data['config_admin_theme'];
				break;
			case INSTALL_FASCADE:
				$theme_name = 'install';
				break;
		endswitch;

		// Set to container
		$this->data['theme.name'] = $theme_name;

		$prefix  = $this->data['prefix.fascade'];

		// Javascript
		$this->data['javascript'] = function ($data) {
			return new Javascript($data);
		};

		// CSS
		$this->data['css'] = function ($data) {
			return new Css($data);
		};

		// Pagination
		$this->data['paginate'] = function ($data) {
			return new Pagination($data);
		};

		// theme
		$this->data['theme'] = function ($data) {
			return new Theme($data);
		};

		// events
		$this->data['events'] = function ($data) {
			return new Event($data, new PluginServiceModel($data));
		};

		$this->data['hooks'] = function ($data) {
			return new Hook($data, new PluginServiceModel($data));
		};

		// plugin
		$this->data['plugin'] = function ($data) {
			return new Plugin($data);
		};

		$this->buildAction();
	}

	protected function buildAction() {
		/**
		 * Let's work through routing items that we need and set them 
		 * to the container before we fire up the service. 
		 */
		
		$this->data['errorhandler'] = function ($data) {
			return new Error($data);
		};

		set_error_handler(array($this->data['errorhandler'], 'error_handler'));
		
		$controller = new Front($this->data);

		switch ($this->data['active.fascade']):
			case FRONT_FASCADE:
				$error   		= new Action(new ActionService($this->data, 'error/notfound'));
				$type 	 		= $this->data['config_site_style'] . '/home';
				$default_action = new Action(new ActionService($this->data, $type));
				break;
			case ADMIN_FASCADE:
				$error   		= new Action(new ActionService($this->data, 'error/notfound'));
				$default_action = new Action(new ActionService($this->data, 'common/dashboard'));
				break;
		endswitch;
		
		if (isset($this->data['request']->get['route'])):
			$action = new Action(new ActionService($this->data, $this->data['request']->get['route']));
		else:
			$action = $default_action;
		endif;
		
		$controller->dispatch($action, $error);

		$this->data['front'] = function ($data) use ($controller) {
			return $controller;
		};
	}

	public function fire() {
		$this->data['front']->output();
	}
}
