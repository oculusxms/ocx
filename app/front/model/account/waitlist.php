<?php

namespace Front\Model\Account;
use Oculus\Engine\Model;

class Waitlist extends Model {

	public function getWaitLists($customer_id) {
		$waitlist_data = array();
		
		$waitlists_query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}event_wait_list 
			WHERE customer_id = '" . (int)$customer_id . "'");
		
		if ($waitlists_query->num_rows):
			foreach ($waitlists_query->rows as $waitlist):
				$waitlist_data[] = array(
					'event_id' => $waitlist['event_id']
				);
			endforeach;
		endif;

		return $waitlist_data;
	}

	public function getEventInfo($event_id) {
		
		$event_data = array();
		
		$event_query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}event_manager 
			WHERE event_id = '" . (int)$event_id . "'");
		
		if ($event_query->num_rows):
			$event_data = array(
				'event_id'		=> $event_query->row['event_id'],
				'date_time'		=> $event_query->row['date_time'],
				'name'			=> $event_query->row['event_name'],
				'location'		=> $event_query->row['location'],
				'telephone'		=> $event_query->row['telephone']
			);
		endif;

		return $event_data;
	}

	public function remove($event_id, $customer_id) {
		$this->db->query("
			DELETE FROM {$this->db->prefix}event_wait_list 
			WHERE event_id = '" . (int)$event_id . "' 
			AND customer_id = '" . (int)$customer_id . "'");
		
		return;
	}
}
