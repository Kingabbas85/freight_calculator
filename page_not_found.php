<?php
	include_once("includes/session.php");
	if($_SESSION['user_email'] == true) {

?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php") ?>
		<title>IMS - Page Not Found</title>
	</head>
	<body id="body">
		<br>
		<br>
		<br>
		<div class="container">
			<div class="text-center">
				<!-- <img src="images/un-authorized_icon.png" width="120px"> -->
				<h1 style="font-size: 100px;">404</h1>
				<h2 style="margin-top: -30px;">Page not found</h2>
				<h5>The page you're looking for doesn't exist or an other error occured.</h5>
			</div>
		</div>
	</body>
</html>
<?php
	} else {
		header('location: login.php');
	}
?>