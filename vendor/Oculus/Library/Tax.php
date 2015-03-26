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

class Tax extends LibraryService {
    
    private $shipping_address;
	private $payment_address;
	private $store_address;
	private $taxes;
    
    public function __construct(Container $app) {
        parent::__construct($app);

		$config  = $app['config'];
		$session = $app['session'];
		
		if (isset($session->data['shipping_country_id']) || isset($session->data['shipping_zone_id'])):
			$this->setShippingAddress($session->data['shipping_country_id'], $session->data['shipping_zone_id']);
		elseif ($config->get('config_tax_default') == 'shipping'):
			$this->setShippingAddress($config->get('config_country_id'), $config->get('config_zone_id'));
		endif;
		
		if (isset($session->data['payment_country_id']) || isset($session->data['payment_zone_id'])):
			$this->setPaymentAddress($session->data['payment_country_id'], $session->data['payment_zone_id']);
		elseif ($config->get('config_tax_default') == 'payment'):
			$this->setPaymentAddress($config->get('config_country_id'), $config->get('config_zone_id'));
		endif;
		
		$this->setStoreAddress($config->get('config_country_id'), $config->get('config_zone_id'));
    }

    public function setShippingAddress($country_id, $zone_id) {
		$this->shipping_address = array(
			'country_id' => $country_id,
			'zone_id'    => $zone_id
		);				
	}

	public function setPaymentAddress($country_id, $zone_id) {
		$this->payment_address = array(
			'country_id' => $country_id,
			'zone_id'    => $zone_id
		);
	}

	public function setStoreAddress($country_id, $zone_id) {
		$this->store_address = array(
			'country_id' => $country_id,
			'zone_id'    => $zone_id
		);
	}
							
  	public function calculate($value, $tax_class_id, $calculate = true) {
		if ($tax_class_id && $calculate):
			$amount = $this->getTax($value, $tax_class_id);
			return $value + $amount;
		else:
      		return $value;
    	endif;
  	}
	
  	public function getTax($value, $tax_class_id) {
		$amount = 0;
			
		$tax_rates = $this->getRates($value, $tax_class_id);
		
		foreach ($tax_rates as $tax_rate):
			$amount += $tax_rate['amount'];
		endforeach;
				
		return $amount;
  	}
		
	public function getRateName($tax_rate_id) {
		$db = parent::$app['db'];

		$tax_query = $this->db->query("
			SELECT name 
			FROM {$db->prefix}tax_rate 
			WHERE tax_rate_id = '" . (int)$tax_rate_id . "'
		");
	
		if ($tax_query->num_rows):
			return $tax_query->row['name'];
		else:
			return false;
		endif;
	}
	
    public function getRates($value, $tax_class_id) {
		$db       = parent::$app['db'];
		$customer = parent::$app['customer'];
		$config   = parent::$app['config'];

		$tax_rates = array();
		
		if ($customer->isLogged()):
			$customer_group_id = $customer->getGroupId();
		else:
			$customer_group_id = $config->get('config_customer_group_id');
		endif;
				
		if ($this->shipping_address):
			$tax_query = $db->query("
				SELECT 
					tr2.tax_rate_id, 
					tr2.name, 
					tr2.rate, 
					tr2.type, 
					tr1.priority 
				FROM {$db->prefix}tax_rule tr1 
				LEFT JOIN {$db->prefix}tax_rate tr2 
					ON (tr1.tax_rate_id = tr2.tax_rate_id) 
				INNER JOIN {$db->prefix}tax_rate_to_customer_group tr2cg 
					ON (tr2.tax_rate_id = tr2cg.tax_rate_id) 
				LEFT JOIN {$db->prefix}zone_to_geo_zone z2gz 
					ON (tr2.geo_zone_id = z2gz.geo_zone_id) 
				LEFT JOIN {$db->prefix}geo_zone gz 
					ON (tr2.geo_zone_id = gz.geo_zone_id) 
				WHERE tr1.tax_class_id = '" . (int)$tax_class_id . "' 
				AND tr1.based = 'shipping' 
				AND tr2cg.customer_group_id = '" . (int)$customer_group_id . "' 
				AND z2gz.country_id = '" . (int)$this->shipping_address['country_id'] . "' 
				AND (z2gz.zone_id = '0' OR z2gz.zone_id = '" . (int)$this->shipping_address['zone_id'] . "') 
				ORDER BY tr1.priority ASC
			");
			
			foreach ($tax_query->rows as $result):
				$tax_rates[$result['tax_rate_id']] = array(
					'tax_rate_id' => $result['tax_rate_id'],
					'name'        => $result['name'],
					'rate'        => $result['rate'],
					'type'        => $result['type'],
					'priority'    => $result['priority']
				);
			endforeach;
		endif;

		if ($this->payment_address):
			$tax_query = $db->query("
				SELECT 
					tr2.tax_rate_id, 
					tr2.name, 
					tr2.rate, 
					tr2.type, 
					tr1.priority 
					FROM {$db->prefix}tax_rule tr1 
					LEFT JOIN {$db->prefix}tax_rate tr2 
						ON (tr1.tax_rate_id = tr2.tax_rate_id) 
					INNER JOIN {$db->prefix}tax_rate_to_customer_group tr2cg 
						ON (tr2.tax_rate_id = tr2cg.tax_rate_id) 
					LEFT JOIN {$db->prefix}zone_to_geo_zone z2gz 
						ON (tr2.geo_zone_id = z2gz.geo_zone_id) 
					LEFT JOIN {$db->prefix}}geo_zone gz 
						ON (tr2.geo_zone_id = gz.geo_zone_id) 
					WHERE tr1.tax_class_id = '" . (int)$tax_class_id . "' 
					AND tr1.based = 'payment' 
					AND tr2cg.customer_group_id = '" . (int)$customer_group_id . "' 
					AND z2gz.country_id = '" . (int)$this->payment_address['country_id'] . "' 
					AND (z2gz.zone_id = '0' OR z2gz.zone_id = '" . (int)$this->payment_address['zone_id'] . "') 
					ORDER BY tr1.priority ASC
				");
			
			foreach ($tax_query->rows as $result):
				$tax_rates[$result['tax_rate_id']] = array(
					'tax_rate_id' => $result['tax_rate_id'],
					'name'        => $result['name'],
					'rate'        => $result['rate'],
					'type'        => $result['type'],
					'priority'    => $result['priority']
				);
			endforeach;
		endif;
		
		if ($this->store_address):
			$tax_query = $db->query("
				SELECT 
					tr2.tax_rate_id, 
					tr2.name, 
					tr2.rate, 
					tr2.type, 
					tr1.priority 
				FROM {$db->prefix}tax_rule tr1 
				LEFT JOIN {$db->prefix}tax_rate tr2 
					ON (tr1.tax_rate_id = tr2.tax_rate_id) 
				INNER JOIN {$db->prefix}tax_rate_to_customer_group tr2cg 
					ON (tr2.tax_rate_id = tr2cg.tax_rate_id) 
				LEFT JOIN {$db->prefix}zone_to_geo_zone z2gz 
					ON (tr2.geo_zone_id = z2gz.geo_zone_id) 
				LEFT JOIN {$db->prefix}geo_zone gz 
					ON (tr2.geo_zone_id = gz.geo_zone_id) 
				WHERE tr1.tax_class_id = '" . (int)$tax_class_id . "' 
				AND tr1.based = 'store' 
				AND tr2cg.customer_group_id = '" . (int)$customer_group_id . "' 
				AND z2gz.country_id = '" . (int)$this->store_address['country_id'] . "' 
				AND (z2gz.zone_id = '0' OR z2gz.zone_id = '" . (int)$this->store_address['zone_id'] . "') 
				ORDER BY tr1.priority ASC
			");
			
			foreach ($tax_query->rows as $result):
				$tax_rates[$result['tax_rate_id']] = array(
					'tax_rate_id' => $result['tax_rate_id'],
					'name'        => $result['name'],
					'rate'        => $result['rate'],
					'type'        => $result['type'],
					'priority'    => $result['priority']
				);
			endforeach;
		endif;
		
		$tax_rate_data = array();
		
		foreach ($tax_rates as $tax_rate):
			if (isset($tax_rate_data[$tax_rate['tax_rate_id']])):
				$amount = $tax_rate_data[$tax_rate['tax_rate_id']]['amount'];
			else:
				$amount = 0;
			endif;
			
			if ($tax_rate['type'] == 'F'):
				$amount += $tax_rate['rate'];
			elseif ($tax_rate['type'] == 'P'):
				$amount += ($value / 100 * $tax_rate['rate']);
			endif;
		
			$tax_rate_data[$tax_rate['tax_rate_id']] = array(
				'tax_rate_id' => $tax_rate['tax_rate_id'],
				'name'        => $tax_rate['name'],
				'rate'        => $tax_rate['rate'],
				'type'        => $tax_rate['type'],
				'amount'      => $amount
			);
		endforeach;
		
		return $tax_rate_data;
	}

  	public function has($tax_class_id) {
		return isset($this->taxes[$tax_class_id]);
  	}
}
