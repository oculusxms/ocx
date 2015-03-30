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

namespace Admin\Model\People;
use Oculus\Engine\Model;
use Oculus\Library\Mail as Mail;

class Customer extends Model {
    public function addCustomer($data) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}customer 
			SET 
                username            = '" . $this->db->escape($data['username']) . "', 
                firstname           = '" . $this->db->escape($data['firstname']) . "', 
                lastname            = '" . $this->db->escape($data['lastname']) . "', 
                email               = '" . $this->db->escape($data['email']) . "', 
                telephone           = '" . $this->db->escape($data['telephone']) . "', 
                newsletter          = '" . (int)$data['newsletter'] . "', 
                customer_group_id   = '" . (int)$data['customer_group_id'] . "', 
                salt                = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', 
                password            = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', 
                status              = '" . (int)$data['status'] . "', 
                date_added          = NOW()
		");
        
        $customer_id = $this->db->getLastId();
        
        if (isset($data['address'])):
            foreach ($data['address'] as $address):
                $this->db->query("
					INSERT INTO {$this->db->prefix}address 
					SET 
                        customer_id = '" . (int)$customer_id . "', 
                        firstname   = '" . $this->db->escape($address['firstname']) . "', 
                        lastname    = '" . $this->db->escape($address['lastname']) . "', 
                        company     = '" . $this->db->escape($address['company']) . "', 
                        company_id  = '" . $this->db->escape($address['company_id']) . "', 
                        tax_id      = '" . $this->db->escape($address['tax_id']) . "', 
                        address_1   = '" . $this->db->escape($address['address_1']) . "', 
                        address_2   = '" . $this->db->escape($address['address_2']) . "', 
                        city        = '" . $this->db->escape($address['city']) . "', 
                        postcode    = '" . $this->db->escape($address['postcode']) . "', 
                        country_id  = '" . (int)$address['country_id'] . "', 
                        zone_id     = '" . (int)$address['zone_id'] . "'
				");
                
                if (isset($address['default'])):
                    $address_id = $this->db->getLastId();
                    
                    $this->db->query("
						UPDATE {$this->db->prefix}customer 
						SET address_id = '" . $address_id . "' 
						WHERE customer_id = '" . (int)$customer_id . "'
					");
                endif;
            endforeach;
        endif;

        if (isset($data['affiliate'])):
            $affiliate = $data['affiliate'];

            $this->db->query("
                UPDATE {$this->db->prefix}customer 
                SET 
                    affiliate_status    = '" . (int)$affiliate['affiliate_status'] . "',
                    company             = '" . $this->db->escape($affiliate['company']) . "',
                    website             = '" . $this->db->escape($affiliate['website']) . "',
                    code                = '" . $this->db->escape($affiliate['code']) . "',
                    commission          = '" . (float)$affiliate['commission'] . "',
                    tax_id              = '" . $this->db->escape($affiliate['tax_id']) . "',
                    payment_method      = '" . $this->db->escape($affiliate['payment_method']) . "',
                    cheque              = '" . $this->db->escape($affiliate['cheque']) . "',
                    paypal              = '" . $this->db->escape($affiliate['paypal']) . "',
                    bank_name           = '" . $this->db->escape($affiliate['bank_name']) . "',
                    bank_branch_number  = '" . $this->db->escape($affiliate['bank_branch_number']) . "',
                    bank_swift_code     = '" . $this->db->escape($affiliate['bank_swift_code']) . "',
                    bank_account_name   = '" . $this->db->escape($affiliate['bank_account_name']) . "',
                    bank_account_number = '" . $this->db->escape($affiliate['bank_account_number']) . "' 
                WHERE customer_id = '" . (int)$customer_id . "'");
        endif;

        $this->theme->trigger('admin_add_customer', array('customer_id' => $customer_id));
    }
    
    public function editCustomer($customer_id, $data) {
        $this->db->query("
			UPDATE {$this->db->prefix}customer 
			SET 
                username            = '" . $this->db->escape($data['username']) . "', 
                firstname           = '" . $this->db->escape($data['firstname']) . "', 
                lastname            = '" . $this->db->escape($data['lastname']) . "', 
                email               = '" . $this->db->escape($data['email']) . "', 
                telephone           = '" . $this->db->escape($data['telephone']) . "', 
                newsletter          = '" . (int)$data['newsletter'] . "', 
                customer_group_id   = '" . (int)$data['customer_group_id'] . "', 
                status              = '" . (int)$data['status'] . "' 
			WHERE customer_id = '" . (int)$customer_id . "'
		");

        if (isset($data['affiliate'])):
            $affiliate = $data['affiliate'];

            $this->db->query("
                UPDATE {$this->db->prefix}customer 
                SET 
                    affiliate_status    = '" . (int)$affiliate['affiliate_status'] . "',
                    company             = '" . $this->db->escape($affiliate['company']) . "',
                    website             = '" . $this->db->escape($affiliate['website']) . "',
                    code                = '" . $this->db->escape($affiliate['code']) . "',
                    commission          = '" . (float)$affiliate['commission'] . "',
                    tax_id              = '" . $this->db->escape($affiliate['tax_id']) . "',
                    payment_method      = '" . $this->db->escape($affiliate['payment_method']) . "',
                    cheque              = '" . $this->db->escape($affiliate['cheque']) . "',
                    paypal              = '" . $this->db->escape($affiliate['paypal']) . "',
                    bank_name           = '" . $this->db->escape($affiliate['bank_name']) . "',
                    bank_branch_number  = '" . $this->db->escape($affiliate['bank_branch_number']) . "',
                    bank_swift_code     = '" . $this->db->escape($affiliate['bank_swift_code']) . "',
                    bank_account_name   = '" . $this->db->escape($affiliate['bank_account_name']) . "',
                    bank_account_number = '" . $this->db->escape($affiliate['bank_account_number']) . "' 
                WHERE customer_id = '" . (int)$customer_id . "'");
        endif;
        
        if ($data['password']):
            $this->db->query("
				UPDATE {$this->db->prefix}customer 
				SET 
					salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', 
					password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' 
				WHERE customer_id = '" . (int)$customer_id . "'
			");
        endif;
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}address 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        if (isset($data['address'])):
            foreach ($data['address'] as $address):
                $this->db->query("
					INSERT INTO {$this->db->prefix}address 
					SET 
                        address_id  = '" . (int)$address['address_id'] . "', 
                        customer_id = '" . (int)$customer_id . "', 
                        firstname   = '" . $this->db->escape($address['firstname']) . "', 
                        lastname    = '" . $this->db->escape($address['lastname']) . "', 
                        company     = '" . $this->db->escape($address['company']) . "', 
                        company_id  = '" . $this->db->escape($address['company_id']) . "', 
                        tax_id      = '" . $this->db->escape($address['tax_id']) . "', 
                        address_1   = '" . $this->db->escape($address['address_1']) . "', 
                        address_2   = '" . $this->db->escape($address['address_2']) . "', 
                        city        = '" . $this->db->escape($address['city']) . "', 
                        postcode    = '" . $this->db->escape($address['postcode']) . "', 
                        country_id  = '" . (int)$address['country_id'] . "', 
                        zone_id     = '" . (int)$address['zone_id'] . "'
				");
                
                if (isset($address['default'])):
                    $address_id = $this->db->getLastId();
                    
                    $this->db->query("
						UPDATE {$this->db->prefix}customer 
						SET address_id = '" . (int)$address_id . "' 
						WHERE customer_id = '" . (int)$customer_id . "'
					");
                endif;
            endforeach;
        endif;

        $this->theme->trigger('admin_edit_customer', array('customer_id' => $customer_id));
    }
    
    public function editToken($customer_id, $token) {
        $this->db->query("
			UPDATE {$this->db->prefix}customer 
			SET token = '" . $this->db->escape($token) . "' 
			WHERE customer_id = '" . (int)$customer_id . "'
		");
    }
    
    public function deleteCustomer($customer_id) {
        $this->db->query("
			DELETE FROM {$this->db->prefix}customer 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}customer_reward 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}customer_credit 
			WHERE customer_id = '" . (int)$customer_id . "'");

        $this->db->query("
            DELETE FROM {$this->db->prefix}customer_commission 
            WHERE customer_id = '" . (int)$customer_id . "'");
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}customer_ip 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}address 
			WHERE customer_id = '" . (int)$customer_id . "'");

        $this->db->query("
            DELETE FROM {$this->db->prefix}affiliate_route 
            WHERE query = 'affiliate_id:" . (int)$customer_id . "'");

        $this->theme->trigger('admin_delete_customer', array('customer_id' => $customer_id));
    }
    
    public function getCustomer($customer_id) {
        $query = $this->db->query("
			SELECT DISTINCT * 
			FROM {$this->db->prefix}customer 
			WHERE customer_id = '" . (int)$customer_id . "'
		");
        
        return $query->row;
    }
    
    public function getCustomerByEmail($username, $email) {
        $query = $this->db->query("
			SELECT DISTINCT * 
			FROM {$this->db->prefix}customer 
			WHERE (LCASE(email) = '" . $this->db->escape($this->encode->strtolower($email)) . "') 
			OR LCASE(username) = '" . $this->db->escape($this->encode->strtolower($username)) . "'");
        
        return $query->row;
    }
    
    public function getCustomers($data = array()) {
        $sql = "
			SELECT *, 
			CONCAT(c.firstname, ' ', c.lastname) AS name, 
			cgd.name AS customer_group 
			FROM {$this->db->prefix}customer c 
			LEFT JOIN {$this->db->prefix}customer_group_description cgd 
				ON (c.customer_group_id = cgd.customer_group_id) 
			WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'
		";
        
        $implode = array();
        
        if (!empty($data['filter_username'])):
            $implode[] = "c.username LIKE '" . $this->db->escape($data['filter_username']) . "%'";
        endif;
        
        if (!empty($data['filter_name'])):
            $implode[] = "CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        endif;
        
        if (!empty($data['filter_email'])):
            $implode[] = "c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
        endif;
        
        if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])):
            $implode[] = "c.newsletter = '" . (int)$data['filter_newsletter'] . "'";
        endif;
        
        if (!empty($data['filter_customer_group_id'])):
            $implode[] = "c.customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
        endif;
        
        if (!empty($data['filter_ip'])):
            $implode[] = "c.customer_id IN (SELECT customer_id FROM {$this->db->prefix}customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
        endif;
        
        if (isset($data['filter_status']) && !is_null($data['filter_status'])):
            $implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
        endif;

        if (isset($data['filter_affiliate']) && !is_null($data['filter_affiliate'])):
            $implode[] = "c.is_affiliate = '" . (int)$data['filter_affiliate'] . "'";
        endif;
        
        if (isset($data['filter_approved']) && !is_null($data['filter_approved'])):
            $implode[] = "c.approved = '" . (int)$data['filter_approved'] . "'";
        endif;
        
        if (!empty($data['filter_date_added'])):
            $implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        endif;
        
        if ($implode):
            $imp = implode(" && ", $implode);
            $sql.= " && {$imp}";
        endif;
        
        $sort_data = array(
            'c.username', 
            'name', 
            'c.email', 
            'customer_group', 
            'c.status',
            'c.is_affiliate', 
            'c.approved', 
            'c.ip', 
            'c.date_added'
        );
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)):
            $sql.= " ORDER BY {$data['sort']}";
        else:
            $sql.= " ORDER BY name";
        endif;
        
        if (isset($data['order']) && ($data['order'] == 'DESC')):
            $sql.= " DESC";
        else:
            $sql.= " ASC";
        endif;
        
        if (isset($data['start']) || isset($data['limit'])):
            if ($data['start'] < 0):
                $data['start'] = 0;
            endif;
            
            if ($data['limit'] < 1):
                $data['limit'] = 20;
            endif;
            
            $sql.= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        endif;
        
        $query = $this->db->query($sql);
        
        return $query->rows;
    }

    public function getAffiliateDetails($customer_id) {
        $details = array();

        $query = $this->db->query("
            SELECT 
                affiliate_status, 
                company, 
                website, 
                code, 
                commission, 
                tax_id, 
                payment_method, 
                cheque, 
                paypal, 
                bank_name, 
                bank_branch_number, 
                bank_swift_code, 
                bank_account_name,
                bank_account_number 
            FROM {$this->db->prefix}customer 
            WHERE customer_id = '" . (int)$customer_id . "' 
            AND is_affiliate = '1'
        ");

        return $query->row;
    }

    public function approve($customer_id) {
        $customer_info = $this->getCustomer($customer_id);
        
        if ($customer_info):
            $this->db->query("
				UPDATE {$this->db->prefix}customer 
				SET approved = '1' 
				WHERE customer_id = '" . (int)$customer_id . "'");
            
            $this->language->load('mail/customer');
            
            $this->theme->model('setting/store');
            
            $store_info = $this->model_setting_store->getStore($customer_info['store_id']);
            
            if ($store_info):
                $store_name = $store_info['name'];
                $store_url = $store_info['url'] . 'account/login';
            else:
                $store_name = $this->config->get('config_name');
                $store_url = $this->app['http.public'] . 'account/login';
            endif;

            // NEW MAILER
            // admin_customer_approve
            
            // $message = sprintf($this->language->get('lang_text_approve_welcome'), $store_name) . "\n\n";
            // $message.= $this->language->get('lang_text_approve_login') . "\n";
            // $message.= $store_url . "\n\n";
            // $message.= $this->language->get('lang_text_approve_services') . "\n\n";
            // $message.= $this->language->get('lang_text_approve_thanks') . "\n";
            // $message.= $store_name;
            
            // $mail = new Mail();
            // $mail->protocol = $this->config->get('config_mail_protocol');
            // $mail->parameter = $this->config->get('config_mail_parameter');
            // $mail->hostname = $this->config->get('config_smtp_host');
            // $mail->username = $this->config->get('config_smtp_username');
            // $mail->password = $this->config->get('config_smtp_password');
            // $mail->port = $this->config->get('config_smtp_port');
            // $mail->timeout = $this->config->get('config_smtp_timeout');
            // $mail->setTo($customer_info['email']);
            // $mail->setFrom($this->config->get('config_email'));
            // $mail->setSender($store_name);
            // $mail->setSubject(html_entity_decode(sprintf($this->language->get('lang_text_approve_subject'), $store_name), ENT_QUOTES, 'UTF-8'));
            // $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            // $mail->send();
            
            $this->theme->trigger('admin_approve_customer', array('customer_id' => $customer_id));
        endif;
    }
    
    public function getAddress($address_id) {
        $address_query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}address 
			WHERE address_id = '" . (int)$address_id . "'");
        
        if ($address_query->num_rows):
            $country_query = $this->db->query("
				SELECT * 
				FROM `{$this->db->prefix}country` 
				WHERE country_id = '" . (int)$address_query->row['country_id'] . "'");
            
            if ($country_query->num_rows):
                $country = $country_query->row['name'];
                $iso_code_2 = $country_query->row['iso_code_2'];
                $iso_code_3 = $country_query->row['iso_code_3'];
                $address_format = $country_query->row['address_format'];
            else:
                $country = '';
                $iso_code_2 = '';
                $iso_code_3 = '';
                $address_format = '';
            endif;
            
            $zone_query = $this->db->query("
				SELECT * 
				FROM `{$this->db->prefix}zone` 
				WHERE zone_id = '" . (int)$address_query->row['zone_id'] . "'");
            
            if ($zone_query->num_rows):
                $zone = $zone_query->row['name'];
                $zone_code = $zone_query->row['code'];
            else:
                $zone = '';
                $zone_code = '';
            endif;
            
            return array(
                'address_id'     => $address_query->row['address_id'], 
                'customer_id'    => $address_query->row['customer_id'], 
                'firstname'      => $address_query->row['firstname'], 
                'lastname'       => $address_query->row['lastname'], 
                'company'        => $address_query->row['company'], 
                'company_id'     => $address_query->row['company_id'], 
                'tax_id'         => $address_query->row['tax_id'], 
                'address_1'      => $address_query->row['address_1'], 
                'address_2'      => $address_query->row['address_2'], 
                'postcode'       => $address_query->row['postcode'], 
                'city'           => $address_query->row['city'], 
                'zone_id'        => $address_query->row['zone_id'], 
                'zone'           => $zone, 
                'zone_code'      => $zone_code, 
                'country_id'     => $address_query->row['country_id'], 
                'country'        => $country, 
                'iso_code_2'     => $iso_code_2, 
                'iso_code_3'     => $iso_code_3, 
                'address_format' => $address_format
            );
        endif;
    }
    
    public function getAddresses($customer_id) {
        $address_data = array();
        
        $query = $this->db->query("
			SELECT address_id 
			FROM {$this->db->prefix}address 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        foreach ($query->rows as $result):
            $address_info = $this->getAddress($result['address_id']);
            
            if ($address_info):
                $address_data[$result['address_id']] = $address_info;
            endif;
        endforeach;
        
        return $address_data;
    }
    
    public function getTotalCustomers($data = array()) {
        $sql = "
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}customer";
        
        $implode = array();
        
        if (!empty($data['filter_username'])):
            $implode[] = "username LIKE '" . $this->db->escape($data['filter_username']) . "%'";
        endif;
        
        if (!empty($data['filter_name'])):
            $implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        endif;
        
        if (!empty($data['filter_email'])):
            $implode[] = "email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
        endif;
        
        if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])):
            $implode[] = "newsletter = '" . (int)$data['filter_newsletter'] . "'";
        endif;
        
        if (!empty($data['filter_customer_group_id'])):
            $implode[] = "customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
        endif;
        
        if (!empty($data['filter_ip'])):
            $implode[] = "customer_id IN (SELECT customer_id FROM {$this->db->prefix}customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
        endif;
        
        if (isset($data['filter_status']) && !is_null($data['filter_status'])):
            $implode[] = "status = '" . (int)$data['filter_status'] . "'";
        endif;

         if (isset($data['filter_affiliate']) && !is_null($data['filter_affiliate'])):
            $implode[] = "is_affiliate = '" . (int)$data['filter_affiliate'] . "'";
        endif;

        if (isset($data['filter_approved']) && !is_null($data['filter_approved'])):
            $implode[] = "approved = '" . (int)$data['filter_approved'] . "'";
        endif;
        
        if (!empty($data['filter_date_added'])):
            $implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        endif;
        
        if ($implode):
            $imp = implode(" && ", $implode);
            $sql.= " WHERE {$imp}";
        endif;
        
        $query = $this->db->query($sql);
        
        return $query->row['total'];
    }
    
    public function getTotalCustomersAwaitingApproval() {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer 
			WHERE status = '0' 
			OR approved = '0'");
        
        return $query->row['total'];
    }
    
    public function getTotalAddressesByCustomerId($customer_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}address 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->row['total'];
    }
    
    public function getTotalAddressesByCountryId($country_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}address 
			WHERE country_id = '" . (int)$country_id . "'");
        
        return $query->row['total'];
    }
    
    public function getTotalAddressesByZoneId($zone_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}address 
			WHERE zone_id = '" . (int)$zone_id . "'");
        
        return $query->row['total'];
    }
    
    public function getTotalCustomersByCustomerGroupId($customer_group_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer 
			WHERE customer_group_id = '" . (int)$customer_group_id . "'");
        
        return $query->row['total'];
    }
    
    public function addHistory($customer_id, $comment) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}customer_history 
			SET 
				customer_id = '" . (int)$customer_id . "', 
				comment = '" . $this->db->escape(strip_tags($comment)) . "', 
				date_added = NOW()");

        $this->theme->trigger('admin_add_history', array('customer_id' => $customer_id));
    }
    
    public function getHistories($customer_id, $start = 0, $limit = 10) {
        if ($start < 0):
            $start = 0;
        endif;
        
        if ($limit < 1):
            $limit = 10;
        endif;
        
        $query = $this->db->query("
			SELECT comment, date_added 
			FROM {$this->db->prefix}customer_history 
			WHERE customer_id = '" . (int)$customer_id . "' 
			ORDER BY date_added 
			DESC LIMIT " . (int)$start . "," . (int)$limit);
        
        return $query->rows;
    }
    
    public function getTotalHistories($customer_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer_history 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->row['total'];
    }
    
    public function addCredit($customer_id, $description = '', $amount = '', $order_id = 0) {
        $customer_info = $this->getCustomer($customer_id);
        
        if ($customer_info):
            $this->db->query("
				INSERT INTO {$this->db->prefix}customer_credit 
				SET 
                    customer_id = '" . (int)$customer_id . "', 
                    order_id    = '" . (int)$order_id . "', 
                    description = '" . $this->db->escape($description) . "', 
                    amount      = '" . (float)$amount . "', 
                    date_added  = NOW()
            ");
            
            $this->language->load('mail/customer');
            
            if ($customer_info['store_id']):
                $this->theme->model('setting/store');
                
                $store_info = $this->model_setting_store->getStore($customer_info['store_id']);
                
                if ($store_info):
                    $store_name = $store_info['name'];
                else:
                    $store_name = $this->config->get('config_name');
                endif;
            else:
                $store_name = $this->config->get('config_name');
            endif;

            // NEW MAILER
            // admin_customer_add_credit
            
            // $message = sprintf($this->language->get('lang_text_credit_received'), $this->currency->format($amount, $this->config->get('config_currency'))) . "\n\n";
            // $message.= sprintf($this->language->get('lang_text_credit_total'), $this->currency->format($this->getCreditTotal($customer_id)));
            
            // $mail = new Mail();
            // $mail->protocol = $this->config->get('config_mail_protocol');
            // $mail->parameter = $this->config->get('config_mail_parameter');
            // $mail->hostname = $this->config->get('config_smtp_host');
            // $mail->username = $this->config->get('config_smtp_username');
            // $mail->password = $this->config->get('config_smtp_password');
            // $mail->port = $this->config->get('config_smtp_port');
            // $mail->timeout = $this->config->get('config_smtp_timeout');
            // $mail->setTo($customer_info['email']);
            // $mail->setFrom($this->config->get('config_email'));
            // $mail->setSender($store_name);
            // $mail->setSubject(html_entity_decode(sprintf($this->language->get('lang_text_credit_subject'), $this->config->get('config_name')), ENT_QUOTES, 'UTF-8'));
            // $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            // $mail->send();
            
            $this->theme->trigger('admin_add_customer_credit', array('customer_id' => $customer_id));
        endif;
    }
    
    public function deleteCredit($order_id) {
        $this->db->query("
			DELETE FROM {$this->db->prefix}customer_credit 
			WHERE order_id = '" . (int)$order_id . "'");

        $this->theme->trigger('admin_delete_customer_credit', array('order_id' => $order_id));
    }
    
    public function getCredits($customer_id, $start = 0, $limit = 10) {
        if ($start < 0):
            $start = 0;
        endif;
        
        if ($limit < 1):
            $limit = 10;
        endif;
        
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}customer_credit 
			WHERE customer_id = '" . (int)$customer_id . "' 
			ORDER BY date_added 
			DESC LIMIT " . (int)$start . "," . (int)$limit);
        
        return $query->rows;
    }
    
    public function getTotalCredits($customer_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer_credit 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->row['total'];
    }
    
    public function getCreditTotal($customer_id) {
        $query = $this->db->query("
			SELECT SUM(amount) AS total 
			FROM {$this->db->prefix}customer_credit 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->row['total'];
    }
    
    public function getTotalCreditsByOrderId($order_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer_credit 
			WHERE order_id = '" . (int)$order_id . "'");
        
        return $query->row['total'];
    }

    public function addCommission($customer_id, $description = '', $amount = '', $order_id = 0) {
        $customer_info = $this->getCustomer($customer_id);
        
        if ($customer_info):
            $this->db->query("
                INSERT INTO {$this->db->prefix}customer_commission 
                SET 
                    customer_id = '" . (int)$customer_id . "', 
                    order_id     = '" . (float)$order_id . "', 
                    description  = '" . $this->db->escape($description) . "', 
                    amount       = '" . (float)$amount . "', 
                    date_added   = NOW()
            ");
            
            $customer_commission_id = $this->db->getLastId();

            // NEW MAILER
            // admin_affiliate_add_transaction
            
            // $message = sprintf($this->language->get('lang_text_transaction_received'), $this->currency->format($amount, $this->config->get('config_currency'))) . "\n\n";
            // $message.= sprintf($this->language->get('lang_text_transaction_total'), $this->currency->format($this->getTransactionTotal($affiliate_id), $this->config->get('config_currency')));
            
            // $mail = new Mail();
            // $mail->protocol = $this->config->get('config_mail_protocol');
            // $mail->parameter = $this->config->get('config_mail_parameter');
            // $mail->hostname = $this->config->get('config_smtp_host');
            // $mail->username = $this->config->get('config_smtp_username');
            // $mail->password = $this->config->get('config_smtp_password');
            // $mail->port = $this->config->get('config_smtp_port');
            // $mail->timeout = $this->config->get('config_smtp_timeout');
            // $mail->setTo($affiliate_info['email']);
            // $mail->setFrom($this->config->get('config_email'));
            // $mail->setSender($this->config->get('config_name'));
            // $mail->setSubject(html_entity_decode(sprintf($this->language->get('lang_text_transaction_subject'), $this->config->get('config_name')), ENT_QUOTES, 'UTF-8'));
            // $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            // $mail->send();
            
            $this->theme->trigger('admin_add_customer_commission', array('customer_commission_id' => $customer_commission_id));
        endif;
    }

    public function deleteCommission($order_id) {
        $customer_commission_id = $this->getCommissionByOrderId($order_id);
        
        $this->db->query("
            DELETE FROM {$this->db->prefix}customer_commission 
            WHERE order_id = '" . (int)$order_id . "'");
        
        $this->theme->trigger('admin_delete_customer_commission', array('customer_commission_id' => $customer_commission_id));
    }

    public function getCommissions($customer_id, $start = 0, $limit = 10) {
        if ($start < 0):
            $start = 0;
        endif;
        
        if ($limit < 1):
            $limit = 10;
        endif;
        
        $query = $this->db->query("
            SELECT * 
            FROM {$this->db->prefix}customer_commission 
            WHERE customer_id = '" . (int)$customer_id . "' 
            ORDER BY date_added DESC 
            LIMIT " . (int)$start . "," . (int)$limit);
        
        return $query->rows;
    }
    
    public function getTotalCommissions($customer_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}customer_commission 
            WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->row['total'];
    }
    
    public function getCommissionTotal($customer_id) {
        $query = $this->db->query("
            SELECT SUM(amount) AS total 
            FROM {$this->db->prefix}customer_commission 
            WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->row['total'];
    }
    
    public function getTotalCommissionsByOrderId($order_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}customer_commission 
            WHERE order_id = '" . (int)$order_id . "'");
        
        return $query->row['total'];
    }
    
    public function getCommissionByOrderId($order_id) {
        $query = $this->db->query("
            SELECT customer_commission_id 
            FROM {$this->db->prefix}customer_commission 
            WHERE order_id = '" . (int)$order_id . "'
        ");
        
        return $query->row['customer_commission_id'];
    }

    public function getTotalAffiliatesByCountryId($country_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}customer 
            WHERE country_id = '" . (int)$country_id . "' 
            AND is_affiliate = '1'
        ");
        
        return $query->row['total'];
    }
    
    public function getTotalAffiliatesByZoneId($zone_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}customer 
            WHERE zone_id = '" . (int)$zone_id . "' 
            AND is_affiliate = '1'
        ");
        
        return $query->row['total'];
    }

    public function getTotalAffiliates($data = array()) {
        $sql = "
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}customer";
        
        $implode = array();
        
        if (!empty($data['filter_name'])):
            $implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        endif;
        
        if (!empty($data['filter_email'])):
            $implode[] = "LCASE(email) = '" . $this->db->escape($this->encode->strtolower($data['filter_email'])) . "'";
        endif;
        
        if (isset($data['filter_status']) && !is_null($data['filter_status'])):
            $implode[] = "status = '" . (int)$data['filter_status'] . "'";
        endif;
        
        if (isset($data['filter_approved']) && !is_null($data['filter_approved'])):
            $implode[] = "approved = '" . (int)$data['filter_approved'] . "'";
        endif;
        
        if (!empty($data['filter_date_added'])):
            $implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        endif;

        $implode[] = "is_affiliate = '1'";
        
        if ($implode):
            $imp  = implode(" && ", $implode);
            $sql .= " WHERE {$imp}";
        endif;
        
        $query = $this->db->query($sql);
        
        return $query->row['total'];
    }

    public function getAffiliates($data = array()) {
        $sql = "
            SELECT *, 
            CONCAT(c.firstname, ' ', c.lastname) AS name, 
            (SELECT SUM(cc.amount) 
                FROM {$this->db->prefix}customer_commission cc 
                WHERE cc.customer_id = c.customer_id 
                GROUP BY cc.customer_id) AS balance 
            FROM {$this->db->prefix}customer c";
        
        $implode = array();
        
        if (!empty($data['filter_name'])):
            $implode[] = "CONCAT(c.firstname, ' ', c.lastname) LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        endif;
        
        if (!empty($data['filter_email'])):
            $implode[] = "LCASE(c.email) = '" . $this->db->escape($this->encode->strtolower($data['filter_email'])) . "'";
        endif;
        
        if (!empty($data['filter_code'])):
            $implode[] = "c.code = '" . $this->db->escape($data['filter_code']) . "'";
        endif;
        
        if (isset($data['filter_status']) && !is_null($data['filter_status'])):
            $implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
        endif;
        
        if (isset($data['filter_approved']) && !is_null($data['filter_approved'])):
            $implode[] = "c.approved = '" . (int)$data['filter_approved'] . "'";
        endif;
        
        if (!empty($data['filter_date_added'])):
            $implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        endif;

        $implode[] = "c.is_affiliate = '1'";
        
        if ($implode):
            $imp = implode(" && ", $implode);
            $sql.= " WHERE {$imp}";
        endif;
        
        $sort_data = array(
            'name', 
            'c.email', 
            'c.code', 
            'c.status', 
            'c.approved', 
            'c.date_added'
        );
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)):
            $sql.= " ORDER BY {$data['sort']}";
        else:
            $sql.= " ORDER BY name";
        endif;
        
        if (isset($data['order']) && ($data['order'] == 'DESC')):
            $sql.= " DESC";
        else:
            $sql.= " ASC";
        endif;
        
        if (isset($data['start']) || isset($data['limit'])):
            if ($data['start'] < 0):
                $data['start'] = 0;
            endif;
            
            if ($data['limit'] < 1):
                $data['limit'] = 20;
            endif;
            
            $sql.= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        endif;
        
        $query = $this->db->query($sql);
        
        return $query->rows;
    }
    
    public function addReward($customer_id, $description = '', $points = '', $order_id = 0) {
        $customer_info = $this->getCustomer($customer_id);
        
        if ($customer_info):
            $this->db->query("
				INSERT INTO {$this->db->prefix}customer_reward 
				SET 
					customer_id = '" . (int)$customer_id . "', 
					order_id = '" . (int)$order_id . "', 
					points = '" . (int)$points . "', 
					description = '" . $this->db->escape($description) . "', 
					date_added = NOW()
			");
            
            $this->language->load('mail/customer');
            
            if ($order_id):
                $this->theme->model('sale/order');
                
                $order_info = $this->model_sale_order->getOrder($order_id);
                
                if ($order_info):
                    $store_name = $order_info['store_name'];
                else:
                    $store_name = $this->config->get('config_name');
                endif;
            else:
                $store_name = $this->config->get('config_name');
            endif;

            // NEW MAILER
            // admin_customer_add_reward
            
            // $message = sprintf($this->language->get('lang_text_reward_received'), $points) . "\n\n";
            // $message.= sprintf($this->language->get('lang_text_reward_total'), $this->getRewardTotal($customer_id));
            
            // $mail = new Mail();
            // $mail->protocol = $this->config->get('config_mail_protocol');
            // $mail->parameter = $this->config->get('config_mail_parameter');
            // $mail->hostname = $this->config->get('config_smtp_host');
            // $mail->username = $this->config->get('config_smtp_username');
            // $mail->password = $this->config->get('config_smtp_password');
            // $mail->port = $this->config->get('config_smtp_port');
            // $mail->timeout = $this->config->get('config_smtp_timeout');
            // $mail->setTo($customer_info['email']);
            // $mail->setFrom($this->config->get('config_email'));
            // $mail->setSender($store_name);
            // $mail->setSubject(html_entity_decode(sprintf($this->language->get('lang_text_reward_subject'), $store_name), ENT_QUOTES, 'UTF-8'));
            // $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            // $mail->send();
             
             $this->theme->trigger('admin_add_reward', array('customer_id' => $customer_id));
        endif;
    }
    
    public function deleteReward($order_id) {
        $this->db->query("
			DELETE FROM {$this->db->prefix}customer_reward 
			WHERE order_id = '" . (int)$order_id . "'");
    }
    
    public function getRewards($customer_id, $start = 0, $limit = 10) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}customer_reward 
			WHERE customer_id = '" . (int)$customer_id . "' 
			ORDER BY date_added 
			DESC LIMIT " . (int)$start . "," . (int)$limit);
        
        return $query->rows;
    }
    
    public function getTotalRewards($customer_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer_reward 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->row['total'];
    }
    
    public function getRewardTotal($customer_id) {
        $query = $this->db->query("
			SELECT SUM(points) AS total 
			FROM {$this->db->prefix}customer_reward 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->row['total'];
    }
    
    public function getTotalCustomerRewardsByOrderId($order_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer_reward 
			WHERE order_id = '" . (int)$order_id . "'");
        
        return $query->row['total'];
    }
    
    public function getIpsByCustomerId($customer_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}customer_ip 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->rows;
    }
    
    public function getTotalCustomersByIp($ip) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}customer_ip 
			WHERE ip = '" . $this->db->escape($ip) . "'");
        
        return $query->row['total'];
    }
    
    public function addBanIp($ip) {
        $this->db->query("
			INSERT INTO `{$this->db->prefix}customer_ban_ip` 
			SET `ip` = '" . $this->db->escape($ip) . "'");
    }
    
    public function removeBanIp($ip) {
        $this->db->query("
			DELETE FROM `{$this->db->prefix}customer_ban_ip` 
			WHERE `ip` = '" . $this->db->escape($ip) . "'");
    }
    
    public function getTotalBanIpsByIp($ip) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM `{$this->db->prefix}customer_ban_ip` 
			WHERE `ip` = '" . $this->db->escape($ip) . "'");
        
        return $query->row['total'];
    }
    
    public function getUsernameByCustomerId($customer_id) {
        $query = $this->db->query("
			SELECT username 
			FROM {$this->db->prefix}customer 
			WHERE customer_id = '" . (int)$customer_id . "'");
        
        return $query->row['username'];
    }

    public function getReferrer($customer_id) {
        $query = $this->db->query("
            SELECT username, firstname, lastname 
            FROM {$this->db->prefix}customer 
            WHERE customer_id = '" . (int)$customer_id . "'");

        return $query->row;
    }
}
