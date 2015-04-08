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
use Oculus\Library\Mail;

class Returns extends Model {
    public function addReturn($data) {
        $this->db->query("
            INSERT INTO `{$this->db->prefix}return` 
            SET 
                order_id         = '" . (int)$data['order_id'] . "', 
                product_id       = '" . (int)$data['product_id'] . "', 
                customer_id      = '" . (int)$data['customer_id'] . "', 
                firstname        = '" . $this->db->escape($data['firstname']) . "', 
                lastname         = '" . $this->db->escape($data['lastname']) . "', 
                email            = '" . $this->db->escape($data['email']) . "', 
                telephone        = '" . $this->db->escape($data['telephone']) . "', 
                product          = '" . $this->db->escape($data['product']) . "', 
                model            = '" . $this->db->escape($data['model']) . "', 
                quantity         = '" . (int)$data['quantity'] . "', 
                opened           = '" . (int)$data['opened'] . "', 
                return_reason_id = '" . (int)$data['return_reason_id'] . "', 
                return_action_id = '" . (int)$data['return_action_id'] . "', 
                return_status_id = '" . (int)$data['return_status_id'] . "', 
                comment          = '" . $this->db->escape($data['comment']) . "', 
                date_ordered     = '" . $this->db->escape($data['date_ordered']) . "', 
                date_added       = NOW(), 
                date_modified    = NOW()
        ");
    }
    
    public function editReturn($return_id, $data) {
        $this->db->query("
            UPDATE `{$this->db->prefix}return` 
            SET 
                order_id         = '" . (int)$data['order_id'] . "', 
                product_id       = '" . (int)$data['product_id'] . "', 
                customer_id      = '" . (int)$data['customer_id'] . "', 
                firstname        = '" . $this->db->escape($data['firstname']) . "', 
                lastname         = '" . $this->db->escape($data['lastname']) . "', 
                email            = '" . $this->db->escape($data['email']) . "', 
                telephone        = '" . $this->db->escape($data['telephone']) . "', 
                product          = '" . $this->db->escape($data['product']) . "', 
                model            = '" . $this->db->escape($data['model']) . "', 
                quantity         = '" . (int)$data['quantity'] . "', 
                opened           = '" . (int)$data['opened'] . "', 
                return_reason_id = '" . (int)$data['return_reason_id'] . "', 
                return_action_id = '" . (int)$data['return_action_id'] . "', 
                return_status_id = '" . (int)$data['return_status_id'] . "', 
                comment          = '" . $this->db->escape($data['comment']) . "', 
                date_ordered     = '" . $this->db->escape($data['date_ordered']) . "', 
                date_modified    = NOW() 
            WHERE return_id = '" . (int)$return_id . "'
        ");
    }
    
    public function editReturnAction($return_id, $return_action_id) {
        $this->db->query("
            UPDATE `{$this->db->prefix}return` 
            SET return_action_id = '" . (int)$return_action_id . "' 
            WHERE return_id = '" . (int)$return_id . "'
        ");
    }
    
    public function deleteReturn($return_id) {
        $this->db->query("
            DELETE FROM `{$this->db->prefix}return` 
            WHERE return_id = '" . (int)$return_id . "'");

        $this->db->query("
            DELETE FROM {$this->db->prefix}return_history 
            WHERE return_id = '" . (int)$return_id . "'");
    }
    
    public function getReturn($return_id) {
        $query = $this->db->query("
            SELECT DISTINCT *, 
                (SELECT CONCAT(c.firstname, ' ', c.lastname) 
                    FROM {$this->db->prefix}customer c 
                    WHERE c.customer_id = r.customer_id) AS customer 
            FROM `{$this->db->prefix}return` r 
            WHERE r.return_id = '" . (int)$return_id . "'
        ");
        
        return $query->row;
    }
    
    public function getReturns($data = array()) {
        $sql = "
            SELECT *, 
                CONCAT(r.firstname, ' ', r.lastname) AS customer, 
                (SELECT rs.name 
                    FROM {$this->db->prefix}return_status rs 
                    WHERE rs.return_status_id = r.return_status_id 
                    AND rs.language_id = '" . (int)$this->config->get('config_language_id') . "') AS status 
            FROM `{$this->db->prefix}return` r";
        
        $implode = array();
        
        if (!empty($data['filter_return_id'])) {
            $implode[] = "r.return_id = '" . (int)$data['filter_return_id'] . "'";
        }
        
        if (!empty($data['filter_order_id'])) {
            $implode[] = "r.order_id = '" . (int)$data['filter_order_id'] . "'";
        }
        
        if (!empty($data['filter_customer'])) {
            $implode[] = "CONCAT(r.firstname, ' ', r.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "%'";
        }
        
        if (!empty($data['filter_product'])) {
            $implode[] = "r.product = '" . $this->db->escape($data['filter_product']) . "'";
        }
        
        if (!empty($data['filter_model'])) {
            $implode[] = "r.model = '" . $this->db->escape($data['filter_model']) . "'";
        }
        
        if (!empty($data['filter_return_status_id'])) {
            $implode[] = "r.return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
        }
        
        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }
        
        if (!empty($data['filter_date_modified'])) {
            $implode[] = "DATE(r.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        
        if ($implode) {
            $imp = implode(" && ", $implode);
            $sql.= " WHERE {$imp}";
        }
        
        $sort_data = array(
            'r.return_id', 
            'r.order_id', 
            'customer', 
            'r.product', 
            'r.model', 
            'status', 
            'r.date_added', 
            'r.date_modified'
        );
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql.= " ORDER BY {$data['sort']}";
        } else {
            $sql.= " ORDER BY r.return_id";
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
    
    public function getTotalReturns($data = array()) {
        $sql = "
            SELECT COUNT(*) AS total 
            FROM `{$this->db->prefix}return` r";
        
        $implode = array();
        
        if (!empty($data['filter_return_id'])) {
            $implode[] = "r.return_id = '" . (int)$data['filter_return_id'] . "'";
        }
        
        if (!empty($data['filter_customer'])) {
            $implode[] = "CONCAT(r.firstname, ' ', r.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "%'";
        }
        
        if (!empty($data['filter_order_id'])) {
            $implode[] = "r.order_id = '" . $this->db->escape($data['filter_order_id']) . "'";
        }
        
        if (!empty($data['filter_product'])) {
            $implode[] = "r.product = '" . $this->db->escape($data['filter_product']) . "'";
        }
        
        if (!empty($data['filter_model'])) {
            $implode[] = "r.model = '" . $this->db->escape($data['filter_model']) . "'";
        }
        
        if (!empty($data['filter_return_status_id'])) {
            $implode[] = "r.return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
        }
        
        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }
        
        if (!empty($data['filter_date_modified'])) {
            $implode[] = "DATE(r.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        
        if ($implode) {
            $imp = implode(" && ", $implode);
            $sql.= " WHERE {$imp}";
        }
        
        $query = $this->db->query($sql);
        
        return $query->row['total'];
    }
    
    public function getTotalReturnsByReturnStatusId($return_status_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM `{$this->db->prefix}return` 
            WHERE return_status_id = '" . (int)$return_status_id . "'
        ");
        
        return $query->row['total'];
    }
    
    public function getTotalReturnsByReturnReasonId($return_reason_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM `{$this->db->prefix}return` 
            WHERE return_reason_id = '" . (int)$return_reason_id . "'
        ");
        
        return $query->row['total'];
    }
    
    public function getTotalReturnsByReturnActionId($return_action_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM `{$this->db->prefix}return` 
            WHERE return_action_id = '" . (int)$return_action_id . "'
        ");
        
        return $query->row['total'];
    }
    
    public function addReturnHistory($return_id, $data) {
        $this->db->query("
            UPDATE `{$this->db->prefix}return` 
            SET 
                return_status_id = '" . (int)$data['return_status_id'] . "', 
                date_modified    = NOW() 
            WHERE return_id = '" . (int)$return_id . "'
        ");
        
        $this->db->query("
            INSERT INTO {$this->db->prefix}return_history 
            SET 
                return_id        = '" . (int)$return_id . "', 
                return_status_id = '" . (int)$data['return_status_id'] . "', 
                notify           = '" . (isset($data['notify']) ? (int)$data['notify'] : 0) . "', 
                comment          = '" . $this->db->escape(strip_tags($data['comment'])) . "', 
                date_added       = NOW()
        ");
        
        if ($data['notify']) {
            
            $return_info = $this->getReturn($return_id);
            
            if ($return_info) {
                
                $status = $this->getStatusNameById($data['return_status_id']);
                $link   = html_entity_decode($this->app['http.public'] . 'account/returns/info&return_id=' . $return_id, ENT_QUOTES, 'UTF-8');

                if ($data['comment']):
                    $comment = strip_tags(html_entity_decode($data['comment'], ENT_QUOTES, 'UTF-8'));
                else:
                    $comment = 'No further comments added.';
                endif;

                $callback = array(
                    'customer_id' => $return_info['customer_id'],
                    'return_id'   => $return_id,
                    'return'      => $return_info,
                    'status'      => $status,
                    'link'        => $link,
                    'comment'     => $comment,
                    'callback'    => array(
                        'class'  => __CLASS__,
                        'method' => 'admin_return_add_history'
                    )
                );

                $this->theme->notify('admin_return_add_history', $callback);
            }
        }
    }
    
    public function getReturnHistories($return_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }
        
        if ($limit < 1) {
            $limit = 10;
        }
        
        $query = $this->db->query("
            SELECT 
                rh.date_added, 
                rs.name AS status, 
                rh.comment, 
                rh.notify 
            FROM {$this->db->prefix}return_history rh 
            LEFT JOIN {$this->db->prefix}return_status rs 
            ON rh.return_status_id = rs.return_status_id 
            WHERE rh.return_id = '" . (int)$return_id . "' 
            AND rs.language_id = '" . (int)$this->config->get('config_language_id') . "' 
            ORDER BY rh.date_added ASC 
            LIMIT " . (int)$start . "," . (int)$limit);
        
        return $query->rows;
    }
    
    public function getTotalReturnHistories($return_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}return_history 
            WHERE return_id = '" . (int)$return_id . "'
        ");
        
        return $query->row['total'];
    }
    
    public function getTotalReturnHistoriesByReturnStatusId($return_status_id) {
        $query = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM {$this->db->prefix}return_history 
            WHERE return_status_id = '" . (int)$return_status_id . "' 
            GROUP BY return_id
        ");
        
        return $query->row['total'];
    }

    public function getStatusNameById($status_id) {
        $query = $this->db->query("
            SELECT name 
            FROM {$this->db->prefix}return_status 
            WHERE return_status_id = '" . (int)$status_id . "'
        ");

        return $query->row['name'];
    }

    /*
    |--------------------------------------------------------------------------
    |   NOTIFICATIONS
    |--------------------------------------------------------------------------
    |
    |   The below are notification callbacks.
    |
    */

    public function admin_return_add_history($data, $message) {
        $search = array(
            '!return_id!',
            '!status!',
            '!link!',
            '!comment!'
        );

        $replace = array(
            $data['return_id'],
            $data['status'],
            $data['link'],
            $data['comment']
        );

        $html_replace = array(
            $data['return_id'],
            $data['status'],
            $data['link'],
            nl2br($data['comment'])
        );

        foreach ($message as $key => $value):
            if ($key == 'html'):
                $message['html'] = str_replace($search, $html_replace, $value);
            else:
                $message[$key] = str_replace($search, $replace, $value);
            endif;
        endforeach;
        
        return $message;
    }
}
