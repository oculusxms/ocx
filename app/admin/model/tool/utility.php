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

namespace Admin\Model\Tool;
use Oculus\Engine\Model;

class Utility extends Model {
    
    public function findSlugByName($slug) {
        $query = $this->db->query("
			SELECT query 
			FROM {$this->db->prefix}route 
			WHERE slug = '" . $this->db->escape($slug) . "'
		");
        
        if ($query->num_rows) return $query->row['query'];
    }
}
