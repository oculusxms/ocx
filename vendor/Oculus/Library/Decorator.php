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

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

/*
|--------------------------------------------------------------------------
|   Description
|--------------------------------------------------------------------------
|
|   The purpose of this class is to provide a single method to replace any 
|	variable that we may need in email and internal notifications.
*/

class Decorator extends LibraryService {
	public function __construct(Container $app) {
		parent::__construct($app);
	}

	public function decorateCustomerNotification($message, $customer, $order_id = 0) {
		$search = array(
			'!fname!',
			'!lname!',
			'!username!',
			'!email!',
			'!telephone!',
			'!ip_address!',
			'!points!',
			'!store_name!',
			'!store_owner!',
			'!store_address!',
			'!store_phone!',
			'!store_send_email!',
			'!store_admin_email!',
			'!store_url!',
			'!preference!',
			'!unsubscribe!',
			'!webversion!',
			'!twitter!',
			'!facebook!'
		);

		$replace = array(
			$customer['firstname'] ? $customer['firstname'] : $customer['username'],
			$customer['lastname'],
			$customer['username'],
			$customer['email'],
			isset($customer['telephone']) ? $customer['telephone'] : '',
			$customer['ip'],
			$customer['points'],
			parent::$app['config_name'],
			parent::$app['config_owner'],
			parent::$app['config_address'],
			parent::$app['config_telephone'],
			parent::$app['config_email'],
			parent::$app['config_admin_email'],
			trim(parent::$app['config_url'], '/'),
			parent::$app['config_url'] . 'account/notification/preferences',
			parent::$app['config_url'] . 'account/notification/unsubscribe',
			parent::$app['config_url'] . 'account/notification/webversion',
			'http://twitter.com/' . parent::$app['config_mail_twitter'],
			'http://www.facebook.com/' . parent::$app['config_mail_facebook']
		);

		$html_replace = array(
			$customer['firstname'] ? $customer['firstname'] : $customer['username'],
			$customer['lastname'],
			$customer['username'],
			$customer['email'],
			isset($customer['telephone']) ? $customer['telephone'] : '',
			$customer['ip'],
			$customer['points'],
			parent::$app['config_name'],
			parent::$app['config_owner'],
			nl2br(parent::$app['config_address']),
			parent::$app['config_telephone'],
			parent::$app['config_email'],
			parent::$app['config_admin_email'],
			trim(parent::$app['config_url'], '/'),
			parent::$app['config_url'] . 'account/notification/preferences',
			parent::$app['config_url'] . 'account/notification/unsubscribe',
			parent::$app['config_url'] . 'account/notification/webversion',
			'http://twitter.com/' . parent::$app['config_mail_twitter'],
			'http://www.facebook.com/' . parent::$app['config_mail_facebook']
		);

		/**
		 * If we have an order ID, let's process it and push
		 * our variables to our search and replace arrays.
		 */
		
		if ($order_id > 0):
			$order = $this->getOrder($order_id);


		endif;

		if (is_array($message)):
			foreach($message as $key => $value):
				if ($key == 'html'):
					$message[$key] = str_replace($search, $html_replace, $value);
				else:
					$message[$key] = str_replace($search, $replace, $value);
				endif;
			endforeach;
		else:
			$message = str_replace($search, $replace, $message);
		endif;
		
		return $message;
	}

	public function decorateUserNotification($message, $user) {

	}

	protected function getOrder($order_id) {
		
	}
}

/**
 * Customer Variables
 * 
 * !fname! - customer first name
 * !lname! - customer last name
 * !username! - customer username
 * !email! - customer email address
 * !points! - customer reward points
 * !telephone! - customer telephone
 * !ip_address! - customer IP address
 * 
 * Store Variables
 * !store_name! - config_name
 * !store_owner! - config_owner
 * !store_address! - config_address
 * !store_phone! - config_telephone
 * !store_send_email - config_email
 * !store_admin_email! - config_admin_email
 * !store_url! - config_url 
 * !twitter_url! - config_mail_twitter
 * !facebook_url! - config_mail_facebook
 */

