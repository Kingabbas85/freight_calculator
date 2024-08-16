<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	// if($_SESSION['user_email'] == true) {
		
		// if ($_SESSION['user_role'] == "developer" || $_SESSION['user_role'] == "management"  || $_SESSION['user_role'] == "procurement team" || $_SESSION['user_role'] == "administration") {

			$id = $_GET['Id'];
			$query = "Select * from teams where Id = '$id'";
			$result = mysqli_query($connection, $query);
			if(mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$team_name = $row['team_name'];
					$team_id = $row['team_id'];
				}
			} else {
				header('Location:page_not_found.php');
			}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>IMS - Team</title>
	</head>
	<body id="body">
		<div class="overlay"><div class="loader"></div></div>
		<?php
			include_once('includes/navbar.php');
		?>
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="vendor_layout">
					
					<div id="page_heading" class="row">
						Edit Team
						<div class="d-flex align-items-center heading_number">
							(
								<span> #</span>	
								<span> <?php echo imsCreateFourDigitNumber($team_id); ?> </span>
							)
						</div>
					</div>
					<div id="margin_div"></div>

					<form id="edit_team_form" method="post" onsubmit="return false">
				      	<div class="row">
						  	<div class="col-md-6" style="margin-bottom: 10px;">
					      		<span class="font-weight-light">
					      			<strong> Team Id:</strong>
					      		</span>
						    	<input type="" id="team_id" name="team_id" class="form-control form-control-sm team_id"  value="<?php echo $team_id;?>" readonly>
						  	</div>
						  	<div class="col-md-6" style="margin-bottom: 10px;">
					      		<span class="font-weight-light">
					      			<strong> Team Name:</strong>
					      		</span>
						    	<input type="text" id="team_name" name="team_name" class="form-control form-control-sm team_name"  value="<?php echo $team_name;?>" oninput="<?php echo $onlyCharacter; ?>" >
						  	</div>
						</div>
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="hidden" name="action" value="updateEmployee">
						<div class="form-group text-center" style="margin-top: 20px;">
					    	<input type="submit" id="form_submit_button" value="Update" class="add_team">
					  	</div>
					</form>
				</div>
			</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/teams.js?clear_cache=<?php echo time();?>"></script>
<?php
	// 	} 
	// 	else {
	// 		include_once('unauthorized_page.php');
	// 	}
	// }
	// else {
	// 	header('location: login.php');
	// }
?>
