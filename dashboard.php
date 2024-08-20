<?php
	include_once("includes/session.php");
	include_once('database/database.php');

	if (isset($_SESSION['user_email']) == true) {

?>
<!DOCTYPE html>
<html>
	<head>
		<title>HRM - Attendance</title>
		<?php include_once('includes/header.php'); ?>
		<style type="text/css">
			.add_new a {
				border-radius: 2px !important;
			}
			.dropdown-menu {
				border-radius: 0px !important;
				padding: 2px 0px !important;
			}
			.dropdown-menu li:hover {
				cursor: pointer;
				background: #F0F3F4;
				color: #000;
			}
			.dropdown-menu li:focus {
				background: red !important;
			}

			.close:hover {
				cursor: pointer;
			}

			.fa-edit {
				font-size: 13px;
			}
			.fa-edit:hover {
				cursor: pointer;
			}
		</style>
	</head>
	<body>
		<?php include_once('includes/navbar.php'); ?>
		<?php include_once('includes/alerts.php'); ?>
		<div class="layout" id="layout">
			<div class="inner-layout">

			</div>
		</div>
	</body>
</html>
<?php
} else {
	header('location: login');
}
?>