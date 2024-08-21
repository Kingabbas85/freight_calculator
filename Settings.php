<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	if($_SESSION['user_email'] == true) {
		
?>
	<!DOCTYPE html>
		<html>

		<head>
			<title>Freight Calculator - Settings</title>
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


				textarea {
					resize:none;
				}
			</style>
		</head>

		<body>
			<?php include_once('includes/navbar.php'); ?>
			<?php include_once('includes/alerts.php'); ?>
			<div class="layout" id="layout">
				<div class="inner-layout">
					<div class="d-flex justify-content-between page-heading">
						<div class="heading"> Calculator Settings 
							<? php // echo $deviceIp = getSettingRecord($connection, 'device_ip'); ?>
						</div>
					</div>
					<div class="line-break"></div>
					<div class="context mt-4">
					<!-- <form id="settings-form" class="settings-form">
							<div class="row mt-3 mb-3">
								<div class="col">
									<span class="font-weight-light">
										<strong>Device Ip:</strong>
										<input type="text" name="device_ip" id="device_ip" class="form-control form-control-sm device_ip" />
									</span>
								</div>
								<div class="col">
									<span class="font-weight-light">
										<strong>Device Super Admin Id:</strong>
										<input type="text" name="device_admin_role_id" id="device_admin_role_id" placeholder="for deafult user 1 and for admin 14" class="form-control form-control-sm device_admin_role_id" />
									</span>
								</div>
							</div>
							<input type="hidden" name="action" class="action" value="SaveSettings">

							<div class="text-center submit mt-4 mb-4">
								<button type="submit" class="btn btn-info submit-btn">Save Settings</button>
							</div>
						</form> -->


						<table id="SettingsTable" class="table-sm w-100 table_style" style="min-width:1000px;">
							<thead>
								<tr class="text-left">
									<th> Task Name </th>
									<th>Actions </th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-left">
									<td> Import Countries In Database From Excel</td>
									<td>
										<button type="button" id="importCountriesFromExcel" class="btn btn-sm btn-outline-success">Import Countries </button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<script type="text/javascript" src="js/settings.js?clear_cache=<?php echo time(); ?>"></script>
		</body>

		</html>
<?php
	
} else {
	header('location: login');
}
?>