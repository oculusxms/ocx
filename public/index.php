<?php

/**
 * OCX - The Oculus XMS Framework
 *
 * @package Oculus
 * @author Vince Kronlein <vince@ocx.io>
 */

/*
|--------------------------------------------------------------------------
|	Turn Up the Heat!
|--------------------------------------------------------------------------
|
|	Build our application and get ready to dazzle your clients with all
|	your awesomeness!
|
*/

require dirname(__DIR__) . '/bootstrap/start.php';


/*
|--------------------------------------------------------------------------
|	Flush the Cache for Development
|--------------------------------------------------------------------------
|
|	Here we'll flush our cache if we have the caching turned off.
|
*/

if ($app->data['active.fascade'] !== INSTALL_FASCADE and !$app->data['config_cache_status']):
	$app->data['cache']->flush_cache();
endif;


/*
|--------------------------------------------------------------------------
|	Fire It UP!!!!
|--------------------------------------------------------------------------
|
|	3 ... 2 ... 1 ...
|
*/

$app->fire();
