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
		<title>MRA - Invoices</title>
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

			/* Sweet alert custom styling */
			.swal-title {
				margin-top:-25px !important;
			}
			.swal-footer {
				margin-top: 5px !important;
			}

			.export_report {
				background: #FC9C10;
				color: white;
				opacity: 0.98;
				border:none;
			}
			.export_report:hover {
				background: #FC960A;
			}
			.export_report:focus {
				border: inherit !important;
				outline: 0 !important;
				box-shadow: none !important;
				border:1px solid #FC960A !important;
			}
		</style>
	</head>
	<body id="body">
		<?php include_once("includes/navbar.php"); ?>
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="quotation_layout">

					<div id="page_heading" class="row d-flex justify-content-between">
						<div> Open Invoices </div>
						<div id="add_new">
							<?php
								//$file_name = imsCreateFourDigitNumber($demand_no)." - (".$requester_name.")";
							?>
							<!-- <a href="quotations"> <i class="fa fa-plus"></i>&nbsp; New Invoice </a> -->
							<a href="assets/reports/InvoicesReport.xlsx" style="display: none;" id="hidden_download" download> Hidden </a>
							<button class="btn-sm export_report" style="width: 80px;">Export</button>
						</div>
					</div>
					<div id="margin_div"></div>
					<div id="filterContainer" class="row"></div>
					
					<div id="table_layout_updated">
						<table id="InvoicesTable" class="table table-sm table-striped table-hover w-100 table_style"
							style="min-width: 800px;">
							<thead>
								<tr class="text-left">
									<th width="40px"> # </th>
									<th width="100px"> Date </th>
									<th width="100px"> Invoice No </th>
									<th width="100px"> Quotation No </th>
									<th width="200px"> Client </th>
									<th width="150px"> Grand Total </th>
									<th width="40px"> Action </th>
								</tr>
							</thead>
							<tbody>
							<?php
								$count = 1;
								$query = "Select * FROM invoices WHERE status = '1' && is_closed = '0' && is_paid = '0' ORDER By invoice_no DESC";
								$result = mysqli_query($connection, $query);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {

										$invoice_no = $row['invoice_no'];
										$quotation_no = $row['quotation_no'];
										$payment_mode = ucfirst($row['payment_mode']);
										$credit_terms = ucfirst($row['credit_terms']);
										// $reference_no = $row['reference_no'];
										$tax = $row['tax'];
										$discount = $row['discount'];
										$delivery_charges = $row['delivery_charges'];
										$additional_charges = $row['additional_charges'];
										$grand_total = $row['grand_total'];
										$is_closed = $row['is_closed'];
										$is_paid = $row['is_paid'];
										$date = date("d-M-Y", strtotime($row['created_at']));

										$file_name = "assets/invoices/NV_".mraCreateSixDigitNumber($invoice_no).".pdf";

										$client_id = 0;
										$currencyUnit = '';
										$query2 = "Select * FROM quotations WHERE quotation_no = '$quotation_no'";
										$result2 = mysqli_query($connection, $query2);
										if (mysqli_num_rows($result2) > 0) {
											while ($row2 = mysqli_fetch_assoc($result2)) {
												$client_id = $row2['client_id'];
												$currency = $row2['currency'];
												$currencyUnit = mraCurrencyUnit($currency);
											}
										}

										$client_name = '';
										$query3 = "Select * FROM clients WHERE client_id = '$client_id'";
										$result3 = mysqli_query($connection, $query3);
										if (mysqli_num_rows($result3) > 0) {
											while ($row2 = mysqli_fetch_assoc($result3)) {
												$client_name = ucfirst($row2['client_name']);
											}
										}

										$paid_batch = '';
										$closed_batch = '';
										if ($is_paid){
											$paid_batch = '<span style="padding:4px 12px; font-size:11px; "class="badge badge-success"> Paid </span>';
										} else {
											if ($is_closed){
												$closed_batch = '<span style="padding:4px 12px; font-size:11px; "class="badge badge-secondary"> Closed </span>';
											}
										}

										echo '<tr>';

											echo '<td class="d-flex align-text-center">'.$count++.'</td>';
											echo '<td>'.$date.'</td>';
											// echo '<td>'.mraCreateSixDigitNumber($invoice_no).' '.$closed_batch.' </td>';
											echo '<td>';
												echo '<div class="d-flex justify-content-between">';
													echo '<div>'.mraCreateSixDigitNumber($invoice_no).'</div>';
													echo '<div>'.$closed_batch.''.$paid_batch.'</div>';
												echo '</div>';
											echo '</td>';

											echo '<td>'.mraCreateSixDigitNumber($quotation_no).' </td>';
											echo '<td>'.$client_name.'</td>';
											// echo '<td>'.$payment_mode.'</td>';
											// echo '<td>'.$credit_terms.'</td>';
											echo '<td>';
												echo '<div class="d-flex align-items-center">';
													echo '<div style="font-size:12px !important;"><b>'.$currencyUnit.'</b></div>';
													echo '&nbsp;&nbsp;&nbsp;<div>'.number_format($grand_total, 2).'</div>';
												echo '</div>';
											echo '</td>';
											echo '<td class="text-right">';
												echo '<input type="hidden" class="id" value="'.mraCreateSixDigitNumber($invoice_no).'">';
												echo '<div class="btn-group">
													<a class="btn-group-three-dots" data-toggle="dropdown" aria-expanded="false">
														<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
												  	</a>';

													echo '<div class="dropdown-menu dropdown-menu-right">';
													echo '<a class="dropdown-item" data-fancybox data-caption="'.$file_name.'" href="'.$file_name.'">
													   	<i class="fa fa-file-o text-info"></i>&nbsp; Print View
													</a>';
													if (!$is_closed && !$is_paid) {
												  		echo '<a class="dropdown-item closed">
													   	<i class="fa fa-check text-success"></i>&nbsp; Closed
													   </a>';
													   echo '<a class="dropdown-item paid">
													   	<i class="fa fa-check text-success"></i>&nbsp; Paid
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
<script type="text/javascript" src="js/invoices.js?clear_cache=<?php echo time(); ?>"></script>
<script>


	$(".export_report").click(function (e) {

		var confirm_reprint = confirm("Are you sure you want to download report?");
		if (confirm_reprint == true) {

			// setTimeout(download_function, 500);
			// function download_function() {
			// 	window.location = Domain + "/export_prfs_reports.php?excelExport=1";
			// }

			$.ajax({
				url : Domain+"/ajaxcallforreport.php",
				method : "POST",
				// data : $("#invoice_form").serialize(),
				data : {
					getInvoiceReport:1,
				},	
				success : function(response) {
					$(".overlay").hide();
					response = response.trim();
					console.log(response);
				}
			});

			// setTimeout(function() {
		   //    var hidden_download = document.getElementById('hidden_download');
		   //    hidden_download.click();
		   // }, 1000);
		}
	});
</script>
<?php
		} else {
			include_once('unauthorized_page.php');
		}
	} else {
		header('location: login.php');
	}
?>