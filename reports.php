<?php
	include_once("includes/session.php");
	include_once('database/database.php');

	if($_SESSION['user_email'] == true) {

	if ( $_SESSION['user_role'] == "developer" || $_SESSION['user_role'] == "management" || $_SESSION['user_role'] == "supply chain" ) {
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>IMS - Reports</title>
		<style type="text/css">
			.daterange {
				background: transparent !important;
			}

			.drp-buttons .drp-selected {
				float: left;
				margin-top: 8px;
			}
			.drp-buttons .cancelBtn {
				display: none;
			}

			.bootstrap-select.form-control-sm .dropdown-toggle {
				border: 1px solid #E5E7E9;
			}

			input[type=radio] {
				width: 13px;
				height: 13px;
			}
		</style>
	</head>
	<body id="body">
		<div class="overlay"><div class="loader"></div></div>
		<?php include_once('includes/navbar.php'); ?>
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="prf_layout">

					<div id="page_heading" class="row">
						Reports
					</div>
					<div id="margin_div"></div>

					<form id="generate_report_form" onsubmit="return false">

						<div class="row">

							<div class="col-md-12 mt-2">
						      	<div class="input-group input-group-sm">
							        <div class="input-group-prepend input-group-sm font-weight-light">
							  			<strong class="input-group-text" style="font-size:14px !important;"> Company </strong>
							  		</div>

						        	<select class="form-control form-control-sm selectpicker company" id="company" name="company" style="height: 34px;">
										<option value="" disabled selected hidden> -- Choose -- </option>
							      		<?php
								  			$query = "Select * FROM clients WHERE status = 1 ORDER By client_name ASC ";
											$result = mysqli_query($connection, $query);
											if (mysqli_num_rows($result) > 0) {
												while ($row = mysqli_fetch_assoc($result)) {
													$client_id = $row['client_id'];
													$client_name = $row['client_name'];
													echo '<option value="'.$client_id.'">' . $client_name . '</option>';
												}
											}
										?>
							      	</select>
					      		</div>
						    </div>

							<div class="col-lg-6 col-md-6 mt-1">
					      		<span class="font-weight-light">
						  			<strong> Program Budget: </strong>
						  		</span>
					      		<select class="form-control form-control-sm program_budget" id="program_budget" name="program_budget">
					      			<option value="" disabled selected hidden> -- Choose -- </option>
					      		</select>
						  	</div>

						  	<div class="col-lg-6 col-md-6 mt-1">
					      		<span class="font-weight-light">
						  			<strong> Project Name: </strong>
						  		</span>
					      		<select class="form-control form-control-sm project_name" id="project_name" name="project_name">
					      			<option value="" disabled selected hidden> -- Choose -- </option>
					      		</select>
						  	</div>

						  	<div class="col-lg-6 col-md-6 mt-1">
					      		<span class="font-weight-light">
						  			<strong> Team Name: </strong>
						  		</span>
					      		<select class="form-control form-control-sm selectpicker team_name" id="team_name" name="team_name">
					      			<?php
				      					echo '<option value="" disabled selected hidden> -- Choose --</option>';
				      					$query2 = "Select * from teams";
				      					$result2 = mysqli_query($connection, $query2);
				      					if (mysqli_num_rows($result2)) {
				      						while ($row2 = mysqli_fetch_assoc($result2)) {
					      			?>
				      							<option value="<?php echo $row2['team_name']; ?>">
				      								<?php echo ucwords($row2['team_name']); ?>
				      							</option>
					      			<?php
				      						}
				      					}
					      			?>
					      		</select>
						  	</div>

						  	<div class="col-lg-6 col-md-6 mt-1">
					      		<span class="font-weight-light">
						  			<strong> User Name: </strong>
						  		</span>
					      		<select class="form-control form-control-sm selectpicker user_name" id="user_name" name="user_name">
					      			<option value="" disabled selected hidden> -- Choose -- </option>
					      			<?php
					      				$query3 = "Select DISTINCT requested_by, requester_name FROM demands ORDER BY requester_name ASC";
				      					$result3 = mysqli_query($connection, $query3);
				      					if (mysqli_num_rows($result3)) {
				      						while ($row3 = mysqli_fetch_assoc($result3)) {
				      							echo '<option value="'.$row3['requested_by'].'"> '.
				      								$row3['requester_name'].' ('.$row3['requested_by'].')'.
				      							' </option>';
				      						}
				      					}
					      			?>
					      		</select>
						  	</div>

						  	<div class="col-lg-6 col-md-6 mt-1">
						  		<div class="d-flex justify-content-between">
									<div>
										<span class="font-weight-light">
								  			<strong> Date: </strong>
								  		</span>
							  		</div>
									<div id="close_custom_date" style="font-weight: 700; font-size:14px; padding-right:2px; padding-top:3px;"> X </div>
								</div>
								
						  		<input type="hidden" name="start_date" class="start_date" id="start_date">
						  		<input type="hidden" name="end_date" class="end_date" id="end_date">
								<div id="daterange_input">
					      			<input class="form-control form-control-sm daterange" id="daterange" name="daterange" readonly style="">
								</div>
					      		<div id="daterange_select">
									<select class="form-control form-control-sm no_of_days selectpicker" id="no_of_days">
										<option value="0">All</option>
										<option value="15">Last 15 Days</option>
										<option value="30" selected>Last 30 Days</option>
										<option value="60">Last 60 Days</option>
										<option value="90">Last 90 Days</option>
										<option value="custom">Custom</option>
									</select>
					      		</div>
						  	</div>

						  	<div class="col-lg-6 col-md-6 mt-1">
					      		<span class="font-weight-light">
						  			<strong> Vendor Name: </strong>
						  		</span>
							    <select class="form-control form-control-sm vendor_id selectpicker" id="vendor_id" name="vendor_id">
							    	<option value="" disabled selected hidden> -- Choose -- </option>
									<?php
										$query = "Select * from vendors ORDER By vendor_name ASC";
										$result = mysqli_query($connection, $query);
										if (mysqli_num_rows($result) > 0) {
											while ($row = mysqli_fetch_assoc($result)) {
												$vendor_id = $row['vendor_id'];
												$vendor_name = $row['vendor_name'];
												?>
												<option value="<?php echo $vendor_id; ?>"><?php echo ucwords($vendor_name); ?></option>
											<?php
											}
										}
									?>
								</select>
						  	</div>

						</div>

						<div class="row pl-3 pr-3 mt-2" style="font-size: 14px; margin-top: 2px;">
				      		<span class="font-weight-light mr-3">
					  			<strong> Sourcing: </strong>
					  		</span>
					  		<input type="hidden" id="sourcing" name="sourcing" class="sourcing" value="">
				      		<div style="margin-top: 1.5px;">
				      			<input type="radio" name="sourcingCheckBox" class="sourcingCheckBox" id="all" value="" checked>
								&nbsp;<label for="all">All</label>
				      			<input type="radio" name="sourcingCheckBox" class="ml-2 sourcingCheckBox" id="local" value="0">
								&nbsp;<label for="local">Local</label>
 								<input type="radio" name="sourcingCheckBox" class="ml-2 sourcingCheckBox" id="international" value="1">
								&nbsp;<label for="international">International</label>
				      		</div>
					  	</div>

					  	<div class="row pl-3 pr-3" style="font-size: 14px; margin-top: 0px;">
				      		<span class="font-weight-light mr-3">
					  			<strong> Module:<i class="text-danger">*</i> </strong>
					  		</span>
					  		<input type="hidden" id="module" name="module" class="module" value="">
				      		<div style="margin-top: 1px;">
				      			<input type="radio" name="moduleCheckBox" class="moduleCheckBox" id="demand" value="Demand">
								&nbsp;<label for="demand">Demand</label>
 								<input type="radio" name="moduleCheckBox" class="ml-2 moduleCheckBox" id="PRF" value="PRF">
								&nbsp;<label for="PRF">PRF</label>
				      		</div>
					  	</div>
					  	
					  	<div style="font-size: 15px; visibility: hidden;" id="files_option">
					  		<input type="checkbox" id="invoices" name="invoices" class="invoices" value="0">
					  		<label for="invoices" class="ml-2"> Invoices </label>
					  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  		<input type="checkbox" id="with_prfs" name="with_prfs" class="with_prfs" value="0">
					  		<label for="with_prfs" class="ml-2"> PRFs </label>
					  	</div>				  	

						<!-- Download links -->
						<a href="./assets/reports/DemandReport.xlsx" style="display: none;" id="DemandsReport" class="DemandsReport" download> Demand Report </a>
						<a href="./assets/reports/PRFReport.zip" style="display: none;" id="PRFsReport_zip" class="PRFsReport_zip" download> PRFs Report (Zip File) </a>
						<a href="./assets/reports/PRFReport.xlsx" style="display: none;" id="PRFsReport" class="PRFsReport" download> PRFs Report </a>
						<!-- Download links -->

						<!-- Submit Button -->
							<div class="form-group text-center">
								<input type="submit" id="form_submit_button" name="generate_report" value="Generate" class="generate_report">
							</div>
						<!-- Submit Button -->
					</form>
				</div>
			</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/reports.js?clear_cache=<?php echo time();?>"></script>
<script type="text/javascript">
	$(".searable_select_option").selectpicker();
</script>
<?php
} 
else {
	include_once('unauthorized_page.php');
}
}
else {
	header('location: login.php');
}
?>