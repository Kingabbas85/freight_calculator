
if ( window.sessionStorage.getItem("isSessionExpired") == "YES" ) {
    window.sessionStorage.clear();
    // window.location = "signout.php";
    window.location.href = window.location.protocol+'//'+window.location.host+"/mra/signout.php";
    // window.sessionStorage.removeItem("key");
    // window.sessionStorage.clear();
}

var Domain = (window.location.protocol+'//'+window.location.host+"/mra");
var DomainName = ("/mra");

(function ($) {
    $(".selectpicker").selectpicker();
    $('.link_row').attr('title','Click to see more detail!');
});


function getFileExtension(filename){
    // get file extension
    const extension = filename.substring(filename.lastIndexOf('.') + 1, filename.length) || filename;
    return extension;
}

function onlyNumberKey(evt) {
    // Only ASCII charactar in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

function onlyNumberKeyWithDot(evt) {
    // Only ASCII charactar in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57) && ASCIICode != 46)
        return false;
    return true;
}

function onlyExludeSomeSpecialChar(evt) {
    // Only ASCII charactar in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode == 34 || ASCIICode == 39)
        return false;
    return true;
}

function onlyCharactersandAlpabets(evt) {
    // Only ASCII charactar in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        // 32 => Space
        // 48 - 57 => Numeric 
        // 65 - 90 => UPPER ALPHA
        // 97 - 122 => lower alpha
        if (!(ASCIICode == 32) && !(ASCIICode > 47 && ASCIICode < 58) && !(ASCIICode > 64 && ASCIICode < 91) && !(ASCIICode > 96 && ASCIICode < 123) 
            && ASCIICode != 44)    
        return false;
    return true;
}

function onlyCharacters(evt) {
    // Only ASCII charactar in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        // 32 => Space
        // 48 - 57 => Numeric 
        // 65 - 90 => UPPER ALPHA
        // 97 - 122 => lower alpha
        if (!(ASCIICode == 32) && !(ASCIICode > 64 && ASCIICode < 91) && !(ASCIICode > 96 && ASCIICode < 123))    
        return false;
    return true;
}

function onlyContactNo(evt) {
    
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57) && ASCIICode != 43 && ASCIICode != 45)
        return false;
    return true;
}
function onlyEmail(evt) {
    
     var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        // 32 => Space
        // 48 - 57 => Numeric 
        // 65 - 90 => UPPER ALPHA
        // 97 - 122 => lower alpha
        if (!(ASCIICode == 32) && !(ASCIICode > 47 && ASCIICode < 58) && !(ASCIICode > 64 && ASCIICode < 91) && !(ASCIICode > 96 && ASCIICode < 123) 
            && ASCIICode != 45 && ASCIICode != 46 && ASCIICode != 64 && ASCIICode != 95)    
        return false;
    return true;
}

function isFloat(n){
    return Number(n) === n && n % 1 !== 0;
}

//Format Numbers in Javascript
function imsNumbersFormat(value) {
    if (value < 1000) {
        // Anything less than a million
        // value = (value).toFixed(2);
        value = value;
    } else if (value < 1000000) {
        
        // Anything less than a 100 Thousand
        value = (value/1000);
        if (Number.isInteger( value ) ) {
            value = value + 'K';
        }else{
            value = value.toFixed(2) + 'K';
        }
    } else if (value < 1000000000) {
        
        // Anything less than a billion
        value = (value/1000000);
        if (Number.isInteger( value ) ) {
            value = value + 'M';
        }else{
            value = value.toFixed(2) + 'M';
        }
    } else {

        // At least a billion
        value = (value/1000000000);
        if (Number.isInteger( value ) ) {
            value = value + 'B';
        }else{
            value = value.toFixed(2) + 'B';
        }
    }
    return value;
}

function imsRandomNumberFromInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min)
}





function imsDateTimeString() {
    
    var now = new Date();
    var timeString = Date.parse(now);
    // console.log(timeString);

    // // get Date, Month, Year, Hours, Minutes, Year
    // var date = now.getDate();
    // var month = now.getMonth();
    // var year = now.getFullYear();
    // var hours = now.getHours();
    // var minutes = now.getMinutes();
    // var seconds = now.getSeconds();

    // // get Date in JSON Format
    // console.log(now.toJSON());

    var randInt01 = imsRandomNumberFromInterval(1000, 9999)
    var randInt02 = imsRandomNumberFromInterval(1000, 9999)

    var datetimeString = timeString+"-"+randInt01+"-"+randInt02
    return datetimeString;
}


function imsGetSqlDateFormat( selected_days ){

    // get selected date
    if (selected_days == 'custom') {

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
    } else {
        // Start date calculate
        start_date = new Date();    
        start_date.setDate( start_date.getDate() - selected_days );
        var date = start_date.getDate();
        if (date < 10) {
            date = "0"+date;
        }
        var month = start_date.getMonth() + 1;
        if (month < 10) {
            month = "0"+month;
        }
        var year = start_date.getFullYear();
        startDate = year + "-" + month + "-" + date;

        // End date calculate
        end_date = new Date();  
        var date = end_date.getDate();
        if (date < 10) {
            date = "0"+date;
        }
        var month = end_date.getMonth() + 1;
        if (month < 10) {
            month = "0"+month;
        }
        var year = end_date.getFullYear();
        endDate = year + "-" + month + "-" + date;     
    }

    var selected_dates = {start_date: startDate, end_date: endDate};
    return selected_dates;
}


// Session timeout start
var warningTimeoutID = undefined;
var logoutTimeoutID = undefined;
window.sessionStorage.setItem("isSessionExpired", "NO");
const events = ["click", "mousemove", "mousedown", "keydown"];

window.addEventListener("DOMContentLoaded", () => {
    if (window.location.pathname != "/mra/login.php") {
        warningTimeoutID = setTimeout(callTimeoutFunc, 1500000);
        events.forEach((event) => {
            window.addEventListener(event, eventHandler);
        });
    }
});


function callTimeoutFunc() {
    
    OpenBootstrapPopup();
    logoutTimeoutID = setTimeout(() => {
        window.sessionStorage.setItem("isSessionExpired", "YES");
    }, 30000);

    logoutTimeoutID = setTimeout(() => {
        // window.location = "signout.php";
        window.location.href = window.location.protocol+'//'+window.location.host+"/mra/signout.php";
    }, 3000000);
}

function eventHandler() {
    if (logoutTimeoutID) {
        clearTimeout(logoutTimeoutID);
    }
    clearTimeout(warningTimeoutID);
    warningTimeoutID = setTimeout(callTimeoutFunc, 1500000);
}

// bootstrap modal for signout
function OpenBootstrapPopup () {
    $('#exampleModal').modal({backdrop: 'static', keyboard: false}, 'show');
};
// Session timeout end