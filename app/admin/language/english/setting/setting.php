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
$_['heading_title']                = 'Settings';

// Text
$_['text_success']                 = 'Success: You have modified settings.';
$_['text_flush_success']           = 'The cache has been flushed successfully.';
$_['text_items']                   = 'Items';
$_['text_product']                 = 'Products';
$_['text_voucher']                 = 'Vouchers';
$_['text_tax']                     = 'Taxes';
$_['text_account']                 = 'Account';
$_['text_checkout']                = 'Checkout';
$_['text_stock']                   = 'Stock';
$_['text_affiliate']               = 'Affiliates';
$_['text_return']                  = 'Returns';
$_['text_image_manager']           = 'Image Manager';
$_['text_browse']                  = 'Browse';
$_['text_clear']                   = 'Clear';
$_['text_shipping']                = 'Shipping Address';
$_['text_payment']                 = 'Payment Address';
$_['text_mail']                    = 'Mail';
$_['text_smtp']                    = 'SMTP';
$_['text_top_level']               = 'Example: if you have a product that is normally linked as ' . parent::$app['http.public'] . '<b>mobile-phones/apple/iphone5</b>, with this setting enabled your link will now show as ' . parent::$app['http.public'] . '<b>iphone5</b>';
$_['text_ucfirst']                 = 'Example: ' . parent::$app['http.public'] . '<b>mobile-phones/apple/iphone5</b> will become: ' . parent::$app['http.public'] . '<b>Mobile-Phones/Apple/Iphone5</b>';
$_['text_description']             = 'OCX ships with 3 possible caching mechanisms for caching your queries.  Code caching is handled automatically by the Autoloader method to use either APC, Opcache for PHP 5.5 and above, or none if you have neither installed. However you\'ll need to select a caching class for your queries.  Memcache is highly recommended if you have a large number of products or high traffic or both.';
$_['text_available']               = 'Only your available choices will show in the menu below.  If you wish to use a different method, please install it on your server and it will become available here.';
$_['text_style_shop']              = 'Shop';
$_['text_style_site']              = 'Website';

// Entry
$_['entry_name']                   = 'Store Name:';
$_['entry_owner']                  = 'Store Owner:';
$_['entry_address']                = 'Address:';
$_['entry_email']                  = 'E-Mail:<br><span class="help">This serves as the from email for all outgoing email from your site.</span>';
$_['entry_admin_email']			   = 'Administrator E-Mail:<br><span class="help">This is a personal admin email address where the administrator can receive notification emails from the server.</span>';
$_['entry_telephone']              = 'Telephone:';
$_['entry_title']                  = 'Title:';
$_['entry_meta_description']       = 'Meta Tag Description:';
$_['entry_layout']                 = 'Default Layout:';
$_['entry_site_style']             = 'Public Layout Style:<br><span class="help">Website will use Shop link for store, Shop will use Blog link to blog.</span>';
$_['entry_home_page']              = 'Home Page:<br><span class="help">Select a specific page to use as your home page. This setting only applies if you selected <strong>website</strong> as your Public Layout Style above. If you don\'t set this, the normal blog roll page will be shown.</span>';
$_['entry_theme']                  = 'Store Theme:';
$_['entry_admin_theme']            = 'Admin Theme:';
$_['entry_country']                = 'Country:';
$_['entry_zone']                   = 'Region / State:';
$_['entry_language']               = 'Language:';
$_['entry_admin_language']         = 'Administration Language:';
$_['entry_currency']               = 'Currency:<br /><span class="help">Change the default currency. Clear your browser cache to see the change and reset your existing cookie.</span>';
$_['entry_currency_auto']          = 'Auto Update Currency:<br /><span class="help">Set your store to automatically update currencies daily.</span>';
$_['entry_length_class']           = 'Length Class:';
$_['entry_weight_class']           = 'Weight Class:';
$_['entry_catalog_limit']          = 'Default Items Per Page (Catalog):<br /><span class="help">Determines how many catalog items are shown per page (products, categories, etc)</span>';
$_['entry_admin_limit']            = 'Default Items Per Page (Admin):<br /><span class="help">Determines how many admin items are shown per page (orders, customers, etc)</span>';
$_['entry_product_count']          = 'Category Product Count:<br /><span class="help">Show the number of products within the subcategories in the store front header category menu. Be very, very aware that this will cause an extreme performance hit for stores with a lot of subcategories.</span>';
$_['entry_review']                 = 'Allow Reviews:<br /><span class="help">Enable/disable new review entry and display of existing reviews</span>';
$_['entry_download']               = 'Allow Downloads:';
$_['entry_voucher_min']            = 'Voucher Min:<br /><span class="help">Minimum amount for which a customer can purchase a voucher.</span>';
$_['entry_voucher_max']            = 'Voucher Max:<br /><span class="help">Maximum amount for which a customer can purchase a voucher.</span>';
$_['entry_tax']                    = 'Display Prices with Tax:';
$_['entry_vat']                    = 'VAT Number Validate:<br /><span class="help">Validate VAT number with http://ec.europa.eu service.</span>';
$_['entry_tax_default']            = 'Use Store Tax Address:<br /><span class="help">Use the store address to calculate taxes if no one is logged in. You can choose to use the store address for the customers shipping or payment address.</span>';
$_['entry_tax_customer']           = 'Use Customer Tax Address:<br /><span class="help">Use the customers default address when they login to calculate taxes. You can choose to use the default address for the customers shipping or payment address.</span>';
$_['entry_customer_online']        = 'Customers Online:<br /><span class="help">Track customers online via the customer reports section.</span>';
$_['entry_customer_group']         = 'Customer Group:<br /><span class="help">Default customer group.</span>';
$_['entry_customer_group_display'] = 'Customer Groups:<br /><span class="help">Displays customer groups new customers can select when signing up, such as wholesale and business .</span>';
$_['entry_customer_price']         = 'Login Display Prices:<br /><span class="help">Only show prices when a customer is logged in.</span>';
$_['entry_account']                = 'Account Terms:<br /><span class="help">This forces people to agree to terms before an account can be created.</span>';
$_['entry_cart_weight']            = 'Display Weight on Cart Page:<br /><span class="help">Show the cart weight on the cart page</span>';
$_['entry_guest_checkout']         = 'Guest Checkout:<br /><span class="help">Allow customers to checkout without creating an account. This will not be available when a downloadable product is in the shopping cart.</span>';
$_['entry_checkout']               = 'Checkout Terms:<br /><span class="help">This forces people to agree to terms before a customer can checkout.</span>';
$_['entry_order_edit']             = 'Order Editing:<br /><span class="help">Number of days allowed to edit an order. This is required because prices and discounts may change over time corrupting the order if it\'s edited.</span>';
$_['entry_invoice_prefix']         = 'Invoice Prefix:<br /><span class="help">Set the invoice prefix (e.g. INV-2011-00). Invoice IDs will start at 1 for each unique prefix</span>';
$_['entry_order_status']           = 'Order Status:<br /><span class="help">Set the default order status when an order is processed.</span>';
$_['entry_complete_status']        = 'Complete Order Status:<br /><span class="help">Set the status the customer\'s order must reach prior to being allowed access to their downloadable products and gift vouchers.</span>';
$_['entry_stock_display']          = 'Display Stock:<br /><span class="help">Display stock quantity on the product page.</span>';
$_['entry_stock_warning']          = 'Show Out Of Stock Warning:<br /><span class="help">Display out of stock message on the shopping cart page if a product is out of stock but stock checkout is yes. (Warning always shows if stock checkout is no)</span>';
$_['entry_stock_checkout']         = 'Stock Checkout:<br /><span class="help">Allow customers to continue with checkout if the products they are ordering are not in stock.</span>';
$_['entry_stock_status']           = 'Out of Stock Status:<br /><span class="help">Set the default out of stock status selected in product edit.</span>';
$_['entry_affiliate']              = 'Affiliate Terms:<br /><span class="help">This forces people to agree to terms before an affiliate account can be created.</span>';
$_['entry_commission']             = 'Affiliate Commission (%):<br /><span class="help">The default affiliate commission percentage.</span>';
$_['entry_return']                 = 'Return Terms:<br /><span class="help">This forces people to agree to terms before a return account can be created.</span>';
$_['entry_return_status']          = 'Return Status:<br /><span class="help">Set the default return status when a return request is submitted.</span>';
$_['entry_logo']                   = 'Store Logo:';
$_['entry_icon']                   = 'Icon:<br /><span class="help">The icon should be a PNG that is 16px x 16px.</span>';
$_['entry_image_category']         = 'Category Image Size:';
$_['entry_image_thumb']            = 'Product Image Thumb Size:';
$_['entry_image_popup']            = 'Product Image Popup Size:';
$_['entry_image_product']          = 'Product Image List Size:';
$_['entry_image_additional']       = 'Additional Product Image Size:';
$_['entry_image_related']          = 'Related Product Image Size:';
$_['entry_image_compare']          = 'Compare Image Size:';
$_['entry_image_wishlist']         = 'Wish List Image Size:';
$_['entry_image_cart']             = 'Cart Image Size:';
$_['entry_ftp_host']               = 'FTP Host:';
$_['entry_ftp_port']               = 'FTP Port:';
$_['entry_ftp_username']           = 'FTP Username:';
$_['entry_ftp_password']           = 'FTP Password:';
$_['entry_ftp_root']               = 'FTP Root:<span class="help">The directory where your OCX installation is normally stored \'public_html/\'.</span>';
$_['entry_ftp_status']             = 'Enable FTP:';
$_['entry_mail_protocol']          = 'Mail Protocol:<span class="help">Only choose \'Mail\' unless your host has disabled the PHP mail function.</span>';
$_['entry_mail_parameter']         = 'Mail Parameters:<span class="help">When using \'Mail\', additional mail parameters can be added here (e.g. "-femail@storeaddress.com").</span>';
$_['entry_smtp_host']              = 'SMTP Host:';
$_['entry_smtp_username']          = 'SMTP Username:';
$_['entry_smtp_password']          = 'SMTP Password:';
$_['entry_smtp_port']              = 'SMTP Port:';
$_['entry_smtp_timeout']           = 'SMTP Timeout:';
$_['entry_mail_twitter']		   = 'Twitter Handle:<br><span class="help">Your Twitter handle for your store. DO NOT include the http address, just the handle. IE: Oculus <b>NOT</b> http://twitter.com/Oculus.</span>';	
$_['entry_mail_facebook']		   = 'Facebook Page:<br><span class="help">Your Facebook page for your store. DO NOT include the http address, just the page name. IE: Oculus <b>NOT</b> http://www.facebook.com/Oculus.</span>';	
$_['entry_account_mail']           = 'New Account Alert Mail:<br /><span class="help">Send an E-mail to the store owner when a new account is registered.</span>';
$_['entry_alert_mail']             = 'New Order Alert Mail:<br /><span class="help">Send an E-mail to the store owner when a new order is created.</span>';
$_['entry_alert_emails']           = 'Additional Alert E-Mails:<br /><span class="help">Any additional E-mail accounts you want alert E-mails sent to, in addition to the main store email. (comma separated)</span>';
$_['entry_fraud_detection']        = 'Use MaxMind Fraud Detection System:<br /><span class="help">MaxMind is a fraud detection service. If you don\'t have a license key you can <a href="http://www.maxmind.com/" target="_blank"><u>sign up here</u></a>. Once you have obtained a key copy you can paste it into the field below.</span>';
$_['entry_fraud_key']              = 'MaxMind License Key:</span>';
$_['entry_fraud_score']            = 'MaxMind Risk Score:<br /><span class="help">The higher the score the more likely the order is fraudulent. Set a score between 0 - 100.</span>';
$_['entry_fraud_status']           = 'MaxMind Fraud Order Status:<br /><span class="help">Orders over your set score will be assigned this order status and will not be allowed to reach the complete status automatically.</span>';
$_['entry_secure']                 = 'Use SSL:<br /><span class="help">To use SSL check with your host if a SSL certificate is installed and added the SSL URL to the catalog and admin config files.</span>';
$_['entry_shared']                 = 'Use Shared Sessions:<br /><span class="help">Try to share the session cookie between stores so the cart can be passed between different domains.</span>';
$_['entry_robots']                 = 'Robots:<br /><span class="help">A list of web crawler user agents that shared sessions will not be used with. Use separate lines for each user agent.</span>';

$_['entry_top_level']              = 'Make URLs Top Level:<br><span class="help">This will force all links for products, categories, manufacturers and pages to appear as top level URLs.</span>';
$_['entry_ucfirst']                = 'UC First:<br><span class="help">Enabling this setting will convert your URL slugs to capitalize the first letter of each word.</span>';

$_['entry_file_extension_allowed'] = 'Allowed File Extensions:<br /><span class="help">Add which file extensions are allowed to be uploaded. Use a new line for each value.</span>';
$_['entry_file_mime_allowed']      = 'Allowed File Mime Types:<br /><span class="help">Add which file mime types are allowed to be uploaded. Use a new line for each value.</span>';
$_['entry_maintenance']            = 'Maintenance Mode:<br /><span class="help">Prevents customers from browsing your store. They will instead see a maintenance message. If logged in as admin, you will see the store as normal.</span>';
$_['entry_password']               = 'Allow Forgotten Password:<br /><span class="help">Allow forgotten password to be used for the admin. This will be disabled automatically if the system detects a hack attempt.</span>';
$_['entry_encryption']             = 'Encryption Key:<br /><span class="help">Please provide a secret key that will be used to encrypt private information when processing orders.</span>';
$_['entry_compression']            = 'Output Compression Level:<br /><span class="help">GZIP for more efficient transfer to requesting clients. Compression level must be between 0 - 9</span>';
$_['entry_error_display']          = 'Display Errors:';
$_['entry_error_log']              = 'Log Errors:';
$_['entry_error_filename']         = 'Error Log Filename:';
$_['entry_google_analytics']       = 'Google Analytics Code:<br /><span class="help">Login to your <a href="http://www.google.com/analytics/" target="_blank"><u>Google Analytics</u></a> account and after creating your web site profile copy and paste the Google Analytics code into this field.</span>';
$_['entry_caches']                 = 'Query Cache Type:';
$_['entry_cache_status']           = 'Cache Status:<br><span class="help">If Disabled, your cache will still be used, but will be flushed on each page load. Disable this ONLY during development.</span>';
$_['entry_default_visibility']     = 'Content Visibility:<br><span class="help">This sets the default visibility for blog posts and pages so that you can control which posts/pages are publicly viewable.</span>';
$_['entry_free_customer']          = 'Free Customer Level:<br><span class="help">Select your free customer group for determining content visibility.</span>';
$_['entry_default_category']       = 'Owner Blog Category:<br><span class="help">Select your Owner Blog category.</span>';
$_['entry_delete_posts']           = 'Delete Posts?:<br><span class="help">When a customer with write priviledges is deleted should we delete their posts. <span class="text-danger"><b>Recommended: NO</b></span></span>';
$_['entry_assign_to']              = 'Assign Posts To:<br><span class="help">(autocomplete)<br>If keeping posts, select a customer account to assign as the new author.<br><span class="text-danger"><b>Must be active, and Top Customer Level.</b></span></span>';
$_['entry_top_customer']           = 'Top Customer Level:<br><span class="help">Your top level customer group.</span>';
$_['entry_member_image_dir']       = 'Upload Image Directory:<br><span class="help">Set the base upload folder for blog writers so that they can only access their own images. <br>Do not include a trailing slash.</span>';
$_['entry_review_anonymous']       = 'Anonymous Reviews:<br><span class="help">Set to yes to allow anonymous reviews, no to require customers to be logged in to post a review.</span>';

// Error
$_['error_warning']                = 'Warning: Please check the form carefully for errors.';
$_['error_permission']             = 'Warning: You do not have permission to modify settings.';
$_['error_name']                   = 'Store name must be between 3 and 32 characters.';
$_['error_owner']                  = 'Store owner must be between 3 and 64 characters.';
$_['error_address']                = 'Store address must be between 10 and 256 characters.';
$_['error_email']                  = 'E-Mail address does not appear to be valid.';
$_['error_admin_email']            = 'Administrator email is required.';
$_['error_telephone']              = 'Telephone must be between 3 and 32 characters.';
$_['error_title']                  = 'Title must be between 3 and 32 characters.';
$_['error_limit']                  = 'Limit required.';
$_['error_customer_group_display'] = 'You must include the default customer group in order to use this feature.';
$_['error_voucher_min']            = 'Minimum voucher amount required.';
$_['error_voucher_max']            = 'Maximum voucher amount required.';
$_['error_image_thumb']            = 'Product image thumb size dimensions required.';
$_['error_image_popup']            = 'Product image pop-up size dimensions required.';
$_['error_image_product']          = 'Product list size dimensions required.';
$_['error_image_category']         = 'Category list size dimensions required.';
$_['error_image_additional']       = 'Additional product image size dimensions required.';
$_['error_image_related']          = 'Related product image size dimensions required.';
$_['error_image_compare']          = 'Compare image size dimensions required.';
$_['error_image_wishlist']         = 'Wish list image size dimensions required.';
$_['error_image_cart']             = 'Cart image size dimensions required.';
$_['error_ftp_host']               = 'FTP Host required.';
$_['error_ftp_port']               = 'FTP Port required.';
$_['error_ftp_username']           = 'FTP Username required.';
$_['error_ftp_password']           = 'FTP Password required.';
$_['error_error_filename']         = 'Error Log Filename required.';
$_['error_encryption']             = 'Encryption must be between 3 and 32 characters.';
$_['error_default_visibility']     = 'Please select a Content Visibility.';
$_['error_free_customer']          = 'Please select a Free Customer Level.';
$_['error_top_customer']           = 'Please select a Top Customer Level.';
$_['error_assign_to']              = 'If you\'re not deleting posts, you must assign a new author.';
$_['error_member_image_dir']       = 'Please set the Upload Image Directory for member uploaded pictures.';
