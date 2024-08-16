<?php
	
	include_once("includes/session.php");
	include_once('database/database.php');

	// Add Item to New Invoice
	if (isset($_POST['action']) && $_POST['action'] == "saveInvoice") {

		$quotation_no = $_POST['quotation_no'];
		$generated_by = $_POST['generated_by'];
		$client_id = $_POST['client_id'];
		$payment_mode = $_POST['payment_mode'];
		$credit_terms = $_POST['credit_terms'];

		$arr_is_changed = $_POST['is_changed'];
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
		$po_no = $_POST['po_no'];
		$comment = $_POST['comment'];
		$comment = str_replace('"', '&#34', $comment);
		$comment = str_replace("'", "&#39", $comment);

		// save quotation
		$connection->begin_transaction();
		try {

			// update the quotation number
			$invoice_no = 0;
			$query = "Select * FROM counter WHERE Id = '3'";
			$result = mysqli_query($connection, $query);
			if(mysqli_num_rows($result)) {
				while ($row = mysqli_fetch_assoc($result)) {
					$invoice_no = $row['count'];
				}
			}
			$invoice_no = $invoice_no + 1;
			$update_count = "Update counter SET count = '$invoice_no' WHERE Id = '3'";
			mysqli_query($connection, $update_count);


			// insert the record into the invoices
			$query2 = "Insert INTO invoices (invoice_no, quotation_no, po_no, payment_mode, credit_terms, tax, discount, delivery_charges, comment, grand_total, status, generated_by) VALUES ('$invoice_no', '$quotation_no', '$po_no', '$payment_mode', '$credit_terms', '$tax', '$discount', '$delivery_charges', '$comment', '$grand_total', '1', '$generated_by')";
			$result2 = mysqli_query($connection, $query2);

			for ($i=0; $i < $total_rows; $i++) { 

				$is_changed = $arr_is_changed[$i];
				if ($is_changed) {
					
					$product_id = $arr_product_ids[$i];
					$qty = $arr_qtys[$i];
					$uom = $arr_uoms[$i];
					$unit_price = $arr_unit_prices[$i];
					$line_total = $arr_totals[$i];
					$additional_note = $arr_additional_note[$i];
					$additional_note = str_replace('"', '&#34', $additional_note);
					$additional_note = str_replace("'", "&#39", $additional_note);
				
					// insert the record into the quotation_items
					$query3 = "Insert INTO invoice_items (invoice_no, product_id, qty, uom, unit_price, line_total, additional_note, status) VALUES ('$invoice_no', '$product_id', '$qty', '$uom', '$unit_price', '$line_total', '$additional_note', '1')";
					$result3 = mysqli_query($connection, $query3);

					$query4 = "Update quotation_items SET is_invoice_generated = '1' WHERE product_id = '$product_id' && quotation_no = '$quotation_no'";
					$result4 = mysqli_query($connection, $query4);
				}
			}

			$query5 = "Update quotations SET is_closed = '1' WHERE quotation_no = '$quotation_no'";
			$result5 = mysqli_query($connection, $query5);

			if ($result2 && $result3 && $result4 && $result5) {
				
				$connection->commit();
				echo $invoice_no."[sprspr]1";
			} else {

				$connection->rollback();
				echo "ERROR";
			}

		} catch (Exception $e) {

			$connection->rollback();
			echo "Transaction rolled back. Error: " . $e->getMessage();
		}
	}


	if (isset($_POST['action']) && $_POST['action'] == "updateInvoice") {
		
		$invoice_no = $_POST['invoice_no'];
		$quotation_no = $_POST['quotation_no'];
		$updated_by = $_POST['updated_by'];
		$updated_at = date("Y-m-d H:i:s", strtotime("+4 Hours"));
		$payment_mode = $_POST['payment_mode'];
		$credit_terms = $_POST['credit_terms'];
		
		$arr_is_changed = $_POST['is_changed'];
		$arr_item_row_id = $_POST['item_row_id'];
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
		$po_no = $_POST['po_no'];
		$comment = $_POST['comment'];
		$comment = str_replace('"', '&#34', $comment);
		$comment = str_replace("'", "&#39", $comment);

		// save quotation
		$connection->begin_transaction();
		try {

			$query = "Update invoices SET po_no = '$po_no', payment_mode = '$payment_mode', credit_terms = '$credit_terms', tax = '$tax', discount = '$discount', delivery_charges = '$delivery_charges', comment = '$comment', grand_total = '$grand_total', updated_by = '$updated_by', updated_at = '$updated_at' WHERE invoice_no = '$invoice_no' && quotation_no = '$quotation_no'";
			$result = mysqli_query($connection, $query);

			for ($i=0; $i < $total_rows; $i++) { 

				$is_changed = $arr_is_changed[$i];
				$id = $arr_item_row_id[$i];
				$product_id = $arr_product_ids[$i];
				$qty = $arr_qtys[$i];
				$uom = $arr_uoms[$i];
				$unit_price = $arr_unit_prices[$i];
				$line_total = $arr_totals[$i];
				$additional_note = $arr_additional_note[$i];
				$additional_note = str_replace('"', '&#34', $additional_note);
				$additional_note = str_replace("'", "&#39", $additional_note);

				if ($is_changed) {
					$query3 = "Update invoice_items SET qty = '$qty', uom = '$uom', unit_price = '$unit_price', line_total = '$line_total', additional_note = '$additional_note' WHERE invoice_no = '$invoice_no' && product_id = '$product_id' && Id = '$id'";

					$query4 = "Update quotation_items SET is_invoice_generated = '1' WHERE product_id = '$product_id' && quotation_no = '$quotation_no'";
				} else {
					$query3 = "Update invoice_items SET status = '0' WHERE invoice_no = '$invoice_no' && product_id = '$product_id' && Id = '$id'";

					$query4 = "Update quotation_items SET is_invoice_generated = '0' WHERE product_id = '$product_id' && quotation_no = '$quotation_no'";
				}
				$result3 = mysqli_query($connection, $query3);
				$result4 = mysqli_query($connection, $query4);
			}

			if ($result && $result3 && $result4) {
				
				$connection->commit();
				echo $invoice_no."[sprspr]1";
			} else {

				$connection->rollback();
				echo "ERROR";
			}
		} catch (Exception $e) {

			$connection->rollback();
			echo "Transaction rolled back. Error: " . $e->getMessage();
		}
	}


	if (isset($_POST['isPaid']) && $_POST['isPaid'] == "1") {

		$invoice_no = $_POST['id'];
		// Update invoices table
		$connection->begin_transaction();
		try {
			$query = "Update invoices SET is_paid = '1' WHERE invoice_no = '$invoice_no'";
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

	if (isset($_POST['isUnPaid']) && $_POST['isUnPaid'] == "1") {

		$invoice_no = $_POST['id'];
		// Update invoices table
		$connection->begin_transaction();
		try {
			$query = "Update invoices SET is_paid = '0' WHERE invoice_no = '$invoice_no'";
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


	if (isset($_POST['isClosed']) && $_POST['isClosed'] == "1") {
		
		$invoice_no = $_POST['id'];
		// Update invoices table
		$connection->begin_transaction();
		try {
			$query = "Update invoices SET is_closed = '1' WHERE invoice_no = '$invoice_no'";
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

	if (isset($_POST['isReOpen']) && $_POST['isReOpen'] == "1") {
		
		$invoice_no = $_POST['id'];
		// Update invoices table
		$connection->begin_transaction();
		try {
			$query = "Update invoices SET is_closed = '0' WHERE invoice_no = '$invoice_no'";
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