<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	if($_SESSION['user_email'] == true) {
		
		if ($_SESSION['user_role'] == "admin") {

			$counter = 0;
			$editid = $_GET['id'];
			$query = "Select * FROM clients";
			$result = mysqli_query($connection, $query);
			if (mysqli_num_rows($result)) {
				while ($row = mysqli_fetch_assoc($result)) {
					if ( $editid == md5( $row['Id']) ) {
						$editid = $row['Id'];
						$client_id = $row['client_id'];
						$client_name = $row['client_name'];
						$contact_name = $row['contact_name'];
						$contact_no = $row['contact_no'];
						$contact_email = $row['contact_email'];
						$phone = $row['phone'];
						$address = $row['address'];
						$city = $row['city'];
						$country = $row['country'];
						$active = $row['active'];
						
						$checked = "";
						if($active) {
							$checked = "checked";
						}
						$counter++;
					}
				}
			}

			if ($counter == 0) {
				header('Location:page_not_found.php');
			}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>IMS - Client</title>
	</head>
	<body id="body">
		<div class="overlay"><div class="loader"></div></div>
		<?php include_once('includes/navbar.php'); ?>
		
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="vendor_layout">
					
					<div id="page_heading" class="row">
						Edit Client
						<div class="d-flex align-items-center heading_number">
							(
								<span> #</span>	
								<span> <?php echo mraCreateSixDigitNumber($client_id); ?> </span>
							)
						</div>
					</div>
					<div id="margin_div"></div>

					<form id="editclient_form">
				      	<div class="row">
						  	<div class="col-md-6 mt-1">
					      		<span class="font-weight-light">
					      			<strong> Client Name:<i class="text-danger">*</i></strong>
					      		</span>
						    	<input type="text" id="client_name" name="client_name" class="form-control form-control-sm client_name" value="<?php echo $client_name; ?>" placeholder="digi-key or amazon" oninput="<?php echo $forVendorName; ?>" maxlength="80">
						  	</div>
						  	<div class="col-md-6 mt-1">
					      		<span class="font-weight-light">
					      			<strong> Contact Name:<i class="text-danger">*</i></strong>
					      		</span>
						    	<input type="text" id="contact_name" name="contact_name" class="form-control form-control-sm contact_name" value="<?php echo $contact_name; ?>" placeholder="John Doe" oninput="<?php echo $onlyCharacter; ?>" maxlength="80">
						  	</div>
						  	<div class="col-md-6 mt-1">
					      		<span class="font-weight-light">
					      			<strong> Contact No:<i class="text-danger">*</i></strong>
					      		</span>
						    	<input type="text" id="contact_no" name="contact_no" class="form-control form-control-sm contact_no" value="<?php echo $contact_no; ?>" placeholder="03001234567" oninput="<?php echo $forContactNo; ?>" maxlength="12">
						  	</div>
						  	<div class="col-md-6 mt-1">
					      		<span class="font-weight-light">
					      			<strong> Email</strong><span style="font-size: 14px; color: #7B7D7D;"> (optional):</span>
					      		</span>
						    	<input type="text" id="email" name="email" class="form-control form-control-sm email" value="<?php echo $contact_email; ?>" placeholder="username@gmail.com" oninput="<?php echo $forEmail; ?>" maxlength="50">
						  	</div>
						  	<div class="col-md-6 mt-1">
					      		<span class="font-weight-light">
					      			<strong> Phone</strong>
					      		</span>
						    	<input type="text" id="phone_no" name="phone_no" class="form-control form-control-sm phone_no" value="<?php echo $phone; ?>" placeholder="03001234567" oninput="<?php echo $forContactNo; ?>" maxlength="12">
						  	</div>
						  	<div class="col-md-6 mt-1">
					      		<span class="font-weight-light">
					      			<strong> Address:</strong>
					      		</span>
						    	<input type="text" id="address" name="address" class="form-control form-control-sm address" value="<?php echo ucwords($address); ?>" placeholder="Street# 01, Block# A" oninput="<?php echo $forAddress; ?>" maxlength="80">
						  	</div>
						  	<div class="col-md-6 mt-1">
					      		<span class="font-weight-light">
					      			<strong> City:</strong>
					      		</span>
						    	<input type="text" id="city" name="city" class="form-control form-control-sm city" value="<?php echo ucwords($city); ?>" placeholder="Lahore" oninput="<?php echo $forAddress; ?>" maxlength="50">
						  	</div>
						  	<div class="col-md-6 mt-1">
					      		<span class="font-weight-light">
					      			<strong> Country:</strong>
					      		</span>
						    	<input type="text" id="country" name="country" class="form-control form-control-sm country" value="<?php echo ucwords($country); ?>" placeholder="Pakistan" oninput="<?php echo $forAddress; ?>" maxlength="50">
						  	</div>
							  <div class="col-md-6 mt-1">
								<input type="hidden" id="active" name="active" class="active" value="<?php echo $active; ?>">
								<input type="checkbox" id="activeCheckbox" name="activeCheckbox" class="activeCheckbox" <?php echo $checked; ?> > &nbsp;&nbsp;
								<label for="activeCheckbox">Active</label>
							</div>
						</div>

						<input type="hidden" id="action" name="action" class="action" value="updateClient">
						<input type="hidden" name="edit_id" value="<?php echo $editid; ?>">
						<div class="form-group text-center">
					    	<input type="submit" id="form_submit_button" value="Update" class="edit_client">
					  	</div>
					</form>
				</div>
			</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/clients.js?clear_cache=<?php echo time();?>"></script>
<?php
		} 
		else {
			include_once('unauthorized_page.php');
		}
	}
	else {
		header('location: login.php');
	}
?>
