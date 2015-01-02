<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|   
|   (c) Vince Kronlein <vince@ocx.io>
|   
|   For the full copyright and license information, please view the LICENSE
|   file that was distributed with this source code.
|   
*/

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Affiliate extends LibraryService {
    private $affiliate_id;
    private $firstname;
    private $lastname;
    private $email;
    private $telephone;
    private $code;
    
    public function __construct(Container $app) {
        parent::__construct($app);
        
        if (isset($app['session']->data['affiliate_id'])):
            $affiliate_query = $app['db']->query("
                SELECT * 
                FROM {$app['db']->prefix}affiliate 
                WHERE affiliate_id = '" . (int)$app['session']->data['affiliate_id'] . "' 
                AND status = '1'
            ");
            
            if ($affiliate_query->num_rows):
                $this->affiliate_id = $affiliate_query->row['affiliate_id'];
                $this->firstname    = $affiliate_query->row['firstname'];
                $this->lastname     = $affiliate_query->row['lastname'];
                $this->email        = $affiliate_query->row['email'];
                $this->telephone    = $affiliate_query->row['telephone'];
                $this->code         = $affiliate_query->row['code'];
                
                $app['db']->query("
                    UPDATE {$app['db']->prefix}affiliate 
                    SET ip = '" . $app['db']->escape($app['request']->server['REMOTE_ADDR']) . "' 
                    WHERE affiliate_id = '" . (int)$app['session']->data['affiliate_id'] . "'
                ");
            else:
                $this->logout();
            endif;
        endif;
    }
    
    public function login($email, $password) {
        $db = parent::$app['db'];
        $session = parent::$app['session'];
        
        $affiliate_query = $db->query("
            SELECT * 
            FROM {$db->prefix}affiliate 
            WHERE LOWER(email) = '" . $db->escape(utf8_strtolower($email)) . "' 
            AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $db->escape($password) . "'))))) 
            OR password = '" . $db->escape(md5($password)) . "') 
            AND status = '1' 
            AND approved = '1'
        ");
        
        if ($affiliate_query->num_rows):
            $session->data['affiliate_id'] = $affiliate_query->row['affiliate_id'];
            
            $this->affiliate_id = $affiliate_query->row['affiliate_id'];
            $this->firstname    = $affiliate_query->row['firstname'];
            $this->lastname     = $affiliate_query->row['lastname'];
            $this->email        = $affiliate_query->row['email'];
            $this->telephone    = $affiliate_query->row['telephone'];
            $this->code         = $affiliate_query->row['code'];
            
            return true;
        else:
            return false;
        endif;
    }
    
    public function logout() {
        $session = parent::$app['session'];
        
        unset($session->data['affiliate_id']);
        
        $this->affiliate_id = '';
        $this->firstname    = '';
        $this->lastname     = '';
        $this->email        = '';
        $this->telephone    = '';
    }
    
    public function isLogged() {
        return $this->affiliate_id;
    }
    
    public function getId() {
        return $this->affiliate_id;
    }
    
    public function getFirstName() {
        return $this->firstname;
    }
    
    public function getLastName() {
        return $this->lastname;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getTelephone() {
        return $this->telephone;
    }
    
    public function getCode() {
        return $this->code;
    }
}
