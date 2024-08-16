<?php
	include_once('database/database.php');
	include_once("includes/session.php");
	if($_SESSION['user_email'] == true) {

		if ($_SESSION['user_role'] == "admin") {
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>MRA - Item</title>
	</head>
	<body id="body">
		<?php include_once('includes/navbar.php'); ?>
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="demand_layout">
					
					<div id="page_heading" class="row">
						New Item
					</div>
					<div id="margin_div"></div>

					<form id="product_form">
						<input type="hidden" id="product_id" name="product_id" class="product_id">
			      	<div class="row">
				      	<div class="col-md-6 mt-1">
				      		<span class="font-weight-light">
				      			<strong> Item Name:<i class="text-danger">*</i></strong>
				      		</span>
						    	<input type="text" id="product_name" name="product_name" class="form-control form-control-sm product_name" placeholder="Wireless Keyboard" maxlength="100" oninput="<?php echo $aplhaNumericwithParenthesisandComma; ?>">
						  	</div>
						  	<div class="col-md-6 mt-1">
				      		<span class="font-weight-light">
				      			<strong> Specification: </strong>
				      		</span>
				      		<input type="text" id="specification" name="specification" class="form-control form-control-sm specification" placeholder="A4 Tech, Logitech" maxlength="150">
						  	</div>
						  	<div class="col-md-6 mt-1">
						    	<span class="font-weight-light">
					      		<strong> Stock: </strong>
					      	</span>
						    	<input type="text" id="stock" name="stock" class="form-control form-control-sm stock" placeholder="1" maxlength="12" oninput="<?php echo $onlyNumeric; ?>">
						  	</div>
						  	<div class="col-md-6 mt-1">
						    	<span class="font-weight-light">
					      		<strong> UOM:<i class="text-danger">*</i> </strong>
					      	</span>
						    	<input type="hidden" id="uom" name="uom" class="uom">
						    	<select id="unit_of_measurement" name="unit_of_measurement" class="form-control form-control-sm unit_of_measurement">
									<option value="" disabled selected hidden> -- Choose -- </option>
									<?php
										$query = "Select * FROM uom ORDER By unit_name ASC";
										$result = mysqli_query($connection, $query);
										if(mysqli_num_rows($result)) {
											while($row = mysqli_fetch_assoc($result)){
												$uom = $row['unit_name'];
												echo '<option value="'.$uom.'">'.$uom.'</option>';
											}
										}
									?>
								</select>
						  	</div>
						  	<div class="col-md-6 mt-1">
				      		<span class="font-weight-light">
				      			<strong> Unit Price: </strong>
				      		</span>
						    	<input type="text" id="unit_price" name="unit_price" class="form-control form-control-sm unit_price" placeholder="0.00" maxlength="12" oninput="<?php echo $onlyNumeric; ?>">
						  	</div>
						  	<!-- <div class="col-md-6 mt-1">
				      		<span class="font-weight-light">
				      			<strong> Dimension: </strong>
				      		</span>
					      	<div class="row">
								   <div class="col">
								      <input type="text" class="form-control form-control-sm length" placeholder="0mm" id="" name="length">
								   </div> <span style="padding-top: 3px;">X</span>
								   <div class="col">
								      <input type="text" class="form-control form-control-sm width" placeholder="0mm" id="width" name="width">
								   </div> <span style="padding-top: 3px;">X</span>
								   <div class="col">
								      <input type="text" class="form-control form-control-sm height" placeholder="0mm" id="height" name="height">
								   </div>
							  	</div>
						  	</div> -->
					  		<div class="col-md-6 mt-1">
				      		<span class="font-weight-light">
				      			<strong> Item Type:<i class="text-danger">*</i> </strong>
				      		</span>
				      		<input type="hidden" id="item_type" name="item_type" class="item_type">
				      		<select id="item_type_select" name="item_type_select" class="form-control form-control-sm item_type_select">
				      			<option value="" disabled selected hidden> -- Choose -- </option>
				      			<option value="assets">Assets</option>
				      			<option value="consumable">Consumable</option>
				      			<option value="tool">Tool</option>
				      			<option value="service">Service</option>
				      		</select>
					  		</div>
						</div>
						<input type="hidden" id="action" name="action" value="newProduct">
						<div class="form-group text-center" style="margin-top: 20px;">
					    	<input type="submit" id="form_submit_button" value="Create" class="create_product">
					  	</div>
					</form>
				</div>
			</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/products.js?clear_cache=<?php echo time();?>"></script>
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