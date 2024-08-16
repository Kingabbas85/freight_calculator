$(document).ready(function(){
		
	$(".overlay").hide();
	$('.email').keyup(function(){

		var email = $(".email").val();
		if(email.length > 0) {
			$(".email").css("border","");
			$(".email").css("box-shadow","");
		} else {
			$(".email").css("border","1px solid red");
			$(".email").css("box-shadow","0px 0px 5px 0px #F1948A");
		}
	});
	$('.password').keyup(function(){

		var password = $(".password").val();
		if(password.length > 0) {
			$(".password").css("border","");
			$(".password").css("box-shadow","");
		} else {
			$(".password").css("border","1px solid red");
			$(".password").css("box-shadow","0px 0px 5px 0px #F1948A");
		}
	});
	$('.email').focusin(function(e){
		$(".email").css("border","");
		$(".email").css("box-shadow","");
	});
	$('.email').focusout(function(e){
		if ($(this).val() == "") {
			$(".email").css("border","1px solid red");
			$(".email").css("box-shadow","0px 0px 5px 0px #F1948A");
		} else {
			$(".email").css("border","");
			$(".email").css("box-shadow","");
		}

		if ($(".password").val() == "") {
			$(".password").css("border","1px solid red");
			$(".password").css("box-shadow","0px 0px 5px 0px #F1948A");
		} else {
			$(".password").css("border","");
			$(".password").css("box-shadow","");
		}
	});
	$('.password').focusin(function(e){
		$(".password").css("border","");
		$(".password").css("box-shadow","");
	});
	$('.password').focusout(function(e){

		if ($(this).val() == "") {
			$(".password").css("border","1px solid red");
			$(".password").css("box-shadow","0px 0px 5px 0px #F1948A");
		} else {
			$(".password").css("border","");
			$(".password").css("box-shadow","");
		}
	});

	$('.login_button').click(function(e){
		e.preventDefault();

		var isValidEmail = 0;
		var email = $(".email").val();
		var email = email.toLowerCase();
		var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
		if(email.length > 0) {

			if (!email.match(validRegex)) {
			
				$("#email_error").addClass("text-danger font-weight-light");
				$("#email_error").html("<i>Invalid email</i>");
				isValidEmail++;
			}
		}
		
		var password = $(".password").val();
		$(".overlay").show();
		if($('.email').val() == "") {
			$(".email").css("border","1px solid red");
			$(".email").css("box-shadow","0px 0px 5px 0px #F1948A");
		}
		if($('.password').val() == "") {
			$(".password").css("border","1px solid red");
			$(".password").css("box-shadow","0px 0px 5px 0px #F1948A");
		}

		if (isValidEmail == 0) {
			if (email == "" || password == "") {
				$(".overlay").hide();
				swal({
				    text: "Email and password required!",
				    icon: 'warning',
				    button: "OK",
				});
			} else if (email != "" && password != "") {

				$.ajax({
					url : "loginprocess.php",
					method : "POST",
					data : {getLogin:1, email:email, password:password},
					success : function(response) {
						console.log(response);
						if(response == "Invalid credientials") {
							$(".overlay").hide();
							swal({
							    // text: "Invalid email address / password!",
							    text: "Invalid credientials!",
							    icon: 'warning',
							    button: "OK",
							});
						}
						if(response == 1) {
							window.location = "dashboard";
						}
					}
				});

				// if (email.includes("venturetronics.com")) {

				// 	$.ajax({
				// 		url : "loginprocess.php",
				// 		method : "POST",
				// 		data : {venturetronicsLogin:1, email:email, password:password},
				// 		success : function(response) {
				// 			console.log(response);
				// 			if(response == "Invalid credientials") {
				// 				$(".overlay").hide();
				// 				swal({
				// 				    // text: "Invalid email address / password!",
				// 				    text: "Invalid credientials!",
				// 				    icon: 'warning',
				// 				    button: "OK",
				// 				});
				// 			}
				// 			if(response == 1) {
				// 				window.location = "dashboard.php";
				// 			}
				// 		}
				// 	});
				// }
				// else if (email.includes("powersoft19.com")) {
				// 	$.ajax({
				// 		url : "loginprocess.php",
				// 		method : "POST",
				// 		data : {powersoft19Login:1, email:email, password:password},
				// 		success : function(response) {
				// 			console.log(response);
				// 			if(response == "Invalid credientials") {
				// 				$(".overlay").hide();
				// 				swal({
				// 				    // text: "Invalid email address / password!",
				// 				    text: "Invalid credientials!",
				// 				    icon: 'warning',
				// 				    button: "OK",
				// 				});
				// 			}
				// 			if(response == 1) {
				// 				window.location = "dashboard.php";
				// 			}
				// 		}
				// 	});
				// }
				// else if (email.includes("raythorne.com")) {
				// 	$.ajax({
				// 		url: "loginprocess.php",
				// 		method: "POST",
				// 		data: { raythorneLogin: 1, email: email, password: password },
				// 		success: function (response) {
				// 			console.log(response);
				// 			if (response == "Invalid credientials") {
				// 				$(".overlay").hide();
				// 				swal({
				// 					// text: "Invalid email address / password!",
				// 					text: "Invalid credientials!",
				// 					icon: 'warning',
				// 					button: "OK",
				// 				});
				// 			}
				// 			if (response == 1) {
				// 				window.location = "dashboard.php";
				// 			}
				// 		}
				// 	});
				// } else {
				// 	$(".overlay").hide();
				// 	swal({
				// 	    text: "Invalid credientials!",
				// 	    icon: 'warning',
				// 	    button: "OK",
				// 	});
				// }
			}
		} else {
			$(".overlay").hide();
			swal({
			    text: "Invalid email!",
			    icon: 'warning',
			    button: "OK",
			});
		}
		
	
	});
});