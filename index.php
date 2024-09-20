
<?php
	session_start();
	if($_SESSION['user_email'] == true) {
		header('location: home.php');
	}
	else {
		header('location: home.php');
	}
?>