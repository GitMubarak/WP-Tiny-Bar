(function(window, $) {

    "use strict";

    jQuery('div#hmtb-top-bar').children(":first").addClass("txtType");
    jQuery('div#hmtb-footer-bar').children(":first").addClass("txtType");

    $(window).scroll(function() {
        if (jQuery(window).scrollTop() >= 500) {
            jQuery('#hmtb-top-bar.hmtb-overlap').addClass("hmtb-hide");
            jQuery('#hmtb-footer-bar.hmtb-overlap').addClass("hmtb-hide");
        }
        if (jQuery(window).scrollTop() < 500) {
            jQuery('#hmtb-top-bar.hmtb-overlap').removeClass("hmtb-hide");
            jQuery('#hmtb-footer-bar.hmtb-overlap').removeClass("hmtb-hide");
        }
    });

})(window, jQuery);