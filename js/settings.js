/** @format */

// zkteco.js

$(document).ready(function () {
	if (window.location.pathname.toLowerCase() == DomainName + "/settings") {
		document.getElementById("SettingsTable").style.borderBottom =
			"1px solid #D0D3D4"
		getAllSettings()
	}

	function getAllSettings() {
		$.ajax({
			url: Domain + "/ajaxcallforsettings.php",
			method: "POST",
			data: {
				getAllSettings: 1,
			},
			dataType: "json",
			success: function (response) {
				if (Object.keys(response).length != 0) {
					$("#default_ior").val(response.default_ior)
					$("#default_duty_tax").val(response.default_duty_tax)
					$("#default_handling_charges").val(response.default_handling_charges)
					$("#default_customs_brokerage").val(response.default_customs_brokerage)
					$("#admin_bank_charges").val(response.admin_bank_charges)
				} else {
					$("#default_ior").val("")
					$("#default_duty_tax").val("")
					$("#default_handling_charges").val("")
					$("#default_customs_brokerage").val("")
					$("#admin_bank_charges").val("")
				}
			},
			error: function (response) {
				console.log(response)
				console.error("Error loading settings.")
			},
		})
	}

	/* -------------------------------------------------------------------------- */
	/*                          // Handle form submission                         */
	/* -------------------------------------------------------------------------- */
	$(".settings-form .submit-btn").click(function (e) {
		e.preventDefault()
		swal({
			title: "Are you sure?",
			text: "Do you want to save settings from the device?",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((result) => {
			if (result) {
				$(".loader-div").show() // show loader
				$.ajax({
					url: Domain + "/ajaxcallforsettings.php",
					method: "POST",
					data: $("#settings-form").serialize(),
					success: function (response) {
						$(".loader-div").hide() // show loader
						console.log(response)
						if (response.status == 'success') {
							$(".success-alert-text").text(
								"Settings saved successfully"
							)
							$(".success-alert").css("display", "flex")
							fadeOutAlertMessage()
						} else {
							$(".error-alert-text").text("Something went wrong!")
							$(".error-alert").css("display", "flex")
							fadeOutAlertMessage()
						}
					},
					error: function (response) {
						console.log(response)
						$(".loader-div").hide() // show loader
						console.error("Error saving settings.")
					},
				})
			}
		})
	})

	/* -------------------------------------------------------------------------- */
	/*                            Import Countries In Database & Device From Excel                     */
	/* -------------------------------------------------------------------------- */
	$("#importCountriesFromExcel").click(function () {
		swal({
			title: "Import Countries",
			text: "Are you sure to import data",
			icon: "info",
			buttons: ["No", "Yes"],
		}).then((result) => {
			if (result) {
				$(".loader-div").show() // show loader
				$.ajax({
					url: Domain + "/ajaxcallforsettings.php",
					method: "POST",
					dataType: "json",
					data: {
						importCountriesFromExcel: true,
					},
					success: function (response) {
						$(".loader-div").hide() // hide loader
						if (response.status === "success") {
							$(".success-alert-text").text(response.message)
							$(".success-alert").css("display", "flex")
							fadeOutAlertMessage()
						} else {
							$(".error-alert-text").text(response.message)
							$(".error-alert").css("display", "flex")
							fadeOutAlertMessage()
						}
					},
					error: function () {
						alert("An error occurred during the export process.")
					},
				})
			}
		})
	})

	// function checkAttendance() {
	//     $.ajax({
	//         url: 'ajaxcallformarkattendance.php',
	//         type: 'GET',
	//         success: function(response) {
	//             if (response.status === 'success') {
	//                 $('#message').text('Fingerprint scanned successfully! User ID: ' + response.user_id + ' at ' + response.timestamp);
	//                 setTimeout(checkAttendance, 4000); // Check again after 4 seconds
	//             } else if (response.status === 'no_data') {
	//                 $('#message').text('No new fingerprints scanned.');
	//                 setTimeout(checkAttendance, 500); // Check again after 0.5 seconds
	//             } else {
	//                 console.error('Error:', response.message);
	//                 setTimeout(checkAttendance, 500); // Check again after 0.5 seconds
	//             }
	//         },
	//         error: function(jqXHR, textStatus, errorThrown) {
	//             console.error('Request failed. Returned status of ' + jqXHR.status);
	//             setTimeout(checkAttendance, 500); // Check again after 0.5 seconds even if there's an error
	//         }
	//     });
	// }

	// $(document).ready(function() {
	//     checkAttendance();
	// });
})
