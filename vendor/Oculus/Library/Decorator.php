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

	public function decorate($data, $customer_id, $order_id = 0) {
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
			'!store_url!'
		);

		// Customer variables
		// Store variables are already set in our app container
		
		$customer = $this->getCustomer($customer_id);
		
		$replace = array(
			$customer['fname'],
			$customer['lname'],
			$customer['username'],
			$customer['email'],
			$customer['telephone'],
			$customer['ip_address'],
			$customer['points'],
			parent::$app['config_name'],
			parent::$app['config_owner'],
			parent::$app['config_address'],
			parent::$app['config_telephone'],
			parent::$app['config_email'],
			parent::$app['config_admin_email'],
			parent::$app['config_url']
		);

		/**
		 * If we have an order ID, let's process it and push
		 * our variables to our search and replace arrays.
		 */
		
		if ($order_id > 0):
			$order = $this->getOrder($order_id);


		endif;

		return str_replace($search, $replace, $data);
	}

	protected function getCustomer($customer_id) {
		$db = parent::$app['db'];

		$customer = array();

		$query = $db->query("
			SELECT DISTINCT * 
			FROM {$db->prefix}customer 
			WHERE customer_id = '" . (int)$customer_id . "'
		");

		$customer['fname']      = $query->row['firstname'];
		$customer['lname']      = $query->row['lastname'];
		$customer['username']   = $query->row['username'];
		$customer['email']      = $query->row['email'];
		$customer['telephone']  = $query->row['telephone'];
		$customer['ip_address'] = $query->row['ip'];

		// points
		$query = $db->query("
            SELECT SUM(points) AS total 
            FROM {$db->prefix}customer_reward 
            WHERE customer_id = '" . (int)$customer_id . "'
        ");
        
        $customer['points'] = $query->row['total'] ? $query->row['total'] : 0;

        return $customer;
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
 */

