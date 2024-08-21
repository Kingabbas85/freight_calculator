$(document).ready(function () {
	/* -------------------------------------------------------------------------- */
	/*                         // Initialize the Datatable                        */
	/* -------------------------------------------------------------------------- */
	$("#CityTable").DataTable({
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

	if (window.location.pathname.toLowerCase() == DomainName + "/cities") {
		document.getElementById("CityTable").style.borderBottom =
			"1px solid #D0D3D4"
	}

	/* -------------------------------------------------------------------------- */
	/*                               // Add New City                              */
	/* -------------------------------------------------------------------------- */
	$(".city_name").keyup(function () {
		$(".city_name").css("border", "1px solid #28B463")
		$(".city_name").css("box-shadow", "")
		if ($(this).val().length == 0) {
			$(this).css("border", "1px solid red")
			$(this).css("box-shadow", "0px 0px 5px 0px #F1948A")
		}
	})
	$(".city-form .submit-btn").click(function (e) {
		e.preventDefault()
		$(".submit-btn").prop("disabled", true)
		var city_name = $(".city_name").val()
		var country_id = $(".country_id").val()

		var isRequired = 0
		if (city_name == "") {
			$(".city_name").css("border", "1px solid red")
			$(".city_name").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}
		if (country_id == "") {
			$(".country_id").css("border", "1px solid red")
			$(".country_id").css("box-shadow", "0px 0px 5px 0px #F1948A")
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
				url: Domain + "/ajaxcallforcities.php",
				method: "POST",
				data: $("#city-form").serialize(),
				success: function (response) {
					$(".loader-div").hide() // hide loader
					console.log(response)
					if (response == 1) {
						$(".success-alert-text").text("City added successfully");
                        $(".success-alert").css("display", "flex");
                        fadeOutAlertMessage();
                        setTimeout(() => {
                            window.location = "Cities";
                        }, 3000);
					} else if (response == "CITY_ALREADY_EXIST") {
						$(".warning-alert-text").text("City already exists");
                        $(".warning-alert").css("display", "flex");
                        fadeOutAlertMessage();
                        setTimeout(() => {
                            window.location = "Cities";
                        }, 3000);
					} else {
						$(".error-alert").css("display", "flex")
						$(".error-alert-text").text("Something went wrong!")
						fadeOutAlertMessage();
						setTimeout(() => {
                            window.location = "Cities";
                        }, 3000);
					}
				},
			})
		}
	})

	/* -------------------------------------------------------------------------- */
	/*                                // Edit City                                */
	/* -------------------------------------------------------------------------- */
	$(".edit-city-form .submit-btn").click(function (e) {
		e.preventDefault()
		$(".submit-btn").prop("disabled", true)
		var city_name = $(".city_name").val()
		var country_id = $(".country_id").val()

		var isRequired = 0
		if (city_name == "") {
			$(".city_name").css("border", "1px solid red")
			$(".city_name").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}
		if (country_id == "") {
			$(".country_id").css("border", "1px solid red")
			$(".country_id").css("box-shadow", "0px 0px 5px 0px #F1948A")
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
				url: Domain + "/ajaxcallforcities.php",
				method: "POST",
				data: $("#edit-city-form").serialize(),
				success: function (response) {
					$(".loader-div").hide() // hide loader
					console.log(response)
					$(".submit-btn").prop("disabled", false)
					if (response == 1) {
						$(".success-alert-text").text("City updated successfully");
                        $(".success-alert").css("display", "flex");
                        fadeOutAlertMessage();
                        setTimeout(() => {
                            window.location = "Cities";
                        }, 3000);
					} else {
						swal({
							text: "Error updating city!",
							icon: "error",
						});
						setTimeout(function () {
							window.location.href = "Cities"
						}, 3000)
					}
					
				},
			})
		}
	})

	/* -------------------------------------------------------------------------- */
	/*                              // Delete City                                */
	/* -------------------------------------------------------------------------- */
	$(".delete-city-btn").click(function () {
		var city_id = $(this).data("id")
		swal({
			text: "Are you sure you want to delete this city?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$(".loader-div").show() // show loader
				$.ajax({
					url: Domain + "/ajaxcallforcities.php",
					method: "POST",
					data: {
						action: "DeleteCity",
						id: city_id,
					},
					success: function (response) {
						$(".loader-div").hide() // hide loader
						if (response == 1) {
							$(".success-alert-text").text("City deleted successfully");
							$(".success-alert").css("display", "flex");
							fadeOutAlertMessage();
							setTimeout(() => {
								window.location = "Cities";
							}, 3000);
						} else {
							swal({
								text: "Error deleting city!",
								icon: "error",
							})
						}
					},
				})
			}
		})
	})
})
