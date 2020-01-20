(function( $ ) {

    // USE STRICT
    "use strict";

    var hmtbColorPicker = ['#hmtb_background_color', '#hmtb_message_color', '#hmtb_button_color'];

    $.each(hmtbColorPicker, function( index, value ) {
        $(value).wpColorPicker();
    });

    $("form#hmtb-settings-form").on('click', 'label', function(e) {
        e.preventDefault();
        var $check = $(this).prev();
        $check.prop( "checked", true ).trigger('change');
    });

})( jQuery );