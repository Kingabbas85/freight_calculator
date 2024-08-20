/** @format */

$(document).ready(function () {
	$(".password").keyup(function () {
		var password = $(this).val()
		if (password.length >= 6) {
			$(".password").css("border", "1px solid #28B463")
			$(".password").css("box-shadow", "")
		} else {
			$(".password").css("border", "1px solid red")
			$(".password").css("box-shadow", "0px 0px 5px 0px #F1948A")
		}
	})
	$(".confirm_password").keyup(function () {
		var password = $(".password").val()
		var confirm_password = $(this).val()
		if (confirm_password.length >= 6) {
			if (password == confirm_password) {
				$(".password").css("border", "1px solid #28B463")
				$(".password").css("box-shadow", "")

				$(".confirm_password").css("border", "1px solid #28B463")
				$(".confirm_password").css("box-shadow", "")
			} else {
				$(".confirm_password").css("border", "1px solid red")
				$(".confirm_password").css(
					"box-shadow",
					"0px 0px 5px 0px #F1948A"
				)
			}
		} else {
			$(".confirm_password").css("border", "1px solid red")
			$(".confirm_password").css("box-shadow", "0px 0px 5px 0px #F1948A")
		}
	})

	$(".reset-password-form .submit-btn").click(function (e) {
		e.preventDefault()
		// (".submit-btn").prop("disabled", true);

		var username = $(".username").val()
		var password = $(".password").val()
		var confirm_password = $(".confirm_password").val()

		isRequired = 0
		if (password == "") {
			$(".password").css("border", "1px solid red")
			$(".password").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}
		if (confirm_password == "") {
			$(".confirm_password").css("border", "1px solid red")
			$(".confirm_password").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isRequired++
		}

		var lengthError = 0
		if (password.length < 6 || confirm_password.length < 6) {
			lengthError++
		}

		var isMatched = 1
		if (password != confirm_password) {
			$(".password").css("border", "1px solid red")
			$(".password").css("box-shadow", "0px 0px 5px 0px #F1948A")

			$(".confirm_password").css("border", "1px solid red")
			$(".confirm_password").css("box-shadow", "0px 0px 5px 0px #F1948A")
			isMatched = 0
		}

		if (isRequired) {
			swal({
				text: "* fields are required!",
				icon: "warning",
				button: "OK",
			})
		} else if (lengthError) {
			swal({
				text: "Password length should be greater than or equal to 6!",
				icon: "warning",
				button: "OK",
			})
		} else if (isMatched == 0) {
			swal({
				text: "Password does not match!",
				icon: "warning",
				button: "OK",
			})
		} else {
			$(".loader-div").show(); // show loader
			$.ajax({
				type: "POST",
				url: "ajaxcallforresetpassword.php",
				data: {
					resetPassword: 1,
					username: username,
					password: password,
					confirm_password: confirm_password,
				},
				success: function (response) {
					console.log(response)
					$(".loader-div").hide(); // show loader
					if (response == 1) {
						$(".success-alert").css("display", "flex")
						fadeOutAlertMessage()

						// setTimeout(function () {
						// 	window.location.href = "signout"
						// }, 2000)
					} else {
						$(".error-alert").css("display", "flex")
						fadeOutAlertMessage()
					}
				},
			})
		}
	})
})
