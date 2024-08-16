$(document).ready(function(){	
	
	$(".overlay").hide();
	// $("#editquotation_form .vendor_id").change(function() {
		
	// 	var vendor_id = $(this).val();
	// 	$(".vendor_id").css("border","");
	// 	$(".vendor_id").css("box-shadow","");
	// });
	// $("#editquotation_form .payment_mode").change(function() {
		
	// 	var payment_mode = $(this).val();
	// 	$(".payment_mode").css("border","");
	// 	$(".payment_mode").css("box-shadow","");
	// });
	// $("#editquotation_form .credit_terms").change(function() {
		
	// 	var credit_terms = $(this).val();
	// 	$(".credit_terms").css("border","");
	// 	$(".credit_terms").css("box-shadow","");
	// });

	$("#editquotation_form").delegate(".qty", "focusin", function() {

		var tr = $(this).parent().parent();
		var qty = $(this).val()
		if (qty == "" || qty == 0) {
			tr.find(".qty").val("");
		}
	});
	$("#editquotation_form").delegate(".qty", "focusout", function() {

		var tr = $(this).parent().parent();
		var qty = $(this).val()
		if (qty == ".") {
			qty = 0;
		}
		qty = qty*1;
		tr.find(".qty").val(qty);
	});
	$("#editquotation_form").delegate(".qty", "keyup", function() {

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

	$("#editquotation_form").delegate(".unit_of_measurement", "change", function() {
		
		var uom = $(this).val();
		var tr = $(this).parent().parent();
		tr.find(".uom").val(uom);

		// tr.find(".unit_of_measurement").css("border","");
		// tr.find(".unit_of_measurement").css("box-shadow","");
	});

	$("#editquotation_form").delegate(".unit_price", "focusin", function() {
		
		if ($(this).val() == 0) {
			$(this).val("");
		}
	});
	$("#editquotation_form").delegate(".unit_price", "focusout", function() {

		var tr = $(this).parent().parent();
		var unit_price = $(this).val();
		if (unit_price == "." || unit_price == "") {
			unit_price = 0;
		}
		unit_price = parseFloat(unit_price);
		$(this).val(unit_price);
	})
	$("#editquotation_form").delegate(".unit_price", "keyup", function() {
		
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

	$(".tax").focusin(function(e) {
		var tax = $(this).val();
		if (tax == 0) {
			$(this).val("");
		}
	});
	$(".tax").focusout(function(e) {
		var tax = $(this).val();
		if (tax == "." || tax == "") {
			tax = 0;
		}
		tax = parseFloat(tax);
		$(this).val(tax);
	});
	$(".tax").keyup(function(e) {
		calculate();
	});

	$(".discount").focusin(function(e) {
		var discount = $(this).val();
		if (discount == 0) {
			$(this).val("");
		}
	});
	$(".discount").focusout(function(e) {
		var discount = $(this).val();
		if (discount == "." || discount == "") {
			discount = 0;
		}
		discount = parseFloat(discount);
		$(this).val(discount);
	});
	$(".discount").keyup(function(e) {
		calculate();
	});

	$(".delivery_charges").focusin(function(e) {
		var delivery_charges = $(this).val();
		if (delivery_charges == 0) {
			$(this).val("");
		}
	});
	$(".delivery_charges").focusout(function(e) {
		var delivery_charges = $(this).val();
		if (delivery_charges == "." || delivery_charges == "") {
			delivery_charges = 0;
		}
		delivery_charges = parseFloat(delivery_charges);
		$(this).val(delivery_charges);
	});
	$(".delivery_charges").keyup(function(e) {
		calculate();
	});




	// $("#editquotation_form").delegate(".available_qty", "focusin", function() {
	// 	if ($(this).val() == 0) {
	// 		$(this).val("");
	// 	}
	// });
	// $("#editquotation_form").delegate(".available_qty", "focusout", function() {
		
	// 	var tr = $(this).parent().parent();
	// 	var available_qty = $(this).val();
	// 	if (available_qty == "." || available_qty == "") {
	// 		available_qty = 0;
	// 	}
	// 	available_qty = parseFloat(available_qty);

	// 	if (available_qty == 0) {
	// 		tr.find(".unit_price").val(0);
	// 		tr.find(".unit_price").css("border","");
	// 		tr.find(".unit_price").css("box-shadow","");

	// 		tr.find(".eta_date").val("");
	// 		tr.find(".eta").css("border","");
	// 		tr.find(".eta").css("box-shadow","");
	// 	}
	// 	$(this).val(available_qty);
	// });
	// $("#editquotation_form").delegate(".available_qty", "keyup", function() {
		
	// 	var available_qty = $(this).val();
	// 	if (available_qty == "." || available_qty == "") {
	// 		available_qty = 0;
	// 	}
	// 	available_qty = parseFloat(available_qty);

	// 	var tr = $(this).parent().parent();
	// 	var buffer_qty = tr.find(".buffer_qty").val();
	// 	buffer_qty = parseFloat(buffer_qty);
	// 	var approve_qty = tr.find(".approve_qty").val();
	// 	approve_qty = parseFloat(approve_qty);
	// 	var unit_price = tr.find(".unit_price").val();
	// 	unit_price = parseFloat(unit_price);

	// 	if (available_qty > approve_qty) {

	// 		tr.find(".available_qty").val(approve_qty);
	// 		t_price = ((approve_qty+buffer_qty) * unit_price);
	// 		total_price = ((approve_qty+buffer_qty) * unit_price);
	// 		swal({
	// 		    text: "Quantity should be less than or equal to "+approve_qty,
	// 		    icon: 'warning',
	// 		    button: "OK",
	// 		});
	// 	} else {
	// 		t_price = ((available_qty+buffer_qty) * unit_price);
	// 		total_price = ((available_qty+buffer_qty) * unit_price);
	// 	}

	// 	if (isFloat(total_price)) {
	// 		t_price = parseFloat(t_price).toFixed(2);
	// 		total_price = parseFloat(total_price).toFixed(8);
	// 	}
	// 	tr.find(".t_price").val(t_price);
	// 	tr.find(".total_price").val(total_price);
	// 	calculate();

	// 	$(".available_qty").css("border","");
	// 	$(".available_qty").css("box-shadow","");
	// });

	// $("#editquotation_form").delegate(".buffer_qty", "focusin", function() {
		
	// 	var tr = $(this).parent().parent();
	// 	var readonly = tr.find(".readonly").val();
	// 	if (readonly == "readonly") {
	// 		$(this).val(0);
	// 	} else {

	// 		if ( $(this).val() == 0 ) {
	// 			$(this).val("");
	// 		}
	// 	}
	// });
	// $("#editquotation_form").delegate(".buffer_qty", "focusout", function() {
		
	// 	var tr = $(this).parent().parent();
	// 	var buffer_qty = $(this).val();
	// 	if (buffer_qty == "." || buffer_qty == "") {
	// 		buffer_qty = 0;
	// 	}
	// 	buffer_qty = parseFloat(buffer_qty);
	// 	$(this).val(buffer_qty);
	// });
	// $("#editquotation_form").delegate(".buffer_qty", "keyup", function() {
		
	// 	var tr = $(this).parent().parent();
	// 	var available_qty = tr.find(".available_qty").val();
	// 	available_qty = parseFloat(available_qty);

	// 	var buffer_qty = $(this).val();
	// 	if (buffer_qty == "." || buffer_qty == "") {
	// 		buffer_qty = 0;
	// 	}
	// 	buffer_qty = parseFloat(buffer_qty);

	// 	var unit_price = tr.find(".unit_price").val();
	// 	unit_price = parseFloat(unit_price);

	// 	t_price = ((available_qty+buffer_qty) * unit_price);
	// 	total_price = ((available_qty+buffer_qty) * unit_price);
	// 	if (isFloat(total_price)) {
	// 		t_price = parseFloat(t_price).toFixed(2);
	// 		total_price = parseFloat(total_price).toFixed(8);
	// 	}
	// 	tr.find(".t_price").val(t_price);
	// 	tr.find(".total_price").val(total_price);
	// 	calculate();
	// });

	// $("#editquotation_form").delegate(".unit_price", "focusin", function() {
	// 	if ($(this).val() == 0) {
	// 		$(this).val("");
	// 	}
	// });
	// $("#editquotation_form").delegate(".unit_price", "focusout", function() {
		
	// 	var tr = $(this).parent().parent();
	// 	var unit_price = $(this).val();
	// 	if (unit_price == "." || unit_price == "") {
	// 		unit_price = 0;
	// 	}
	// 	unit_price = parseFloat(unit_price);
	// 	$(this).val(unit_price);
	// });
	// $("#editquotation_form").delegate(".unit_price", "keyup", function() {
		
	// 	var tr = $(this).parent().parent();
	// 	var available_qty = tr.find(".available_qty").val();
	// 	available_qty = parseFloat(available_qty);
	// 	var buffer_qty = tr.find(".buffer_qty").val();
	// 	buffer_qty = parseFloat(buffer_qty);

	// 	var unit_price = $(this).val();
	// 	if (unit_price == "." || unit_price == "") {
	// 		unit_price = 0;
	// 	}
	// 	unit_price = parseFloat(unit_price);

	// 	var t_price = ( (available_qty+buffer_qty) * unit_price);
	// 	var total_price = ( (available_qty+buffer_qty) * unit_price);
	// 	if (isFloat(total_price)) {
	// 		t_price = parseFloat(t_price).toFixed(2);
	// 		total_price = parseFloat(total_price).toFixed(8);
	// 	}
	// 	tr.find(".t_price").val(t_price);
	// 	tr.find(".total_price").val(total_price);
	// 	calculate();

	// 	tr.find(".unit_price").css("border","");
	// 	tr.find(".unit_price").css("box-shadow","");
	// });
	// $('.eta').datepicker({
	//     format: 'dd/mm/yyyy',
	//     startDate: '0d',
	//     autoclose: true,
	// });
	// $("#editquotation_form").delegate("#eta", "focusout", function() {
		
	// 	var tr = $(this).parent().parent();
	// 	var prevdate = tr.find(".eta_date").val();

	// 	if ( prevdate.length > 0 ) {
	// 		var dates = [];
	// 		dates = prevdate.split("-");
	// 		var newdate = dates[2]+"/"+dates[1]+"/"+dates[0];
	// 		tr.find(".eta").val(newdate);
	// 	}
	// });
	// $("#editquotation_form").delegate("#eta", "change", function() {
		
	// 	var eta = $(this).val();
	// 	var tr = $(this).parent().parent();
	// 	tr.find(".eta").val(eta);

	// 	var dates = [];
	// 	dates = eta.split("/");
	// 	var newdate = dates[2]+"-"+dates[1]+"-"+dates[0];
	// 	tr.find(".eta_date").val(newdate);
	// });

	// $("#editquotation_form").on("keyup",".reference_no", function(e) {
	// 	$(".reference_no").css("border","");
	// 	$(".reference_no").css("box-shadow","");
	// });
	// $("#editquotation_form").on("focusin",".tax", function(e) {
	// 	var tax = $(this).val();
	// 	if (tax == 0) {
	// 		$(this).val("");
	// 	}
	// });
	// $("#editquotation_form").on("focusout",".tax", function(e) {
	// 	var tax = $(this).val();
	// 	if (tax == "." || tax == "") {
	// 		tax = 0;
	// 	}
	// 	tax = parseFloat(tax);
	// 	$(this).val(tax);
	// });
	// $("#editquotation_form").on("keyup",".tax", function(e) {
		
	// 	var tax = $(".tax").val();
	// 	if (tax == "." || tax == "") {
	// 		tax = "";
	// 	}
	// 	$(".tax").val(tax);
	// 	calculate();
	// });
	// $("#editquotation_form").on("focusin",".discount", function(e) {
	// 	var discount = $(this).val();
	// 	if (discount == 0) {
	// 		$(this).val("");
	// 	}
	// });
	// $("#editquotation_form").on("focusout",".discount", function(e) {
	// 	var discount = $(this).val();
	// 	if (discount == "." || discount == "") {
	// 		discount = 0;
	// 	}
	// 	discount = parseFloat(discount);
	// 	$(this).val(discount);
	// });
	// $("#editquotation_form").on("keyup",".discount", function(e) {

	// 	var discount = $(".discount").val();
	// 	if (discount == "." || discount == "") {
	// 		discount = "";
	// 	}
	// 	$(this).val(discount);
	// 	calculate();
	// });
	// $("#editquotation_form").on("focusin",".freight", function(e) {
	// 	var freight = $(this).val();
	// 	if (freight == 0) {
	// 		$(this).val("");
	// 	}
	// });
	// $("#editquotation_form").on("focusout",".freight", function(e) {
	// 	var freight = $(this).val();
	// 	if (freight == "." || freight == "") {
	// 		freight = 0;
	// 	}
	// 	freight = parseFloat(freight);
	// 	$(this).val(freight);
	// });
	// $("#editquotation_form").on("keyup",".freight", function(e) {

	// 	var freight = $(".freight").val();
	// 	if (freight == "." || freight == "") {
	// 		freight = "";
	// 	}
	// 	$(this).val(freight);
	// 	calculate();
	// });
	// $("#editquotation_form").on("focusin",".wire_transfer", function(e) {
	// 	var wire_transfer = $(this).val();
	// 	if (wire_transfer == 0) {
	// 		$(this).val("");
	// 	}
	// });
	// $("#editquotation_form").on("focusout",".wire_transfer", function(e) {
	// 	var wire_transfer = $(this).val();
	// 	if (wire_transfer == "." || wire_transfer == "") {
	// 		wire_transfer = 0;
	// 	}
	// 	wire_transfer = parseFloat(wire_transfer);
	// 	$(this).val(wire_transfer);
	// });
	// $("#editquotation_form").on("keyup",".wire_transfer", function(e) {

	// 	var wire_transfer = $(".wire_transfer").val();
	// 	if (wire_transfer == "." || wire_transfer == "") {
	// 		wire_transfer = "";
	// 	}
	// 	$(this).val(wire_transfer);
	// 	calculate();
	// });
	// $("#editquotation_form").on("focusin",".additional_tax", function(e) {
	// 	var additional_tax = $(this).val();
	// 	if (additional_tax == 0) {
	// 		$(this).val("");
	// 	}
	// });
	// $("#editquotation_form").on("focusout",".additional_tax", function(e) {
	// 	var additional_tax = $(this).val();
	// 	if (additional_tax == "." || additional_tax == "") {
	// 		additional_tax = 0;
	// 	}
	// 	additional_tax = parseFloat(additional_tax);
	// 	$(this).val(additional_tax);
	// });
	// $("#editquotation_form").on("keyup",".additional_tax", function(e) {

	// 	var additional_tax = $(".additional_tax").val();
	// 	if (additional_tax == "." || additional_tax == "") {
	// 		additional_tax = "";
	// 	}
	// 	$(this).val(additional_tax);
	// 	calculate();
	// });
	// $("#editquotation_form").on("focusin",".additional_charges", function(e) {
	// 	var additional_charges = $(this).val();
	// 	if (additional_charges == 0) {
	// 		$(this).val("");
	// 	}
	// });
	// $("#editquotation_form").on("focusout",".additional_charges", function(e) {
	// 	var additional_charges = $(this).val();
	// 	if (additional_charges == "." || additional_charges == "") {
	// 		additional_charges = 0;
	// 	}
	// 	additional_charges = parseFloat(additional_charges);
	// 	$(this).val(additional_charges);
	// });
	// $("#editquotation_form").on("keyup",".additional_charges", function(e) {

	// 	var additional_charges = $(".additional_charges").val();
	// 	if (additional_charges == "." || additional_charges == "") {
	// 		additional_charges = "";
	// 	}
	// 	$(this).val(additional_charges);
	// 	calculate();
	// });


	

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


	$("#LoadItemsInModal").on('hide.bs.modal', function(){
   	calculate();
  	});


	// Remove line
	removeCounter = $(".counter").val();
	if (removeCounter == 1) {
		$(".removeRow").prop("disabled", true);
		$(".remove_row").css("pointer-events", "none");
	}

	var deleted_ids = [];
	var deleted_ids_counter = 0;
	$("#editquotation_form").delegate(".remove_row", "click", function() {

		var tr = $(this).parent().parent();
		var status = tr.find(".status").val();

		var strconfirm = confirm("Are you sure you want to delete?");
	   if (strconfirm == true) {
	   	tr.find(".status").val(0);
	      $(this).parents("tr").remove();
	      removeCounter -= 1;

	   	var row_id = tr.find(".row_id").val();
	   	deleted_ids[deleted_ids_counter] = row_id;
	   	deleted_ids_counter++;
	   }
	   if (removeCounter == 1) {
			$(".removeRow").prop("disabled", true);
			$(".remove_row").css("pointer-events", "none");
		}

		// Update the rows counter
		var counter = 1;
		$(".numbers_counter").map(function(){
			$(this).text(counter);
			counter++;
		});
	});


	document.getElementById('character_limit').innerHTML = $( ".comment" ).val().length+"/299";
	$(".comment").keyup(function(e) {
		
		comment = $( ".comment" ).val();
		var text_length = comment.length;
		document.getElementById('character_limit').innerHTML = text_length+"/299";
	});


	// function calculate() {
		
	// 	var sub_qty = 0;
	// 	$(".available_qty").each(function() {
	// 		var this_value = $(this).val();
	// 		if ($(this).val() == ".") {
	// 			this_value = 0;
	// 		}
	// 		sub_qty = sub_qty + (this_value*1);
	// 	});
	// 	$(".buffer_qty").each(function() {
	// 		var this_value = $(this).val();
	// 		if ($(this).val() == ".") {
	// 			this_value = 0;
	// 		}
	// 		sub_qty = sub_qty + (this_value*1);
	// 	});
	// 	if (isFloat(sub_qty)) {
	// 		sub_qty = parseFloat(sub_qty).toFixed(2);
	// 	}
	// 	$(".total_qty").val(sub_qty);

	// 	var sub_total = 0;
	// 	$(".total_price").each(function() {
	// 		sub_total = sub_total + ($(this).val()*1);
	// 	});
	// 	sub_total = parseFloat(sub_total).toFixed(2);
	// 	$(".total").val(sub_total);
	// 	$(".grand_total").val(sub_total);

		
	// 	var total = $(".total").val();
	// 	var tax = $(".tax").val();
	// 	var discount = $(".discount").val();

	// 	var grand_total = (parseFloat(total) + parseFloat(tax) - parseFloat(discount));
	// 	grand_total = parseFloat(grand_total).toFixed(2);
	// 	$(".grand_total").val(grand_total);

	// 	// var tax = $(".tax").val();
	// 	// if (tax == "") {
	// 	// 	tax = 0;
	// 	// } else if(tax > 0) {

	// 	// 	var grand_total = (parseFloat(tax) + parseFloat(previous_total));
	// 	// 	if (isFloat(grand_total)) {
	// 	// 		grand_total = parseFloat(grand_total).toFixed(2);
	// 	// 	}
	// 	// 	grand_total = parseFloat(grand_total).toFixed(2);
	// 	// 	$(".grand_total").val(grand_total);
	// 	// }

	// 	// var discount = $(".discount").val();
	// 	// var total = $(".total").val();
	// 	// if (discount > 0) {

	// 	// 	var grand_total = (parseFloat(tax) + parseFloat(total));
	// 	// 	if (isFloat(grand_total)) {
	// 	// 		grand_total = parseFloat(grand_total).toFixed(2);
	// 	// 	}
	// 	// 	grand_total = parseFloat(grand_total).toFixed(2);
	// 	// 	$(".grand_total").val(grand_total - discount);
	// 	// }
	// }

	
	

	// var count = 0; 
	// $('.eta').datepicker({
	//     format: 'dd/mm/yyyy',
	//     startDate: '0d',
	//     autoclose: true
	// });
	// $("#editquotation_form").delegate(".eta", "change", function() {

	// 	var tr = $(this).parent().parent();
	// 	var eta = $(this).val();
	// 	tr.find(".eta").val(eta);

	// 	var dates = [];
	// 	dates = eta.split("/");
	// 	var new_date = dates[2]+"-"+dates[1]+"-"+dates[0];
	// 	tr.find(".eta_date").val(new_date);

	// 	$(".eta").css("border","");
	// 	$(".eta").css("box-shadow","");
	// });

	// $("#editquotation_form").on("keyup",".reference_no", function(e) {
	// 	$(".reference_no").css("border","");
	// 	$(".reference_no").css("box-shadow","");
	// });

	// $("#editquotation_form").on("focusin",".tax", function(e) {

	// 	var tax = $(".tax").val();
	// 	if (tax == 0) {
	// 		$(".tax").val("");
	// 	}
	// });
	// $("#editquotation_form").on("keyup",".tax", function(e) {
	
	// 	var tax = $(".tax").val();
	// 	if (tax == "") {
	// 		tax = 0;
	// 	}
	// 	tax = parseFloat(tax);
	// 	var total = $(".total").val();
	// 	total = parseFloat(total);

	// 	var discount = $(".discount").val();
	// 	if (discount == "") {
	// 		discount = 0;
	// 	}
	// 	discount = parseFloat(discount);

	// 	var grand_total = (total +  tax - discount);
	// 	grand_total = parseFloat(grand_total).toFixed(2);
	// 	$(".grand_total").val(grand_total);

	// });
	// $("#editquotation_form").on("focusin",".discount", function(e) {
	// 	var discount = $(".discount").val();
	// 	if (discount == 0) {
	// 		$(".discount").val("");
	// 	}
	// })
	// $("#editquotation_form").on("focusout",".discount", function(e) {
		
	// 	var discount = $(".discount").val();
	// 	if (discount == "." || discount == "") {
	// 		discount = 0;
	// 	}
	// 	discount = discount*1;
	// 	$(".discount").val(discount);
	// })
	// $("#editquotation_form").on("keyup",".discount", function(e) {

	// 	var discount = $(".discount").val();
	// 	if (discount == "") {
			
	// 		discount = 0;
	// 		total = $(".total").val();
	// 		total = parseFloat(total);
	// 		tax = $(".tax").val();
	// 		tax = parseFloat(tax);

	// 		grand_total = (total + tax - discount);
	// 		grand_total = parseFloat(grand_total).toFixed(2);
	// 		$(".grand_total").val(grand_total);

	// 	} else if (discount > 0) {
			
	// 		discount = (discount*1);
	// 		total = $(".total").val();
	// 		total = parseFloat(total);
	// 		tax = $(".tax").val();
	// 		tax = parseFloat(tax);
	// 		if (discount > total) {
	// 			$(".discount").val(0);
	// 			total = parseFloat(total + tax).toFixed(2);
	// 			$(".grand_total").val(total);
	// 			swal({
	// 			    text: "Discount price should be less than to total price!",
	// 			    icon: "warning",
	// 			    button: "OK",
	// 			});
	// 		} else {
	// 			grand_total = (total + tax - discount);
	// 			grand_total = parseFloat(grand_total).toFixed(2);
	// 			$(".grand_total").val(grand_total);
	// 		}
	// 	}
	// });


	// function getFileExtension(filename){
	//     // get file extension
	//     const extension = filename.substring(filename.lastIndexOf('.') + 1, filename.length) || filename;
	//     return extension;
	// }

	

	// var file = "";
	// var path = window.location.pathname;
	// var path = path.toLowerCase();
	// const actualBtn = document.getElementById('actual-btn');
	// const fileChosen = document.getElementById('file-chosen');
	// if (path == DomainName+"/editquotation.php" || path == DomainName+"/international/editquotation.php") {
	// 	// actualBtn.addEventListener('change', function(){
	// 	//   	fileChosen.textContent = this.files[0].name;
	// 	//   	$(".previous_image").val(fileChosen.textContent = this.files[0].name);
	// 	//   	$("#editquote_image_layout").css('display', "none");
	// 	// });

	// 	// upload file using button
	// 	actualBtn.addEventListener('change', function(){
		  	
	// 	  	// fileChosen.textContent = this.files[0].name;
	// 	  	file = this.files[0];
	// 	  	var filename = this.files[0].name;
	// 	  	var file_extension = filename.split('.').pop();
	// 	    $("#file-chosen").text(filename);
	// 	    $(".filename").val(filename);
	// 	    $(".extension").val(file_extension);
	// 	});

	// 	// upload file using drag & drop
	// 	const dragArea = document.getElementById('dragArea');
	// 	dragArea.addEventListener('dragover', (event) => {
	// 		event.preventDefault();

	// 		$("#file-chosen").text("Release to upload");
	// 		dragArea.classList.add('active');
	// 	});
	// 	dragArea.addEventListener('dragleave', (event) => {
			
	// 		var filename = $(".filename").val();
	// 		$("#file-chosen").text(filename);
	// 		if (filename == "") {
	// 	    	$("#file-chosen").text("Drag & Drop or browse");
	// 		}
	// 	    dragArea.classList.remove('active');
	// 	});
	// 	dragArea.addEventListener('drop', (event) => {
	// 		event.preventDefault();

	// 	    file = event.dataTransfer.files[0];
	// 	    var filename = file.name;
	// 	    var ext_len = filename.split('.');
	// 	    var extension = ext_len.pop();

	// 	    if ( ext_len.length > 0 ) {
	// 		    $("#file-chosen").text(filename);
	// 		    $(".filename").val(filename);
	// 		    $(".extension").val(extension);
	// 	    } else {

	// 	    	$("#file-chosen").text("Drag & Drop or browse");
	// 		    $(".filename").val("");
	// 		    $(".extension").val("");
	// 	    	swal({
	// 			    text: "folder cannot be uploaded",
	// 			    icon: 'warning',
	// 			    button: "OK",
	// 			});
	// 	    }
	// 	    dragArea.classList.remove('active');
	// 	});
	// 	let input = document.querySelector('.attachment');
	// 	dragArea.onclick = () => {
	// 		input.click();
	// 	}
	// }
	// // $(".editquote_image_style").click(function(){
	// // 	$("#editquote_image_layout").css('display', "none");
	// // 	$(".previous_image").val("");
	// // 	$("#file-chosen").text("No file chosen");
	// // });


	// $("#editquotation_form").on("click", ".update_quotation", function(e) {
	$(".update_quotation").click(function(e) {
		e.preventDefault();
		$(".overlay").show();


		// console.log(deleted_ids);
		$(".deleted_ids").val(deleted_ids);
		// var editid = $(".edit_quotaion_id").val();
		// var total_count = 0;
		// $("#editquotation_form .product_id").map(function(){
		// 	total_count++;
		// });
		// var check_available_qty = 0;
		// $("#editquotation_items .available_qty").map(function(){
		// 	if ($(this).val() != 0) {
		// 		check_available_qty++;
		// 	}
		// });

		// var isRequired = 0;
		// $("#editquotation_items .unit_price").map(function(){

		// 	var tr = $(this).parent().parent();
		// 	var unit_price_value = $(this).val();
		// 	unit_price_value = parseInt(unit_price_value);

		// 	var available_qty = tr.find(".available_qty").val();
		// 	available_qty = parseInt(available_qty);

		// 	if (available_qty != 0) {
		// 		if(tr.find(".unit_price").val() == 0) {
		// 			tr.find(".unit_price").css("border","1px solid red");
		// 			tr.find(".unit_price").css("box-shadow","0px 0px 5px 0px #F1948A");
		// 			isRequired++;
		// 		}
		// 	}
		// });
		// if($(".reference_no").val() == "") {
		// 	$(".reference_no").css("border","1px solid red");
		// 	$(".reference_no").css("box-shadow","0px 0px 5px 0px #F1948A");
		// 	isRequired++;
		// };

		// var form = $('#editquotation_form')[0];
		// var formData = new FormData(form);
	   //  formData.append('attachment', file);

	   // var form = $('#editquotation_form');
		// var formData = new FormData(form[0]);

		// var formData = new FormData(document.getElementById('editquotation_form'));

	  	// var extension = $(".extension").val();
	  	// var extension = extension.toLowerCase();

		var id = $(".quotation_no").val();

		var isRequired = 0;
	  	$("#editquotation_items .qty").map(function(){
			if ($(this).val() == 0) {
				$(this).css("border","1px solid red");
				$(this).css("box-shadow","0px 0px 5px 0px #F1948A");
				isRequired++;
			}
		});
		$("#editquotation_items .unit_price").map(function(){
			if ($(this).val() == 0) {
				$(this).css("border","1px solid red");
				$(this).css("box-shadow","0px 0px 5px 0px #F1948A");
				isRequired++;
			}
		});

		if (isRequired) {

			swal({
		   	text: "* fields are mandatory",
		   	icon: "warning",
		    	button: "OK",
			})
			.then(function() {
			   $(".overlay").hide();
			});
		} else {
			$.ajax({
				url : Domain+"/ajaxcallforquotation.php",
				method : "POST",
				// data : formData,
				// contentType: false,
  				// processData: false,
				data : $("#editquotation_form").serialize(),
				// data : {
				// 	updateQuotation:1,
				// },
				success : function(response) {
					response = response.trim();
					console.log(response);
					// $(".overlay").hide();
					if(response == 1) {
						$.ajax({
							type: "POST",
							url: "QUOTATION_PRINTOUT.php",
							data: {
								"id": id,
							},
							success: function (response2) {
								response2 = response2.trim();
								console.log(response2);

								if(response2 == 1) {
									swal({
									   text: "Updated successfully!",
									   icon: "success",
									   button: "OK",
									})
									.then(function() {
									   window.location = "quotations";
									});
								} else {
									swal({
									   text: "Updated successfully! But PDF not created!",
									   icon: "success",
									   button: "OK",
									})
									.then(function() {
									   window.location = "quotations";
									});
								}
							}
						});
					} else {
						swal({
						   text: "Something went wrong, please try again later",
						   icon: 'warning',
						   button: "OK",
						})
						.then(function() {
						   location.reload();
						});
					}
				}
			});
		}
						
		// } else {
		// 	swal({
		// 	    text: "* fields are mandatory!",
		// 	    icon: "warning",
		// 	    button: "OK",
		// 	})
		// 	.then(function() {
		// 	    $(".overlay").hide();
		// 	});
		// }
	});
});