(function( window, $ ) {
	
	"use strict";
	
	jQuery('div#hmtb-top-bar').children(":first").addClass("txtType");
	jQuery('div#hmtb-footer-bar').children(":first").addClass("txtType");		

	$(window).scroll(function() {
		if(jQuery(window).scrollTop() >= 500 ) {
			jQuery('#hmtb-top-bar').addClass("hide");
			jQuery('#hmtb-footer-bar').addClass("hide");
		}
		if(jQuery(window).scrollTop() < 500) {
			jQuery('#hmtb-top-bar').removeClass("hide");
			jQuery('#hmtb-footer-bar').removeClass("hide");
		}
	});

})( window, jQuery );