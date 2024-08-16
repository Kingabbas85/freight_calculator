<?php
	include_once("includes/session.php");
	if($_SESSION['user_email'] == true) {

?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php") ?>
		<title>IMS - Expired</title>
	</head>
	<body id="body">
		<br><br>
		<div class="container">
			<div class="text-center">
				<img src="images/link_expire.jpg" width="100px">
				<div style="margin-top: 5px;"></div>
				<h5>The link you followed has expired</h5>
				<p style="margin-top: -6px;">This demand has moved to the next step.</p>
			</div>
		</div>
	</body>
</html>
<?php
	} else {
		header('location: login.php');
	}
?>