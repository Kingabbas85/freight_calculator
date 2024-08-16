<?php

	require_once("includes/helpers.php");
	require_once('packages/Mysqldump/Mysqldump.php');
    // Connect Database
    $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=freight_calculator_db', 'root', 'ims-admin$');
	
	$time=date('Ymd Hi', strtotime('+4 Hours'));

    // Sava database into the folder
    $dump->start("db_backups/$time.sql");

	
	session_start();
	session_unset();
	header('location:login.php');
	exit; // Ensure no further output is sent
?>