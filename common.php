<?php
/**
 * General settings and file inclusions required by the rest
 * of the application.
 */
 
session_start();

/** Get application settings and config */
require 'config.php';


/** Connect to database through PDO */
$db = new pdo(
	'mysql://host='.DB_HOST.';
	dbname='.DB_NAME.';', 
	DB_USER, 
	DB_PASS
);


/** Set error level for the database */
if (DEBUG === TRUE){
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}


/** Load core application files */
require LIBS_PATH . 'Session.php';
require CORE_PATH . 'Job.php';
require CORE_PATH . 'Department.php';
require CORE_PATH . 'Supervisor.php';
require CORE_PATH . 'Employee.php';
require CORE_PATH . 'Category.php';
require CORE_PATH . 'Task.php';

$Job = new Job($db);
$Department = new Department($db);
$Supervisor = new Supervisor($db);
$Employee = new Employee($db);
$Category = new Category($db);
$Task	  = new Task($db);

/** Check if the user has logged in */
if (!empty($_SESSION['username']) && !empty($_SESSION['usertype'])) {
	define('LOGGED_IN', TRUE);
} else {
	define('LOGGED_IN', FALSE);
}

/** URL Arguments */
$_GET['act'] = empty($_GET['act']) ? 'default' : $_GET['act'];

/** If not logged in, redirect to login page */
if ($_GET['act'] != "login" && LOGGED_IN === FALSE) {
	header("Location: users.php?act=login");
}