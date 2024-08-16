<?php
	
	include_once("includes/session.php");
	include_once('database/database.php');

	// Add Item to New Purchase
	if(isset($_POST["addToPurchase"])) {

		$row_id = $_POST['row_id'];
		$item_qty = $_POST['item_qty'];
		$username = $_SESSION['user_name'];

		$query = "Select * FROM products WHERE Id = '$row_id'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result) > 0) {	
			while ($row = mysqli_fetch_assoc($result)) {
				$product_id = $row['product_sku'];
				$description = $row['description'];
				$specification = $row['specification'];
				$price = $row['price'];
				$uom = $row['uom'];
			}
		}

		$query2 = "Insert INTO draft_items (type, username, product_id, description, specification, qty, uom, unit_price) VALUES ('purchase', '$username', '$product_id', '$description', '$specification', '$item_qty', '$uom', '$price')";
		$result2 = mysqli_query($connection, $query2);
		if ($result2) {
			echo 1;
			echo "[sprsprsprspr]";
			echo '<tr class="readonly_class">';
				echo '<td class="numbers_counter"> </td>';
				echo '<td> <input type="text" name="description[]" class="form-control form-control-sm description" readonly value="'.$description.'"> </td>';
				echo '<td> <input type="text" name="specification[]" class="form-control form-control-sm specification" readonly value="'.$specification.'"> </td>';
				echo '<td> <input type="text" name="qty[]" class="form-control form-control-sm qty" value="'.$item_qty.'" oninput="'.$onlyNumeric.'" maxlength="12"> </td>';
				
				echo '<td>';
					echo '<input type="hidden" name="uom[]" class="uom" value="'.$uom.'">';
					echo '<select id="unit_of_measurement" class="form-control form-control-sm unit_of_measurement" name="unit_of_measurement">';
						$query = "Select * FROM uom ORDER By unit_name ASC";
						$result = mysqli_query($connection, $query);
						if(mysqli_num_rows($result)) {
							while($row = mysqli_fetch_assoc($result)){

								$uom_value = $row['unit_name'];
								$selected = '';
								if ( isset($uom) && $uom == $uom_value) { 
									$selected = 'selected';
								}
								echo '<option value="'.$uom_value.'" '.$selected.'> '.$uom_value.' </option>';
							}
						}
					echo '</select>';
				echo '</td>';

				echo '<td> <input type="text" name="unit_price[]" class="form-control form-control-sm unit_price" value="'.$unit_price.'" oninput="'.$onlyNumeric.'" maxlength="12"> </td>';
				echo '<td> <input type="text" name="total[]" class="form-control form-control-sm total" readonly value="'.$line_total.'"> </td>';
				echo '<td> <input type="text" name="additional_note[]" class="form-control form-control-sm additional_note" maxlength="50" placeholder="A4 Tech"> </td>';
				echo '<td class="text-center" style="width: 30px; padding-top: 12px;">';

					echo '<a href="javascript:void(0)" id="remove_row" class="fa fa-times remove_row" style="margin-top: 12px; color: red; font-weight: lighter; text-decoration: none; font-size: 14px; margin-top: -4px;" title="Remove row"></a>';

					echo '<input type="hidden" name="product_id[]" class="product_id" value="'.$product_id.'">';
					echo '<input type="hidden" name="readonly[]" class="readonly" value="">';
					echo '<input type="hidden" name="row_id[]" class="row_id" value="'.$row_id.'">';
					echo '<input type="hidden" name="status[]" class="status" value="new">';

				echo '</td>';
			echo '</tr>';
		} else {
			echo "ERROR";
		}
	}


	// Save Draft
	if (isset($_POST['saveDraft'])) {
		
		$generated_by = $_POST['generated_by'];
		$vendor_id = $_POST['vendor_id'];
		$payment_mode = $_POST['payment_mode'];
		$credit_terms = $_POST['credit_terms'];
		$tax = $_POST["tax"];
		$discount = $_POST["discount"];
		$delivery_charges = $_POST["delivery_charges"];
		$reference_no = $_POST["reference_no"];
		$currency = $_POST["currency"];
		$comment = $_POST["comment"];
		$comment = str_replace("'", "&#39;", $comment);
		$comment = str_replace('"', '&#34;', $comment);

		// Items list
		$arr_product_ids = $_POST['product_ids'];
		$arr_descriptions = $_POST['descriptions'];
		$arr_specifications = $_POST['specifications'];
		$arr_qtys = $_POST['qtys'];
		$arr_uoms = $_POST['uoms'];
		$arr_unitprices = $_POST['unit_prices'];
		$arr_additionalnote = $_POST['additional_notes'];
		

		$query = "Select * FROM draft WHERE username = '$generated_by' && type = 'purchase'";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			$query2 = "Update draft SET vendor_id = '$vendor_id', payment_mode = '$payment_mode', credit_terms = '$credit_terms', tax = '$tax', discount = '$discount', delivery_charges = '$delivery_charges', currency = '$currency', comment = '$comment' WHERE username = '$generated_by' && type = 'purchase'";
		} else {
			$query2 = "Insert INTO draft (type, username, vendor_id, payment_mode, credit_terms, tax, discount, delivery_charges, currency, comment) VALUES('purchase', '$generated_by', '$vendor_id', '$payment_mode', '$credit_terms', '$tax', '$discount', '$delivery_charges', '$currency', '$comment')";
		}
		$result2 = mysqli_query($connection, $query2);

		$query3 = "Delete FROM draft_items WHERE username = '$generated_by' && type = 'purchase'";
		$result3 = mysqli_query($connection, $query3);

		for ($i=0; $i < count($arr_product_ids); $i++) {

			$product_id = $arr_product_ids[$i];
			$description = $arr_descriptions[$i];
			$specification = $arr_specifications[$i];
			$specification = str_replace("'", "&#39;", $specification);
			$specification = str_replace('"', '&#34;', $specification);
			$qty = $arr_qtys[$i];
			$uom = $arr_uoms[$i];
			$unit_price = $arr_unitprices[$i];
			$additional_note = $arr_additionalnote[$i];
			$additional_note = str_replace("'", "&#39;", $additional_note);
			$additional_note = str_replace('"', '&#34;', $additional_note);

			$query4 = "Insert INTO draft_items (type, username, product_id, description, specification, qty, uom, unit_price, additional_note) VALUES('purchase', '$generated_by', '$product_id', '$description', '$specification', '$qty', '$uom', '$unit_price', '$additional_note')";
			$result4 = mysqli_query($connection, $query4);
		}

		if ($result2 && $result3 && $result4) {
			echo 1;
		} else {
			echo "ERROR";
		}
	}

	// Save Purchase
	if (isset($_POST['action']) && $_POST['action'] == "savePurchase") {
		
		$generated_by = $_POST['generated_by'];
		$vendor_id = $_POST['vendor_id'];
		$payment_mode = $_POST['payment_mode'];
		$credit_terms = $_POST['credit_terms'];

		$arr_description = $_POST['description'];
		$arr_specifications = $_POST['specification'];
		$arr_product_ids = $_POST['product_id'];
		$arr_qtys = $_POST['qty'];
		$arr_uoms = $_POST['uom'];
		$arr_unit_prices = $_POST['unit_price'];
		$arr_totals = $_POST['total'];
		$arr_additional_note = $_POST['additional_note'];
		$total_rows = count($arr_description);

		$tax = $_POST['tax'];
		$discount = $_POST['discount'];
		$delivery_charges = $_POST['delivery_charges'];
		$grand_total = $_POST['grand_total'];
		$reference_no = $_POST['reference_no'];
		$currency = $_POST['currency'];

		$comment = $_POST['comment'];
		$comment = str_replace('"', '&#34', $comment);
		$comment = str_replace("'", "&#39", $comment);
		
		// save purchase
		$connection->begin_transaction();
		try {

			// update the purchase number
			$purchase_no = 0;
			$query = "Select * FROM counter WHERE Id = '1'";
			$result = mysqli_query($connection, $query);
			if(mysqli_num_rows($result)) {
				while ($row = mysqli_fetch_assoc($result)) {
					$purchase_no = $row['count'];
				}
			}
			$purchase_no = $purchase_no + 1;
			$update_count = "Update counter SET count = '$purchase_no' WHERE Id = '1'";
			mysqli_query($connection, $update_count);

			// insert the record into the purchases
			$query2 = "Insert INTO purchases (purchase_no, vendor_id, payment_mode, credit_terms, reference_no, tax, discount, delivery_charges, comment, grand_total, currency, status, generated_by) VALUES ('$purchase_no', '$vendor_id', '$payment_mode', '$credit_terms', '$reference_no', '$tax', '$discount', '$delivery_charges', '$comment', '$grand_total', '$currency', '1', '$generated_by')";
			$result2 = mysqli_query($connection, $query2);

			for ($i=0; $i < $total_rows; $i++) { 

				$product_id = $arr_product_ids[$i];
				$qty = $arr_qtys[$i];
				$uom = $arr_uoms[$i];
				$unit_price = $arr_unit_prices[$i];
				$line_total = $arr_totals[$i];
				$additional_note = $arr_additional_note[$i];
				$additional_note = str_replace('"', '&#34', $additional_note);
				$additional_note = str_replace("'", "&#39", $additional_note);
			
				// insert the record into the purchase_items
				$query3 = "Insert INTO purchase_items (purchase_no, product_id, qty, uom, unit_price, line_total, additional_note, status) VALUES ('$purchase_no', '$product_id', '$qty', '$uom', '$unit_price', '$line_total', '$additional_note', '1')";
				$result3 = mysqli_query($connection, $query3);
			}
			
			if ($result2 && $result3) {
				
				$connection->commit();
				// echo $purchase_no."[sprspr]1";
				echo 1;

				// delete the data into the draft
				$query4 = "Delete FROM draft WHERE type = 'purchase' && username = '$generated_by'";
				$result4 = mysqli_query($connection, $query4);

				$query5 = "Delete FROM draft_items WHERE type = 'purchase' && username = '$generated_by'";
				$result5 = mysqli_query($connection, $query5);
			} else {

				$connection->rollback();
				echo "ERROR";
			}
		} catch (Exception $e) {

			$connection->rollback();
			echo "Transaction rolled back. Error: " . $e->getMessage();
		}
	}

	// Empty Draft
	if (isset($_POST['emptyDraft'])) {

		$username = $_SESSION['user_name'];
		$query = "Delete FROM draft WHERE type = 'purchase' && username = '$username'";
		$result = mysqli_query($connection, $query);

		$query2 = "Delete FROM draft_items WHERE type = 'purchase' && username = '$username'";
		$result2 = mysqli_query($connection, $query2);

		if ($result && $result2) {
			echo 1;
		} else {
			echo "ERROR";
		}
	}

	// Add Item to Update Purchase
	if(isset($_POST["updateToPurchase"])) {
		
		$purchase_no = $_POST['purchase_no'];
		$id = $_POST['id'];
		$item_qty = $_POST['item_qty'];
		$username = $_SESSION['user_name'];

		$query = "Select * FROM products WHERE Id = '$id'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result) > 0) {	
			while ($row = mysqli_fetch_assoc($result)) {
				$product_id = $row['product_sku'];
				$description = ucfirst($row['description']);
				$specification = ucfirst($row['specification']);
				$uom = $row['uom'];
				$unit_price = $row['price'];
			}
		}
		$line_total = $item_qty * $unit_price;

		$itemsArray = array();
		$query2 = "Insert INTO purchase_items (purchase_no, product_id, qty, uom, unit_price, line_total) VALUES ('$purchase_no', '$product_id', '$item_qty', '$uom', '$unit_price', '$line_total')"; 
		$result2 = mysqli_query($connection, $query2);
		if ($result2) {
			$row_id = mysqli_insert_id($connection);
			
			echo 1;
			echo "[sprsprsprspr]";
			echo '<tr class="readonly_class">';
				echo '<td class="numbers_counter"> </td>';
				echo '<td> <input type="text" name="description[]" class="form-control form-control-sm description" readonly value="'.$description.'"> </td>';
				echo '<td> <input type="text" name="specification[]" class="form-control form-control-sm specification" readonly value="'.$specification.'"> </td>';
				echo '<td> <input type="text" name="qty[]" class="form-control form-control-sm qty" value="'.$item_qty.'" oninput="'.$onlyNumeric.'" maxlength="12"> </td>';
				
				echo '<td>';
					echo '<input type="hidden" name="uom[]" class="uom" value="'.$uom.'">';
					echo '<select id="unit_of_measurement" class="form-control form-control-sm unit_of_measurement" name="unit_of_measurement">';
						$query = "Select * FROM uom ORDER By unit_name ASC";
						$result = mysqli_query($connection, $query);
						if(mysqli_num_rows($result)) {
							while($row = mysqli_fetch_assoc($result)){

								$uom_value = $row['unit_name'];
								$selected = '';
								if ( isset($uom) && $uom == $uom_value) { 
									$selected = 'selected';
								}
								echo '<option value="'.$uom_value.'" '.$selected.'> '.$uom_value.' </option>';
							}
						}
					echo '</select>';
				echo '</td>';

				echo '<td> <input type="text" name="unit_price[]" class="form-control form-control-sm unit_price" value="'.$unit_price.'" oninput="'.$onlyNumeric.'" maxlength="12"> </td>';
				echo '<td> <input type="text" name="total[]" class="form-control form-control-sm total" readonly value="'.$line_total.'"> </td>';
				echo '<td> <input type="text" name="additional_note[]" class="form-control form-control-sm additional_note" maxlength="50" placeholder="A4 Tech"> </td>';
				echo '<td class="text-center" style="width: 30px; padding-top: 12px;">';

					echo '<a href="javascript:void(0)" id="remove_row" class="fa fa-times remove_row" style="margin-top: 12px; color: red; font-weight: lighter; text-decoration: none; font-size: 14px; margin-top: -4px;" title="Remove row"></a>';

					echo '<input type="hidden" name="product_id[]" class="product_id" value="'.$product_id.'">';
					echo '<input type="hidden" name="readonly[]" class="readonly" value="">';
					echo '<input type="hidden" name="row_id[]" class="row_id" value="'.$row_id.'">';
					echo '<input type="hidden" name="status[]" class="status" value="new">';

				echo '</td>';
			echo '</tr>';
		} else {
			echo "ERROR";
		}
	}

	// Update Purchase
	if (isset($_POST['action']) && $_POST['action'] == "updatePurchase") {

		$edit_id = $_POST['edit_id'];
		$purchase_no = $_POST['purchase_no'];

		$vendor_id = $_POST['vendor_id'];
		$payment_mode = $_POST['payment_mode'];
		$credit_terms = $_POST['credit_terms'];

		$arr_description = $_POST['description'];
		$arr_specifications = $_POST['specification'];
		$arr_product_ids = $_POST['product_id'];
		$arr_qtys = $_POST['qty'];
		$arr_uoms = $_POST['uom'];
		$arr_unit_prices = $_POST['unit_price'];
		$arr_totals = $_POST['total'];
		$arr_additional_note = $_POST['additional_note'];
		$total_rows = count($arr_description);

		$deleted_ids = isset($_POST['deleted_ids']) ? $_POST['deleted_ids'] : '';
		if ($deleted_ids) {
			$arr_deleted_ids = explode(",", $deleted_ids);
		} else {
			$arr_deleted_ids = array();
		}
		// pre_r($arr_deleted_ids);
		// die();
		$arr_row_ids = $_POST['row_id'];
		$arr_statuses = $_POST['status'];

		$tax = $_POST['tax'];
		$discount = $_POST['discount'];
		$delivery_charges = $_POST['delivery_charges'];
		$grand_total = $_POST['grand_total'];
		$reference_no = $_POST['reference_no'];
		$currency = $_POST['currency'];

		$comment = $_POST['comment'];
		$comment = str_replace('"', '&#34', $comment);
		$comment = str_replace("'", "&#39", $comment);

		$updated_by = $_POST['updated_by'];
		$updated_at = date("Y-m-d H:i:s", strtotime("+4 Hours"));
		
		// save purchase
		$connection->begin_transaction();
		try {
			$query = "Update purchases SET vendor_id = '$vendor_id', payment_mode = '$payment_mode', credit_terms = '$credit_terms', reference_no = '$reference_no', tax = '$tax', discount = '$discount', delivery_charges = '$delivery_charges', comment = '$comment', grand_total = '$grand_total', currency = '$currency', updated_by = '$updated_by', updated_at = '$updated_at' WHERE Id = '$edit_id'";
			$result = mysqli_query($connection, $query);

			// delete the rows from purchase_items
			for ($i=0; $i < count($arr_deleted_ids); $i++) {
				$deletd_id = $arr_deleted_ids[$i];
				$query2 = "Delete FROM purchase_items WHERE Id = '$deletd_id'";
				$result2 = mysqli_query($connection, $query2);
			}

			// update the rows from purchase_items
			for ($j=0; $j < $total_rows; $j++) { 
				
				$id = $arr_row_ids[$j];
				$qty = $arr_qtys[$j];
				$uom = $arr_uoms[$j];
				$unit_price = $arr_unit_prices[$j];
				$line_total = $arr_totals[$j];
				$additional_note = $arr_additional_note[$j];
				$query3 = "Update purchase_items SET qty = '$qty', uom = '$uom', unit_price = '$unit_price', line_total = '$line_total', additional_note = '$additional_note', status = '1' WHERE Id = '$id'";
				$result3 = mysqli_query($connection, $query3);
			}

			if ($result && $result3) {
				$connection->commit();
				echo 1;
			} else {
				$connection->rollback();
				echo "ERROR";
			}
		} catch (Exception $e) {

			$connection->rollback();
			echo "Transaction rolled back. Error: " . $e->getMessage();
		}
	}


	// Closed
	if(isset($_POST["isClosed"])) {

		$id = $_POST['id'];
		// Update purchase table
		$connection->begin_transaction();
		try {
			$query = "Update purchases SET is_closed = '1' WHERE purchase_no = '$id'";
			$result = mysqli_query($connection, $query);

			if ($result) {
				$connection->commit();
				echo 1;
			} else {
				$connection->rollback();
				echo "ERROR";
			}

		} catch (Exception $e) {

			$connection->rollback();
			echo "Transaction rolled back. Error: " . $e->getMessage();
		}
	}

	// Closed
	if(isset($_POST["isReOpen"])) {

		$id = $_POST['id'];
		// Update purchase table
		$connection->begin_transaction();
		try {
			$query = "Update purchases SET is_closed = '0' WHERE purchase_no = '$id'";
			$result = mysqli_query($connection, $query);

			if ($result) {
				$connection->commit();
				echo 1;
			} else {
				$connection->rollback();
				echo "ERROR";
			}

		} catch (Exception $e) {

			$connection->rollback();
			echo "Transaction rolled back. Error: " . $e->getMessage();
		}
	}

?>