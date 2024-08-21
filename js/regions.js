/** @format */

$(document).ready(function () {
	/* -------------------------------------------------------------------------- */
	/*                         // Initialize the Datatable                        */
	/* -------------------------------------------------------------------------- */
	$("#RegionTable").DataTable({
		scrollX: true,
		scrollCollapse: true,
		processing: true,
		lengthChange: true,
		lengthMenu: [10, 25, 100, 200],
		pageLength: 10,
		searching: true,
		language: {
			paginate: {
				previous: "&laquo;", // or '<<'
				next: "&raquo;", // or '>>'
			},
		},
		drawCallback: function () {
			var width = $(window).width()
			if (width < 520) {
				$(".dataTables_paginate > .pagination").addClass(
					"pagination-sm"
				)
			} else {
				$(".dataTables_paginate > .pagination").removeClass(
					"pagination-sm"
				)
			}
		},
	})

	if (window.location.pathname.toLowerCase() == DomainName + "/regions") {
		document.getElementById("RegionTable").style.borderBottom =
			"1px solid #D0D3D4"
	}

	/* -------------------------------------------------------------------------- */
	/*                               // Add New User                              */
	/* -------------------------------------------------------------------------- */
	$(".region_name").keyup(function () {
		$(".region_name").css("border", "1px solid #28B463")
		$(".region_name").css("box-shadow", "")
		if ($(this).val().length == 0) {
			$(this).css("border", "1px solid red")
			$(this).css("box-shadow", "0px 0px 5px 0px #F1948A")
		}
	})
	$(".region-form .submit-btn").click(function (e) {
		e.preventDefault()
		$(".submit-btn").prop("disabled", true)
		var region_name = $(".region_name").val()

		var isRequired = 0
		if (region_name == "") {
			$(".region_name").css("border", "1px solid red")
			$(".region_name").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}

		if (isRequired) {
			swal({
				text: "* fields are required!",
				icon: "warning",
				button: "OK",
			}).then(function () {
				$(".submit-btn").prop("disabled", false)
			})
		} else {
			$(".loader-div").show() // show loader
			$.ajax({
				url: Domain + "/ajaxcallforregions.php",
				method: "POST",
				data: $("#region-form").serialize(),
				success: function (response) {
					$(".loader-div").hide() // show loader
					console.log(response)
					// $(".submit-btn").prop("disabled", )

					if (response == 1) {
						$(".success-alert-text").text(
							"Region added Successfully"
						)
						$(".success-alert").css("display", "flex")
						fadeOutAlertMessage()
						setTimeout(() => {
							window.location = "Regions"
						}, 3000)
					} else if (response == "REGION_ALREADY_EXIST") {
						$(".warning-alert-text").text("Region already exists")
						$(".warning-alert").css("display", "flex")
						fadeOutAlertMessage()
						setTimeout(() => {
							$(".submit-btn").prop("disabled", false)
						}, 3000)
					} else {
						$(".error-alert-text").text("Something went wrong!")
						$(".error-alert").css("display", "flex")
						fadeOutAlertMessage()
					}
				},
			})
		}
	})

	/* -------------------------------------------------------------------------- */
	/*                                // Edit user                                */
	/* -------------------------------------------------------------------------- */
	$(".edit-region-form .submit-btn").click(function (e) {
		e.preventDefault()
		$(".submit-btn").prop("disabled", true)
		var region_name = $(".region_name").val()

		var isRequired = 0
		if (region_name == "") {
			$(".region_name").css("border", "1px solid red")
			$(".region_name").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}
		if (isRequired) {
			swal({
				text: "* fields are required!",
				icon: "warning",
				button: "OK",
			}).then(function () {
				$(".submit-btn").prop("disabled", false)
			})
		} else {
			$(".loader-div").show() // show loader
			$.ajax({
				url: Domain + "/ajaxcallforregions.php",
				method: "POST",
				data: $("#edit-region-form").serialize(),
				success: function (response) {
					$(".loader-div").hide() // show loader
					console.log(response)
					$(".submit-btn").prop("disabled", false)
					if (response == 1) {
						$(".success-alert").css("display", "flex")
						fadeOutAlertMessage()
					} else {
						swal({
							text: "Error deleting region!",
							icon: "error",
						})
					}
					setTimeout(function () {
						window.location.href = "Regions"
					}, 2000)
				},
			})
		}
	})

	/* -------------------------------------------------------------------------- */
	/*                              // Delete Region                              */
	/* -------------------------------------------------------------------------- */
	$(".delete-region-btn").click(function () {
		var region_id = $(this).data("id")
		swal({
			text: "Are you sure you want to delete this region?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$(".loader-div").show() // show loader
				$.ajax({
					url: Domain + "/ajaxcallforregions.php",
					method: "POST",
					data: {
						action: "DeleteRegion",
						id: region_id,
					},
					success: function (response) {
						$(".loader-div").hide() // hide loader
						if (response == 1) {
							$(".success-alert-text").text(
								"Region deletd Successfully"
							)
							$(".success-alert").css("display", "flex")
							fadeOutAlertMessage()
							window.location.reload()
						} else {
							swal({
								text: "Error deleting region!",
								icon: "error",
							})
						}
					},
				})
			}
		})
	})
	
})
