<?php

namespace Oculus\Interfaces;
use Oculus\Engine\Container;

interface ActionServiceInterface {
	public function __construct(Container $app, $route, $args = array());
}