<?php
	include 'classes/user.php';
	$usr = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		$usrlogin = $usr->userLogin($email, $password);
	}
?>