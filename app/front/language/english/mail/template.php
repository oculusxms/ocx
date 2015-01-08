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
$_['text_subscribed']    = 'You are receiving this email because<br/>1.) You\'re a member of "' . $this->app['config_name'] . '" or<br/>2.) You subscribed via <a href="' . $this->app['http.server'] . '" style="color:#999;text-decoration:underline;">our website</a><br/>';
$_['text_unsubscribe']   = 'Want to be removed? No problem, <a href="' . $this->app['http.server'] . 'contact" style="color:#999;text-decoration:underline;">click here</a> and let us know you\'d like to close your account.';

$_['text_address_block'] = '<a href="https://twitter.com/twitterpage"><img src="' . $this->app['http.server'] . 'image/email/footer_twitter.gif" width="42" height="42" alt="Twitter" title="Twitter" border="0" /></a><a href="http://www.facebook.com/yourpage"><img src="' . $this->app['http.server'] . 'image/email/footer_fb.gif" width="42" height="42" alt="Facebook" title="Facebook" border="0" /></a><br><span style="color: #848484; font-weight: bold; font-size:14px">' . $this->app['config_name'] . '</span><br><span style="color: #848484; font-weight: normal;">' . nl2br($this->app['config_address']) . '<br>' . $this->app['config_telephone'] . '</span><br>';
