<?php

namespace Front\Model\Total;
use Oculus\Engine\Model;

class Loworderfee extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if ($this->cart->getSubTotal() && ($this->cart->getSubTotal() < $this->config->get('loworderfee_total'))) {
			$this->language->load('total/loworderfee');

			$total_data[] = array( 
				'code'       => 'loworderfee',
				'title'      => $this->language->get('text_loworderfee'),
				'text'       => $this->currency->format($this->config->get('loworderfee_fee')),
				'value'      => $this->config->get('loworderfee_fee'),
				'sort_order' => $this->config->get('loworderfee_sort_order')
			);

			if ($this->config->get('loworderfee_tax_class_id')) {
				$tax_rates = $this->tax->getRates($this->config->get('loworderfee_fee'), $this->config->get('loworderfee_tax_class_id'));

				foreach ($tax_rates as $tax_rate) {
					if (!isset($taxes[$tax_rate['tax_rate_id']])) {
						$taxes[$tax_rate['tax_rate_id']] = $tax_rate['amount'];
					} else {
						$taxes[$tax_rate['tax_rate_id']] += $tax_rate['amount'];
					}
				}
			}

			$total += $this->config->get('loworderfee_fee');
		}
	}
}