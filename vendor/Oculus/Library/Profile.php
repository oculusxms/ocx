<?php

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Profile extends LibraryService {


	public function __construct(Container $app) {
		parent::__construct($app);

	}
}
