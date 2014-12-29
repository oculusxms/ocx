<?php

namespace Oculus\Engine;
use Oculus\Engine\Container;
use Oculus\Interfaces\ActionServiceInterface;

final class Action {
	
	protected $file;
	protected $class;
	protected $method;
	protected $args = array();

	public function __construct(ActionServiceInterface $action) {
		$this->file 	= $action->get('file');
		$this->method 	= $action->get('method');
		$this->class 	= $action->get('class');
		$this->args 	= $action->get('args');
	}

	public function execute(Container $app) {
		if (substr($this->method, 0, 2) == '__'):
			return false;
		endif;
		
		$controller = new $this->class($app);
		
		if (is_callable(array($controller, $this->method))):
			return call_user_func_array(array($controller, $this->method), $this->args);
		else:
			return false;
		endif;
	}
}