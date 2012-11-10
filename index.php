<?php

require 'common.php';

switch ($_SESSION['usertype'])
{
	case "admin":
		require CONTROLLERS_PATH . 'admin.php';
		exit;


	case 'supervisor':
		require CONTROLLERS_PATH . 'supervisor.php';
		exit;

	case 'employee':
		require CONTROLLERS_PATH . 'employee.php';
		exit;
}