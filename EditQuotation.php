<?php
	include_once('database/database.php');
	include_once("includes/session.php");
	if($_SESSION['user_email'] == true) {
		
		$username = $_SESSION['user_name'];
		$user_fullname = $_SESSION['user_fullname'];
		$user_email = $_SESSION['user_email'];
		if ($_SESSION['user_role'] == "admin") {
			
			$isExist = 0;
	  		$editid = $_GET['id'];
			$query = "Select * FROM quotations";
			$result = mysqli_query($connection, $query);
			$isDraft = mysqli_num_rows($result);
			if (mysqli_num_rows($result)) {
				while ($row = mysqli_fetch_assoc($result)) {
					if ($editid == md5($row['quotation_no'])) {
						
						$edit_id = $row['Id'];
						$quotation_no = $row['quotation_no'];
						$dbclient_id = $row['client_id'];
						$payment_mode = $row['payment_mode'];
						$credit_terms = $row['credit_terms'];
						$tax = $row['tax'];
						$discount = $row['discount'];
						$delivery_charges = $row['delivery_charges'];
						$currency = $row['currency'];
						$comment = $row['comment'];
						$created_at = $row['created_at'];
						$dateTime = date('F d, Y H:i', strtotime($created_at));
						$isExist++;
					}
				}
			}
			if ($isExist == 0) {
				header('Location:page_not_found.php');
			}

			$query2 = "Delete FROM quotation_items WHERE quotation_no = '$quotation_no' && status = 0";
			mysqli_query($connection, $query2);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php") ?>
		<title>IMS - Quotation</title>
		<style type="text/css">
			.dataTables_filter input {
				width: 200px !important;
			}
			.page-link {
				color: #14213D !important;
			}
			.active .page-link {
				color: white !important;
				background: #14213D !important;
				border: 1px solid #14213D !important;
			}
			
			#LoadItemsInModalLabel {
				color: #154360;
			}
			#add_to_quote i {
				width: 30px !important;
				height: 30px !important;
				color: #14213D !important;
				padding-top: 8px !important;
				border-radius: 4px !important;
				border: 1px solid #14213D !important;
			}
			#add_to_quote i:hover {
				color: #FFFFFF !important;
				background: #14213D !important;
			}
		</style>
	</head>
	<body id="body">
		<div class="overlay"><div class="loader"></div></div>
		<?php include_once('includes/navbar.php'); ?>

		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="demand_layout">
			
					<div id="page_heading" class="row">
						Edit Quotation
						<div class="d-flex align-items-center heading_number">
							(
								<span> #</span>	
								<span> <?php echo mraCreateSixDigitNumber($quotation_no); ?> </span>
							)
						</div>
					</div>
					<div id="margin_div"></div>

					
					<!-- <div class="row p-0" id="single_page_heading">
						<div class="col-md-3">
							<div id="single_page_heading_outer">
								<span id="single_page_heading_inner">Date:</span>
								<span id="single_page_heading_text"> <?php echo $dateTime; ?> </span>
							</div>
						</div>
					</div> -->
					<form id="editquotation_form">
						
						<div class="row mt-1">
							<div class="col-md-3 mt-1">
								<span class="font-weight-light">
									<strong> Date: </strong>
								</span>
								<input id="date" name="date" class="form-control form-control-sm date" value="<?php echo $dateTime; ?>" readonly>
							</div>
							<div class="col-md-3 mt-1">
								<span class="font-weight-light">
									<strong> Client:<i class="text-danger">*</i> </strong>
								</span>
								<select id="client_id" name="client_id" class="form-control form-control-sm client_id">
									<option value="" disabled selected hidden> -- Choose -- </option>
									<?php
										$query = "Select * FROM clients ORDER By client_name ASC";
										$result = mysqli_query($connection, $query);
										if(mysqli_num_rows($result)) {
											while($row = mysqli_fetch_assoc($result)){
												$client_id = $row['client_id'];
												$client_name = ucfirst($row['client_name']);

												$selected = '';
												if ($dbclient_id == $client_id) {
													$selected = 'selected';
												}

												echo '<option value="'.$client_id.'" '.$selected.'>'.$client_name.'</option>';
											}
										}
									?>
								</select>
							</div>
							<div class="col-md-3 mt-1">
								<span class="font-weight-light">
									<strong> Payment Mode:<i class="text-danger">*</i> </strong>
								</span>
								<select id="payment_mode" name="payment_mode" class="form-control form-control-sm payment_mode">
									<option value="" disabled selected hidden> Choose </option>
									<option value="cash"
										<?php
											if (isset($payment_mode) && $payment_mode == "cash") {
												echo 'selected';
											}
										?>
									>Cash</option>
									<option value="cheque"
										<?php
											if (isset($payment_mode) && $payment_mode == "cheque") {
												echo 'selected';
											}
										?>
									>Cheque</option>
									<option value="Wire Transfer/TT"
										<?php
											if (isset($payment_mode) && $payment_mode == "Wire Transfer/TT") {
												echo 'selected';
											}
										?>
									>Wire Transfer/TT</option>
								</select>
							</div>
							<div class="col-md-3 mt-1">
								<span class="font-weight-light">
									<strong> Credit Terms:<i class="text-danger">*</i> </strong>
								</span>
								<select id="credit_terms" name="credit_terms" class="form-control form-control-sm credit_terms">
									<option value="" disabled selected hidden> Choose </option>
									<option value="Net 10"
										<?php
											if (isset($credit_terms) && $credit_terms == "Net 10") {
												echo 'selected';
											}
										?>
									>Net 10</option>
									<option value="Net 15"
										<?php
											if (isset($credit_terms) && $credit_terms == "Net 15") {
												echo 'selected';
											}
										?>
									>Net 15</option>
									<option value="Net 30"
										<?php
											if (isset($credit_terms) && $credit_terms == "Net 30") {
												echo 'selected';
											}
										?>
									>Net 30</option>
									<option value="prepay"
										<?php
											if (isset($credit_terms) && $credit_terms == "prepay") {
												echo 'selected';
											}
										?>
									>Prepay</option>
									<option value="per agreed terms"
										<?php
											if (isset($credit_terms) && $credit_terms == "per agreed terms") {
												echo 'selected';
											}
										?>
									>Per agreed terms</option>
								</select>
							</div>
						</div>
					  	
						<input type="hidden" name="updated_by" class="updated_by" value="<?php echo $username; ?>">
						<input type="hidden" name="quotation_no" class="quotation_no" value="<?php echo $quotation_no; ?>">
					  	
					  	<div class="mt-3" style="box-shadow: 0px 0px 8px 0px #bebebe; padding: 8px 15px; background: #FBFCFC; border-radius: 5px; margin-top:12px !important; padding-bottom: 18px;">
					  		<div class="d-flex justify-content-between">
					  			<div> <h4 id="subform_demand_products"> Make a quotation list </h4> </div>
					  			<div>
					  				<a class="btn btn-sm add_row" href="javascript:void(0)" data-toggle="modal" data-target="#LoadItemsInModal"> Add </a>
					  			</div>
					  		</div>
					  		<?php include_once("LoadItemsInModalForEditQuotation.php"); ?>
							
							<div style="overflow: auto;">
							  	<table id="QuotationListTable" class="table-sm table-hover table-striped table_form_style" style="min-width: 1000px;">
							  		<thead class="card-header">
							  			<tr>
							  				<th width="40px"> # </th>
							  				<th width="220px"> Item Description </th>
							  				<th width="180"> Specification </th>
							  				<th width="120px"> Quantity<i class="text-danger">*</i> </th>
							  				<th width="120px"> UOM<i class="text-danger">*</i> </th>
							  				<th width="120px"> Unit Price<i class="text-danger">*</i> </th>
							  				<th width="120px"> Line Total </th>
							  				<th width="180px"> Additional Notes </th>
							  				<th width="40px">  </th>
							  			</tr>
							  		</thead>
							  		<tbody id="editquotation_items">
							  			<tr></tr>
							  			<?php
							  				$count = 1;
							  				$query4 = "Select * FROM quotation_items WHERE quotation_no = '$quotation_no' && status = '1'";
							  				$result4 = mysqli_query($connection, $query4);
							  				if(mysqli_num_rows($result4) > 0) {
							  					while ($row4 = mysqli_fetch_assoc($result4)) {
							  						
							  						$row_id = $row4['Id'];
							  						$product_id = $row4['product_id'];
							  						// $description = ucfirst($row4['description']);
							  						// $specification = $row4['specification'];
							  						$qty = $row4['qty'];
							  						$uom = $row4['uom'];
							  						$unit_price = $row4['unit_price'];
							  						$line_total = $qty * $unit_price;
							  						$additional_note = $row4['additional_note'];
							  						$status = $row4['status'];

							  						$readonly = "";
							  						$readonly_class = "";
							  						$e_product_id = "";
							  						$query5 = "Select * FROM products WHERE product_sku = '$product_id'";
							  						$result5 = mysqli_query($connection, $query5);
							  						if (mysqli_num_rows($result5) > 0) {
							  							while ($row5 = mysqli_fetch_assoc($result5)) {
							  								
															$Id = $row5['Id'];
							  								$e_product_id = $row5['product_sku'];
							  								$description = ucfirst($row5['description']);
							  								$specification = $row5['specification'];
							  								// $uom = $row5['uom'];
							  								$item_type = $row5['item_type'];
							  							}
							  						}

							  						if ($product_id == $e_product_id) {
							  							
							  							if ($product_id) {
								  							$readonly = "readonly";
								  							$readonly_class = "readonly_class";
								  						}
							  						}

							  						$readonly = "readonly";
							  						$readonly_class = "readonly_class";
							  						if ($description) {
							  							$readonly = "";
							  							$readonly_class = "";
							  						}
							  			?>
							  				<tr class="<?php echo $readonly_class; ?>">
							  					<td class="numbers_counter"> <?php echo $count++; ?> </td>
							  					<td>
													<input type="text" id="description" name="description[]"  class="form-control form-control-sm description" placeholder="Key board" oninput="<?php echo $expectQuotationSymbols; ?>" value="<?php if(isset($description)) { echo $description; } ?>" maxlength="80" readonly>
												</td>
							  					<td> <input type="text" id="specification" name="specification[]" class="form-control form-control-sm specification" placeholder="A4 Tech" oninput="" value="<?php if(isset($specification)) { echo $specification; } ?>" maxlength="200" readonly> </td>
							  					<td> <input type="text" id="qty" name="qty[]" class="form-control form-control-sm qty" placeholder="1" oninput="<?php echo $onlyNumeric; ?>" value="<?php if(isset($qty)) { echo $qty; } ?>" maxlength="12" <?php echo $readonly; ?>> </td>
							  					<td>
													<input type="hidden" id="uom" name="uom[]" class="uom" value="<?php if(isset($uom)) { echo $uom; } ?>">
													<select id="unit_of_measurement" class="form-control form-control-sm unit_of_measurement" name="unit_of_measurement" <?php echo $readonly; ?>>
														<option value="" disabled selected hidden> Choose </option>
														<?php
															$query11 = "Select * FROM uom ORDER By unit_name ASC";
															$result11 = mysqli_query($connection, $query11);
															if(mysqli_num_rows($result11) > 0) {
																while( $row11 = mysqli_fetch_assoc($result11) ){
																	$uom_value = $row11['unit_name'];

																	$selected = '';
																	if ( isset($uom) && $uom == $uom_value) { 
																		$selected = 'selected';
																	}
																	echo '<option value="'.$uom_value.'" '.$selected.'> '.$uom_value.' </option>';
																}
															}
														?>
													</select>
												</td>
												<td> <input type="text" id="unit_price" name="unit_price[]" class="form-control form-control-sm unit_price" placeholder="100.0" oninput="<?php echo $onlyNumeric; ?>" value="<?php if(isset($unit_price)) { echo $unit_price; } ?>" maxlength="12" <?php echo $readonly; ?>> </td>
												<td> <input type="text" id="total" name="total[]" class="form-control form-control-sm total" placeholder="100.0" value="<?php if(isset($line_total)) { echo $line_total; } ?>" readonly> </td>
												<td> <input type="text" id="additional_note" name="additional_note[]" class="form-control form-control-sm additional_note" placeholder="A4 Tech" value="<?php if(isset($additional_note)) { echo $additional_note; } ?>" maxlength="50" <?php echo $readonly; ?>> </td>

												<td style="width: 30px; padding-top: 12px; text-align: center;">
													<a href="javascript:void(0)" id="remove_row" class="fa fa-times remove_row" style="margin-top: 12px; color: red; font-weight: lighter; text-decoration: none; font-size: 14px; margin-top: -4px;" title="Remove row"></a>
													
													<input type="hidden" id="product_id" name="product_id[]" class="product_id" value="<?php echo $product_id; ?>">
													<input type="hidden" id="readonly" name="readonly[]" class="readonly" value="<?php echo $readonly; ?>">
													<input type="hidden" id="row_id" name="row_id[]" class="row_id" value="<?php echo $row_id; ?>">
													<input type="hidden" id="status" name="status[]" class="status" value="<?php echo $status; ?>">
												</td>
							  				</tr>
							  			<?php
							  					}
							  				}
							  			?>
							  		</tbody>
							  	</table>
							</div>

						  	<!-- <div class="text-center" id="create_demand_action">
						  		<button id="addRow" class="btn btn-success addRow">
						  			<i class="fa fa-plus"></i> Add
								</button>
						  		<button id="removeRow" class="btn btn-danger removeRow">
						  			<i class="fa fa-times"></i> Remove
								</button>
						  	</div> -->
					  	</div>

						<div class="row mt-1" style="font-size: 15px;">

							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Tax: </strong>
								</span>
								<input type="" id="tax" name="tax" class="form-control form-control-sm tax" placeholder="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="10" value="<?php if(isset($tax)) { echo $tax; } ?>">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Discount: </strong>
								</span>
								<input type="" id="discount" name="discount" class="form-control form-control-sm discount" placeholder="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="10" value="<?php if(isset($discount)) { echo $discount; } ?>">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Delivery Charges: </strong>
								</span>
								<input type="" id="delivery_charges" name="delivery_charges" class="form-control form-control-sm delivery_charges" placeholder="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="10" value="<?php if(isset($delivery_charges)) { echo $delivery_charges; } ?>">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Grand Total: </strong>
								</span>
								<input type="" id="grand_total" name="grand_total" class="form-control form-control-sm grand_total" placeholder="100.0" maxlength="10" readonly>
							</div>
						</div>

					  	<div class="col-md-12 p-0 mt-1">
					  		<span class="font-weight-light pull-left">
					  			<strong> Comment: </strong>
					  		</span>
					  		<span id="character_limit" class="pull-right" style="color: #979A9A; font-size: 13px; margin-top: 5px;">
					  			0/399
					  		</span>

					  		<input type="hidden" name="new_note" class="new_note" value="<?php if(isset($comment)) { echo $comment; } ?>">
					    	<textarea rows="3" name="comment" form="editquotation_form" class="form-control form-control-sm comment" placeholder="Aa" maxlength="299"><?php if ( isset($comment)) { echo $comment; }?></textarea>
					  	</div>
					  	
					   <input type="hidden" name="currency" value="<?php echo $currency; ?>" />
					   <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>" />
					   <input type="hidden" name="deleted_ids" class="deleted_ids" />
					   <input type="hidden" name="action" value="updateQuote" />
					  	<input type="hidden" class="counter" value="<?php echo $count-1; ?>">
					  	<div class="form-group text-center mt-3">
					    	<input type="submit" id="form_submit_button" name="update_quotation" value="Update" class="update_quotation">
					  	</div>
					</form>
		</div>
		</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/editquotation.js?clear_cache=<?php echo time();?>"></script>
<script type="text/javascript">
	
	$(".readonly_class").hover(function(){
	  	$(this).css("pointer-events", "none");
	}, function(){
	  	// $(this).css("pointer-events", "none");
	});

</script>
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