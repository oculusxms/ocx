<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|	
|	(c) Vince Kronlein <vince@ocx.io>
|	
|	For the full copyright and license information, please view the LICENSE
|	file that was distributed with this source code.
|	
*/

namespace Front\Controller\Common;
use Oculus\Engine\Controller;

class Queue extends Controller {
	
	private $queued;

	public function index() {
		// /usr/bin/curl -s -L "http://dev.ocx.io/queue" > /dev/null
		$this->theme->model('tool/utility');

		// First let's delete all sent emails to ease the search query
		$this->model_tool_utility->pruneQueue();

		// Now we can just grab the first 50
		$emails = $this->model_tool_utility->getQueue();

		if ($emails):
			foreach($emails as $email):
				$this->queued[] = $email;
			endforeach;
		endif;

		$this->process();
	}

	private function process() {
		if ($this->queued):
			foreach ($this->queued as $email):
				$this->mailer->build($email['subject'], $email['email'], $email['name'], $email['text'], $email['html'], true);
				$this->model_tool_utility->updateQueue($email['queue_id']);
			endforeach;
		endif;
	}
}
