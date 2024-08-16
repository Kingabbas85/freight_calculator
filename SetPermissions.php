<?php
	include_once("includes/session.php");
	if($_SESSION['user_email'] == true) {
		
		if ($_SESSION['user_role'] == "developer") {
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>IMS - Permission</title>
		<style type="text/css">
			.tokenfield{font-family:sans-serif;font-size:13.5px; min-height:10px; color:#556270;outline: none; padding:7px 5px 0px 5px; border-radius:3px}
			::placeholder {
				font-size: 14px;
			}
		</style>
	</head>
	<body id="body">
		<?php
			include_once('includes/navbar.php');
		?>
		<div id="outer_layout" class="mx-auto">
			<div id="inner_layout">
				<div id="permission_layout">
					
					<div id="page_heading" class="row">
						Set Permissions
					</div>
					<div id="margin_div"></div>

					<form id="permission_form" onsubmit="return false">
				      	<div class="row">
						  	<div class="col-md-6" style="margin-bottom: 10px;">
					      		<span class="font-weight-light">
					      			<strong> User Name:<i class="text-danger">*</i></strong>
					      		</span>
						    	<input type="text" id="user_emails" name="user_emails" class="form-control form-control-sm user_emails" placeholder="junaid.khalil@venturetronics.com">
						  	</div>
						  	<div class="col-md-6" style="margin-bottom: 10px;">
					      		<span class="font-weight-light">
					      			<strong> User Role:<i class="text-danger">*</i></strong>
					      		</span>
						    	<select id="user_role" name="user_role" class="form-control form-control-sm user_role" style="height: 34px;">
					      			<option value="" disabled selected hidden> -- Choose Role -- </option>
						    		<option value="developer">Developer</option>
						    		<option value="accounts">Accounts</option>
						    		<option value="management">Management</option>
						    		<option value="team lead">Team Lead</option>
						    		<option value="inventory team">Inventory Team</option>
						    		<option value="procurement team">Procurement Team</option>
						    	</select>
						  	</div>

						</div>
						<div class="form-group text-center" style="margin-top: 20px;">
					    	<input type="submit" id="form_submit_button" value="Allow" class="allow_permission">
					  	</div>
					</form>
				</div>
			</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/set_permission.js?clear_cache=<?php echo time();?>"></script>
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
