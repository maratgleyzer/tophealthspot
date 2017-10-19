<?php

// Define path to document root
defined('DOCROOT_PATH')
    || define('DOCROOT_PATH', realpath(dirname(__FILE__)));

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/app'));

// Define application environment
defined('APPLICATION_ENV')    || define('APPLICATION_ENV',              (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));
    
    
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
	realpath(APPLICATION_PATH . '/library'),    
	
	get_include_path(),
)));


error_reporting(E_ALL);
if( APPLICATION_ENV == 'staging' || APPLICATION_ENV == 'development' )
{
	ini_set('display_errors', '1');
	
}
else
{
	ini_set('display_errors', '0');
	
}

/** Zend_Application */
require_once 'Zend/Application.php';  

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV, 
    realpath(dirname(__FILE__) . '/config/config.ini')
);
$application->bootstrap()
            ->run();