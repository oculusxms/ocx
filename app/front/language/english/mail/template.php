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

$_['text_subscribed']    = 'You are receiving this email because<br/>1.) You\'re a member of "' . parent::$app['config_name'] . '" or<br/>2.) You subscribed via <a href="' . parent::$app['http.server'] . '" style="color:#999;text-decoration:underline;">our website</a><br/>';
$_['text_unsubscribe']   = 'Want to be removed? No problem, <a href="' . parent::$app['http.server'] . 'contact" style="color:#999;text-decoration:underline;">click here</a> and let us know you\'d like to close your account.';

$_['text_address_block'] = '<a href="https://twitter.com/' . parent::$app['config_mail_twitter'] . '"><img src="' . parent::$app['http.server'] . 'image/data/email/footer_twitter.gif" width="42" height="42" alt="Twitter" title="Twitter" border="0" /></a><a href="http://www.facebook.com/' . parent::$app['config_mail_facebook'] . '"><img src="' . parent::$app['http.server'] . 'image/data/email/footer_fb.gif" width="42" height="42" alt="Facebook" title="Facebook" border="0" /></a><br><span style="color: #848484; font-weight: bold; font-size:14px">' . parent::$app['config_name'] . '</span><br><span style="color: #848484; font-weight: normal;">' . nl2br(parent::$app['config_address']) . '<br>' . parent::$app['config_telephone'] . '</span><br>';
