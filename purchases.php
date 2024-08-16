<?php
	include_once("includes/session.php");
	include_once('database/database.php');

	if ($_SESSION['user_email'] == true) {

		if ($_SESSION['user_role'] == "admin") {
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php") ?>
		<title>MRA - Purchase</title>
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
		<?php include_once("includes/navbar.php"); ?>
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="quotation_layout">

					<div id="page_heading" class="row d-flex justify-content-between">
						<div> Purchases </div>
						<div id="add_new">
							<a href="NewPurchase"> <i class="fa fa-plus"></i>&nbsp; New Purchase </a>
						</div>
					</div>
					<div id="margin_div"></div>
					<div id="filterContainer" class="row"></div>
					
					<div id="table_layout_updated">
						<table id="PurchaseTable" class="table table-sm table-striped table-hover w-100 table_style"
							style="min-width: 800px;">
							<thead>
								<tr class="text-left">
									<th width="40px"> # </th>
									<th width="100px"> Date </th>
									<th width="100px"> Purchase No </th>
									<th width="120px"> Reference No </th>
									<th width="120px"> Payment Mode  </th>
									<th width="120px"> Credit Terms </th>
									<th width="120px"> Grand Total </th>
									<th width="40px"> Action </th>
								</tr>
							</thead>
							<tbody>
							<?php
								$count = 1;
								$query = "Select * FROM purchases WHERE status = '1' ORDER By purchase_no DESC";
								$result = mysqli_query($connection, $query);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {

										$purchase_no = $row['purchase_no'];
										$payment_mode = ucfirst($row['payment_mode']);
										$credit_terms = ucfirst($row['credit_terms']);
										$reference_no = $row['reference_no'];
										$tax = $row['tax'];
										$discount = $row['discount'];
										$delivery_charges = $row['delivery_charges'];
										$additional_charges = $row['additional_charges'];
										$grand_total = $row['grand_total'];
										$currency = $row['currency'];
										$currencyUnit = mraCurrencyUnit($currency);
										$is_closed = $row['is_closed'];
										$date = date("d-M-Y", strtotime($row['created_at']));

										$file_name = "assets/quotations/QT_".mraCreateSixDigitNumber($purchase_no).".pdf";

										$closed_batch = '';
										if ($is_closed){
											$closed_batch = '<span style="padding:4px 12px; font-size:11px; "class="badge badge-secondary"> Closed </span>';
										}

										echo '<tr>';

											echo '<td class="d-flex align-text-center">'.$count++.'</td>';
											echo '<td>'.$date.'</td>';
											echo '<td>';
												echo '<div class="d-flex justify-content-between">';
													echo '<div>'.mraCreateSixDigitNumber($purchase_no).'</div>';
													echo '<div>'.$closed_batch.'</div>';
												echo '</div>';
											echo '</td>';
											echo '<td>'.$reference_no.'</td>';
											echo '<td>'.$payment_mode.'</td>';
											echo '<td>'.$credit_terms.'</td>';
											echo '<td>';
												echo '<div class="d-flex align-items-center">';
													echo '<div style="font-size:12px !important;"><b>'.$currencyUnit.'</b></div>';
													echo '&nbsp;&nbsp;&nbsp;<div>'.number_format($grand_total, 2).'</div>';
												echo '</div>';
											echo '</td>';
											echo '<td class="text-right">';
												echo '<input type="hidden" class="id" value="'.mraCreateSixDigitNumber($purchase_no).'">';
												echo '<div class="btn-group">
													<a class="btn-group-three-dots" data-toggle="dropdown" aria-expanded="false">
														<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
												  	</a>';

													echo '<div class="dropdown-menu dropdown-menu-right">';
												  	if (!$is_closed) {
													   echo '<a class="dropdown-item edit">
													   	<i class="fa fa-edit text-primary"></i>&nbsp; Edit
													   </a>';

                                                       echo '<a class="dropdown-item closed">
													   	<i class="fa fa-check text-success"></i>&nbsp; Closed
													   </a>';
												  	}
												  	if ($is_closed) {
												  		echo '<a class="dropdown-item reopen">
													   	<i class="fa fa-undo text-secondary"></i>&nbsp; Re-open
													   </a>';
												  	}
													echo '</div>';
													
												echo '</div>';
											echo '</td>';

										echo '</tr>';
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
<script type="text/javascript" src="js/purchases.js?clear_cache=<?php echo time(); ?>"></script>
<?php
		} else {
			include_once('unauthorized_page.php');
		}
	} else {
		header('location: login.php');
	}
?>