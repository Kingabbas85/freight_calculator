/** @format */

$(document).ready(function () {
	/* -------------------------------------------------------------------------- */
	/*                         // Initialize the Datatable                        */
	/* -------------------------------------------------------------------------- */
	$("#CountryTable").DataTable({
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

	if (window.location.pathname.toLowerCase() == DomainName + "/countries") {
		document.getElementById("CountryTable").style.borderBottom =
			"1px solid #D0D3D4"
	}

	/* -------------------------------------------------------------------------- */
	/*                          // Add New Country                               */
	/* -------------------------------------------------------------------------- */
	$(".country-form .submit-btn").click(function (e) {
		e.preventDefault()
		$(".submit-btn").prop("disabled", true)

		var country_name = $(".country_name").val()
		var country_code = $(".country_code").val()
		var region_id = $(".region_id").val()

		var isRequired = 0

		// Validate fields
		if (country_name == "") {
			$(".country_name").css("border", "1px solid red")
			$(".country_name").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}
		if (country_code == "") {
			$(".country_code").css("border", "1px solid red")
			$(".country_code").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}
		if (region_id == "") {
			$(".region_id").css("border", "1px solid red")
			$(".region_id").css("box-shadow", "0px 0px 5px 0px #F1948A")
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
				url: Domain + "/ajaxcallforcountries.php",
				method: "POST",
				data: $("#country-form").serialize(),
				success: function (response) {
					$(".loader-div").hide() // show loader
					$(".submit-btn").prop("disabled", false)
					if (response == 1) {
						$(".success-alert-text").text(
							"Country added Successfully"
						)
						$(".success-alert").css("display", "flex")
						fadeOutAlertMessage()
						setTimeout(() => {
							window.location = "Countries"
						}, 3000)
					} else {
						$(".danger-alert-text").text(
							response
						)
						$(".error-alert").css("display", "flex")
						fadeOutAlertMessage()
						setTimeout(function () {
							window.location.href = "Countries"
						}, 2000)
					}
				},
			})
		}
	})

	/* -------------------------------------------------------------------------- */
	/*                          // Edit Country                                   */
	/* -------------------------------------------------------------------------- */
	$(".edit-country-form .submit-btn").click(function (e) {
		e.preventDefault()
		$(".submit-btn").prop("disabled", true)

		var country_name = $(".country_name").val()
		var country_code = $(".country_code").val()
		var region_id = $(".region_id").val()

		var isRequired = 0

		// Validate fields
		if (country_name == "") {
			$(".country_name").css("border", "1px solid red")
			$(".country_name").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}
		if (country_code == "") {
			$(".country_code").css("border", "1px solid red")
			$(".country_code").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}
		if (region_id == "") {
			$(".region_id").css("border", "1px solid red")
			$(".region_id").css("box-shadow", "0px 0px 5px 0px #F1948A")
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
				url:  Domain + "/ajaxcallforcountries.php",
				method: "POST",
				data: $("#edit-country-form").serialize(),
				success: function (response) {
					$(".loader-div").hide() // show loader
					$(".submit-btn").prop("disabled", false)
					if (response == 1) {
						$(".success-alert-text").text(
							"Country updated Successfully"
						)
						$(".success-alert").css("display", "flex")
						fadeOutAlertMessage()
						setTimeout(() => {
							window.location = "Countries"
						}, 3000)
					} else {
						$(".danger-alert-text").text(
							response
						)
						$(".error-alert").css("display", "flex")
						fadeOutAlertMessage()
						setTimeout(function () {
							window.location.href = "Countries"
						}, 3000)
					}
				},
			})
		}
	})
	$(document).on('click', '.delete-country-btn', function () {
		var country_id = $(this).data("id");
		swal({
			text: "Are you sure you want to delete this country?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$(".loader-div").show(); // show loader
				$.ajax({
					url: Domain + "/ajaxcallforcountries.php",
					method: "POST",
					data: {
						action: "DeleteCountry",
						id: country_id,
					},
					success: function (response) {
						$(".loader-div").hide(); // hide loader
						if (response == 1) {
							$(".success-alert-text").text(
								"Country deleted Successfully"
							);
							$(".success-alert").css("display", "flex");
							fadeOutAlertMessage();
							window.location.reload();
						} else {
							swal({
								text: "Error deleting country!",
								icon: "error",
							});
						}
					},
				});
			}
		});
	});
	

})
