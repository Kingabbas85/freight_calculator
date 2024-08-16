<?php
	include_once("includes/session.php");
	include_once('database/database.php'); 
	
	if (isset($_POST['action']) && $_POST['action'] == "newClient") {
		
		$client_name = $_POST['client_name'];
		$contact_name = $_POST['contact_name'];
		$contact_no = $_POST['contact_no'];
		$contact_email = $_POST['email'];
		$phone_no = $_POST['phone_no'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$country = $_POST['country'];
		$active = $_POST['active'];
	
		$query = "Select * FROM counter WHERE Id = '5'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result) > 0) {	
			while ($row = mysqli_fetch_assoc($result)) {
				$client_id = $row['count'];
			}
		}
		$client_id = $client_id + 1;
		$update_count = "Update counter SET count = '$client_id' WHERE Id = '5'";
		mysqli_query($connection, $update_count);
	
		$connection->begin_transaction();
		try {
			$query2 = "Insert INTO clients (client_id, client_name, contact_name, contact_no, contact_email,phone, address, city, country, active) VALUES('$client_id', '$client_name', '$contact_name', '$contact_no', '$contact_email','$phone_no', '$address', '$city', '$country', $active)";
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
	}


	if (isset($_POST['action']) && $_POST['action'] == "updateClient") {

		$id = $_POST['edit_id'];
		$client_name = $_POST['client_name'];
		$contact_name = $_POST['contact_name'];
		$contact_no = $_POST['contact_no'];
		$contact_email = $_POST['email'];
		$phone_no = $_POST['phone_no'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$country = $_POST['country'];
		$active = $_POST['active'];

		$connection->begin_transaction();
		try {
			$query = "Update clients SET client_name = '$client_name', contact_name = '$contact_name', contact_no = '$contact_no', contact_email = '$contact_email', phone = '$phone_no', address = '$address', city = '$city', country = '$country', active = '$active' WHERE Id = '$id'";
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