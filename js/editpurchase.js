$(document).ready(function(){	
	
	$(".overlay").hide();
	$("#editpurchase_form").delegate(".qty", "focusin", function() {

		var tr = $(this).parent().parent();
		var qty = $(this).val()
		if (qty == "" || qty == 0) {
			tr.find(".qty").val("");
		}
	});
	$("#editpurchase_form").delegate(".qty", "focusout", function() {

		var tr = $(this).parent().parent();
		var qty = $(this).val()
		if (qty == ".") {
			qty = 0;
		}
		qty = qty*1;
		tr.find(".qty").val(qty);
	});
	$("#editpurchase_form").delegate(".qty", "keyup", function() {

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

	$("#editpurchase_form").delegate(".unit_of_measurement", "change", function() {
		
		var uom = $(this).val();
		var tr = $(this).parent().parent();
		tr.find(".uom").val(uom);
	});

	$("#editpurchase_form").delegate(".unit_price", "focusin", function() {
		
		if ($(this).val() == 0) {
			$(this).val("");
		}
	});
	$("#editpurchase_form").delegate(".unit_price", "focusout", function() {

		var tr = $(this).parent().parent();
		var unit_price = $(this).val();
		if (unit_price == "." || unit_price == "") {
			unit_price = 0;
		}
		unit_price = parseFloat(unit_price);
		$(this).val(unit_price);
	})
	$("#editpurchase_form").delegate(".unit_price", "keyup", function() {
		
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


	calculate();
	function calculate() {

		// Calculate total quantity
		var total_quantity = 0;
		$(".qty").each(function() {
			var qty = $(this).val();
			qty = parseFloat(qty*1);
			total_quantity = (total_quantity + qty);
		});

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
	$("#editpurchase_form").delegate(".remove_row", "click", function() {

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


	

	$("#editpurchase_form").on("click", ".update_purchase", function(e) {
	// $(".update_quotation").click(function(e) {
		e.preventDefault();
		$(".overlay").show();

		$(".deleted_ids").val(deleted_ids);
		// console.log(deleted_ids);

		// var id = $(".purchase_no").val();

		var isRequired = 0;
	  	$("#editpurchase_items .qty").map(function(){
			if ($(this).val() == 0) {
				$(this).css("border","1px solid red");
				$(this).css("box-shadow","0px 0px 5px 0px #F1948A");
				isRequired++;
			}
		});
		$("#editpurchase_items .unit_price").map(function(){
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
				url : Domain+"/ajaxcallforpurchase.php",
				method : "POST",
				data : $("#editpurchase_form").serialize(),
				success : function(response) {
					response = response.trim();
					console.log(response);
					// $(".overlay").hide();
					if(response == 1) {
                        swal({
                            text: "Updated successfully!",
                            icon: "success",
                            button: "OK",
                        })
                        .then(function() {
                            window.location = "purchases";
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
	});
});