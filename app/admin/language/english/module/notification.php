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
$_['heading_title']    = 'Notifications';

// Text
$_['text_system']      = 'System';
$_['text_user']        = 'User';
$_['text_success']     = 'Success: You have modified notifications.';

// Column
$_['column_name']      = 'Name';
$_['column_slug']      = 'Slug';
$_['column_type']      = 'Type';
$_['column_action']    = 'Action';

// Entry
$_['entry_email_slug'] = 'Function Slug:<br><span class="help">This is the function slug that\'s used to call your notification throughout the OCX system. Only user added notification slugs are editable.</span>';
$_['entry_text']       = 'Text Version:<br><span class="help">Text version of your notification, sent only in emails.</span>';
$_['entry_html']       = 'HTML Version:<br><span class="help">HTML version of your notification, sent in both emails and internal notifications.</span>';

// Error
$_['error_warning']    = 'Warning: Please check the form carefully for errors.';
$_['error_permission'] = 'Warning: You do not have permission to modify notifications.';
$_['error_text']       = 'Text version is required.';
$_['error_html']       = 'HTML version is required.';
$_['error_email_slug'] = 'A function slug is required for your notification.';
$_['error_system']     = 'System notifications cannot be deleted.';
