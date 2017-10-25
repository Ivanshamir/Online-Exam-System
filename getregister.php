<?php
	include 'classes/user.php';
	$usr = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		$userdata = $usr->userRegistration($name, $username, $password, $email);
	}
?>