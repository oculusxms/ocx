<?php

define('OCX_START', microtime(true));
define('VERSION', '1.0.11');

/*
|--------------------------------------------------------------------------
|	Environment and Paths
|--------------------------------------------------------------------------
|
|	Lets require our paths and configuration array so we can boot this baby
|	up and change the world as we know it!
|
*/

require __DIR__ . '/paths.php';

/*
|--------------------------------------------------------------------------
|	Register the Autoloader
|--------------------------------------------------------------------------
|
| 	Let's make sure we can load up some classes or our users aren't gonna
|	have much of an experience with our super cool application.
|
*/

if ($loader = dirname(FRAMEWORK) . '/autoload.php'):
	require $loader;
endif;


/*
|--------------------------------------------------------------------------
|	Installer??
|--------------------------------------------------------------------------
|
|	If our install fascade is called let's make sure we stay within the
|	installer application.  We'll let the installer app work out whether
|	we need to do an upgrade or new install.
|
*/

if (preg_match('/^\/(' . INSTALL_FASCADE . ')/', $_SERVER['REQUEST_URI'])):
	$app = new Oculus\Engine\Installer;
	return $app->buildConfigRequest($config);
else:
	/**
	 * 	We also need to redirect calls to the app when no db config 
	 * 	file exists.
	 */
	if (!is_readable($config['base']['path.database'] . 'config/db.php')):
		header('Location: ' . INSTALL_FASCADE);
	else:
		require $config['base']['path.database'] . 'config/db.php';
	endif;
endif;


/*
|--------------------------------------------------------------------------
|	Assemble Application
|--------------------------------------------------------------------------
|	Here we'll instantiate our application class and push through our 
|	config array so that we can set it to the IoC container.
|
*/

$app = new Oculus\Engine\Application;

return $app->buildConfigRequest($config);
