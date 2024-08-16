<?php
include_once("includes/session.php");
include_once("database/database.php");
if (isset($_SESSION['user_email']) == true) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<?php include_once('includes/header.php'); ?>
		<title>FC - Dashboard</title>
		<link rel="stylesheet" type="text/css" href="css/style_dashboard.css">

		<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script> -->



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

			.top_container .data .heading,
			.bottom_container .data .heading {
				/* font-size:24px; */
				/* font-weight:600; */
				font-size: 1.4vw;
			}

			.top_container .data .number,
			.bottom_container .data .number {
				/*				font-size:38px;*/
				font-size: 2.5vw;
				font-weight: 600;
				display: flex;
				align-items: center;
				justify-content: center;
			}

			.top_container .data .number .label,
			.bottom_container .data .number .label {
				/*				font-size:34px;*/
				font-size: 2vw;
				font-weight: 600;
			}



			.custom_arrows {
				position: absolute;
				top: 15px;
				right: 18px;
				font-size: 21px;
			}

			.custom_arrows .left_icon,
			.custom_arrows .right_icon {
				border: 1px solid #FC960A;
				padding: 8px 4px 4px 4px;
				border-radius: 4px;
				color: #14213D;
			}

			.custom_arrows .left_icon {
				padding-right: 6px;
			}

			.custom_arrows .right_icon {
				padding-left: 6px;
			}

			.custom_arrows .left_icon:hover,
			.custom_arrows .right_icon:hover {
				background: #14213D;
				border: 1px solid #14213D;
				color: #FFFFFF;
				cursor: pointer;
			}


			.disabled {
				border: 1px solid #B3B6B7 !important;
				color: #7B7D7D !important;
			}


			.daterangepicker .drp-buttons .btn {
				width: 60px !important;
			}


			/* .selectpicker {
				border: 1px solid red !important;
			} */

			.bootstrap-select.form-control-sm .dropdown-toggle {
				border: 1px solid #D0D3D4 !important;
			}


			#close_custom_date {
				font-size: 14px !important;
				font-weight: 700 !important;
				padding-top: 3px !important;
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
				border: 1px solid #FFFFFF !important;
			}

			.applyBtn {
				background-color: #FC960A !important;
				border: none !important;
			}


			@media screen and (max-width: 1350px) {

				.top_container .col-md-6 .data .heading,
				.bottom_container .data .heading {
					font-size: 1.5vw;
				}
			}

			@media screen and (max-width: 1198px) {

				.top_container .col-md-6 .data .heading,
				.bottom_container .data .heading {
					font-size: 2vw;
				}
			}

			@media screen and (max-width: 768px) {

				.top_container .data .number,
				.bottom_container .data .number {
					font-size: 3.5vw;
				}

				.top_container .data .number .label,
				.bottom_container .data .number .label {
					font-size: 3vw;
				}

				.top_container .col-md-6 .data .heading,
				.bottom_container .data .heading {
					font-size: 2.5vw;
				}
			}

			@media screen and (max-width: 550px) {

				.top_container .col-md-6 .data .heading,
				.bottom_container .data .heading {
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




		// // Vendors chart setup
		// var data = {
		// 	labels: [],
		// 	datasets: [{
		// 		label: "",
		// 		data: [],
		// 		backgroundColor: ['#14213D'],
		// 		datalabels: {
		// 			formatter: (value, context) => {
		//                 return new Intl.NumberFormat().format(value);
		//             },
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
		// // Vendors chart config
		// const config = {
		// 	type: 'bar',
		// 	data,
		// 	options: {
		// 		scales: {
		//             x: {
		// 				min: 0,
		// 				max: 3,
		//                 grid: {
		//                     drawOnChartArea: false,
		//                 }
		//             },
		// 			y: {
		// 				beginAtZero: true,
		// 			}
		//         },
		// 		plugins: {
		// 			tooltip: {
		// 				yAlign: 'bottom',
		// 				displayColors: false,
		// 				backgroundColor: '#FC960A',
		// 				titleMarginBottom: 0,
		// 				callbacks: {

		// 				},
		// 			},

		//             legend: {
		//                 display: false,
		//             },
		// 		}
		// 	},
		// 	plugins: [ChartDataLabels],
		// }
		// // Render vendors chart
		// const vendor_chart = new Chart(
		// 	document.getElementById('VendorChart'),
		// 	config
		// );


		// // Pagination chart buttons
		// $(".vendors_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
		// $(".vendors_breakdown .custom_arrows .left_icon").addClass('disabled');
		// setTimeout(function() {
		// 	var data_length = vendor_chart.data.labels.length;
		// 	var max = vendor_chart.config.options.scales.x.max;
		// 	if (max+1 >= data_length) {
		// 		$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
		// 		$(".vendors_breakdown .custom_arrows .right_icon").addClass('disabled');
		// 	}
		// }, 100);

		// $(".vendors_breakdown .custom_arrows .left_icon").click(function(){

		// 	var min = vendor_chart.config.options.scales.x.min;
		// 	var max = vendor_chart.config.options.scales.x.max;
		// 	var data_length = vendor_chart.data.labels.length;

		// 	min = vendor_chart.config.options.scales.x.min -= 1;
		// 	max = vendor_chart.config.options.scales.x.max -= 1;
		// 	vendor_chart.update();

		// 	if (min == 0) {
		// 		$(".vendors_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
		// 		$(".vendors_breakdown .custom_arrows .left_icon").addClass('disabled');
		// 	}
		// 	if (max < (data_length-1)) {
		// 		$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'auto');
		// 		$(".vendors_breakdown .custom_arrows .right_icon").removeClass('disabled');
		// 	}
		// });
		// $(".vendors_breakdown .custom_arrows .right_icon").click(function(){

		// 	var min = vendor_chart.config.options.scales.x.min;
		// 	var max = vendor_chart.config.options.scales.x.max;
		// 	var data_length = vendor_chart.data.labels.length;

		// 	min = vendor_chart.config.options.scales.x.min += 1;
		// 	max = vendor_chart.config.options.scales.x.max += 1;
		// 	vendor_chart.update();

		// 	if (min > 0) {
		// 		$(".vendors_breakdown .custom_arrows .left_icon").css('pointer-events', 'auto');
		// 		$(".vendors_breakdown .custom_arrows .left_icon").removeClass('disabled');
		// 	}
		// 	if (max >= (data_length-1)) {
		// 		$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
		// 		$(".vendors_breakdown .custom_arrows .right_icon").addClass('disabled');
		// 	}
		// });


		// // Clients chart setup
		// var data = {
		// 	labels: [],
		// 	datasets: [{
		// 		label: "",
		// 		data: [],
		// 		backgroundColor: ['#14213D'],
		// 		datalabels: {
		// 			formatter: (value, context) => {
		//                 return new Intl.NumberFormat().format(value);
		//             },
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
		// // Clients chart config
		// const client_config = {
		// 	type: 'bar',
		// 	data,
		// 	options: {
		// 		scales: {
		//             x: {
		// 				min: 0,
		// 				max: 3,
		//                 grid: {
		//                     drawOnChartArea: false,
		//                 }
		//             },
		// 			y: {
		// 				beginAtZero: true,
		// 			}
		//         },
		// 		plugins: {
		// 			tooltip: {
		// 				yAlign: 'bottom',
		// 				displayColors: false,
		// 				backgroundColor: '#FC960A',
		// 				titleMarginBottom: 0,
		// 				callbacks: {

		// 				},
		// 			},

		//             legend: {
		//                 display: false,
		//             },
		// 		}
		// 	},
		// 	plugins: [ChartDataLabels],
		// }
		// // Render clients chart
		// const client_chart = new Chart(
		// 	document.getElementById('ClientChart'),
		// 	client_config
		// );


		// // Pagination chart buttons
		// $(".clients_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
		// $(".clients_breakdown .custom_arrows .left_icon").addClass('disabled');
		// setTimeout(function() {
		// 	var data_length = client_chart.data.labels.length;
		// 	var max = client_chart.config.options.scales.x.max;
		// 	if (max+1 >= data_length) {
		// 		$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
		// 		$(".clients_breakdown .custom_arrows .right_icon").addClass('disabled');
		// 	}
		// }, 100);

		// $(".clients_breakdown .custom_arrows .left_icon").click(function(){

		// 	var min = client_chart.config.options.scales.x.min;
		// 	var max = client_chart.config.options.scales.x.max;
		// 	var data_length = client_chart.data.labels.length;

		// 	min = client_chart.config.options.scales.x.min -= 1;
		// 	max = client_chart.config.options.scales.x.max -= 1;
		// 	client_chart.update();

		// 	if (min == 0) {
		// 		$(".clients_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
		// 		$(".clients_breakdown .custom_arrows .left_icon").addClass('disabled');
		// 	}
		// 	if (max < (data_length-1)) {
		// 		$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'auto');
		// 		$(".clients_breakdown .custom_arrows .right_icon").removeClass('disabled');
		// 	}
		// });
		// $(".clients_breakdown .custom_arrows .right_icon").click(function(){

		// 	var min = client_chart.config.options.scales.x.min;
		// 	var max = client_chart.config.options.scales.x.max;
		// 	var data_length = client_chart.data.labels.length;

		// 	min = client_chart.config.options.scales.x.min += 1;
		// 	max = client_chart.config.options.scales.x.max += 1;
		// 	client_chart.update();

		// 	if (min > 0) {
		// 		$(".clients_breakdown .custom_arrows .left_icon").css('pointer-events', 'auto');
		// 		$(".clients_breakdown .custom_arrows .left_icon").removeClass('disabled');
		// 	}
		// 	if (max >= (data_length-1)) {
		// 		$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
		// 		$(".clients_breakdown .custom_arrows .right_icon").addClass('disabled');
		// 	}
		// });


		// function getDashboardData() {

		// 	var start_date = '';
		// 	var end_date = '';
		// 	setTimeout(function() {
		// 		var selected_days = $(".selected_days").val();
		// 		var dates = imsGetSqlDateFormat( selected_days );
		// 		start_date = dates.start_date;
		// 		end_date = dates.end_date;

		// 		var vendor_ids = [];
		// 		$('#vendor_id option').each(function(i) {
		// 			if (this.selected == true) {
		// 				vendor_ids.push(this.value);
		// 			}
		// 		});
		// 		// console.log(vendor_ids);

		// 		var client_ids = [];
		// 		$('#client_id option').each(function(i) {
		// 			if (this.selected == true) {
		// 				client_ids.push(this.value);
		// 			}
		// 		});
		// 		// console.log(client_ids);

		// 		$.ajax({
		// 			type: "POST",
		// 			url: "ajaxcallfordashboard.php",
		// 			data: {
		// 				"getDashboardData": 1,
		// 				selected_days: selected_days,
		// 				start_date: start_date,
		// 				end_date: end_date,
		// 				vendor_ids: vendor_ids,
		// 				client_ids: client_ids,
		// 			},
		// 			success: function (response) {
		// 				response = response.trim();
		// 				// console.log(response);

		// 				const json_data = JSON.parse(response);

		// 				var to_pay = json_data.to_pay;
		// 				var to_receive = json_data.to_receive;
		// 				$(".to_pay").html('<span class="label">PKR</span>&nbsp;&nbsp;&nbsp;&nbsp; <span class="amount">'+to_pay+'</span>');
		// 				$(".to_receive").html('<span class="label">PKR</span>&nbsp;&nbsp;&nbsp;&nbsp; <span class="amount">'+to_receive+'</span>');

		// 				vendor_chart.config.options.scales.x.min = 0;
		// 				vendor_chart.config.options.scales.x.max = 2;
		// 				vendor_chart.data.labels = [];
		// 				vendor_chart.data.datasets[0].data = [];
		// 				const vendorsBreakdown = json_data.vendors_breakdown;
		// 				for (const vendor_name in vendorsBreakdown) {
		// 					if (vendorsBreakdown.hasOwnProperty(vendor_name)) {
		// 						const amount = vendorsBreakdown[vendor_name];
		// 						// console.log(`Vendor: ${vendor_name}, Amount: ${amount}`);

		// 						vendor_chart.data.labels.push(vendor_name);
		// 						vendor_chart.data.datasets[0].data.push(amount);
		// 					}
		// 				}
		// 				vendor_chart.update();
		// 				// console.log(vendor_chart.config.options.scales.x.max);
		// 				// console.log(vendor_chart.data.datasets[0].data.length);
		// 				if ((vendor_chart.config.options.scales.x.max+1) >= vendor_chart.data.datasets[0].data.length) {
		// 					$(".vendors_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
		// 					$(".vendors_breakdown .custom_arrows .left_icon").addClass('disabled');

		// 					$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
		// 					$(".vendors_breakdown .custom_arrows .right_icon").addClass('disabled');
		// 				} else {
		// 					$(".vendors_breakdown .custom_arrows .right_icon").css('pointer-events', 'auto');
		// 					$(".vendors_breakdown .custom_arrows .right_icon").removeClass('disabled');
		// 				}


		// 				client_chart.config.options.scales.x.min = 0;
		// 				client_chart.config.options.scales.x.max = 2;
		// 				client_chart.data.labels = [];
		// 				client_chart.data.datasets[0].data = [];
		// 				const clientsBreakdown = json_data.clients_breakdown;
		// 				for (const client_name in clientsBreakdown) {
		// 					if (clientsBreakdown.hasOwnProperty(client_name)) {
		// 						const amount = clientsBreakdown[client_name];
		// 						// console.log(`Vendor: ${client_name}, Amount: ${amount}`);

		// 						client_chart.data.labels.push(client_name);
		// 						client_chart.data.datasets[0].data.push(amount);
		// 					}
		// 				}
		// 				client_chart.update();
		// 				// console.log(client_chart.config.options.scales.x.max);
		// 				// console.log(client_chart.data.datasets[0].data.length);
		// 				if ((client_chart.config.options.scales.x.max+1) >= client_chart.data.datasets[0].data.length) {
		// 					$(".clients_breakdown .custom_arrows .left_icon").css('pointer-events', 'none');
		// 					$(".clients_breakdown .custom_arrows .left_icon").addClass('disabled');

		// 					$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'none');
		// 					$(".clients_breakdown .custom_arrows .right_icon").addClass('disabled');
		// 				} else {
		// 					$(".clients_breakdown .custom_arrows .right_icon").css('pointer-events', 'auto');
		// 					$(".clients_breakdown .custom_arrows .right_icon").removeClass('disabled');
		// 				}
		// 			}
		// 		});

		// 	}, 0);
		// }



















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


		// $("#daterange").daterangepicker({
		// 	locale: {
		// 		format: 'MMM DD, YYYY',
		// 	},
		// 	maxDate: moment() // Restrict forward dates to today
		// });

		// $('.daterange_container').css('display', 'none');
		// $(".no_of_days").change(function(e){

		// 	e.preventDefault();
		// 	checkedCounter = 0;
		// 	var current_date = new Date();
		// 	var filtered_value = $(this).val();
		// 	if (filtered_value == 'custom') {
		// 		$('.daterange_container').css('display', 'block');
		// 		$('.no_of_days_container').css('display', 'none');
		// 		$("#selected_days").val('custom');
		// 	} else {

		// 		$('.daterange_container').css('display', 'none');
		// 		current_date.setDate( current_date.getDate() - filtered_value );
		// 		$("#selected_days").val(filtered_value);
		// 	}
		// });
		// $("#close_custom_date").click(function () {

		// 	$('.daterange_container').css('display', 'none');
		// 	$(".no_of_days_container").css('display', 'block');
		// 	$(".no_of_days").val(0);
		// 	$(".no_of_days").selectpicker('refresh');
		// 	$(".selected_days").val(0);

		// 	getDashboardData();
		// });
	</script>
<?php
} else {
	header('location: login.php');
}
?>