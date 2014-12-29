<?php

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Session extends LibraryService {
	
	public $data = array();

	public function __construct(Container $app) {
		parent::__construct($app);
	}

	public function admin_session() {
		if (!session_id()):
			ini_set('session.use_only_cookies', 'On');
			ini_set('session.use_trans_sid', 'Off');
			ini_set('session.cookie_httponly', 'On');
			ini_set('session.save_path', parent::$app['path.storage'] . 'session/admin/');

			session_set_cookie_params(0, '/manage');
			session_start();
		endif;

		$this->data =& $_SESSION;
	}

	public function front_session() {
		if (!session_id()):
			ini_set('session.use_only_cookies', 'On');
			ini_set('session.use_trans_sid', 'Off');
			ini_set('session.cookie_httponly', 'On');
			ini_set('session.save_path', parent::$app['path.storage'] . 'session/front/');

			session_set_cookie_params(0, '/');
			session_start();
		endif;

		$this->data =& $_SESSION;
	}

	function getId() {
		return session_id();
	}
}