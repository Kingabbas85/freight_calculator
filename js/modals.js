$(document).ready(function() {
	
	// CEO Approve Section
	$("#ceo_approval_modal").on("click",".only_po", function(e){
		
		if ($(this).is(':checked')) {
			$(".status").val("exclude");
		} else {
			$(".status").val("");
		}
	});
	$("#ceo_approval_modal").on("click",".submit", function(e){

		var id = $(".id").val();
		var po_number = $(".po_number").val();
		var demand_no = $(".demand_no").val();
		var quotation_no = $(".quotation_no").val();
		var selected_items =  $(".selected_items").val();	
		var canceled_items =  $(".canceled_items").val();	
		var remarks =  $(".approver_remarks").val();
		var status =  $(".status").val();
		var user_name =  $(".user_name").val();

		swal({
			text: "Do you want to approve selected items?",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((willDelete) => {
		  	if (willDelete) {
		  		$.ajax({
					url : Domain+"/po_approval_process.php",
					method : "POST",
					data : {
						isCeoApproved:1, 
						id : id,
						po_number : po_number,
						demand_no : demand_no,
						quotation_no : quotation_no,
						selected_items : selected_items, 
						canceled_items : canceled_items,
						remarks : remarks, 
						status : status,
						user_name : user_name,
					},
					success : function(response){
						console.log(response);
						if (response == 1) {
							$.ajax({
								type: "POST",
						    	url: Domain+"/PDF_PO_PRINTOUT.php?po_number="+id,
					    		success:function(response2){
					    			console.log(response2);
					    			if (response2 == 1) {
					    				swal({
											text: "Approved",
											icon: "success",
											buttons: "OK",
										}).then(function() {
											location.reload();
										});
					    			} else if (response2 == "NOT_SAVED") {
					    				swal({
											text: "File did not save!",
											icon: "warning",
											buttons: "OK",
										}).then(function() {
											location.reload();
										});
					    			} else {
										$(".overlay").hide();
										swal({
										    text: "Something went wrong, please try again later",
										    icon: 'warning',
										    button: "OK",
										}).then(function() {
											location.reload();
										});
					    			}
					    		}
							});
						} else {
							$(".overlay").hide();
							swal({
							    text: "Something went wrong, please try again later",
							    icon: 'warning',
							    button: "OK",
							}).then(function() {
								location.reload();
							});
						}
					}
				});	
		  	}
		})		
	});

	// // CEO On Hold Section
	// $("#ceo_hold_modal").on("click",".only_po", function(e){
		
	// 	if ($(this).is(':checked')) {
	// 		$(".status").val("exclude");
	// 	} else {
	// 		$(".status").val("");
	// 	}
	// });
	// $("#ceo_hold_modal").on("click",".submit", function(e){

	// 	var po_number = $(".po_number").val();
	// 	var demand_no = $(".demand_no").val();
	// 	var quotation_no = $(".quotation_no").val();
	// 	var product_ids =  $(".selected_items").val();	
	// 	var approval_items =  $(".approval_items").val();
	// 	var remarks = $(".on_hold_remarks").val();
	// 	var status = $(".status").val();
	
	// 	swal({
	// 		text: "Do you want to hold selected items?",
	// 		icon: "warning",
	// 		buttons: ["No", "Yes"],
	// 	}).then((willDelete) => {
	// 	  	if (willDelete) {

	// 	  		$.ajax({
	// 				url : Domain+"/po_approval_process.php",
	// 				method : "POST",
	// 				data : {
	// 					isCeoOnhold:1, 
	// 					po_number:po_number,
	// 					demand_no:demand_no,
	// 					quotation_no:quotation_no,
	// 					product_ids:product_ids,
	// 					approval_items:approval_items,
	// 					remarks:remarks,
	// 					status:status,
	// 				},
	// 				success : function(response){
	// 					console.log(response);
	// 					if (response == 1) {
	// 						$.ajax({
	// 							type: "POST",
	// 				    		url: Domain+"/PDF_PO_PRINTOUT.php?po_number="+po_number,
	// 				    		success:function(response2){
	// 				    			console.log(response2)
	// 				    			if (response2 == 1) {
	// 				    				swal({
	// 										text: "Approved",
	// 										icon: "success",
	// 										buttons: "OK",
	// 									}).then(function() {
	// 										location.reload();
	// 									});
	// 				    			}
	// 				    			if (response2 == "NOT_SAVED") {
	// 				    				swal({
	// 										text: "File did not save!",
	// 										icon: "warning",
	// 										buttons: "OK",
	// 									}).then(function() {
	// 										location.reload();
	// 									});
	// 				    			}
	// 				    		}
	// 						});
	// 					}
	// 					if (response == 2) {
	// 						swal({
	// 							text: "Approved",
	// 							icon: "success",
	// 							buttons: "OK",
	// 						}).then(function() {
	// 							location.reload();
	// 						});
	// 					}
	// 					if (response == "ERROR") {
	// 						$(".overlay").hide();
	// 						swal({
	// 						    text: "Something went wrong!",
	// 						    icon: 'warning',
	// 						    button: "OK",
	// 						}).then(function() {
	// 							location.reload();
	// 						});
	// 					}
	// 				}
	// 			});	
	// 	  	} else {

	// 	  	}
	// 	});
	// })

	// // CEO Cancel Section
	// $("#ceo_cancel_modal").on("click",".only_po", function(e){
	// 	// alert("clicked");
	// 	if ($(this).is(':checked')) {
	// 		$(".status").val("exclude");
	// 	} else {
	// 		$(".status").val("");
	// 	}
	// });
	// $("#ceo_cancel_modal").on("click",".submit", function(e){

	// 	var po_number = $(".po_number").val();
	// 	var demand_no = $(".demand_no").val();
	// 	var quotation_no = $(".quotation_no").val();
	// 	var remarks = $(".cancel_remarks").val();
	// 	var status = $(".status").val();
	// 	var product_ids = $(".selected_items").val();
		
	
	// 	swal({
	// 		text: "Do you want to cancel whole PO?",
	// 		icon: "warning",
	// 		buttons: ["No", "Yes"],
	// 	}).then((willDelete) => {
	// 	  	if (willDelete) {

	// 	  		$.ajax({
	// 				url : Domain+"/po_approval_process.php",
	// 				method : "POST",
	// 				data : {
	// 					isCeoCancel:1, 
	// 					po_number:po_number,
	// 					demand_no:demand_no,
	// 					quotation_no:quotation_no,
	// 					remarks:remarks,
	// 					status:status,
	// 					product_ids:product_ids,
						
	// 				},
	// 				success : function(response){
	// 					console.log(response);
	// 					if (response == 1) {
	// 						swal({
	// 							text: "Canceled",
	// 							icon: "success",
	// 							buttons: "OK",
	// 						}).then(function() {
	// 							location.reload();
	// 						});
	// 					}
	// 					if (response == "ERROR") {
	// 						$(".overlay").hide();
	// 						swal({
	// 						    text: "Something went wrong!",
	// 						    icon: 'warning',
	// 						    button: "OK",
	// 						}).then(function() {
	// 							location.reload();
	// 						});
	// 					}
	// 				}
	// 			});	
	// 	  	} else {

	// 	  	}
	// 	});
	// });


	// COO Approve Section
	$("#coo_approval_modal").on("click",".only_po", function(e){
		
		if ($(this).is(':checked')) {
			$(".coo_status").val("exclude");
		} else {
			$(".coo_status").val("");
		}
	});
	$("#coo_approval_modal").on("click",".submit",function(e){

		var id = $(".id").val();
		var po_number = $(".po_number").val();
		var demand_no = $(".demand_no").val();
		var quotation_no = $(".quotation_no").val();
		var selected_items =  $(".selected_items").val();
		var canceled_items =  $(".canceled_items").val();
		var remarks =  $(".coo_approver_remarks").val();
		var status =  $(".coo_status").val();
		var user_name =  $(".user_name").val();

		swal({
			text: "Do you want to approve selected items?",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((willDelete) => {
		  	if (willDelete) {
		  		$.ajax({
					url : Domain+"/po_approval_process.php",
					method : "POST",
					data : {
						isCooApproved:1, 
						id : id,
						po_number : po_number,
						demand_no : demand_no,
						quotation_no : quotation_no,
						selected_items : selected_items,
						canceled_items : canceled_items,
						remarks : remarks, 
						status : status, 
						user_name : user_name,
					},
					success : function(response){
						console.log(response);
						if (response == 1) {
							$.ajax({
								type: "POST",
						    	url: Domain+"/PDF_PO_PRINTOUT.php?po_number="+id,
					    		success:function(response2){
					    			console.log(response2);
					    			if (response2 == 1) {
					    				swal({
											text: "Approved",
											icon: "success",
											buttons: "OK",
										}).then(function() {
											location.reload();
										});
					    			} else if (response2 == "NOT_SAVED") {
					    				swal({
											text: "File did not save!",
											icon: "warning",
											buttons: "OK",
										}).then(function() {
											location.reload();
										});
					    			} else {
										$(".overlay").hide();
										swal({
										    text: "Something went wrong, please try again later",
										    icon: 'warning',
										    button: "OK",
										}).then(function() {
											location.reload();
										});
					    			}
					    		}
							});
						}
						if (response == "ERROR") {
							$(".overlay").hide();
							swal({
							    text: "Something went wrong, please try again later",
							    icon: 'warning',
							    button: "OK",
							}).then(function() {
								location.reload();
							});
						}
					}
				});
		  	}
		});
			
	})

	// COO On hold Section
	$("#coo_hold_modal").on("click",".submit",function(e){

		var id = $(".id").val();
		var po_number = $(".po_number").val();
		var demand_no = $(".demand_no").val();
		var quotation_no = $(".quotation_no").val();
		var selected_items =  $(".selected_items").val();	
		var approved_items =  $(".approved_items").val();
		var remarks = $(".coo_on_hold_remarks").val();
		var status = $(".coo_status").val();
		var user_name = $(".user_name").val();
	
		swal({
			text: "Do you want to hold selected items?",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((willDelete) => {
		  	if (willDelete) {

		  		$.ajax({
					url : Domain+"/po_approval_process.php",
					method : "POST",
					data : {
						isCooOnhold:1, 
						id:id,
						po_number:po_number,
						demand_no:demand_no,
						quotation_no:quotation_no,
						selected_items:selected_items,
						approved_items:approved_items,
						remarks:remarks,
						status:status,
						user_name:user_name,
					},
					success : function(response){
						console.log(response);
						if (response == 1) {
							$.ajax({
								type: "POST",
					    		url: Domain+"/PDF_PO_PRINTOUT.php?po_number="+id,
					    		success:function(response2){
					    			console.log(response2)
					    			if (response2 == 1) {
					    				swal({
											text: "Approved",
											icon: "success",
											buttons: "OK",
										}).then(function() {
											location.reload();
										});
					    			} else if (response2 == "NOT_SAVED") {
					    				swal({
											text: "File did not save!",
											icon: "warning",
											buttons: "OK",
										}).then(function() {
											location.reload();
										});
					    			} else {
										$(".overlay").hide();
										swal({
										    text: "Something went wrong, please try again later",
										    icon: 'warning',
										    button: "OK",
										}).then(function() {
											location.reload();
										});
					    			}
					    		}
							});
						} else {
							$(".overlay").hide();
							swal({
							    text: "Something went wrong, please try again later",
							    icon: 'warning',
							    button: "OK",
							}).then(function() {
								location.reload();
							});
						}
					}
				});	
		  	} else {

		  	}
		});
	})


	// COO Cancel Section
	$("#coo_cancel_modal").on("click",".only_po",function(e){
		
		if ($(this).is(':checked')) {
			$(".coo_status").val("exclude");
		} else {
			$(".coo_status").val("");
		}
	});
	$("#coo_cancel_modal").on("click",".submit",function(e){

		var id = $(".id").val();
		var po_number = $(".po_number").val();
		var demand_no = $(".demand_no").val();
		var quotation_no = $(".quotation_no").val();
		var status = $(".coo_status").val();
		var remarks = $(".coo_cancel_remarks").val();
		var selected_items = $(".selected_items").val();
		var filenamewithpath = $(".filenamewithpath").val();

		swal({
			text: "Do you want to cancel whole PO?",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((willDelete) => {
		  	if (willDelete) {

		  		$.ajax({
					url : Domain+"/po_approval_process.php",
					method : "POST",
					data : {
						isCooCancel:1, 
						id:id,
						po_number:po_number,
						demand_no:demand_no,
						quotation_no:quotation_no,
						status:status,
						remarks:remarks,
						selected_items:selected_items,
						filenamewithpath:filenamewithpath,
					},
					success : function(response){
						console.log(response);
						if (response == 1) {
							swal({
								text: "Canceled",
								icon: "success",
								buttons: "OK",
							}).then(function() {
								location.reload();
							});
						}
						if (response == "ERROR") {
							$(".overlay").hide();
							swal({
							    text: "Something went wrong, try again later",
							    icon: 'warning',
							    button: "OK",
							}).then(function() {
								location.reload();
							});
						}
					}
				});	
		  	} else {

		  	}
		});
	})
})