<?php

namespace Front\Model\Widget;
use Oculus\Engine\Model;

class Event extends Model {
	public function getEvents($customer_id) {
		$events_data = array();
		$time 		 = time();
		
		$events = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}event_manager 
			WHERE date_end > NOW()");
		
		if ($events):
			foreach ($events->rows as $event):
				if (!empty($event['roster'])):
					foreach (unserialize($event['roster']) as $roster):
						if ($roster['attendee_id'] == $customer_id):
							$events_data[] = array(
								'event_id'		=> $event['event_id'],
								'date_time'		=> $event['date_time'],
								'name'			=> $event['event_name'],
								'online'		=> $event['online'],
								'hangout'		=> $event['hangout'],
								'location'		=> $event['location'],
								'event_days'	=> unserialize($event['event_days']),
								'telephone'		=> $event['telephone']
							);
							break;
						endif;
					endforeach;
				endif;
			endforeach;
		endif;

		return $events_data;
	}
}