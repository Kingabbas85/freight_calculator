<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	if($_SESSION['user_email'] == true) {
		
		if ($_SESSION['user_role'] == "developer" || $_SESSION['user_role'] == "management"  || $_SESSION['user_role'] == "procurement team" || $_SESSION['user_role'] == "administration") {

			$query = "SELECT Id FROM teams ORDER BY Id DESC LIMIT 1";
			$result = mysqli_query($connection, $query);
			if (mysqli_num_rows($result) >0) {
				while($row = mysqli_fetch_assoc($result)){
					$id = $row['Id'];
					$id = $id + 1;
					$team_id = imsCreateFourDigitNumber($id);
				}
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
						New Team
					</div>
					<div id="margin_div"></div>

					<form id="team_form" method="post" >
				      	<div class="row">
						  	<div class="col-md-6" style="margin-bottom: 10px;">
					      		<span class="font-weight-light">
					      			<strong> Team Id:</strong>
					      		</span>
						    	<input type="" id="team_id" name="team_id" class="form-control form-control-sm team_id" value="<?php echo "t_".$team_id;?>"  readonly>
						  	</div>
						  	<div class="col-md-6" style="margin-bottom: 10px;">
					      		<span class="font-weight-light">
					      			<strong> Team Name:</strong>
					      		</span>
						    	<input type="text" id="team_name" name="team_name" class="form-control form-control-sm team_name" placeholder="Name" oninput="<?php echo $onlyCharacter; ?>">
						  	</div>
						</div>
						<input type="hidden" name="action" value="addTeam">
						<div class="form-group text-center" style="margin-top: 20px;">
					    	<input type="submit" id="form_submit_button" value="Add Team" class="add_team">
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
		} 
		else {
			include_once('unauthorized_page.php');
		}
	}
	else {
		header('location: login.php');
	}
?>
