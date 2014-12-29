<?php

namespace Oculus\Engine;
use Oculus\Engine\Container;

abstract class Controller {
	
	protected $app;

	public function __construct(Container $app) {
		$this->app = $app;
	}

	public function get($key) {
		return $this->app[$key];
	}

	public function set($key, $value) {
		$this->app[$key] = $value;
	}	

	public function __get($key) {
		return $this->app[$key];
	}

	/**
	 * Use the $this->container[$key] = $value method
	 * to add any key/value parameters to the container.
	 */
	public function __set($key, $value) {
		$this->app[$key] = $value;
	}

	/**
	 * Use the $this->push($key, $class) method to create
	 * a new service on the container. $class to be the full
	 * namespace to the class to instantiate.
	 */
	public function push($key, $class) {
		$this->app[$key] = function($app) use ($class) {
			return new $class($app);
		};
	}
}
