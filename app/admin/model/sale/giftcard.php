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

namespace Admin\Model\Sale;
use Oculus\Engine\Model;
use Oculus\Library\Language;
use Oculus\Library\Template;

class Giftcard extends Model {
    public function addGiftcard($data) {
        $this->db->query("
            INSERT INTO {$this->db->prefix}giftcard 
            SET 
                code              = '" . $this->db->escape($data['code']) . "', 
                from_name         = '" . $this->db->escape($data['from_name']) . "', 
                from_email        = '" . $this->db->escape($data['from_email']) . "', 
                to_name           = '" . $this->db->escape($data['to_name']) . "', 
                to_email          = '" . $this->db->escape($data['to_email']) . "', 
                giftcard_theme_id = '" . (int)$data['giftcard_theme_id'] . "', 
                message           = '" . $this->db->escape($data['message']) . "', 
                amount            = '" . (float)$data['amount'] . "', 
                status            = '" . (int)$data['status'] . "', 
                date_added        = NOW()"
        );
    }
    
    public function editGiftcard($giftcard_id, $data) {
        $this->db->query("
            UPDATE {$this->db->prefix}giftcard 
            SET 
                code              = '" . $this->db->escape($data['code']) . "', 
                from_name         = '" . $this->db->escape($data['from_name']) . "', 
                from_email        = '" . $this->db->escape($data['from_email']) . "', 
                to_name           = '" . $this->db->escape($data['to_name']) . "', 
                to_email          = '" . $this->db->escape($data['to_email']) . "', 
                giftcard_theme_id = '" . (int)$data['giftcard_theme_id'] . "', 
                message           = '" . $this->db->escape($data['message']) . "', 
                amount            = '" . (float)$data['amount'] . "', 
                status            = '" . (int)$data['status'] . "' 
            WHERE giftcard_id = '" . (int)$giftcard_id . "'
        ");
    }
    
    public function deleteGiftcard($giftcard_id) {
        $this->db->query("
            DELETE FROM {$this->db->prefix}giftcard 
            WHERE giftcard_id = '" . (int)$giftcard_id . "'");

        $this->db->query("
            DELETE FROM {$this->db->prefix}giftcard_history 
            WHERE giftcard_id = '" . (int)$giftcard_id . "'");
    }
    
    public function getGiftcard($giftcard_id) {
        $query = $this->db->query("
            SELECT DISTINCT * 
            FROM {$this->db->prefix}giftcard 
            WHERE giftcard_id = '" . (int)$giftcard_id . "'
        ");
        
        return $query->row;
    }
    
    public function getGiftcardByCode($code) {
        $query = $this->db->query("
            SELECT DISTINCT * 
            FROM {$this->db->prefix}giftcard 
            WHERE code = '" . $this->db->escape($code) . "'
        ");
        
        return $query->row;
    }
    
    public function getGiftcards($data = array()) {
        $sql = "
        SELECT 
            v.giftcard_id, 
            v.code, 
            v.from_name, 
            v.from_email, 
            v.to_name, 
            v.to_email, 
            (SELECT vtd.name 
                FROM {$this->db->prefix}giftcard_theme_description vtd 
                WHERE vtd.giftcard_theme_id = v.giftcard_theme_id 
                AND vtd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS theme, 
            v.amount, 
            v.status, 
            v.date_added 
        FROM {$this->db->prefix}giftcard v";
        
        $sort_data = array(
            'v.code', 
            'v.from_name', 
            'v.from_email', 
            'v.to_name', 
            'v.to_email', 
            'v.theme', 
            'v.amount', 
            'v.status', 
            'v.date_added'
        );
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql.= " ORDER BY {$data['sort']}";
        } else {
            $sql.= " ORDER BY v.date_added";
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
    
    public function sendGiftcard($giftcard_id) {
        $giftcard_info = $this->getGiftcard($giftcard_id);
        
        if ($giftcard_info) {
            if ($giftcard_info['order_id']) {
                $order_id = $giftcard_info['order_id'];
            } else {
                $order_id = 0;
            }
            
            $this->theme->model('sale/order');
            
            $order_info = $this->model_sale_order->getOrder($order_id);
            
            // If giftcard belongs to an order
            if ($order_info) {
                $this->theme->model('localization/language');
                
                $language = new Language($order_info['language_directory'], $this->app['path.language'], $this->app);
                $language->load($order_info['language_filename']);
                $language->load('mail/giftcard');

                // NEW MAILER
                // admin_giftcard_order_send
                
                // HTML Mail
                // $template = new Template($this->app);
                
                // $template->data['title'] = sprintf($language->get('text_subject'), $giftcard_info['from_name']);
                
                // $template->data['text_greeting'] = sprintf($language->get('text_greeting'), $this->currency->format($giftcard_info['amount'], $order_info['currency_code'], $order_info['currency_value']));
                // $template->data['text_from'] = sprintf($language->get('text_from'), $giftcard_info['from_name']);
                // $template->data['text_message'] = $language->get('text_message');
                // $template->data['text_redeem'] = sprintf($language->get('text_redeem'), $giftcard_info['code']);
                // $template->data['text_footer'] = $language->get('text_footer');
                
                // $this->theme->model('sale/giftcardtheme');
                
                // $giftcard_theme_info = $this->model_sale_giftcardtheme->getGiftcardTheme($giftcard_info['giftcard_theme_id']);
                
                // if ($giftcard_info && file_exists($this->app['path.image'] . $giftcard_theme_info['image'])) {
                //     $template->data['image'] = $this->app['http.public'] . 'image/' . $giftcard_theme_info['image'];
                // } else {
                //     $template->data['image'] = '';
                // }
                
                // $template->data['store_name'] = $order_info['store_name'];
                // $template->data['store_url'] = $order_info['store_url'];
                // $template->data['message'] = nl2br($giftcard_info['message']);
                
                // $mail = new Mail();
                // $mail->protocol = $this->config->get('config_mail_protocol');
                // $mail->parameter = $this->config->get('config_mail_parameter');
                // $mail->hostname = $this->config->get('config_smtp_host');
                // $mail->username = $this->config->get('config_smtp_username');
                // $mail->password = $this->config->get('config_smtp_password');
                // $mail->port = $this->config->get('config_smtp_port');
                // $mail->timeout = $this->config->get('config_smtp_timeout');
                // $mail->setTo($giftcard_info['to_email']);
                // $mail->setFrom($this->config->get('config_email'));
                // $mail->setSender($order_info['store_name']);
                // $mail->setSubject(html_entity_decode(sprintf($language->get('text_subject'), $giftcard_info['from_name']), ENT_QUOTES, 'UTF-8'));
                // $mail->setHtml($template->fetch('mail/giftcard'));
                // $mail->send();
                
                // If giftcard does not belong to an order
                
            } else {
                $this->language->load('mail/giftcard');

                // NEW MAILER
                // admin_giftcard_no_order_send
                
                // $template = new Template($this->app);
                
                // $template->data['title'] = sprintf($this->language->get('lang_text_subject'), $giftcard_info['from_name']);
                
                // $template->data['text_greeting'] = sprintf($this->language->get('lang_text_greeting'), $this->currency->format($giftcard_info['amount'], $order_info['currency_code'], $order_info['currency_value']));
                // $template->data['text_from'] = sprintf($this->language->get('lang_text_from'), $giftcard_info['from_name']);
                // $template->data['text_message'] = $this->language->get('lang_text_message');
                // $template->data['text_redeem'] = sprintf($this->language->get('lang_text_redeem'), $giftcard_info['code']);
                // $template->data['text_footer'] = $this->language->get('lang_text_footer');
                
                // $this->theme->model('sale/giftcardtheme');
                
                // $giftcard_theme_info = $this->model_sale_giftcardtheme->getGiftcardTheme($giftcard_info['giftcard_theme_id']);
                
                // if ($giftcard_info && file_exists($this->app['path.image'] . $giftcard_theme_info['image'])) {
                //     $template->data['image'] = $this->app['http.public'] . 'image/' . $giftcard_theme_info['image'];
                // } else {
                //     $template->data['image'] = '';
                // }
                
                // $template->data['store_name'] = $this->config->get('config_name');
                // $template->data['store_url'] = $this->app['http.public'];
                // $template->data['message'] = nl2br($giftcard_info['message']);
                
                // $mail = new Mail();
                // $mail->protocol = $this->config->get('config_mail_protocol');
                // $mail->parameter = $this->config->get('config_mail_parameter');
                // $mail->hostname = $this->config->get('config_smtp_host');
                // $mail->username = $this->config->get('config_smtp_username');
                // $mail->password = $this->config->get('config_smtp_password');
                // $mail->port = $this->config->get('config_smtp_port');
                // $mail->timeout = $this->config->get('config_smtp_timeout');
                // $mail->setTo($giftcard_info['to_email']);
                // $mail->setFrom($this->config->get('config_email'));
                // $mail->setSender($this->config->get('config_name'));
                // $mail->setSubject(html_entity_decode(sprintf($this->language->get('lang_text_subject'), $giftcard_info['from_name']), ENT_QUOTES, 'UTF-8'));
                // $mail->setHtml($template->fetch('mail/giftcard'));
                // $mail->send();
            }
        }
    }
    
    public function getTotalGiftcards() {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}giftcard
        ");
        
        return $query->row['total'];
    }
    
    public function getTotalGiftcardsByGiftcardThemeId($giftcard_theme_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}giftcard 
            WHERE giftcard_theme_id = '" . (int)$giftcard_theme_id . "'
        ");
        
        return $query->row['total'];
    }
    
    public function getGiftcardHistories($giftcard_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }
        
        if ($limit < 1) {
            $limit = 10;
        }
        
        $query = $this->db->query("
            SELECT 
                vh.order_id, 
                CONCAT(o.firstname, ' ', o.lastname) AS customer, 
                vh.amount, vh.date_added 
            FROM {$this->db->prefix}giftcard_history vh 
            LEFT JOIN `{$this->db->prefix}order` o 
            ON (vh.order_id = o.order_id) 
            WHERE vh.giftcard_id = '" . (int)$giftcard_id . "' 
            ORDER BY vh.date_added ASC 
            LIMIT " . (int)$start . "," . (int)$limit);
        
        return $query->rows;
    }
    
    public function getTotalGiftcardHistories($giftcard_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}giftcard_history 
            WHERE giftcard_id = '" . (int)$giftcard_id . "'
        ");
        
        return $query->row['total'];
    }
}
