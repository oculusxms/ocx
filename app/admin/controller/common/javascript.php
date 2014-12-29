<?php

namespace Admin\Controller\Common;
use Oculus\Engine\Controller;

class Javascript extends Controller {
	
	public function index() {
		$scripts = $this->javascript->fetch();
		$data    = $scripts['data'];

		$data['scripts'] = $scripts['files'];

		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		return $this->theme->view('common/javascript', $data);
	}
	
	public function runner() {
		$this->javascript->register('jquery.min', NULL)
			->register('migrate.min', 'jquery.min')
			->register('bootstrap.min', 'migrate.min')
			->register('datetimepicker.min', 'bootstrap.min')
			->register('typeahead.min', 'bootstrap.min')
			->register('editor/codemirror.min', 'bootstrap.min')
			->register('editor/xml-fold.min', 'codemirror.min')
			->register('editor/active-line.min', 'xml-fold.min')
			->register('editor/matchbrackets.min', 'active-line.min')
			->register('editor/closebrackets.min', 'matchbrackets.min')
			->register('editor/matchtags.min', 'closebrackets.min')
			->register('editor/closetag.min', 'matchtags.min')
			->register('editor/xml.min', 'closetag.min')
			->register('editor/javascript.min', 'xml.min')
			->register('editor/css.min', 'javascript.min')
			->register('editor/php.min', 'css.min')
			->register('editor/format.min', 'php.min')
			->register('editor/summernote.min', 'format.min')
			->register('common.min', NULL, true);
			
		$this->theme->listen(__CLASS__, __FUNCTION__);
	}
	
	public function render() {
		$key  = $this->request->get['js'];
		$file = $this->filecache->get($key);
		
		header('Content-Type: application/javascript');
		print_r($file);
	}
}