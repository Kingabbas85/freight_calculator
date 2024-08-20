
$(document).ready(function(){

	var path = window.location.pathname;
	var path = path.toLowerCase();
	var id = path.replace("/freight_calculator/", "");
	// active sidebar
	$(".side-bar .sidebar-items a#"+id).addClass("active");

	if (id == "Countries") {
		$(".side-bar .sidebar-items a#countries").addClass("active");
		$(".side-bar .sidebar-items a#resetpassword").addClass("active");
	}

	if ( id == "regions" || id == "newregion" || id == "editregion" ) {
		$(".side-bar .sidebar-items a#location").addClass("active");
		$(".side-bar .sidebar-items a#regions").addClass("active");
	}

	// collapse-expand sidebar starts
	let sideBar = document.querySelector('.side-bar');
	let header = document.querySelector('.header');
	let layout = document.querySelector('.layout');
	// let main_heading = document.querySelector('.header .heading');
	document.querySelector('.collapse-expand-btn').onclick = () => {
		sideBar.classList.toggle('active');
		header.classList.toggle('active');
		layout.classList.toggle('active');
		// main_heading.classList.toggle('active');

		$(".side-bar .logo-container .logo").css("display", "none");
		$(".side-bar.active .logo-container .logo").css("display", "flex");
	}

	// Window resize event
	$(window).resize(function() {
		layoutResponsive();
	})

	// Onload event
	layoutResponsive();

	// Collapse-expand function
	function layoutResponsive() {
		var width = $( window ).width();
		if (width <= 992) {

			$(document).on('click', function (event) {
				if ( !$(event.target).closest('#side-bar').length && !$(event.target).closest('.collapse-expand-btn').length ) {
					sideBar.classList.add('active');
					$(".side-bar.active .logo-container .logo").css("display", "flex");
					header.classList.add('active');
				}	
			});
			sideBar.classList.add('active');
			$(".side-bar.active .logo-container .logo").css("display", "flex");		
			header.classList.add('active');	
		} else {

			$(document).on('click', function (event) {
				if ( !$(event.target).closest('#side-bar').length && !$(event.target).closest('.collapse-expand-btn').length ) {
					
					var width_find = $( "#side-bar" ).width();
					if ( width_find < 75 ) {
						sideBar.classList.add('active');
						$(".side-bar.active .logo-container .logo").css("display", "flex");
					} else {
						sideBar.classList.remove('active');
						$(".side-bar .logo-container .logo").css("display", "none");
					}
					
				}	
			});
			sideBar.classList.remove('active');
			$(".side-bar .logo-container .logo").css("display", "none");

			header.classList.remove('active');
			layout.classList.remove('active');
		}
	}

	$(window).scroll(function() {
		layoutResponsive();
	})
	// collapse-expand sidebar ends
    
	// $('#exampleModal').modal('show');
})