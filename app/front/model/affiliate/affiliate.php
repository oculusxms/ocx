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

namespace Front\Model\Affiliate;
use Oculus\Engine\Model;
use Oculus\Library\Mail;
use Oculus\Library\Template;

class Affiliate extends Model {
    public function addAffiliate($data) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}affiliate 
			SET 
				firstname = '" . $this->db->escape($data['firstname']) . "', 
				lastname = '" . $this->db->escape($data['lastname']) . "', 
				email = '" . $this->db->escape($data['email']) . "', 
				telephone = '" . $this->db->escape($data['telephone']) . "', 
				salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', 
				password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', 
				company = '" . $this->db->escape($data['company']) . "', 
				address_1 = '" . $this->db->escape($data['address_1']) . "', 
				address_2 = '" . $this->db->escape($data['address_2']) . "', 
				city = '" . $this->db->escape($data['city']) . "', 
				postcode = '" . $this->db->escape($data['postcode']) . "', 
				country_id = '" . (int)$data['country_id'] . "', 
				zone_id = '" . (int)$data['zone_id'] . "', 
				code = '" . $this->db->escape(uniqid()) . "', 
				commission = '" . (float)$this->config->get('config_commission') . "', 
				tax = '" . $this->db->escape($data['tax']) . "', 
				payment = '" . $this->db->escape($data['payment']) . "', 
				`check` = '" . $this->db->escape($data['check']) . "', 
				paypal = '" . $this->db->escape($data['paypal']) . "', 
				bank_name = '" . $this->db->escape($data['bank_name']) . "', 
				bank_branch_number = '" . $this->db->escape($data['bank_branch_number']) . "', 
				bank_swift_code = '" . $this->db->escape($data['bank_swift_code']) . "', 
				bank_account_name = '" . $this->db->escape($data['bank_account_name']) . "', 
				bank_account_number = '" . $this->db->escape($data['bank_account_number']) . "', 
				status = '1', 
				date_added = NOW()
		");
        
        $affiliate_id = $this->db->getLastId();
        
        $this->language->load('mail/affiliate');

        // NEW MAILER
        // public_affiliate_register
        // public_affiliate_admin
        
        // $subject = sprintf($this->language->get('lang_text_subject'), $this->config->get('config_name'));
        
        // $message = sprintf($this->language->get('lang_text_welcome'), $this->config->get('config_name')) . "\n\n";
        // $message.= $this->language->get('lang_text_approval') . "\n";
        // $message.= $this->url->link('affiliate/login', '', 'SSL') . "\n\n";
        // $message.= $this->language->get('lang_text_services') . "\n";
        
        // $text = sprintf($this->language->get('lang_email_template'), $message);

        // $template = new Template($this->app);
        // $template->data = $this->theme->language('mail/affiliate');
        // $template->data['title'] = sprintf($this->language->get('lang_text_welcome'), $this->config->get('config_name'));
        // $template->data['url_affiliate_login'] = $this->url->link('affiliate/login', '', 'SSL');

        // $html = $template->fetch('mail/affiliate_register');

        // $this->mailer->build(
        // 	html_entity_decode($subject, ENT_QUOTES, 'UTF-8'),
        // 	$this->request->post['email'],
        // 	$data['firstname'] . ' ' . $data['lastname'],
        // 	html_entity_decode($text, ENT_QUOTES, 'UTF-8'),
        // 	$html,
        // 	true
        // );

        // unset($message);
        // unset($text);
        // unset($html);

        // $subject = sprintf($this->language->get('lang_text_admin_subject'), $this->config->get('config_name'));

        // $message  = sprintf($this->language->get('lang_text_admin_welcome'), $data['firstname'] . ' ' . $data['lastname']) . "\n\n";
        // $message .= $this->language->get('lang_text_admin_services') . "\n";
        // $message .= $this->app['https.server'] . ADMIN_FASCADE . "\n";

        // $text = sprintf($this->language->get('lang_email_template'), $message);

        // $template->data['title'] = sprintf($this->language->get('lang_text_admin_welcome'), $data['firstname'] . ' ' . $data['lastname']);
        // $template->data['text_services'] = $this->language->get('lang_text_admin_services');
        // $template->data['admin_login'] = $this->app['https.server'] . ADMIN_FASCADE;

        // $html = $template->fetch('mail/affiliate_register_admin');

        // $this->mailer->build(
        // 	html_entity_decode($subject, ENT_QUOTES, 'UTF-8'),
        // 	$this->config->get('config_admin_email'),
        // 	$this->config->get('config_owner'),
        // 	html_entity_decode($text, ENT_QUOTES, 'UTF-8'),
        // 	$html,
        // 	true
        // );
        
        $this->theme->trigger('front_affiliate_add', array('affiliate_id' => $affiliate_id));
    }
    
    public function editAffiliate($data) {
        $this->db->query("
			UPDATE {$this->db->prefix}affiliate 
			SET 
				firstname = '" . $this->db->escape($data['firstname']) . "', 
				lastname = '" . $this->db->escape($data['lastname']) . "', 
				email = '" . $this->db->escape($data['email']) . "', 
				telephone = '" . $this->db->escape($data['telephone']) . "', 
				company = '" . $this->db->escape($data['company']) . "', 
				address_1 = '" . $this->db->escape($data['address_1']) . "', 
				address_2 = '" . $this->db->escape($data['address_2']) . "', 
				city = '" . $this->db->escape($data['city']) . "', 
				postcode = '" . $this->db->escape($data['postcode']) . "', 
				country_id = '" . (int)$data['country_id'] . "', 
				zone_id = '" . (int)$data['zone_id'] . "' 
				WHERE affiliate_id = '" . (int)$this->affiliate->getId() . "'
		");
        
        $this->theme->trigger('front_affiliate_edit', array('affiliate_id' => $this->affiliate->getId()));
    }
    
    public function editPayment($data) {
        $this->db->query("
			UPDATE {$this->db->prefix}affiliate 
			SET 
				tax = '" . $this->db->escape($data['tax']) . "', 
				payment = '" . $this->db->escape($data['payment']) . "', 
				`check` = '" . $this->db->escape($data['check']) . "', 
				paypal = '" . $this->db->escape($data['paypal']) . "', 
				bank_name = '" . $this->db->escape($data['bank_name']) . "', 
				bank_branch_number = '" . $this->db->escape($data['bank_branch_number']) . "', 
				bank_swift_code = '" . $this->db->escape($data['bank_swift_code']) . "', 
				bank_account_name = '" . $this->db->escape($data['bank_account_name']) . "', 
				bank_account_number = '" . $this->db->escape($data['bank_account_number']) . "' 
			WHERE affiliate_id = '" . (int)$this->affiliate->getId() . "'
		");
        
        $this->theme->trigger('front_affiliate_edit_payment', array('affiliate_id' => $this->affiliate->getId()));
    }
    
    public function editPassword($email, $password) {
        $this->db->query("
			UPDATE {$this->db->prefix}affiliate 
			SET 
				salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', 
				password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "' 
			WHERE LOWER(email) = '" . $this->db->escape($this->encode->strtolower($email)) . "'
		");
        
        $this->theme->trigger('front_affiliate_edit_password', array('affiliate_id' => $this->affiliate->getId()));
    }
    
    public function getAffiliate($affiliate_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}affiliate 
			WHERE affiliate_id = '" . (int)$affiliate_id . "'
		");
        
        return $query->row;
    }
    
    public function getAffiliateByEmail($email) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}affiliate 
			WHERE LOWER(email) = '" . $this->db->escape($this->encode->strtolower($email)) . "'
		");
        
        return $query->row;
    }
    
    public function getAffiliateByCode($code) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}affiliate 
			WHERE code = '" . $this->db->escape($code) . "'
		");
        
        return $query->row;
    }
    
    public function getTotalAffiliatesByEmail($email) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}affiliate 
			WHERE LOWER(email) = '" . $this->db->escape($this->encode->strtolower($email)) . "'
		");
        
        return $query->row['total'];
    }
}
