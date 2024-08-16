<?php
	// if (strpos($_SERVER['HTTP_ORIGIN'], "javascript") == false) {
	// 	header("Access-Control-Allow-Origin: *");
	// }
	include_once("includes/session.php");
	include_once('database/database.php');	

	if (isset($_POST['user_emails']) && isset($_POST['user_role']) ){

		$user_emails = "";
		$user_emails = explode(",",strtolower($_POST['user_emails']));
		$user_role = $_POST['user_role'];
		
		for ($i=0; $i < count($user_emails); $i++) { 
			
			$query = "Delete FROM permissions WHERE user_email = '$user_emails[$i]'";
			$result = mysqli_query($connection, $query);
		}
		for ($i=0; $i < count($user_emails); $i++) { 
			$query2 = "Insert INTO permissions (user_email, user_role) VALUES ('$user_emails[$i]', '$user_role')";
			$result2 = mysqli_query($connection, $query2);
		}
		if ($result && $result2) {
			echo 1;
		}
		
	} else {
		echo 0;
	}
?>