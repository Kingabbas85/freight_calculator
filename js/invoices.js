$(document).ready(function () {

	$(".overlay").hide();
	$('#InvoicesTable').DataTable({
		"scrollX": false,
		// "scrollY": false,
		"scrollCollapse": true,
		"processing": true,
		"lengthChange": true,
		"lengthMenu": [10, 25, 100, 200],
		"pageLength": 10,
		"searching": true,
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

	document.getElementById("InvoicesTable").style.borderBottom = "1px solid #D0D3D4";



	
	// Edit Invoice from Invocies Table
	$("#InvoicesTable").on("click", ".edit", function (e) {
		e.preventDefault();

		var editid = $(this).closest("tr").find(".id").val();
		editid = md5(editid*1);
		window.location.href = Domain+"/EditInvoice.php?id="+editid;
	});


	// Mark Paid Invoice from Invoices Table
	$("#InvoicesTable").on("click", ".paid", function (e) {
		e.preventDefault();

		var invoiceid = $(this).closest("tr").find(".id").val();
		// console.log(invoiceid);
		swal({
			title: "Are you sure?",
			text: "You have received the payment against Invoice #"+invoiceid+".",
			icon: "warning",
			buttons: ["No", "Yes"],
			// dangerMode: true,
		}).then((willTrue) => {
			if (willTrue) {
				$.ajax({
					type: "POST",
					url: "ajaxcallforinvoice.php",
					data: {
						"isPaid": 1,
						"id": invoiceid,
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

	// Mark Paid Invoice from Invoices Table
	$("#InvoicesTable").on("click", ".unpaid", function (e) {
		e.preventDefault();

		var invoiceid = $(this).closest("tr").find(".id").val();
		// console.log(invoiceid);
		swal({
			title: "Are you sure?",
			text: "You want to mark unpaid payment against Invoice #"+invoiceid+".",
			icon: "warning",
			buttons: ["No", "Yes"],
			// dangerMode: true,
		}).then((willTrue) => {
			if (willTrue) {
				$.ajax({
					type: "POST",
					url: "ajaxcallforinvoice.php",
					data: {
						"isUnPaid": 1,
						"id": invoiceid,
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

	// Mark Close Invoice from Invoices Table
	$("#InvoicesTable").on("click", ".closed", function (e) {
		e.preventDefault();

		var invoiceid = $(this).closest("tr").find(".id").val();
		// console.log(invoiceid);
		swal({
			title: "Are you sure?",
			text: "You want to close Invoice #"+invoiceid+".",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((willTrue) => {
			if (willTrue) {
				$.ajax({
					type: "POST",
					url: "ajaxcallforinvoice.php",
					data: {
						"isClosed": 1,
						"id": invoiceid,
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

	// Mark Close Invoice from Invoices Table
	$("#InvoicesTable").on("click", ".reopen", function (e) {
		e.preventDefault();

		var invoiceid = $(this).closest("tr").find(".id").val();
		// console.log(invoiceid);
		swal({
			title: "Are you sure?",
			text: "You want to reopen Invoice #"+invoiceid+".",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((willTrue) => {
			if (willTrue) {
				$.ajax({
					type: "POST",
					url: "ajaxcallforinvoice.php",
					data: {
						"isReOpen": 1,
						"id": invoiceid,
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


	

});