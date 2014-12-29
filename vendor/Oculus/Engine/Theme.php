<?php

namespace Oculus\Engine;
use Oculus\Engine\Container;
use Oculus\Engine\Action;
use Oculus\Service\ActionService;
use Oculus\Engine\View;

final class Theme {
	private $title;
	private $description;
	private $keywords;
	private $ogimage;
	private $ogtitle;
	private $ogsite;
	private $ogdescription;
	private $ogtype;
	private $ogurl;
	private $canonical;

	private $links 		 = array();
	private $controllers = array();
	
	public  $path;
	public  $name;
	public  $style;
	
	public function __construct(Container $app) {
		$this->app 	= $app;
		$this->path = $app['path.theme'] . $app['theme.name']  . '/';
		$this->name = ucfirst(basename($this->path));
		
		if ($app->offsetExists('config_site_style')):
			$this->style = $app['config_site_style'];
		endif;
		
		$this->build_controllers($app['pre.controllers']);
	}
	
	/*
	|--------------------------------------------------------------------------
	|	Controllers Section
	|--------------------------------------------------------------------------
	|
	|	This section manipulates and sets up all our controllers for the app
	|	to run. Use the {set/unset}_controller methods in your controller to add or
	|	remove controllers from the render.
	|
	*/
	public function set_controller($key, $file) {
		$this->controllers[$key] = $file;
	}
	
	public function unset_controller($key) {
		unset($this->controllers[$key]);
	}
	
	public function controller($route) {
		$args = func_get_args();
		array_shift($args);

		$action = new Action(new ActionService($this->app, $route, $args));
		
		return $action->execute($this->app);
	}

	public function render_controllers($data) {
		foreach($this->controllers as $key => $route):
			$data[$key] = $this->controller($route);
		endforeach;

		return $data;
	}
	
	public function model($model) {
		$items 	= $this->build_model($model);
		$key 	= $items['key'];
		
		if (!$this->app->offsetExists($key)):
			$class = $items['class'];

			$this->app[$key] = function($app) use ($class) {
				return new $class($app);
			};
		endif;
	}
	
	public function view($template, $data = array()) {
		$view = new View($this->path);
		return $view->render($template, $data);
	}
	
	public function loadjs($file, $data, $path = '') {
		$this->app['javascript']->load($file, $data, $path);	
	}

	public function listen($class, $method, $data = array()) {
		// First let's fire any plugin hooks so that
		// our theme isn't changing any data that the plugin
		// might need to remain unchanged.
		if ($this->app->offsetExists('plugin')):
			$data = $this->app['plugin']->listen($class, $method, $data);
		endif;		

		// Now let's push revised data to theme hooks.
		return $this->fire_theme_hooks($class, $method, $data);
	}

	/**
	 * This method allows devs to call hooks directly in
	 * theme controllers or models.
	 * @param  $route  route to controller file
	 * @param  $method method to execute
	 * @param  $data   controller data passed in
	 * @return $data   data array passed back from hook
	 */
	public function hook($route, $method, $data = array()) {
		$file 	 = 'theme/' . $this->app['active.fascade'] . '/' . $this->app['theme.name'] . '/controller/' . $route . '.php';
		$default = $this->app['active.fascade'] . '/controller/' . $route . '.php';

		if (is_readable($this->app['path.app_path'] . $file)):
			$file = $file;
		elseif (is_readable($this->app['path.app_path'] . $default)):
			$file = $default;
		else:
			return $data;
		endif;

		$class = $this->format_class($file);

		$hook = new $class($this->app);
					
		if (is_callable(array($hook, $method))):
			$data = call_user_func_array(array($hook, $method), array($data));
		endif;

		return $data;
	}

	public function trigger($event, $data = array()) {
		// First let's fire any plugin events so that
		// our theme isn't changing any data that the plugin
		// might need to remain unchanged.
		if ($this->app->offsetExists('plugin')):
			$data = $this->app['plugin']->trigger($event, $data);
		endif;

		// Now let's push our revised data to theme events.
		return $this->fire_theme_events($event, $data);
	}

	public function config($config) {
		$this->app['config']->load($config);
	}

	public function language($language, $data = array()) {
		$lang = $this->app['language']->load($language);
		
		if (!empty($data)):
			$lang = array_merge($data, $lang);
		endif;
		
		return $lang;
	}
	
	private function build_controllers($controllers) {
		foreach ($controllers as $key => $file):
			$this->controllers[$key] = $file;
		endforeach;	
	}

	/**
	 * Builds an array of files from both the theme and application directories
	 * based on the passed in directory and current theme.
	 * @param  string $directory [controller sub-directory to search]
	 * @return $files [the array of files built]            
	 */
	public function getFiles($directory = '*') {
		$filenames   = array();
		$files       = array();
		
		$core_files  = glob($this->app['path.application'] . 'controller/' . $directory . '/*.php');
		$theme_files = glob($this->path . 'controller/' . $directory . '/*.php');

		if (!empty($theme_files)):
			foreach($theme_files as $file):
				$file_data   = explode('/', dirname($file));
				$filename    = end($file_data) . '/' . basename($file, '.php');
				$filenames[] = $filename;
				$files[]     = $file;
			endforeach;
		endif;
		
		if (!empty($core_files)):
			foreach($core_files as $file):
				$file_data = explode('/', dirname($file));
				$filename  = end($file_data) . '/' . basename($file, '.php');
				if (!in_array($filename, $filenames)):
					$files[] = $file;
				endif;
			endforeach;
		endif;

		return $files;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}

	public function getKeywords() {
		return $this->keywords;
	}

	public function setOgImage($image) {
		$this->ogimage = $image;	
	}
	
	public function getOgImage() {
		return $this->ogimage;
	}
	
	public function setOgType($type) {
		$this->ogtype = $type;	
	}
	
	public function getOgType() {
		return $this->ogtype;
	}
	
	public function setOgSite($site) {
		$this->ogsite = $site;	
	}
	
	public function getOgSite() {
		return $this->ogsite;
	}
	
	public function setOgTitle($title) {
		$this->ogtitle = $title;	
	}
	
	public function getOgTitle() {
		return $this->ogtitle;
	}
	
	public function setOgUrl($url) {
		$this->ogurl = $url;	
	}
	
	public function getOgUrl() {
		return $this->ogurl;
	}
	
	public function setOgDescription($description) {
		$this->ogdescription = $this->rip_tags($description);	
	}
	
	public function getOgDescription() {
		return $this->ogdescription;
	}

	public function setCanonical($url) {
		$this->canonical = $url;	
	}
	
	public function getCanonical() {
		return $this->canonical;
	}

	public function addLink($href, $rel) {
		$this->links[$href] = array(
			'href' => $href,
			'rel'  => $rel
		);
	}

	public function getLinks() {
		return $this->links;
	}
	
	public function paginate($total, $page, $limit, $text, $url) {
		$paging = $this->app['paginate'];
		
		$paging->total 	= $total;
		$paging->page 	= $page;
		$paging->limit 	= $limit;
		$paging->text 	= $text;
		$paging->url 	= $url;
		
		return $paging->render();
	}

	private function build_model($model) {
		$data 		 = array();
		$data['key'] = 'model_' . str_replace('/', '_', $model);

		$parts = explode('/', $model);	
		$path  = '';

		foreach($parts as $part):
			$path .= ucfirst(str_replace('_', '', $part)) . '/';
		endforeach;
		
		$path = str_replace('/', '\\', rtrim($path, '/'));

		if (is_readable($this->path . 'model/' . $model . '.php')):
			$class = 'Theme\\' . $this->app['prefix.fascade'] . $this->name . '\Model\\' . $path;
		else:
			$class = $this->app['prefix.fascade'] . 'Model\\' . $path;
		endif;

		$data['class'] = $class;

		return $data;
	}

	private function fire_theme_hooks($class, $method, $data = array()) {
		// when building theme hooks ensure that your hook
		// passes back either the original or altered $data variable
		// otherwise the data from your controller will be lost.

		return $data;
	}

	public function fire_theme_events($event, $data = array()) {
		

		return $data;
	}

	private function format_class ($file) {
		$file  = rtrim($file, '.php');
		$paths = explode ('/', $file);
		$class = array();

		foreach ($paths as $path):
			$class[] = ucfirst($path);
		endforeach;

		return implode ('\\', $class);
	}

	private function rip_tags($string) { 
	
		// ----- remove HTML TAGs ----- 
		$string = preg_replace ('/<[^>]*>/', ' ', $string); 
		
		// ----- remove control characters ----- 
		$string = str_replace("\r", '', $string);    // --- replace with empty space
		$string = str_replace("\n", ' ', $string);   // --- replace with space
		$string = str_replace("\t", ' ', $string);   // --- replace with space
		
		// ----- remove multiple spaces ----- 
		$string = trim(preg_replace('/ {2,}/', ' ', $string));
		
		return $string; 
	
	}
	
	// Test pattern
	public function test($data, $quit = true) {
		echo "<pre>";
		print_r ($data);
		echo "</pre>";
		
		if ($quit):
			exit;
		endif;
	}
}
