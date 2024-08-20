
$(".login-form .email").focusin(function(){
    var email = $(".email").val();
    if ( email != "" ) {
        $(".email").css("border","");
		$(".email").css("box-shadow","");
    }
});
$(".login-form .email").focusout(function(){
    var email = $(".email").val();
    if ( email == "" ) {
        $(".email").css("border","1px solid red");
		$(".email").css("box-shadow","0px 0px 5px 0px #F1948A");
    }
});
$(".login-form .email").keyup(function(){
    $(".email").css("border","");
	$(".email").css("box-shadow","");
});

$(".login-form .password").focusin(function(){
    var password = $(".password").val();
    if ( password != "" ) {
        $(".password").css("border","");
		$(".password").css("box-shadow","");
    }
});
$(".login-form .password").focusout(function(){
    var password = $(".password").val();
    if ( password == "" ) {
        $(".password").css("border","1px solid red");
		$(".password").css("box-shadow","0px 0px 5px 0px #F1948A");
    }
});
$(".login-form .password").keyup(function(){
    $(".password").css("border","");
	$(".password").css("box-shadow","");
});

$(".login-form .loader").css("visibility", "hidden");
$(".login-form .submit-btn").click(function(e){
    e.preventDefault();

    var email = $(".email").val();
    var email = email.toLowerCase();
    var password = $(".password").val();

    var isRequired = 0;
    if(email == "") {
        $(".email").css("border","1px solid red");
		$(".email").css("box-shadow","0px 0px 5px 0px #F1948A");
        isRequired++;
    } 
    if(password == "") {
        $(".password").css("border","1px solid red");
		$(".password").css("box-shadow","0px 0px 5px 0px #F1948A");
        isRequired++;
    } 

    if(isRequired) {
        swal({
            text: "Email and password are required!",
            icon: "warning",
            button: "OK",
        });
    } else {
        $(".login-form .submit-btn").prop("disabled", true);
        $(".login-form .submit-btn").addClass("active");
        $(".login-form .loader").css("visibility", "visible");

        $.ajax({
            url : Domain+"/ajaxcallforlogin.php",
            method : "POST",
            data : {
                getLoginInfo:1,
                email:email,
                password:password,
            },          
            success : function(response) {
                console.log(response);
                $(".login-form .submit-btn").prop("disabled", false);
                $(".login-form .submit-btn").removeClass("active");
                $(".login-form .loader").css("visibility", "hidden");
                if (response == 1) {
                    window.location.href = "dashboard";
                } else if ( response == "USERS_DOES_NOT_EXIST") {
                    $(".email").css("border","1px solid red");
                    $(".email").css("box-shadow","0px 0px 5px 0px #F1948A");
                    $(".password").css("border","1px solid red");
                    $(".password").css("box-shadow","0px 0px 5px 0px #F1948A");
                    swal({
                        text: "Invalid credientials",
                        icon: "warning",
                        button: "OK",
                    });
                }
            }
        });

        // if (email.includes("venturetronics.com")) {
        //     $.ajax({
        //         url : Domain+"/ajaxcallforlogin.php",
        //         method : "POST",
        //         data : {
        //             venturetronicsLogin:1,
        //             email:email,
        //             password:password
        //         },
        //         success : function(response) {
        //             console.log(response);
        //             $(".login-form .submit-btn").prop("disabled", false);
        //             $(".login-form .submit-btn").removeClass("active");
        //             $(".login-form .loader").css("visibility", "hidden");
        //             if(response == 1) {
        //                 window.location.href = "home";
        //             } else {
        //                 swal({
        //                     text: "Invalid credientials!",
        //                     icon: 'warning',
        //                     button: "OK",
        //                 });
        //             }
        //         }
        //     });
        // } else if (email.includes("powersoft19.com")) {
        //     $.ajax({
        //         url : Domain+"/ajaxcallforlogin.php",
        //         method : "POST",
        //         data : {
        //             powersoft19Login:1,
        //             email:email,
        //             password:password
        //         },
        //         success : function(response) {
        //             console.log(response);
        //             $(".login-form .submit-btn").prop("disabled", false);
        //             $(".login-form .submit-btn").removeClass("active");
        //             $(".login-form .loader").css("visibility", "hidden");
        //             if(response == 1) {
        //                 window.location.href = "home";
        //             } else {
        //                 swal({
        //                     text: "Invalid credientials!",
        //                     icon: 'warning',
        //                     button: "OK",
        //                 });
        //             }
        //         }
        //     });
        // } else if (email.includes("raythorne.com")) {
        //     $.ajax({
        //         url : Domain+"/ajaxcallforlogin.php",
        //         method : "POST",
        //         data : {
        //             raythorneLogin:1,
        //             email:email,
        //             password:password
        //         },
        //         success : function(response) {
        //             console.log(response);
        //             $(".login-form .submit-btn").prop("disabled", false);
        //             $(".login-form .submit-btn").removeClass("active");
        //             $(".login-form .loader").css("visibility", "hidden");
        //             if(response == 1) {
        //                 window.location.href = "home";
        //             } else {
        //                 swal({
        //                     text: "Invalid credientials!",
        //                     icon: 'warning',
        //                     button: "OK",
        //                 });
        //             }
        //         }
        //     });
        // } else {
        // }
        
    }
});