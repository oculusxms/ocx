<?php

namespace Plugin\Git;
use Oculus\Engine\Container;
use Oculus\Engine\Plugin;

class Register extends Plugin {
	public function __construct(Container $app) {
		parent::__construct($app);
		parent::setPlugin('git');	
	}
}
