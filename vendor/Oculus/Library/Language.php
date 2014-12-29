<?php

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Language extends LibraryService {
	private $default = 'english';
	private $directory;
	private $data = array();
	private $base;

	public function __construct($directory = '', $base, Container $app) {
		parent::__construct($app);
		
		$this->directory = $directory;
		$this->base = $base;
	}

	public function get($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : $key);
	}
	
	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	public function load($filename) {
		$_ = array();

		/**
		 * We need to work out whether we have a base language file for our current
		 * fascade and theme.  If we do, we'll use this one, else we'll fallback
		 * to the default base file.
		 */
		
		switch(parent::$app['active.fascade']):
			case ADMIN_FASCADE:
				$language_dir = parent::$app['path.theme'] . parent::$app['config_admin_theme'] . '/language/';
				break;
			case FRONT_FASCADE:
				$language_dir = parent::$app['path.theme'] . parent::$app['config_theme'] . '/language/';
				break;
		endswitch;

		// grab our base file
		if (is_readable($file = $language_dir . $this->default . '/' . $filename . '.php')):
			require $file;
		else:
			require $this->base . $this->default . '/' . $filename . '.php';
		endif;

		/**
		 * We need to do the same for our requested individual language file. Use theme version
		 * first, then fallback to default. 
		 */

		if (is_readable($file = $language_dir . $this->directory . '/' . $filename . '.php')):
			require $file;
		else:
			require $this->base . $this->directory . '/' . $filename . '.php';
		endif;

		$this->data = array_merge($this->data, $_);
		
		return $this->data;
	}
	
	public function getDirectory() {
		return $this->directory;	
	}
	
	public function fetch() {
		return $this->data;	
	}
}