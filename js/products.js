$(document).ready(function() {
    
	$(".overlay").hide();
	// DataTable
   $('#productTable').DataTable({
    	"scrollX" : true,
    	"processing": true,
     	"ordering": true,
     	"lengthChange": true,
     	"lengthMenu": [10, 25, 100, 200],
     	"pageLength": 10,

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
	    }
   });

   $(window).resize(function(){
		paginationResize();
	});
	$(window).ready(function(){
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
	// DataTable End


	// Add Item Data
	$("#product_form").on("keyup",".product_name", function(e) {
		$("#product_name").css("border","");
		$("#product_name").css("box-shadow","");
		$("#specification").css("border","");
		$("#specification").css("box-shadow","");
	});
	$("#product_form").on("keyup",".specification", function(e) {
		$("#product_name").css("border","");
		$("#product_name").css("box-shadow","");
		$("#specification").css("border","");
		$("#specification").css("box-shadow","");
	});
	$("#product_form").on("focusin",".stock", function(e){
		var this_value = $(this).val();
		if (this_value == 0) {
			$(this).val("");
		}
	});
	$("#product_form").on("focusout",".stock", function(e){
		var this_value = $(this).val();
		if (this_value == "" || this_value == ".") {
			$(this).val(0);
			this_value = 0;
		}
		$(this).val(this_value * 1);
	});

	$("#product_form").on("change",".unit_of_measurement", function(e) {
		var uom = $(this).val();
		$(".uom").val(uom);

		$("#unit_of_measurement").css("border","");
		$("#unit_of_measurement").css("box-shadow","");
	});

	$("#product_form").on("focusin",".unit_price", function(e){
		if ($(this).val() == 0) {
			$(this).val("");
		}
	});
	$("#product_form").on("focusout",".unit_price", function(e){
		if ($(this).val() == "" || $(this).val() == ".") {
			$(this).val(0);
		} else {
			$(this).val( $(this).val()*1 );
		}
	});
	
	$("#product_form").on("change",".item_type_select", function(e) {
		var item_type = $(this).val();
		$(".item_type").val(item_type);

		$("#item_type_select").css("border","");
		$("#item_type_select").css("box-shadow","");
	});

	// Add Item
	$(".create_product").click(function(e) {
		e.preventDefault();
        
      var datetimestring = imsDateTimeString();
      $(".product_id").val(datetimestring);

     	var isRequired = 0;
      if ($("#product_name").val() == "") {
        	$("#product_name").css("border","1px solid red");
			$("#product_name").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }
      if ($("#uom").val() == "") {
        	$("#unit_of_measurement").css("border","1px solid red");
			$("#unit_of_measurement").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }
      if ($("#item_type").val() == "") {
        	$("#item_type_select").css("border","1px solid red");
			$("#item_type_select").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }

      if (isRequired) {
      	swal({
			   text: "* fields are mandatory",
			   icon: 'warning',
			   button: "OK",
			});
      } else {

	      $.ajax({
				url : Domain+"/ajaxcallforproduct.php",
				method : "POST",
				data : $("#product_form").serialize(),	
				success : function(response) {
					response = response.trim();
					console.log(response);
					if (response == "ALREADY_EXISTS") {
						alert("Item is already exists");
						$("#product_name").css("border","1px solid red");
						$("#product_name").css("box-shadow","0px 0px 5px 0px #F1948A");
						$("#specification").css("border","1px solid red");
						$("#specification").css("box-shadow","0px 0px 5px 0px #F1948A");
					} else {
						if(response == 1) {
							swal({
							   text: "Product added successfully!",
							   icon: "success",
							   button: "OK",
							}).then(function() {
							   window.location = "items.php";
							});
						} else {
							swal({
							   text: "Something went wrong, please try again later",
							   icon: 'warning',
							   button: "OK",
							}).then(function() {
							   location.reload();
							});
						}
					}
				}
			});
      }
	});	


	// Edit Item Link
	$("#productTable").delegate(".edit", "click", function(e) {
		e.preventDefault();

		var tr = $(this).parent().parent();
		var editid = tr.find(".editid").val();
		window.location = "EditItem.php?id="+editid;
	});


	// Update Item Data
	$("#editproduct_form").on("keyup",".product_name", function(e) {
		$("#product_name").css("border","");
		$("#product_name").css("box-shadow","");
		$("#specification").css("border","");
		$("#specification").css("box-shadow","");
	});
	$("#editproduct_form").on("keyup",".specification", function(e) {
		$("#product_name").css("border","");
		$("#product_name").css("box-shadow","");
		$("#specification").css("border","");
		$("#specification").css("box-shadow","");
	});
	$("#editproduct_form").on("focusin",".stock", function(e){
		var this_value = $(this).val();
		if (this_value == 0) {
			$(this).val("");
		}
	});
	$("#editproduct_form").on("focusout",".stock", function(e){
		var this_value = $(this).val();
		if (this_value == "" || this_value == ".") {
			$(this).val(0);
			this_value = 0;
		}
		$(this).val(this_value * 1);
	});

	$("#editproduct_form").on("change",".unit_of_measurement", function(e) {
		var uom = $(this).val();
		$(".uom").val(uom);

		$("#unit_of_measurement").css("border","");
		$("#unit_of_measurement").css("box-shadow","");
	});

	$("#editproduct_form").on("focusin",".unit_price", function(e){
		if ($(this).val() == 0) {
			$(this).val("");
		}
	});
	$("#editproduct_form").on("focusout",".unit_price", function(e){
		if ($(this).val() == "" || $(this).val() == ".") {
			$(this).val(0);
		} else {
			$(this).val( $(this).val()*1 );
		}
	});
	
	$("#editproduct_form").on("change",".item_type_select", function(e) {
		var item_type = $(this).val();
		$(".item_type").val(item_type);

		$("#item_type_select").css("border","");
		$("#item_type_select").css("box-shadow","");
	});

	// Update Product
	$(".update_product").click(function(e){
		e.preventDefault();
        	
     	// var editid = $("#editid").val();
     	var isRequired = 0;
      if ($("#product_name").val() == "") {
        	$("#product_name").css("border","1px solid red");
			$("#product_name").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }
      if ($("#uom").val() == "") {
        	$("#unit_of_measurement").css("border","1px solid red");
			$("#unit_of_measurement").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }
      if ($("#item_type").val() == "") {
        	$("#item_type_select").css("border","1px solid red");
			$("#item_type_select").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }

      if (isRequired) {
      	swal({
			   text: "* fields are mandatory",
			   icon: 'warning',
			   button: "OK",
			});
      } else {
      	 $.ajax({
				url : Domain+"/ajaxcallforproduct.php",
				method : "POST",
				data : $("#editproduct_form").serialize(),	
				success : function(response) {
					response = response.trim();
					console.log(response);

					if (response == "ALREADY_EXISTS") {
						alert("Item is already exists");
						$("#product_name").css("border","1px solid red");
						$("#product_name").css("box-shadow","0px 0px 5px 0px #F1948A");
						$("#specification").css("border","1px solid red");
						$("#specification").css("box-shadow","0px 0px 5px 0px #F1948A");
					} else {
						if(response == 1) {
							swal({
							   text: "Product updated successfully!",
							   icon: "success",
							   button: "OK",
							}).then(function() {
							   window.location = "items.php";
							});
						} else {
							swal({
							   text: "Something went wrong, please try again later",
							   icon: 'warning',
							   button: "OK",
							}).then(function() {
							   location.reload();
							});
						}
					}
				}
			});
      }
	});	

	// // Delete Item from Items List
	// $("#productTable").on("click",".delete", function(e){
	// 	e.preventDefault();
	// 	var deleteid = $(this).closest("tr").find(".delete_id").val();

	// 	swal({
	// 		title: "Are you sure?",
	// 		text: "Once deleted, you will not be able to recover this!",
	// 		icon: "warning",
	// 		buttons: ["No", "Delete"],
	// 		dangerMode: true,
	// 	})
	// 	.then((willDelete) => {
	// 	  	if (willDelete) {
	// 		    	$.ajax({
	// 		    		type:"POST",
	// 		    		url:"../templates/action.php",
	// 		    		data:{
	// 		    			"product_delete_btn":1,
	// 		    			"deleteid":deleteid,
	// 		    		},
	// 		    		success:function(response){
	// 		    			swal("Product deleted!", {
	// 				      	icon: "success",
	// 				    	}).then(function() {
	// 						location.reload();
	// 					});
	// 		    		}
	// 		    	});	
	// 	  	} else {
	// 	    		// swal("Your imaginary file is safe!");
	// 	  	}
	// 	});
	// });
});