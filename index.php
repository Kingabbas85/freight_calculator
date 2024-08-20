
<?php
	session_start();
	if($_SESSION['user_email'] == true) {
		header('location: home');
	}
	else {
		header('location: home');
	}
?>