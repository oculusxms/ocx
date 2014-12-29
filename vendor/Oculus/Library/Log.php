<?php

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Log extends LibraryService {
	private $filehandle;

	public function __construct($filename, $directory, Container $app) {
		parent::__construct($app);

		$file = $directory . $filename;
		$this->filehandle = fopen($file, 'a');
	}

	public function __destruct() {
		fclose($this->filehandle);
	}

	public function write($message) {
		fwrite($this->filehandle, date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n");
	}
}