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

class Profile extends Model {
    public function getFrequencies() {
        return array(
            'day'        => $this->language->get('lang_text_day'), 
            'week'       => $this->language->get('lang_text_week'), 
            'semi_month' => $this->language->get('lang_text_semi_month'), 
            'month'      => $this->language->get('lang_text_month'), 
            'year'       => $this->language->get('lang_text_year')
        );
    }
    
    public function getProfile($profile_id) {
        $query = $this->db->query("
            SELECT * FROM {$this->db->prefix}profile 
            WHERE profile_id = '" . (int)$profile_id . "'");

        return $query->row;
    }
    
    public function getProfileDescription($profile_id) {
        $profile_descriptions = array();
        
        $query = $this->db->query("
            SELECT * FROM {$this->db->prefix}profile_description 
            WHERE profile_id = '" . (int)$profile_id . "'");
        
        foreach ($query->rows as $result) {
            $profile_descriptions[$result['language_id']] = array('name' => $result['name']);
        }
        
        return $profile_descriptions;
    }
    
    public function getProfiles() {
        $query = $this->db->query("
            SELECT 
                p.profile_id, 
                p.sort_order, 
                pd.name 
            FROM {$this->db->prefix}profile p 
            JOIN {$this->db->prefix}profile_description pd 
            ON(pd.profile_id = p.profile_id) 
            AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
            ORDER BY p.sort_order ASC
        ");

        return $query->rows;
    }
    
    public function addProfile($data) {
        $this->db->query("
            INSERT INTO `{$this->db->prefix}profile` 
            SET 
                `sort_order` = " . (int)$data['sort_order'] . ", 
                `status` = " . (int)$data['status'] . ", 
                `price` = " . (double)$data['price'] . ", 
                `frequency` = '" . $this->db->escape($data['frequency']) . "', 
                `duration` = " . (int)$data['duration'] . ", 
                `cycle` = " . (int)$data['cycle'] . ", 
                `trial_status` = " . (int)$data['trial_status'] . ", 
                `trial_price` = " . (double)$data['trial_price'] . ", 
                `trial_frequency` = '" . $this->db->escape($data['trial_frequency']) . "', 
                `trial_duration` = " . (int)$data['trial_duration'] . ", 
                `trial_cycle` = " . (int)$data['trial_cycle']
        );
        
        $profile_id = $this->db->getLastId();
        
        foreach ($data['profile_description'] as $language_id => $profile_description) {
            $this->db->query("
                INSERT INTO {$this->db->prefix}profile_description 
                SET 
                    profile_id = '" . (int)$profile_id . "', 
                    language_id = '" . (int)$language_id . "', 
                    name = '" . $this->db->escape($profile_description['name']) . "'
            ");
        }
        
        $this->theme->trigger('admin_add_profile', array('profile_id' => $profile_id));
        
        return $profile_id;
    }
    
    public function updateProfile($profile_id, $data) {
        $this->db->query("
            DELETE FROM `{$this->db->prefix}profile_description` 
            WHERE profile_id = " . (int)$profile_id);
        
        $this->db->query("
            UPDATE `{$this->db->prefix}profile` 
            SET 
                `sort_order` = " . (int)$data['sort_order'] . ", 
                `status` = " . (int)$data['status'] . ", 
                `price` = " . (double)$data['price'] . ", 
                `frequency` = '" . $this->db->escape($data['frequency']) . "', 
                `duration` = " . (int)$data['duration'] . ", 
                `cycle` = " . (int)$data['cycle'] . ", 
                `trial_status` = " . (int)$data['trial_status'] . ", 
                `trial_price` = " . (double)$data['trial_price'] . ", 
                `trial_frequency` = '" . $this->db->escape($data['trial_frequency']) . "', 
                `trial_duration` = " . (int)$data['trial_duration'] . ", 
                `trial_cycle` = " . (int)$data['trial_cycle'] . " 
            WHERE profile_id = " . (int)$profile_id);
        
        foreach ($data['profile_description'] as $language_id => $profile_description) {
            $this->db->query("
                INSERT INTO {$this->db->prefix}profile_description 
                SET 
                    profile_id = '" . (int)$profile_id . "', 
                    language_id = '" . (int)$language_id . "', 
                    name = '" . $this->db->escape($profile_description['name']) . "'
            ");
        }
        
        $this->theme->trigger('admin_update_profile', array('profile_id' => $profile_id));
    }
    
    public function deleteProfile($profile_id) {
        $this->db->query("
            DELETE FROM {$this->db->prefix}profile 
            WHERE profile_id = '" . (int)$profile_id . "'");

        $this->db->query("
            DELETE FROM {$this->db->prefix}profile_description 
            WHERE profile_id = '" . (int)$profile_id . "'");

        $this->db->query("
            DELETE FROM {$this->db->prefix}product_profile 
            WHERE profile_id = '" . (int)$profile_id . "'");

        $this->db->query("
            UPDATE {$this->db->prefix}order_recurring 
            SET 
                profile_id = '0' 
            WHERE profile_id = '" . (int)$profile_id . "'");
        
        $this->theme->trigger('admin_delete_profile', array('profile_id' => $profile_id));
    }
    
    public function copyProfile($profile_id) {
        $data = $this->getProfile($profile_id);
        $data['profile_description'] = $this->getProfileDescription($profile_id);
        
        foreach ($data['profile_description'] as & $profile_description) {
            $profile_description['name'].= ' - 2';
        }
        
        $this->addProfile($data);
    }
}
