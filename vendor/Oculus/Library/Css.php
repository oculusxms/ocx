<?php

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Css extends LibraryService {
	
	private $registered  = array();
	private $queued 	 = array();
	private $complete 	 = array();
	private $last_file;
	private $directory;
	public  $cache_key;
	
	public function __construct(Container $app) {
		parent::__construct($app);

		$this->directory = $app['path.asset'] . $app['theme.name'] . '/css/';
	}
	
	public function register($name, $dep = NULL, $last = false) {
		if ((array_key_exists($dep, $this->registered) || !isset($dep)) && !$last):
			if (is_readable($this->directory . $name . '.css')):
				$this->registered[basename($name)] = array(
					'file' => $name . '.css',
				);
			endif;
		elseif ($last):
				$this->last_file = $name;
		else:
			if (is_readable($this->directory . $name . '.css')):
				$this->queued[] = array(
					'name' => $name,
					'file' => $name . '.css',
					'dep'  => $dep,
					'last' => $last
				);
			endif;
		endif;
		
		$this->collate();
		
		return $this;
	}
	
	private function collate() {
		if (!empty($this->queued)):
			foreach ($this->queued as $key => $script):
				if (array_key_exists($script['dep'], $this->registered)):
					$this->registered[basename($script['name'])] = array(
						'file' => $script['file']
					);
					unset($this->queued[$key]);
				endif;
			endforeach;	
		endif;
	}
	
	public function compile() {
		$cache 	 = parent::$app['filecache'];
		
		$this->collate();
		unset($this->queued);
		
		if (isset($this->last_file)):
			$this->registered[$this->last_file] = array('file' => $this->last_file . '.css');
			unset($this->last_file);
		endif;
		
		foreach($this->registered as $style):
			$this->complete[] = $style['file'];
		endforeach;

		$prefix = parent::$app['active.fascade'];
		$key 	= 'css.' . $prefix . '.' . md5 (str_replace('.css', '', implode('|', $this->complete)));
		
		$this->cache_key = md5($key);

		$cachefile = $cache->get($this->cache_key);
		
		if (is_bool($cachefile) or !parent::$app['config_cache_status']):
			$cached = '';

			foreach($this->complete as $file):
				$cached .= file_get_contents ($this->directory . $file);
			endforeach;

			$cachefile = $cached;
			$cache->set($this->cache_key, $cachefile);
		endif;
		
		unset($this->registered);
		unset($this->complete);
		
		return $this->cache_key;
	}
	
	public function reset() {
		$this->registered = array();
		$this->queued 	  = array();
		$this->complete   = array();
		$this->last_file  = '';	
	}
}
