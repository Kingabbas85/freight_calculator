<?php
	include_once("includes/session.php");
	include_once('database/database.php'); 
	
	if (isset($_POST['action']) && $_POST['action'] == "newVendor") {
		
		$vendor_name = $_POST['vendor_name'];
		$ntn_number = $_POST['ntn_number'];
		$contact_name = $_POST['contact_name'];
		$contact_no = $_POST['contact_no'];
		$contact_email = $_POST['email'];
		$phone_no = $_POST['phone_no'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$zip_code =$_POST['zip_code'];
		$country = $_POST['country'];
		$active = $_POST['active'];
	
		$query = "Select * FROM counter where Id = '4'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result) > 0) {	
			while ($row = mysqli_fetch_assoc($result)) {
				$vendor_id = $row['count'];
			}
		}
		$vendor_id = $vendor_id + 1;
		$update_count = "Update counter SET count = '$vendor_id' WHERE Id = '4'";
		mysqli_query($connection, $update_count);

		$is_matched = "NO";
		$query = "Select * FROM vendors ORDER By vendor_name ASC";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				
				$db_vendorname = $row['vendor_name'];
				$db_vendorname = str_replace(" ", "", $db_vendorname);
				$vendor_name_for_matching = str_replace(" ", "", $vendor_name);

				if (strtolower($db_vendorname) == strtolower($vendor_name_for_matching)) {
					$is_matched = "YES";
					break;
				}
			}
		}

		if ($is_matched == "NO") {

			$connection->begin_transaction();
			try {
				$query2 = "Insert INTO vendors (vendor_id, vendor_name, ntn_number, contact_name, contact_no, contact_email,phone, address, city, zip_code, country, active) VALUES('$vendor_id', '$vendor_name', '$ntn_number', '$contact_name', '$contact_no', '$contact_email','$phone_no', '$address', '$city', '$zip_code', '$country', $active)";
				$result2 = mysqli_query($connection, $query2);
				if ($result2) {
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


	if (isset($_POST['action']) && $_POST['action'] == "updateVendor") {

		$id = $_POST['edit_vendor_id'];
		$vendor_name = $_POST['vendor_name'];
		$ntn_number = $_POST['ntn_number'];
		$contact_name = $_POST['contact_name'];
		$contact_no = $_POST['contact_no'];
		$contact_email = $_POST['email'];
		$phone_no = $_POST['phone_no'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$zip_code =$_POST['zip_code'];
		$country = $_POST['country'];
		$active = $_POST['active'];

		$is_matched = "NO";
		$query = "Select * FROM vendors WHERE Id <> '$id' ORDER By vendor_name ASC";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				
				$db_vendorname = $row['vendor_name'];
				$db_vendorname = str_replace(" ", "", $db_vendorname);
				$vendor_name_for_matching = str_replace(" ", "", $vendor_name);

				if (strtolower($db_vendorname) == strtolower($vendor_name_for_matching)) {
					$is_matched = "YES";
					break;
				}
			}
		}

		if ($is_matched == "NO") {
			
			$connection->begin_transaction();
			try {
				$query2 = "Update vendors SET vendor_name = '$vendor_name', ntn_number = '$ntn_number', contact_name = '$contact_name', contact_no = '$contact_no', contact_email = '$contact_email', phone = '$phone_no', address = '$address', city = '$city', zip_code = '$zip_code', country = '$country', active = '$active' WHERE Id = '$id'";
				$result2 = mysqli_query($connection, $query2);
				if ($result2) {
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