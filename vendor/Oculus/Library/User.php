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

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class User extends LibraryService {
    private $user_id;
    private $username;
    private $user_group_id;
    private $user_last_access;
    private $permission = array();
    
    public function __construct(Container $app) {
        parent::__construct($app);

        $session = $app['session'];
        
        if (isset($session->data['user_id'])):
            $this->user_id          = $session->data['user_id'];
            $this->username         = $session->data['username'];
            $this->user_group_id    = $session->data['user_group_id'];
            $this->user_last_access = $session->data['user_last_access'];
            $this->permission       = $session->data['permission'];
        else:
            $this->logout();
        endif;
    }
    
    public function login($username, $password) {
        $db      = parent::$app['db'];
        $request = parent::$app['request'];
        $session = parent::$app['session'];
        
        $user_query = $db->query("
			SELECT * 
			FROM {$db->prefix}user 
			WHERE username = '" . $db->escape($username) . "' 
			AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $db->escape($password) . "'))))) 
			OR password = '" . $db->escape(md5($password)) . "') 
			AND status = '1'
		");
        
        if ($user_query->num_rows):
            $session->data['user_id']          = $user_query->row['user_id'];
            $session->data['username']         = $user_query->row['username'];
            $session->data['user_group_id']    = $user_query->row['user_group_id'];
            $session->data['user_last_access'] = strtotime($user_query->row['last_access']);
            
            $db->query("
				UPDATE {$db->prefix}user 
				SET 
					ip = '" . $db->escape($request->server['REMOTE_ADDR']) . "', 
					last_access = NOW() 
				WHERE user_id = '" . (int)$user_query->row['user_id'] . "'
			");
            
            $user_group_query = $db->query("
				SELECT permission 
				FROM {$db->prefix}user_group 
				WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'
			");
            
            $permissions = unserialize($user_group_query->row['permission']);
            
            if (is_array($permissions)):
                foreach ($permissions as $key => $value):
                    $session->data['permission'][$key] = $value;
                endforeach;
            endif;
            
            return true;
        else:
            return false;
        endif;
    }
    
    public function logout() {
        $session = parent::$app['session'];
        
        unset($session->data['user_id']);
        unset($session->data['username']);
        unset($session->data['user_group_id']);
        unset($session->data['user_last_access']);
        unset($session->data['permission']);
        
        $this->user_id          = '';
        $this->username         = '';
        $this->user_group_id    = '';
        $this->user_last_access = '';
        $this->permission       = array(null);
    }
    
    public function hasPermission($key, $value) {
        if (isset($this->permission[$key])):
            return in_array($value, $this->permission[$key]);
        else:
            return false;
        endif;
    }
    
    public function reload_permissions() {
        $db      = parent::$app['db'];
        $session = parent::$app['session'];
        
        $query = $db->query("
			SELECT permission 
			FROM {$db->prefix}user_group 
			WHERE user_group_id = '" . (int)$this->user_group_id . "'
		");
        
        $permissions = unserialize($query->row['permission']);
        
        if (is_array($permissions)):
            foreach ($permissions as $key => $value):
                $session->data['permission'][$key] = $value;
            endforeach;
        endif;
        
        return true;
    }
    
    public function isLogged() {
        return $this->user_id;
    }
    
    public function getId() {
        return $this->user_id;
    }
    
    public function getUserName() {
        return $this->username;
    }
    
    public function getGroupId() {
        return $this->user_group_id;
    }
    
    public function getLastAccess() {
        return $this->user_last_access;
    }
}
