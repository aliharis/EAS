<?php

require 'common.php';

switch ($_GET['act']) 
{
	case 'login':
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			// call to login function
			$user = login($_POST['username'], $_POST['password']);

			if ($user) {
				$_SESSION['username'] = $user['username'];
				$_SESSION['usertype'] = $user['usertype'];

				header("Location: index.php");
 			} else {
				echo "No record found";
			}
		}

		require TEMPLATES_PATH . 'login.html';
		exit;
}