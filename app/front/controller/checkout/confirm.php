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

namespace Front\Controller\Checkout;
use Oculus\Engine\Controller;

class Confirm extends Controller {
    public function index() {
        $redirect = '';
        
        if ($this->cart->hasShipping()):
            
            // Validate if shipping address has been set.
            $this->theme->model('account/address');
            
            if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])):
                $shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
            elseif (isset($this->session->data['guest'])):
                $shipping_address = $this->session->data['guest']['shipping'];
            endif;
            
            if (empty($shipping_address)):
                $redirect = $this->url->link('checkout/checkout', '', 'SSL');
            endif;
            
            // Validate if shipping method has been set.
            if (!isset($this->session->data['shipping_method'])):
                $redirect = $this->url->link('checkout/checkout', '', 'SSL');
            endif;
        else:
            unset($this->session->data['shipping_method']);
            unset($this->session->data['shipping_methods']);
        endif;
        
        // Validate if payment address has been set.
        $this->theme->model('account/address');
        
        if ($this->customer->isLogged() && isset($this->session->data['payment_address_id'])):
            $payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
        elseif (isset($this->session->data['guest'])):
            $payment_address = $this->session->data['guest']['payment'];
        endif;
        
        if (empty($payment_address)):
            $redirect = $this->url->link('checkout/checkout', '', 'SSL');
        endif;
        
        // Validate if payment method has been set.
        if (!isset($this->session->data['payment_method'])):
            $redirect = $this->url->link('checkout/checkout', '', 'SSL');
        endif;
        
        // Validate cart has products and has stock.
        if ((!$this->cart->hasProducts() && empty($this->session->data['giftcards'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))):
            $redirect = $this->url->link('checkout/cart');
        endif;
        
        // Validate minimum quantity requirments.
        $products = $this->cart->getProducts();
        
        foreach ($products as $product):
            $product_total = 0;
            
            foreach ($products as $product_2):
                if ($product_2['product_id'] == $product['product_id']):
                    $product_total+= $product_2['quantity'];
                endif;
            endforeach;
            
            if ($product['minimum'] > $product_total):
                $redirect = $this->url->link('checkout/cart');
                break;
            endif;
        endforeach;
        
        if (!$redirect):
            $total_data = array();
            $total      = 0;
            $taxes      = $this->cart->getTaxes();
            
            $this->theme->model('setting/module');
            
            $sort_order = array();
            
            $results = $this->model_setting_module->getModules('total');
            
            foreach ($results as $key => $value):
                $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
            endforeach;
            
            array_multisort($sort_order, SORT_ASC, $results);
            
            foreach ($results as $result):
                if ($this->config->get($result['code'] . '_status')):
                    $this->theme->model('total/' . $result['code']);
                    $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
                endif;
            endforeach;
            
            $sort_order = array();
            
            foreach ($total_data as $key => $value):
                $sort_order[$key] = $value['sort_order'];
            endforeach;
            
            array_multisort($sort_order, SORT_ASC, $total_data);
            
            $data = $this->theme->language('checkout/checkout');
            
            $order = array();
            
            $order['invoice_prefix'] = $this->config->get('config_invoice_prefix');
            $order['store_id']       = $this->config->get('config_store_id');
            $order['store_name']     = $this->config->get('config_name');
            
            if ($order['store_id']):
                $order['store_url'] = $this->config->get('config_url');
            else:
                $order['store_url'] = $this->get('http.server');
            endif;
            
            if ($this->customer->isLogged()):
                $order['customer_id']       = $this->customer->getId();
                $order['customer_group_id'] = $this->customer->getGroupId();
                $order['firstname']         = $this->customer->getFirstName();
                $order['lastname']          = $this->customer->getLastName();
                $order['email']             = $this->customer->getEmail();
                $order['telephone']         = $this->customer->getTelephone();
                
                $this->theme->model('account/address');
                
                $payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
            elseif (isset($this->session->data['guest'])):
                $order['customer_id']       = 0;
                $order['customer_group_id'] = $this->session->data['guest']['customer_group_id'];
                $order['firstname']         = $this->session->data['guest']['firstname'];
                $order['lastname']          = $this->session->data['guest']['lastname'];
                $order['email']             = $this->session->data['guest']['email'];
                $order['telephone']         = $this->session->data['guest']['telephone'];
                
                $payment_address = $this->session->data['guest']['payment'];
            endif;
            
            $order['payment_firstname']      = $payment_address['firstname'];
            $order['payment_lastname']       = $payment_address['lastname'];
            $order['payment_company']        = $payment_address['company'];
            $order['payment_company_id']     = $payment_address['company_id'];
            $order['payment_tax_id']         = $payment_address['tax_id'];
            $order['payment_address_1']      = $payment_address['address_1'];
            $order['payment_address_2']      = $payment_address['address_2'];
            $order['payment_city']           = $payment_address['city'];
            $order['payment_postcode']       = $payment_address['postcode'];
            $order['payment_zone']           = $payment_address['zone'];
            $order['payment_zone_id']        = $payment_address['zone_id'];
            $order['payment_country']        = $payment_address['country'];
            $order['payment_country_id']     = $payment_address['country_id'];
            $order['payment_address_format'] = $payment_address['address_format'];
            
            if (isset($this->session->data['payment_method']['title'])):
                $order['payment_method'] = $this->session->data['payment_method']['title'];
            else:
                $order['payment_method'] = '';
            endif;
            
            if (isset($this->session->data['payment_method']['code'])):
                $order['payment_code'] = $this->session->data['payment_method']['code'];
            else:
                $order['payment_code'] = '';
            endif;
            
            if ($this->cart->hasShipping()):
                if ($this->customer->isLogged()):
                    $this->theme->model('account/address');
                    $shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
                elseif (isset($this->session->data['guest'])):
                    $shipping_address = $this->session->data['guest']['shipping'];
                endif;
                
                $order['shipping_firstname']      = $shipping_address['firstname'];
                $order['shipping_lastname']       = $shipping_address['lastname'];
                $order['shipping_company']        = $shipping_address['company'];
                $order['shipping_address_1']      = $shipping_address['address_1'];
                $order['shipping_address_2']      = $shipping_address['address_2'];
                $order['shipping_city']           = $shipping_address['city'];
                $order['shipping_postcode']       = $shipping_address['postcode'];
                $order['shipping_zone']           = $shipping_address['zone'];
                $order['shipping_zone_id']        = $shipping_address['zone_id'];
                $order['shipping_country']        = $shipping_address['country'];
                $order['shipping_country_id']     = $shipping_address['country_id'];
                $order['shipping_address_format'] = $shipping_address['address_format'];
                
                if (isset($this->session->data['shipping_method']['title'])):
                    $order['shipping_method'] = $this->session->data['shipping_method']['title'];
                else:
                    $order['shipping_method'] = '';
                endif;
                
                if (isset($this->session->data['shipping_method']['code'])):
                    $order['shipping_code'] = $this->session->data['shipping_method']['code'];
                else:
                    $order['shipping_code'] = '';
                endif;
            else:
                $order['shipping_firstname']      = '';
                $order['shipping_lastname']       = '';
                $order['shipping_company']        = '';
                $order['shipping_address_1']      = '';
                $order['shipping_address_2']      = '';
                $order['shipping_city']           = '';
                $order['shipping_postcode']       = '';
                $order['shipping_zone']           = '';
                $order['shipping_zone_id']        = '';
                $order['shipping_country']        = '';
                $order['shipping_country_id']     = '';
                $order['shipping_address_format'] = '';
                $order['shipping_method']         = '';
                $order['shipping_code']           = '';
            endif;
            
            $product_data = array();
            
            foreach ($this->cart->getProducts() as $product):
                $option_data = array();
                
                foreach ($product['option'] as $option):
                    if ($option['type'] != 'file'):
                        $value = $option['option_value'];
                    else:
                        $value = $this->encryption->decrypt($option['option_value']);
                    endif;
                    
                    $option_data[] = array(
                        'product_option_id'       => $option['product_option_id'], 
                        'product_option_value_id' => $option['product_option_value_id'], 
                        'option_id'               => $option['option_id'], 
                        'option_value_id'         => $option['option_value_id'], 
                        'name'                    => $option['name'], 
                        'value'                   => $value, 
                        'type'                    => $option['type']
                    );
                endforeach;
                
                $product_data[] = array(
                    'product_id' => $product['product_id'], 
                    'name'       => $product['name'], 
                    'model'      => $product['model'], 
                    'option'     => $option_data, 
                    'download'   => $product['download'], 
                    'quantity'   => $product['quantity'], 
                    'subtract'   => $product['subtract'], 
                    'price'      => $product['price'], 
                    'total'      => $product['total'], 
                    'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']), 
                    'reward'     => $product['reward']
                );
            endforeach;
            
            // Gift card
            $giftcard_data = array();
            
            if (!empty($this->session->data['giftcards'])):
                foreach ($this->session->data['giftcards'] as $giftcard):
                    $giftcard_data[] = array(
                        'description'       => $giftcard['description'], 
                        'code'              => substr(md5(mt_rand()), 0, 10), 
                        'to_name'           => $giftcard['to_name'], 
                        'to_email'          => $giftcard['to_email'], 
                        'from_name'         => $giftcard['from_name'], 
                        'from_email'        => $giftcard['from_email'], 
                        'giftcard_theme_id' => $giftcard['giftcard_theme_id'], 
                        'message'           => $giftcard['message'], 
                        'amount'            => $giftcard['amount']
                    );
                endforeach;
            endif;
            
            $order['products']  = $product_data;
            $order['giftcards'] = $giftcard_data;
            $order['totals']    = $total_data;
            $order['comment']   = $this->session->data['comment'];
            $order['total']     = $total;
            
            /**
             * 3 ways to check for an affiliate, listed by precedence:
             * 1. Referral_id of logged in customer
             * 2. Referrer cookie
             * 3. Affiliate_id cookie
             */
            
            /**
             * We'll need our subtotal to calculate the commission
             */
            $subtotal = $this->cart->getSubTotal();

            // Load model
            
            $this->theme->model('account/affiliate');

            /**
             * Start with setting affiliate_id to false;
             */
            
            $affiliate_id = false;

            /**
             * Let's handle all logged in customers first
             */
            if ($this->customer->isLogged() && ($this->customer->getReferralId() > 0)):
                $affiliate_id = $this->customer->getReferralId();
            endif;

            /**
             * Not logged in or no referral_id, we can try cookies.
             * make sure we check that the affiliate_id is not already set
             */
            
            // referrer cookie
            if (!$affiliate_id && isset($this->request->cookie['referrer'])):
                $affiliate_id = $this->request->cookie['referrer'];
            endif;
            
            // affiliate_id cookie
            if (!$affiliate_id && isset($this->request->cookie['affiliate_id'])):
                $affiliate_id = $this->request->cookie['affiliate_id'];
            endif;

            if ($affiliate_id && ($affiliate_id !== $this->customer->getId())):
                $order['affiliate_id'] = $affiliate_id;
                $order['commission']   = $this->model_account_affiliate->getAffiliateCommission($affiliate_id);
            else:
                $order['affiliate_id'] = 0;
                $order['commission']   = 0;
            endif;
            
            $order['language_id']    = $this->config->get('config_language_id');
            $order['currency_id']    = $this->currency->getId();
            $order['currency_code']  = $this->currency->getCode();
            $order['currency_value'] = $this->currency->getValue($this->currency->getCode());
            $order['ip']             = $this->request->server['REMOTE_ADDR'];
            
            if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])):
                $order['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
            elseif (!empty($this->request->server['HTTP_CLIENT_IP'])):
                $order['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
            else:
                $order['forwarded_ip'] = '';
            endif;
            
            if (isset($this->request->server['HTTP_USER_AGENT'])):
                $order['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
            else:
                $order['user_agent'] = '';
            endif;
            
            if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])):
                $order['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
            else:
                $order['accept_language'] = '';
            endif;
            
            $this->theme->model('checkout/order');
            
            $this->session->data['order_id'] = $this->model_checkout_order->addOrder($order);
            
            $data['products'] = array();
            
            foreach ($this->cart->getProducts() as $product):
                $option_data = array();
                
                foreach ($product['option'] as $option):
                    if ($option['type'] != 'file'):
                        $value = $option['option_value'];
                    else:
                        $filename = $this->encryption->decrypt($option['option_value']);    
                        $value    = $this->encode->substr($filename, 0, $this->encode->strrpos($filename, '.'));
                    endif;
                    
                    $option_data[] = array(
                        'name'  => $option['name'], 
                        'value' => ($this->encode->strlen($value) > 20 ? $this->encode->substr($value, 0, 20) . '..' : $value)
                    );
                endforeach;
                
                $recurring = '';
                
                if ($product['recurring']):
                    $frequencies = array(
                        'day'        => $this->language->get('lang_text_day'), 
                        'week'       => $this->language->get('lang_text_week'), 
                        'semi_month' => $this->language->get('lang_text_semi_month'), 
                        'month'      => $this->language->get('lang_text_month'), 
                        'year'       => $this->language->get('lang_text_year')
                    );
                    
                    if ($product['recurring']['trial']):
                        $recurring = sprintf($this->language->get('lang_text_trial_description'), $this->currency->format($this->tax->calculate($product['recurring']['trial_price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax'))), $product['recurring']['trial_cycle'], $frequencies[$product['recurring']['trial_frequency']], $product['recurring']['trial_duration']) . ' ';
                    endif;
                    
                    if ($product['recurring']['duration']):
                        $recurring.= sprintf($this->language->get('lang_text_payment_description'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax'))), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
                    else:
                        $recurring.= sprintf($this->language->get('lang_text_payment_until_canceled_description'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax'))), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
                    endif;
                endif;
                
                $data['products'][] = array(
                    'key'        => $product['key'], 
                    'product_id' => $product['product_id'], 
                    'name'       => $product['name'], 
                    'model'      => $product['model'], 
                    'option'     => $option_data, 
                    'quantity'   => $product['quantity'], 
                    'subtract'   => $product['subtract'], 
                    'price'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'))), 
                    'total'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']), 
                    'href'       => $this->url->link('catalog/product', 'product_id=' . $product['product_id']), 
                    'recurring'  => $recurring
                );
            endforeach;
            
            // Gift Giftcard
            $data['giftcards'] = array();
            
            if (!empty($this->session->data['giftcards'])):
                foreach ($this->session->data['giftcards'] as $giftcard):
                    $data['giftcards'][] = array(
                        'description' => $giftcard['description'], 
                        'amount'      => $this->currency->format($giftcard['amount'])
                    );
                endforeach;
            endif;
            
            $data['totals']  = $total_data;
            $data['payment'] = $this->theme->controller('payment/' . $this->session->data['payment_method']['code']);
        else:
            $data['redirect'] = $redirect;
        endif;
        
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $this->response->setOutput($this->theme->view('checkout/confirm', $data));
    }
}
