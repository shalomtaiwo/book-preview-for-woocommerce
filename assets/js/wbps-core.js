// wbps_preview_popup wbps_open
function popupOpenp() {
	document.getElementById("wbps_show_current_preview_pdf").style.cssText= "display: block; animation-name: fade-in;animation-duration: 0.7s;animation-direction:alternate;";
}
function popupOpen() {
	document.getElementById("wbps_show_current_preview").style.cssText= "display: block; animation-name: fade-in;animation-duration: 0.7s;animation-direction:alternate;";
}
function popupOpensimple() {
	document.getElementById("wbps_simple_popup").style.cssText= "display: block; animation-name: fade-in;animation-duration: 0.7s;animation-direction:alternate;";
}
function popupOpensimplepdf() {
	document.getElementById("wbps_simple_popup_pdf").style.cssText= "display: block; animation-name: fade-in;animation-duration: 0.7s;animation-direction:alternate;";
}
// wbps_preview_popup Close
function popupClosep() {
	document.getElementById("wbps_show_current_preview_pdf").style.cssText= "animation: hide 0.3s linear;animation-fill-mode: forwards;";
}  
function popupClosesimple() {
	document.getElementById("wbps_simple_popup").style.cssText= "animation: hide 0.3s linear;animation-fill-mode: forwards;";
} 
function popupClosesimplep() {
	document.getElementById("wbps_simple_popup_pdf").style.cssText= "animation: hide 0.3s linear;animation-fill-mode: forwards;";
} 
function popupClose() {
	document.getElementById("wbps_show_current_preview").style.cssText= "animation: hide 0.3s linear;animation-fill-mode: forwards;";
}
//Overlay and Background position
jQuery(function($) {
	$(document).ready(function() {
		$("#wbps_popup_btn").click(function(e) {
			e.stopPropagation();
			$("body").addClass("wbps_stop");
			$("html").addClass("wbps_stop");
		});
		$("#wbps_popup_btnp").click(function(e) {
			e.stopPropagation();
			$("body").addClass("wbps_stop");
			$("html").addClass("wbps_stop");
		});
		$("#wbps_popup_btnsimple").click(function(e) {
			e.stopPropagation();
			$("body").addClass("wbps_stop");
			$("html").addClass("wbps_stop");
		});
		$("#wbps_popup_btnsimple_pdf").click(function(e) {
			e.stopPropagation();
			$("body").addClass("wbps_stop");
			$("html").addClass("wbps_stop");
		});
		$(".wbps_mycontent_close").click(function(e) {
			e.stopPropagation();
			$("body").removeClass("wbps_stop");
			$("html").removeClass("wbps_stop");
		});
		$(".wbps_mycontent_close_pdf").click(function(e) {
			e.stopPropagation();
			$("body").removeClass("wbps_stop");
			$("html").removeClass("wbps_stop");
		});
		$("#wbps_close_button_position").click(function() {
			$("body").removeClass("wbps_stop");
			$("html").removeClass("wbps_stop");
		});
		$("#wbps_close_button_position_p").click(function() {
			$("body").removeClass("wbps_stop");
			$("html").removeClass("wbps_stop");
		});
		$("#wbps_close_sticky_position_r").click(function() {
			$("body").removeClass("wbps_stop");
			$("html").removeClass("wbps_stop");
		});
		$("#wbps_close_sticky_position").click(function() {
			$("body").removeClass("wbps_stop");
			$("html").removeClass("wbps_stop");
		});
		
	});
});

//Prevent right clicking on preview contents
jQuery(function($) {
	$(document).ready(function() {
		$("#wbps-no-click").on("contextmenu", function() {
			return false;
		});
	});
});