<?php
	include_once("includes/session.php");
	include_once('database/database.php');

	if($_SESSION['user_email'] == true) {

	if ($_SESSION['user_role'] == "management" || $_SESSION['user_role'] == "developer" || $_SESSION['user_role'] == "procurement team" || $_SESSION['user_role'] == "accounts" || $_SESSION['user_role'] == "supply chain") {

		$_module = $_SESSION['_module'];
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>IMS - PRF</title>
		<style type="text/css">
			#items-list {
				max-height: 400px; 
				overflow: auto;
				border: 1px solid #D0D3D4;
				margin: 12px 0px 4px 0px;
				display: none;
				padding: 0px 10px 10px 10px;
			}
			#add_image_button label {
				background-color: #ECF0F1;
				color: #283747;
				padding: 0.5rem 1rem;
				font-family: sans-serif;
				border-radius: 0.3rem;
				cursor: pointer;
				margin-top: 1rem;
				font-weight: 500;
				border:1px solid #D0D3D4;
			}
			#file-chosen{
				margin-left: 0.3rem;
			}


			input[readonly] {
				background: #FFF !important;
			}
			input[readonly]:focus {
			  	background:#fff !important;
			}

			.pos_list_container {
				color:#154360; 
				font-size:20px;
				font-weight:600;
				margin-top:5px;
			}
			.pos_list_container a {
				color:#154360;
			}
			.pos_list_container a:hover {
				text-decoration: none;
			}
		</style>
	</head>
	<body id="body">
		<div class="overlay"><div class="loader"></div></div>
		<?php include_once('includes/navbar.php'); ?>
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="prf_layout">

					<div id="page_heading" class="row">
						New PRF - MTT
					</div>
					<div id="margin_div"></div>

					<form id="prf_form" class="generate_prf_form" onsubmit="return false">

						<div class="mt-1">
							<div class="row p-0">
								
								<input type="hidden" name="vendor_id" class="vendor_id" id="vendor_id" value="172">
								<div class="col-md-6" id="projectsListContainer">
									<span class="font-weight-light">
										<strong> Project:<i class="text-danger">*</i> </strong>
									</span>
									<select id="projectList" name="projectList" class="form-control form-control-sm searable_select_option projectList" data-live-search="true">
									</select>
										<option value="" disabled selected hidden> Choose </option>
								</div>
			  	
							</div>
						</div>

						<!-- PO's List -->
						<div id="items-list"></div>
						<!-- PO's List -->

							
						<div class="row p-0">

							<div class="col-md-6">
								<span class="font-weight-light">
									<strong> Payment Method:<i class="text-danger">*</i> </strong>
								</span>
								<select id="payment_method" name="payment_method" class="form-control form-control-sm payment_method">
									<option value="" disabled selected hidden> Choose </option>
									<option value="cash"> Cash </option>
									<option value="cheque"> Cheque </option>
									<option value="Wire Transfer/TT"> Wire Transfer/TT </option>
								</select>
							</div>
							<div class="col-md-6">
								<span class="font-weight-light">
									<strong> Tax: </strong>
								</span>
								<input type="" name="tax" class="form-control form-control-sm tax" id="tax" oninput="<?php echo $onlyNumeric; ?>" maxlength="8" value="0">
							</div>
							<div class="col-md-6">
								<span class="font-weight-light">
									<strong> Invoice No:<i class="text-danger">*</i> </strong>
								</span>
								<input type="" name="invoice_no" class="form-control form-control-sm invoice_no" id="invoice_no" oninput="<?php echo $allowMultipleInvoiceNo; ?>" maxlength="99">
							</div>
							<div class="col-md-6">
								<span class="font-weight-light">
									<strong> Invoice Date:<i class="text-danger">*</i> </strong>
								</span>
								<input type="hidden" name="" class="invoice_date">
								<input type="" name="date" class="form-control form-control-sm date" id="date" readonly>
							</div>	
							<div class="col-md-6">
								<span class="font-weight-light">
									<strong> Company:<i class="text-danger">*</i> </strong>
								</span>
								<select name="company_id" id="company_id" class="form-control form-control-sm company_id">
									<option value="" disabled selected hidden> Choose </option>
									<?php
										$query5 = "Select * FROM companies WHERE status = 1 ORDER By company_name ASC ";
										$result5 = mysqli_query($connection, $query5);
										if ( mysqli_num_rows($result5) ) {
											while ($row5 = mysqli_fetch_assoc($result5)) {
												$company_id = $row5['company_id'];
												$company_name = $row5['company_name'];

												echo '<option value="'.$company_id.'">'.$company_name.'</option>';
											}
										}
									?>
								</select>
							</div>

						</div>
						<!-- Invoice Detail Start -->


						<!-- Note -->
						<div class="row mt-2" style="font-size: 14px; position: relative; padding: 0px 15px;">
				      		<span class="font-weight-light mr-3">
					  			<strong> Note: </strong>
					  		</span>
					  		<input type="hidden" id="note_text" name="note_text" class="note_text">
				      		<div style="margin-top: 1px;">
				      			<input type="radio" name="noteCheckBox" class="noteCheckBox" id="new_note" value="new">
								&nbsp;<label for="new_note">New</label>
 								<input type="radio" name="noteCheckBox" class="ml-2 noteCheckBox" id="same_as_demand" value="same_as_demand">
								&nbsp;<label for="same_as_demand">Same as demand</label>
				      		</div>

				      		<div id="remaing_note_limit" style="color:#979A9A; font-size:13px; margin-top:8px; position:absolute; right:15px;">
					  			0/299
					  		</div>
				      		<textarea rows="3" name="note" form="prf_form" class="form-control form-control-sm note mb-1" placeholder="Aa" maxlength="299"></textarea>
					  		<input type="hidden" id="note_value" name="note_value" class="note_value">
					  	</div>
						<!-- Note -->

						<!-- Attachment Section -->
						<div class="row">
							<div class="col-md-6">
								<span class="font-weight-light">
						  			<strong> Attachment:<i class="text-danger">*</i> </strong>
						  		</span>
								<div id="add_image_button">
									<span class="error_msg"></span>
									<input type="file" id="actual-btn" class="attachment" name="attachment" hidden />
									<div style="margin-top: -14px;">
										<label for="actual-btn"><i class="fa fa-upload"></i>&nbsp; Choose</label>
										<span id="file-chosen">No file chosen</span>
									</div>
								</div>
							</div>
							</div>
						<!-- Attachment Section -->

						<!-- Hidden Values -->
							<input type="hidden" name="_module" id="_module" class="_module" value="<?php echo $_module; ?>">
						<!-- Hidden Values -->
						

						<!-- Submit Button -->
							<div class="form-group text-center mt-3">
								<input type="submit" id="form_submit_button" name="generate_prf" value="Generate" class="generate_prf">
							</div>
						<!-- Submit Button -->
					</form>
				</div>
			</div>
		</div>
		<?php include_once('attach_invoices.php'); ?>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/new_prf-mtt.js?clear_cache=<?php echo time();?>"></script>

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