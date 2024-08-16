<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	if($_SESSION['user_email'] == true) {
		
		if ($_SESSION['user_role'] == "admin") {
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>IMS - Client</title>
		<style>
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
			.edit:hover, .delete:hover, .print:hover {
				cursor: pointer;
			}
			.btn-group-three-dots {
				border: 1px solid transparent;
				color: #14213D;
				padding:0px 10px;
				font-size:18px;
			}
			.btn-group-three-dots:hover {
				cursor: pointer;
				border: 1px solid #EBF5FB;
				background: #F0F3F4;
			}
			.dropdown-item:hover {
				cursor: pointer !important;
				background: #ECF0F1;
			}
		</style>
	</head>
	<body id="body">
		<div class="overlay"><div class="loader"></div></div>

		<?php include_once('includes/navbar.php'); ?>
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout" style="">
				<div id="vendor_layout">
					
					<div id="page_heading" class="row d-flex justify-content-between">
						<div> Clients </div>
						<div id="add_new">
							<a href="NewClient"> <i class="fa fa-plus"></i>&nbsp; New Client </a>
						</div>
					</div>
					<div id="margin_div"></div>

					<div id="table_layout_updated">
						<table id="clientsTable" class="table table-sm table-striped table-hover w-100 table_style" style="min-width: 900px;">
							<thead>
								<tr class="text-left">
									<th width="40px">#</th>
									<th width="80px">ClientID</th>
									<th width="140px">Client Name</th>
									<th width="140px">Company Name</th>
									<th width="120px">Contact No</th>
									<th width="140px">Address</th>
									<th width="120px">City / Country</th>
									<th width="60px">Active</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$count = 1;
								$query = "Select * FROM clients ORDER By client_name, contact_name ASC";
								$result = mysqli_query($connection, $query);
								if(mysqli_num_rows($result)) {
									while($row = mysqli_fetch_assoc($result)) {
										
										$id = $row['Id'];
										$client_id = $row['client_id'];
										$client_name = $row['client_name'];
										$contact_no = $row['contact_no'];
										$address = $row['address'];
										$zip_code = $row['zip_code'];
										$city = $row['city'];
										$country = $row['country'];
										$active = $row['active'];

										$client_address = "";
										if ($address != "" && $zip_code != "") {
											$client_address = ucwords($address).", ".ucwords($zip_code);
										} elseif ($address != "" && $zip_code == "") {
											$client_address = ucwords($address);
										} elseif ($address == "" && $zip_code != "") {
											$client_address = ucwords($zip_code);
										}

										$client_city = "";
										if ($city != "" && $country != "") {
											$client_city = ucwords($city).", ".ucwords($country);
										} elseif ($city != "" && $country == "") {
											$client_city = ucwords($city);
										} elseif ($city == "" && $country != "") {
											$client_city = ucwords($country);
										}

										$checked = "";
										if ($active) {
											$checked = "checked";
										}
							?>
										<tr>
											<td> <?php echo $count++; ?> </td>
											<td>
												<input type="hidden" class="edit_id" value="<?php echo md5($id); ?>">
												<a href="javascript:void(0)" class="edit" title="edit">
													<?php echo "CL-".mraCreateSixDigitNumber($client_id); ?>
												</a>
											</td>
											<td> <?php echo $client_name; ?> </td>
											<td>  </td>
											<td> <?php echo $contact_no; ?> </td>
											<td> <?php echo $client_address; ?> </td>
											<td> <?php echo $client_city; ?> </td>
											<!-- <td class="text-center" width="60px">
												<input type="hidden" class="edit_id" value="<?php echo md5($id); ?>">
												<a href="javascript:void(0)" class="fa fa-edit edit" title="edit"></a>
											</td> -->
											<td class="text-center">
												<input type="checkbox" name="" disabled <?php echo $checked; ?>>
											</td>
										</tr>
							<?php
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/clients.js?clear_cache=<?php echo time();?>"></script>
<script type="text/javascript">
	document.getElementById("clientsTable").style.borderBottom = "1px solid #D0D3D4";
</script>
<?php
		} else {
			include_once('unauthorized_page.php');
		}
	} else {
		header('location: login.php');
	}
?>