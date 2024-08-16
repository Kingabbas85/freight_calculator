
$(window).resize(function(){

	var width = $(window).width();
	if (width < 768) {
		$(".pagination").removeClass("justify-content-end");
		$(".pagination").addClass("justify-content-center");

		$("#pagination_container #left").addClass("text-center");

		$(".d-flex").removeClass("justify-content-end");
		$(".d-flex").addClass("justify-content-center");

	}
	if (width < 520) {
		$(".pagination").addClass("pagination-sm");
		// $("#previous").html("&laquo;");
		// $("#next").html("&raquo;");
	} else {
		$(".pagination").removeClass("pagination-sm");
		// $("#previous").html("Previous");
		// $("#next").html("Next");
	}

	if (width > 768) {
		$(".pagination").addClass("justify-content-end");
		$(".pagination").removeClass("justify-content-center");
		$("#pagination_container #left").removeClass("text-center");

		$(".d-flex").addClass("justify-content-end");
		$(".d-flex").removeClass("justify-content-center");
	}
});
var width = $(window).width();
if (width < 768) {
	$(".pagination").removeClass("justify-content-end");
	$(".pagination").addClass("justify-content-center");

	$("#pagination_container #left").addClass("text-center");

	$(".d-flex").removeClass("justify-content-end");
	$(".d-flex").addClass("justify-content-center");
	 
}
if (width < 520) {
	$(".pagination").addClass("pagination-sm");
	$("#previous").html("&laquo;");
	$("#next").html("&raquo;");
}

if (width > 768) {
	$(".pagination").addClass("justify-content-end");
	$(".pagination").removeClass("justify-content-center");

	$(".pagination").removeClass("pagination-sm");
	// $("#previous").html("Previous");
	// $("#next").html("Next");
	$("#previous").html("&laquo;");
	$("#next").html("&raquo;");

	$("#pagination_container #left").removeClass("text-center");
}

$("#table_layout").scroll(function(e){

	$(".scrollbar-hidden::-webkit-scrollbar").fadeIn(3000);
	$('#table_layout').addClass('scrollbar-hidden');
	// $('.scrollbar').css('margin-bottom', '2px');

	clearTimeout($.data(this, 'scrollTimer'));
    $.data(this, 'scrollTimer', setTimeout(function() {
        // do something
        // console.log("Haven't scrolled in 1000ms!");
        $('#table_layout').removeClass('scrollbar-hidden');
		// $('.scrollbar').css('margin-bottom', '10px');
    }, 3000));
})