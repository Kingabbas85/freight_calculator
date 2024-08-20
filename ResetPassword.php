<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
	$username = $_SESSION['user_name'];
	$user_role = $_SESSION['user_role'];
	$user = getUserByUsername($connection, $username);
	$user_id = $user['Id'];
	// $role = getRoleByUserId($connection,$user_id);
	$is_view_rights = checkPermission($connection, $user_id, 20, 'View');
	$is_add_rights = checkPermission($connection, $user_id, 20, 'Add');
	$is_edit_rights = checkPermission($connection, $user_id, 20, 'Edit');
	$is_delete_rights = checkPermission($connection, $user_id, 20, 'Delete');
	if ($is_view_rights) {

?>
		<!DOCTYPE html>
		<html>

		<head>
			<title>HRM - Reset Password</title>
			<?php include_once('includes/header.php'); ?>
		</head>

		<body>

			<?php include_once('includes/navbar.php'); ?>
			<?php include_once('includes/alerts.php'); ?>

			<div class="success-alert">
				<svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
					<use xlink:href="#check-circle-fill" />
				</svg>
				Password updaded successfully!
			</div>
			<div class="error-alert">
				<svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
					<use xlink:href="#exclamation-triangle-fill" />
				</svg>
				Something went wrong!
			</div>

			<div class="layout" id="layout">
				<div class="inner-layout">

					<div class="d-flex justify-content-between page-heading">
						<div> Reset Password </div>
					</div>
					<div class="line-break"></div>

					<div class="mt-4 context">

						<form id="reset-password-form" class="reset-password-form">
							<div class="row">
								<?php
								// if ($is_add_rights || $is_edit_rights) {
								?>
									<!-- <div class="col-md-6 mt-1">
										<span class="font-weight-light">
											<strong> Usaer :<i class="text-danger">*</i></strong>
											<select name="username" id="username" class="form-select form-select-sm username">
												<option value="" disabled selected hidden> -- Choose -- </option>
												<?php
												$query = "Select * from users ORDER BY display_name ASC";
												$result = mysqli_query($connection, $query);
												if (mysqli_num_rows($result)) {
													while ($row = mysqli_fetch_assoc($result)) {
														$user_name = $row['user_name'];
														$display_name = $row['display_name'];

														$fullname = $display_name . "  (" . $user_name . ")";

														$selected = "";
														if ($user_name == $username) {
															$selected = "selected";
														}
												?>
														<option value="<?php echo $user_name; ?>" <?php echo $selected; ?>> <?php echo $fullname; ?> </option>
												<?php
													}
												}
												?>
											</select>
										</span>
									</div> -->
								<?php //} else { ?>
									<input type="hidden" name="username" class="username" value="<?php echo $username; ?>">
								<?php// } ?>

								<div class="col-md-6 mt-1">
									<span class="font-weight-light">
										<strong> New Password:<i class="text-danger">*</i></strong>
										<input type="password" name="password" id="password" class="form-control form-control-sm password" />
									</span>
								</div>
								<div class="col-md-6 mt-1">
									<span class="font-weight-light">
										<strong> Confirm Password:<i class="text-danger">*</i></strong>
										<input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm confirm_password" />
									</span>
								</div>
							</div>

							<div class="text-center submit mt-4">
								<button type="submit" class="btn btn-info reset-password-form  submit-btn">Reset</button>
							</div>
						</form>

					</div>
				</div>
			</div>

		</body>

		</html>
		<script type="text/javascript" src="js/resetpassword.js?clear_cache=<?php echo time(); ?>"></script>

<?php
	} else {
		header('location: Unauthorized');
	}
} else {
	header('location: login');
}
?>