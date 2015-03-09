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

class Email extends LibraryService {

	public function __construct(Container $app) {
		parent::__construct($app);
	}

	public function fetch($name) {
		$data = array();

		$db = parent::$app['db'];

		$query = $db->query("
			SELECT 
				ec.subject AS subject, 
				ec.text AS text, 
				ec.html AS html 
			FROM {$db->prefix}email_content ec 
			LEFT JOIN {$db->prefix}email e 
			ON (e.email_id = ec.email_id) 
			WHERE e.email_slug = '" . $db->escape($name) . "' 
			AND language_id = '" . (int)parent::$app['config_language_id'] . "'
		");

		$data['subject'] = html_entity_decode($query->row['subject'], ENT_QUOTES, 'UTF-8');
		$data['text']    = html_entity_decode($query->row['text'], ENT_QUOTES, 'UTF-8');
		$data['html']    = html_entity_decode($query->row['html'], ENT_QUOTES, 'UTF-8');

		return $data;
	}

	public function public_waitlist_join() {

	}

	public function public_customer_order_confirm() {

	}

	public function public_admin_order_confirm() {

	}

	public function public_customer_order_update() {

	}

	public function public_affiliate_forgotten() {

	}

	public function public_contact_admin() {

	}

	public function public_contact_customer() {

	}

	public function public_register_customer() {

	}

	public function public_register_admin() {

	}

	public function public_affiliate_register() {

	}

	public function public_affiliate_admin() {

	}

	public function public_voucher_confirm() {

	}

	public function admin_forgotten_email() {

	}

	public function admin_people_contact() {

	}

	public function admin_event_add(){

	}

	public function admin_event_waitlist() {

	}

	public function admin_affiliate_add_transaction() {

	}

	public function admin_affiliate_approve() {

	}

	public function admin_customer_approve() {

	}

	public function admin_customer_add_transaction() {

	}

	public function admin_customer_add_reward() {

	}

	public function admin_order_add_history() {

	}

	public function admin_return_add_history() {

	}

	public function admin_voucher_order_send() {

	}

	public function admin_voucher_no_order_send() {

	}
}
