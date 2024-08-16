<?php
	include_once("includes/session.php");
	if($_SESSION['user_email'] == true) {
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>IMS - Unauthorized</title>
	</head>
	<body id="body">
		<br>
		<div class="container">
			<div class="text-center">
				<br><br><br>
				<h1 style="font-size: 120px;">401</h1>
				<h6 style="margin-top: -30px;">
					<span style="font-size: 24px;"> 
						<img src="images/un-authorized_icon.png" width="50px" style="margin-top: -10px;">
						<span> You're not authorized for selected action </span>
					</span>
				</h6>
			</div>
		</div>
	</body>
</html>
<?php	
	
	} else {
		header('location: login.php');
	}
?>