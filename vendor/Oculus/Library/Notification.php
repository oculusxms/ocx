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

/**
 * The goal of this class is to provide a single interface
 * to accomplish all notifications to a given customer
 * whether it be internal or email.
 *
 * This class requires the following objects from Container:
 * Mail
 * Customer
 * Textemailtemplate
 * Htmlemailtemplate
 * Db
 * 
 */

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Notification extends LibraryService {
	public function __construct(Container $app) {
		parent::__construct($app);
	}

	/**
	 * pass in notification type and customer
	 * @return boolean
	 */
	public function build($type, $customer_id) {

	}

	
}
