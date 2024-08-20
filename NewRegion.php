<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {

?>
		<!DOCTYPE html>
		<html>

		<head>
			<title>Freight Calculator - User</title>
			<?php include_once('includes/header.php'); ?>
		</head>

		<body>

			<?php include_once('includes/navbar.php'); ?>
			<?php include_once('includes/alerts.php'); ?>

			<div class="layout" id="layout">
				<div class="inner-layout">

					<div class="d-flex justify-content-between page-heading">
						<div> New Region </div>
					</div>
					<div class="line-break"></div>

					<div class="mt-4 context">
						<form id="region-form" class="region-form">

							<div class="row">
								<div class="col-md-6 mt-1">
									<span class="font-weight-light">
										<strong> Region Name:<i class="text-danger">*</i></strong>
										<input type="text" name="region_name" id="region_name" placeholder="Enter Region name " class="form-control form-control-sm region_name" maxlength="24" oninput="<?php echo $onlyCharacter; ?>">
									</span>
								</div>
								
							</div>

							<input type="hidden" name="action" class="action" value="NewRegion">
							<div class="text-center submit mt-4">
								<button type="submit" class="btn btn-info submit-btn">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<script type="text/javascript" src="js/regions.js?clear_cache=<?php echo time(); ?>"></script>
		</body>

		</html>

<?php
} else {
	header('location: login');
}
?>