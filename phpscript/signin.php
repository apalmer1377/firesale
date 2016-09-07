<?php
	$email = $_GET['username'];
	$password = $_GET['password'];

	$sqlconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');

	if ($sqlconn->connect_error) {
		echo 'Failed to connect.';
	}
	
	$prep = $sqlconn->prepare("SELECT email, password FROM users WHERE email=?");
	$prep->bind_param("s",$email);
	$prep->execute();

	$result = $prep->get_result();
	$row = $result->fetch_assoc();
	if (sha1($password) != $row['password']) {
		echo 'Nope!';
	} else {
		header('Location: ../markup/home.html',true,301);
		exit;
	}
	
	$prep->close;
	
?>