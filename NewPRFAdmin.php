<?php
include_once("includes/session.php");
include_once('database/database.php');

if($_SESSION['user_email'] == true) {

	if ($_SESSION['user_role'] == "management" || $_SESSION['user_role'] == "developer" || $_SESSION['user_role'] == "administration" || $_SESSION['user_role'] == "procurement team") {
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<?php include_once("includes/header.php"); ?>
			<title>IMS - PRF</title>
			<style type="text/css">
				#custom_btn_layout label {
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
			</style>
		</head>
		<body id="body">
			<div class="overlay"><div class="loader"></div></div>
			<?php
				include_once('includes/navbar.php');
				$dateTime = new DateTime('now', new DateTimeZone('Asia/Karachi'));
			?>
			<div id="outer_layout" class="mx-auto">
				<div id="inner_layout">
					<div id="prf_layout">

						<div id="page_heading" class="row">
							New PRF
						</div>
						<div id="margin_div"></div>

						<form id="prf_form" class="generate_prf_form" onsubmit="return false">
							<div class="row">
						    	<input type="hidden" class="requested_by" id="requested_by" name="requested_by" value="<?php echo $_SESSION['user_name']; ?>" >
						    	<input type="hidden" class="requester_name" id="requester_name" name="requester_name" value="<?php echo $_SESSION['user_fullname']; ?>" >
						    	<input type="hidden" class="user_email" id="user_email" name="user_email" value="<?php echo $_SESSION['user_email']; ?>" >
							  	<div class="col-md-3">
						      		<span class="font-weight-light">
							  			<strong> Vendor:<i class="text-danger">*</i> </strong>
							  		</span>
						      		<select class="form-control form-control-sm vendor" id="vendor" name="vendor">
						      			<option value="" disabled selected hidden> -- Choose -- </option>
						      			<?php
						      				$query = "Select * from vendors ORDER By vendor_name ASC";
						      				$result = mysqli_query($connection, $query);
						      				if (mysqli_num_rows($result) > 0) {
						      					while ($row = mysqli_fetch_assoc($result)) {
						      						$vendor_id = $row['vendor_id'];
						      						$vendor_name = $row['vendor_name'];
						      			?>
						      							<option value="<?php echo $vendor_id; ?>"><?php echo ucwords($vendor_name); ?></option>
						      			<?php
						      					}
						      				}
						      			?>
						      		</select>
							  	</div>
							  	<div class="col-md-3">
						      		<span class="font-weight-light">
							  			<strong> Campus:<i class="text-danger">*</i> </strong>
							  		</span>
						      		<select class="form-control form-control-sm campusName" id="campusName" name="campusName">
						      			<option value="" disabled selected hidden> -- Choose -- </option>
						      			<option value="4-J"> 4-J</option>
						      			<option value="103-C"> 103-C</option>
						      			<option value="SJP"> SJP</option>
						      			<option value="VTLabs"> VTLabs</option>
						      			<option value="Raythorne"> Raythorne</option>
						      		</select>
							  	</div>
							  	<div class="col-md-3" id="">
						      		<span class="font-weight-light">
							  			<strong> Type:<i class="text-danger">*</i> </strong>
							  		</span>
						      		<select class="form-control form-control-sm prfType" id="prfType" name="prfType">
						      			<option value="" disabled selected hidden> -- Choose -- </option>
						      			<option value="civil work"> Civil Work </option>
						      			<option value="general expense"> Genreal Expense </option>
						      			<option value="international payments"> International Payments </option>
						      			<option value="LPG"> LPG </option>
						      			<option value="maintenance / services"> Maintenance / Services </option>
						      			<option value="mess / grocery"> Mess / Grocery </option>
						      			<option value="online purchases for projects"> Online Purchases for Projects </option>
						      			<option value="phone"> Phone </option>
						      			<option value="transport"> Transport </option>						      			
						      			<option value="travel"> Travel </option>						      			
						      			<option value="utility bill"> Utility Bill </option>
						      			<option value="visit food"> Visit Food </option>
						      		</select>
							  	</div>
							  	<div class="col-md-3" id="">
						      		<span class="font-weight-light">
							  			<strong> Credit Term:<i class="text-danger">*</i> </strong>
							  		</span>
							  		<!-- <input type="hidden" id="credit_term" name="credit_term" class="credit_term"> -->
						      		<select class="form-control form-control-sm creditTerm" id="creditTerm" name="creditTerm">
						      			<option value="" disabled selected hidden> -- Choose -- </option>
						      			<option value="Net 10"> Net 10 </option>
						      			<option value="Net 15"> Net 15 </option>
						      			<option value="Net 30"> Net 30 </option>
						      			<option value="Prepay"> Prepay </option>
						      			<option value="per agreed terms"> Per agreed Terms </option>
						      		</select>
							  	</div>
							</div>
							<div>
								<div class="row" style="margin-top:12px;">
									<div class="col-md-12" style="font-size: 14px;">
										<input type="hidden" name="billable" class="billable" value="0">
								  		<input type="checkbox" id="billableCheckbox" class="billableCheckbox" value="0">&nbsp;
								  		<label for="billableCheckbox"> Billable </label>
								  		&nbsp;&nbsp;

								  		<input type="hidden" name="payment" class="payment" value="0">
								  		<input type="checkbox" id="paymentCheckbox" class="paymentCheckbox" value="0">&nbsp;
								  		<label for="paymentCheckbox"> Cash </label>
								  		&nbsp;&nbsp;
								  		
								  		<input type="hidden" name="billingfrom" class="billingfrom" value="1">
								  		<input type="checkbox" id="billingfromCheckbox" class="billingfromCheckbox" value="2">&nbsp;
								  		<label for="billingfromCheckbox"> Raythorne </label>
								  		&nbsp;&nbsp;

								  		<input type="hidden" name="is_px" class="is_px" value="">
								  		<input type="checkbox" id="PXCheckbox" class="PXCheckbox" value="PX">&nbsp;
								  		<label for="PXCheckbox"> PX </label>
								  	</div>
								</div>
							</div>

							<div style="box-shadow: 0px 0px 8px 0px #bebebe; margin-top: 2px; padding: 5px 15px; padding-bottom: 15px; background: #FBFCFC; border-radius: 5px;">
							<div style="height: 45px; ">
								<div class="pull-left" style="margin-top: 4px;">
							  		<h4 style="color:#1A5276; order:1px solid red;">
										Make a PRF List
									</h4>
							  	</div>
							  	<div class="pull-right" style="margin-top: 4px; margin-right: -8px;">
							  		<button id="addRow" class="addRow" style="width: 36px; height: 34px; border: none; padding-top: 2px; background: #154360; color: white; font-weight: 500; font-size: 14px;">
							  			<i class="fa fa-plus"></i>
							  		</button>
							  	</div>
							</div>
					  		
							<div style="overflow: auto;">
							  	<table class="table-sm table-hover table-striped table_form_style" style="min-width: 1100px;">
							  		<thead class="card-header">
							  			<tr>
							  				<th width="40px">#</th>
							  				<th width="">Description<i class="text-danger">*</i></th>
							  				<th width="">Specification</th>
							  				<th width="">UOM<i class="text-danger">*</i></th>
							  				<th width="">Item Type<i class="text-danger">*</i></th>
							  				<th width="90px">Quantity<i class="text-danger">*</i></th>
							  				<th width="90px">Unit Price<i class="text-danger">*</i></th>
							  				<th width="100px">Total</th>
							  				<th width="130px">Comment</th>
							  				<th></th>
							  			</tr>
							  		</thead>
							  		<tbody id="prf_items">
							  			<tr></tr>
  			<!-- <tr id="new_row">
  				<td>
  				<select id="product_list" name="product_list[]" class="form-control" onchange="get_value();">
  					<option value=""> Product 1 </option>
  				</select>
  				</td>
  				<td><input id="product_sku" type="text" name="product_sku" class="form-control"></td>
  				<td><input id="stock" type="number" name="stock[]" class="form-control" readonly="readonly"></td>
  				<td><input id="qty" type="number" name="quantity[]" class="form-control"></td>
  				<td><input type="price" name="unit_price[]" class="form-control" readonly="readonly"></td>
  				<td><input type="price" id="total_price" name="total_price[]" class="form-control" readonly="readonly" value="0.00"></td>
  			</tr> -->					
							  		</tbody>
							  	</table>
							</div>
						  	<!-- <div class="text-right" id="create_demand_action" style="padding: 0px;">
						  		<button id="addRow" class="btn btn-success addRow">
						  			<i class="fa fa-plus"></i> Add</button>
						  		<button id="removeRow" class="btn btn-danger removeRow">
						  			<i class="fa fa-times"></i> Remove</button>
						  	</div> -->
					  	</div>
					  	<div class="row" style="margin-top: 8px;">
						  	 <div class="col-md-12">
						  	 	<div class="row">
						  	 		<div class="col-md-6">
						  	 			<span class="font-weight-light">
								  			<strong> Tax: </strong>
								  		</span>
								  		<input type="hidden" name="tax" id="tax" class="tax" value="0">
								  		<select name="tax_select" id="tax_select" class="form-control form-control-sm tax_select">
							      			<option value="0"> None </option>
							      			<option value="5"> 5% </option>
							      			<option value="10"> 10% </option>
							      			<option value="17"> 17% </option>
								  		</select>
						  	 		</div>

						  	 		<div class="col-md-6">
						  	 			<span class="font-weight-light">
								  			<strong> Requested By: </strong>
								  		</span>
								  		<input type="text" name="requested_by" id="requested_by" class="form-control form-control-sm requested_by" oninput="<?php echo $onlyCharacter; ?>" value="<?php echo $_SESSION['user_fullname']; ?>" >
						  	 		</div>

						  	 		<div class="col-md-6">
						  	 			<span class="font-weight-light">
								  			<strong> Grand Total: </strong>
								  		</span>
								  		<input type="hidden" name="g_total" id="g_total" class="form-control form-control-sm g_total" value="">
								  		<input type="text" name="grand_total" id="grand_total" class="form-control form-control-sm grand_total" readonly value="0">
						  	 		</div>

						  	 		<!-- <div class="col-md-12 row" style="font-size: 14px; border: 1px solid red;">
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
											<input type="radio" name="taxCheckBox" class="ml-3 taxCheckBox" id="seventeen" value="17">
											&nbsp;<label for="seventeen">17</label>
							      		</div>
								  	</div> -->

						  	 		<div class="col-md-6 mt-1">
						  	 			<span class="font-weight-light">
								  			<strong> Grand Total with Tax: </strong>
								  		</span>
								  		<input type="text" name="grand_total_with_tax" id="grand_total_with_tax" class="form-control form-control-sm grand_total_with_tax" readonly value="0">
						  	 		</div>
						  	 	</div>
						  	 </div>
					  	</div>
					  	<div class="row mt-1">
						  	<div class="col-md-12" id="note_section">
						  		<span class="font-weight-light pull-left">
						  			<strong> Note:<i class="text-danger">*</i> </strong>
						  		</span>
						  		<span id="remaing_note_limit" class="pull-right" style="color: #979A9A; font-size: 13px; margin-top: 6px;">
						  			0/140
						  		</span>
						    	<textarea rows="3" name="note" form="prf_form" class="form-control form-control-sm note" placeholder="Aa" maxlength="140"></textarea>
						  	</div>
					  	</div>

					  	

					  	<input type="hidden" name="new_note" class="new_note">

					  	<div class="row" style="margin-top: 8px;">
						  	 <div class="col-md-12">
						  	 	<div class="row">
						  	 		<div class="col-md-6">
						  	 			<span class="font-weight-light">
								  			<strong> Invoice No: </strong>
								  		</span>
								  		<input type="text" name="invoice_no" id="invoice_no" class="form-control form-control-sm invoice_no" oninput="<?php echo $allowMultipleInvoiceNo; ?>" maxlength="99">
						  	 		</div>

						  	 		<div class="col-md-6 mt-1">
						  	 			<span class="font-weight-light">
								  			<strong> Invoice Date: </strong>
								  		</span>
								  		<input type="hidden" name="invoice_date" id="invoice_date" class="invoice_date">
								  		<input type="text" name="date" id="date" class="form-control form-control-sm date" readonly style="background:white;">
						  	 		</div>
						  	 	</div>
						  	 </div>
					  	</div>

					  	<div class="row" style="margin-top: 6px;">
							<div class="col-md-6">
								<label>Image:<i class="text-danger font-weight-light" style="font-size: 15px;">*</i></label>
								<div id="custom_btn_layout" style="padding:0px; margin-top: -22px;">
									<span class="error_msg"></span>
									<input type="file" id="actual-btn" class="invoice" name="invoice" hidden />
									<div style="margin-top: -12px;">
										<label for="actual-btn"><i class="fa fa-upload"></i>&nbsp; Choose</label>
										<span id="file-chosen"> No file chosen</span>
									</div>
								</div>
							</div>
						</div>

					  	<div class="form-group text-center" style="margin-top: 20px;">
					  		<input type="hidden" name="count" class="count" value="0">
					  		<input type="hidden" name="savedPRF" class="savedPRF" value="1">
					    	<input type="submit" id="form_submit_button" name="generate_prf" value="Generate" class="generate_prf">
					  	</div>
						</form>
					</div>
				</div>
			</div>
			<div id="bottom_layout"></div>
		</body>
		</html>
		<script type="text/javascript" src="js/prfs2.js?clear_cache=<?php echo time();?>"></script>
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