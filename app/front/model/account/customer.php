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

namespace Front\Model\Account;
use Oculus\Engine\Model;
use Oculus\Library\Mail;
use Oculus\Library\Template;

class Customer extends Model {
    public function addCustomer($data) {
        if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
            $customer_group_id = $data['customer_group_id'];
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }
        
        $this->theme->model('account/customergroup');
        
        $customer_group_info = $this->model_account_customergroup->getCustomerGroup($customer_group_id);
        
        $this->db->query("
			INSERT INTO {$this->db->prefix}customer 
			SET 
				store_id = '" . (int)$this->config->get('config_store_id') . "', 
				username = '" . $this->db->escape($data['username']) . "', 
				email = '" . $this->db->escape($data['email']) . "', 
				salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', 
				password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', 
				customer_group_id = '" . (int)$customer_group_id . "', 
				ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', 
				status = '1', 
				approved = '" . (int)!$customer_group_info['approval'] . "', 
				date_added = NOW()
		");
        
        $customer_id = $this->db->getLastId();
        
        $this->db->query("
			INSERT INTO {$this->db->prefix}address 
			SET 
				customer_id = '" . (int)$customer_id . "'
		");
        
        $address_id = $this->db->getLastId();
        
        $this->db->query("
			UPDATE {$this->db->prefix}customer 
			SET address_id = '" . (int)$address_id . "' 
			WHERE customer_id = '" . (int)$customer_id . "'
		");
        
        $lang = $this->language->load('mail/customer');

        // NEW MAILER
        // public_register_customer
        
        // $template = new Template($this->app);
        // $template->data = $lang;
        
        // $template->data['username'] = $data['username'];
        // $template->data['title'] = sprintf($this->language->get('lang_text_welcome'), $this->config->get('config_name'));
        // $template->data['account_login'] = $this->url->link('account/login', '', 'SSL');
        // $template->data['email'] = $data['email'];
        
        // if (!$customer_group_info['approval']) {
        //     $template->data['customer_text'] = $this->language->get('lang_text_login');
        // } else {
        //     $template->data['customer_text'] = $this->language->get('lang_text_approval');
        // }
        
        // $html = $template->fetch('mail/customer_register');
        
        // $subject = sprintf($this->language->get('lang_text_subject'), $this->config->get('config_name'));
        
        // $message = sprintf($this->language->get('lang_text_welcome'), $this->config->get('config_name')) . "\n\n";
        
        // if (!$customer_group_info['approval']) {
        //     $message.= $this->language->get('lang_text_login') . "\n";
        // } else {
        //     $message.= $this->language->get('lang_text_approval') . "\n";
        // }
        
        // $message.= $this->url->link('account/login', '', 'SSL') . "\n\n";
        // $message.= $this->language->get('lang_text_services') . "\n\n";
        // $message.= $this->language->get('lang_text_thanks') . "\n";
        // $message.= $this->config->get('config_name');
        
        
        // $this->mailer->build(
        //     html_entity_decode($subject, ENT_QUOTES, 'UTF-8'), 
        //     $data['email'], 
        //     $data['username'], 
        //     html_entity_decode($message, ENT_QUOTES, 'UTF-8'), 
        //     $html
        // );
        
        // $this->mailer->send();

        // Send to main admin email if new account email is enabled
        if ($this->config->get('config_account_mail')) {
            // NEW MAILER
            // public_register_admin

            // $message = $this->language->get('lang_text_signup') . "\n\n";
            // $message.= $this->language->get('lang_text_website') . ' ' . $this->config->get('config_name') . "\n";
            // $message.= $this->language->get('lang_text_username') . ' ' . $data['username'] . "\n";
            // $message.= $this->language->get('lang_text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
            
            // $message.= $this->language->get('lang_text_email') . ' ' . $data['email'] . "\n";
            
            // $template->data['title'] = $this->language->get('lang_text_signup');
            
            // if ($customer_group_info['approval']) {
            //     $template->data['text_approve'] = $this->language->get('lang_text_approve');
            //     $template->data['account_approve'] = $this->app['https.server'] . ADMIN_FASCADE . '/index.php?route=sale/customer&filter_approved=0';
            //     $subject = "ADMIN APPROVAL - " . html_entity_decode($this->language->get('lang_text_new_customer'), ENT_QUOTES, 'UTF-8');
            // } else {
            //     $subject = "ADMIN - " . html_entity_decode($this->language->get('lang_text_new_customer'), ENT_QUOTES, 'UTF-8');
            // }
            
            // $html = $template->fetch('mail/customer_register_admin');
            
            // $this->mailer->build(
            //     $subject,
            //     $this->config->get('config_email'),
            //     $this->config->get('config_name'),
            //     html_entity_decode($message, ENT_QUOTES, 'UTF-8'),
            //     $html,
            //     true
            // );

            // Send to additional alert emails if new account email is enabled
            $emails = explode(',', $this->config->get('config_alert_emails'));
            
            foreach ($emails as $email) {
                if (strlen($email) > 0 && preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email)) {
                    // public_register_admin

                    // $this->mailer->build(
                    //     $subject,
                    //     $email,
                    //     $this->config->get('config_name'),
                    //     html_entity_decode($message, ENT_QUOTES, 'UTF-8'),
                    //     $html,
                    //     true
                    // );
                }
            }
        }
        
        $this->theme->trigger('front_add_customer', array('customer_id' => $customer_id));
    }
    
    public function editCustomer($data) {
        $this->db->query("
			UPDATE {$this->db->prefix}customer 
			SET 
				firstname = '" . $this->db->escape($data['firstname']) . "', 
				lastname = '" . $this->db->escape($data['lastname']) . "', 
				email = '" . $this->db->escape($data['email']) . "', 
				telephone = '" . $this->db->escape($data['telephone']) . "' 
			WHERE customer_id = '" . (int)$this->customer->getId() . "'
		");
        
        $this->theme->trigger('front_edit_customer', array('customer_id' => $customer_id));
    }
    
    public function editPassword($email, $password) {
        $this->db->query("
			UPDATE {$this->db->prefix}customer 
			SET 
				salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', 
				password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "' 
			WHERE LOWER(email) = '" . $this->db->escape($this->encode->strtolower($email)) . "'
		");
        
        $this->theme->trigger('front_customer_edit_password', array('customer_id' => $this->customer->getId()));
    }
    
    public function editNewsletter($newsletter) {
        $this->db->query("
			UPDATE {$this->db->prefix}customer 
			SET newsletter = '" . (int)$newsletter . "' 
			WHERE customer_id = '" . (int)$this->customer->getId() . "'
		");
        
        $this->theme->trigger('front_customer_edit_newsletter', array('customer_id' => $this->customer->getId()));
    }
    
    public function getCustomer($customer_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}customer 
			WHERE customer_id = '" . (int)$customer_id . "'
		");
        
        return $query->row;
    }
    
    public function getCustomerByEmail($email) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}customer 
			WHERE LOWER(email) = '" . $this->db->escape($this->encode->strtolower($email)) . "'
		");
        
        return $query->row;
    }
    
    public function getCustomerByToken($token) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}customer 
			WHERE token = '" . $this->db->escape($token) . "' 
			AND token != ''
		");
        
        $this->db->query("
			UPDATE {$this->db->prefix}customer 
			SET token = ''");
        
        return $query->row;
    }
    
    public function getCustomers($data = array()) {
        $sql = "
			SELECT *, 
			CONCAT(c.firstname, ' ', c.lastname) AS name, 
			cg.name AS customer_group 
			FROM {$this->db->prefix}customer c 
			LEFT JOIN {$this->db->prefix}customer_group cg 
				ON (c.customer_group_id = cg.customer_group_id) 
		";
        
        $implode = array();
        
        if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
            $implode[] = "LCASE(CONCAT(c.firstname, ' ', c.lastname)) LIKE '" . $this->db->escape($this->encode->strtolower($data['filter_name'])) . "%'";
        }
        
        if (isset($data['filter_email']) && !is_null($data['filter_email'])) {
            $implode[] = "LCASE(c.email) = '" . $this->db->escape($this->encode->strtolower($data['filter_email'])) . "'";
        }
        
        if (isset($data['filter_customer_group_id']) && !is_null($data['filter_customer_group_id'])) {
            $implode[] = "cg.customer_group_id = '" . $this->db->escape($data['filter_customer_group_id']) . "'";
        }
        
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
        }
        
        if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
            $implode[] = "c.approved = '" . (int)$data['filter_approved'] . "'";
        }
        
        if (isset($data['filter_ip']) && !is_null($data['filter_ip'])) {
            $implode[] = "c.customer_id IN (SELECT customer_id FROM {$this->db->prefix}customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
        }
        
        if (isset($data['filter_date_added']) && !is_null($data['filter_date_added'])) {
            $implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }
        
        if ($implode) {
            $imp = implode(" && ", $implode);
            $sql.= " WHERE {$imp}";
        }
        
        $sort_data = array('name', 'c.email', 'customer_group', 'c.status', 'c.ip', 'c.date_added');
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql.= " ORDER BY {$data['sort']}";
        } else {
            $sql.= " ORDER BY name";
        }
        
        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql.= " DESC";
        } else {
            $sql.= " ASC";
        }
        
        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }
            
            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }
            
            $sql.= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        
        $query = $this->db->query($sql);
        
        return $query->rows;
    }
    
    public function getTotalCustomersByEmail($email) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer 
			WHERE LOWER(email) = '" . $this->db->escape($this->encode->strtolower($email)) . "'
		");
        
        return $query->row['total'];
    }
    
    public function getTotalCustomersByUsername($username) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer 
			WHERE LOWER(username) = '" . $this->db->escape($this->encode->strtolower($username)) . "'
		");
        
        return $query->row['total'];
    }
    
    public function getIps($customer_id) {
        $query = $this->db->query("
			SELECT * 
			FROM `{$this->db->prefix}customer_ip` 
			WHERE customer_id = '" . (int)$customer_id . "'
		");
        
        return $query->rows;
    }
    
    public function isBanIp($ip) {
        $query = $this->db->query("
			SELECT * 
			FROM `{$this->db->prefix}customer_ban_ip` 
			WHERE ip = '" . $this->db->escape($ip) . "'
		");
        
        return $query->num_rows;
    }
}
