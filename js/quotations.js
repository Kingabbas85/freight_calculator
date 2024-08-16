$(document).ready(function () {

	var filterContainer = $('#filterContainer');

	$(".overlay").hide();
	$('#QuotationTable').DataTable({
		// "scrollX": true,
		// "scrollCollapse": true,
		"processing": true,
		"lengthChange": true,
		"lengthMenu": [10, 25, 100, 200],
		"pageLength": 10,
		"searching": true,
		// initComplete: function () {
		//     // Apply the search
		//     this.api().columns().every( function () {
		//         var that = this;

		//         $( 'input', this.footer() ).on( 'keyup change clear', function () {
		//             if ( that.search() !== this.value ) {
		//                 that.search( this.value ).draw();
		//             }
		//         } );
		//     });
		// },
		"language": {
			paginate: {
				previous: '&laquo;', // or '<<' 
				next: '&raquo;', // or '>>'
			}
		},
		"drawCallback": function () {
			// $('.dataTables_paginate > .pagination').addClass('pagination-sm');
			var width = $(window).width();
			if (width < 520) {
				$('.dataTables_paginate > .pagination').addClass('pagination-sm')
			} else {
				$('.dataTables_paginate > .pagination').removeClass('pagination-sm')
			}
		},
		// initComplete: function () {

		// 	var api = this.api();
		// 	var filterColumns = api.columns().header();

		// 	api.columns().every(function () {
		// 		var column = this;
		// 		// console.log(column[0][0]);
		// 		if (column[0][0] != 0 && column[0][0] != 2) {
		// 			var columnFilterContainer = $('<div class="col-md custom_filter_container"></div>').appendTo(filterContainer);
		// 			var select = $('<select class="form-control form-control-sm custom_filter"><option value=""></option></select>')
		// 				.appendTo(columnFilterContainer)
		// 				.on('change', function () {
		// 					var val = $.fn.dataTable.util.escapeRegex($(this).val());
		// 					val = val.replace(/\\/g, '');
		// 					column.search(val).draw();
		// 				});
		// 		}

		// 		this.data().unique().sort().each(function (result) {

		// 			if (column[0][0] == 0) {

		// 			} else if (column[0][0] == 1) {

		// 				result = $(result).text();
		// 				result = result.replace('!', '');
		// 				let value = result.trim();
		// 				value = value.replace('QUO-', '');

		// 				select.append('<option value="' + value + '">' + result + '</option>');

		// 			} else if (column[0][0] == 2) {


		// 			} else if (column[0][0] == 3) {

		// 				result = $(result).text();
		// 				result = result.replace('!', '');
		// 				let value = result.trim();
		// 				value = value.replace('DEM-', '');

		// 				select.append('<option value="' + value + '">' + result + '</option>');
		// 			} else if (column[0][0] == 4) {

		// 				result = $(result).text();
		// 				result = result.replace('!', '');
		// 				let value = result.trim();
		// 				value = value.replace('PRF-', '');

		// 				if (value == "") {
		// 					select.append('<option value="blank">blank</option>');
		// 				} else {
		// 					select.append('<option value="' + value + '">' + value + '</option>');
		// 				}

		// 			} else if (column[0][0] == 5) {

		// 				var o = new Option(result, result);
		// 				$(o).html(result);
		// 				select.append(o);

		// 			}

		// 		});
		// 	});
		// },
	});

	// get value from datatable input field
	$('.dataTables_filter input').keyup(function () {
		var value = $(this).val();
		// console.log(value);
		// datatable.search(value).draw(); 
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


	document.getElementById("QuotationTable").style.borderBottom = "1px solid #D0D3D4";

	// // Delete Quotation from Quotations Table
	// $("#QuotationTable").on("click", ".delete", function (e) {
	// 	e.preventDefault();

	// 	var tr = $(this).parent().parent();
	// 	var deleteid = tr.find('.id').val();

	// 	swal({
	// 		title: "Are you sure?",
	// 		text: "Once deleted, you will not be able to recover this!",
	// 		icon: "warning",
	// 		buttons: ["No", "Delete"],
	// 		dangerMode: true,
	// 	}).then((willDelete) => {

	// 		if (willDelete) {
	// 			$.ajax({
	// 				type: "POST",
	// 				url: "action.php",
	// 				data: {
	// 					"quotation_delete_btn": 1,
	// 					"deleteid": deleteid,
	// 				},
	// 				success: function (response) {
	// 					response = response.trim();
	// 					console.log(response);
	// 					if (response == 1) {
	// 						swal({
	// 						    text: "Deleted",
	// 						    icon: "success",
	// 						    button: "OK",
	// 						}).then(function() {
	// 						    location.reload();
	// 						});
	// 					} else {
	// 						swal({
	// 						    text: "Something went wrong, please try again later",
	// 						    icon: "warning",
	// 						    button: "OK",
	// 						}).then(function() {
	// 						    location.reload();
	// 						});
	// 					}
	// 				}
	// 			});
	// 		} else {
	// 			// swal("Your imaginary file is safe!");
	// 		}
	// 	});
	// });

	// Edit Quotation from Quotations Table
	$("#QuotationTable").on("click", ".edit", function (e) {
		e.preventDefault();

		// var tr = $(this).parent().parent();
		// var editid = tr.find('.id').val();
		var editid = $(this).closest("tr").find(".id").val();
		editid = md5(editid*1);
		window.location.href = Domain+"/EditQuotation.php?id="+editid;
	});


	// Closed Quotation
	$("#QuotationTable").on("click", ".closed", function (e) {
		e.preventDefault();

		var closedid = $(this).closest("tr").find(".id").val();
		// console.log(closedid);

		swal({
			title: "Are you sure?",
			text: "You want to close Quotation #"+closedid+".",
			icon: "warning",
			buttons: ["No", "Yes"],
			// dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: "POST",
					url: "ajaxcallforquotation.php",
					data: {
						"isClosed": 1,
						"id": closedid,
					},
					success: function (response) {
						response = response.trim();
						console.log(response);
						if (response == 1) {
							swal({
							    text: "Updated",
							    icon: "success",
							    button: "OK",
							}).then(function() {
							    location.reload();
							});
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
				});
			}
		});
	});

	// Generate New Invoice
	$("#QuotationTable").on("click", ".generate_invoice", function (e) {
		e.preventDefault();

		// var tr = $(this).parent().parent();
		// var editid = tr.find('.id').val();

		var editid = $(this).closest("tr").find(".id").val();
		// id = md5(id);
		window.location.href = Domain+"/NewInvoice.php?id="+md5(editid*1);
	});


	// Re-open Quotation
	$("#QuotationTable").on("click", ".reopen", function (e) {
		e.preventDefault();

		var id = $(this).closest("tr").find(".id").val();
		// console.log(closedid);

		swal({
			title: "Are you sure?",
			text: "You want to reopen Quotation #"+id+".",
			icon: "warning",
			buttons: ["No", "Yes"],
			// dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: "POST",
					url: "ajaxcallforquotation.php",
					data: {
						"isReOpen": 1,
						"id": id,
					},
					success: function (response) {
						response = response.trim();
						console.log(response);
						if (response == 1) {
							swal({
							    text: "Updated",
							    icon: "success",
							    button: "OK",
							}).then(function() {
							    location.reload();
							});
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
				});
			}
		});
	});

	


	// Edit Quotation from Quotations Table
	$("#QuotationTable").on("click", ".print", function (e) {
		e.preventDefault();

		var tr = $(this).parent().parent();
		var id = tr.find('.id').val();
		// console.log(id);

		// window.location = Domain+"/QUOTATION_PRINTOUT.php?id="+id;
		$.ajax({
			type: "POST",
			url: "QUOTATION_PRINTOUT.php",
			data: {
				"id": id,
			},
			success: function (response) {
				response = response.trim();
				console.log(response);
				// if (response == 1) {
				// 	swal({
				// 	    text: "Deleted",
				// 	    icon: "success",
				// 	    button: "OK",
				// 	}).then(function() {
				// 	    location.reload();
				// 	});
				// } else {
				// 	swal({
				// 	    text: "Something went wrong, please try again later",
				// 	    icon: "warning",
				// 	    button: "OK",
				// 	}).then(function() {
				// 	    location.reload();
				// 	});
				// }
			}
		});
	});


	
	// $("#QuotationTable").on("click", ".link_row", function (e) {
	// 	e.preventDefault();

	// 	_path = "";
	// 	if (_module == 1) {
	// 		_path = "/International";
	// 	}
	// 	var demand_no = $(this).closest("tr").find(".demand_no").val();
	// 	window.open(Domain+_path+"/ViewDemand.php?id="+md5(demand_no), '_blank');
	// });


	// Check PO generated or not for all items
	var checkedCount = 0;
	$("input:checkbox[name=select_products]:checked").each(function (key) {
		checkedCount++;
	});
	var approvedCount = $(".approvedCount").val();
	var demand_status = $(".demand_status").val();
	// approvedCount == checkedCount && demand_status == 'closed'
	if (demand_status == 'closed') {
		$(".generate_po").attr('disabled', 'disabled');
	} else {
		$(".generate_po").removeAttr('disabled', 'disabled');
	}

	// View Attachments
	var quote_file = document.querySelectorAll("#open_quote_file");
	for (let j = 0; j < quote_file.length; j++) {

		quote_file[j].addEventListener("click", function (e) {
			quote_file[j].setAttribute("target", "_blank");
			var file_name = document.querySelectorAll("#file_name")[j].innerHTML;
			var newUrl = Domain+"/assets/quotations/" + file_name;
			$(this).attr("href", newUrl);
		})
	}
});