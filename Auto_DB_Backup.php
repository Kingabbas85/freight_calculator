<?php
	require_once("includes/helpers.php");
	require_once('packages/Mysqldump/Mysqldump.php');
    // Connect Database
    $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=mra', 'root', 'ims-admin$');
	
	$time=date('Ymd Hi', strtotime('+4 Hours'));

    // Sava database into the folder
    $dump->start("db_backups/$time.sql");

	// Redirect after successful backup
	header('Location: success_page.php');
	exit; // Ensure no further output is sent
?>