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

// Locale
$_['code']                  = 'en';
$_['direction']             = 'ltr';
$_['date_format_short']     = 'm/d/Y';
$_['date_format_long']      = 'l F dS, Y';
$_['time_format']           = 'g:i A';
$_['decimal_point']         = '.';
$_['thousand_point']        = ',';
$_['post_date']             = '\o\n F dS, Y \a\t g:i A';

// Text
$_['text_home']             = '<i class="fa fa-home fa-lg"></i>';
$_['text_yes']              = 'Yes';
$_['text_no']               = 'No';
$_['text_none']             = ' --- None --- ';
$_['text_select']           = ' --- Please Select --- ';
$_['text_all_zones']        = 'All Zones';
$_['text_pagination']       = 'Showing {start} to {end} of {total} ({pages} Pages)';
$_['text_separator']        = ' &raquo; ';
$_['text_read_more']        = 'Read More';
$_['text_by']               = 'by';

// Email goodies
$_['email_store_name']      = '<i>Thanks.<br><br>' . parent::$app['config_name'] . ' Management</i><br><br>';
$_['email_store_url']       = parent::$app['http.server'];
$_['email_server']          = '<i>Thanks.<br><br>OCX Server<br></i>';

$_['email_template'] = '
===========================================
' . parent::$app['config_name'] . '
===========================================

%s

Thanks.

' . parent::$app['config_name'] . ' Administration

==========================
' . parent::$app['config_name'] . '
' . parent::$app['http.server'] . '

' . parent::$app['config_address'] . '
' . parent::$app['config_telephone'] . '

-----------------------------------
You are receiving this because:
1.) You\'re a member of ' . parent::$app['http.server'] . ' or
2.) You subscribed via our website (' . parent::$app['http.server'] . ')

Want to be removed? No problem, click here:
' . parent::$app['http.server'] . 'contact
and let us know you\'d like to close your account.
-----------------------------------
http://twitter.com/twitterpage
http://www.facebook.com/yourpage
';

// Buttons
$_['button_add_address']    = 'Add Address';
$_['button_back']           = 'Back';
$_['button_continue']       = 'Continue';
$_['button_cart']           = 'Add to Cart';
$_['button_compare']        = 'Compare Product';
$_['button_wishlist']       = 'Add to Wish List';
$_['button_checkout']       = 'Checkout';
$_['button_confirm']        = 'Confirm Order';
$_['button_coupon']         = 'Apply Coupon';
$_['button_delete']         = 'Delete';
$_['button_download']       = 'Download';
$_['button_edit']           = 'Edit';
$_['button_filter']         = 'Refine Search';
$_['button_new_address']    = 'New Address';
$_['button_change_address'] = 'Change Address';
$_['button_reviews']        = 'Reviews';
$_['button_write']          = 'Write Review';
$_['button_login']          = 'Login';
$_['button_update']         = 'Update';
$_['button_remove']         = 'Remove';
$_['button_reorder']        = 'Reorder';
$_['button_return']         = 'Return';
$_['button_shopping']       = 'Continue Shopping';
$_['button_search']         = 'Search';
$_['button_shipping']       = 'Apply Shipping';
$_['button_guest']          = 'Guest Checkout';
$_['button_view']           = 'View';
$_['button_view_event']     = 'View Event';
$_['button_voucher']        = 'Apply Voucher';
$_['button_upload']         = 'Upload File';
$_['button_reward']         = 'Apply Points';
$_['button_quote']          = 'Get Quotes';
$_['button_submit']         = 'Submit';

// Error
$_['error_upload_1']        = 'Warning: The uploaded file exceeds the upload_max_filesize directive in php.ini.';
$_['error_upload_2']        = 'Warning: The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
$_['error_upload_3']        = 'Warning: The uploaded file was only partially uploaded.';
$_['error_upload_4']        = 'Warning: No file was uploaded.';
$_['error_upload_6']        = 'Warning: Missing a temporary folder.';
$_['error_upload_7']        = 'Warning: Failed to write file to disk.';
$_['error_upload_8']        = 'Warning: File upload stopped by extension.';
$_['error_upload_999']      = 'Warning: No error code available.';
