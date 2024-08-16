$(document).ready(function(){

//calculate the time before calling the function in window.onload
// var beforeload = (new Date()).getTime();

// function getPageLoadTime() {
//   //calculate the current time in afterload
//   var afterload = (new Date()).getTime();
//   // now use the beforeload and afterload to calculate the seconds
//   seconds = (afterload - beforeload) / 1000;
//   // Place the seconds in the innerHTML to show the results
//   console.log('Loaded in  ' + seconds + ' sec(s).');
// }

// window.onload = getPageLoadTime;

	$("#generate_report_form").on("change", "#company", function() {

		var company = $(this).val();
		$.ajax({
			url : Domain+"/process.php",
			method : "POST",
			dataType: 'json',
			data : {
				getProgramsList:1, client:company,
			},			
			success : function(response) {
				// console.log(response);
				$('#program_budget option').remove();
				$('#program_budget').val("");
				$(".program_budget").append('<option value="" disabled selected hidden> -- Choose --</option>');

				$('#project_name option').remove();
				$('#project_name').val("");
				$(".project_name").append('<option value="" disabled selected hidden> -- Choose --</option>');

				$.each(response, function(key, value){
					$(".program_budget").append('<option value="'+value+'">'+value+'</option>');
				});			
			}
		});
		// $('#program_budget').addClass('searable_select_option');
		// $(".searable_select_option").selectpicker();
	})

	$("#generate_report_form").on("change", ".program_budget", function() {
		
		var company = $("#company").val();
		var program_budget = $(this).val();
		$.ajax({
			url : Domain+"/process.php",
			method : "POST",
			dataType: 'json',
			data : {
				getProjectsList:1, client:company, program_budget:program_budget,
			},			
			success : function(response) {
				// console.log(response);
				$('#project_name option').remove();
				$('#project_name').val("");
				$(".project_name").append('<option value="" disabled selected hidden> -- Choose --</option>');

				$.each(response, function(key, value){
					$(".project_name").append('<option value="'+value+'">'+value+'</option>');
				});			
			}
		});
	});


	$('input[name="daterange"]').daterangepicker({
	    minDate: new Date('09/21/2021'),
	    maxDate: new Date(),
	    locale: {
	      	format: 'DD/MM/YYYY'
	    }
	});
	
	var get_date = imsGetSqlDateFormat( 30 );
	$('.start_date').val(get_date.start_date);
	$('.end_date').val(get_date.end_date);
	
	$('#daterange_input').css('display', 'none');
	$('#close_custom_date').css('display', 'none');
	$("#generate_report_form").on("change", "#no_of_days", function() {

		var selected_days = $(this).val();
		if (selected_days == "custom") {
			$('#daterange_select').css('display', 'none');
			$('#daterange_input').css('display', 'block');
			$('#close_custom_date').css('display', 'inline-block');
		}

		var get_date = imsGetSqlDateFormat( selected_days );
		$('.start_date').val(get_date.start_date);
		$('.end_date').val(get_date.end_date);

		if (selected_days == 0) {
			$('.start_date').val("");
			$('.end_date').val("");
		}
	});

	$("#generate_report_form").on("click", "#close_custom_date", function() {
		$('#daterange_select').css('display', 'block');
		$('#daterange_input').css('display', 'none');
		$('#close_custom_date').css('display', 'none');

		$(".no_of_days").val(30);
  		$(".no_of_days").selectpicker('refresh');
  		var get_date = imsGetSqlDateFormat( 30 );
		$('.start_date').val(get_date.start_date);
		$('.end_date').val(get_date.end_date);
	});

	$("#generate_report_form").on("change", ".daterange", function() {

		var selected_date = $(this).val();
		var new_dates = selected_date.split(" - ");

		var start_date = new_dates[0];
		var end_date = new_dates[1];

		var startDate = start_date.split("/");
		var date = startDate[0];
		var month = startDate[1];
		var year = startDate[2];
		$(".start_date").val(year+"-"+month+"-"+date);

		var endDate = end_date.split("/");
		var date = endDate[0];
		var month = endDate[1];
		var year = endDate[2];
		$(".end_date").val(year+"-"+month+"-"+date);
	})

	$("#generate_report_form").on("click", ".moduleCheckBox", function() {
		var _module = $(this).val();
		if (_module == "PRF") {
			$("#files_option").css('visibility', 'visible');
		} else {
			$("#files_option").css('visibility', 'hidden');
			$('#invoices').prop('checked', false);
			$("#invoices").val(0);
			$('#with_prfs').prop('checked', false);
			$("#with_prfs").val(0);
		}
		$('.module').val( $(this).val() );
	})

	$("#generate_report_form").on("click", ".sourcingCheckBox", function() {
		
		var sourcing = $(this).val();
		$('.sourcing').val( $(this).val() );
	})

	$("#generate_report_form").on("click", ".invoices", function() {
		if ($(this).is(':checked')) {
			
			$(this).val(1);
			swal({
			    text: "Adding invoices in the report may takes a few minutes",
			    icon: "info",
			    button: "OK",
			})
		} else {
			$(this).val(0);
		}
	})

	$("#generate_report_form").on("click", ".with_prfs", function() {
		if ($(this).is(':checked')) {
			$(this).val(1);
		} else {
			$(this).val(0);
		}
	})

	
	$("#generate_report_form").on("click", ".generate_report", function() {

		$(".overlay").show();
		var company = $("#company").val();
		var program_budget = $(".program_budget").val();
		var project_name = $(".project_name").val();
		var team_name = $("#team_name").val();
		var user_name = $("#user_name").val();
		var start_date = $("#start_date").val();
		var end_date = $("#end_date").val();
		var vendor_id = $("#vendor_id").val();
		var _module = $("#module").val();
		var sourcing = $("#sourcing").val();
		var withInvoices = $(".invoices").val();
		var withPRFs = $(".with_prfs").val();

		if (_module == "") {
			swal({
			    text: "Module must be selected",
			    icon: "warning",
			    button: "OK",
			}).then(function() {
			    $(".overlay").hide();
			});
		} else {

			// var timerStart = new Date();
			// var myInterval = setInterval(countLoadingTime, 1000, timerStart);
			var request = $.ajax({

				url : Domain+"/reportprocess.php",
				method : "POST",
				timeout: 290000,
				data : {
					action:'projectReport',
					company:company,
					program_budget:program_budget,
					project_name:project_name,
					team_name:team_name,
					user_name:user_name,
					start_date:start_date,
					end_date:end_date,
					vendor_id:vendor_id,
					_module:_module,
					sourcing:sourcing,
					with_invoices:withInvoices,
					with_prfs:withPRFs
				},			
				success : function(response) {
					console.log(response);
					$(".overlay").hide();
					if (_module == "Demand") {
						
						setTimeout(download_function, 500);
						function download_function() {
							let btn = document.querySelector('#DemandsReport');
							btn.click();
						}
					}

					if (_module == "PRF") {
						
						if (withInvoices != 0 || withPRFs != 0) {

							setTimeout(download_function, 500);
							function download_function() {
								let btn = document.querySelector('#PRFsReport_zip');
								btn.click();
							}
						} else {

							setTimeout(download_function, 500);
							function download_function() {
								let btn = document.querySelector('#PRFsReport');
								btn.click();
							}
						}
					}
				},
                error: function(jqXHR, textStatus, errorThrown) {

			        if (textStatus === 'timeout') {
			            
			            // Handle the timeout here
	                    console.log("Request timed out");
	                    swal({
						    text: "Something went wrong, try again with less data",
						    icon: "error",
						    button: "OK",
						}).then(function() {
						    $(".overlay").hide();
						});
			        }
			    },
			});

			// var timerStart = new Date();
			// function countLoadingTime(time) {
			// 	var datetime = new Date();
			// 	var calculate_seconds = Math.floor((datetime - time)/1000);
			// 	console.log( calculate_seconds );
			// 	if (calculate_seconds > 10) {
			// 		clearInterval(myInterval);
			// 		request.abort();
			// 		location.reload();

			// 		// swal({
			// 		//     text: "Something went wrong, try again with less data",
			// 		//     icon: "error",
			// 		//     button: "OK",
			// 		// }).then(function() {
			// 		//     // location.reload();
			// 		// });
			// 	}
			// }
		}
	});
})