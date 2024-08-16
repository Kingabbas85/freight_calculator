
<div class="modal fade" id="LoadItemsInModal" tabindex="-1" aria-labelledby="LoadItemsInModal" aria-hidden="true">
 	<div class="modal-dialog modal-dialog-scrollable modal-xl">
	   <div class="modal-content">
   		<div class="modal-header">
	        	<h6 class="modal-title" id="LoadItemsInModalLabel" style="font-size: 24px;">Items</h6>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	         	<span aria-hidden="true">&times;</span>
	        	</button>
     	 	</div>
   		<div class="modal-body" style="padding:15px 15px 0px 15px !important;">
				<div id="table_layout_updated">
					<table id="ItemsTable" class="table-sm table-striped table-hover w-100 table_style" style="min-width: 1000px;">
						<thead>
							<tr class="text-left">
								<th width="40px"> </th>
								<th width="40px"> # </th>
								<th width="200px"> Item Name </th>
								<th width="300px"> Specification </th>
								<th width="100px"> Quantity </th>
								<th width="100px"> UOM </th>
								<th width="100px"> Price </th>
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
										<!-- <td class="text-center"> <i class="fa fa-plus"></i> </td> -->
										<td class="text-center align-middle">
		        							<a href="javascript:void(0)" id="add_to_quote">
												<i class="fa fa-plus align-middle"></i>
											</a>
		        						</td>
										<td> 
											<?php echo $counter++; ?>
											<input type="hidden" class="hidden_id" value="<?php echo $id; ?>">
											<input type="hidden" class="hidden_description" value="<?php echo $description; ?>">
											<input type="hidden" class="hidden_specification" value="<?php echo $specification; ?>">
										</td>
										<td> <?php echo $description; ?> </td>
										<td> <?php echo $specification; ?> </td>
										<td> <?php echo $stock; ?> </td>
										<td> <?php echo $uom; ?> </td>
										<td> <?php echo $price; ?> </td>
		        					</tr>
				        	<?php
					        		}
					      	}
		        			?>
		    			</tbody>
					</table>
				</div>
      	</div>
      	<div style="padding-top:15px;" class="text-right"></div>
 		</div>
  	</div>
</div>


<div class="modal fade" id="SelectItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog">
	   <div class="modal-content">
   		<div class="modal-header">
	        	<h5 class="modal-title" id="addToQuoteModalLabel">Add to quote</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	         	<span aria-hidden="true">&times;</span>
	        	</button>
     	 	</div>
   		<div class="modal-body" style="padding:12px 0px !important">
				<div id="add_to_quote_form">
					<!-- <input type="" class="row_id" value=""> -->
	       		<div class="col-md-12 mt-1">
						<span class="font-weight-light">
							<strong> Description: </strong>
						</span>
						<input type="hidden" class="id">
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
				</div>
      	</div>
      	<div style="padding:0px 12px 12px;" class="text-right pr-3">
			<button type="button" class="btn btn-sm save">Add</button>
      	</div>
 		</div>
  	</div>
</div>

<script type="text/javascript">
	
	document.getElementById("ItemsTable").style.borderBottom = "1px solid #D0D3D4";

	$('#ItemsTable').DataTable({
		// "scrollX": true,
		"scrollCollapse": true,
		"processing": true,
		"lengthChange": false,
		"lengthMenu": [10, 25, 100, 200],
		"pageLength": 50,
		"searching": true,
		"ordering": true,
		"info": true,
		"paging": true,

		"language": {
			paginate: {
				previous: '&laquo;', // or '<<' 
				next: '&raquo;', // or '>>'
			}
		},
		"drawCallback": function () {
			var width = $(window).width();
			if (width < 520) {
				$('.dataTables_paginate > .pagination').addClass('pagination-sm')
			} else {
				$('.dataTables_paginate > .pagination').removeClass('pagination-sm')
			}
		},
	});

	// Add pagination-sm class
	$(window).resize(function () {
		paginationResize();
	});
	$(window).ready(function () {
		paginationResize();
	})
	function paginationResize() {
		var width = $(window).width();
		if (width < 520) {
			$(".pagination").addClass("pagination-sm");
		} else {
			$(".pagination").removeClass("pagination-sm");
		}
	}


	$("#LoadItemsInModal").delegate("#add_to_quote", "click", function(e) {
		
		var tr = $(this).parent().parent();
		var id = tr.find(".hidden_id").val();
		var description = tr.find(".hidden_description").val();
		var specification = tr.find(".hidden_specification").val();

		$("#SelectItemModal").modal('show');
		$("#SelectItemModal .id").val(id);
		$("#SelectItemModal .description").val(description);
		$("#SelectItemModal .specification").val(specification);
		$(".item_qty").val(0);
		$(".item_qty").css("border","");
		$(".item_qty").css("box-shadow","");
	});

	$("#SelectItemModal").on("focusin", ".item_qty", function(e) {

		var item_qty = $(this).val();
		if (item_qty == "" || item_qty == 0) {
			$(".item_qty").val("");
		}
	});
	$("#SelectItemModal").on("focusout", ".item_qty", function(e) {

		var item_qty = $(this).val();
		if (item_qty == ".") {
			item_qty = 0;
		}
		item_qty = item_qty*1;
		$(".item_qty").val(item_qty);
	});
	$("#SelectItemModal").on("keyup", ".item_qty", function(e) {
		
		$(".item_qty").css("border","");
		$(".item_qty").css("box-shadow","");
	});

	$("#SelectItemModal").on("click", ".save", function(e) {
		
		isRequired = 0;
		var id = $("#SelectItemModal .id").val();
		var item_qty = $("#SelectItemModal .item_qty").val();

		if (item_qty == 0) {
			isRequired++;
			$(".item_qty").css("border","1px solid red");
			$(".item_qty").css("box-shadow","0px 0px 5px 0px #F1948A");
		}
		// console.log(isRequired);

		if (isRequired) {

		} else {
			if (isRequired) {

			} else {
				$.ajax({
					url : Domain+"/ajaxcallforquotation.php",
					method : "POST",
					data : {
						addToQuote:1,
						id:id,
						item_qty:item_qty,
					},
					success : function(response) {
						response = response.trim();
						// console.log(JSON.parse(response));
						// console.log(response);

						var updated_response = response.split("[sprsprsprspr]");
						// console.log(updated_response[0]);

						if (updated_response[0] == 1) {
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
						
						var empty_check = 0;
						$(".product_id").map(function(){
							var product_id = $(this).val();
							// console.log(product_id);
							if (product_id == "") {
								empty_check++;
							}
						});
						if (empty_check) {
							$('#quotation_items').children("tr:eq(1)").remove();
						}

						$("#quotation_items").append(response);
						$("#SelectItemModal").modal('hide');
						$("#SelectItemModal .item_qty").val(0);

						// Update the rows counter
						var counter = 1;
						$(".numbers_counter").map(function(){
							$(this).text(counter);
							counter++;

							// var tr = $(this).parent().parent();
							// var new_description = tr.find(".product_id").val();
							// console.log(new_description);
						});
						
					}
				});
			}
		}
	});

</script>