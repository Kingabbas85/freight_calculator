<?php
	include_once("includes/session.php");
	include_once('database/database.php');

	// Add new item
	if (isset($_POST['action']) && $_POST['action'] == "newProduct") {
		
		$description = $_POST['product_name'];
		$specification = $_POST['specification'];
		$specification = str_replace("'", "&#39;", $specification);
		$specification = str_replace('"', '&#34;', $specification);
		$product_id = $_POST['product_id'];
		$stock = $_POST['stock'];
		$uom = $_POST['uom'];
		$unit_price = $_POST['unit_price'];
		$item_type = $_POST['item_type'];

		$name = str_replace(" ", "", $description);
		$spec = str_replace(" ", "", $specification);
		$product_sku = strtolower($name).strtolower($spec);

		$is_matched = "NO";
		$query = "Select * FROM products ORDER By description, specification ASC";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$db_productname = $row['description'];
				$db_specification = $row['specification'];

				$db_name = str_replace(" ", "", $db_productname);
				$db_spec = str_replace(" ", "", $db_specification);
				$db_productsku = strtolower($db_name).strtolower($db_spec);

				if ($db_productsku == $product_sku) {
					$is_matched = "YES";
					break;
				}
			}
		}
		
		if ($is_matched == "NO") {
			
			// save product
			$connection->begin_transaction();
			try {
				$query = "Insert INTO products (description, specification, product_sku, stock, uom, item_type, price) VALUES ('$description', '$specification', '$product_id', '$stock', '$uom', '$item_type', '$unit_price')";
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
		} else {
			echo "ALREADY_EXISTS";
		}
	}

	// Update existing item
	if (isset($_POST['action']) && $_POST['action'] == "updateProduct") {
		
		$editid = $_POST['editid'];
		$description = $_POST['product_name'];
		$specification = $_POST['specification'];
		$specification = str_replace("'", "&#39;", $specification);
		$specification = str_replace('"', '&#34;', $specification);
		$product_id = $_POST['product_id'];
		$stock = $_POST['stock'];
		$uom = $_POST['uom'];
		$unit_price = $_POST['unit_price'];
		$item_type = $_POST['item_type'];

		$name = str_replace(" ", "", $description);
		$spec = str_replace(" ", "", $specification);
		$product_sku = strtolower($name).strtolower($spec);

		$is_matched = "NO";
		$query = "Select * FROM products WHERE Id <> '$editid' ORDER By description, specification ASC";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$db_productname = $row['description'];
				$db_specification = $row['specification'];

				$db_name = str_replace(" ", "", $db_productname);
				$db_spec = str_replace(" ", "", $db_specification);
				$db_productsku = strtolower($db_name).strtolower($db_spec);

				if ($db_productsku == $product_sku) {
					$is_matched = "YES";
					break;
				}
			}
		}

		if ($is_matched == "NO") {
			
			// save product
			$connection->begin_transaction();
			try {
				$query = "Update products SET description = '$description', specification = '$specification', stock = '$stock', uom = '$uom', price = '$unit_price', item_type = '$item_type' WHERE Id = '$editid'";
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
		} else {
			echo "ALREADY_EXISTS";
		}
	}
?>