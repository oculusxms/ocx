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
|--------------------------------------------------------------------------
|   Swiftmailer Wrapper
|--------------------------------------------------------------------------
|
|   This class is a simple PHP wrapper for Swiftmailer.
*/

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;
use Swift_MailTransport;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class Mail extends LibraryService {

	private $mailer;
	private $message;

	public function __construct(Container $app) {
		parent::__construct($app);

		/**
		 * Our application will build a new instance
		 * of this mailer in the baseClasses() method
		 * then all pieces of an email can be passed
		 * to the build method, and sent immediately.
		 */
		
		if ($app['config_mail_protocol'] === 'mail'):
			$transport = Swift_MailTransport::newInstance();
		else:
			$transport = Swift_SmtpTransport::newInstance($app['config_smtp_host'], $app['config_smtp_port'])
				->setUsername($app['config_smtp_username'])
				->setPassword($app['config_smtp_password']);
		endif;

		$this->mailer = Swift_Mailer::newInstance($transport);
	}

	public function build($subject, $email, $name, $html, $text) {
		$message = Swift_Message::newInstance();
		$message->setFrom(array($app['config_email'] => $app['config_name']));

		// customer/function specific details
		$message->setSubject($subject);
		$message->setTo(array($email => $name));
		$message->setBody($html);
		$message->addPart($text, 'text/plain');

		$this->message = $message;
	}

	public function send() {
		$this->mailer->send($this->message);
		unset($this->message);
	}
}
