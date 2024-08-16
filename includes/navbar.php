<?php
	include_once("session.php");
	if($_SESSION['user_email'] == true) {

		$user_name = $_SESSION['user_name'];
		$user_role = $_SESSION['user_role'];
		$super_admin = $_SESSION['super_admin'];
?>
		<input type="hidden" name="module" class="module" value="0" />
		<nav id="navbar" class="navbar navbar-expand-lg position-fixed w-100">
	     	<div id="navbar_top_layout">
     			<div id="navbar_top_layout_left">
     				<div id="vt_logo">
     					<img id="logo" src="images/fc_logo.png" width="62px">
						<br>
     					<!-- <span id="logo_heading">VENTURETRONICS</span> -->
     					<!-- <img id="logo_heading" src="images/vt-heading.png" width="190px;"> -->
     				</div>
     				<div>
	     				<span onclick="openNav()" id="open_icon"><i class="fa fa-bars"></i><i class="fa fa-caret-right" id="arrow"></i> </span>
	     				<span onclick="closeNav()" id="close_icon"> <i class="fa fa-bars"></i><i class="fa fa-caret-left" id="arrow"></i> </span>
     				</div>
     			</div>
     			<div id="heading">ACCOUNT MANAGEMENT</div>
     			<div id="navbar_top_layout_right" class="pull-right text-right">
     				<?php
     					$user_name = '';
     					$login_user_name = '';
     					$user_name = explode(' ', $_SESSION['user_fullname']);
 						if(strtolower($user_name[0]) == "muhammad" || strtolower($user_name[0]) == "mohammad") {
 							$login_user_name = "<span style='font-weight:700;'>".$user_name[1]."<span>";
     					} else{
     						$login_user_name = "<span style='font-weight:700;'>".$user_name[0]."<span>";
     					}
     				?>
     				<div id="signout_layout" style="">
     					<div id="navbar_top_layout_right_display_name" class="pull-left"><?php echo ucwords( "Welcome ". $login_user_name); ?></div>
					    <div class="dropdown">
					        <div id="signout_image_layout" class="pull-right" data-toggle="dropdown" style="float: left;">
					        	<img src="images/user-icon-4.png">
					        </div>
					        <!-- <div id="signout" class="signout" title="Sign out">
					        	<img src="images/logout.svg" width="18px">&nbsp;
					        	<span style="font-size: 16.4px; font-weight: 500;">Sign out</span>
					        </div> -->

					        <div id="signout" class="signout" title="Sign out">
					        	<img src="images/logout.svg" width="18px">&nbsp;
					        	<span style="font-size: 16.4px; font-weight: 500;">Sign out</span>
					        </div>

					        <div id="signout_dropdown" class="dropdown-menu pull-right">
					            <!-- <a href="#" class="dropdown-item"><i class="fa fa-user" title="Profile"></i>&nbsp; Profile</a> -->
					            <!-- <a href="#" class="dropdown-item" style=""><i class="fa fa-gear"></i>&nbsp; Setting</a> -->
					            <a href="javascript:void(0)" class="dropdown-item signout"><img src="images/logout.svg" width="18px">&nbsp;&nbsp;Sign out</a>
					        </div>
					    </div>
					</div>
     			</div>
	     	</div>
		</nav>
		<div style="height: 110px;"></div>
		<div id="sideNavbar" class="sideNavbar">
			<div id="inner_sideNavbar">

				<a href="dashboard" title="Dashboard" id="dashboard" class="anchor_tag">
					<img id="bydefault_svg" src="images/sidebar_icons/dashboard_default.svg">
					<img id="hover_svg" src="images/sidebar_icons/dashboard_hover.svg">
					<span id="navbar_text">Dashboard</span>
				</a>

				<a href="purchases" id="purchases" title="Purchases" class="anchor_tag">
					<img id="bydefault_svg" src="images/sidebar_icons/quotation_default.svg">
					<img id="hover_svg" src="images/sidebar_icons/quotation_hover.svg">
					<span id="navbar_text">Country Rates </span>
				</a>

				<a href="invoices" id="invoices" title="Invoices" class="anchor_tag">
					<img id="bydefault_svg" src="images/sidebar_icons/quotation_default.svg">
					<img id="hover_svg" src="images/sidebar_icons/quotation_hover.svg">
					<span id="navbar_text">Origins</span>
				</a>

				<a href="vendors" id="vendors" title="Vendors" class="anchor_tag">
					<img id="bydefault_svg" src="images/sidebar_icons/vendor_default.svg">
					<img id="hover_svg" src="images/sidebar_icons/vendor_hover.svg">
					<span id="navbar_text">Countries</span>
				</a>

				<a href="clients" id="clients" title="Clients" class="anchor_tag">
					<img id="bydefault_svg" src="images/sidebar_icons/vendor_default.svg">
					<img id="hover_svg" src="images/sidebar_icons/vendor_hover.svg">
					<span id="navbar_text">Customers</span>
				</a>

				<a href="#"  data-toggle="collapse" data-target="#service" class="collapsed manage_items" id="manage_items" title="Manage Items">
					<img id="bydefault_svg" src="images/sidebar_icons/manage_product_default.svg">
					<img id="hover_svg" src="images/sidebar_icons/manage_product_hover.svg">
					<span id="navbar_text">Settings</span>
				</a>
            	<div class="collapse" id="service">
					<a href="items" id="new_item" title="Items">&nbsp;&nbsp;
						<img id="bydefault_svg" src="images/sidebar_icons/product_default.svg">
							<img id="hover_svg" src="images/sidebar_icons/product_hover.svg">
						<span id="inner_navbar_text">Country rates</span>
					</a>
					<a href="settings" id="settings" title="Settings">&nbsp;&nbsp;
						<img id="bydefault_svg" src="images/sidebar_icons/product_default.svg">
							<img id="hover_svg" src="images/sidebar_icons/product_hover.svg">
						<span id="inner_navbar_text">other</span>
					</a>
					<a href="models" id="models" title="Models">&nbsp;&nbsp;
						<img id="bydefault_svg" src="images/sidebar_icons/product_default.svg">
							<img id="hover_svg" src="images/sidebar_icons/product_hover.svg">
						<span id="inner_navbar_text">Models</span>
					</a>
					
				</div>

				<!-- <a href="#"  data-toggle="collapse" data-target="#service2" class="collapsed additionals" id="additionals" title="Additionals">
					<div class="d-flex">
						<div style="margin-top: 1.5px;">
							<i id="hover_svg" class="fa fa-bars" style="font-size:22px;"></i>
							<i id="bydefault_svg" class="fa fa-bars" style="font-size:22px;"></i>
						</div>&nbsp;
						<span id="navbar_text"> Reports </span>
					</div>
				</a>
				<div class="collapse" id="service2">
					<a href="reports.php" id="reports" title="Sell">
						&nbsp;&nbsp;
						<i id="bydefault_svg" class="fa fa-files-o" aria-hidden="true" style="font-size:21px;"></i>
						<i id="hover_svg" class="fa fa-files-o" aria-hidden="true" style="font-size:21px;"></i>
						<span id="inner_navbar_text">Sell</span>
					</a>
					<a href="reports.php" id="reports" title="Purchase">
						&nbsp;&nbsp;
						<i id="bydefault_svg" class="fa fa-files-o" aria-hidden="true" style="font-size:21px;"></i>
						<i id="hover_svg" class="fa fa-files-o" aria-hidden="true" style="font-size:21px;"></i>
						<span id="inner_navbar_text">Purchase</span>
					</a>
				</div> -->

				<input type="hidden" name="user_name" class="user_name" value="<?php echo $user_name; ?>">
				<input type="hidden" name="user_role" class="user_role" value="<?php echo $user_role; ?>">
				<input type="hidden" name="super_admin" class="super_admin" value="<?php echo $super_admin; ?>">
            </div>
		</div>

		<!-- Session timeoud modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      	<div class="text-left">
				        <div class="text-center mt-3 mb-4">
				        	<img src="./images/warning_icon.png">
				        	<h5 class="mt-1"> Your session has expired </h5>
				        </div>
				        <div class="text-right mb-3 mr-3">
				        	<button type="button" class="btn btn-sm btn-secondary session_expired" 
				        		style="width:80px; background:#154360;"> 
				        	Log In </button>
				        </div>
			      	</div>
			    </div>
		  	</div>
		</div>
		<!-- Session timeoud modal -->
		
<script type="text/javascript" src="js/navbar.js?clear_cache=<?php echo time();?>"></script>
<?php
	} else {
		header('location: login.php');
	}
?>

