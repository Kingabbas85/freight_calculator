
<?php
	session_start();
	if($_SESSION['user_email'] == true) {
		header('location: dashboard');
	}
	else {
		header('location: home');
	}
?>