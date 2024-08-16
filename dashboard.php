<?php
	include_once("includes/session.php");
	include_once("database/database.php");
	if($_SESSION['user_email'] == true) {	
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once('includes/header.php'); ?>
		<title>MRA - Dashboard</title>
		<link rel="stylesheet" type="text/css" href="css/style_dashboard.css">
		
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script>



		<style type="text/css">
			.top_container .data {
				padding: 15px 0px;
				border-radius: 15px;
				border: 1px solid rgb(235, 235, 235);
				border-bottom: 1px solid rgb(230, 230, 230);
				/* box-shadow: rgba(150, 150, 150, 0.2) 1px 1px 20px 1px; */
				box-shadow: 0px 0px 10px 0px #CACFD2;
			}
			.bottom_container .data {
				padding: 15px;
				border-radius: 15px;
				border: 1px solid rgb(235, 235, 235);
				border-bottom: 1px solid rgb(230, 230, 230);
				/* box-shadow: rgba(150, 150, 150, 0.2) 1px 1px 20px 1px; */
				box-shadow: 0px 0px 10px 0px #CACFD2;

				position: relative;
			}
			.top_container .data:hover {
				cursor: pointer !important;
				border: 1px solid #dcdcdc !important;
			}

			.top_container .data .heading, .bottom_container .data .heading {
				/* font-size:24px; */
				/* font-weight:600; */
				font-size: 1.4vw;
			}
			.top_container .data .number, .bottom_container .data .number {
/*				font-size:38px;*/
				font-size: 2.5vw;
				font-weight:600;
				display: flex;
				align-items: center;
				justify-content: center;
			}
			.top_container .data .number .label, .bottom_container .data .number .label {
/*				font-size:34px;*/
				font-size: 2vw;
				font-weight:600;
			}



			.custom_arrows {
				position: absolute;
				top:15px;
				right:18px;
				font-size:21px;
			}
			.custom_arrows .left_icon, .custom_arrows .right_icon {
				border:1px solid #FC960A;
				padding:8px 4px 4px 4px;
				border-radius: 4px;
				color:#14213D;
			}
			.custom_arrows .left_icon {
				padding-right:6px;
			}
			.custom_arrows .right_icon {
				padding-left:6px;
			}

			.custom_arrows .left_icon:hover, .custom_arrows .right_icon:hover {
				background: #14213D;
				border:1px solid #14213D;
				color: #FFFFFF;
				cursor: pointer;
			}


			.disabled {
				border: 1px solid #B3B6B7 !important;
				color: #7B7D7D !important;
			}


			.daterangepicker .drp-buttons .btn {
				width:60px !important;
			}


			/* .selectpicker {
				border: 1px solid red !important;
			} */

			.bootstrap-select.form-control-sm .dropdown-toggle {
				border: 1px solid #D0D3D4 !important;
			}


			#close_custom_date {
				font-size:14px !important;
				font-weight:700 !important;
				padding-top:3px !important;
			}


			.table-condensed .active {
				background-color: #14213D !important;
				border-radius: 20px !important;
				width: 26px !important;
				height: 26px !important;
			}

			.table-condensed .ends {
				background-color: #FFFFFF !important;
			}

			.table-condensed .disabled {
				border:1px solid #FFFFFF !important;
			}

			.applyBtn {
				background-color: #FC960A !important;
				border:none !important;
			}


			@media screen and (max-width: 1350px) {
				.top_container .col-md-6 .data .heading, .bottom_container .data .heading {
					font-size: 1.5vw;
				}
			}
			@media screen and (max-width: 1198px) {
				.top_container .col-md-6 .data .heading, .bottom_container .data .heading {
					font-size: 2vw;
				}
			}
			@media screen and (max-width: 768px) {
				.top_container .data .number, .bottom_container .data .number {
					font-size: 3.5vw;
				}
				.top_container .data .number .label, .bottom_container .data .number .label {
					font-size: 3vw;
				}
				.top_container .col-md-6 .data .heading, .bottom_container .data .heading {
					font-size: 2.5vw;
				}
			}
			@media screen and (max-width: 550px) {
				.top_container .col-md-6 .data .heading, .bottom_container .data .heading {
					font-size: 3.2vw;
				}
			}
		</style>
	</head>
	<body id="body">
		<?php
			include_once('includes/navbar.php');
		?>
		<div id="outer_layout">
			<div id="inner_layout">
				<div id="dashboard_layout">
					
					<div id="page_heading" class="row">
						Dashboard
					</div>
					<div id="margin_div"></div>
					<!-- <div id="margin_div"></div> -->
					<!-- <div id="margin_div"></div> -->

					<div class="filters">
						<div class="row">
							<div class="col-md-3 mt-1 no_of_days_container">
								<strong> No of Days: </strong>
								<input type="hidden" name="selected_days" id="selected_days" class="selected_days" value="0">
								<select class="form-control form-control-sm no_of_days selectpicker" onchange="getDashboardData();">
									<option value="0" selected>All</option>
									<option value="15">Last 15 Days</option>
									<option value="30">Last 30 Days</option>
									<option value="60">Last 60 Days</option>
									<option value="90">Last 90 Days</option>
									<option value="custom">Custom</option>
								</select>
							</div>
							<div class="col-md-3 mt-1 daterange_container">
								<div class="d-flex justify-content-between">
									<div> <strong> Date: </strong> </div>
									<div id="close_custom_date"> X </div>
								</div>
								<input type="text" id="daterange" name="daterange" onchange="getDashboardData();" class="form-control form-control-sm daterange" />
							</div>
							<div class="col-md-3 mt-1">
								<span class="font-weight-light">
									<strong> Vendors: </strong>
								</span>
								<select class="form-control form-control-sm vendor_id selectpicker" id="vendor_id" name="vendor_id[]" multiple data-selected-text-format="count > 2" onchange="getDashboardData();" data-actions-box="true">
									<?php
										$query = "Select * FROM vendors ORDER By vendor_name ASC";
										$result = mysqli_query($connection, $query);
										if(mysqli_num_rows($result)) {
											while($row = mysqli_fetch_assoc($result)){
												$vendor_id = $row['vendor_id'];
												$vendor_name = ucfirst($row['vendor_name']);

												$selected = '';
												if ($dbvendor_id == $vendor_id) {
													$selected = 'selected';
												}
												echo '<option value="'.$vendor_id.'" '.$selected.'>'.$vendor_name.'</option>';
											}
										}
									?>
								</select>
							</div>
							<div class="col-md-3 mt-1">
								<span class="font-weight-light">
									<strong> Clients:<i class="text-danger">*</i> </strong>
								</span>
								<select class="form-control form-control-sm client_id selectpicker" id="client_id" name="client_id[]" multiple data-selected-text-format="count > 2" onchange="getDashboardData();" data-actions-box="true">
									<?php
										$query = "Select * FROM clients ORDER By client_name ASC";
										$result = mysqli_query($connection, $query);
										if(mysqli_num_rows($result)) {
											while($row = mysqli_fetch_assoc($result)){
												$client_id = $row['client_id'];
												$client_name = ucfirst($row['client_name']);

												$selected = '';
												if ($dbclient_id == $client_id) {
													$selected = 'selected';
												}
												echo '<option value="'.$client_id.'" '.$selected.'>'.$client_name.'</option>';
											}
										}
									?>
								</select>

								</select>
							</div>
						</div>
					</div>


					<div class="row top_container">
						<div class="col-md-3" style="border: 1px solid transparent; padding-right: 13px;" onclick="window.location='OpenPurchases';">
							<div class="text-center data mt-4"> 
								<div class="heading"> To Pay </div>
								<div class="number mt-3 to_pay"> <span class="label">PKR</span>&nbsp;&nbsp; <span class="amount">0.00</span> </div>
							</div>
						</div>
						<div class="col-md-3" style="border: 1px solid transparent; padding-left: 13px;" onclick="window.location='OpenInvoices';">
							<div class="text-center data mt-4"> 
								<div class="heading"> Paid </div>
								<div class="number mt-3 paid"> <span class="label">PKR</span>&nbsp;&nbsp; <span class="amount">0.00</span> </div>
							</div>
						</div>
						<div class="col-md-3" style="border: 1px solid transparent; padding-left: 13px;" onclick="window.location='OpenInvoices';">
							<div class="text-center data mt-4"> 
								<div class="heading"> To Receive </div>
								<div class="number mt-3 to_receive"> <span class="label">PKR</span>&nbsp;&nbsp; <span class="amount">0.00</span> </div>
							</div>
						</div>
						<div class="col-md-3" style="border: 1px solid transparent; padding-left: 13px;" onclick="window.location='OpenInvoices';">
							<div class="text-center data mt-4"> 
								<div class="heading"> Received </div>
								<div class="number mt-3 received"> <span class="label">PKR</span>&nbsp;&nbsp; <span class="amount">0.00</span> </div>
							</div>
						</div>
					</div>

					<div class="row bottom_container">
						<div class="col-lg-6 vendors_breakdown" style="border: 1px solid transparent; padding-right: 13px;">
							<div class="text-center data mt-4">
								<div class="heading"> Vendor's Breakdown </div>
								<div class="number mt-3"> <canvas id="VendorChart"></canvas> </div>
								<div class="custom_arrows">
									<span> <i class="fa fa-chevron-left left_icon"></i> </span>
									<span> <i class="fa fa-chevron-right right_icon"></i> </span>
								</div>
							</div>
						</div>
						<div class="col-lg-6 clients_breakdown" style="border: 1px solid transparent; padding-left: 13px;">
							<div class="text-center data mt-4">
								<div class="heading"> Client's Breakdown </div>
								<div class="number mt-3"> <canvas id="ClientChart"></canvas> </div>
								<div class="custom_arrows">
									<span> <i class="fa fa-chevron-left left_icon"></i> </span>
									<span> <i class="fa fa-chevron-right right_icon"></i> </span>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript">
  	
	// const ctx = document.getElementById('myChart');
    // new Chart(ctx, {
    //     type: 'bar',
    //     showTooltips: false,
    //     data: {
    //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    //         datasets: [{
    //             label: '',
    //             data: [21, 53, 3, 5, 1, 3],
    //             backgroundColor: [
    //                 '#14213D',
    //             ],
	// 			datalabels: {
	// 				color: '#14213D',
	// 				anchor: 'end',
	// 				align: 'top',
	// 				offset: -4,
	// 				font: {
    //                     size: 14 // Set font size here
    //                 }
	// 			},
    //         }]
    //     },
	// 	plugins: [ChartDataLabels],
    //     options: {
    //         plugins: {
    //             legend: {
    //                 display: false,
    //             },
    //         },
    //         scales: {
    //             x: {
    //                 grid: {
    //                     drawOnChartArea: false,
    //                 }
    //             },
    //         }
    //     }
    // });


	
	
	// Vendors chart setup
	var data = {
		labels: [],
		datasets: [{
			label: "",
			data: [],
			backgroundColor: ['#14213D'],
			datalabels: {
				formatter: (value, context) => {
                    return new Intl.NumberFormat().format(value);
                },
				color: '#14213D',
				anchor: 'end',
				align: 'top',
				offset: -4,
				font: {
					size: 14 // Set font size here
				}
			},
		}]
	}
	// Vendors chart config
	const config = {
		type: 'bar',
		data,
		options: {
			scales: {
                x: {
					min: 0,
					max: 3,
                    grid: {
                        drawOnChartArea: false,
                    }
                },
				y: {
					beginAtZero: true,
				}
            },
			plugins: {
				tooltip: {
					yAlign: 'bottom',
					displayColors: false,
					backgroundColor: '#FC960A',
					titleMarginBottom: 0,
					callbacks: {
						
					},
				},

                legend: {
                    display: false,
                },
			}
		},
		plugins: [ChartDataLabels],
	}
	// Render vendors chart
	const vendor_chart = new Chart(
		document.getElementById('VendorChart'),
		config
	);


	// Pagination chart buttons
	$(".vendors_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
	$(".vendors_breakdown .custom_arrows .left_icon").addClass('disabled');
	setTimeout(function() {
		var data_length = vendor_chart.data.labels.length;
		var max = vendor_chart.config.options.scales.x.max;
		if (max+1 >= data_length) {
			$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
			$(".vendors_breakdown .custom_arrows .right_icon").addClass('disabled');
		}
	}, 100);

	$(".vendors_breakdown .custom_arrows .left_icon").click(function(){
		
		var min = vendor_chart.config.options.scales.x.min;
		var max = vendor_chart.config.options.scales.x.max;
		var data_length = vendor_chart.data.labels.length;

		min = vendor_chart.config.options.scales.x.min -= 1;
		max = vendor_chart.config.options.scales.x.max -= 1;
		vendor_chart.update();

		if (min == 0) {
			$(".vendors_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
			$(".vendors_breakdown .custom_arrows .left_icon").addClass('disabled');
		}
		if (max < (data_length-1)) {
			$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'auto');
			$(".vendors_breakdown .custom_arrows .right_icon").removeClass('disabled');
		}
	});
	$(".vendors_breakdown .custom_arrows .right_icon").click(function(){
		
		var min = vendor_chart.config.options.scales.x.min;
		var max = vendor_chart.config.options.scales.x.max;
		var data_length = vendor_chart.data.labels.length;

		min = vendor_chart.config.options.scales.x.min += 1;
		max = vendor_chart.config.options.scales.x.max += 1;
		vendor_chart.update();

		if (min > 0) {
			$(".vendors_breakdown .custom_arrows .left_icon").css('pointer-events', 'auto');
			$(".vendors_breakdown .custom_arrows .left_icon").removeClass('disabled');
		}
		if (max >= (data_length-1)) {
			$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
			$(".vendors_breakdown .custom_arrows .right_icon").addClass('disabled');
		}
	});


	// Clients chart setup
	var data = {
		labels: [],
		datasets: [{
			label: "",
			data: [],
			backgroundColor: ['#14213D'],
			datalabels: {
				formatter: (value, context) => {
                    return new Intl.NumberFormat().format(value);
                },
				color: '#14213D',
				anchor: 'end',
				align: 'top',
				offset: -4,
				font: {
					size: 14 // Set font size here
				}
			},
		}]
	}
	// Clients chart config
	const client_config = {
		type: 'bar',
		data,
		options: {
			scales: {
                x: {
					min: 0,
					max: 3,
                    grid: {
                        drawOnChartArea: false,
                    }
                },
				y: {
					beginAtZero: true,
				}
            },
			plugins: {
				tooltip: {
					yAlign: 'bottom',
					displayColors: false,
					backgroundColor: '#FC960A',
					titleMarginBottom: 0,
					callbacks: {
						
					},
				},

                legend: {
                    display: false,
                },
			}
		},
		plugins: [ChartDataLabels],
	}
	// Render clients chart
	const client_chart = new Chart(
		document.getElementById('ClientChart'),
		client_config
	);


	// Pagination chart buttons
	$(".clients_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
	$(".clients_breakdown .custom_arrows .left_icon").addClass('disabled');
	setTimeout(function() {
		var data_length = client_chart.data.labels.length;
		var max = client_chart.config.options.scales.x.max;
		if (max+1 >= data_length) {
			$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
			$(".clients_breakdown .custom_arrows .right_icon").addClass('disabled');
		}
	}, 100);

	$(".clients_breakdown .custom_arrows .left_icon").click(function(){
		
		var min = client_chart.config.options.scales.x.min;
		var max = client_chart.config.options.scales.x.max;
		var data_length = client_chart.data.labels.length;

		min = client_chart.config.options.scales.x.min -= 1;
		max = client_chart.config.options.scales.x.max -= 1;
		client_chart.update();

		if (min == 0) {
			$(".clients_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
			$(".clients_breakdown .custom_arrows .left_icon").addClass('disabled');
		}
		if (max < (data_length-1)) {
			$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'auto');
			$(".clients_breakdown .custom_arrows .right_icon").removeClass('disabled');
		}
	});
	$(".clients_breakdown .custom_arrows .right_icon").click(function(){
		
		var min = client_chart.config.options.scales.x.min;
		var max = client_chart.config.options.scales.x.max;
		var data_length = client_chart.data.labels.length;

		min = client_chart.config.options.scales.x.min += 1;
		max = client_chart.config.options.scales.x.max += 1;
		client_chart.update();

		if (min > 0) {
			$(".clients_breakdown .custom_arrows .left_icon").css('pointer-events', 'auto');
			$(".clients_breakdown .custom_arrows .left_icon").removeClass('disabled');
		}
		if (max >= (data_length-1)) {
			$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
			$(".clients_breakdown .custom_arrows .right_icon").addClass('disabled');
		}
	});


	function getDashboardData() {

		var start_date = '';
		var end_date = '';
		setTimeout(function() {
			var selected_days = $(".selected_days").val();
			var dates = imsGetSqlDateFormat( selected_days );
			start_date = dates.start_date;
			end_date = dates.end_date;
			
			var vendor_ids = [];
			$('#vendor_id option').each(function(i) {
				if (this.selected == true) {
					vendor_ids.push(this.value);
				}
			});
			// console.log(vendor_ids);
	
			var client_ids = [];
			$('#client_id option').each(function(i) {
				if (this.selected == true) {
					client_ids.push(this.value);
				}
			});
			// console.log(client_ids);
	
			$.ajax({
				type: "POST",
				url: "ajaxcallfordashboard.php",
				data: {
					"getDashboardData": 1,
					selected_days: selected_days,
					start_date: start_date,
					end_date: end_date,
					vendor_ids: vendor_ids,
					client_ids: client_ids,
				},
				success: function (response) {
					response = response.trim();
					// console.log(response);

					const json_data = JSON.parse(response);
					
					var to_pay = json_data.to_pay;
					var to_receive = json_data.to_receive;
					$(".to_pay").html('<span class="label">PKR</span>&nbsp;&nbsp;&nbsp;&nbsp; <span class="amount">'+to_pay+'</span>');
					$(".to_receive").html('<span class="label">PKR</span>&nbsp;&nbsp;&nbsp;&nbsp; <span class="amount">'+to_receive+'</span>');

					vendor_chart.config.options.scales.x.min = 0;
					vendor_chart.config.options.scales.x.max = 2;
					vendor_chart.data.labels = [];
					vendor_chart.data.datasets[0].data = [];
					const vendorsBreakdown = json_data.vendors_breakdown;
					for (const vendor_name in vendorsBreakdown) {
						if (vendorsBreakdown.hasOwnProperty(vendor_name)) {
							const amount = vendorsBreakdown[vendor_name];
							// console.log(`Vendor: ${vendor_name}, Amount: ${amount}`);

							vendor_chart.data.labels.push(vendor_name);
							vendor_chart.data.datasets[0].data.push(amount);
						}
					}
					vendor_chart.update();
					// console.log(vendor_chart.config.options.scales.x.max);
					// console.log(vendor_chart.data.datasets[0].data.length);
					if ((vendor_chart.config.options.scales.x.max+1) >= vendor_chart.data.datasets[0].data.length) {
						$(".vendors_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
						$(".vendors_breakdown .custom_arrows .left_icon").addClass('disabled');

						$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
						$(".vendors_breakdown .custom_arrows .right_icon").addClass('disabled');
					} else {
						$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'auto');
						$(".vendors_breakdown .custom_arrows .right_icon").removeClass('disabled');
					}


					client_chart.config.options.scales.x.min = 0;
					client_chart.config.options.scales.x.max = 2;
					client_chart.data.labels = [];
					client_chart.data.datasets[0].data = [];
					const clientsBreakdown = json_data.clients_breakdown;
					for (const client_name in clientsBreakdown) {
						if (clientsBreakdown.hasOwnProperty(client_name)) {
							const amount = clientsBreakdown[client_name];
							// console.log(`Vendor: ${client_name}, Amount: ${amount}`);

							client_chart.data.labels.push(client_name);
							client_chart.data.datasets[0].data.push(amount);
						}
					}
					client_chart.update();
					// console.log(client_chart.config.options.scales.x.max);
					// console.log(client_chart.data.datasets[0].data.length);
					if ((client_chart.config.options.scales.x.max+1) >= client_chart.data.datasets[0].data.length) {
						$(".clients_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
						$(".clients_breakdown .custom_arrows .left_icon").addClass('disabled');

						$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
						$(".clients_breakdown .custom_arrows .right_icon").addClass('disabled');
					} else {
						$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'auto');
						$(".clients_breakdown .custom_arrows .right_icon").removeClass('disabled');
					}
				}
			});

		}, 0);
	}

	

















	// // Clients Chart
	// const titleChart2 = "Client's Chart";
	// const labelChart2 = "Label Chart";
	
	// // config
	// var data = {
	// 	labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
	// 	datasets: [{
	// 		label: titleChart2,
	// 		data: [21, 19, 17, 11, 9, 4],
	// 		backgroundColor: ['#14213D'],
	// 		datalabels: {
	// 			color: '#14213D',
	// 			anchor: 'end',
	// 			align: 'top',
	// 			offset: -4,
	// 			font: {
	// 				size: 14 // Set font size here
	// 			}
	// 		},
	// 	}]
	// }

	// // tooltip
	// const titleTooltip2 = (tooltipItems) => {
	// 	// return tooltipItems
	// 	return titleChart2;
	// }
	// // tooltip
	// const labelTooltip2 = (tooltipItems) => {
	// 	// return tooltipItems
	// 	return labelChart2;
	// }

	// // config
	// const config2 = {
	// 	type: 'bar',
	// 	data,
	// 	options: {
	// 		scales: {
    //             x: {
    //                 grid: {
    //                     drawOnChartArea: false,
    //                 }
    //             },
	// 			y: {
	// 				beginAtZero: true
	// 			}
    //         },
	// 		plugins: {
	// 			tooltip: {
	// 				yAlign: 'bottom',
	// 				displayColors: false,
	// 				backgroundColor: '#FC960A',
	// 				titleMarginBottom: 0,
	// 				callbacks: {
	// 					title: titleTooltip2,
	// 					label: labelTooltip2,
	// 				}
	// 			},

    //             legend: {
    //                 display: false,
    //             },
	// 		}
	// 	},
	// 	plugins: [ChartDataLabels],
	// }

	// // render chart
	// const chart2 = new Chart(
	// 	document.getElementById('myChart2'),
	// 	config2
	// )

	
	$("#daterange").daterangepicker({
		locale: {
			format: 'MMM DD, YYYY',
		},
		maxDate: moment() // Restrict forward dates to today
	});

	$('.daterange_container').css('display', 'none');
	$(".no_of_days").change(function(e){

		e.preventDefault();
		checkedCounter = 0;
		var current_date = new Date();
		var filtered_value = $(this).val();
		if (filtered_value == 'custom') {
			$('.daterange_container').css('display', 'block');
			$('.no_of_days_container').css('display', 'none');
			$("#selected_days").val('custom');
		} else {

			$('.daterange_container').css('display', 'none');
			current_date.setDate( current_date.getDate() - filtered_value );
			$("#selected_days").val(filtered_value);
		}
	});
	$("#close_custom_date").click(function () {

		$('.daterange_container').css('display', 'none');
		$(".no_of_days_container").css('display', 'block');
		$(".no_of_days").val(0);
		$(".no_of_days").selectpicker('refresh');
		$(".selected_days").val(0);

		getDashboardData();
	});

</script>
<?php
	} else {
		header('location: login.php');
	}
?>
