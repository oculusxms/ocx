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

namespace Admin\Model\Report;
use Oculus\Engine\Model;

class Returns extends Model {
    public function getReturns($data = array()) {
        $sql = "SELECT MIN(r.date_added) AS date_start, MAX(r.date_added) AS date_end, COUNT(r.return_id) AS `returns` FROM `{$this->db->prefix}return` r";
        
        if (!empty($data['filter_return_status_id'])) {
            $sql.= " WHERE r.return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
        } else {
            $sql.= " WHERE r.return_status_id > '0'";
        }
        
        if (!empty($data['filter_date_start'])) {
            $sql.= " AND DATE(r.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
        }
        
        if (!empty($data['filter_date_end'])) {
            $sql.= " AND DATE(r.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
        }
        
        if (isset($data['filter_group'])) {
            $group = $data['filter_group'];
        } else {
            $group = 'week';
        }
        
        switch ($group) {
            case 'day';
            $sql.= " GROUP BY DAY(r.date_added)";
            break;

        default:
        case 'week':
            $sql.= " GROUP BY WEEK(r.date_added)";
            break;

        case 'month':
            $sql.= " GROUP BY MONTH(r.date_added)";
            break;

        case 'year':
            $sql.= " GROUP BY YEAR(r.date_added)";
            break;
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
    if (!empty($data['filter_group'])) {
        $group = $data['filter_group'];
    } else {
        $group = 'week';
    }
    
    switch ($group) {
        case 'day';
        $sql = "SELECT COUNT(DISTINCT DAY(date_added)) AS total FROM `{$this->db->prefix}return`";
        break;

    default:
    case 'week':
        $sql = "SELECT COUNT(DISTINCT WEEK(date_added)) AS total FROM `{$this->db->prefix}return`";
        break;

    case 'month':
        $sql = "SELECT COUNT(DISTINCT MONTH(date_added)) AS total FROM `{$this->db->prefix}return`";
        break;

    case 'year':
        $sql = "SELECT COUNT(DISTINCT YEAR(date_added)) AS total FROM `{$this->db->prefix}return`";
        break;
}

if (!empty($data['filter_return_status_id'])) {
    $sql.= " WHERE return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
} else {
    $sql.= " WHERE return_status_id > '0'";
}

if (!empty($data['filter_date_start'])) {
    $sql.= " AND DATE(date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
}

if (!empty($data['filter_date_end'])) {
    $sql.= " AND DATE(date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
}

$query = $this->db->query($sql);

return $query->row['total'];
}
}
