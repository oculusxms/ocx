<?php

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Service\LibraryService;

class Tax extends LibraryService {
	
	private $tax_rates = array();

	public function __construct(Container $app) {
		parent::__construct($app);

		if (isset($app['session']->data['shipping_address'])):
			$this->setShippingAddress($app['session']->data['shipping_address']['country_id'], $app['session']->data['shipping_address']['zone_id']);
		elseif (parent::$app['config_tax_default'] == 'shipping'):
			$this->setShippingAddress(parent::$app['config_country_id'], parent::$app['config_zone_id']);
		endif;

		if (isset($app['session']->data['payment_address'])):
			$this->setPaymentAddress($app['session']->data['payment_address']['country_id'], $app['session']->data['payment_address']['zone_id']);
		elseif (parent::$app['config_tax_default'] == 'payment'):
			$this->setPaymentAddress(parent::$app['config_country_id'], parent::$app['config_zone_id']);
		endif;

		if (parent::$app['config_tax_default']):
			$this->setStoreAddress(parent::$app['config_country_id'], parent::$app['config_zone_id']);
		endif;
	}

	public function setShippingAddress($country_id, $zone_id) {
		$db 	= parent::$app['db'];
		$cache  = parent::$app['cache'];

		$key  = 'shipping.address.tax.' . $country_id . '.' . $zone_id;
		$rows = $cache->get($key);
		
		if (is_bool($rows)):
			$tax_query = $db->query("
				SELECT 
					tr1.tax_class_id, 
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
				WHERE tr1.based = 'shipping' 
				AND tr2cg.customer_group_id = '" . (int)parent::$app['config_customer_group_id'] . "' 
				AND z2gz.country_id = '" . (int)$country_id . "' 
				AND (z2gz.zone_id = '0' 
				OR z2gz.zone_id = '" . (int)$zone_id . "') 
				ORDER BY tr1.priority ASC
			");

			$rows = $tax_query->rows;
			$cache->set($key, $rows);
		endif;

		foreach ($rows as $result):
			$this->tax_rates[$result['tax_class_id']][$result['tax_rate_id']] = array(
				'tax_rate_id' => $result['tax_rate_id'],
				'name'        => $result['name'],
				'rate'        => $result['rate'],
				'type'        => $result['type'],
				'priority'    => $result['priority']
			);
		endforeach;
	}

	public function setPaymentAddress($country_id, $zone_id) {
		$db 	= parent::$app['db'];
		$cache  = parent::$app['cache'];

		$key  = 'payment.address.tax.' . $country_id . '.' . $zone_id;
		$rows = $cache->get($key);
		
		if (is_bool($rows)):
			$tax_query = $db->query("
				SELECT 
					tr1.tax_class_id, 
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
				WHERE tr1.based = 'payment' 
				AND tr2cg.customer_group_id = '" . (int)parent::$app['config_customer_group_id'] . "' 
				AND z2gz.country_id = '" . (int)$country_id . "' 
				AND (z2gz.zone_id = '0' 
				OR z2gz.zone_id = '" . (int)$zone_id . "') 
				ORDER BY tr1.priority ASC
			");

			$rows = $tax_query->rows;
			$cache->set($key, $rows);
		endif;

		foreach ($rows as $result):
			$this->tax_rates[$result['tax_class_id']][$result['tax_rate_id']] = array(
				'tax_rate_id' => $result['tax_rate_id'],
				'name'        => $result['name'],
				'rate'        => $result['rate'],
				'type'        => $result['type'],
				'priority'    => $result['priority']
			);
		endforeach;
	}

	public function setStoreAddress($country_id, $zone_id) {
		$db 	= parent::$app['db'];
		$cache  = parent::$app['cache'];

		$key  = 'store.address.tax.' . $country_id . '.' . $zone_id;
		$rows = $cache->get($key);
		
		if (is_bool($rows)):
			$tax_query = $db->query("
				SELECT 
					tr1.tax_class_id, 
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
				WHERE tr1.based = 'store' 
				AND tr2cg.customer_group_id = '" . (int)parent::$app['config_customer_group_id'] . "' 
				AND z2gz.country_id = '" . (int)$country_id . "' 
				AND (z2gz.zone_id = '0' 
				OR z2gz.zone_id = '" . (int)$zone_id . "') 
				ORDER BY tr1.priority ASC
			");

			$rows = $tax_query->rows;
			$cache->set($key, $rows);
		endif;

		foreach ($rows as $result):
			$this->tax_rates[$result['tax_class_id']][$result['tax_rate_id']] = array(
				'tax_rate_id' => $result['tax_rate_id'],
				'name'        => $result['name'],
				'rate'        => $result['rate'],
				'type'        => $result['type'],
				'priority'    => $result['priority']
			);
		endforeach;
	}

	public function calculate($value, $tax_class_id, $calculate = true) {
		if ($tax_class_id && $calculate):
			$amount = 0;

			$tax_rates = $this->getRates($value, $tax_class_id);

			foreach ($tax_rates as $tax_rate):
				if ($calculate != 'P' && $calculate != 'F'):
					$amount += $tax_rate['amount'];
				elseif ($tax_rate['type'] == $calculate):
					$amount += $tax_rate['amount'];
				endif;
			endforeach;

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
		$db 	= parent::$app['db'];
		$cache  = parent::$app['cache'];

		$key = 'tax.rate.name.' . $tax_rate_id;
		$cachefile = $cache->get($key);
		
		if (is_bool($cachefile)):
			$tax_query = $db->query("
				SELECT name 
				FROM {$db->prefix}tax_rate 
				WHERE tax_rate_id = '" . (int)$tax_rate_id . "'
			");

			if ($tax_query->num_rows):
				$cachefile = $tax_query->row['name'];
				$cache->set($key, $cachefile);
			else:
				$cache->set($key, 0);
				return false;
			endif;
		endif;

		return $cachefile;
	}

	public function getRates($value, $tax_class_id) {
		$tax_rate_data = array();

		if (isset($this->tax_rates[$tax_class_id])):
			foreach ($this->tax_rates[$tax_class_id] as $tax_rate):
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
		endif;

		return $tax_rate_data;
	}

	public function has($tax_class_id) {
		return isset($this->taxes[$tax_class_id]);
	}
}