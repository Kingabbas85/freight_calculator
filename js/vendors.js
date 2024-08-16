$(document).ready(function(){

	$(".overlay").hide();
	// DataTable
   $('#vendorTable').DataTable({
    	"scrollX" : true,
    	"processing": true,
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


	// Add Vendor Data
   $("#vendor_form").on("keyup",".vendor_name",function(e){
		e.preventDefault();
		$("#vendor_name").css("border","");
		$("#vendor_name").css("box-shadow","");
	});
	$("#vendor_form").on("keyup",".contact_name",function(e){
		e.preventDefault();
		$("#contact_name").css("border","");
		$("#contact_name").css("box-shadow","");
	});
	$("#vendor_form").on("keyup",".contact_no",function(e){
		e.preventDefault();
		$("#contact_no").css("border","");
		$("#contact_no").css("box-shadow","");
	});
	$("#vendor_form").on("keyup",".country",function(e){
		e.preventDefault();
		$("#country").css("border","");
		$("#country").css("box-shadow","");
	});
	$("#vendor_form").on("click", ".activeCheckbox",function(e){
		if ($(this).is(':checked')) {
			$(this).val(1);
		} else {
			$(this).val(0);
		}
		$(".active").val($(this).val());
	});

	// Add Vendor
   $("#vendor_form").on("click", ".add_vendor", function(e) {
		e.preventDefault();
		$(".overlay").show();
		
		var isRequired = 0;
		if ($("#vendor_name").val() == "") {
        	$("#vendor_name").css("border","1px solid red");
			$("#vendor_name").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }
      if ($("#contact_name").val() == "") {
        	$("#contact_name").css("border","1px solid red");
			$("#contact_name").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }
      if ($("#contact_no").val() == "") {
        	$("#contact_no").css("border","1px solid red");
			$("#contact_no").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }

      if (isRequired) {
			swal({
			    text: "* feilds are mandatory!",
			    icon: 'warning',
			    button: "OK",
			}).then(function() {
			   $(".overlay").hide();
			});
      } else {
			$.ajax({
				url : Domain+"/ajaxcallforvendor.php",
				method : "POST",
				data : $("#vendor_form").serialize(),			
				success : function(response) {
					response = response.trim();
					console.log(response);
					if(response == 1) {
						swal({
						    text: "Vendor added successfully!",
						    icon: 'success',
						    button: "OK",
						}).then(function() {
						    window.location = "vendors";
						});
					} else if (response == "ALREADY_EXISTS") {
						swal({
						    text: "Vendor has already exists!",
						    icon: 'warning',
						    button: "OK",
						}).then(function() {
							$("#vendor_name").css("border","1px solid red");
							$("#vendor_name").css("box-shadow","0px 0px 5px 0px #F1948A");
							$(".overlay").hide();
						});
					} else {
						swal({
						    text: "Some went wrong, please try again later",
						    icon: 'warning',
						    button: "OK",
						}).then(function() {
						    window.location = "vendors";
						});
					}
				}
			});
		}
	});


    //Edit Vendor Link
   $("#vendorTable").on("click", ".edit", function(e) {
    	e.preventDefault();

		var tr = $(this).parent().parent();
		var editid = tr.find(".edit_id").val();
		window.location = "EditVendor?id="+editid;
   });

   
   // Update Vendor Data
   $("#editvendor_form").on("keyup",".vendor_name",function(e){
		e.preventDefault();
		$("#vendor_name").css("border","");
		$("#vendor_name").css("box-shadow","");
	});
	$("#editvendor_form").on("keyup",".contact_name",function(e){
		e.preventDefault();
		$("#contact_name").css("border","");
		$("#contact_name").css("box-shadow","");
	});
	$("#editvendor_form").on("keyup",".contact_no",function(e){
		e.preventDefault();
		$("#contact_no").css("border","");
		$("#contact_no").css("box-shadow","");
	});
	$("#editvendor_form").on("keyup",".country",function(e){
		e.preventDefault();
		$("#country").css("border","");
		$("#country").css("box-shadow","");
	});
	$("#editvendor_form").on("click", ".activeCheckbox",function(e){
		
		if ($(this).is(':checked')) {
			$(this).val(1);
		} else {
			$(this).val(0);
		}
		$(".active").val($(this).val());
	});

	// Update Vendor
   $("#editvendor_form").on("click", ".edit_vendor", function(e) {
    	e.preventDefault();

		$(".overlay").show();
		var isRequired = 0;
		if ($("#vendor_name").val() == "") {
        	$("#vendor_name").css("border","1px solid red");
			$("#vendor_name").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }
      if ($("#contact_name").val() == "") {
        	$("#contact_name").css("border","1px solid red");
			$("#contact_name").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }
      if ($("#contact_no").val() == "") {
        	$("#contact_no").css("border","1px solid red");
			$("#contact_no").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
      }

      if (isRequired) {
			swal({
			    text: "* feilds are mandatory!",
			    icon: 'warning',
			    button: "Ok",
			}).then(function() {
      		$(".overlay").hide();
			});
      } else {

        	$.ajax({
				url : Domain+"/ajaxcallforvendor.php",
				method : "POST",
				data : $("#editvendor_form").serialize(),	
				success : function(response) {
					response = response.trim();
					console.log(response);
					if(response == 1) {
						$(".overlay").hide();
						swal({
							text: "Vendor updated successfully!",
							icon: 'success',
							button: "OK",
						}).then(function() {
							window.location = "vendors";
						});
					} else if (response == "ALREADY_EXISTS") {
						swal({
						    text: "Vendor has already exists!",
						    icon: 'warning',
						    button: "OK",
						}).then(function() {
							$("#vendor_name").css("border","1px solid red");
							$("#vendor_name").css("box-shadow","0px 0px 5px 0px #F1948A");
							$(".overlay").hide();
						});
					} else {
						swal({
						    text: "Some went wrong, please try again later",
						    icon: 'warning',
						    button: "OK",
						}).then(function() {
							window.location = "vendors";
						});
					}
				}
			});
		}
   });

   // // Delete Vendor
   // $("#vendorTable").on("click", ".delete", function(e) {
   //  	e.preventDefault();

   //  	var deleteid = $(this).closest("tr").find(".delete_id").val();
   //  	swal({
	// 		title: "Are you sure?",
	// 		text: "Once deleted, you will not be able to recover this!",
	// 		icon: "warning",
	// 		buttons: ["No", "Delete"],
	// 		dangerMode: true,
	// 	}).then((willDelete) => {
	// 		if (willDelete) {
	// 	    	$.ajax({
	// 	    		type:"POST",
	// 	    		url:"action.php",
	// 	    		data:{
	// 	    			"vendor_delete_btn":1,
	// 	    			"deleteid":deleteid,
	// 	    		},
	// 	    		success:function(response){
	// 	    			// alert(response);
	// 	    			swal("Vendor deleted!", {
	// 			      		icon: "success",
	// 			    	}).then(function() {
	// 					    location.reload();
	// 					});
	// 	    		}
	// 	    	});	
	// 		} else {
	// 		    // swal("Your imaginary file is safe!");
	// 		}
	// 	});
   // })
});