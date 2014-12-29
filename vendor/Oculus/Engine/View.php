<?php

namespace Oculus\Engine;

class View {
	private $directory;
	private $file;
	private $data;
	
	public function __construct($directory) {
		$this->setDirectory($directory);
	}
	
	public function render($template, $data = array()) {
		$this->data = $data;
		$this->file = $this->directory . 'view/' . $template . '.tpl';
		
		return $this->output();
	}
	
	public function setDirectory($directory) {
		$this->directory = $directory;
	}
	
	private function output() {
		if (is_readable($this->file)):
			extract($this->data);
			ob_start();
			require_once $this->file;
			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;
		else:
			trigger_error('Error: Could not load template ' . $this->file . '!');
		endif;	
	}
}
