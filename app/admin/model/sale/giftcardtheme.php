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

class Giftcardtheme extends Model {
    public function addGiftcardTheme($data) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}giftcard_theme 
			SET 
				image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "'
		");
        
        $giftcard_theme_id = $this->db->getLastId();
        
        foreach ($data['giftcard_theme_description'] as $language_id => $value) {
            $this->db->query("
				INSERT INTO {$this->db->prefix}giftcard_theme_description 
				SET 
                    giftcard_theme_id = '" . (int)$giftcard_theme_id . "', 
                    language_id       = '" . (int)$language_id . "', 
                    name              = '" . $this->db->escape($value['name']) . "'
			");
        }
        
        $this->cache->delete('giftcard');
    }
    
    public function editGiftcardTheme($giftcard_theme_id, $data) {
        $this->db->query("
			UPDATE {$this->db->prefix}giftcard_theme 
			SET 
				image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' 
			WHERE giftcard_theme_id = '" . (int)$giftcard_theme_id . "'
		");
        
        $this->db->query("DELETE FROM {$this->db->prefix}giftcard_theme_description WHERE giftcard_theme_id = '" . (int)$giftcard_theme_id . "'");
        
        foreach ($data['giftcard_theme_description'] as $language_id => $value) {
            $this->db->query("
				INSERT INTO {$this->db->prefix}giftcard_theme_description 
				SET 
                    giftcard_theme_id = '" . (int)$giftcard_theme_id . "', 
                    language_id       = '" . (int)$language_id . "', 
                    name              = '" . $this->db->escape($value['name']) . "'
			");
        }
        
        $this->cache->delete('giftcard');
    }
    
    public function deleteGiftcardTheme($giftcard_theme_id) {
        $this->db->query("
            DELETE FROM {$this->db->prefix}giftcard_theme 
            WHERE giftcard_theme_id = '" . (int)$giftcard_theme_id . "'");

        $this->db->query("
            DELETE FROM {$this->db->prefix}giftcard_theme_description 
            WHERE giftcard_theme_id = '" . (int)$giftcard_theme_id . "'");
        
        $this->cache->delete('giftcard');
    }
    
    public function getGiftcardTheme($giftcard_theme_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}giftcard_theme vt 
			LEFT JOIN {$this->db->prefix}giftcard_theme_description vtd 
				ON (vt.giftcard_theme_id = vtd.giftcard_theme_id) 
			WHERE vt.giftcard_theme_id = '" . (int)$giftcard_theme_id . "' 
			AND vtd.language_id = '" . (int)$this->config->get('config_language_id') . "'
		");
        
        return $query->row;
    }
    
    public function getGiftcardThemes($data = array()) {
        if ($data) {
            $sql = "
				SELECT * 
				FROM {$this->db->prefix}giftcard_theme vt 
				LEFT JOIN {$this->db->prefix}giftcard_theme_description vtd 
					ON (vt.giftcard_theme_id = vtd.giftcard_theme_id) 
				WHERE vtd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
				ORDER BY vtd.name
			";
            
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
        } else {
            $query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}giftcard_theme vt 
				LEFT JOIN {$this->db->prefix}giftcard_theme_description vtd 
					ON (vt.giftcard_theme_id = vtd.giftcard_theme_id) 
				WHERE vtd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
				ORDER BY vtd.name
			");
            
            return $query->rows;
        }
    }
    
    public function getGiftcardThemeDescriptions($giftcard_theme_id) {
        $giftcard_theme_data = array();
        
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}giftcard_theme_description 
			WHERE giftcard_theme_id = '" . (int)$giftcard_theme_id . "'
		");
        
        foreach ($query->rows as $result) {
            $giftcard_theme_data[$result['language_id']] = array('name' => $result['name']);
        }
        
        return $giftcard_theme_data;
    }
    
    public function getTotalGiftcardThemes() {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}giftcard_theme");
        
        return $query->row['total'];
    }
}
