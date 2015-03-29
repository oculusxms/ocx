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

namespace Admin\Controller\People;
use Oculus\Engine\Controller;
use Oculus\Library\Mail;

class Contact extends Controller {
    
    public function index() {
        $data = $this->theme->language('people/contact');
        $this->theme->setTitle($this->language->get('lang_heading_title'));
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->session->data['success'])):
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        endif;
        
        $this->breadcrumb->add('lang_heading_title', 'people/contact');
        
        $data['cancel'] = $this->url->link('people/contact', 'token=' . $this->session->data['token'], 'SSL');
        
        $this->theme->model('setting/store');
        
        $data['stores'] = $this->model_setting_store->getStores();
        
        $this->theme->model('people/customergroup');
        
        $data['customer_groups'] = $this->model_people_customergroup->getCustomerGroups(0);
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('people/contact', $data));
    }
    
    public function send() {
        $this->language->load('people/contact');
        
        $json = array();
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST'):
            if (!$this->user->hasPermission('modify', 'people/contact')):
                $json['error']['warning'] = $this->language->get('lang_error_permission');
            endif;
            
            if (!$this->request->post['subject']):
                $json['error']['subject'] = $this->language->get('lang_error_subject');
            endif;
            
            if (!$this->request->post['message']):
                $json['error']['message'] = $this->language->get('lang_error_message');
            endif;
            
            if (!$json):
                $this->theme->model('setting/store');
                
                $store_info = $this->model_setting_store->getStore($this->request->post['store_id']);
                
                if ($store_info):
                    $store_name = $store_info['name'];
                else:
                    $store_name = $this->config->get('config_name');
                endif;
                
                $this->theme->model('people/customer');
                $this->theme->model('people/customergroup');
                $this->theme->model('sale/order');
                
                if (isset($this->request->get['page'])):
                    $page = $this->request->get['page'];
                else:
                    $page = 1;
                endif;
                
                $email_total = 0;
                $emails      = array();
                
                switch ($this->request->post['to']):
                    case 'newsletter':
                        $customer_data = array(
                            'filter_newsletter' => 1, 
                            'start' => ($page - 1) * 10, 
                            'limit' => 10
                        );
                        
                        $email_total = $this->model_people_customer->getTotalCustomers($customer_data);
                        $results     = $this->model_people_customer->getCustomers($customer_data);
                        
                        foreach ($results as $result):
                            $emails[] = $result['email'];
                        endforeach;
                        break;
                    case 'customer_all':
                        $customer_data = array(
                            'start' => ($page - 1) * 10, 
                            'limit' => 10
                        );
                        
                        $email_total = $this->model_people_customer->getTotalCustomers($customer_data);
                        $results     = $this->model_people_customer->getCustomers($customer_data);
                        
                        foreach ($results as $result):
                            $emails[] = $result['email'];
                        endforeach;
                        break;
                    case 'customer_group':
                        $customer_data = array(
                            'filter_customer_group_id' => $this->request->post['customer_group_id'], 
                            'start'                    => ($page - 1) * 10, 
                            'limit'                    => 10
                        );
                        
                        $email_total = $this->model_people_customer->getTotalCustomers($customer_data);
                        $results     = $this->model_people_customer->getCustomers($customer_data);
                        
                        foreach ($results as $result):
                            $emails[$result['customer_id']] = $result['email'];
                        endforeach;
                        break;
                    case 'customer':
                        if (!empty($this->request->post['customer'])):
                            foreach ($this->request->post['customer'] as $customer_id):
                                $customer_info = $this->model_people_customer->getCustomer($customer_id);
                                
                                if ($customer_info):
                                    $emails[] = $customer_info['email'];
                                endif;
                            endforeach;
                        endif;
                        break;
                    case 'affiliate_all':
                        $affiliate_data = array(
                            'start' => ($page - 1) * 10, 
                            'limit' => 10
                        );
                        
                        $email_total = $this->model_people_customer->getTotalAffiliates($affiliate_data);
                        $results     = $this->model_people_customer->getAffiliates($affiliate_data);
                        
                        foreach ($results as $result):
                            $emails[] = $result['email'];
                        endforeach;
                        break;
                    case 'affiliate':
                        if (!empty($this->request->post['affiliate'])):
                            foreach ($this->request->post['affiliate'] as $affiliate_id):
                                $affiliate_info = $this->model_people_customer->getCustomer($affiliate_id);
                                
                                if ($affiliate_info):
                                    $emails[] = $affiliate_info['email'];
                                endif;
                            endforeach;
                        endif;
                        break;
                    case 'product':
                        if (isset($this->request->post['product'])):
                            $email_total = $this->model_sale_order->getTotalEmailsByProductsOrdered($this->request->post['product']);
                            $results     = $this->model_sale_order->getEmailsByProductsOrdered($this->request->post['product'], ($page - 1) * 10, 10);
                            
                            foreach ($results as $result):
                                $emails[] = $result['email'];
                            endforeach;
                        endif;
                        break;
                endswitch;
                
                if ($emails):
                    $start = ($page - 1) * 10;
                    $end   = $start + 10;
                    
                    if ($end < $email_total):
                        $json['success'] = sprintf($this->language->get('lang_text_sent'), $start, $email_total);
                    else:
                        $json['success'] = $this->language->get('lang_text_success');
                    endif;
                    
                    if ($end < $email_total):
                        $json['next'] = str_replace('&amp;', '&', $this->url->link('people/contact/send', 'token=' . $this->session->data['token'] . '&page=' . ($page + 1), 'SSL'));
                    else:
                        $json['next'] = '';
                    endif;
                    
                    if ($end < $email_total):
                        $json['redirect'] = '';
                    else:
                        $json['redirect'] = str_replace('&amp;', '&', $this->url->link('people/contact', 'token=' . $this->session->data['token'], 'SSL'));
                        $this->session->data['success'] = $this->language->get('lang_text_success');
                    endif;

                    // NEW MAILER
                    // admin_people_contact
                    
                    $callback = array(

                    );



                    // $message = '<html dir="ltr" lang="en">' . "\n";
                    // $message.= '  <head>' . "\n";
                    // $message.= '    <title>' . $this->request->post['subject'] . '</title>' . "\n";
                    // $message.= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
                    // $message.= '  </head>' . "\n";
                    // $message.= '  <body>' . html_entity_decode($this->request->post['message'], ENT_QUOTES, 'UTF-8') . '</body>' . "\n";
                    // $message.= '</html>' . "\n";
                    
                    // foreach ($emails as $email) {
                    //     $mail = new Mail();
                    //     $mail->protocol = $this->config->get('config_mail_protocol');
                    //     $mail->parameter = $this->config->get('config_mail_parameter');
                    //     $mail->hostname = $this->config->get('config_smtp_host');
                    //     $mail->username = $this->config->get('config_smtp_username');
                    //     $mail->password = $this->config->get('config_smtp_password');
                    //     $mail->port = $this->config->get('config_smtp_port');
                    //     $mail->timeout = $this->config->get('config_smtp_timeout');
                    //     $mail->setTo($email);
                    //     $mail->setFrom($this->config->get('config_email'));
                    //     $mail->setSender($store_name);
                    //     $mail->setSubject(html_entity_decode($this->request->post['subject'], ENT_QUOTES, 'UTF-8'));
                    //     $mail->setHtml($message);
                    //     $mail->send();
                    // }
                endif;
            endif;
        }
        
        $json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);
        
        $this->response->setOutput(json_encode($json));
    }

    public function admin_people_contact($data, $message) {

    }
}
