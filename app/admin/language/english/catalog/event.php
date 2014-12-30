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

// Heading
$_['heading_title']             = 'Events';

// Text
$_['text_no_results']           = 'There are no events to display.';
$_['text_no_results2']          = 'There are no attendees on the wait list for this event.';
$_['text_no_presenters']        = 'There are no presenters to display.';
$_['text_no_attendees']         = 'There are no attendees registered for this event.';
$_['text_yes']                  = 'Yes';
$_['text_no']                   = 'No';
$_['text_roster']               = 'Roster';
$_['text_event_name']           = 'Event Name: ';
$_['text_seats']                = 'Maximum Seats: ';
$_['text_available']            = 'Available Seats: ';
$_['text_presenter_tab']        = 'Presenters';
$_['text_add_success']          = 'You have successfully added an event.';
$_['text_add_i_success']        = 'You have successfully added an presenter.';
$_['text_add_s_success']        = 'You have successfully registered someone for this event.';
$_['text_edit_success']         = 'You have successfully edited an event.';
$_['text_edit_i_success']       = 'You have successfully edited an presenter.';
$_['text_delete_success']       = 'You have successfully deleted the selected events.';
$_['text_delete_i_success']     = 'You have successfully deleted the selected presenters.';
$_['text_delete_s_success']     = 'You have successfully deleted the selected people from this event.';
$_['text_monday']               = 'Monday';
$_['text_tuesday']              = 'Tuesday';
$_['text_wednesday']            = 'Wednesday';
$_['text_thursday']             = 'Thursday';
$_['text_friday']               = 'Friday';
$_['text_saturday']             = 'Saturday';
$_['text_sunday']               = 'Sunday';
$_['text_enabled']              = 'Enabled';
$_['text_disabled']             = 'Disabled';
$_['text_add']                  = 'Add to Event';
$_['text_remove']               = 'Remove from List';
$_['text_add_to_event']         = 'You have successfully added this customer to the event.';
$_['text_remove_from_list']     = 'You have successfully removed this customer from the wait list.';
$_['text_add_waitlist_success'] = 'You have successfully added this customer to the events wait list.';
$_['text_duplicate_attendee']   = 'This customer has already been added to the wait list for this event.';
$_['text_add_event_subject']    = 'Event - %s';
$_['text_add_event_message']    = 'You have been added to the event, %s.  You will find the event details below:';
$_['text_add_wait_subject']     = 'Event Wait List - %s';
$_['text_add_wait_message']     = 'You have been added to the wait list for the event, %s.  You will find the event details below:';
$_['text_default']              = 'Default';
$_['text_build']                = 'Build Slug';
$_['text_hangout']              = 'Google Hangout';

// Column
$_['column_event_name']         = 'Event Name';
$_['column_visibility']         = 'Visibility';
$_['column_date_time']          = 'Date/Time';
$_['column_location']           = 'Location';
$_['column_telephone']          = 'Telephone';
$_['column_cost']               = 'Cost';
$_['column_seats']              = 'Seats';
$_['column_filled']             = 'Available';
$_['column_waitlist']           = 'Wait List';
$_['column_presenter']          = 'Presenter';
$_['column_action']             = 'Action';
$_['column_name']               = 'Presenter Name';
$_['column_bio']                = 'Bio';
$_['column_attendee']           = 'Attendee Name';
$_['column_date_added']         = 'Date Added';

// Entry
$_['entry_name']                = 'Event Name:<br><span class="help">Enter a name for this event.</span>';
$_['entry_model']               = 'Model:<br><span class="help">Your event will also create a new product, a unique model is required for each product.</span>';
$_['entry_sku']                 = 'SKU:<br><span class="help">(optional)</span>';
$_['entry_category']            = 'Category:<br><span class="help">Select any product categories your event should fall under.</span>';
$_['entry_store']               = 'Store:';
$_['entry_stock_status']        = 'Out of Stock Status:<br><span class="help">The out of stock message to show for an out of stock event.</span>';
$_['entry_visibility']          = 'Visibility:<br><span class="help">Select the lowest customer group that\'s able to attend this event. Any group with a lower ID will not be able to see the event product.</span>';
$_['entry_event_length']        = 'Event Length:<br><span class="help">The length of your event in hours.<br>Min 1, Max 24.</span>';
$_['entry_event_days']          = 'Event Days:<br><span class="help">The day or days of the week in which your event will occur.</span>';
$_['entry_event_date']          = 'Event Date:';
$_['entry_event_time']          = 'Event Start Time:';
$_['entry_location']            = 'Event Location:<br><span class="help">Enter the address of a live local event.</span>';
$_['entry_hangout']             = 'Hangout Link:<br><span class="help">If your event is a Google Hangout,<br>enter the link here.</span>';
$_['entry_online']              = 'Google Hangout:<br><span class="help">If your event is a Google Hangout,<br>select yes and enter the link below.</span>';
$_['entry_cost']                = 'Event Cost:<br><span class="help">The cost for your event.<br>Enter 0 for FREE event.</span>';
$_['entry_seats']               = 'Maximum Seats:';
$_['entry_presenter_tab']       = 'Presenter Tab Name:<br><span class="help">This can be anything you like, Teacher, Host, Instructor. Default is Presenter.</span>';
$_['entry_presenter']           = 'Event Presenter:<br><span class="help">Select your presenter from the list.</span>';
$_['entry_telephone']           = 'Contact Telephone:<br><span class="help">(optional)</span>';
$_['entry_description']         = 'Event Description:<br><span class="help">Give some details for your event.</span>';
$_['entry_refundable']          = 'Refundable:<br><span class="help">Is your event refundable?</span>';
$_['entry_presenter_name']      = 'Presenter Name:';
$_['entry_bio']                 = 'Presenter Bio:';
$_['entry_customers']           = 'Select an Attendee:<br><span class="help">(autocomplete)</span>';
$_['entry_status']              = 'Event Status:';
$_['entry_slug']                = 'Slug:<br /><span class="help">Do not use spaces instead replace spaces with - and make sure the slug is globally unique.</span>';

// Button
$_['button_presenters']         = 'Presenters';
$_['button_delete_event']       = 'Delete Event';
$_['button_add_presenter']      = 'Add Presenter';
$_['button_delete_presenter']   = 'Delete Presenter';
$_['button_add_attendee']       = 'Add Attendee';
$_['button_delete_attendee']    = 'Delete Attendee';
$_['button_save']               = 'Save';
$_['button_cancel']             = 'Cancel';
$_['button_clear_list']         = 'Clear Wait List';
$_['button_add_waitlist']       = 'Add to Wait List';

// Error
$_['error_permission']          = 'You do not have permission to modify Events.';
$_['error_warning']             = 'Please correct the errors shown below.';
$_['error_name']                = 'Event Name must be between 1 and 150 characters';
$_['error_model']               = 'Model must be between 1 and 50 characters';
$_['error_event_length']        = 'Event Length must be between 1 and 40 characters';
$_['error_event_date']          = 'You must select a event date and it must be a future date.';
$_['error_event_time']          = 'You must select a event time';
$_['error_location']            = 'Event Location must be between 1 and 200 characters';
$_['error_hangout']             = 'If your event is online, you must provide a Hangout URL.';
$_['error_cost']                = 'You must enter a Event Cost';
$_['error_seats']               = 'You must enter the number of Event Seats';
$_['error_presenter']           = 'You must select a Event Presenter';
$_['error_description']         = 'You must enter a Event Description and description must be greater than 25 characters';
$_['error_presenter_name']      = 'Presenter Name must be between 1 and 150 characters';
$_['error_bio']                 = 'You must enter a bio and bio must be greater than 25 characters';
$_['error_attendee_required']   = 'Please select a attendee to add before clicking the Add Attendee button';
$_['error_attendee_exists']     = 'The selected attendee is already registered for this event.';
$_['error_event_days']          = 'You must select at least one day for the event.';
$_['error_slug']                = 'Warning: Slug is required for events.';
$_['error_slug_found']          = 'ERROR: The slug %s is already in use, please set a different one in the input field.';
$_['error_name_first']          = 'ERROR: Please enter a name for your event before attempting to build a slug.';

