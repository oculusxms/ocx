<?php

namespace Oculus\Engine;
use Oculus\Engine\Container;

abstract class Model {
	
	protected $app;

	public function __construct(Container $app) {
		$this->app = $app;
	}

	public function __get($key) {
		return $this->app[$key];
	}

	public function __set($key, $value) {
		$this->app[$key] = $value;
	}
}
