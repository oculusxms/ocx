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

namespace Admin\Model\Localization;
use Oculus\Engine\Model;

class Currency extends Model {
    public function addCurrency($data) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}currency 
			SET 
				title = '" . $this->db->escape($data['title']) . "', 
				code = '" . $this->db->escape($data['code']) . "', 
				symbol_left = '" . $this->db->escape($data['symbol_left']) . "', 
				symbol_right = '" . $this->db->escape($data['symbol_right']) . "', 
				decimal_place = '" . $this->db->escape($data['decimal_place']) . "', 
				value = '" . $this->db->escape($data['value']) . "', 
				status = '" . (int)$data['status'] . "', 
				date_modified = NOW()
		");
        
        if ($this->config->get('config_currency_auto')) {
            $this->updateCurrencies(true);
        }
        
        $this->cache->delete('currency');
        $this->cache->delete('default.store.currency');
    }
    
    public function editCurrency($currency_id, $data) {
        $this->db->query("
			UPDATE {$this->db->prefix}currency 
			SET 
				title = '" . $this->db->escape($data['title']) . "', 
				code = '" . $this->db->escape($data['code']) . "', 
				symbol_left = '" . $this->db->escape($data['symbol_left']) . "', 
				symbol_right = '" . $this->db->escape($data['symbol_right']) . "', 
				decimal_place = '" . $this->db->escape($data['decimal_place']) . "', 
				value = '" . $this->db->escape($data['value']) . "', 
				status = '" . (int)$data['status'] . "', 
				date_modified = NOW() 
			WHERE currency_id = '" . (int)$currency_id . "'
		");
        
        $this->cache->delete('currency');
        $this->cache->delete('default.store.currency');
    }
    
    public function deleteCurrency($currency_id) {
        $this->db->query("DELETE FROM {$this->db->prefix}currency WHERE currency_id = '" . (int)$currency_id . "'");
        
        $this->cache->delete('currency');
        $this->cache->delete('default.store.currency');
    }
    
    public function getCurrency($currency_id) {
        $query = $this->db->query("
			SELECT DISTINCT * 
			FROM {$this->db->prefix}currency 
			WHERE currency_id = '" . (int)$currency_id . "'
		");
        
        return $query->row;
    }
    
    public function getCurrencyByCode($currency) {
        $query = $this->db->query("
			SELECT DISTINCT * 
			FROM {$this->db->prefix}currency 
			WHERE code = '" . $this->db->escape($currency) . "'
		");
        
        return $query->row;
    }
    
    public function getCurrencies($data = array()) {
        if ($data) {
            $sql = "
				SELECT * 
				FROM {$this->db->prefix}currency";
            
            $sort_data = array('title', 'code', 'value', 'date_modified');
            
            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql.= " ORDER BY {$data['sort']}";
            } else {
                $sql.= " ORDER BY title";
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
        } else {
            $currency_data = array();
            
            $query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}currency 
				ORDER BY title ASC
			");
            
            foreach ($query->rows as $result) {
                $currency_data[$result['code']] = array('currency_id' => $result['currency_id'], 'title' => $result['title'], 'code' => $result['code'], 'symbol_left' => $result['symbol_left'], 'symbol_right' => $result['symbol_right'], 'decimal_place' => $result['decimal_place'], 'value' => $result['value'], 'status' => $result['status'], 'date_modified' => $result['date_modified']);
            }
            
            return $currency_data;
        }
    }
    
    public function updateCurrencies($force = false) {
        if (extension_loaded('curl')) {
            $data = array();
            
            if ($force) {
                $query = $this->db->query("
					SELECT * 
					FROM {$this->db->prefix}currency 
					WHERE code != '" . $this->db->escape($this->config->get('config_currency')) . "'
				");
            } else {
                $query = $this->db->query("
					SELECT * 
					FROM {$this->db->prefix}currency 
					WHERE code != '" . $this->db->escape($this->config->get('config_currency')) . "' 
					AND date_modified < '" . $this->db->escape(date('Y-m-d H:i:s', strtotime('-1 day'))) . "'
				");
            }
            
            foreach ($query->rows as $result) {
                $data[] = $this->config->get('config_currency') . $result['code'] . '=X';
            }
            
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_URL, 'http://download.finance.yahoo.com/d/quotes.csv?s=' . implode(',', $data) . '&f=sl1&e=.csv');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            
            $content = curl_exec($curl);
            
            curl_close($curl);
            
            $lines = explode("\n", trim($content));
            
            foreach ($lines as $line) {
                $currency = $this->encode->substr($line, 4, 3);
                $value = $this->encode->substr($line, 11, 6);
                
                if ((float)$value) {
                    $this->db->query("
						UPDATE {$this->db->prefix}currency 
						SET 
							value = '" . (float)$value . "', 
							date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' 
						WHERE code = '" . $this->db->escape($currency) . "'
					");
                }
            }
            
            $this->db->query("
				UPDATE {$this->db->prefix}currency 
				SET 
					value = '1.00000', 
					date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' 
				WHERE code = '" . $this->db->escape($this->config->get('config_currency')) . "'
			");
            
            $this->cache->delete('currency');
        }
    }
    
    public function getTotalCurrencies() {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}currency");
        
        return $query->row['total'];
    }
}
