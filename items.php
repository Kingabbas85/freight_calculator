<?php
	include_once('database/database.php');
	include_once("includes/session.php");
	if($_SESSION['user_email'] == true) {
		
		if ($_SESSION['user_role'] == "admin") {
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<title>IMS - Items</title>
		<style>
			/* a:hover {
				text-decoration: none !important;
			}
			#add_to_quote i {
				width: 30px !important;
				height: 30px !important;
				border: 1px solid #154360 !important;
				color: #154360;
				padding-top: 8px !important;
			}
			#add_to_quote i:hover {
				background: #154360 !important;
				color: white;
			} */

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
				<div id="product_layout">

					<div id="page_heading" class="row d-flex justify-content-between">
						<div> Items </div>
						<div id="add_new">
							<a href="NewItem"> <i class="fa fa-plus"></i>&nbsp; New Item </a>
						</div>
					</div>
					<div id="margin_div"></div>

					<div id="table_layout_updated">
						<table id="productTable" class="table table-sm table-striped table-hover w-100 table_style" style="min-width: 920px;">
							<thead>
								<tr class="text-left">
									<th width="40"> # </th>
									<th width="200"> Item </th>
									<th width="300"> Specification </th>
									<th width="100px"> Quantity </th>
									<th width="100px"> UOM </th>
									<th width="100px"> Price </th>
									<th width="60px"> Action </th>
								</tr>
							</thead>
							<tbody>
								<?php
								$counter = 1;
								$query = "Select * FROM products ORDER By description, specification ASC";
								$result = mysqli_query($connection, $query);
								if(mysqli_num_rows($result)) {
									while($row = mysqli_fetch_assoc($result)) {
										$id = $row['Id'];
										$product_id = $row['product_sku'];
										$description = ucfirst($row['description']);
										$specification = ucfirst($row['specification']);
										$stock = $row['stock'];
										$uom = $row['uom'];
										$price = $row['price'];
										$location = $row['location'];
								?>
										<tr>
											<td> 
												<?php echo $counter++; ?>
												<input type="hidden" class="id" value="<?php echo $id; ?>">
												<input type="hidden" class="hidden_description" value="<?php echo $description; ?>">
												<input type="hidden" class="hidden_specification" value="<?php echo $specification; ?>">
											</td>
											<td> <?php echo $description; ?> </td>
											<td> <?php echo $specification; ?> </td>
											<td> <?php echo $stock; ?> </td>
											<td> <?php echo $uom; ?> </td>
											<td> <?php echo $price; ?> </td>
											<td class="text-center">
												<input type="hidden" class="editid" value="<?php echo md5($id); ?>">
												<a href="javascript:void(0)" class="edit">
													<i class="fa fa-edit"></i>
												</a>												
			        						</td>
			        					</tr>
					        	<?php
						        		}
						      	}
			        			?>
			    			</tbody>
						</table>
					</div>

					<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ItemModal">
					  	Launch demo modal
					</button> -->
					<div class="modal fade" id="ItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					 	<div class="modal-dialog">
						   <div class="modal-content">
				      		<div class="modal-header">
						        	<h5 class="modal-title" id="addToQuoteModalLabel">Add to quote</h5>
						        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						         	<span aria-hidden="true">&times;</span>
						        	</button>
					     	 	</div>
				      		<div class="modal-body" style="padding:12px 0px !important">
									<form id="add_to_quote_form">
										<input type="hidden" class="row_id" value="">
						       		<div class="col-md-12 mt-1">
											<span class="font-weight-light">
												<strong> Description: </strong>
											</span>
											<input type="" class="form-control form-control-sm description" readonly>
										</div>
										<div class="col-md-12 mt-1">
											<span class="font-weight-light">
												<strong> Specification: </strong>
											</span>
											<input type="" class="form-control form-control-sm specification" readonly>
										</div>
										<div class="col-md-12 mt-1">
											<span class="font-weight-light">
												<strong> Quantity:<i class="text-danger">*</i> </strong>
											</span>
											<input type="" class="form-control form-control-sm item_qty" value="0" oninput="<?php echo $onlyNumeric; ?>" maxlength="12">
										</div>
									</form>
					      	</div>
					      	<div style="padding:0px 12px 12px;" class="text-right pr-3">
								<button type="button" class="btn btn-sm save" style="width:80px; background: #154360; color: white;">Add</button>
					      	</div>
				    		</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
		<div id="bottom_layout"></div>
	</body>
</html>
<script type="text/javascript" src="js/products.js?clear_cache=<?php echo time();?>"></script>
<script type="text/javascript">
	document.getElementById("productTable").style.borderBottom = "1px solid #D0D3D4";

	
	$("#productTable").delegate("#add_to_quote", "click", function(e) {
		var tr = $(this).parent().parent();
		var id = tr.find(".id").val();
		var description = tr.find(".hidden_description").val();
		var specification = tr.find(".hidden_specification").val();

		$("#ItemModal").modal('show');
		$(".row_id").val(id);
		$(".description").val(description);
		$(".specification").val(specification);
		$(".item_qty").val(0);
		$(".item_qty").css("border","");
		$(".item_qty").css("box-shadow","");
	});


	
	$("#ItemModal").on("focusin", ".item_qty", function(e) {

		var item_qty = $(this).val();
		if (item_qty == "" || item_qty == 0) {
			$(".item_qty").val("");
		}
	});
	$("#ItemModal").on("focusout", ".item_qty", function(e) {

		var item_qty = $(this).val();
		if (item_qty == ".") {
			item_qty = 0;
		}
		item_qty = item_qty*1;
		$(".item_qty").val(item_qty);
	});
	$("#ItemModal").on("keyup", ".item_qty", function(e) {
		
		$(".item_qty").css("border","");
		$(".item_qty").css("box-shadow","");
	});

	$("#ItemModal").on("click", ".save", function(e) {
		
		isRequired = 0;
		var row_id = $("#add_to_quote_form .row_id").val();
		var item_qty = $("#add_to_quote_form .item_qty").val();

		if (item_qty == 0) {
			isRequired++;
			$(".item_qty").css("border","1px solid red");
			$(".item_qty").css("box-shadow","0px 0px 5px 0px #F1948A");
		}

		if (isRequired) {

		} else {
			if (isRequired) {

			} else {
				$.ajax({
					url : Domain+"/ajaxforquotation.php",
					method : "POST",
					data : {
						addToQuote:1,
						row_id:row_id,
						item_qty:item_qty,
					},
					success : function(response) {
						response = response.trim();
						// console.log(response);
						
						$("#ItemModal").modal('hide');
						$(".item_qty").val(0);
						if (response == 1) {
							swal({
							    text: "Item added",
							    icon: "success",
							    button: "OK",
							});
						} else {
							swal({
							   text: "Something went wrong, please try again later",
							   icon: "warning",
							   button: "OK",
							});
						}
						// $("#add_to_quote_form .item_qty").val(0);
					}
				});
			}
		}
	});
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