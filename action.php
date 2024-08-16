<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	if($_SESSION['user_email'] == true) {

		// // Demand Delete
		// if(isset($_POST['demand_delete_btn'])) {
			
		// 	$deleteid = $_POST['deleteid'];
		// 	$query = "Update `demands` SET status = 'deleted' WHERE Id = '$deleteid'";
		// 	$result = mysqli_query($connection, $query);

		// 	$query2 = "Select * from demands where Id = '$deleteid'";
		// 	$result2 = mysqli_query($connection, $query2);
		// 	if(mysqli_num_rows($result2)) {
		// 		while ($row2 = mysqli_fetch_assoc($result2)) {
		// 			$demand_no = $row2['demand_no'];
		// 		}
		// 	}

		// 	$query2 = "Update `demand_products` SET status = 'deleted' WHERE demand_no = '$demand_no'";
		// 	$result2 = mysqli_query($connection, $query2);

		// 	if ($result && $result2) {
		// 		echo 1;
		// 	}
		// 	// $demand_no = 0;
		// 	// $quotation_no = 0;

		// 	// $query = "Select * from demands where Id = '$deleteid'";
		// 	// $result = mysqli_query($connection, $query);
		// 	// if(mysqli_num_rows($result)) {
		// 	// 	while ($row = mysqli_fetch_assoc($result)) {
		// 	// 		$demand_no = $row['demand_no'];
		// 	// 	}
		// 	// }

		// 	// $query5 = "Select * from quotations where demand_no = '$demand_no'";
		// 	// $result5 = mysqli_query($connection, $query5);
		// 	// if(mysqli_num_rows($result5)) {
		// 	// 	while ($row = mysqli_fetch_assoc($result5)) {
		// 	// 		$quotation_no = $row['quotation_no'];

		// 	// 		$query6 = "Delete from quotation_demands where quotation_no='$quotation_no'";
		// 	// 		$result6 = mysqli_query($connection, $query6);	
		// 	// 	}
		// 	// }

		// 	// $query4 = "Delete from quotations where demand_no = '$demand_no'";
		// 	// $result4 = mysqli_query($connection, $query4);


		// 	// $query3 = "Delete from demand_products where demand_no = '$demand_no'";
		// 	// $result3 = mysqli_query($connection, $query3);


		// 	// $query2 = "Delete from demands where Id = '$deleteid'";
		// 	// $result2 = mysqli_query($connection, $query2);	
			
		// 	// if($result5 && $result4 && $result3 && $result2) {
		// 	// 	echo "Deleted";
		// 	// } else {
		// 	// 	echo "something went wrong";
		// 	// }
		// }


		// Delete quotation
		if(isset($_POST['quotation_delete_btn'])) {

			$deleteid = $_POST['deleteid'];

			$query = "Update quotations SET status = '0' WHERE quotation_no = '$deleteid'";
			$result = mysqli_query($connection, $query);	

			$query2 = "Update quotation_items SET status = '0' WHERE quotation_no = '$deleteid'";
			$result2 = mysqli_query($connection, $query2);	
			
			if($result && $result2) {		
				echo 1;
			} else {
				echo "ERROR";
			}
		}


		// PO Delete
		if(isset($_POST['po_delete_btn'])) {
			$prf_no = 0;
			$demand_no = 0;
			$deleteid = $_POST['deleteid'];
			// echo $deleteid;

			$query = "Select * from prfs where Id = $deleteid";
			$result = mysqli_query($connection, $query);
			if(mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$prf_no = $row['prf_no'];
					$demand_no = $row['demand_no'];
				}
			}
			
			$query2 = "Update prfs SET status = 'deleted' WHERE Id = '$deleteid' ";
			$result2 = mysqli_query($connection, $query2);

			$query3 = "Update prf_quotations SET status = 'deleted' WHERE prf_no = '$prf_no'";
			$result3 = mysqli_query($connection, $query3);

			$quotation_no = 0;
			$query4 = "Select * from prf_quotations WHERE prf_no = $prf_no";
			$result4 = mysqli_query($connection, $query4);
			if(mysqli_num_rows($result4) > 0) {
				while ($row4 = mysqli_fetch_assoc($result4)) {
					$quotation_no = $row4['quotation_no'];
					$pro_id = $row4['pro_id'];
					$product_id = $row4['product_id'];

					// Update quotation's items status
					$query5 = "Update quotation_demands SET status = '' WHERE quotation_no = '$quotation_no' && pro_id = '$pro_id' && product_id = '$product_id' ";
					$result5 = mysqli_query($connection, $query5);

					// Update demand's items status
					$query6 = "Update demand_products SET status = 'Waiting for PO', is_po = '' WHERE demand_no = '$demand_no' && Id = '$pro_id' && product_id = '$product_id' ";
					$result6 = mysqli_query($connection, $query6);
				}
			}

			$query7 = "Update quotations SET status = 'Waiting for PO' WHERE quotation_no = '$quotation_no' ";
			$result7 = mysqli_query($connection, $query7);

			if($result2 && $result3) {
				echo 1;
			} else {
				echo "ERROR";
			}
		}

		// PRF Delete
		if(isset($_POST['prf_delete_btn'])) {
			
			$deleteid = $_POST['deleteid'];
			$query = "Update prf_items SET received_qty = '0', status = '0' WHERE prf_no = '$deleteid' ";
			// $query = "Delete from prf_items where prf_no = '$deleteid'";
			$result = mysqli_query($connection, $query);

			if($result) {
				echo 1;
			} else {
				echo "ERROR";
			}
		}

		// Admin PRF
		if(isset($_POST['admin_prf_delete_btn'])) {
			
			$deleteid = $_POST['deleteid'];
			// $query = "Update admin_prfs SET status = '2' WHERE prf_no = '$deleteid' ";
			$query = "Delete from admin_prfs where prf_no = '$deleteid'";
			$result = mysqli_query($connection, $query);

			$query2 = "Delete from admin_prfs_items where prf_no = '$deleteid'";
			$result2 = mysqli_query($connection, $query2);

			if($result && $result2) {
				echo 1;
			} else {
				echo "ERROR";
			}
		}

		// Vendor Delete
		if(isset($_POST['vendor_delete_btn'])) {
			
			$deleteid = $_POST['deleteid'];
			echo $deleteid;
			$query = "Delete from vendors where Id = '$deleteid'";
			$result = mysqli_query($connection, $query);
			if ($result) {
				echo 1;
			} else {
				echo "ERROR";
			}
		}

	} else {
		header('location: login.php');
	}
?>