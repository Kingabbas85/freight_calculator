<?php
	session_start();
	if ( $_SESSION['user_role'] == 'management' ) {

		$user_name = $_SESSION['user_name'];
		if ($user_name == 'sajid.anjum') {
			$user_name = "sanjum";
		}
		if ($user_name == 'yaqoob.khan') {
			$user_name = "ykhan";
		}
		if ( $user_name == 'sanjum' || $user_name == 'ykhan') {
			
			$_SESSION['super_admin'] = '';
		} else {
			$_SESSION['super_admin'] = '';
		}
	} else if ( $_SESSION['user_role'] == 'developer' ) {
		
		$_SESSION['super_admin'] = 'YES';
	} else {
		
		$_SESSION['super_admin'] = '';
	}

	$includes = "INDLUDES";
	require_once("helpers.php");
	require_once("config.php");

	$actual_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$actual_url = strtolower($actual_url);
	if (str_contains($actual_url, 'international')) {
	    $_module = 1;
	} else {
		$_module = 0;
	}

	$_SESSION['_module'] = $_module;
?>