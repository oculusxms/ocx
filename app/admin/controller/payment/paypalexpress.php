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

namespace Admin\Controller\Payment;
use Oculus\Engine\Controller;

class Paypalexpress extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('payment/paypalexpress');
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->theme->model('setting/setting');
        $this->theme->model('setting/module');
        $this->theme->model('payment/paypalexpress');
        
        $this->error = array();
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('paypalexpress', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $this->response->redirect($this->url->link('module/payment', 'token=' . $this->session->data['token'], 'SSL'));
        } else {
            $data['error'] = $this->error;
        }
        
        $data['text_ipn_url'] = $this->app['https.public'] . 'payment/paypalexpress/ipn';
        
        $this->breadcrumb->add('text_payment', 'module/payment');
        $this->breadcrumb->add('heading_title', 'payment/paypalexpress');
        
        //button actions
        $data['action'] = $this->url->link('payment/paypalexpress', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('module/payment', 'token=' . $this->session->data['token'], 'SSL');
        $data['search'] = $this->url->link('payment/paypalexpress/search', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['paypalexpress_login_seamless'] = true;
        
        if (isset($this->request->post['paypalexpress_username'])) {
            $data['paypalexpress_username'] = $this->request->post['paypalexpress_username'];
        } else {
            $data['paypalexpress_username'] = $this->config->get('paypalexpress_username');
        }
        
        if (isset($this->request->post['paypalexpress_password'])) {
            $data['paypalexpress_password'] = $this->request->post['paypalexpress_password'];
        } else {
            $data['paypalexpress_password'] = $this->config->get('paypalexpress_password');
        }
        
        if (isset($this->request->post['paypalexpress_signature'])) {
            $data['paypalexpress_signature'] = $this->request->post['paypalexpress_signature'];
        } else {
            $data['paypalexpress_signature'] = $this->config->get('paypalexpress_signature');
        }
        
        if (isset($this->request->post['paypalexpress_test'])) {
            $data['paypalexpress_test'] = $this->request->post['paypalexpress_test'];
        } else {
            $data['paypalexpress_test'] = $this->config->get('paypalexpress_test');
        }
        
        if (isset($this->request->post['paypalexpress_method'])) {
            $data['paypalexpress_method'] = $this->request->post['paypalexpress_method'];
        } else {
            $data['paypalexpress_method'] = $this->config->get('paypalexpress_method');
        }
        
        if (isset($this->request->post['paypalexpress_total'])) {
            $data['paypalexpress_total'] = $this->request->post['paypalexpress_total'];
        } else {
            $data['paypalexpress_total'] = $this->config->get('paypalexpress_total');
        }
        
        if (isset($this->request->post['paypalexpress_debug'])) {
            $data['paypalexpress_debug'] = $this->request->post['paypalexpress_debug'];
        } else {
            $data['paypalexpress_debug'] = $this->config->get('paypalexpress_debug');
        }
        
        if (isset($this->request->post['paypalexpress_currency'])) {
            $data['paypalexpress_currency'] = $this->request->post['paypalexpress_currency'];
        } else {
            $data['paypalexpress_currency'] = $this->config->get('paypalexpress_currency');
        }
        
        $data['currency_codes'] = $this->model_payment_paypalexpress->currencyCodes();
        
        $this->theme->model('localization/order_status');
        
        $data['order_statuses'] = $this->model_localization_order_status->getOrderStatuses();
        
        if (isset($this->request->post['paypalexpress_canceled_reversal_status_id'])) {
            $data['paypalexpress_canceled_reversal_status_id'] = $this->request->post['paypalexpress_canceled_reversal_status_id'];
        } else {
            $data['paypalexpress_canceled_reversal_status_id'] = $this->config->get('paypalexpress_canceled_reversal_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_completed_status_id'])) {
            $data['paypalexpress_completed_status_id'] = $this->request->post['paypalexpress_completed_status_id'];
        } else {
            $data['paypalexpress_completed_status_id'] = $this->config->get('paypalexpress_completed_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_denied_status_id'])) {
            $data['paypalexpress_denied_status_id'] = $this->request->post['paypalexpress_denied_status_id'];
        } else {
            $data['paypalexpress_denied_status_id'] = $this->config->get('paypalexpress_denied_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_expired_status_id'])) {
            $data['paypalexpress_expired_status_id'] = $this->request->post['paypalexpress_expired_status_id'];
        } else {
            $data['paypalexpress_expired_status_id'] = $this->config->get('paypalexpress_expired_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_failed_status_id'])) {
            $data['paypalexpress_failed_status_id'] = $this->request->post['paypalexpress_failed_status_id'];
        } else {
            $data['paypalexpress_failed_status_id'] = $this->config->get('paypalexpress_failed_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_pending_status_id'])) {
            $data['paypalexpress_pending_status_id'] = $this->request->post['paypalexpress_pending_status_id'];
        } else {
            $data['paypalexpress_pending_status_id'] = $this->config->get('paypalexpress_pending_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_processed_status_id'])) {
            $data['paypalexpress_processed_status_id'] = $this->request->post['paypalexpress_processed_status_id'];
        } else {
            $data['paypalexpress_processed_status_id'] = $this->config->get('paypalexpress_processed_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_refunded_status_id'])) {
            $data['paypalexpress_refunded_status_id'] = $this->request->post['paypalexpress_refunded_status_id'];
        } else {
            $data['paypalexpress_refunded_status_id'] = $this->config->get('paypalexpress_refunded_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_reversed_status_id'])) {
            $data['paypalexpress_reversed_status_id'] = $this->request->post['paypalexpress_reversed_status_id'];
        } else {
            $data['paypalexpress_reversed_status_id'] = $this->config->get('paypalexpress_reversed_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_voided_status_id'])) {
            $data['paypalexpress_voided_status_id'] = $this->request->post['paypalexpress_voided_status_id'];
        } else {
            $data['paypalexpress_voided_status_id'] = $this->config->get('paypalexpress_voided_status_id');
        }
        
        if (isset($this->request->post['paypalexpress_allow_note'])) {
            $data['paypalexpress_allow_note'] = $this->request->post['paypalexpress_allow_note'];
        } else {
            $data['paypalexpress_allow_note'] = $this->config->get('paypalexpress_allow_note');
        }
        
        if (isset($this->request->post['paypalexpress_logo'])) {
            $data['paypalexpress_logo'] = $this->request->post['paypalexpress_logo'];
        } else {
            $data['paypalexpress_logo'] = $this->config->get('paypalexpress_logo');
        }
        
        if (isset($this->request->post['paypalexpress_page_colour'])) {
            $data['paypalexpress_page_colour'] = str_replace('#', '', $this->request->post['paypalexpress_page_colour']);
        } else {
            $data['paypalexpress_page_colour'] = $this->config->get('paypalexpress_page_colour');
        }
        
        if (isset($this->request->post['paypalexpress_recurring_cancel_status'])) {
            $data['paypalexpress_recurring_cancel_status'] = $this->request->post['paypalexpress_recurring_cancel_status'];
        } else {
            $data['paypalexpress_recurring_cancel_status'] = $this->config->get('paypalexpress_recurring_cancel_status');
        }
        
        $this->theme->model('tool/image');
        
        $logo = $this->config->get('paypalexpress_logo');
        
        if (isset($this->request->post['paypalexpress_logo']) && file_exists($this->app['path.image'] . $this->request->post['paypalexpress_logo'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['paypalexpress_logo'], 750, 90);
        } elseif (($logo != '') && file_exists($this->app['path.image'] . $logo)) {
            $data['thumb'] = $this->model_tool_image->resize($logo, 750, 90);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('placeholder.png', 750, 90);
        }
        
        $data['no_image'] = $this->model_tool_image->resize('placeholder.png', 750, 90);
        
        if (isset($this->request->post['paypalexpress_geo_zone_id'])) {
            $data['paypalexpress_geo_zone_id'] = $this->request->post['paypalexpress_geo_zone_id'];
        } else {
            $data['paypalexpress_geo_zone_id'] = $this->config->get('paypalexpress_geo_zone_id');
        }
        
        $this->theme->model('localization/geo_zone');
        
        $data['geo_zones'] = $this->model_localization_geo_zone->getGeoZones();
        
        if (isset($this->request->post['paypalexpress_status'])) {
            $data['paypalexpress_status'] = $this->request->post['paypalexpress_status'];
        } else {
            $data['paypalexpress_status'] = $this->config->get('paypalexpress_status');
        }
        
        if (isset($this->request->post['paypalexpress_sort_order'])) {
            $data['paypalexpress_sort_order'] = $this->request->post['paypalexpress_sort_order'];
        } else {
            $data['paypalexpress_sort_order'] = $this->config->get('paypalexpress_sort_order');
        }
        
        $data['token'] = $this->session->data['token'];
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('payment/paypalexpress', $data));
    }
    
    public function imageLogo() {
        $this->theme->model('tool/image');
        
        if (isset($this->request->get['image'])) {
            $this->response->setOutput($this->model_tool_image->resize(html_entity_decode($this->request->get['image'], ENT_QUOTES, 'UTF-8'), 750, 90));
        }
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'payment/paypalexpress')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (empty($this->request->post['paypalexpress_username'])) {
            $this->error['username'] = $this->language->get('error_username');
        }
        
        if (empty($this->request->post['paypalexpress_password'])) {
            $this->error['password'] = $this->language->get('error_password');
        }
        
        if (empty($this->request->post['paypalexpress_signature'])) {
            $this->error['signature'] = $this->language->get('error_signature');
        }
        
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
    
    public function resend() {
        $this->theme->language('payment/paypalexpress');
        $this->theme->model('payment/paypalexpress');
        
        $json = array();
        
        if (isset($this->request->get['paypal_order_transaction_id'])) {
            $transaction = $this->model_payment_paypalexpress->getFailedTransaction($this->request->get['paypal_order_transaction_id']);
            
            if ($transaction) {
                $call_data = unserialize($transaction['call_data']);
                
                $result = $this->model_payment_paypalexpress->call($call_data);
                
                if ($result) {
                    
                    $parent_transaction = $this->model_payment_paypalexpress->getLocalTransaction($transaction['parent_transaction_id']);
                    
                    if ($parent_transaction['amount'] == abs($transaction['amount'])) {
                        $this->db->query("
							UPDATE `{$this->db->prefix}paypal_order_transaction` 
							SET 
								`payment_status` = 'Refunded' 
							WHERE `transaction_id` = '" . $this->db->escape($transaction['parent_transaction_id']) . "' 
							LIMIT 1");
                    } else {
                        $this->db->query("
							UPDATE `{$this->db->prefix}paypal_order_transaction` 
							SET 
								`payment_status` = 'Partially-Refunded' 
							WHERE `transaction_id` = '" . $this->db->escape($transaction['parent_transaction_id']) . "' 
							LIMIT 1");
                    }
                    
                    if (isset($result['REFUNDTRANSACTIONID'])) {
                        $transaction['transaction_id'] = $result['REFUNDTRANSACTIONID'];
                    } else {
                        $transaction['transaction_id'] = $result['TRANSACTIONID'];
                    }
                    
                    if (isset($result['PAYMENTTYPE'])) {
                        $transaction['payment_type'] = $result['PAYMENTTYPE'];
                    } else {
                        $transaction['payment_type'] = $result['REFUNDSTATUS'];
                    }
                    
                    if (isset($result['PAYMENTSTATUS'])) {
                        $transaction['payment_status'] = $result['PAYMENTSTATUS'];
                    } else {
                        $transaction['payment_status'] = 'Refunded';
                    }
                    
                    if (isset($result['AMT'])) {
                        $transaction['amount'] = $result['AMT'];
                    } else {
                        $transaction['amount'] = $transaction['amount'];
                    }
                    
                    $transaction['pending_reason'] = (isset($result['PENDINGREASON']) ? $result['PENDINGREASON'] : '');
                    
                    $this->model_payment_paypalexpress->updateTransaction($transaction);
                    
                    $json['success'] = $this->language->get('success_transaction_resent');
                } else {
                    $json['error'] = $this->language->get('error_timeout');
                }
            } else {
                $json['error'] = $this->language->get('error_transaction_missing');
            }
        } else {
            $json['error'] = $this->language->get('error_data');
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    
    public function capture() {
        $this->theme->language('payment/paypalexpress');
        
        /**
         * used to capture authorised payments
         *
         * capture can be full or partial amounts
         */
        if (isset($this->request->post['order_id']) && $this->request->post['amount'] > 0 && isset($this->request->post['order_id']) && isset($this->request->post['complete'])) {
            
            $this->theme->model('payment/paypalexpress');
            
            $paypal_order = $this->model_payment_paypalexpress->getOrder($this->request->post['order_id']);
            
            if ($this->request->post['complete'] == 1) {
                $complete = 'Complete';
            } else {
                $complete = 'NotComplete';
            }
            
            $call_data = array();
            $call_data['METHOD'] = 'DoCapture';
            $call_data['AUTHORIZATIONID'] = $paypal_order['authorization_id'];
            $call_data['AMT'] = number_format($this->request->post['amount'], 2);
            $call_data['CURRENCYCODE'] = $paypal_order['currency_code'];
            $call_data['COMPLETETYPE'] = $complete;
            $call_data['MSGSUBID'] = uniqid(mt_rand(), true);
            
            $result = $this->model_payment_paypalexpress->call($call_data);
            
            $transaction = array('paypal_order_id' => $paypal_order['paypal_order_id'], 'transaction_id' => '', 'parent_transaction_id' => $paypal_order['authorization_id'], 'note' => '', 'msgsubid' => $call_data['MSGSUBID'], 'receipt_id' => '', 'payment_type' => '', 'payment_status' => '', 'pending_reason' => '', 'transaction_entity' => 'payment', 'amount' => '', 'debug_data' => json_encode($result));
            
            if ($result === false) {
                $transaction['amount'] = number_format($this->request->post['amount'], 2);
                $paypal_order_transaction_id = $this->model_payment_paypalexpress->addTransaction($transaction, $call_data);
                
                $json['error'] = true;
                
                $json['failed_transaction']['paypal_order_transaction_id'] = $paypal_order_transaction_id;
                $json['failed_transaction']['amount'] = $transaction['amount'];
                $json['failed_transaction']['column_date_added'] = date("Y-m-d H:i:s");
                
                $json['msg'] = $this->language->get('error_timeout');
            } else if (isset($result['ACK']) && $result['ACK'] != 'Failure' && $result['ACK'] != 'FailureWithWarning') {
                $transaction['transaction_id'] = $result['TRANSACTIONID'];
                $transaction['payment_type'] = $result['PAYMENTTYPE'];
                $transaction['payment_status'] = $result['PAYMENTSTATUS'];
                $transaction['pending_reason'] = (isset($result['PENDINGREASON']) ? $result['PENDINGREASON'] : '');
                $transaction['amount'] = $result['AMT'];
                
                $this->model_payment_paypalexpress->addTransaction($transaction);
                
                unset($transaction['debug_data']);
                $transaction['date_added'] = date("Y-m-d H:i:s");
                
                $captured = number_format($this->model_payment_paypalexpress->totalCaptured($paypal_order['paypal_order_id']), 2);
                $refunded = number_format($this->model_payment_paypalexpress->totalRefundedOrder($paypal_order['paypal_order_id']), 2);
                
                $transaction['captured'] = $captured;
                $transaction['refunded'] = $refunded;
                $transaction['remaining'] = number_format($paypal_order['total'] - $captured, 2);
                
                $transaction['status'] = 0;
                if ($transaction['remaining'] == 0.00) {
                    $transaction['status'] = 1;
                    $this->model_payment_paypalexpress->updateOrder('Complete', $this->request->post['order_id']);
                }
                
                $transaction['void'] = '';
                
                if ($this->request->post['complete'] == 1 && $transaction['remaining'] > 0) {
                    $transaction['void'] = array('paypal_order_id' => $paypal_order['paypal_order_id'], 'transaction_id' => '', 'parent_transaction_id' => $paypal_order['authorization_id'], 'note' => '', 'msgsubid' => '', 'receipt_id' => '', 'payment_type' => '', 'payment_status' => 'Void', 'pending_reason' => '', 'amount' => '', 'debug_data' => 'Voided after capture', 'transaction_entity' => 'auth',);
                    
                    $this->model_payment_paypalexpress->addTransaction($transaction['void']);
                    $this->model_payment_paypalexpress->updateOrder('Complete', $this->request->post['order_id']);
                    $transaction['void']['date_added'] = date("Y-m-d H:i:s");
                    $transaction['status'] = 1;
                }
                
                $json['data'] = $transaction;
                $json['error'] = false;
                $json['msg'] = 'Ok';
            } else {
                $json['error'] = true;
                $json['msg'] = (isset($result['L_SHORTMESSAGE0']) ? $result['L_SHORTMESSAGE0'] : 'There was an error');
            }
        } else {
            $json['error'] = true;
            $json['msg'] = 'Missing data';
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    
    public function void() {
        
        /**
         * used to void an authorised payment
         */
        if (isset($this->request->post['order_id']) && $this->request->post['order_id'] != '') {
            $this->theme->model('payment/paypalexpress');
            
            $paypal_order = $this->model_payment_paypalexpress->getOrder($this->request->post['order_id']);
            
            $call_data = array();
            $call_data['METHOD'] = 'DoVoid';
            $call_data['AUTHORIZATIONID'] = $paypal_order['authorization_id'];
            
            $result = $this->model_payment_paypalexpress->call($call_data);
            
            if ($result['ACK'] != 'Failure' && $result['ACK'] != 'FailureWithWarning') {
                $transaction = array('paypal_order_id' => $paypal_order['paypal_order_id'], 'transaction_id' => '', 'parent_transaction_id' => $paypal_order['authorization_id'], 'note' => '', 'msgsubid' => '', 'receipt_id' => '', 'payment_type' => 'void', 'payment_status' => 'Void', 'pending_reason' => '', 'transaction_entity' => 'auth', 'amount' => '', 'debug_data' => json_encode($result));
                
                $this->model_payment_paypalexpress->addTransaction($transaction);
                $this->model_payment_paypalexpress->updateOrder('Complete', $this->request->post['order_id']);
                
                unset($transaction['debug_data']);
                $transaction['date_added'] = date("Y-m-d H:i:s");
                
                $json['data'] = $transaction;
                $json['error'] = false;
                $json['msg'] = 'Transaction void';
            } else {
                $json['error'] = true;
                $json['msg'] = (isset($result['L_SHORTMESSAGE0']) ? $result['L_SHORTMESSAGE0'] : 'There was an error');
            }
        } else {
            $json['error'] = true;
            $json['msg'] = 'Missing data';
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    
    public function refund() {
        $data = $this->theme->language('payment/paypalexpress_refund');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->breadcrumb->add('text_paypalexpress', 'payment/paypalexpress');
        $this->breadcrumb->add('heading_title', 'payment/paypalexpress/refund');
        
        //button actions
        $data['action'] = $this->url->link('payment/paypalexpress/doRefund', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('payment/paypalexpress', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['transaction_id'] = $this->request->get['transaction_id'];
        
        $this->theme->model('payment/paypalexpress');
        $pp_transaction = $this->model_payment_paypalexpress->getTransaction($this->request->get['transaction_id']);
        
        $data['amount_original'] = $pp_transaction['AMT'];
        $data['currency_code'] = $pp_transaction['CURRENCYCODE'];
        
        $refunded = number_format($this->model_payment_paypalexpress->totalRefundedTransaction($this->request->get['transaction_id']), 2);
        
        if ($refunded != 0.00) {
            $data['refund_available'] = number_format($data['amount_original'] + $refunded, 2);
            $data['attention'] = $this->language->get('text_current_refunds') . ': ' . $data['refund_available'];
        } else {
            $data['refund_available'] = '';
            $data['attention'] = '';
        }
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->session->data['error'])) {
            $data['error'] = $this->session->data['error'];
            unset($this->session->data['error']);
        } else {
            $data['error'] = '';
        }
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('payment/paypalexpress_refund', $data));
    }
    
    public function doRefund() {
        
        /**
         * used to issue a refund for a captured payment
         *
         * refund can be full or partial
         */
        if (isset($this->request->post['transaction_id']) && isset($this->request->post['refund_full'])) {
            
            $this->theme->model('payment/paypalexpress');
            $this->theme->language('payment/paypalexpress_refund');
            
            if ($this->request->post['refund_full'] == 0 && $this->request->post['amount'] == 0) {
                $this->session->data['error'] = $this->language->get('error_partial_amt');
            } else {
                $order_id = $this->model_payment_paypalexpress->getOrderId($this->request->post['transaction_id']);
                $paypal_order = $this->model_payment_paypalexpress->getOrder($order_id);
                
                if ($paypal_order) {
                    $call_data = array();
                    $call_data['METHOD'] = 'RefundTransaction';
                    $call_data['TRANSACTIONID'] = $this->request->post['transaction_id'];
                    $call_data['NOTE'] = urlencode($this->request->post['refund_message']);
                    $call_data['MSGSUBID'] = uniqid(mt_rand(), true);
                    
                    $current_transaction = $this->model_payment_paypalexpress->getLocalTransaction($this->request->post['transaction_id']);
                    
                    if ($this->request->post['refund_full'] == 1) {
                        $call_data['REFUNDTYPE'] = 'Full';
                    } else {
                        $call_data['REFUNDTYPE'] = 'Partial';
                        $call_data['AMT'] = number_format($this->request->post['amount'], 2);
                        $call_data['CURRENCYCODE'] = $this->request->post['currency_code'];
                    }
                    
                    $result = $this->model_payment_paypalexpress->call($call_data);
                    
                    $transaction = array('paypal_order_id' => $paypal_order['paypal_order_id'], 'transaction_id' => '', 'parent_transaction_id' => $this->request->post['transaction_id'], 'note' => $this->request->post['refund_message'], 'msgsubid' => $call_data['MSGSUBID'], 'receipt_id' => '', 'payment_type' => '', 'payment_status' => 'Refunded', 'transaction_entity' => 'payment', 'pending_reason' => '', 'amount' => '-' . (isset($call_data['AMT']) ? $call_data['AMT'] : $current_transaction['amount']), 'debug_data' => json_encode($result));
                    
                    if ($result === false) {
                        $transaction['payment_status'] = 'Failed';
                        $this->model_payment_paypalexpress->addTransaction($transaction, $call_data);
                        $this->response->redirect($this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $paypal_order['order_id'], 'SSL'));
                    } else if ($result['ACK'] != 'Failure' && $result['ACK'] != 'FailureWithWarning') {
                        
                        $transaction['transaction_id'] = $result['REFUNDTRANSACTIONID'];
                        $transaction['payment_type'] = $result['REFUNDSTATUS'];
                        $transaction['pending_reason'] = $result['PENDINGREASON'];
                        $transaction['amount'] = '-' . $result['GROSSREFUNDAMT'];
                        
                        $this->model_payment_paypalexpress->addTransaction($transaction);
                        
                        //edit transaction to refunded status
                        if ($result['TOTALREFUNDEDAMOUNT'] == $this->request->post['amount_original']) {
                            $this->db->query("
								UPDATE `{$this->db->prefix}paypal_order_transaction` 
								SET 
									`payment_status` = 'Refunded' 
								WHERE `transaction_id` = '" . $this->db->escape($this->request->post['transaction_id']) . "' 
								LIMIT 1");
                        } else {
                            $this->db->query("
								UPDATE `{$this->db->prefix}paypal_order_transaction` 
								SET 
									`payment_status` = 'Partially-Refunded' 
								WHERE `transaction_id` = '" . $this->db->escape($this->request->post['transaction_id']) . "' 
								LIMIT 1");
                        }
                        
                        //redirect back to the order
                        $this->response->redirect($this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $paypal_order['order_id'], 'SSL'));
                    } else {
                        $this->model_payment_paypalexpress->log(json_encode($result));
                        $this->session->data['error'] = (isset($result['L_SHORTMESSAGE0']) ? $result['L_SHORTMESSAGE0'] : 'There was an error') . (isset($result['L_LONGMESSAGE0']) ? '<br />' . $result['L_LONGMESSAGE0'] : '');
                        $this->response->redirect($this->url->link('payment/paypalexpress/refund', 'token=' . $this->session->data['token'] . '&transaction_id=' . $this->request->post['transaction_id'], 'SSL'));
                    }
                } else {
                    $this->session->data['error'] = $this->language->get('error_data_missing');
                    $this->response->redirect($this->url->link('payment/paypalexpress/refund', 'token=' . $this->session->data['token'] . '&transaction_id=' . $this->request->post['transaction_id'], 'SSL'));
                }
            }
        } else {
            $this->session->data['error'] = $this->language->get('error_data');
            $this->response->redirect($this->url->link('payment/paypalexpress/refund', 'token=' . $this->session->data['token'] . '&transaction_id=' . $this->request->post['transaction_id'], 'SSL'));
        }
    }
    
    public function install() {
        $this->theme->model('payment/paypalexpress');
        $this->model_payment_paypalexpress->install();
    }
    
    public function uninstall() {
        $this->theme->model('payment/paypalexpress');
        $this->model_payment_paypalexpress->uninstall();
    }
    
    public function orderAction() {
        if ($this->config->get('paypalexpress_status')) {
            $data = $this->theme->language('payment/paypalexpress_order');
            $this->theme->model('payment/paypalexpress');
            
            $paypal_order = $this->model_payment_paypalexpress->getOrder($this->request->get['order_id']);
            
            if ($paypal_order) {
                $data['paypal_order'] = $paypal_order;
                $data['order_id'] = $this->request->get['order_id'];
                $data['token'] = $this->session->data['token'];
                
                $captured = number_format($this->model_payment_paypalexpress->totalCaptured($data['paypal_order']['paypal_order_id']), 2);
                $refunded = number_format($this->model_payment_paypalexpress->totalRefundedOrder($data['paypal_order']['paypal_order_id']), 2);
                
                $data['paypal_order']['captured'] = $captured;
                $data['paypal_order']['refunded'] = $refunded;
                $data['paypal_order']['remaining'] = number_format($data['paypal_order']['total'] - $captured, 2);
                
                $captured = number_format($this->model_payment_paypalexpress->totalCaptured($paypal_order['paypal_order_id']), 2);
                $refunded = number_format($this->model_payment_paypalexpress->totalRefundedOrder($paypal_order['paypal_order_id']), 2);
                
                $data['paypal_order'] = $paypal_order;
                
                $data['paypal_order']['captured'] = $captured;
                $data['paypal_order']['refunded'] = $refunded;
                $data['paypal_order']['remaining'] = number_format($paypal_order['total'] - $captured, 2);
                
                $data['refund_link'] = $this->url->link('payment/paypalexpress/refund', 'token=' . $this->session->data['token'], 'SSL');
                $data['view_link'] = $this->url->link('payment/paypalexpress/viewTransaction', 'token=' . $this->session->data['token'], 'SSL');
                $data['resend_link'] = $this->url->link('payment/paypalexpress/resend', 'token=' . $this->session->data['token'], 'SSL');
                
                $this->theme->listen(__CLASS__, __FUNCTION__);
                
                return $this->theme->view('payment/paypalexpress_order', $data);
            }
        }
    }
    
    public function search() {
        $data = $this->theme->language('payment/paypalexpress_search');
        $this->theme->model('payment/paypalexpress');
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $data['currency_codes'] = $this->model_payment_paypalexpress->currencyCodes();
        $data['default_currency'] = $this->config->get('paypalexpress_currency');
        
        $this->breadcrumb->add('text_paypalexpress', 'payment/paypalexpress');
        $this->breadcrumb->add('heading_title', 'payment/paypalexpress/search');
        
        $data['token'] = $this->session->data['token'];
        $data['date_start'] = date("Y-m-d", strtotime('-30 days'));
        $data['date_end'] = date("Y-m-d");
        $data['view_link'] = $this->url->link('payment/paypalexpress/viewTransaction', 'token=' . $this->session->data['token'], 'SSL');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->theme->loadjs('javascript/payment/paypalexpress_search', $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('payment/paypalexpress_search', $data));
    }
    
    public function doSearch() {
        
        /**
         * used to search for transactions from a user account
         */
        if (isset($this->request->post['date_start'])) {
            
            $this->theme->model('payment/paypalexpress');
            
            $call_data = array();
            $call_data['METHOD'] = 'TransactionSearch';
            $call_data['STARTDATE'] = gmdate($this->request->post['date_start'] . "\TH:i:s\Z");
            
            if (!empty($this->request->post['date_end'])) {
                $call_data['ENDDATE'] = gmdate($this->request->post['date_end'] . "\TH:i:s\Z");
            }
            
            if (!empty($this->request->post['transaction_class'])) {
                $call_data['TRANSACTIONCLASS'] = $this->request->post['transaction_class'];
            }
            
            if (!empty($this->request->post['status'])) {
                $call_data['STATUS'] = $this->request->post['status'];
            }
            
            if (!empty($this->request->post['buyer_email'])) {
                $call_data['EMAIL'] = $this->request->post['buyer_email'];
            }
            
            if (!empty($this->request->post['merchant_email'])) {
                $call_data['RECEIVER'] = $this->request->post['merchant_email'];
            }
            
            if (!empty($this->request->post['receipt_id'])) {
                $call_data['RECEIPTID'] = $this->request->post['receipt_id'];
            }
            
            if (!empty($this->request->post['transaction_id'])) {
                $call_data['TRANSACTIONID'] = $this->request->post['transaction_id'];
            }
            
            if (!empty($this->request->post['invoice_number'])) {
                $call_data['INVNUM'] = $this->request->post['invoice_number'];
            }
            
            if (!empty($this->request->post['auction_item_number'])) {
                $call_data['AUCTIONITEMNUMBER'] = $this->request->post['auction_item_number'];
            }
            
            if (!empty($this->request->post['amount'])) {
                $call_data['AMT'] = number_format($this->request->post['amount'], 2);
                $call_data['CURRENCYCODE'] = $this->request->post['currency_code'];
            }
            
            if (!empty($this->request->post['recurring_id'])) {
                $call_data['PROFILEID'] = $this->request->post['recurring_id'];
            }
            
            if (!empty($this->request->post['name_salutation'])) {
                $call_data['SALUTATION'] = $this->request->post['name_salutation'];
            }
            
            if (!empty($this->request->post['name_first'])) {
                $call_data['FIRSTNAME'] = $this->request->post['name_first'];
            }
            
            if (!empty($this->request->post['name_middle'])) {
                $call_data['MIDDLENAME'] = $this->request->post['name_middle'];
            }
            
            if (!empty($this->request->post['name_last'])) {
                $call_data['LASTNAME'] = $this->request->post['name_last'];
            }
            
            if (!empty($this->request->post['name_suffix'])) {
                $call_data['SUFFIX'] = $this->request->post['name_suffix'];
            }
            
            $result = $this->model_payment_paypalexpress->call($call_data);
            
            if ($result['ACK'] != 'Failure' && $result['ACK'] != 'FailureWithWarning' && $result['ACK'] != 'Warning') {
                $response['error'] = false;
                $response['result'] = $this->formatRows($result);
            } else {
                $response['error'] = true;
                $response['error_msg'] = $result['L_LONGMESSAGE0'];
            }
            
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($response));
        } else {
            $response['error'] = true;
            $response['error_msg'] = 'Enter a start date';
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($response));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
    }
    
    public function viewTransaction() {
        $data = $this->theme->language('payment/paypalexpress_view');
        $this->theme->model('payment/paypalexpress');
        
        $data['transaction'] = $this->model_payment_paypalexpress->getTransaction($this->request->get['transaction_id']);
        $data['lines'] = $this->formatRows($data['transaction']);
        $data['view_link'] = $this->url->link('payment/paypalexpress/viewTransaction', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('payment/paypalexpress/search', 'token=' . $this->session->data['token'], 'SSL');
        $data['token'] = $this->session->data['token'];
        
        $this->theme->setTitle($this->language->get('heading_title'));
        
        $this->breadcrumb->add('text_paypalexpress', 'payment/paypalexpress');
        $this->breadcrumb->add('heading_title', 'payment/paypalexpress/viewTransaction');
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('payment/paypalexpress_view', $data));
    }
    
    private function formatRows($data) {
        $return = array();
        
        foreach ($data as $k => $v) {
            $elements = preg_split("/(\d+)/", $k, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            if (isset($elements[1]) && isset($elements[0])) {
                if ($elements[0] == 'L_TIMESTAMP') {
                    $v = str_replace('T', ' ', $v);
                    $v = str_replace('Z', '', $v);
                }
                $return[$elements[1]][$elements[0]] = $v;
            }
        }
        
        return $return;
    }
    
    public function recurringCancel() {
        
        //cancel an active recurring
        $this->language->load('sale/recurring');
        
        $this->theme->model('sale/recurring');
        $this->theme->model('payment/paypalexpress');
        
        $recurring = $this->model_sale_recurring->getRecurring($this->request->get['order_recurring_id']);
        
        if ($recurring && !empty($recurring['reference'])) {
            
            $result = $this->model_payment_paypalexpress->recurringCancel($recurring['reference']);
            
            if (isset($result['PROFILEID'])) {
                $this->db->query("
					INSERT INTO `{$this->db->prefix}order_recurring_transaction` 
					SET 
						`order_recurring_id` = '" . (int)$recurring['order_recurring_id'] . "', 
						`date_added` = NOW(), 
						`type` = '5'");
                
                $this->db->query("
					UPDATE `{$this->db->prefix}order_recurring` 
					SET 
						`status` = 4 
					WHERE `order_recurring_id` = '" . (int)$recurring['order_recurring_id'] . "' 
					LIMIT 1");
                
                $this->session->data['success'] = $this->language->get('text_cancelled');
            } else {
                $this->session->data['error'] = sprintf($this->language->get('error_not_cancelled'), $result['L_LONGMESSAGE0']);
            }
        } else {
            $this->session->data['error'] = $this->language->get('error_not_found');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        $this->response->redirect($this->url->link('sale/recurring/info', 'order_recurring_id=' . $this->request->get['order_recurring_id'] . '&token=' . $this->request->get['token'], 'SSL'));
    }
    
    public function recurringButtons() {
        $this->theme->model('sale/recurring');
        
        $recurring = $this->model_sale_recurring->getRecurring($this->request->get['order_recurring_id']);
        
        $data['buttons'] = array();
        
        if ($recurring['status_id'] == 2 || $recurring['status_id'] == 3) {
            $data['buttons'][] = array('text' => $this->language->get('button_cancel_recurring'), 'link' => $this->url->link('payment/paypalexpress/recurringCancel', 'order_recurring_id=' . $this->request->get['order_recurring_id'] . '&token=' . $this->request->get['token'], 'SSL'));
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return $this->theme->view('common/buttons', $data);
    }
}
