$(document).ready(function () {

	// if ($(this).is(':checked')) {
	// 	$(this).val(1);
	// } else {
	// 	$(this).val(0);
	// }

	var checkedCount = 0;
	$(".row_id:checked").map(function(key) {
  		checkedCount++;
	});
	// console.log(checkedCount);

	if (checkedCount == 1) {
		$(".row_id").prop("disabled", true);
	}


	$("#invoice_form").delegate(".row_id", "click", function(e) {
  		
  		var tr = $(this).parent().parent();
  		if ($(this).is(':checked')) {
			tr.find(".is_changed").val(1);
			checkedCount++;
		} else {
			tr.find(".is_changed").val(0);
			checkedCount--;
		}

		// Disable the checkbox if only one line remains selected
		if (checkedCount == 1) {
			$(".row_id:checked").prop("disabled", true);
		} else {
			$(".row_id").prop("disabled", false);
		}
		calculate();
	});


	$("#invoice_form").delegate(".qty", "focusin", function() {

		var tr = $(this).parent().parent();
		var qty = $(this).val()
		if (qty == "" || qty == 0) {
			tr.find(".qty").val("");
		}
	});
	$("#invoice_form").delegate(".qty", "focusout", function() {

		var tr = $(this).parent().parent();
		var qty = $(this).val()
		if (qty == ".") {
			qty = 0;
		}
		qty = qty*1;
		tr.find(".qty").val(qty);
	});
	$("#invoice_form").delegate(".qty", "keyup", function() {

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

		tr.find(".total").val(qty*unit_price);

		tr.find(".qty").css("border","");
		tr.find(".qty").css("box-shadow","");
		calculate();
	});
	$("#invoice_form").delegate(".unit_of_measurement", "change", function() {
		var uom = $(this).val();
		var tr = $(this).parent().parent();
		tr.find(".uom").val(uom);

		tr.find(".unit_of_measurement").css("border","");
		tr.find(".unit_of_measurement").css("box-shadow","");
	});
	$("#invoice_form").delegate(".unit_price", "focusin", function() {
		
		if ($(this).val() == 0) {
			$(this).val("");
		}
	});
	$("#invoice_form").delegate(".unit_price", "focusout", function() {

		var tr = $(this).parent().parent();
		var unit_price = $(this).val();
		if (unit_price == "." || unit_price == "") {
			unit_price = 0;
		}
		unit_price = parseFloat(unit_price);
		$(this).val(unit_price);
	})
	$("#invoice_form").delegate(".unit_price", "keyup", function() {
		
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

		tr.find(".total").val(qty*unit_price);

		tr.find(".unit_price").css("border","");
		tr.find(".unit_price").css("box-shadow","");
		calculate();
	});

	$("#invoice_form").on("focusin",".tax", function(e) {
		var tax = $(this).val();
		if (tax == 0) {
			$(this).val("");
		}
	});
	$("#invoice_form").on("focusout",".tax", function(e) {
		var tax = $(this).val();
		if (tax == "." || tax == "") {
			tax = 0;
		}
		tax = parseFloat(tax);
		$(this).val(tax);
	});
	$("#invoice_form").on("keyup",".tax", function(e) {
		calculate();
	});
	$("#invoice_form").on("focusin",".discount", function(e) {
		var discount = $(this).val();
		if (discount == 0) {
			$(this).val("");
		}
	});
	$("#invoice_form").on("focusout",".discount", function(e) {
		var discount = $(this).val();
		if (discount == "." || discount == "") {
			discount = 0;
		}
		discount = parseFloat(discount);
		$(this).val(discount);
	});
	$("#invoice_form").on("keyup",".discount", function(e) {
		calculate();
	});
	$("#invoice_form").on("focusin",".delivery_charges", function(e) {
		var delivery_charges = $(this).val();
		if (delivery_charges == 0) {
			$(this).val("");
		}
	});
	$("#invoice_form").on("focusout",".delivery_charges", function(e) {
		var delivery_charges = $(this).val();
		if (delivery_charges == "." || delivery_charges == "") {
			delivery_charges = 0;
		}
		delivery_charges = parseFloat(delivery_charges);
		$(this).val(delivery_charges);
	});
	$("#invoice_form").on("keyup",".delivery_charges", function(e) {
		calculate();
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

			var tr = $(this).parent().parent();
			var is_changed = tr.find(".is_changed").val();
			// console.log(is_changed);
			if (is_changed == 1) {
				var total = $(this).val();
				total = parseFloat(total*1);
				subtotal = (subtotal + total);
			}
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


	document.getElementById('character_limit').innerHTML = $( ".comment" ).val().length+"/299";
	$("#invoice_form").on("keyup", ".comment", function(e) {
		
		comment = $( ".comment" ).val();
		var text_length = comment.length;
		document.getElementById('character_limit').innerHTML = text_length+"/299";
	});


	// Generate invoice
	$("#invoice_form").on("click", ".new_invoice", function(e) {
		e.preventDefault();
		// $(".overlay").show();

		var isRequired = 0;
		$("#invoice_form .qty").map(function(){
			if ($(this).val() == "" || $(this).val() == 0) {
				$(this).css("border","1px solid red");
				$(this).css("box-shadow","0px 0px 5px 0px #F1948A");
				isRequired++;
			}
		});
		$("#invoice_form .unit_of_measurement").map(function(){
			if ($(this).val() == null) {
				$(this).css("border","1px solid red");
				$(this).css("box-shadow","0px 0px 5px 0px #F1948A");
				isRequired++;
			}
		});
		$("#invoice_form .unit_price").map(function(){
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
			    button: "OK",
			}).then(function() {
			    $(".overlay").hide();
			});
		} else {
			$.ajax({
				url : Domain+"/ajaxcallforinvoice.php",
				method : "POST",
				data : $("#invoice_form").serialize(),
				// data : {
				// 	saveDemand:1,
				// 	client:client,
				// },	
				success : function(response) {
					$(".overlay").hide();
					response = response.trim();
					console.log(response);
					var response_data = response.split("[sprspr]");
					var id = response_data[0];
					var success = response_data[1];

					// window.location.href = Domain+"/INVOICE_PRINTOUT.php?id="+id;
					if(success == "1") {
						$.ajax({
							type: "POST",
							url: "INVOICE_PRINTOUT.php",
							data: {
								"id": id,
							},
							success: function (response2) {
								response2 = response2.trim();
								console.log(response2);
								if(response2 == 1) {
									swal({
									    text: "Generated successfully!",
									    icon: "success",
									    button: "OK",
									}).then(function() {
									    window.location = "invoices";
									});
								} else {
									swal({
									   text: "Generated successfully! But PDF not created!",
									   icon: "success",
									   button: "OK",
									}).then(function() {
									   window.location = "invoices";
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
						    window.location = "invoices";
						});
					}
				}
			});
		}
	});

});