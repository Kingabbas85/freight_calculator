
// Define domain name
var Domain = (window.location.protocol+'//'+window.location.host+"/");
var DomainName = ("/");

// if ((window.location.protocol+'//'+window.location.host) == "http://vt-inven.venturetronics.com") {
//     window.location.href = "http://203.130.21.178/freight_calculator";
// }
// var path = window.location.pathname;
// var path = path.toLowerCase();
// if (path != "/freight_calculator/home" && path != "/freight_calculator/login") {
//     if ((window.location.protocol+'//'+window.location.host) == "http://vt-inven.venturetronics.com") {
//         window.location.href = "signout";
//     }
// }


/* -------------------------------------------------------------------------- */
/*                            Set the session timeout                         */
/* -------------------------------------------------------------------------- */
if (window.sessionStorage.getItem("isSessionExpired") == "YES") {
    window.sessionStorage.clear();
    window.location = "signout";
}
var warningTimeoutID = undefined;
var logoutTimeoutID = undefined;
window.sessionStorage.setItem("isSessionExpired", "NO");
var events = ["click", "mousemove", "mousedown", "keydown"];
window.addEventListener("DOMContentLoaded", () => {
    if (window.location.pathname != "/freight_calculator/login") {
        warningTimeoutID = setTimeout(callTimeoutFunc, 1800000);
        events.forEach((event) => {
            window.addEventListener(event, eventHandler);
        });
    }
});
function callTimeoutFunc() {
    OpenBootstrapPopup();
    logoutTimeoutID = setTimeout(() => {
        window.sessionStorage.setItem("isSessionExpired", "YES");
    }, 1000);

    logoutTimeoutID = setTimeout(() => {
        window.location = "signout";
    }, 3000000);
}
function eventHandler() {
    if (logoutTimeoutID) {
        clearTimeout(logoutTimeoutID);
    }
    clearTimeout(warningTimeoutID);
    warningTimeoutID = setTimeout(callTimeoutFunc, 1800000);
}
// bootstrap modal for signout
function OpenBootstrapPopup () {
    $('#exampleModal').modal('show');
};
/* -------------------------------------------------------------------------- */
/*                            Set the session timeout                         */
/* -------------------------------------------------------------------------- */


// Selectpicker event
(function ($) {
    $(".selectpicker").selectpicker();
    // $('.link_row').attr('title','Click to see more detail!');
});


/* -------------------------------------------------------------------------- */
/*                               Helper functions                             */
/* -------------------------------------------------------------------------- */
// Get the month names array
var getMonthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

// Get the month number from the month name
function getMonthNumberFromMonthName(mon){
    var monthName = new Date(Date.parse(mon +" 01, 2023")).getMonth()+1;
    if ( monthName < 10 ) {
        monthName = "0"+monthName;
    }
    return monthName;
}

// Fadeout the alert messages
function fadeOutAlertMessage() {
    setTimeout(function() { 
        $( ".success-alert" ).fadeOut( 2000, "linear" );
        $( ".error-alert" ).fadeOut( 2000, "linear" );
        $( ".warning-alert" ).fadeOut( 2000, "linear" );
    }, 4000);
}

// Function to format date
function dateFormat(date, monthNames) {
    var updateddate = date.split("-");
    var newyear = updateddate[0];
    var newmonth = parseInt(updateddate[1] * 1 - 1);
    var newdate = updateddate[2];
    return (new_date = newdate + " " + monthNames[newmonth] + ", " + newyear);
}
    
// Get the file extention
function getFileExtension(filename) {
    // get file extension
    const extension = filename.substring(filename.lastIndexOf('.') + 1, filename.length) || filename;
    return extension;
}

// Get start and end date from the daterange
function getSqlDateFormat(selected_days) {

    var dates = $(".daterange").val();
    var dates = dates.split(' - ');
    var startDate = dates[0];
    var startDate = new Date(startDate);
    var date = startDate.getDate();
    if (date < 10) {
        date = "0"+date;
    }
    var month = startDate.getMonth() + 1;
    if (month < 10) {
        month = "0"+month;
    }
    var year = startDate.getFullYear();
    startDate = year + "-" + month + "-" + date;
    var endDate = dates[1];
    var endDate = new Date(endDate);
    var date = endDate.getDate();
    if (date < 10) {
        date = "0"+date;
    }
    var month = endDate.getMonth() + 1;
    if (month < 10) {
        month = "0"+month;
    }
    var year = endDate.getFullYear();
    endDate = year + "-" + month + "-" + date;

    var selected_dates = {start_date: startDate, end_date: endDate};
    return selected_dates;
}

// Calculate the number of days between the selected dates
function getDatabaseFormatData(selected_date) {
    var updateddate = selected_date.split(" ");
    var newdate = updateddate[0];
    var newmonth = updateddate[1].replace(",", "");
    newmonth = getMonthNumberFromMonthName(newmonth);
    var newyear = updateddate[2];
    var newday = updateddate[4];

    var new_date = newyear + "-" + newmonth + "-" + newdate;
    return new_date;
}

// Calculate the number of days between the selected dates
function calculateNumberOfDays(from_date, to_date) {
    // Parse the dates
    var from_dateObj = new Date(from_date);
    var to_dateObj = new Date(to_date);
    var time_difference = to_dateObj.getTime() - from_dateObj.getTime();

    var numberof_days = Math.ceil(time_difference / (1000 * 3600 * 24));
    if (numberof_days < 0) {
        return numberof_days-1;    
    }
    return numberof_days+1;
}

// Calculate the number of days between the selected dates
function calculateNumberOfBusinessDays(from_date, to_date) {
    // Parse the dates
    var from_dateObj = new Date(from_date);
    var to_dateObj = new Date(to_date);
    var time_difference = to_dateObj.getTime() - from_dateObj.getTime();

    var numberof_days = Math.ceil(time_difference / (1000 * 3600 * 24));
    if (numberof_days < 0) {
        return numberof_days-1;    
    }
    return numberof_days+1;
}


function getMonthsListOnPageLoad() {
	var year = $(".year").val();
	var current_month = $(".current_month").val();

	$("#month option").remove();
	$(".month").append(
	'<option value="" disabled selected hidden> Select Month </option>'
	);
	var date = new Date();
	if (year == date.getFullYear()) {
	var monthsCount = date.getMonth();
	for (var i = 0; i <= monthsCount; i++) {
		var selected = "";
		if (current_month * 1 == i + 1) {
		selected = "selected";
		}
		$(".month").append('<option value="' +i +'" ' +selected +">" +getMonthNames[i] +"</option>");
	}
	} else {
	for (var i = 0; i <= 11; i++) {
		$(".month").append(
		'<option value="' + i + '">' + getMonthNames[i] + "</option>"
		);
	}
	}
}

function getMonthsList() {
	var year = $(".year").val();
	var current_month = $(".current_month").val();

	$("#month option").remove();
	$(".month").append(
	'<option value="" disabled selected hidden> Select Month </option>'
	);
	var date = new Date();
	if (year == date.getFullYear()) {
	var monthsCount = date.getMonth();
	for (var i = 0; i <= monthsCount; i++) {
		$(".month").append('<option value="' + i + '">' + getMonthNames[i] + "</option>");
	}
	} else {
	for (var i = 0; i <= 11; i++) {
		$(".month").append('<option value="' + i + '">' + getMonthNames[i] + "</option>");
	}
	}
}
/* -------------------------------------------------------------------------- */
/*                               Helper functions                             */
/* -------------------------------------------------------------------------- */