$(document).ready(function () {

	$(".overlay").hide();
	var purchaseTable = $('#PurchaseTable').DataTable({
		// "scrollX": true,
		// "scrollCollapse": true,
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

	document.getElementById("PurchaseTable").style.borderBottom = "1px solid #D0D3D4";


	// var purchaseTable = $('#PurchaseTable').DataTable({
	// 	"processing": true,
	// 	"lengthChange": true,
	// 	"lengthMenu": [10, 25, 100, 200],
	// 	"pageLength": 10,
	// 	"searching": true,
	// 	"language": {
	// 		paginate: {
	// 			previous: '&laquo;', // or '<<' 
	// 			next: '&raquo;', // or '>>'
	// 		}
	// 	},
	// 	"scrollX": true, // Enable horizontal scrolling
	// 	"scrollCollapse": true, // Collapse table when scrolling
	// 	"scroller": true, // Enable Scroller extension
	// 	"drawCallback": function () {
	// 		var width = $(window).width();
	// 		if (width < 520) {
	// 			$('.dataTables_paginate > .pagination').addClass('pagination-sm')
	// 		} else {
	// 			$('.dataTables_paginate > .pagination').removeClass('pagination-sm')
	// 		}
	// 	}
	// });
	
	// $(".fa-ellipsis-v").click(function(){
	// 	// Adjusting DataTable options
	// 	purchaseTable.settings()[0].oScroll.bX = false;
	// 	purchaseTable.draw();
	// });
	
	// Edit Purchase from Purchases Table
	$("#PurchaseTable").on("click", ".edit", function (e) {
		e.preventDefault();

		var editid = $(this).closest("tr").find(".id").val();
		// editid = md5(editid*1);
		window.location.href = Domain+"/EditPurchase.php?id="+md5(editid*1);
	});


	// Closed Purchase
	$("#PurchaseTable").on("click", ".closed", function (e) {
		e.preventDefault();

		var closedid = $(this).closest("tr").find(".id").val();
		// console.log(closedid);

		swal({
			title: "Are you sure?",
			text: "You want to close Purchase #"+closedid+".",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: "POST",
					url: "ajaxcallforpurchase.php",
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

	// Re-open Purchase
	$("#PurchaseTable").on("click", ".reopen", function (e) {
		e.preventDefault();

		var id = $(this).closest("tr").find(".id").val();
		// console.log(closedid);

		swal({
			title: "Are you sure?",
			text: "You want to reopen Purchase #"+id+".",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: "POST",
					url: "ajaxcallforpurchase.php",
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
});