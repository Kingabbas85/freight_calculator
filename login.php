<?php
	include_once("includes/session.php");
	if(isset($_SESSION['user_email']) == false) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>HRM - Login</title>
	<?php include_once('includes/header.php'); ?>
	<style>
		.login-form-container .logo .carousel-inner {
			height: 100px;
			/* border: 1px solid red; */
			display: flex !important;
			align-items: center !important;
			box-sizing: border-box !important;
		}
	</style>
</head>
<body>
	<!-- Header section starts -->
	<div class="login-layout">
      	<div class="login-form-container">
         	<h3>Sign in</h3>
         	<div class="logo" style="">
				<img src="images/fc_logo_new.png" style="width:120px !important;">
				<!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<!-- <div class="carousel-item active">
							<img src="images/fc_logo.png" style="width:100px !important;">
						</div>
						<div class="carousel-item">
							<img src="images/cal.png" style="width:120px !important;">
						</div>
						<div class="carousel-item">
							<img src="images/percentage-cal.jpg" style="width:100px !important;">
						</div>
					</div>
				</div> -->
        	</div>
         <form class="login-form">
            <div class="input">
					<span class="font-weight-light">
						<input type="text" name="email" id="email" class="form-control form-control-sm email" placeholder="Email">
					</span>
				</div>
             <div class="input" id="password-div">
					<span class="font-weight-light">
						<input type="password" name="password" id="password" class="form-control form-control-sm password" placeholder="Password">
					</span>
				</div>
				<div class="loader">
				  	<i class="fa fa-circle-o-notch fa-spin"></i>
				</div>
            <div class="submit">
					<span class="font-weight-light">
						<input type="submit" id="submit-btn" class="submit-btn" value="Sign in">
					</span>
				</div>
         </form>
      </div>
	</div>
	<!-- <h1>Fingerprint Scan Monitoring</h1>
    <div id="message">Waiting for fingerprint scan...</div> -->
</body>
</html>
<script type="text/javascript" src="js/login.js?clear_cache=<?php echo time();?>"></script>
<script>

// $(document).ready(function() {
// 	$('.carousel').carousel({
// 		interval: 2000,
// 	});

//     var myCarousel = $('#carouselExampleSlidesOnly');
//     // Listen to the 'slide.bs.carousel' event
//     myCarousel.on('slide.bs.carousel', function (e) {
//         // Get the index of the currently active item
//         var activeSlide = $(e.relatedTarget).index();

//         // Change button color and login form border based on the active slide
//         switch (activeSlide) {
//             case 0:
//                 $('.login-form-container').css('border-top', '4px solid #FC9C10');
//                 $('.submit-btn').css('background-color', '#FC9C10');
//                 break;
//             case 1:
//                 $('.login-form-container').css('border-top', '4px solid red');
//                 $('.submit-btn').css('background-color', 'red');
//                 break;
//             case 2:
//                 $('.login-form-container').css('border-top', '4px solid #14213D');
//                 $('.submit-btn').css('background-color', '#14213D');
//                 break;
//             default:
//                 $('.submit-btn').css('background-color', 'gray'); // Default color
//                 break;
//         }
//     });

// 	// Function to update the slide index based on email value
//     function updateSlideIndex() {
//         var emailValue = $('#email').val().toLowerCase();
//         var slideIndex = null; // Default slide index
        
//         // Check if email contains specific strings and set slide index accordingly
//         if (emailValue.includes('@venturetronics.com')) {
//             slideIndex = 1; // Index of the slide with VT logo
//         } else if (emailValue.includes('@raythorne.com')) {
//             slideIndex = 2; // Index of the slide with RT logo
//         } else if (emailValue.includes('@powersoft19.com')) {
//             slideIndex = 0; // Index of the slide with PS logo
//         }
        
//         // // Manually switch to the corresponding slide
//         myCarousel.carousel('pause').carousel(slideIndex);
// 		myCarousel.carousel({
// 			interval: false, // Disable automatic sliding
// 		});
//     }

//     $('#email').on('focusin focusout keyup', function (e) {
//         myCarousel.carousel('pause');
//         // If it's a keyup event and the key is not Enter, update the slide index
//         if (e.type === 'keyup' && e.keyCode !== 13) {
//             updateSlideIndex();
//         }
//     });
// });
</script>
<?php
	} else {
      header('location: home');
   }
?>