<?php
	session_start();
	require_once("config.php");
	include_once("helpers.php");

	if (isset($_SESSION['user_fullname'])) {
		header ('Location: signout');
	}
?>