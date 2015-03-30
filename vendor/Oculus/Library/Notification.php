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
use Oculus\Library\Decorator;
use Oculus\Library\Email;

class Notification extends LibraryService {
    
    private $html;
    private $text;
    private $decorator;
    private $email;
    private $customer;
    private $order_id = 0;
    private $user;
    private $to_name;
    private $to_email;
    private $preference = array();
    
    public function __construct(Container $app) {
        parent::__construct($app);
        
        $this->decorator = new Decorator($app);
        $this->email     = new Email($app);

        $this->fetchWrapper();
    }

    /**
     * fetch the wrapper from the email object.
     * @return array $data for calling from outside the class.
     */
    public function fetchWrapper() {
        $data = $this->email->fetchWrapper();
        
        $this->text = html_entity_decode($data['text'], ENT_QUOTES, 'UTF-8');
        $this->html = html_entity_decode($data['html'], ENT_QUOTES, 'UTF-8');

        return $data;
    }

    /**
     * fetch the data for the called notification
     * @param  string $name slug string of notification
     * @return array  subject, text, html, priority
     */
    public function fetch($name) {
        return $this->email->fetch($name);
    }

    public function getNotificationType($name) {
        $db = parent::$app['db'];

        $query = $db->query("
            SELECT email_id, recipient 
            FROM {$db->prefix}email 
            WHERE email_slug = '" . $db->escape($name) . "'");

        return $query->row;
    }

    public function setCustomer($email_id, $customer_id) {
        $db = parent::$app['db'];

        $customer = array();

        $query = $db->query("
            SELECT DISTINCT * 
            FROM {$db->prefix}customer 
            WHERE customer_id = '" . (int)$customer_id . "'");

        foreach ($query->row as $key => $value):
            $customer[$key] = $value;
        endforeach;

        $query = $db->query("
            SELECT SUM(points) AS total 
            FROM {$db->prefix}customer_reward 
            WHERE customer_id = '" . (int)$customer_id . "'
        ");

        $points = $query->row['total'] ? $query->row['total'] : 0;

        $customer['points'] = $points;

        $this->customer = $customer;

        // Let's set our to_name and to_email for the send method
        $this->to_name  = (isset($this->customer['firstname'])) ? $this->customer['firstname'] . ' ' . $this->customer['lastname'] : $this->customer['username'];
        $this->to_email = $this->customer['email'];

        // set the preference for this specific email
        $this->setCustomerPreference($email_id, $customer_id);
    }

    public function setOrderId($order_id) {
        $this->order_id = $order_id;
    }

    public function setUser($user_id) {
        $db = parent::$app['db'];

        $query = $db->query("
            SELECT DISTINCT * 
            FROM {$db->prefix}user 
            WHERE user_id = '" . (int)$user_id . "'");

        $this->user = $query->row;

        // Let's set our to_name and to_email for the send method
        $this->to_name  = (isset($this->user['firstname'])) ? $this->user['firstname'] . ' ' . $this->user['lastname'] : $this->user['username'];
        $this->to_email = $this->user['email'];

        // there's no need to check preference here as admins
        // always receive email only
        
        $this->preference = array(
            'email'    => 1,
            'internal' => 0
        );
    }

    private function setCustomerPreference($email_id, $customer_id) {
        $db = parent::$app['db'];

        $query = $db->query("
            SELECT settings 
            FROM {$db->prefix}customer_notification 
            WHERE customer_id = '" . (int)$customer_id . "'");

        $data = unserialize($query->row['settings']);

        // If the email_id exists in the array then we will use
        // the preferences provided, otherwise this notification
        // isn't configurable and we should send them email only.
        // This would be the case for a forgotten password etc.
        if (array_key_exists($email_id, $data)):
            $preference = $data[$email_id];
        else:
            $preference = array(
                'email'    => 1,
                'internal' => 0
            );
        endif;

        $this->preference = $preference;
    }

    public function getPreference() {
        return $this->preference;
    }

    public function customerInternal($message) {
        $message['html'] .= '!signature!';
        $message = $this->decorator->decorateCustomerNotification($message, $this->customer, $this->order_id);

        /**
         * Let's go ahead and insert the message.
         */
        $db = parent::$app['db'];

        $customer_id = $this->customer['customer_id'];
        $subject     = $message['subject'];
        $content     = $message['html'];
        
        $db->query("
            INSERT INTO {$db->prefix}customer_inbox 
            SET 
                customer_id = '" . (int)$customer_id . "', 
                subject = '" . $db->escape($subject) . "', 
                message = '" . $db->escape($content) . "'
        ");

        return $message;
    }

    public function formatEmail($email, $type) {
        $message = array();
        // subject
        $message['subject'] = $email['subject'];
        // text
        $message['text']    = str_replace('!content!', $email['text'], $this->text);
        
        // html
        $this->html         = str_replace('!subject!', $email['subject'], $this->html);
        $message['html']    = str_replace('!content!', $email['html'], $this->html);
        

        switch($type):
            case 1:
                $message = $this->decorator->decorateCustomerNotification($message, $this->customer, $this->order_id);
                break;
            case 2:
                $message = $this->decorator->decorateUserNotification($message, $this->user);
                break;
        endswitch;
        
        return $message;
    }

    public function addToEmailQueue($message) {
        // first add all parts of the email to queue and get the insert id
        $id = $this->email->addToEmailQueue($message, $this->to_email, $this->to_name);

        // now pass the insert id and html to decorator to decorate the webversion url
        $html = $this->decorator->decorateWebversion($id, $message['html']);

        // now update the queue with the html
        $this->email->updateHtml($id, $html);

        return true;
    }

    public function send($message, $add = array()) {
        return $this->email->send($message, $this->to_email, $this->to_name, true, $add);
    }
}
