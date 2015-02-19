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

namespace Front\Controller\Affiliate;
use Oculus\Engine\Controller;

class Notification extends Controller {

	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()):
            $this->session->data['redirect'] = $this->url->link('affiliate/notification', '', 'SSL');
            $this->response->redirect($this->url->link('affiliate/login', '', 'SSL'));
        endif;

		$data = $this->theme->language('affiliate/notification');

		$this->theme->setTitle($this->language->get('lang_heading_title'));
        $this->theme->model('affiliate/notification');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()):
            $this->model_affiliate_notification->editNotification($this->request->post);
            $this->session->data['success'] = $this->language->get('lang_text_success');
        endif;

        $this->breadcrumb->add('lang_text_affiliate', 'affiliate/dashboard', null, true, 'SSL');
        $this->breadcrumb->add('lang_heading_title', 'affiliate/notification', null, true, 'SSL');

        if (isset($this->error['warning'])):
            $data['error_warning'] = $this->error['warning'];
        else:
            $data['error_warning'] = '';
        endif;

        if (isset($this->session->data['success'])):
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        else:
            $data['success'] = '';
        endif;

        $customer_notifications = $this->model_affiliate_notification->getCustomerNotifications();
        $emails = $this->model_affiliate_notification->getConfigurableNotifications();

        $data['notifications'] = array();

        foreach($emails as $email):
            $mail     = array();
            $internal = array();

            $mail['title']     = $this->language->get('lang_text_email');
            $internal['title'] = $this->language->get('lang_text_internal');

            if (array_key_exists($email['email_id'], $customer_notifications)):
                $mail['value']     = $customer_notifications[$email['email_id']]['email'];
                $internal['value'] = $customer_notifications[$email['email_id']]['internal'];
            else:
                $mail['value']     = 0;
                $internal['value'] = 0;
            endif;

            $notify = array(
                'email'    => $mail,
                'internal' => $internal
            );

            $data['notifications'][] = array(
                'id'          => $email['email_id'],
                'slug'        => $email['email_slug'],
                'description' => $email['config_description'],
                'content'     => $notify
            );
        endforeach;

		$data['action'] = $this->url->link('affiliate/notification', '', 'SSL');
		$data['back']   = $this->url->link('affiliate/dashboard', '', 'SSL');

        $this->theme->loadjs('javascript/affiliate/notification', $data);

        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->set_controller('header', 'shop/header');
        $this->theme->set_controller('footer', 'shop/footer');
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('affiliate/notification', $data));
	}

    public function inbox() {
        $data = $this->theme->language('affiliate/notification');
        $this->theme->model('affiliate/notification');
        
        if (isset($this->request->get['page'])):
            $page = $this->request->get['page'];
        else:
            $page = 1;
        endif;
        
        $data['inbox'] = array();
        
        $total   = $this->model_affiliate_notification->getTotalNotifications();
        $results = $this->model_affiliate_notification->getAllNotifications(($page - 1) * 10, 10);


        
        foreach ($results as $result):
           $data['inbox'][] = array(
                'notification_id' => $result['notification_id'],
                'href'            => $this->url->link('affiliate/notification/read', 'notification_id=' . $result['notification_id'], 'SSL'),
                'subject'         => $result['subject'],
                'read'            => $result['is_read'],
                'delete'          => $this->url->link('affiliate/notification/delete', 'notification_id=' . $result['notification_id'], 'SSL'),
            ); 
        endforeach;
        
        $data['pagination'] = $this->theme->paginate(
            $total, 
            $page, 
            10, 
            $this->language->get('lang_text_pagination'), 
            $this->url->link('affiliate/notification/inbox', 'page={page}')
        );
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->response->setOutput($this->theme->view('affiliate/inbox', $data));
    }

    public function read() {
        $this->theme->model('affiliate/notification');

        $json = array();

        $id = $this->request->get['notification_id'];

        $json['message'] = html_entity_decode($this->model_affiliate_notification->getInboxNotification($id), ENT_QUOTES, 'UTF-8');

        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }

    public function delete() {
        $this->theme->language('affiliate/notification');
        $this->theme->model('affiliate/notification');

        $json = array();

        $notification_id = $this->request->get['notification_id'];

        if ($this->model_affiliate_notification->deleteInboxNotification($notification_id)):
            $json['success'] = $this->language->get('lang_text_success');
        endif;

        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }

	private function validate() {
		// just return true as we have nothing to validate here
        return true;
	}
}
