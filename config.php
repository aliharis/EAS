<?php
/**
 * MySQL database connection details to be used later on
 * by pdo and other database access objects
 */
 
/** Database host (MySQL hostname) */
define ('DB_HOST', 'localhost');

/** MySQL database username to be used */
define ('DB_USER', 'root');

/** MySQL users password */
define ('DB_PASS', 'root');

/** MySQL database name  */
define ('DB_NAME', 'empdb');

/** Database driver to be used */
define ('DB_TYPE', 'pdo');




/**
 * Define all directory settings to be used for easy access and
 * in case any of the directories needs to be changed around.
 */
 
/** Full URL of host #http://site.com/script/ */
define ('HOST', 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']). '/');
 
/** Base path of the project */
define ('DIR_SEP', DIRECTORY_SEPARATOR); 

if (!defined('ABS_PATH'))
	define ('ABS_PATH', dirname(__FILE__) . '/');
	
/** Path to library folder */
define ('LIBS_PATH',  ABS_PATH . 'libs/');

/** Path to templates folder */
define ('TEMPLATES_PATH',  ABS_PATH . 'templates/');

/** Path to framework core files */
define ('CORE_PATH',  ABS_PATH . 'core/');

/** Path to controller files */
define ('CONTROLLERS_PATH',  ABS_PATH . 'controllers/');



// Set other ini settings
// date_default_timezone_set('Indian/Maldives');

define ('DEBUG',  TRUE);
 
