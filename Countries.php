<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Freight Calculator - Country</title>
		<?php include_once('includes/header.php'); ?>
		<style>
			.counter_container .d-flex div:nth-child(1) {
				font-size: 14px;
				font-weight: 600;
				width: 220px;
			}

			.counter_container .d-flex div:nth-child(2) {
				font-size: 14px;
				font-weight: 600;
			}

			.pending_requests {
				padding: 7px 20px 8px 20px;
				background: #14213D;
				color: #FFFFFF;
				font-size: 14px;
				border-radius: 4px;
				opacity: 0.95;
			}

			.pending_requests:hover {
				opacity: 1;
				text-decoration: none;
				color: #FFFFFF;
			}
		</style>
	</head>

	<body>
		<?php include_once('includes/navbar.php'); ?>
		<?php include_once('includes/alerts.php'); ?>
		<div class="layout" id="layout">
			<div class="inner-layout">

				<div class="d-flex justify-content-between page-heading">
					<div class="heading"> Countries </div>
					<div class="add_new">
						<a href="NewCountry"> <i class="fas fa-plus"></i>&nbsp; Add Country </a>
					</div>
				</div>
				<div class="line-break"></div>

				<div class="context mt-4">

					<table id="CountryTable" class="table-sm w-100 table_style mt-2" style="min-width:1000px;">
						<thead>
							<tr class="text-left">
								<th width="50px"> # </th>
								<th> Country Name </th>
								<th> Country Code </th>
								<th> Region Name </th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1;
							$query = "Select * FROM Countries";
							$result = mysqli_query($connection, $query);
							if (mysqli_num_rows($result)) {
								while ($row = mysqli_fetch_assoc($result)) {

									$id = $row['Id'];
									$name = $row['name'];
									$country_code = $row['country_code'];
									$region_id = $row['region_id'];
									$region_name = getRegionNameById($connection, $region_id);
									$date = date("d-M-Y", strtotime($row['created_at']));

									echo '<tr>';
									echo '<td>' . $count++ . '</td>';
									echo '<td>' . $name . '</td>';
									echo '<td>' . $country_code . '</td>';
									echo '<td>' . $region_name . '</td>';
									echo '<td>
										<a href="EditCountry?id=' . md5($row['Id']) . '" class="text-primary"><i class="fas fa-edit"></i></a>&nbsp;
										<a href="javascript:void(0);" class="delete-region-btn" data-id="' . $id . '">
												<i class="fas fa-trash text-danger"></i>
											</a>
									  </td>';
								}
							} else {
								echo '<tr>';
								echo '<td class="text-center" colspan="6"> No Record Found </td>';
								echo '</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>

	</html>
	<script type="text/javascript" src="js/countries.js?clear_cache=<?php echo time(); ?>"></script>
	<script type="text/javascript">
		// var startDate = moment().startOf('year');
		// var endDate = moment().endOf('month');
		// $("#daterange").daterangepicker({
		//  	startDate: startDate,
		//  	endDate: endDate,
		//  	locale: { 
		//    	format: 'MMM DD, YYYY',
		//  	},
		//  	maxDate: moment() // Restrict forward dates to today
		// });
	</script>
<?php

} else {
	header('location: login');
}
?>