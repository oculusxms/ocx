<?php

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Template extends LibraryService {
	public  $data = array();
	private $path;
	
	public function __construct(Container $app, $directory = '') {
		parent::__construct($app);

		if ($directory):
			$this->path = $directory;
		else:
			$this->path = $app['theme']->path . 'view/';
		endif;
	}

	public function fetch($filename, $mail = true) {
		$file = $this->path . $filename . '.tpl';

		if (is_readable($file)):
			extract($this->data);
			ob_start();
			include($file);
			$content = ob_get_clean();
			
			if ($mail)
				return $this->wrap($content);
			else
				return $content;
		else:
			trigger_error('Error: Could not load template ' . $file . '!');		
		endif;
	}

	public function wrap($template) {
		$file = parent::$app['theme']->path . 'view/mail/template.tpl';

		$data = parent::$app['language']->load('mail/template');
		$data['content'] = $template;

		if (is_readable($file)):
			extract($data);
			ob_start();
			include($file);
			$content = ob_get_clean();
			return $content;
		else:
			trigger_error('Error: Could not load main mail template ' . $file . '!');		
		endif;
	}
}