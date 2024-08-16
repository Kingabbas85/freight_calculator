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
		<title>IMS - Brand</title>
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
						<div> Brands </div>
						<div id="add_new">
							<a href="NewBrand"> <i class="fa fa-plus"></i>&nbsp; New Brand </a>
						</div>
					</div>
					<div id="margin_div"></div>

					<div id="table_layout_updated">
						<table id="brandsTable" class="table table-sm table-striped table-hover w-100 table_style" style="min-width: 900px;">
							<thead>
								<tr class="text-left">
									<th width="40px">#</th>
									<th width="80px">Brand ID</th>
									<th>Brand Name</th>
									<th width="60px">Active</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$count = 1;
								$query = "Select * FROM brands ORDER By brand_name ASC";
								$result = mysqli_query($connection, $query);
								if(mysqli_num_rows($result)) {
									while($row = mysqli_fetch_assoc($result)) {
										
										$id = $row['Id'];
										$brand_id = $row['brand_id'];
										$brand_name = $row['brand_name'];

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
													<?php echo "CL-".mraCreateSixDigitNumber($brand_id); ?>
												</a>
											</td>
											<td> <?php echo $brand_name; ?> </td>
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
<script type="text/javascript" src="js/brands.js?clear_cache=<?php echo time();?>"></script>
<script type="text/javascript">
	document.getElementById("brandsTable").style.borderBottom = "1px solid #D0D3D4";
</script>
<?php
		} else {
			include_once('unauthorized_page.php');
		}
	} else {
		header('location: login.php');
	}
?>