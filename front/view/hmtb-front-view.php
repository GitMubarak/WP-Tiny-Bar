<?php
$hmtb_front_prefix = substr(HMTB_PREFIX, 0, -1) . '-';

$hmtb_display_type          = ( null !== get_option('hmtb_display_type') ) ? get_option('hmtb_display_type') : 'hmtb-fixed';
$hmtb_display_option        = ( '' !== get_option('hmtb_display_option') ) ? get_option('hmtb_display_option') : 'top';
$hmtb_scroll_hide           = ( '' !== get_option('hmtb_scroll_hide') ) ? get_option('hmtb_scroll_hide') : '';
$hmtb_bar_height            = ( '' !== get_option('hmtb_bar_height') ) ? get_option('hmtb_bar_height') : 50;
echo $hmtb_content_width         = ( null !== get_option('hmtb_content_width' ) ) ? get_option('hmtb_content_width') : 500;
$hmtb_message_content       = ( '' !== get_option('hmtb_message_content') ) ? get_option('hmtb_message_content') : 'There is no message to display. Please add one.';
$hmtb_button_text           = ( '' !== get_option('hmtb_button_text') ) ? get_option('hmtb_button_text') : 'Button Text';
$hmtb_button_uri            = ( '' !== get_option('hmtb_button_uri') ) ? get_option('hmtb_button_uri') : '#';
$hmtb_button_url_is_external = ( 'true' === get_option('hmtb_button_url_is_external') ) ? 'target="_blank"' : '';
$hmtb_button_url_nofollow   = ( 'true' === get_option('hmtb_button_url_nofollow') ) ? 'rel="nofollow"' : '';

// Styling Settings
$hmtb_background_color      = ( '' !== get_option('hmtb_background_color') ) ? get_option('hmtb_background_color') : '#F6CA0F';
$hmtb_message_color         = ( '' !== get_option('hmtb_message_color') ) ? get_option('hmtb_message_color') : '#000000';
$hmtb_msg_font_size         = ( '' !== get_option('hmtb_msg_font_size') ) ? get_option('hmtb_msg_font_size') : 12;
$hmtb_button_color          = ( '' !== get_option('hmtb_button_color') ) ? get_option('hmtb_button_color') : '#d60000';
$hmtb_button_text_color     = ( '' !== get_option('hmtb_button_text_color') ) ? get_option('hmtb_button_text_color') : '#FFFFFF';
$hmtb_button_text_size      = ( '' !== get_option('hmtb_button_text_size') ) ? get_option('hmtb_button_text_size') : 12;
$hmtb_button_font_weight    = ( '' !== get_option('hmtb_button_font_weight') ) ? get_option('hmtb_button_font_weight') : 'normal';
?>

<style type="text/css">
<?php
if ( ( 'hmtb-fixed' === $hmtb_display_type ) && ( 'top' === $hmtb_display_option ) ) { echo 'ddd';
    ?>
    body {
        padding-top: <?php esc_html_e( $hmtb_bar_height ); ?>px!important;
    }
    @media(max-width:500px) {
        body {
            padding-top: <?php echo ( $hmtb_bar_height * 2 ); ?>px!important;
        }
    }
    <?php
}
?>
#hmtb-top-bar, #hmtb-footer-bar {
    background: <?php esc_html_e( $hmtb_background_color ); ?>!important;
    min-height: <?php esc_html_e( $hmtb_bar_height ); ?>px;
    color: <?php esc_html_e( $hmtb_message_color ); ?>;
}
.hmtb-content-wrapper {
    color: <?php esc_html_e( $hmtb_message_color ); ?>!important;
    grid-template-columns: auto 150px;
    max-width: <?php esc_html_e( $hmtb_content_width ); ?>px;
    min-height: <?php esc_html_e( $hmtb_bar_height ); ?>px;
}
.hmtb-msg-container {
  font-size: <?php esc_html_e( $hmtb_msg_font_size ); ?>px;
}
<?php 
if( 'hmtb-hide' === $hmtb_scroll_hide ) {
    ?>
    #hmtb-top-bar.hmtb-overlap.hmtb-hide, 
    #hmtb-footer-bar.hmtb-overlap.hmtb-hide {
        height: 0px;
        opacity:0.5;
        -moz-transition:all 0.5s ease-in-out;
        -o-transition:all 0.5s ease-in-out;
        transition:all 0.5s ease-in-out;
        -webkit-transition:all 0.5s ease-in-out;
    }
    #hmtb-top-bar.hmtb-overlap.hmtb-hide { top:-<?php echo esc_attr( $hmtb_bar_height ); ?>px; }
    #hmtb-footer-bar.hmtb-overlap.hmtb-hide { bottom:-<?php echo esc_attr( $hmtb_bar_height ); ?>px; }
    <?php 
} 
?>
.txtType { color: <?php echo $hmtb_message_color; ?>; }
.hmtb-btn-container a.hmtb-button {
    background: <?php echo esc_attr( $hmtb_button_color ); ?>;
    border-color: <?php echo esc_attr( $hmtb_button_color ); ?>;
    box-shadow: 0 1px 0 <?php echo esc_attr( $hmtb_button_color ); ?>;
    text-shadow: 0 -1px 1px <?php echo esc_attr( $hmtb_button_color ); ?>, 1px 0 1px <?php echo esc_attr( $hmtb_button_color ); ?>, 0 1px 1px <?php echo esc_attr( $hmtb_button_color ); ?>,-1px 0 1px <?php echo esc_attr( $hmtb_button_color ); ?>;
    color: <?php echo $hmtb_button_text_color; ?>;
    font-weight: <?php echo $hmtb_button_font_weight; ?>;
}
.hmtb-btn-container a.hmtb-button span.hmtb-btn-text {
    font-size: <?php echo esc_attr( $hmtb_button_text_size ); ?>px !important;
}
</style>

<?php
$hmtbHtml = '';
$hmtbHtml .= '<div class="hmtb-content-wrapper">';
/* 
if( '' != $hmtb_image ) :
$hmtbHtml .= '<div class="hmtb-img-container">';
    $hmtbHtml .= '<img src="' . esc_attr($hmtb_image) . '">';
$hmtbHtml .= '</div>';
endif; 
*/
$hmtbHtml .= '<div class="hmtb-msg-container">' . wp_kses_post( $hmtb_message_content ) . '</div>';
$hmtbHtml .= '<div class="hmtb-btn-container">';
$hmtbHtml .= '<a href="' . esc_url( $hmtb_button_uri ) . '" class="hmtb-button" ' . $hmtb_button_url_is_external . ' ' . $hmtb_button_url_nofollow . '>';
$hmtbHtml .= '<span class="hmtb-btn-text">' . esc_html( $hmtb_button_text ) . '</span>';
/*
if($hmtbButtonSubTxt != '') :
$hmtbHtml .= '<span class="hmtb-sub-btn-text">' . esc_html($hmtbButtonSubTxt) . '</span>';
endif;
*/
$hmtbHtml .= '</a>';
$hmtbHtml .= '</div>';
//$hmtbHtml .= '<span class="hmtb-close"><i class="fas fa-times-circle"></i></span>';
$hmtbHtml .= '</div>';

if ( 'top' === $hmtb_display_option ) {
    ?>
    <div id="hmtb-top-bar" class="<?php echo esc_attr( $hmtb_display_type ); ?>">
        <?php echo $hmtbHtml; ?>
    </div>
    <?php 
}

if( 'bottom' === $hmtb_display_option ) { 
    ?>
    <div id="hmtb-footer-bar" class="<?php echo esc_attr( $hmtb_display_type ); ?>">
        <?php echo $hmtbHtml; ?>
    </div>
    <?php 
} 
?>