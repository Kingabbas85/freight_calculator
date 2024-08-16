$(document).ready(function(){
		
	// var Domain = "http://localhost/ims";
	// var Domain = "http://vt-inven.venturetronics.com/ims";
	$("#user_emails").tokenfield({
		// autocomplete:{
			// source :['HTML', 'CSS', 'PHP'],
		// 	delay:100
		// },
		showAutocompleteOnFocus: true
	});

	$(".allow_permission").click(function(e){
		e.preventDefault();

		$.ajax({
			url : Domain+"/permissionprocess.php",
			method : "POST",
			data : $("#permission_form").serialize(),			
			success : function(response) {
				console.log(response);

				if(response == 0) {
					$(".overlay").hide();
					swal({
					    text: "User email & user role can't be empty!",
					    icon: 'warning',
					    button: "OK",
					});
				}
				if(response == 1) {
					$(".overlay").hide();
					swal({
					    text: "Permissions have been setted!",
					    icon: 'success',
					    button: "OK",
					}).then(function() {
				    	location.reload();
					});
				}
			}
		});
	})
});