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
|
|--------------------------------------------------------------------------
|	Oculus Framework Autoloader
|--------------------------------------------------------------------------
|
|	This autoloader loads all the Oculus Framework classes and is written
|	as a simple closure.  No need for a named function.
|	
*/

spl_autoload_register(function ($class) {
    $file = dirname(FRAMEWORK) . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    
    if (!is_readable($file)):
        return;
    else:
        
        /*
        |--------------------------------------------------------------------------
        |   Override Framework Files
        |--------------------------------------------------------------------------
        |
        |   All of our autoloaded framework classes are passed through this 
        |   statement so that they can be overriden by developers.
        |
        */

        if (substr($file, 0, strlen(FRAMEWORK)) == FRAMEWORK):
            $override = OVERRIDE . substr($file, strlen(dirname(FRAMEWORK)));
        endif;

        if (is_readable($override)):
            require $override;
        else:
            require $file;
        endif;

        return true;
    endif;
});

/*
|--------------------------------------------------------------------------
|	Application Autoloader
|--------------------------------------------------------------------------
|
|	This autoloader loads all of our classes from within the app directory.
|	Once again, no need for a named method, just use a simple closure.
|	
*/

spl_autoload_register(function ($class) {
    $file = APP_PATH . str_replace('\\', DIRECTORY_SEPARATOR, strtolower($class)) . '.php';
    
    if (!is_readable($file)):
        return;
    else:
        require $file;
        return true;
    endif;
});
