<?php
include_once("includes/session.php");
include_once('database/database.php');
if($_SESSION['user_email'] == true) {

	if ($_SESSION['user_role'] == "admin") {

		$count = 0;
		$editid = $_GET['id'];
		$query2 = "Select * FROM products";
		$result2 = mysqli_query($connection, $query2);
		if ( mysqli_num_rows($result2) > 0) {
			while ($row = mysqli_fetch_assoc($result2)) {
				if ( $editid == md5( $row['Id']) ) {
					
					$editid = $row['Id'];
					$id = $row['Id'];
					$description = $row['description'];
					$specification = $row['specification'];
					$product_sku = $row['product_sku'];
					$mfg = $row['mfg'];
					$mfg_pn = $row['mfg_pn'];
					$stock = $row['stock'];
					$db_uom = $row['uom'];
					$unit_price = $row['price'];
					$item_type = $row['item_type'];
					$count++;
				}
			}
		}
		if ($count == 0) {
			header('Location:page_not_found.php');
		}

		// $query = "Select * FROM products WHERE Id = '$editid'";
		// $result = mysqli_query($connection, $query);
		// if(mysqli_num_rows($result) > 0) {
		// 	while ($row = mysqli_fetch_assoc($result)) {
		// 		$id = $row['Id'];
		// 		$description = $row['description'];
		// 		$specification = $row['specification'];
		// 		$product_sku = $row['product_sku'];
		// 		$mfg = $row['mfg'];
		// 		$mfg_pn = $row['mfg_pn'];
		// 		$stock = $row['stock'];
		// 		$uom = $row['uom'];
		// 		$price = $row['price'];
		// 		$item_type = $row['item_type'];
		// 	}
		// } else {
		// 	header('Location:page_not_found.php');
		// }
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
			<div id="inner_layout" style="">
				<div id="demand_layout">

					<div id="page_heading" class="row">
						Edit Item
						<div class="d-flex align-items-center heading_number">
							(
							<span> #</span>	
							<span> <?php echo mraCreateSixDigitNumber($id); ?> </span>
							)
						</div>
					</div>
					<div id="margin_div"></div>

					<form id="editproduct_form">
						<input type="hidden" id="product_id" name="product_id" class="product_id">
						<div class="row">
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Item Name:<i class="text-danger">*</i> </strong>
								</span>
								<input type="text" id="product_name" name="product_name" class="form-control form-control-sm product_name" placeholder="Wireless Keyboard" maxlength="100" value="<?php echo $description; ?>" oninput="<?php echo $aplhaNumericwithParenthesisandComma; ?>">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Specification: </strong>
								</span>
								<input type="text" id="specification" name="specification" class="form-control form-control-sm specification" placeholder="A4 Tech, Logitech" maxlength="150" value="<?php echo $specification; ?>">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Stock: </strong>
								</span>
								<input type="text" id="stock" name="stock" class="form-control form-control-sm stock" placeholder="1" maxlength="12" value="<?php echo $stock; ?>" oninput="<?php echo $onlyNumeric; ?>">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> UOM:<i class="text-danger">*</i> </strong>
								</span>
								<input type="hidden" id="uom" name="uom" class="uom" value="<?php echo $db_uom; ?>">
						    	<select id="unit_of_measurement" name="unit_of_measurement" class="form-control form-control-sm unit_of_measurement">
									<option value="" disabled selected hidden> -- Choose -- </option>
									<?php
										$query = "Select * FROM uom ORDER By unit_name ASC";
										$result = mysqli_query($connection, $query);
										if(mysqli_num_rows($result)) {
											while($row = mysqli_fetch_assoc($result)){
												$uom = $row['unit_name'];
												$selected = "";
												if ($uom == $db_uom) {
													$selected = "selected";
												}
												echo '<option value="'.$uom.'" '.$selected.'>'.$uom.'</option>';
											}
										}
									?>
								</select>
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Unit Price: </strong>
								</span>
								<input type="text" id="unit_price" name="unit_price" class="form-control form-control-sm unit_price" placeholder="0.00" maxlength="12" value="<?php echo $unit_price; ?>" oninput="<?php echo $onlyNumeric; ?>">
							</div>
							<div class="col-md-6 mt-1">
								<span class="font-weight-light">
									<strong> Item Type:</strong>
								</span>
								<input type="hidden" id="item_type" name="item_type" class="item_type" value="<?php echo $item_type; ?>">
				      		<select id="item_type_select" name="item_type_select" class="form-control form-control-sm item_type_select">
				      			<option value="" disabled selected hidden> -- Choose -- </option>
				      			<option value="assets" <?php if (isset($item_type) && $item_type == "assets") { echo 'selected'; } ?>>Assets</option>
				      			<option value="consumable" <?php if (isset($item_type) && $item_type == "consumable") { echo 'selected'; } ?>>Consumable</option>
				      			<option value="tool" <?php if (isset($item_type) && $item_type == "tool") { echo 'selected'; } ?>>Tool</option>
				      			<option value="service" <?php if (isset($item_type) && $item_type == "service") { echo 'selected'; } ?>>Service</option>
				      		</select>
							</div>
						</div>
						
						<input type="hidden" id="action" name="action" value="updateProduct">
						<input type="hidden" id="editid" name="editid" value="<?php echo $editid; ?>">
						<div class="form-group text-center" style="margin-top: 20px;">
					    	<input type="submit" id="form_submit_button" value="Update" class="update_product">
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