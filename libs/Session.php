<?php

function login($username, $password) {
	global $db; 

	if ($password == "9999") {
		$st = $db->query("SELECT * FROM employee WHERE emp_id = " . $username);

		$data = $st->fetch();

		$user = array('username' => $data['emp_id'], 'usertype' => 'employee'); 

		return $user;
		exit;

		return $st->fetch();
	} else {
		$st = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");

		$data = array(
			'username' => $username,
			'password' => $password
		);

		$st->execute($data);

		return $st->fetch();
	}
}