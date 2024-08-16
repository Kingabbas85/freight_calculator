$(document).ready(function(){

	$(".overlay").hide();
	// DataTable End
	$('#clientsTable').DataTable({
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

	// Add Client Data
	$("#client_form").on("keyup",".client_name",function(e){
		e.preventDefault();
		$("#client_name").css("border","");
		$("#client_name").css("box-shadow","");
	});
	$("#client_form").on("keyup",".contact_name",function(e){
		e.preventDefault();
		$("#contact_name").css("border","");
		$("#contact_name").css("box-shadow","");
	});
	$("#client_form").on("keyup",".contact_no",function(e){
		e.preventDefault();
		$("#contact_no").css("border","");
		$("#contact_no").css("box-shadow","");
	});
	$("#client_form").on("click", ".activeCheckbox",function(e){
		if ($(this).is(':checked')) {
			$(this).val(1);
		} else {
			$(this).val(0);
		}
		$(".active").val($(this).val());
	});

	// Add Client
   $("#client_form").on("click", ".add_client", function(e) {
		e.preventDefault();
		$(".overlay").show();
		$(".overlay").hide();
		
		var isRequired = 0;
		if ($("#client_name").val() == "") {
        	$("#client_name").css("border","1px solid red");
			$("#client_name").css("box-shadow","0px 0px 5px 0px #F1948A");
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
				url : Domain+"/ajaxcallforclient.php",
				method : "POST",
				data : $("#client_form").serialize(),			
				success : function(response) {
					response = response.trim();
					console.log(response);
					if(response == 1) {
						swal({
						    text: "Client added successfully!",
						    icon: 'success',
						    button: "OK",
						}).then(function() {
						    window.location = "clients";
						});
					} else {
						swal({
						    text: "Some went wrong, please try again later",
						    icon: 'warning',
						    button: "OK",
						}).then(function() {
						    window.location = "clients";
						});
					}
				}
			});
		}
	});


	//Edit Vendor Link
   $("#clientsTable").on("click", ".edit", function(e) {
    	e.preventDefault();

		var tr = $(this).parent().parent();
		var editid = tr.find(".edit_id").val();
		window.location = "EditClient?id="+editid;
   });


   // Update Client Data
   $("#editclient_form").on("keyup",".client_name",function(e){
		e.preventDefault();
		$("#client_name").css("border","");
		$("#client_name").css("box-shadow","");
	});
	$("#editclient_form").on("keyup",".contact_name",function(e){
		e.preventDefault();
		$("#contact_name").css("border","");
		$("#contact_name").css("box-shadow","");
	});
	$("#editclient_form").on("keyup",".contact_no",function(e){
		e.preventDefault();
		$("#contact_no").css("border","");
		$("#contact_no").css("box-shadow","");
	});
	$("#editclient_form").on("click", ".activeCheckbox",function(e){
		
		if ($(this).is(':checked')) {
			$(this).val(1);
		} else {
			$(this).val(0);
		}
		$(".active").val($(this).val());
	});

	// Update Client
   $("#editclient_form").on("click", ".edit_client", function(e) {
    	e.preventDefault();

		$(".overlay").show();
		var isRequired = 0;
		if ($("#client_name").val() == "") {
        	$("#client_name").css("border","1px solid red");
			$("#client_name").css("box-shadow","0px 0px 5px 0px #F1948A");
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
				url : Domain+"/ajaxcallforclient.php",
				method : "POST",
				data : $("#editclient_form").serialize(),	
				success : function(response) {
					response = response.trim();
					console.log(response);
					if(response == 1) {
						$(".overlay").hide();
						swal({
							text: "Client updated successfully!",
							icon: 'success',
							button: "OK",
						}).then(function() {
							window.location = "clients";
						});
					} else {
						swal({
						    text: "Some went wrong, please try again later",
						    icon: 'warning',
						    button: "OK",
						}).then(function() {
							window.location = "clients";
						});
					}
				}
			});
		}
   });

});