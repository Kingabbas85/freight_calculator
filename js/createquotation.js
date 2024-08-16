$(document).ready(function(){
	
	$(".overlay").hide();
	var removeCounter = 0;

	var isOnlyOneRow = $('.cntr').val();
	if (isOnlyOneRow == 1) {
	  	$(".remove_row").css("pointer-events", "none");
	} else {
  		$(".remove_row").css("pointer-events", "auto");
  	}

	// Add New Row Function
	function addNewRow() {

		var counter = $('.cntr').val();
		counter = parseInt(counter);
		counter = counter + 1;

		$.ajax({
			url : Domain+"/process.php",
			method : "POST",
			data : {getNewRow:1, count:counter},

			success : function(data){
				// console.log(data);
				$('#quotation_items').append( data );
				// $(".autoComplete").hide();
			}
		});

		removeCounter += 1;
		if (removeCounter == 1) {
			$(".removeRow").prop("disabled", true);
			$(".remove_row").css("pointer-events", "none");
		} else {
			$(".removeRow").prop("disabled", false);
			$(".remove_row").css("pointer-events", "auto");
		}

		if (counter > 1) {
			// $('.localImportButton').prop('disabled', true);
		}
		$('.cntr').val(counter);
	}
	// Add New Row

	var isDraft = $('.cntr').val();
	if ( isDraft == 0 ) {
		addNewRow();
	} else {
		// $(".autoComplete").hide();
	}
	$("#quotation_form").on("click",".addRow",function(e){
    	e.preventDefault();
		addNewRow();
	});

	// Remove Existing Row
	$("#quotation_form").on("click",".removeRow",function(e){
    	e.preventDefault();
    	
    	var counter = $('.cntr').val();
    	var strconfirm = confirm("Are you sure you want to delete?");
	   if (strconfirm == true) {
	      $('#quotation_items').children("tr:last").remove();
	      counter = counter - 1;
			removeCounter -= 1;
	   }
		
		if (removeCounter == 1) {
			$(".removeRow").prop("disabled", true);
			$(".remove_row").css("pointer-events", "none");
		}

		$('.cntr').val(counter);
		if (counter == 1) {
			$('.localImportButton').prop('disabled', false);
		}
		saveDraft();
	});


	
	$("#quotation_form").on("change", ".client_id", function() {
		$("#client_id").css("border","");
		$("#client_id").css("box-shadow","");
		saveDraft();
	});
	$("#quotation_form").on("change", ".payment_mode", function() {
		$("#payment_mode").css("border","");
		$("#payment_mode").css("box-shadow","");
		saveDraft();
	});
	$("#quotation_form").on("change", ".credit_terms", function() {
		$("#credit_terms").css("border","");
		$("#credit_terms").css("box-shadow","");
		saveDraft();
	});

	// $("#quotation_form").delegate(".description", "keyup", function(e) {

	// 	var description = $(this).val();
	// 	var tr = $(this).parent().parent();

	// 	var product_id = imsDateTimeString();
	// 	tr.find(".product_id").val(product_id);

	// 	tr.find(".description").css("border","");
	// 	tr.find(".description").css("box-shadow","");
	// 	saveDraft();
	// });
	// $("#quotation_form").delegate(".specification", "keyup", function() {
		
	// 	var specification = $(this).val();
	// 	var tr = $(this).parent().parent();

	// 	var product_id = imsDateTimeString();
	// 	tr.find(".product_id").val(product_id);

	// 	saveDraft();
	// });

	$("#quotation_form").delegate(".qty", "focusin", function() {

		var tr = $(this).parent().parent();
		var qty = $(this).val()
		if (qty == "" || qty == 0) {
			tr.find(".qty").val("");
		}
	});
	$("#quotation_form").delegate(".qty", "focusout", function() {

		var tr = $(this).parent().parent();
		var qty = $(this).val()
		if (qty == ".") {
			qty = 0;
		}
		qty = qty*1;
		tr.find(".qty").val(qty);
	});
	$("#quotation_form").delegate(".qty", "keyup", function() {

		var tr = $(this).parent().parent();
		var unit_price = tr.find(".unit_price").val();
		if (unit_price == "") {
			unit_price = 0;
		}
		unit_price = parseFloat(unit_price);

		var qty = $(this).val();
		if (qty == "." || qty == "") {
			qty = 0;
		}
		qty = parseFloat(qty);
		saveDraft();

		tr.find(".total").val(qty*unit_price);

		tr.find(".qty").css("border","");
		tr.find(".qty").css("box-shadow","");
		calculate();
	});
	$("#quotation_form").delegate(".unit_of_measurement", "change", function() {
		var uom = $(this).val();
		var tr = $(this).parent().parent();
		tr.find(".uom").val(uom);

		tr.find(".unit_of_measurement").css("border","");
		tr.find(".unit_of_measurement").css("box-shadow","");
		saveDraft();
	});
	$("#quotation_form").delegate(".unit_price", "focusin", function() {
		
		if ($(this).val() == 0) {
			$(this).val("");
		}
	});
	$("#quotation_form").delegate(".unit_price", "focusout", function() {

		var tr = $(this).parent().parent();
		var unit_price = $(this).val();
		if (unit_price == "." || unit_price == "") {
			unit_price = 0;
		}
		unit_price = parseFloat(unit_price);
		$(this).val(unit_price);
	})
	$("#quotation_form").delegate(".unit_price", "keyup", function() {
		
		var tr = $(this).parent().parent();
		var qty = tr.find(".qty").val();
		if (qty == "") {
			qty = 0;
		}
		qty = parseFloat(qty);

		var unit_price = $(this).val();
		if (unit_price == "." || unit_price == "") {
			unit_price = 0;
		}
		unit_price = parseFloat(unit_price);
		saveDraft();

		tr.find(".total").val(qty*unit_price);

		tr.find(".unit_price").css("border","");
		tr.find(".unit_price").css("box-shadow","");
		calculate();
	});
	$("#quotation_form").on("keyup",".additional_note", function(e) {
		saveDraft();
	});

	$("#quotation_form").on("focusin",".tax", function(e) {
		var tax = $(this).val();
		if (tax == 0) {
			$(this).val("");
		}
	});
	$("#quotation_form").on("focusout",".tax", function(e) {
		var tax = $(this).val();
		if (tax == "." || tax == "") {
			tax = 0;
		}
		tax = parseFloat(tax);
		$(this).val(tax);
	});
	$("#quotation_form").on("keyup",".tax", function(e) {
		calculate();
		saveDraft();
	});
	$("#quotation_form").on("focusin",".discount", function(e) {
		var discount = $(this).val();
		if (discount == 0) {
			$(this).val("");
		}
	});
	$("#quotation_form").on("focusout",".discount", function(e) {
		var discount = $(this).val();
		if (discount == "." || discount == "") {
			discount = 0;
		}
		discount = parseFloat(discount);
		$(this).val(discount);
	});
	$("#quotation_form").on("keyup",".discount", function(e) {
		calculate();
		saveDraft();
	});
	$("#quotation_form").on("focusin",".delivery_charges", function(e) {
		var delivery_charges = $(this).val();
		if (delivery_charges == 0) {
			$(this).val("");
		}
	});
	$("#quotation_form").on("focusout",".delivery_charges", function(e) {
		var delivery_charges = $(this).val();
		if (delivery_charges == "." || delivery_charges == "") {
			delivery_charges = 0;
		}
		delivery_charges = parseFloat(delivery_charges);
		$(this).val(delivery_charges);
	});
	$("#quotation_form").on("keyup",".delivery_charges", function(e) {
		calculate();
		saveDraft();
	});


	calculate();
	function calculate() {

		// Calculate total quantity
		var total_quantity = 0;
		$(".qty").each(function() {
			var qty = $(this).val();
			qty = parseFloat(qty*1);
			total_quantity = (total_quantity + qty);
		});
		// console.log()

		// Calculate subtotal
		var subtotal = 0;
		$(".total").each(function() {
			var total = $(this).val();
			total = parseFloat(total*1);
			subtotal = (subtotal + total);
		});
		$(".grand_total").val(subtotal);


		var tax = $(".tax").val();
		if (tax == "." || tax == "") {
			tax = 0;
		}
		tax = parseFloat(tax*1);
		var discount = $(".discount").val();
		if (discount == "." || discount == "") {
			discount = 0;
		}
		discount = parseFloat(discount*1);
		var delivery_charges = $(".delivery_charges").val();
		if (delivery_charges == "." || delivery_charges == "") {
			delivery_charges = 0;
		}
		delivery_charges = parseFloat(delivery_charges*1);

		grand_total = (subtotal + tax + delivery_charges);
		if (discount > grand_total) {
			
			discount = 0;
			$(".discount").val(0);
			swal({
			    text: "Discount price should be less than to total price!",
			    icon: "warning",
			    button: "OK",
			});
		}
		grand_total = grand_total - discount;
		if (isFloat(grand_total)) {
			grand_total = parseFloat(grand_total).toFixed(2);
		}
		// console.log(grand_total);
		$(".grand_total").val(grand_total);
	}

	// Remove line
	$("#quotation_form").delegate(".remove_row", "click", function() {

		var strconfirm = confirm("Are you sure you want to delete?");
	    if (strconfirm == true) {
	        $(this).parents("tr").remove();
	        removeCounter -= 1;
	    }
	    if (removeCounter == 1) {
			$(".removeRow").prop("disabled", true);
			$(".remove_row").css("pointer-events", "none");
		}
		saveDraft();

		// Update the rows counter
		var counter = 1;
		$(".numbers_counter").map(function(){
			$(this).text(counter);
			counter++;
		});
	});
	
	document.getElementById('character_limit').innerHTML = $( ".comment" ).val().length+"/299";
	$("#quotation_form").on("keyup", ".comment", function(e) {
		
		comment = $( ".comment" ).val();
		var text_length = comment.length;
		document.getElementById('character_limit').innerHTML = text_length+"/299";
		saveDraft();
	});


	// Generate quote
	$("#quotation_form").on("click", ".generate_quote", function(e) {
		e.preventDefault();
		$(".overlay").show();

		var isRequired = 0;
		if ($('#client_id').val() == null) {
			$("#client_id").css("border","1px solid red");
			$("#client_id").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
		}
		if ($('#payment_mode').val() == null) {
			$("#payment_mode").css("border","1px solid red");
			$("#payment_mode").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
		}
		if ($('#credit_terms').val() == null) {
			$("#credit_terms").css("border","1px solid red");
			$("#credit_terms").css("box-shadow","0px 0px 5px 0px #F1948A");
			isRequired++;
		}

		$("#quotation_items .qty").map(function(){
			if ($(this).val() == "" || $(this).val() == 0) {
				$(this).css("border","1px solid red");
				$(this).css("box-shadow","0px 0px 5px 0px #F1948A");
				isRequired++;
			}
		});
		$("#quotation_items .unit_of_measurement").map(function(){
			if ($(this).val() == null) {
				$(this).css("border","1px solid red");
				$(this).css("box-shadow","0px 0px 5px 0px #F1948A");
				isRequired++;
			}
		});
		$("#quotation_items .unit_price").map(function(){
			if ($(this).val() == "" || $(this).val() == 0) {
				$(this).css("border","1px solid red");
				$(this).css("box-shadow","0px 0px 5px 0px #F1948A");
				isRequired++;
			}
		});
		// console.log(isRequired);

		if (isRequired) {
			swal({
			    text: "* fields are mandatory",
			    icon: 'warning',
			    // icon: '../js/icon-1.png',
			    button: "OK",
			}).then(function() {
			    $(".overlay").hide();
			});
		} else {

			$.ajax({
				url : Domain+"/ajaxcallforquotation.php",
				method : "POST",
				data : $("#quotation_form").serialize(),
				// data : {
				// 	saveDemand:1,
				// 	client:client,
				// },	
				success : function(response) {
					$(".overlay").hide();
					response = response.trim();
					// console.log(response);
					var response_data = response.split("[sprspr]");
					var id = response_data[0];
					var success = response_data[1];
					if(success == "1") {
						$.ajax({
							type: "POST",
							url: "QUOTATION_PRINTOUT.php",
							data: {
								"id": id,
							},
							success: function (response2) {
								response2 = response2.trim();
								// console.log(response2);
								if(response2 == 1) {
									swal({
									    text: "Generated successfully!",
									    icon: "success",
									    button: "OK",
									}).then(function() {
									    window.location = "quotations.php";
									});
								} else {
									swal({
									   text: "Generated successfully! But PDF not created!",
									   icon: "success",
									   button: "OK",
									}).then(function() {
									   window.location = "quotations";
									});
								}
							}
						});
						
					} else {
						swal({
						    text: "Something went wrong, please try again later",
						    icon: "warning",
						    button: "OK",
						}).then(function() {
						    window.location = "quotations.php";
						});
					}
				}
			});
		}
	});	


	function saveDraft() {

		setTimeout(function(){
			
			var generated_by = $("#generated_by").val();
			var client_id = $(".client_id").val();
			var payment_mode = $(".payment_mode").val();
			var credit_terms = $(".credit_terms").val();
			var tax = $(".tax").val();
			var discount = $(".discount").val();
			var delivery_charges = $(".delivery_charges").val();
			var currency = $(".currency").val();
			var comment = $(".comment").val();

			// var proIds = [];
			// $('input[name="pro_id[]"]').each(function(key) {
			//     proIds[key] = $(this).val();
			// });
			// var productSkus = [];
			// $('input[name="product_sku[]"]').each(function(key) {
			//     productSkus[key] = $(this).val();
			// });

			var product_ids = [];
			$('input[name="product_id[]"]').each(function(key) {
			    product_ids[key] = $(this).val();
			});
			var descriptions = [];
			$('input[name="description[]"]').each(function(key) {
			    descriptions[key] = $(this).val();
			});
			var specifications = [];
			$('input[name="specification[]"]').each(function(key) {
			    specifications[key] = $(this).val();
			});
			var qtys = [];
			$('input[name="qty[]"]').each(function(key) {
			    qtys[key] = $(this).val();
			});
			var uoms = [];
			$('input[name="uom[]"]').each(function(key) {
			    uoms[key] = $(this).val();
			});
			var unit_prices = [];
			$('input[name="unit_price[]"]').each(function(key) {
			    unit_prices[key] = $(this).val();
			});
			var additionalnote = [];
			$('input[name="additional_note[]"]').each(function(key) {
			    additionalnote[key] = $(this).val();
			});

			$.ajax({
				url : Domain+"/ajaxcallforquotation.php",
				method : "POST",
				data : {
					saveDraft:1,
					generated_by:generated_by,
					client_id:client_id,
					payment_mode:payment_mode,
					credit_terms:credit_terms,
					tax:tax,
					discount:discount,
					delivery_charges:delivery_charges,
					currency:currency,
					comment:comment,

					// Items list
					product_ids:product_ids,
					descriptions:descriptions,
					specifications:specifications,
					qtys:qtys,
					uoms:uoms,
					unit_prices:unit_prices,
					additionalnote:additionalnote,
					// Items list
				},	
				success : function(response) {
					console.log(response);
				}
			})
		}, 1000);
	}

	$("#page_heading").on("click", "#empty_draft", function() {

		var strconfirm = confirm("Are you sure you want to empty draft?");
	    if (strconfirm == true) {

	        $.ajax({
				url : Domain+"/ajaxcallforquotation.php",
				method : "POST",
				data : {
					emptyDraft:1,
				},			
				success : function(response) {
					// console.log(response);
					if (response == 1) {
						location.reload();
					} else {
						swal({
						    text: "Something went wrong, please try again later",
						    icon: "warning",
						    button: "OK",
						}).then(function() {
						    location.reload();
						});
					}
				}
			})
	    }
	});

});