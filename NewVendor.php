<?php
	include_once("includes/session.php");
	if($_SESSION['user_email'] == true) {

		if ($_SESSION['user_role'] == "admin") {
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>IMS - Vendor</title>
	</head>
	<body id="body">
		<div class="overlay"><div class="loader"></div></div>
		<?php include_once('includes/navbar.php'); ?>
		
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="vendor_layout">

					<div id="page_heading" class="row">
						New Vendor
					</div>
					<div id="margin_div"></div>

					<form id="vendor_form">
						<div class="row">
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Vendor Name:<i class="text-danger">*</i></strong>
								</span>
								<input type="text" id="vendor_name" name="vendor_name" class="form-control form-control-sm vendor_name" placeholder="digi-key or amazon" oninput="<?php echo $forVendorName; ?>" maxlength="80">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> NTN Number:</strong>
								</span>
								<input type="text" id="ntn_number" name="ntn_number" class="form-control form-control-sm ntn_number" placeholder="PK-NTN-1234567-0" oninput="<?php echo $forVendorName; ?>" maxlength="20">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Contact Name:<i class="text-danger">*</i></strong>
								</span>
								<input type="text" id="contact_name" name="contact_name" class="form-control form-control-sm contact_name" placeholder="John Doe" oninput="<?php echo $onlyCharacter; ?>" maxlength="80">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Contact No:<i class="text-danger">*</i></strong>
								</span>
								<input type="text" id="contact_no" name="contact_no" class="form-control form-control-sm contact_no" placeholder="03001234567" oninput="<?php echo $forContactNo; ?>" maxlength="12">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Email</strong><span style="font-size: 14px; color: #7B7D7D;"> (optional):</span>
								</span>
								<input type="text" id="email" name="email" class="form-control form-control-sm email" placeholder="username@gmail.com" oninput="<?php echo $forEmail; ?>" maxlength="50">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Phone</strong>
								</span>
								<input type="text" id="phone_no" name="phone_no" class="form-control form-control-sm phone_no" placeholder="03001234567" oninput="<?php echo $forContactNo; ?>" maxlength="12">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Address:</strong>
								</span>
								<input type="text" id="address" name="address" class="form-control form-control-sm address" placeholder="Street# 01, Block# A" oninput="<?php echo $forAddress; ?>" maxlength="80">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> City:</strong>
								</span>
								<input type="text" id="city" name="city" class="form-control form-control-sm city" placeholder="Lahore" oninput="<?php echo $forAddress; ?>" maxlength="50">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Zip/Postal Code:</strong>
								</span>
								<input type="text" id="zip_code" name="zip_code" class="form-control form-control-sm zip_code" placeholder="54000" oninput="<?php echo $forAddress; ?>" maxlength="12">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Country:</strong>
								</span>
								<input type="text" id="country" name="country" class="form-control form-control-sm country" placeholder="Pakistan" oninput="<?php echo $forAddress; ?>" maxlength="50">
							</div>
							<div class="col-md-6 mt-1">
								<input type="hidden" id="active" name="active" class="active" value="0">
								<input type="checkbox" id="activeCheckbox" name="activeCheckbox" class="activeCheckbox" value="0"> &nbsp;&nbsp;
								<label for="activeCheckbox">Active</label>
							</div>
						</div>

						<input type="hidden" name="action" class="action" value="newVendor">
						<div class="form-group text-center">
							<input type="submit" id="form_submit_button" value="Add Vendor" class="add_vendor">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/vendors.js?clear_cache=<?php echo time();?>"></script>
<?php
		} else {
			include_once('unauthorized_page.php');
		}
	} else {
		header('location: login.php');
	}
?>
