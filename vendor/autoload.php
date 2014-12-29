<?php

/*
|--------------------------------------------------------------------------
|	Override Function for Framework Overrides
|--------------------------------------------------------------------------
|
|	All of our autoloaded framework classes are passed through this method
|	so that they can be overriden by developers.
|
*/

function override($filename) {
	if (substr($filename, 0, strlen(FRAMEWORK)) == FRAMEWORK):
		$file = dirname(APP_PATH) . '/override' . substr($filename, strlen(dirname(FRAMEWORK)));
	endif;
	
	if (is_readable($file)):
		return $file;
	else:
		return $filename;
	endif;
}

/*
|--------------------------------------------------------------------------
|	Oculus Framework Autoloader
|--------------------------------------------------------------------------
|
|	This autoloader loads all the Oculus Framework classes and is written
|	as a simple closure.  No need for a named function.
|	
*/

spl_autoload_register(function($class) {
	$file = dirname(FRAMEWORK) . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

	if (!is_readable($file)):
		return;
	else:
		require override($file);
		return true;
	endif;
});

/*
|--------------------------------------------------------------------------
|	Include our Helper files
|--------------------------------------------------------------------------
|
|	All helper files with no classes need to be loaded traditionally
|
*/

require	override(FRAMEWORK . 'Helper/json.php');
require override(FRAMEWORK . 'Helper/utf8.php');
require override(FRAMEWORK . 'Helper/vat.php');


/*
|--------------------------------------------------------------------------
|	Application Autoloader
|--------------------------------------------------------------------------
|
|	This autoloader loads all of our classes from within the app directory.
|	Once again, no need for a named method, just use a simple closure.
|	
*/

spl_autoload_register(function($class) {
	$file = APP_PATH . str_replace('\\', DIRECTORY_SEPARATOR, strtolower($class)) . '.php';

	if (!is_readable($file)):
		return;
	else:
		require $file;
		return true;
	endif;
});
