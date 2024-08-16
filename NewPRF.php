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
				display: none;
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
			#eta {
				background-color : white;
			}

			#dragArea:hover, #dragArea.active {
				cursor: pointer;
				border: 1px solid #B3B6B7 !important;
			}
			.custom-file-upload {
				cursor: pointer !important;
			}
			.choose-btn {
				width: 100px;
				height: 100%;
				padding-top: 7px;
				background:#ECF0F1;
				border-right: 1px dotted #B3B6B7;
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
						New PRF
					</div>
					<div id="margin_div"></div>

					<form id="prf_form" class="generate_prf_form" onsubmit="return false">
					<!-- <?php
						$prf_no = 0;
						$query00 = "Select * from count_number where Id = '5'";
						$result00 = mysqli_query($connection, $query00);
						if (mysqli_num_rows($result00)) {
							while ($row00 = mysqli_fetch_assoc($result00)) {
								$prf_no = $row00['count'];
							}
						}
						$prf_no = $prf_no + 1;
					?> -->

						<div class="mt-1 mb-2">
							<div class="row p-0">
								<div class="col-md-6" id="vendorsListContainer">
									<span class="font-weight-light">
										<strong> Vendor:<i class="text-danger">*</i> </strong>
									</span>
									<input type="hidden" name="vendor_id" class="vendor_id" id="vendor_id">
									<select id="vendorList" name="vendorList" class="form-control form-control-sm searable_select_option selectpicker vendorList" data-live-search="true">
										<option value="" disabled selected hidden> Choose </option>
										<?php
											$query4 = "Select * from vendors WHERE vendor_id <> 172 ORDER By vendor_name ASC";
											$result4 = mysqli_query($connection, $query4);
											if (mysqli_num_rows($result4) > 0) {
												while ($row4 = mysqli_fetch_assoc($result4)) {
										?>
													<option value="<?php echo $row4['vendor_id']; ?>">
														<?php echo ucwords($row4['vendor_name']); ?>
													</option>
										<?php
												}
											}
										?>
									</select>
								</div>

								<div class="col-md-6" id="projectsListContainer">
									<span class="font-weight-light">
										<strong> Project:<i class="text-danger">*</i> </strong>
									</span>
									<input type="hidden" name="project" class="project" id="project">
									<select id="projectList" name="projectList" class="form-control form-control-sm searable_select_option projectList" data-live-search="true">
									</select>
										<option value="" disabled selected hidden> Choose </option>
								</div>					  	
							</div>
						</div>


						<!-- Checkbox  -->
							<!-- <div style="font-size: 14px;">
								<div class="row" style="padding: 0px 15px;">
									<input type="hidden" id="payment" class="payment" value="cheque">
									<input type="checkbox" id="paymentCheckBox" class="paymentCheckBox" value="cheque"> 
									<div class="checkbox-text payment-label"> Cash </div>
								</div>
							</div> -->
							<div class="row" style="font-size: 14px;">
								  <div class="col-md-6">
							  		<span class="font-weight-light">
							  			<strong> Payment Method:<i class="text-danger">*</i> </strong>
							  		</span>
									<select id="payment" name="payment" class="form-control form-control-sm payment">
										<option value="" disabled selected hidden> Choose </option>
										<option value="Cash" id="cash">Cash</option>
										<option value="Cheque" id="cheque" selected>Cheque</option>
										<option value="Wire Transfer/TT" id="wire_transfer">Wire Transfer/TT</option>
									</select>
							  	</div>
						  	</div>

							<!-- PO's List -->
							<div id="items-list" class="mt-1 mb-2"></div>
						<!-- PO's List -->


						  	<!-- <div class="row pl-3" style="font-size: 14px;">
					      		<span class="font-weight-light mr-3">
						  			<strong> Tax: </strong>
						  		</span>
						  		<input type="hidden" id="tax" name="tax" class="tax" value="0">
					      		<div style="margin-top: 1px;">
					      			<input type="radio" name="taxCheckBox" class="taxCheckBox" id="none" value="0" checked>
									&nbsp;<label for="none">None</label>
	 								<input type="radio" name="taxCheckBox" class="ml-3 taxCheckBox" id="five" value="5">
									&nbsp;<label for="five">5</label>
									<input type="radio" name="taxCheckBox" class="ml-3 taxCheckBox" id="ten" value="10">
									&nbsp;<label for="ten">10</label>
									<input type="radio" name="taxCheckBox" class="ml-3 taxCheckBox" id="sixteen" value="16">
									&nbsp;<label for="sixteen">16</label>
									<input type="radio" name="taxCheckBox" class="ml-3 taxCheckBox" id="seventeen" value="17">
									&nbsp;<label for="seventeen">17</label>
									<input type="radio" name="taxCheckBox" class="ml-3 taxCheckBox" id="eightteen" value="18">
									&nbsp;<label for="eightteen">18</label>
					      		</div>
						  	</div> -->
							
							  <div class="mt-1 mb-2">
							<div class="row p-0">
							  <div class="col-md-6">
									<span class="font-weight-light">
										<strong> Tax: </strong>
									</span>
									<input type="" id="tax" name="tax" class="form-control form-control-sm tax" placeholder="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="10" value="0">
								</div>
								<div class="col-md-6">
									<span class="font-weight-light">
										<strong> Discount: </strong>
									</span>
									<input type="" id="discount" name="discount" class="form-control form-control-sm discount" placeholder="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="10" value="0">
								</div>
							</div>
							  </div>
							  		
							  <div class="mt-1 mb-2">
							<div class="row p-0">
								<div class="col-md-6">
				                    <span class="font-weight-light">
				                        <strong> Freight </strong>
				                    </span>
				                    <input type="" id="freight" name="freight" class="form-control form-control-sm freight" placeholder="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="10" value="0">
				                </div>
				                <div class="col-md-6">
				                    <span class="font-weight-light">
				                        <strong> Wire Transfer Charges </strong>
				                    </span>
				                    <input type="" id="wire_transfer" name="wire_transfer" class="form-control form-control-sm wire_transfer" placeholder="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="10" value="0">
				                </div>
								</div>
							  </div>
							  <div class="mt-1 mb-2">
							<div class="row p-0">
								<div class="col-md-6">
				                    <span class="font-weight-light">
				                        <strong> Additional Tax: </strong>
				                    </span>
				                    <input type="" id="additional_tax" name="additional_tax" class="form-control form-control-sm additional_tax" placeholder="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="10" value="0">
				                </div>
				                <div class="col-md-6">
				                    <span class="font-weight-light">
				                        <strong> Additional Tax Detail: </strong>
				                    </span>
				                    <input type="" id="additional_tax_detail" name="additional_tax_detail" class="form-control form-control-sm additional_tax_detail" oninput="<?php echo $expectSingleAndDoubleQuote; ?>" maxlength="250">
				                </div>
								</div>
							  </div>
							  <div class="mt-1 mb-2">
							<div class="row p-0">
				                <div class="col-md-6">
				                    <span class="font-weight-light">
				                        <strong> Additional Charges: </strong>
				                    </span>
				                    <input type="" id="additional_charges" name="additional_charges" class="form-control form-control-sm additional_charges" placeholder="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="10" value="0">
				                </div>
				                <div class="col-md-6">
				                    <span class="font-weight-light">
				                        <strong> Additional Charges Detail: </strong>
				                    </span>
				                    <input type="" id="additional_charges_detail" name="additional_charges_detail" class="form-control form-control-sm additional_charges_detail" oninput="<?php echo $expectSingleAndDoubleQuote; ?>" maxlength="250">
				                </div>
								</div>
							  </div>
						<!-- Checkbox -->

						<!-- Invoice Detail Start -->
						<div class="mt-1 mb-2">
							<div class="row p-0">
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
									<input type="" name="date" class="form-control form-control-sm date" id="date" readonly style="background: white;">
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
						</div>
						<!-- Invoice Detail Start -->
							<!-- Note -->
							<div class="row mt-1" style="font-size: 14px; position: relative; padding: 0px 15px;">
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

				      		<div id="remaing_note_limit" style="color: #979A9A; font-size: 13px; margin-top: 6px; position: absolute; right: 15px;">
					  			0/299
					  		</div>
				      		<textarea rows="3" name="note" form="prf_form" class="form-control form-control-sm note mb-1" placeholder="Aa" maxlength="299"></textarea>
					  		<input type="hidden" id="note_value" name="note_value" class="note_value">
					  	</div>
						<!-- Note -->

						<!-- Attachment Section -->
							<!-- <div class="row">
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
							</div> -->
							<div class="row mt-1">
								<div class="col-md-12">
									<input type="hidden" id="filename" name="filename" class="filename">
									<input type="hidden" id="extension" name="extension" class="extension">
									<span class="font-weight-light">
										<strong> Attachment:<i class="text-danger">*</i> </strong>
									</span>
									<div id="dragArea" style="border:1px dotted #B3B6B7;">
										<div class="d-flex">
											<div class="custom-file-upload">
											    <input type="file" id="actual-btn" name="attachment" class="attachment" hidden />
											    <div class="text-center choose-btn"> <i class="fa fa-upload"></i>&nbsp;Choose </div>
											</div>
											<div style="padding:10px; padding-top:7px;">
												<span id="file-chosen"> Drag & Drop or browse </span>
											</div>
										</div>
									</div>
								</div>
							</div>
						<!-- Attachment Section -->

						<!-- Hidden Values -->
							<input type="hidden" name="prf_no" id="prf_no" class="prf_no" value="<?php echo $prf_no; ?>">
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
<script type="text/javascript" src="js/new_prf.js?clear_cache=<?php echo time();?>"></script>

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