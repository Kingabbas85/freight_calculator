<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	if($_SESSION['user_email'] == true) {
		
		if ($_SESSION['user_role'] == "management" || $_SESSION['user_role'] == "developer" || $_SESSION['user_role'] == "procurement team" || $_SESSION['user_role'] == "inventory team" || $_SESSION['user_role'] == "team lead"  || $_SESSION['user_role'] == "accounts") {
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php") ?>
		<title>IMS - Demand</title>
		<style type="text/css">
			.disabled:hover {
				cursor: not-allowed;
			}
			.dots:hover {
				cursor: not-allowed;
			}
		</style>
	</head>
	<body id="body">
		<!-- <div class="overlay"><div class="loader"></div></div> -->
		<?php
			include_once('includes/navbar.php');
		?>
		<div id="outer_layout" class="mx-auto">
		<div id="inner_layout">
		<div id="demand_layout">
			<div id="page_heading" class="pull-left">
				Demands
			</div>
			<div id="add_new" class="pull-right">
				<!-- <a href="createdemand.php"> <i class="fa fa-plus"></i>&nbsp; New Demand </a> -->
			</div>
			<?php
				if (isset($_GET['page_length'])) {
					if ($_GET['page_length'] == 5 || $_GET['page_length'] == 10 || $_GET['page_length'] == 25 || $_GET['page_length'] == 50 || $_GET['page_length'] == 100) {
						$page_length = $_GET['page_length'];
					} else {
						$page_length = 5;
						$page = $_GET['page'];
			?>
						<script type="text/javascript">
							window.location = 'custom_pagination.php?page=<?php echo $page; ?>&page_length=<?php echo $page_length; ?>';
						</script>
			<?php
					}
    			} else {
    				$page_length = 5;
    			}
			?>
			<div id="heading_hr_div"></div>
			<hr id="heading_hr">
				<div style="margin-bottom: 10px; padding-right: 15px;">
					<div class="row">
						<div class="col-md-2" style="">
							<select name="page_length" id="page_length" class="form-control form-control-sm page_length">
								<option value="5" <?php if(isset($page_length) && $page_length == 5){ echo 'selected'; } ?> >5</option>
								<option value="10" <?php if(isset($page_length) && $page_length == 10){ echo 'selected'; } ?> >10</option>
								<option value="25" <?php if(isset($page_length) && $page_length == 25){ echo 'selected'; } ?> >25</option>
								<option value="50" <?php if(isset($page_length) && $page_length == 50){ echo 'selected'; } ?> >50</option>
								<option value="100" <?php if(isset($page_length) && $page_length == 100){ echo 'selected'; } ?> >100</option>
							</select>
						</div>
						<!-- <div class="col-md-4">
							<input type="" name="" class="form-control form-control-sm search_box">
						</div>
						<div class="col-md-4">
							<input type="" name="" class="form-control form-control-sm search_box">
						</div>

						<div class="col-md-2"></div>
						<div class="col-md-1">
							<input type="submit" name="" class="btn btn-sm btn-primary" value="Search">
						</div> -->
					</div>					
				</div>
				<div id="table_layout" style="overflow: auto;">
					<table id="demandTable" class="table table-sm table-hover table-striped w-100 table_style" style="min-width: 800px;">
				        <thead id="new_new_new">
				            <tr class="text-left">
				                <th style="width: 30px;">#</th>
				                <th>Demand No</th>
				                <th>Requested By</th>
				                <th>Campus Name</th>
				                <th>Team Name</th>
				                <th>Status</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php
			        			if (isset($_GET['page'])) {
			        				$page = $_GET['page'];
			        			} else {
			        				$page = 1;
			        			}

				        		$count = 0;
				        		$query = "Select * from demands";
				        		$result = mysqli_query($connection, $query);
				        		$total_records = mysqli_num_rows($result);
				        		$limit = $page_length;
				        		$record_per_page = ceil($total_records / $limit);
				        		$offset = ($page - 1) * $limit;

				        		if ($page > $record_per_page || $page <= 0) {
				        			$page = 1;
				        	?>
				        			<script type="text/javascript">
		        						window.location = 'custom_pagination.php?page=<?php echo $page; ?>&page_length=<?php echo $page_length; ?>';
		        					</script>
				        	<?php
				        		}

				        		$query2 = "Select * from demands ORDER BY Id DESC LIMIT $offset,$limit ";
				        		$offset = $offset + 1; 
				        		$result2 = mysqli_query($connection, $query2);
				        		if(mysqli_num_rows($result2) > 0) {
				        			while($row = mysqli_fetch_assoc($result2)) {
				        				$demand_id = $row['Id'];
				        				$demandno = $row['demand_no'];
				        				$status = $row['status'];
				        	?>
				            <tr>
				                <td>
				                	<?php 
				                		echo $offset++;
				                	?>
				                </td>
				                <td>
				                	<?php 
				                		$demand_no = $row['demand_no'];
				                		echo $demand_no;
				                	?>		
				                </td>
				                <td> <?php echo $row['requester_name']; ?> </td>
				                <td> <?php echo $row['campus_name']; ?> </td>
				                <td>
				                	<?php 
				                		$team_name = $row['team_name'];
				                		echo ucwords($team_name); 
				                	?>
				                </td>
				                <td><?php echo ucfirst($row['status']); ?></td>
				            </tr>
				            <?php
				            		}
				        		}
				            ?>
				        </tbody>
				    </table>
	    		</div>

	    		<div style="margin-top: -12px;">
	    			<nav aria-label="Page navigation example">
					  	<ul class="pagination justify-content-end">
					  		<?php
					  			if ($page == 1) {
						    		$disabled = 'disabled';
						    		$first = '';
						    		$previous = '';
						    		$next = '';
						    		$last = '';
						    	} else {
						    		$disabled = '';
						    		$first = 'First';
						    		$previous = 'Previous';
						    		$next = 'Next';
						    		$last = 'Last';
						    	}
					  		?>
					  		<li class="page-item <?php echo $disabled; ?>" title="<?php echo $first; ?>">
						      	<a class="page-link" href="custom_pagination.php?page=1&page_length=<?php echo $page_length; ?>" aria-label="First">
						        	<span aria-hidden="true">&laquo;</span>
						        	<span class="sr-only">First</span>
						      	</a>
						    </li>
						    <li class="page-item <?php echo $disabled; ?>" title="<?php echo $previous; ?>">
						      	<a class="page-link" href="custom_pagination.php?page=<?php echo $page-1; ?>&page_length=<?php echo $page_length; ?>" aria-label="Previous">
						        	<span aria-hidden="true">&#8249;</span>
						        	<!-- <span aria-hidden="true">Previous</span> -->
						        	<span class="sr-only">Previous</span>
						      	</a>
						    </li>
						    <?php
						    	if ($page > 2) {
						    ?>
								    <li class="page-item disabled">
							      		<a class="page-link" href="" aria-label="Dots">
							        		<span aria-hidden="true">...</span>
							        		<span class="sr-only">Dots</span>
							      		</a>
							    	</li>
					    	<?php
						    	}
						    ?>
						    <?php
						    	if ($record_per_page > 3) {
						    		$start_range = $page;
							    	$end_range = $page + 2;
							    	if ($start_range > 1) {
							    		$start_range = $page - 1;
							    		$end_range = $page + 1;

							    	} 
							    	if ($page == $record_per_page) {
							    		$start_range = $page - 2;
							    		$end_range = $page;
							    	} 
						    	} else {
						    		$start_range = 1;
							    	$end_range = $record_per_page;
						    	}

						    	for ($i = $start_range; $i <= $end_range; $i++) {
						    		if ($i == $page) {
						    			$active = 'active';
						    		} else {
						    			$active = '';
						    		}
						    ?>
								    <li class="page-item <?php echo $active; ?>">
								    	<a class="page-link" href="custom_pagination.php?page=<?php echo $i; ?>&page_length=<?php echo $page_length; ?>">
								    		<?php
								    			echo $i;
								    		?>
								    	</a>
								    </li>
						    <?php
						    	}
						    	if ($page == $record_per_page) {
						    		$disabled = 'disabled';
						    		$first = '';
						    		$previous = '';
						    		$next = '';
						    		$last = '';
						    	} else {
						    		$disabled = '';
						    		$first = 'First';
						    		$previous = 'Previous';
						    		$next = 'Next';
						    		$last = 'Last';
						    	}
						    ?>
						    <?php
						    	if ($page < ($record_per_page - 1) ) {
						    ?>
								    <li class="page-item disabled">
							      		<a class="page-link" href="" aria-label="Dots">
							        		<span aria-hidden="true">...</span>
							        		<span class="sr-only">Dots</span>
							      		</a>
							    	</li>
					    	<?php
						    	}
						    ?>
						    <li class="page-item <?php echo $disabled; ?>" title="<?php echo $next; ?>">
					      		<a class="page-link" href="custom_pagination.php?page=<?php echo $page+1; ?>&page_length=<?php echo $page_length; ?>" aria-label="Next">
					        		<span aria-hidden="true">&#8250;</span>
					        		<!-- <span aria-hidden="true">Next</span> -->
					        		<span class="sr-only">Next</span>
					      		</a>
					    	</li>

					    	<li class="page-item <?php echo $disabled; ?>" title="<?php echo $last; ?>">
					      		<a class="page-link" href="custom_pagination.php?page=<?php echo $record_per_page; ?>&page_length=<?php echo $page_length; ?>" aria-label="Last">
					        		<span aria-hidden="true">&raquo;</span>
					        		<span class="sr-only">Last</span>
					      		</a>
					    	</li>
					  	</ul>
					</nav>
	    		</div>

	    		<!-- <button onclick="javascript:history.go(-1)" style="width: 120px; height: 32px; background: red; color: white; border: none; margin-top: 20px;"> Back </button> -->
	    	</div>
	    </div>
	    </div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/responsive-paginate.js?clear_cache=<?php echo time();?>"></script>
<script type="text/javascript">
	$(".page_length").change(function(){
		var page = '<?php echo $page; ?>';
		var page_length = $(this).val();
		window.location.href = Domain+"/custom_pagination.php?page="+page+"&page_length="+page_length;
	});


	$(".pagination").rPage();
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