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

class Customer extends LibraryService {
    private $customer_id;
    private $username;
    private $firstname;
    private $lastname;
    private $email;
    private $telephone;
    private $newsletter;
    private $address_id;
    private $profile_complete;
    private $address_complete;
    private $customer_products;
    
    public $customer_group_id;
    public $customer_group_name;
    
    public function __construct(Container $app) {
        parent::__construct($app);
        
        $db      = $app['db'];
        $request = $app['request'];
        $session = $app['session'];
        
        if (isset($session->data['customer_id'])):
            $this->customer_id         = $session->data['customer_id'];
            $this->username            = $session->data['username'];
            $this->firstname           = $session->data['firstname'];
            $this->lastname            = $session->data['lastname'];
            $this->email               = $session->data['email'];
            $this->telephone           = $session->data['telephone'];
            $this->newsletter          = $session->data['newsletter'];
            $this->customer_group_id   = $session->data['customer_group_id'];
            $this->customer_group_name = $session->data['customer_group_name'];
            $this->address_id          = $session->data['address_id'];
            
            $this->profile_complete    = $session->data['profile_complete'];
            $this->address_complete    = $session->data['address_complete'];
            $this->customer_products   = $session->data['customer_products'];
            
            $db->query("
                UPDATE {$db->prefix}customer 
                SET 
                    cart = '" . $db->escape(isset($session->data['cart']) ? serialize($session->data['cart']) : '') . "', 
                    wishlist = '" . $db->escape(isset($session->data['wishlist']) ? serialize($session->data['wishlist']) : '') . "', 
                    ip = '" . $db->escape($request->server['REMOTE_ADDR']) . "' 
                WHERE customer_id = '" . (int)$this->customer_id . "'
            ");
        else:
            $this->logout();
        endif;
    }
    
    public function login($email, $password, $override = false) {
        $db      = parent::$app['db'];
        $session = parent::$app['session'];
        $request = parent::$app['request'];
        $encode  = $app['encode'];
        
        if ($override):
            $customer_query = $db->query("
                SELECT * FROM {$db->prefix}customer 
                WHERE LOWER(email) = '" . $db->escape($encode->strtolower($email)) . "' 
                AND status = '1'
            ");
        else:
            $customer_query = $db->query("
                SELECT * FROM {$db->prefix}customer 
                WHERE (LOWER(email) = '" . $db->escape($encode->strtolower($email)) . "') 
                OR LOWER(username) = '" . $db->escape($encode->strtolower($email)) . "' 
                AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $db->escape($password) . "'))))) 
                OR password = '" . $db->escape(md5($password)) . "') 
                AND status = '1' 
                AND approved = '1'
            ");
        endif;
        
        if ($customer_query->num_rows):
            $session->data['customer_id'] = $customer_query->row['customer_id'];
            
            if ($customer_query->row['cart'] && is_string($customer_query->row['cart'])):
                $cart = unserialize($customer_query->row['cart']);
                
                foreach ($cart as $key => $value):
                    if (!array_key_exists($key, $session->data['cart'])):
                        $session->data['cart'][$key] = $value;
                    else:
                        $session->data['cart'][$key]+= $value;
                    endif;
                endforeach;
            endif;
            
            if ($customer_query->row['wishlist'] && is_string($customer_query->row['wishlist'])):
                if (!isset($session->data['wishlist'])):
                    $session->data['wishlist'] = array();
                endif;
                
                $wishlist = unserialize($customer_query->row['wishlist']);
                
                foreach ($wishlist as $product_id):
                    if (!in_array($product_id, $session->data['wishlist'])):
                        $session->data['wishlist'][] = $product_id;
                    endif;
                endforeach;
            endif;
            
            $session->data['customer_id']       = $customer_query->row['customer_id'];
            $session->data['username']          = $customer_query->row['username'];
            $session->data['firstname']         = $customer_query->row['firstname'];
            $session->data['lastname']          = $customer_query->row['lastname'];
            $session->data['email']             = $customer_query->row['email'];
            $session->data['telephone']         = $customer_query->row['telephone'];
            $session->data['newsletter']        = $customer_query->row['newsletter'];
            $session->data['customer_group_id'] = $customer_query->row['customer_group_id'];
            $session->data['address_id']        = $customer_query->row['address_id'];
            
            $customer_group_query = $db->query("
                SELECT name 
                FROM {$db->prefix}customer_group_description 
                WHERE customer_group_id = '" . (int)$customer_query->row['customer_group_id'] . "' 
                AND language_id = '" . (int)parent::$app['config_language_id'] . "'");
            
            $session->data['customer_group_name'] = strtolower($customer_group_query->row['name']);
            
            $db->query("
                UPDATE {$db->prefix}customer 
                SET ip = '" . $db->escape($request->server['REMOTE_ADDR']) . "' 
                WHERE customer_id = '" . (int)$customer_query->row['customer_id'] . "'
            ");
            
            // get any customer specific product ids
            $query = $db->query("
                SELECT product_id 
                FROM {$db->prefix}product 
                WHERE customer_id = '" . (int)$customer_query->row['customer_id'] . "' 
                AND status = '1' 
                AND visibility <= '" . (int)$customer_query->row['customer_group_id'] . "' 
                AND date_available < NOW()");
            
            $session->data['customer_products'] = array();
            
            if ($query->num_rows):
                foreach ($query->rows as $product_id):
                    if (!in_array($product_id, $session->data['customer_products'])):
                        $session->data['customer_products'][] = $product_id;
                    endif;
                endforeach;
            endif;
            
            // is profile complete
            $complete = 0;
            $required = 3;
            
            if ($session->data['firstname']) $complete++;
            if ($session->data['lastname'])  $complete++;
            if ($session->data['telephone']) $complete++;
            
            if ($complete === $required):
                $session->data['profile_complete'] = true;
            else:
                $session->data['profile_complete'] = false;
            endif;
            
            $required = 0;
            
            // is address complete
            $address = $this->getAddress($session->data['customer_id'], $session->data['address_id']);
            
            $complete = 0;
            $required = 7;
            
            if ($address['firstname'])  $complete++;
            if ($address['lastname'])   $complete++;
            if ($address['address_1'])  $complete++;
            if ($address['city'])       $complete++;
            if ($address['postcode'])   $complete++;
            if ($address['country_id']) $complete++;
            if ($address['zone_id'])    $complete++;
            
            if ($complete === $required):
                $session->data['address_complete'] = true;
            else:
                $session->data['address_complete'] = false;
            endif;
            
            return true;
        else:
            return false;
        endif;
    }
    
    public function logout() {
        $db = parent::$app['db'];
        $session = parent::$app['session'];
        
        $db->query("
            UPDATE {$db->prefix}customer 
            SET 
                cart = '" . $db->escape(isset($session->data['cart']) ? serialize($session->data['cart']) : '') . "', 
                wishlist = '" . $db->escape(isset($session->data['wishlist']) ? serialize($session->data['wishlist']) : '') . "' 
            WHERE customer_id = '" . (int)$this->customer_id . "'
        ");
        
        unset($session->data['customer_id']);
        unset($session->data['username']);
        unset($session->data['firstname']);
        unset($session->data['lastname']);
        unset($session->data['email']);
        unset($session->data['telephone']);
        unset($session->data['newsletter']);
        unset($session->data['customer_group_id']);
        unset($session->data['customer_group_name']);
        unset($session->data['address_id']);
        unset($session->data['profile_complete']);
        unset($session->data['address_complete']);
        unset($session->data['customer_products']);
        
        $this->customer_id         = '';
        $this->username            = '';
        $this->firstname           = '';
        $this->lastname            = '';
        $this->email               = '';
        $this->telephone           = '';
        $this->newsletter          = '';
        $this->customer_group_name = '';
        $this->address_id          = '';
        $this->profile_complete    = false;
        $this->address_complete    = false;
        $this->customer_products   = false;
        
        // set group id to publically visible
        $this->customer_group_id = parent::$app['config_default_visibility'];
    }
    
    public function isLogged() {
        return $this->customer_id;
    }
    
    public function getId() {
        return $this->customer_id;
    }
    
    public function getUsername() {
        return $this->username;
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
    
    public function getNewsletter() {
        return $this->newsletter;
    }
    
    public function getGroupId() {
        return $this->customer_group_id;
    }
    
    public function getGroupName() {
        return $this->customer->customer_group_name;
    }
    
    public function setGroupId($group_id) {
        $session = parent::$app['session'];
        
        $session->data['customer_group_id'] = $group_id;
        $this->customer_group_id = $group_id;
    }
    
    public function setGroupName($name) {
        $session = parent::$app['session'];
        
        $session->data['customer_group_name'] = $name;
        $this->customer_group_name = $name;
    }
    
    public function getAddressId() {
        return $this->address_id;
    }
    
    public function getUploadPath() {
        return $this->upload_path;
    }
    
    public function profileComplete() {
        return $this->profile_complete;
    }
    
    public function addressComplete() {
        return $this->address_complete;
    }
    
    public function getCustomerProducts() {
        return $this->customer_products;
    }
    
    public function getBalance() {
        $db = parent::$app['db'];
        
        $query = $db->query("
            SELECT SUM(amount) AS total 
            FROM {$db->prefix}customer_transaction 
            WHERE customer_id = '" . (int)$this->customer_id . "'
        ");
        
        return $query->row['total'];
    }
    
    public function getRewardPoints() {
        $db = parent::$app['db'];
        
        $query = $db->query("
            SELECT SUM(points) AS total 
            FROM {$db->prefix}customer_reward 
            WHERE customer_id = '" . (int)$this->customer_id . "'
        ");
        
        return $query->row['total'];
    }
    
    public function addReward($customer_id, $description, $points, $order_id = 0) {
        $db = parent::$app['db'];
        
        $db->query("
            INSERT INTO {$db->prefix}customer_reward 
            SET 
                customer_id = '" . (int)$customer_id . "', 
                order_id = '" . (int)$order_id . "', 
                points = '" . (int)$points . "', 
                description = '" . $db->escape($description) . "', 
                date_added = NOW()
        ");
    }
    
    public function updateCustomerGroup($group_id) {
        $db = parent::$app['db'];
        
        $db->query("
            UPDATE {$db->prefix}customer 
            SET customer_group_id = '" . (int)$group_id . "' 
            WHERE customer_id = '" . (int)$this->customer_id . "'");
    }
    
    private function getAddress($customer_id, $address_id) {
        $db = parent::$app['db'];
        
        $address_query = $db->query("
            SELECT DISTINCT * 
            FROM {$db->prefix}address 
            WHERE address_id = '" . (int)$address_id . "' 
            AND customer_id = '" . (int)$customer_id . "'
        ");
        
        if ($address_query->num_rows) {
            $country_query = $db->query("
                SELECT * 
                FROM `{$db->prefix}country` 
                WHERE country_id = '" . (int)$address_query->row['country_id'] . "'
            ");
            
            if ($country_query->num_rows) {
                $country = $country_query->row['name'];
                $iso_code_2 = $country_query->row['iso_code_2'];
                $iso_code_3 = $country_query->row['iso_code_3'];
                $address_format = $country_query->row['address_format'];
            } else {
                $country        = '';
                $iso_code_2     = '';
                $iso_code_3     = '';
                $address_format = '';
            }
            
            $zone_query = $db->query("
                SELECT * 
                FROM `{$db->prefix}zone` 
                WHERE zone_id = '" . (int)$address_query->row['zone_id'] . "'
            ");
            
            if ($zone_query->num_rows) {
                $zone      = $zone_query->row['name'];
                $zone_code = $zone_query->row['code'];
            } else {
                $zone      = '';
                $zone_code = '';
            }
            
            $address_data = array(
                'firstname'      => $address_query->row['firstname'],
                'lastname'       => $address_query->row['lastname'],
                'company'        => $address_query->row['company'],
                'company_id'     => $address_query->row['company_id'],
                'tax_id'         => $address_query->row['tax_id'],
                'address_1'      => $address_query->row['address_1'],
                'address_2'      => $address_query->row['address_2'],
                'postcode'       => $address_query->row['postcode'],
                'city'           => $address_query->row['city'],
                'zone_id'        => $address_query->row['zone_id'],
                'zone'           => $zone,
                'zone_code'      => $zone_code,
                'country_id'     => $address_query->row['country_id'],
                'country'        => $country,
                'iso_code_2'     => $iso_code_2,
                'iso_code_3'     => $iso_code_3,
                'address_format' => $address_format
            );
            
            return $address_data;
        } else {
            return false;
        }
    }
    
    public function processMembership($products) {
        $db = parent::$app['db'];
        
        // find all recurring products in ordered products passed in
        // should be only one but you never know
        $recurring_products = array();
        
        foreach ($products as $product_id):
            $query = $db->query("
                SELECT COUNT(recurring_id) AS total 
                FROM {$db->prefix}product_recurring 
                WHERE product_id = '" . (int)$product_id . "'");
            
            if ($query->row['total'] > 0):
                $recurring_products[] = $product_id;
            endif;
        endforeach;
        
        // now get the model name of our recurring products
        $recurring_models = array();
        
        if (!empty($recurring_products)):
            foreach ($recurring_products as $product_id):
                $query = $db->query("
                    SELECT model 
                    FROM {$db->prefix}product 
                    WHERE product_id = '" . (int)$product_id . "'");
                
                foreach ($query->rows as $row):
                    $recurring_models[] = strtolower($row['model']);
                endforeach;
            endforeach;
        else:
            
            // no recurring products let's bail.
            return;
        endif;
        
        $group_names = array();
        
        // fetch an array of our customer groups
        $groups = $db->query("
            SELECT * 
            FROM {$db->prefix}customer_group_description 
            WHERE language_id = '" . (int)parent::$app['config_language_id'] . "'");
        
        foreach ($groups->rows as $group):
            $group_names[strtolower($group['name']) ] = $group['customer_group_id'];
        endforeach;
        
        // recurring_models should not be empty since we bailed
        // if there were no recurring products, iterating the loop should not error
        foreach ($recurring_models as $key => $value):
            if (array_key_exists($value, $group_names)):
                $group_id = $group_names[$value];
                
                if ($value == $this->customer->customer_group_name):
                    
                    // our customer is already this member type
                    // nothing to do but bail.
                    return;
                else:
                    
                    // update session, update class, update db
                    $this->setGroupId($group_id);
                    $this->updateCustomerGroup($group_id);
                    $this->setGroupName($value);
                endif;
            endif;
        endforeach;
    }
}
