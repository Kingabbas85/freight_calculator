$(document).ready(function() {

	// console.log(Domain);
	$(".overlay").hide();
	var user_role = $(".user_name").val();
	var user_role = $(".user_role").val();
	var super_admin = $(".super_admin").val();
	var page = $(".page").val();

	var path = window.location.pathname;
	var path = path.toLowerCase();

	var extension = ".php";

	// console.log(path);
	// console.log(DomainName+"/newinvoice");
	var add_module = "";
	// if ( path.includes("international") ) {
	// 	var _module = 1;
	// 	var add_module = "/international";
	// } else {
	// 	var _module = 0;
	// }

	// if (path == DomainName+"/dashboard.php") {
	// 	if ( super_admin == 'YES' ) {

	// 		if (page == "supply_chain") {
	// 			document.getElementById("dashboardtarget").className = "link_active";
	// 			document.getElementById("supply_chain").className = "link_active";
	// 		} else if (page == "inventory") {
	// 			document.getElementById("dashboardtarget").className = "link_active";
	// 			document.getElementById("inventory").className = "link_active";
	// 		} else if (page == "timeline") {
	// 			document.getElementById("dashboardtarget").className = "link_active";
	// 			document.getElementById("timeline").className = "link_active";
	// 		} else {
	// 			document.getElementById("dashboardtarget").className = "link_active";
	// 			document.getElementById("financial").className = "link_active";
	// 		}
	// 	}
	// }

	// if (path == DomainName+"/accounttype.php") {
	// 	document.getElementById("manage_chartof_account").className = "link_active";
	// 	document.getElementById("account_type").className = "link_active";
	// }
	// if (path == DomainName+"/vouchers.php") {
	// 	document.getElementById("manage_chartof_account").className = "link_active";
	// 	document.getElementById("vouchers").className = "link_active";
	// }

	// if (path == DomainName+add_module+"/demands.php" || path == DomainName+add_module+"/newdemand.php" || path == DomainName+add_module+"/editdemand.php" || path == DomainName+add_module+"/viewdemand.php" || path == DomainName+add_module+"/verifydemand.php" || path == DomainName+"/viewdetail.php" || path == DomainName+add_module+"/pendingapprovals.php" || path == DomainName+"/pendingquotations.php") {
	// 	document.getElementById("demands").className = "link_active";
	// }

	if (path == DomainName+"/newquotation" || path == DomainName+"/editquotation.php" || path == DomainName+"/viewquotation.php") {
		document.getElementById("quotations").className = "link_active";
	}
	
	if (path == DomainName+"/newpurchase" || path == DomainName+"/editpurchase.php" || path == DomainName+"/openpurchases" || path == DomainName+"/viewpurchase.php") {
		document.getElementById("purchases").className = "link_active";
	}
	if (path == DomainName+"/newinvoice"+extension || path == DomainName+"/editinvoice.php" || path == DomainName+"/openinvoices" || path == DomainName+"/viewinvoice.php") {
		document.getElementById("invoices").className = "link_active";
	}
	// if (path == DomainName+add_module+"/purchase_orders.php" || path == DomainName+add_module+"/viewpo.php" || path == DomainName+add_module+"/editpo.php" ) {
	// 	document.getElementById("purchase_orders").className = "link_active";
	// }
	// if (path == DomainName+add_module+"/prfs.php" || path == DomainName+add_module+"/newprf.php" || path == DomainName+"/editprf.php" || path == DomainName+"/singleprf.php" || path == DomainName+"/pos_list.php" || path == DomainName+"/newprf2.php" || path == DomainName+"/adminprfs.php" || path == DomainName+"/newprfadmin.php" || path == DomainName+"/mtt_prfs.php" || path == DomainName+"/newprf-mtt.php" || path == DomainName+add_module+"/pendingitemslist.php") {
	// 	document.getElementById("prfs").className = "link_active";
	// }
	// if (path == DomainName+"/singleorder.php") {
	// 	document.getElementById("orders").className = "link_active";
	// }
	if (path == DomainName+"/newvendor" || path == DomainName+"/editvendor") {
		document.getElementById("vendors").className = "link_active";
	}
	if (path == DomainName+"/newclient" || path == DomainName+"/editclient") {
		document.getElementById("clients").className = "link_active";
	}
	if (path == DomainName+"/items" || path == DomainName+"/newitem" || path == DomainName+"/edititem.php" || path == DomainName+"/.php") {
		document.getElementById("manage_items").className = "link_active";
		document.getElementById("new_item").className = "link_active";
	}
	if (path == DomainName+"/brands" || path == DomainName+"/newbrand" || path == DomainName+"/editbrand.php") {
		document.getElementById("manage_items").className = "link_active";
		document.getElementById("brands").className = "link_active";
	}
	if (path == DomainName+"/models" || path == DomainName+"/newmodel" || path == DomainName+"/editmodel.php") {
		document.getElementById("manage_items").className = "link_active";
		document.getElementById("models").className = "link_active";
	}
	// if (path == DomainName+"/receivedhistory.php" || path == DomainName+"/issuedhistory.php" || path == DomainName+"/edit_received_history.php" || path == DomainName+"/edit_issued_history.php") {
	// 	document.getElementById("manage_items").className = "link_active";
	// 	document.getElementById("history").className = "link_active";
	// }
	// if (path == DomainName+add_module+"/issuancelist.php" || path == DomainName+add_module+"/issuance.php" || path == DomainName+"/issuance_list.php" || path == DomainName+"/issue_single_item.php") {
	// 	document.getElementById("manage_items").className = "link_active";
	// 	document.getElementById("issue_items").className = "link_active";
	// }
	// if (path == DomainName+add_module+"/receivinglist.php" || path == DomainName+add_module+"/receiving.php" || path == DomainName+"/receiving_list.php" || path == DomainName+"/receive_single_item.php") {
	// 	document.getElementById("manage_items").className = "link_active";
	// 	document.getElementById("receive_items").className = "link_active";
	// }
	if (path == DomainName+"/reports.php") {
		document.getElementById("additionals").className = "link_active";
		document.getElementById("reports").className = "link_active";
	}
	// if (path == DomainName+"/budgets.php") {
	// 	document.getElementById("additionals").className = "link_active";
	// 	document.getElementById("budgets").className = "link_active";
	// }
	// if (path == DomainName+"/projects.php") {
	// 	document.getElementById("additionals").className = "link_active";
	// 	document.getElementById("projects").className = "link_active";
	// }
	// if (path == DomainName+"/teams.php" || path == DomainName+"/newteam.php" || path == DomainName+"/editteam.php") {
	// 	document.getElementById("additionals").className = "link_active";
	// 	document.getElementById("teams").className = "link_active";
	// }
	// if (path == DomainName+"/resources.php") {
	// 	document.getElementById("additionals").className = "link_active";
	// 	document.getElementById("resources").className = "link_active";
	// }
	// if (path == DomainName+"/conversionrate.php") {
	// 	document.getElementById("additionals").className = "link_active";
	// 	document.getElementById("conversion_rate").className = "link_active";
	// }

	var y = document.getElementById("sideNavbar").querySelectorAll(".link_active #bydefault_svg");
  	for(var j = 0; j < y.length; j++) {
  		y[j].style.display = "none"; 
  	}
  	var y = document.getElementById("sideNavbar").querySelectorAll(".link_active #hover_svg");
  	for(var j = 0; j < y.length; j++) {
  		y[j].style.display = "inline-block"; 
  	}
	

	var currentLocation = location.href;
	currentLocation = currentLocation.toLowerCase();
	const menuItems = document.querySelectorAll('.anchor_tag');
	const menuLength = menuItems.length;
	for (let i = 0; i < menuLength; i++) {
			
		var menu = menuItems[i].href.toLowerCase();
		if (menu === currentLocation) {

			menuItems[i].className = "link_active";
			var y = document.getElementById("sideNavbar").querySelectorAll(".link_active #bydefault_svg");
		  	for(var j = 0; j < y.length; j++) {
		  		y[j].style.display = "none"; 
		  	}
		  	var y = document.getElementById("sideNavbar").querySelectorAll(".link_active #hover_svg");
		  	for(var j = 0; j < y.length; j++) {
		  		y[j].style.display = "inline-block"; 
		  	}
		}
	}

	if ($(window).width() < 900) {

		document.getElementById("signout_dropdown").style.display = 'none';
		document.getElementById("signout").style.display = 'none';

		document.getElementById("signout_layout").style.marginLeft = '35px';
		document.getElementById("signout_layout").style.width = '260px';
		
		$("#signout_image_layout").click(function(){
			$("#signout_dropdown").toggle();
		});
	}

	if ($(window).width() < 992) {
	   	
	   document.getElementById("inner_layout").style.marginLeft = '65px';
  		document.getElementById("inner_layout").style.padding = '0px';

		document.getElementById("sideNavbar").style.width = "62px";
		document.getElementById("navbar_top_layout_left").style.width = '65px';
		document.getElementById("heading").style.marginLeft = '40px';
		document.getElementById("vt_logo").style.textAlign = 'left';
	  	document.getElementById("vt_logo").style.marginLeft = '-10px';
	  	document.getElementById("vt_logo").style.marginTop = '14px';
	  	document.getElementById("vt_logo").style.width = '65px';
	  	document.getElementById("vt_logo").style.padding = '0px';
	  	document.getElementById("logo").style.width = '60px';
	  	// document.getElementById("logo_heading").style.display = 'none';
		document.getElementById("open_icon").style.marginRight = '-26px';
		document.getElementById("open_icon").style.marginTop = '0px';
  		document.getElementById("close_icon").style.display = 'none';
  		document.getElementById("close_icon").style.marginLeft = '65px';
  		document.getElementById("close_icon").style.zIndex = '10';

  		var x =document.getElementById("sideNavbar").querySelectorAll("a");
	  	for(var i = 0; i < x.length; i++) {
	  		x[i].style.padding = "9px 0px 8px 18px"; 
	  	}
	  	var elms = document.querySelectorAll("[id='navbar_text']");
	  	for(var i = 0; i < elms.length; i++) {
	  		elms[i].style.display='none';
	  	}

	  	// if ( _module ) {
		//   	var x =document.getElementById("service").querySelectorAll("a");
		//   	for(var i = 0; i < x.length; i++) {
		  		
		//   	}
	  	// }
	  	var elms = document.querySelectorAll("[id='inner_navbar_text']");
	  	for(var i = 0; i < elms.length; i++) {
	  		elms[i].style.display='none';
	  	}

	  	// if( $('.visit_mode_txt').length ) {
	  	// 	$('.visit_mode_txt').hide();
	  	// }
	  	// if( $('.switch_module_txt').length ) {
	  	// 	$('.switch_module_txt').hide();
	  	// }

	  	// //custom switch in navbar
	  	// if( $('.visit-mode').length ) {

	  	// 	$('.visit-mode').css({
		// 	    "left":"0px",
		// 	    "padding":"0px 10px" 
		// 	});
	  	// }
	  	// if( $('.switch-module').length ) {

	  	// 	$('.switch-module').css({
		// 	    "left":"0px",
		// 	    "padding":"0px 10px" 
		// 	});
	  	// }
	} else {
		document.getElementById("inner_layout").style.padding = '0px';

		document.getElementById("sideNavbar").style.width = "251px";
		document.getElementById("open_icon").style.display = 'none';
		document.getElementById("vt_logo").style.textAlign = 'center';
	  	document.getElementById("vt_logo").style.marginLeft = '0px';
	  	document.getElementById("vt_logo").style.marginTop = '0px';
	  	document.getElementById("vt_logo").style.width = '180px';
	  	document.getElementById("vt_logo").style.padding = '0px';
	  	document.getElementById("logo").style.width = '62px';
	  	// document.getElementById("logo_heading").style.marginTop = '-6px';

	  	document.getElementById("signout_dropdown").style.display = 'none';
	}

	$('.signout').click(function() {
		
		$.ajax({
			url : Domain+"/signout.php",
			method : "POST",
			data : {},			
			success : function(response) {
				window.location.href =  Domain+"/index.php";
			}
		});
	});

	// $('.visit_mode').on('click', function(){

	// 	var value;
	// 	var $this = $(this);

    //     if( $this.is(':checked') === true ) {
    //     	value = '1';
    //     }else{
    //     	value = '0';
    //     }

    //     $.ajax({
    //         type: 'POST',
    //         url: Domain+"/visit_mode_process.php",
    //         dataType: 'json',
    //         data:{
    //             action: 'ims_coo_visit_mode',
    //             'visit_mode_val': value,
    //         },
    //         beforeSend: function () {
    //         	$this.attr("disabled", true);
    //         	$this.closest('.row').find('.spinner-border').show();
    //         },
    //         success: function(data) {
    //         	// console.log(data);
    //         },
    //         error: function(xhr, status, error) {
    //             var err = eval("(" + xhr.responseText + ")");
    //             console.log(err.Message);
    //         },
    //         complete: function(){
    //         	$this.attr("disabled", false);
    //             $this.closest('.row').find('.spinner-border').hide();
    //         }
    //     });//end ajax
    // });//end visit_mode


    // $('.switch_module').on('click', function() {

    // 	let get_url = window.location.href;
    // 	get_url = get_url.toLowerCase();

    // 	let get_value = $(this).val();

    // 	if ($(this).is(':checked')) {
    // 		$(this).val(1);
    // 		// var result = get_url.replace("ims", "ims/International");
    // 		var result = "International/demands.php";
    // 	} else {
    // 		$(this).val(0);
    // 		// var result = get_url.replace("ims/international", "ims");
    // 		var result = "/ims/demands.php";
    // 	}
    // 	window.location.href = result;
    // })

    // $('.switch_module_radio').on('click', function() {

    // 	let get_url = window.location.href;
    // 	get_url = get_url.toLowerCase();

    // 	var get_value = $(this).val();
    // 	if (get_value == 1) {
    		
    // 		get_url = get_url.includes("international");
	//     	if (get_url) {
	//     		var result = "/ims/International/NewDemand.php";
	//     	} else {
	//     		var result = "International/NewDemand.php";	
	//     	}
    	
    // 	} else {
    // 		var result = "/ims/NewDemand.php";
    // 	}
    // 	window.location.href = result;
    // })
    


    // $('.switch-module-button').on('click', function() {

    // 	let get_url = window.location.href;
    // 	get_url = get_url.toLowerCase();
    // 	get_url = get_url.includes("international");

    // 	if (get_url) {
    // 		var result = "/ims/demands.php";
    // 	} else {
    // 		var result = "International/demands.php";	
    // 	}
    // 	window.location.href = result;    	
    // })

});//end jQuery


function openNav() {

	document.getElementById("sideNavbar").style.width = "253px";
	document.getElementById("navbar_top_layout_left").style.width = '250px';
  	// // document.getElementById("logo_heading").style.display = 'block';
  	// if( $('.visit_mode_txt').length ) {
  	// 	$('.visit_mode_txt').show();
  	// }
  	// if( $('.switch_module_txt').length ) {
  	// 	$('.switch_module_txt').show();
  	// }
  	
  	if ($(window).width() < 530) {
   	
		document.getElementById("navbar_top_layout_left").style.width = '65px';
	  	document.getElementById("navbar_top_layout_left").style.padding = '0px';
	  	document.getElementById("heading").style.marginLeft = '40px';
	  	document.getElementById("vt_logo").style.textAlign = 'left';
	  	document.getElementById("vt_logo").style.marginLeft = '5px';
	  	document.getElementById("vt_logo").style.marginTop = '15px';
	  	document.getElementById("vt_logo").style.width = '65px';
	  	document.getElementById("vt_logo").style.padding = '3px 0px 3px 0px';
	  	document.getElementById("logo").style.width = '60px';
	  	// document.getElementById("logo_heading").style.display = 'none';
		document.getElementById("open_icon").style.marginTop = '5px'; 
		document.getElementById("open_icon").style.display = 'none';
      	document.getElementById("close_icon").style.display = 'block';
      	document.getElementById("close_icon").style.marginRight = '-31px';
      	document.getElementById("close_icon").style.marginTop = '-49px';
      	document.getElementById("close_icon").style.zIndex = '10';
   	}
   	else if ($(window).width() < 850) {
   		document.getElementById("sideNavbar").style.width = "252px";
   		document.getElementById("heading").style.display = 'none';
   		document.getElementById("navbar_top_layout_left").style.padding = '5px 8px 5px 15px';
		document.getElementById("heading").style.marginLeft = '10px';
		document.getElementById("vt_logo").style.textAlign = 'center';
	  	document.getElementById("vt_logo").style.marginTop = '-1px';
	  	document.getElementById("vt_logo").style.width = '180px';
	  	document.getElementById("logo").style.width = '72px';
		document.getElementById("open_icon").style.display = 'none';
		document.getElementById("close_icon").style.display = 'block';
      	document.getElementById("close_icon").style.marginRight = '-4px';
      	document.getElementById("close_icon").style.marginTop = '-60px';
      	document.getElementById("close_icon").style.zIndex = '10';	
   	}
    else if ($(window).width() < 992) {

    	$(window).scroll(function(){
			// document.getElementById("sideNavbar").style.width = '65px';
		});
		document.getElementById("heading").style.display = 'none';
		document.getElementById("sideNavbar").style.width = "252px";
		document.getElementById("navbar_top_layout_left").style.padding = '5px 8px 5px 15px';
		document.getElementById("heading").style.marginLeft = '10px';
		document.getElementById("vt_logo").style.textAlign = 'center';
	  	document.getElementById("vt_logo").style.marginTop = '-1px';
	  	document.getElementById("vt_logo").style.width = '180px';
	  	document.getElementById("logo").style.width = '75px';
		document.getElementById("open_icon").style.display = 'none';
		document.getElementById("close_icon").style.display = 'block';
      	document.getElementById("close_icon").style.marginRight = '-4px';
      	document.getElementById("close_icon").style.marginTop = '-60px';
      	document.getElementById("close_icon").style.zIndex = '10';	
    } else {
		
		document.getElementById("inner_layout").style.marginLeft = '250px';
      	
      document.getElementById("navbar_top_layout_left").style.padding = '5px 8px 5px 15px';
		document.getElementById("heading").style.marginLeft = '15px';
		document.getElementById("vt_logo").style.textAlign = 'center';
	  	document.getElementById("vt_logo").style.marginLeft = '0px';
	  	document.getElementById("vt_logo").style.marginTop = '0px';
	  	document.getElementById("vt_logo").style.width = '180px';
	  	document.getElementById("logo").style.width = '62px';
	  	// document.getElementById("logo_heading").style.marginTop = '2px';
		document.getElementById("open_icon").style.display = 'none';
   	document.getElementById("close_icon").style.display = 'block';
   	document.getElementById("close_icon").style.marginRight = '-4px';
   	document.getElementById("close_icon").style.marginTop = '0px';
   	document.getElementById("close_icon").style.zIndex = '10';
	}

	// //custom switch in navbar
  	// if( $('.visit-mode').length ) {

  	// 	$('.visit-mode').css({
	// 	    "left":"5px",
	// 	    "padding":"0px 18px" 
	// 	});
  	// }
  	// if( $('.switch-module').length ) {

  	// 	$('.switch-module').css({
	// 	    "left":"5px",
	// 	    "padding":"0px 18px" 
	// 	});
  	// }
     
    var x = document.getElementById("sideNavbar").querySelectorAll("a");
  	for(var i = 0; i < x.length; i++) {
  		x[i].style.padding = "11px 0px 8px 20px"; 
  		x[i].style.fontSize = "16px"; 
  	}
	var elms = document.querySelectorAll("[id='navbar_text']");
  	for(var i = 0; i < elms.length; i++) {
  		elms[i].style.display='inline-block';
  	}
  	var elms = document.querySelectorAll("[id='inner_navbar_text']");
  	for(var i = 0; i < elms.length; i++) {
  		elms[i].style.display='inline-block';
  	}
}
function closeNav() {

  	document.getElementById("sideNavbar").style.width = "68px";
  	document.getElementById("sideNavbar").style.marginLeft = "-1px";
  	document.getElementById("close_icon").style.display = 'none';
  	document.getElementById("open_icon").style.display = 'block';

  	// if( $('.visit_mode_txt').length ) {
  	// 	$('.visit_mode_txt').hide();
  	// }
  	// if( $('.switch_module_txt').length ) {
  	// 	$('.switch_module_txt').hide();
  	// }

  	if ($(window).width() < 850 && $(window).width() > 768) {
   		document.getElementById("heading").style.display = 'none';
   	}
	if ($(window).width() < 992 && $(window).width() >= 850) {

		// document.getElementById("heading").style.display = 'block';
		document.getElementById("navbar_top_layout_left").style.width = '65px';
	  	document.getElementById("navbar_top_layout_left").style.padding = '0px';
	  	document.getElementById("heading").style.marginLeft = '40px';
	  	document.getElementById("vt_logo").style.textAlign = 'left';
	  	document.getElementById("vt_logo").style.marginLeft = '5px';
	  	document.getElementById("vt_logo").style.marginTop = '15px';
	  	document.getElementById("vt_logo").style.width = '65px';
	  	document.getElementById("logo").style.width = '60px';
	  	// document.getElementById("logo_heading").style.display = 'none';
		document.getElementById("open_icon").style.marginTop = '4px'; 	
	} else {

		// document.getElementById("demandTable").style.width = '100%';
		document.getElementById("inner_layout").style.marginLeft = '65px';

	  	document.getElementById("navbar_top_layout_left").style.width = '65px';
	  	document.getElementById("navbar_top_layout_left").style.padding = '0px';
	  	document.getElementById("heading").style.marginLeft = '40px';
	  	document.getElementById("open_icon").style.marginRight = '-32px';
	  	document.getElementById("open_icon").style.marginTop = '4px';
		document.getElementById("vt_logo").style.textAlign = 'left';
	  	document.getElementById("vt_logo").style.marginLeft = '3px';
	  	document.getElementById("vt_logo").style.marginTop = '4px';
	  	document.getElementById("vt_logo").style.width = '62px';
	  	document.getElementById("logo").style.width = '62px';
	  	// document.getElementById("logo_heading").style.display = 'none';
	}

	// //custom switch in navbar
  	// if( $('.visit-mode').length ) {

  	// 	$('.visit-mode').css({
	// 	    "left":"0px",
	// 	    "padding":"0px 10px" 
	// 	});
  	// }
  	// if( $('.switch-module').length ) {

  	// 	$('.switch-module').css({
	// 	    "left":"0px",
	// 	    "padding":"0px 10px" 
	// 	});
  	// }

	var x =document.getElementById("sideNavbar").querySelectorAll("a");
  	for(var i = 0; i < x.length; i++) {
  		x[i].style.padding = "11px 0px 8px 18px"; 
  	}
  	var x =document.getElementById("service").querySelectorAll("a");
  	for(var i = 0; i < x.length; i++) {
  		x[i].style.padding = "8px 0px 8px 18px"; 
  	}
  	var elms = document.querySelectorAll("[id='navbar_text']");
  	for(var i = 0; i < elms.length; i++) {
  		elms[i].style.display='none';
  	}
  	var elms = document.querySelectorAll("[id='inner_navbar_text']");
  	for(var i = 0; i < elms.length; i++) {
  		elms[i].style.display='none';
  	}
}


$('.session_expired').click(function(){
	window.location = "signout.php";
})