/** @format */

// zkteco.js

$(document).ready(function () {

	
	if (window.location.pathname.toLowerCase() == DomainName + "/zkteco") {
		document.getElementById("ZktechoTable").style.borderBottom = "1px solid #D0D3D4";
	}
	// Preload the form with existing settings
	$.ajax({
		url: Domain + "/ajaxcallforzkteco.php",
		method: "GET",
		success: function (response) {
            // console.log(response);
			// var settings = JSON.parse(response)
			if (response.device_ip) {
				$("#device_ip").val(response.device_ip)
			}
			if (response.device_admin_role_id) {
				$("#device_admin_role_id").val(response.device_admin_role_id)
			}
		},
		error: function () {
			$(".loader-div").hide(); // show loader
			console.error("Error loading settings.")
		},
	})

	// Handle form submission
	$(".settings-form .submit-btn").click(function (e) {
		e.preventDefault()
		swal({
			title: "Are you sure?",
			text: "Do you want to save settings from the device?",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((result) => {
			if (result) {
				$(".loader-div").show(); // show loader
				$.ajax({
					url: Domain + "/ajaxcallforzkteco.php",
					method: "POST",
					data: $("#settings-form").serialize(),
					success: function (response) {
						$(".loader-div").hide(); // show loader
						// console.log(response)
						if (response == 1) {
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
					error: function () {
						$(".loader-div").hide(); // show loader
						console.error("Error saving settings.")
					},
				})
			}
		})
	})

	// Clear All Users from Device
	$("#clearUsersButton").click(function () {
		swal({
			title: "Are you sure?",
			text: "Do you want to clear all users from the device?",
			icon: "warning",
			buttons: ["No", "Yes"],
		}).then((result) => {
			if (result) {
				$(".loader-div").show(); // show loader
				$.ajax({
					url: Domain + "/ajaxcallforzkteco.php",
					method: "POST",
					data: {
						ZKtechoClearUser: true,
					},
					success: function (response) {
						$(".loader-div").hide(); // show loader
						console.log(response);
                        if (response.status === "success") {
							$(".success-alert-text").text(
								response.message
							)
							$(".success-alert").css("display", "flex")
							fadeOutAlertMessage()
							
						} else {
							$(".error-alert-text").text( response.message)
							$(".error-alert").css("display", "flex")
							fadeOutAlertMessage()
						}
					},
					error: function () {
						$(".loader-div").hide(); // show loader
						swal(
							"Error!",
							"An error occurred while clearing users.",
							"error"
						)
					},
				})
			}
		})
	})

	// Pull All Users from Device
	$("#pullUsersButton").click(function () {
		swal({
			title: "Fetching Users",
			text: "Please wait while we pull users from the device...",
			icon: "info",
			buttons: ["No", "Yes"],
		}).then((result) => {

			if (result) {
				$(".loader-div").show(); // show loader
				$.ajax({
					url: Domain + "/ajaxcallforzkteco.php",
					method: "POST",
					data: {
						ZKtechoPullUsers: true,
					},
					success: function (response) {
						$(".loader-div").hide(); // show loader
						// console.log()
						var result = response;
						if (result.status === "success") {
							$(".success-alert-text").text(
								result.message
							)
							$(".success-alert").css("display", "flex")
							fadeOutAlertMessage()
							
						} else {
							$(".error-alert-text").text( result.message)
							$(".error-alert").css("display", "flex")
							fadeOutAlertMessage()
						}
					},
					error: function () {
						$(".loader-div").hide(); // show loader
						swal(
							"Error!",
							"An error occurred while pulling users.",
							"error"
						)
					},
				})
			}
		})
	});

	// Get All Users from Device and show on a page
	$(".remove-user-btn").click(function () {
		var userId = $(this).data('userid');
		swal({
			title: "Remove User",
			text: "Are you sure you want to remove this user?",
			icon: "warning",
			buttons: ["Cancel", "Remove"],
		}).then((result) => {
			if (result) {
				$.ajax({
					url: Domain + "/ajaxcallforzkteco.php",
					method: "POST",
					data: {
						ZKtechoRemoveUser: true,
						user_id: userId
					},
					success: function (response) {
						
						var result = response;
						if (result.status === "success") {
							$(".success-alert-text").text(result.message);
							$(".success-alert").css("display", "flex");
							fadeOutAlertMessage();
							setTimeout(function () {
								window.location.href = "showDeviceUsers.php";
							}, 1000);
							
						} else {
							$(".error-alert-text").text(result.message);
							$(".error-alert").css("display", "flex");
							fadeOutAlertMessage();
							setTimeout(function () {
								window.location.href = "showDeviceUsers.php";
							}, 1000);
						}
					},
					error: function () {
						$(".error-alert-text").text("An error occurred while removing the user.");
						$(".error-alert").css("display", "flex");
						fadeOutAlertMessage();
					}
				});
			}
		});
	});
	// Push All Users to Device
	$("#pushUsersButton").click(function () {
		swal({
			title: "Pushing Users",
			text: "Please wait while we push users to the device...",
			icon: "info",
			buttons: ["No", "Yes"],
		}).then((result) => {
			if (result) {
				$(".loader-div").show(); // show loader
				$.ajax({
					url: Domain + "/ajaxcallforzkteco.php",
					method: "POST",
					data: {
						ZKtechoPushUsers: true,
					},
					success: function (response) {
						$(".loader-div").hide(); // hide loader
						// var result = JSON.parse(response)
						if (response.status === "success") {
							$(".success-alert-text").text(
								response.message
							)
							$(".success-alert").css("display", "flex")
							fadeOutAlertMessage()
							
						} else {
							$(".loader-div").hide(); // hide loader
							$(".error-alert-text").text( response.message)
							$(".error-alert").css("display", "flex")
							fadeOutAlertMessage()
						}
					},
					error: function () {
						$(".loader-div").hide(); // hide loader
						swal(
							"Error!",
							"An error occurred while pushing users.",
							"error"
						)
					},
				})
			}
		})
	})
    // Test Device Connection
    $("#testConnectionButton").click(function () {
		$(".loader-div").show(); // show loader
		$.ajax({
			url: Domain + "/ajaxcallforzkteco.php",
			method: "POST",
			data: {
				testConnectionButton: true,
			},
			success: function (response) {
				$(".loader-div").hide(); // hide loader
				// var result = JSON.parse(response)
                if (response.status === "success") {
                    $(".success-alert-text").text(
                        response.message
                    )
                    $(".success-alert").css("display", "flex")
                    fadeOutAlertMessage()
                    
                } else {
                    $(".error-alert-text").text( response.message)
                    $(".error-alert").css("display", "flex")
                    fadeOutAlertMessage()
                }
			},
			error: function () {
				$(".loader-div").hide(); // hide loader
				swal(
					"Error!",
					"An error occurred while pushing users.",
					"error"
				)
			},
		})
	})

    /* -------------------------------------------------------------------------- */
	/*                            // Export Device Users Report                          */
	/* -------------------------------------------------------------------------- */
	$("#exportDeviceUser").click(function () {
		$(".loader-div").show(); // show loader
		$.ajax({
			url: Domain + "/ajaxcallforzkteco.php",
			method: "POST",
			data: {
				ExportDeviceUsers: true, 
			},
			success: function (response) {
				$(".loader-div").hide(); // show loader
				if (response.success) {
					console.log("Success")
					// Download the generated Excel file
					var link = document.createElement("a")
					link.href = response.filepath // Adjust the path accordingly
					link.download = response.filename
					document.body.appendChild(link)
					link.click()
					document.body.removeChild(link)
				} else {
					alert(response.message)
				}
			},
			error: function () {
				$(".loader-div").hide(); // show loader
				alert("An error occurred during the export process.")
			},
		})
	});
   
        /* -------------------------------------------------------------------------- */
	/*                            Import Users In Database & Device From Excel                     */
	/* -------------------------------------------------------------------------- */
	$("#importUsersFromExcel").click(function () {
		swal({
			title: "Import Users",
			text: "Are you sure to import data",
			icon: "info",
			buttons: ["No", "Yes"],
		}).then((result) => {
			if (result) {
				$(".loader-div").show(); // show loader
				$.ajax({
					url: Domain + "/ajaxcallforzkteco.php",
					method: "POST",
					dataType: "json",
					data: {
						importUsersFromExcel: true, 
					},
					success: function (response) {
						$(".loader-div").hide(); // hide loader
						if (response.status === "success") {
							$(".success-alert-text").text(
								response.message
							)
							$(".success-alert").css("display", "flex")
							fadeOutAlertMessage()
							
						} else {
							$(".error-alert-text").text( response.message)
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
	});
    
    

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
