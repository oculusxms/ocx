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

namespace Admin\Model\Catalog;
use Oculus\Engine\Model;
use Oculus\Library\Mail;

class Event extends Model {
    
    public function getEvents($data = array()) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}event_manager 
			ORDER BY date_time ASC");
        
        return $query->rows;
    }
    
    public function getEvent($event_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
        
        return $query->row;
    }
    
    public function addEvent($data) {
        $date_start = date('Y-m-d H:i:s', strtotime($data['event_date'] . ' ' . $data['event_time']));
        $date_end = date('Y-m-d H:i:s', strtotime('+' . $data['event_length'] . ' hour', strtotime($date_start)));
        
        $this->db->query("
			INSERT INTO {$this->db->prefix}event_manager 
			SET 
				event_name = '" . $this->db->escape($data['name']) . "', 
				model = '" . $this->db->escape($data['model']) . "', 
				sku = '" . $this->db->escape($data['sku']) . "', 
				visibility = '" . (int)$data['visibility'] . "', 
				event_days = '" . $this->db->escape(serialize($data['event_days'])) . "', 
				event_length = '" . $this->db->escape($data['event_length']) . "', 
				date_time = '" . $this->db->escape($date_start) . "', 
				online = '" . (int)$data['online'] . "', 
				hangout = '" . $this->db->escape($data['hangout']) . "', 
				location = '" . $this->db->escape($data['location']) . "', 
				telephone = '" . $this->db->escape($data['telephone']) . "', 
				cost = '" . (float)$data['cost'] . "', 
				seats = '" . (int)$data['seats'] . "', 
				presenter_id = '" . (int)$data['presenter'] . "', 
				description = '" . $this->db->escape($data['description']) . "', 
				presenter_tab = '" . $this->db->escape($data['presenter_tab']) . "', 
				date_end = '" . $this->db->escape($date_end) . "', 
				refundable = '" . (int)$data['refundable'] . "'");
        
        $event_id = $this->db->getLastId();
        
        $this->db->query("
			INSERT INTO {$this->db->prefix}product 
			SET 
				model = '" . $this->db->escape($data['model']) . "', 
				sku = '" . $this->db->escape($data['sku']) . "', 
				location = '" . $this->db->escape($data['location']) . "', 
				visibility = '" . (int)$data['visibility'] . "', 
				quantity = '" . (int)$data['seats'] . "', 
				stock_status_id = '" . (int)$data['stock_status_id'] . "', 
				price = '" . (float)$data['cost'] . "', 
				subtract = '1', 
				status = '" . (int)$data['status'] . "', 
				end_date = '" . $this->db->escape($date_end) . "', 
				event_id = '" . (int)$event_id . "', 
				shipping = '0', 
				weight_class_id = '" . (int)$this->config->get('config_weight_class_id') . "', 
				length_class_id = '" . (int)$this->config->get('config_length_class_id') . "', 
				date_available = NOW(), 
				date_added = NOW(), 
				date_modified = NOW()");
        
        $product_id = $this->db->getLastId();
        
        // add event to routes as a product
        $this->db->query("
			INSERT INTO {$this->db->prefix}route 
			SET 
				route = 'catalog/product', 
				query = 'product_id:" . (int)$product_id . "', 
				slug = '" . $this->db->escape($data['slug']) . "'
		");
        
        $languages = $this->db->query("
			SELECT language_id 
			FROM {$this->db->prefix}language");
        
        $this->db->query("
			UPDATE {$this->db->prefix}event_manager 
			SET product_id = '" . (int)$product_id . "' 
			WHERE event_id = '" . (int)$event_id . "'");
        
        foreach ($languages->rows as $language) {
            $this->db->query("
				INSERT INTO {$this->db->prefix}product_description 
				SET 
					product_id = '" . (int)$product_id . "', 
					language_id = '" . $language['language_id'] . "', 
					name = '" . $this->db->escape($data['name']) . "', 
					description = '" . $this->db->escape($data['description']) . "'");
        }
        
        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}product_to_store 
					SET 
						product_id = '" . (int)$product_id . "', 
						store_id = '" . (int)$store_id . "'");
            }
        }
        
        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}product_to_category 
					SET 
						product_id = '" . (int)$product_id . "', 
						category_id = '" . (int)$category_id . "'");
            }
        }
        
        return;
    }
    
    public function editEvent($event_id, $data) {
        $date_start = date('Y-m-d H:i:s', strtotime($data['event_date'] . ' ' . $data['event_time']));
        $date_end = date('Y-m-d H:i:s', strtotime('+' . $data['event_length'] . ' hour', strtotime($date_start)));
        
        $this->db->query("
			UPDATE {$this->db->prefix}event_manager 
			SET 
				event_name = '" . $this->db->escape($data['name']) . "', 
				model = '" . $this->db->escape($data['model']) . "', 
				sku = '" . $this->db->escape($data['sku']) . "', 
				visibility = '" . (int)$data['visibility'] . "', 
				event_days = '" . $this->db->escape(serialize($data['event_days'])) . "', 
				event_length = '" . $this->db->escape($data['event_length']) . "', 
				date_time = '" . $this->db->escape($date_start) . "', 
				online = '" . (int)$data['online'] . "', 
				hangout = '" . $this->db->escape($data['hangout']) . "', 
				location = '" . $this->db->escape($data['location']) . "', 
				telephone = '" . $this->db->escape($data['telephone']) . "', 
				cost = '" . (float)$data['cost'] . "', 
				seats = '" . (int)$data['seats'] . "', 
				presenter_id = '" . (int)$data['presenter'] . "', 
				description = '" . $this->db->escape($data['description']) . "', 
				presenter_tab = '" . $this->db->escape($data['presenter_tab']) . "', 
				date_end = '" . $this->db->escape($date_end) . "', 
				product_id = '" . (int)$data['product_id'] . "', 
				refundable = '" . (int)$data['refundable'] . "' 
			WHERE event_id = '" . (int)$event_id . "'");
        
        $filled = $this->db->query("
			SELECT filled 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
        
        $quantity = (int)$data['seats'] - (int)$filled->row['filled'];
        
        $this->db->query("
			UPDATE {$this->db->prefix}product 
			SET 
				model = '" . $this->db->escape($data['model']) . "', 
				sku = '" . $this->db->escape($data['sku']) . "', 
				location = '" . $this->db->escape($data['location']) . "', 
				visibility = '" . (int)$data['visibility'] . "', 
				quantity = '" . (int)$quantity . "', 
				price = '" . (float)$data['cost'] . "', 
				stock_status_id = '" . (int)$data['stock_status_id'] . "', 
				status = '" . (int)$data['status'] . "', 
				end_date = '" . $this->db->escape($date_end) . "', 
				date_modified = NOW() 
			WHERE product_id = '" . (int)$data['product_id'] . "'");
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}product_to_store 
			WHERE product_id = '" . (int)$data['product_id'] . "'");
        
        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}product_to_store 
					SET 
						product_id = '" . (int)$data['product_id'] . "', 
						store_id = '" . (int)$store_id . "'");
            }
        }
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}product_to_category 
			WHERE product_id = '" . (int)$data['product_id'] . "'");
        
        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}product_to_category 
					SET 
						product_id = '" . (int)$data['product_id'] . "', 
						category_id = '" . (int)$category_id . "'");
            }
        }
        
        $this->db->query("DELETE FROM {$this->db->prefix}route WHERE query = 'product_id:" . (int)$data['product_id'] . "'");
        
        $this->db->query("
			INSERT INTO {$this->db->prefix}route 
			SET 
				route = 'catalog/product', 
				query = 'product_id:" . (int)$data['product_id'] . "', 
				slug = '" . $this->db->escape($data['slug']) . "'
		");
        
        $languages = $this->db->query("
			SELECT language_id 
			FROM {$this->db->prefix}language");
        
        foreach ($languages->rows as $language) {
            $this->db->query("
				UPDATE {$this->db->prefix}product_description 
				SET 
					name = '" . $this->db->escape($data['name']) . "', 
					description = '" . $this->db->escape($data['description']) . "' 
				WHERE product_id = '" . (int)$data['product_id'] . "' 
				AND language_id = '" . (int)$language['language_id'] . "'");
        }
        
        return;
    }
    
    public function deleteEvent($event_id) {
        $product_id = $this->db->query("
			SELECT product_id 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}event_wait_list 
			WHERE event_id = '" . (int)$event_id . "'");
        
        $this->theme->model('catalog/product');
        $this->model_catalog_product->deleteProduct($product_id->row['product_id']);
        
        return;
    }
    
    public function getSlug($product_id) {
        $query = $this->db->query("
			SELECT slug 
			FROM {$this->db->prefix}route 
			WHERE query = 'product_id:" . (int)$product_id . "'");
        
        return $query->row['slug'];
    }
    
    public function getPresenters($data = array()) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}presenter 
			ORDER BY presenter_name ASC");
        
        return $query->rows;
    }
    
    public function getPresenter($presenter_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}presenter 
			WHERE presenter_id = '" . (int)$presenter_id . "'");
        
        return $query->row;
    }
    
    public function getCategoryName($category_id) {
        $query = $this->db->query("
			SELECT name 
			FROM {$this->db->prefix}category_description 
			WHERE category_id = '" . (int)$category_id . "'");
        
        return $query->row['name'];
    }
    
    public function getPresenterName($presenter_id) {
        $query = $this->db->query("
			SELECT presenter_name 
			FROM {$this->db->prefix}presenter 
			WHERE presenter_id = '" . (int)$presenter_id . "'");
        
        if ($query->num_rows) {
            return $query->row['presenter_name'];
        } else {
            return;
        }
    }
    
    public function addPresenter($data) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}presenter 
			SET 
				presenter_name = '" . $this->db->escape($data['presenter_name']) . "', 
				bio = '" . $this->db->escape($data['bio']) . "'");
        return;
    }
    
    public function editPresenter($presenter_id, $data) {
        $this->db->query("
			UPDATE {$this->db->prefix}presenter 
			SET 
				presenter_name = '" . $this->db->escape($data['presenter_name']) . "', 
				bio = '" . $this->db->escape($data['bio']) . "' 
			WHERE presenter_id = '" . (int)$presenter_id . "'");
        
        return;
    }
    
    public function deletePresenter($presenter_id) {
        $this->db->query("
			DELETE FROM {$this->db->prefix}presenter 
			WHERE presenter_id = '" . (int)$presenter_id . "'");
        
        return;
    }
    
    public function getRoster($event_id) {
        $return_data = array();
        
        $query = $this->db->query("
			SELECT roster 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
        
        if (!empty($query->row['roster'])) {
            foreach (unserialize($query->row['roster']) as $roster) {
                $return_data[] = array('attendee_id' => $roster['attendee_id'], 'name' => $this->getAttendeeName($roster['attendee_id']), 'date_added' => $roster['date_added']);
            }
        }
        
        return $return_data;
    }
    
    public function getWaitListCount($event_id) {
        $query = $this->db->query("
			SELECT COUNT(*) as total 
			FROM {$this->db->prefix}event_wait_list 
			WHERE event_id = '" . (int)$event_id . "'");
        
        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }
    
    public function getWaitListAttendees($event_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}event_wait_list 
			WHERE event_id = '" . (int)$event_id . "'");
        
        return $query->rows;
    }
    
    public function addToEvent($data) {
        $attendee_data = array('attendee_id' => $data['customer_id'], 'event_id' => $data['event_id']);
        
        $this->addAttendee($attendee_data);
        
        $query = $this->db->query("
			SELECT seats, filled 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$data['event_id'] . "'");
        
        if ($query->row['seats'] < $query->row['filled']) {
            $this->db->query("
				UPDATE {$this->db->prefix}event_manager 
				SET 
					seats = '" . (int)$query->row['filled'] . "' 
				WHERE event_id = '" . (int)$data['event_id'] . "'");
        }
        
        $this->db->query("
			DELETE FROM {$this->db->prefix}event_wait_list 
			WHERE event_id = '" . (int)$data['event_id'] . "' 
			AND customer_id = '" . (int)$data['customer_id'] . "'");
        
        $event_info = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$data['event_id'] . "'");
        
        $customer_email = $this->db->query("
			SELECT email 
			FROM {$this->db->prefix}customer 
			WHERE customer_id = '" . (int)$data['customer_id'] . "'");
        
        // NEW MAILER
        // admin_event_add
            
        // if ($customer_email->num_rows && $customer_email->row['email'] != "") {
        //     $subject = sprintf($this->language->get('text_add_event_subject'), $event_info->row['event_name']);
        //     $image = IMAGE_URL . $this->config->get('config_logo');
        //     $logo = str_replace(' ', '%20', $image);
        //     $html = '<div style="width: 100%; height: 100px; margin-bottom: 20px;"><img src="' . $logo . '" border="0" /></div>';
        //     $html.= '<div style="width: 100%; margin-bottom: 20px;">';
        //     $html.= sprintf($this->language->get('text_add_event_message'), $event_info->row['event_name']);
        //     $html.= '</div>';
        //     $html.= '<div style="width: 100%; margin-bottom: 20px;">';
        //     $html.= '<table>';
        //     $html.= '<tr>';
        //     $html.= '<td style="width: 200px; font-weight: bold;">' . $this->language->get('column_event_name') . ':</td>';
        //     $html.= '<td>' . $event_info->row['event_name'] . '</td>';
        //     $html.= '</tr>';
        //     $html.= '<tr>';
        //     $html.= '<td style="width: 200px; font-weight: bold;">' . $this->language->get('column_date_time') . ':</td>';
        //     $html.= '<td>' . date($this->language->get('date_format_short'), strtotime($event_info->row['date_time'])) . ' at ' . date($this->language->get('time_format'), strtotime($event_info->row['date_time'])) . '</td>';
        //     $html.= '</tr>';
            
        //     if ($event_info->row['location'] != "") {
        //         $html.= '<tr>';
        //         $html.= '<td style="width: 200px; font-weight: bold;">' . $this->language->get('column_location') . ':</td>';
        //         $html.= '<td>' . $event_info->row['location'] . '</td>';
        //         $html.= '</tr>';
        //     }
            
        //     if ($event_info->row['telephone'] != "") {
        //         $html.= '<tr>';
        //         $html.= '<td style="width: 200px; font-weight: bold;">' . $this->language->get('column_telephone') . ':</td>';
        //         $html.= '<td>' . $event_info->row['telephone'] . '</td>';
        //         $html.= '</tr>';
        //     }
            
        //     $html.= '</table>';
        //     $html.= '</div>';
        //     $html.= '<div style="width: 100%;">';
        //     $html.= $this->config->get('config_name');
        //     $html.= '</div>';
            
        //     $mail = new Mail();
        //     $mail->protocol = $this->config->get('config_mail_protocol');
        //     $mail->parameter = $this->config->get('config_mail_parameter');
        //     $mail->hostname = $this->config->get('config_smtp_host');
        //     $mail->username = $this->config->get('config_smtp_username');
        //     $mail->password = $this->config->get('config_smtp_password');
        //     $mail->port = $this->config->get('config_smtp_port');
        //     $mail->timeout = $this->config->get('config_smtp_timeout');
        //     $mail->setTo($customer_email->row['email']);
        //     $mail->setFrom($this->config->get('config_email'));
        //     $mail->setSender($this->config->get('config_name'));
        //     $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
        //     $mail->setHtml($html);
        //     $mail->send();
        // }
        
        return;
    }
    
    public function addToWaitList($data) {
        if ($this->checkAttendee($data)):
            return 2;
        endif;
        
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}event_wait_list 
			WHERE event_id = '" . (int)$data['event_id'] . "' 
			AND customer_id = '" . (int)$data['attendee_id'] . "'");
        
        if (!$query->num_rows) {
            $this->db->query("
				INSERT INTO {$this->db->prefix}event_wait_list 
				SET 
					event_id = '" . (int)$data['event_id'] . "', 
					customer_id = '" . (int)$data['attendee_id'] . "'");
            
            $event_info = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}event_manager 
				WHERE event_id = '" . (int)$data['event_id'] . "'");
            
            $customer_email = $this->db->query("
				SELECT email 
				FROM {$this->db->prefix}customer 
				WHERE customer_id = '" . (int)$data['attendee_id'] . "'");

            // NEW MAILER
            // admin_event_waitlist
            
            // if ($customer_email->num_rows && $customer_email->row['email'] != "") {
            //     $subject = sprintf($this->language->get('text_add_wait_subject'), $event_info->row['event_name']);
            //     $image = IMAGE_URL . $this->config->get('config_logo');
            //     $logo = str_replace(' ', '%20', $image);
            //     $html = '<div style="width: 100%; height: 100px; margin-bottom: 20px;"><img src="' . $logo . '" border="0" /></div>';
            //     $html.= '<div style="width: 100%; margin-bottom: 20px;">';
            //     $html.= sprintf($this->language->get('text_add_wait_message'), $event_info->row['event_name']);
            //     $html.= '</div>';
            //     $html.= '<div style="width: 100%; margin-bottom: 20px;">';
            //     $html.= '<table>';
            //     $html.= '<tr>';
            //     $html.= '<td style="width: 200px; font-weight: bold;">' . $this->language->get('column_event_name') . ':</td>';
            //     $html.= '<td>' . $event_info->row['event_name'] . '</td>';
            //     $html.= '</tr>';
            //     $html.= '<tr>';
            //     $html.= '<td style="width: 200px; font-weight: bold;">' . $this->language->get('column_date_time') . ':</td>';
            //     $html.= '<td>' . date($this->language->get('date_format_short'), strtotime($event_info->row['date_time'])) . ' at ' . date($this->language->get('time_format'), strtotime($event_info->row['date_time'])) . '</td>';
            //     $html.= '</tr>';
                
            //     if ($event_info->row['location'] != "") {
            //         $html.= '<tr>';
            //         $html.= '<td style="width: 200px; font-weight: bold;">' . $this->language->get('column_location') . ':</td>';
            //         $html.= '<td>' . $event_info->row['location'] . '</td>';
            //         $html.= '</tr>';
            //     }
                
            //     if ($event_info->row['telephone'] != "") {
            //         $html.= '<tr>';
            //         $html.= '<td style="width: 200px; font-weight: bold;">' . $this->language->get('column_telephone') . ':</td>';
            //         $html.= '<td>' . $event_info->row['telephone'] . '</td>';
            //         $html.= '</tr>';
            //     }
                
            //     $html.= '</table>';
            //     $html.= '</div>';
            //     $html.= '<div style="width: 100%;">';
            //     $html.= $this->config->get('config_name');
            //     $html.= '</div>';
                
            //     $mail = new Mail();
            //     $mail->protocol = $this->config->get('config_mail_protocol');
            //     $mail->parameter = $this->config->get('config_mail_parameter');
            //     $mail->hostname = $this->config->get('config_smtp_host');
            //     $mail->username = $this->config->get('config_smtp_username');
            //     $mail->password = $this->config->get('config_smtp_password');
            //     $mail->port = $this->config->get('config_smtp_port');
            //     $mail->timeout = $this->config->get('config_smtp_timeout');
            //     $mail->setTo($customer_email->row['email']);
            //     $mail->setFrom($this->config->get('config_email'));
            //     $mail->setSender($this->config->get('config_name'));
            //     $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
            //     $mail->setHtml($html);
            //     $mail->send();
            // }
            return true;
        } else {
            return false;
        }
    }
    
    public function removeFromList($event_wait_list_id) {
        $this->db->query("
			DELETE FROM {$this->db->prefix}event_wait_list 
			WHERE event_wait_list_id = '" . (int)$event_wait_list_id . "'");
        
        return;
    }
    
    public function emptyWaitList($event_id) {
        $this->db->query("
			DELETE FROM {$this->db->prefix}event_wait_list 
			WHERE event_id = '" . (int)$event_id . "'");
        
        return;
    }
    
    public function getEventName($event_id) {
        $query = $this->db->query("
			SELECT event_name 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
        
        return $query->row['event_name'];
    }
    
    public function getSeats($event_id) {
        $query = $this->db->query("
			SELECT seats 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
        
        return $query->row['seats'];
    }
    
    public function getAvailable($event_id) {
        $query = $this->db->query("
			SELECT seats, filled 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
        
        $available = $query->row['seats'] - $query->row['filled'];
        
        return $available;
    }
    
    public function updateSeats($event_id, $seats) {
        $this->db->query("
			UPDATE {$this->db->prefix}event_manager 
			SET 
				filled = (filled - " . (int)$seats . ") 
			WHERE event_id = '" . (int)$event_id . "'");
        
        return;
    }
    
    public function getAttendeeName($attendee_id) {
        $query = $this->db->query("
			SELECT 
				CONCAT(firstname, ' ', lastname) as name, 
				username 
			FROM {$this->db->prefix}customer 
			WHERE customer_id = '" . (int)$attendee_id . "'");
        
        if ($query->num_rows) {
            return $query->row['name'] . ' (' . $query->row['username'] . ')';
        } else {
            return;
        }
    }
    
    public function checkAttendee($data) {
        $exists = false;
        
        $query = $this->db->query("
			SELECT roster 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$data['event_id'] . "'");
        
        if (!empty($query->row['roster'])) {
            foreach (unserialize($query->row['roster']) as $roster) {
                if ($roster['attendee_id'] == $data['attendee_id']) {
                    $exists = true;
                    break;
                }
            }
        }
        
        return $exists;
    }
    
    public function addAttendee($data) {
        $new_array = array();
        
        $query = $this->db->query("
			SELECT roster, seats, product_id, filled 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$data['event_id'] . "'");
        
        $filled = $query->row['filled'];
        $seats = $query->row['seats'];
        $product_id = $query->row['product_id'];
        
        if (!empty($query->row['roster'])) {
            foreach (unserialize($query->row['roster']) as $attendee) {
                $new_array[] = array('attendee_id' => $attendee['attendee_id'], 'date_added' => $attendee['date_added']);
            }
        }
        
        $new_array[] = array('attendee_id' => $data['attendee_id'], 'date_added' => time());
        
        if ($filled > $seats) {
            $seats = $filled;
        }
        
        $this->db->query("
			UPDATE {$this->db->prefix}event_manager 
			SET 
				roster = '" . $this->db->escape(serialize($new_array)) . "', 
				seats = '" . (int)$seats . "', 
				filled = (filled + 1) 
			WHERE event_id = '" . (int)$data['event_id'] . "'");
        
        $this->updateProductQuantity($product_id, 1);
        
        $new_array = null;
        
        unset($new_array);
        
        return;
    }
    
    public function deleteAttendee($event_id, $attendee_id) {
        $new_array = array();
        
        $query = $this->db->query("
			SELECT roster, product_id 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
        
        $product_id = $query->row['product_id'];
        
        foreach (unserialize($query->row['roster']) as $roster) {
            if ($attendee_id != $roster['attendee_id']) {
                $new_array[] = array('attendee_id' => $roster['attendee_id'], 'date_added' => $roster['date_added']);
            }
        }
        
        $this->db->query("
			UPDATE {$this->db->prefix}event_manager 
			SET roster = '" . $this->db->escape(serialize($new_array)) . "' 
			WHERE event_id = '" . (int)$event_id . "'");
        
        $this->updateProductQuantity($product_id);
        
        $new_array = null;
        
        unset($new_array);
        
        return;
    }
    
    public function updateProductQuantity($product_id, $quantity = 0) {
        if ($quantity) {
            $this->db->query("
				UPDATE {$this->db->prefix}product 
				SET quantity = (quantity - 1) 
				WHERE product_id = '" . (int)$product_id . "'");
        } else {
            $this->db->query("
				UPDATE {$this->db->prefix}product 
				SET quantity = (quantity + 1) 
				WHERE product_id = '" . (int)$product_id . "'");
        }
    }
    
    public function getProductId($event_id) {
        $query = $this->db->query("
			SELECT product_id 
			FROM {$this->db->prefix}product 
			WHERE event_id = '" . (int)$event_id . "'");
        
        if ($query->num_rows) {
            return $query->row['product_id'];
        } else {
            return 0;
        }
    }
}
