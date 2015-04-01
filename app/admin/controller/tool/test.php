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

namespace Admin\Controller\Tool;
use Oculus\Engine\Controller;
use Oculus\Library\Template;
use Oculus\Library\Text;

class Test extends Controller {
    public function index() {
        $data = $this->theme->language('tool/test');
        
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        if (isset($this->session->data['success'])):
            $data['success'] = $this->session->data['success'];
            
            unset($this->session->data['success']);
        else:
            $data['success'] = '';
        endif;
        
        $this->breadcrumb->add('lang_heading_title', 'tool/test');

        $this->theme->model('catalog/event');
        $event_info = $this->model_catalog_event->getEvent(5);

        $callback = array(
            'customer_id' => 1,
            'event'       => $event_info,
            'callback'    => array(
                'class'  => __CLASS__,
                'method' => 'email_test'
            )
        );

        $this->theme->notify('admin_event_waitlist', $callback);

        
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('tool/test', $data));
    }

    public function email_test($data, $message) {
        $call = $data['event'];
        unset($data);

        $data = $this->theme->language('notification/event');

        $data['event_name'] = $call['event_name'];
        $data['event_date'] = date($this->language->get('lang_date_format_short'), strtotime($call['date_time']));
        $data['event_time'] = date($this->language->get('lang_time_format'), strtotime($call['date_time']));

        $data['event_location']  = false;
        $data['event_telephone'] = false;

        if ($call['location']):
            $data['event_location'] = $call['location'];
        endif;

        if ($call['telephone']):
            $data['event_telephone'] = $call['telephone'];
        endif;

        $html = new Template($this->app);
        $text = new Text($this->app);

        $html->data = $data;
        $text->data = $data;

        $html = $html->fetch('notification/event');
        $text = $text->fetch('notification/event');

        $message['text'] = str_replace('!content!', $text, $message['text']);
        $message['html'] = str_replace('!content!', $html, $message['html']);

        return $message;
    }
}
