<?php
session_start();
if (isset($_SESSION['user_email']) == true) {
	header('location: dashboard.php');
} else {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<?php include_once('includes/header.php'); ?>
		<title>IMS - Login</title>
	</head>

	<body id="body">
		<div class="overlay">
			<div class="loader"></div>
		</div>
		<div class="container">
			<div id="access_layout">
				<div id="access_heading" class="text-center card-header">
					<span>Sign in</span>
				</div>
				<div>
					<div class="text-center">
						<img src="images/fc_logo.png" width="150px">
					</div>
					<div id="access_form_layout">
						<form name="login_form" id="login_form" class="login_form" onsubmit="return false">
							<div class="form-group">
								<span id="email_error"></span>
								<input type="email" class="form-control form-control-sm email" id="email" placeholder="Email Address" name="email" value=<?php if (isset($_POST['email'])) echo $email; ?>>
							</div>
							<div class="form-group">
								<span class="font-weight-light"></span>
								<input type="password" class="form-control form-control-sm password" id="password" placeholder="Password" name="password">
							</div>
							<div class="form-group text-center mt-4">
								<input type="submit" id="signin_button" class="login_button" name="sign_in" value="Sign in">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>

	</html>
	<script type="text/javascript" src="js/login.js?clear_cache=<?php echo time(); ?>"></script>
<?php
}
?>