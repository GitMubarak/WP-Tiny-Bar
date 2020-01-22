<?php
$hmtb_front_prefix = substr(HMTB_PREFIX, 0, -1) . '-';

$bg = (get_option( HMTB_PREFIX . 'background_color')!='') ? get_option( HMTB_PREFIX . 'background_color') : '#999';
$barHeight = (get_option( HMTB_PREFIX . 'bar_height')!='') ? sanitize_text_field(get_option( HMTB_PREFIX . 'bar_height')) : 100;

$msgColor = (get_option( HMTB_PREFIX . 'message_color')!='') ? get_option( HMTB_PREFIX . 'message_color') : '#FFF';

$hmtbButtonTxt  = (get_option( HMTB_PREFIX . 'button_text')!='') ? sanitize_text_field(get_option( HMTB_PREFIX . 'button_text')) : 'Button Text';
$btnClr = (get_option( HMTB_PREFIX . 'button_color')!='') ? get_option( HMTB_PREFIX . 'button_color') : '#0085ba';
$hmtbButtonUrl = (get_option( HMTB_PREFIX . 'button_uri')!='') ? sanitize_text_field(get_option( HMTB_PREFIX . 'button_uri')) : '#';
$hmtbButtonUrlTarget = (get_option( HMTB_PREFIX . 'button_url_is_external') == true) ? ' target="_blank"' : '';
$hmtbButtonUrlNofollow = (get_option( HMTB_PREFIX . 'button_url_nofollow') == true) ? ' rel="nofollow"' : '';
$hmtbBtnTxtClr = (get_option( HMTB_PREFIX . 'button_text_color')!='') ? get_option( HMTB_PREFIX . 'button_text_color') : '#FFF';
$hmtbBtnFntWeight = (get_option( HMTB_PREFIX . 'button_font_weight')!='') ? get_option( HMTB_PREFIX . 'button_font_weight') : 'normal';
?>

<style type="text/css">
#hmtb-top-bar, #hmtb-footer-bar {
    background: <?php echo $bg; ?>;
    min-height: <?php echo $barHeight; ?>px;
    color: <?php echo $msgColor; ?>;
}
<?php if('hide' == get_option('hmtb_scroll_hide')) { ?>
#hmtb-top-bar.hide, #hmtb-footer-bar.hide {
    height: 0px;
    opacity:0.5;

    -moz-transition:all 0.5s ease-in-out;
    -o-transition:all 0.5s ease-in-out;
    transition:all 0.5s ease-in-out;
    -webkit-transition:all 0.5s ease-in-out;
}
#hmtb-top-bar.hide { top:-<?php echo $barHeight; ?>px; }
#hmtb-footer-bar.hide { bottom:-<?php echo $barHeight; ?>px; }
<?php } ?>
.txtType { color: <?php echo $msgColor; ?>; }
.hmtb-btn-container a.hmtb-button {
    background: <?php echo $btnClr; ?>;
    border-color: <?php echo $btnClr; ?> <?php echo $btnClr; ?> <?php echo $btnClr; ?>;
    box-shadow: 0 1px 0 <?php echo $btnClr; ?>;
    text-shadow: 0 -1px 1px <?php echo $btnClr; ?>,1px 0 1px <?php echo $btnClr; ?>,0 1px 1px <?php echo $btnClr; ?>,-1px 0 1px <?php echo $btnClr; ?>;
    color: <?php echo $hmtbBtnTxtClr; ?>;
    font-weight: <?php echo $hmtbBtnFntWeight; ?>;
}
</style>

<?php if(get_option( HMTB_PREFIX . 'display_option') == "top") { ?>
<div id="hmtb-top-bar">
    <div class="hmtb-msg-container">
        <?php echo (null != get_option(HMTB_PREFIX . 'message_content')) ? wp_kses_post(get_option( HMTB_PREFIX . 'message_content')) : esc_attr('There is no message to display right now.'); ?>
	</div>
    <div class="hmtb-btn-container">
        <a href="<?php echo esc_url( $hmtbButtonUrl ); ?>" class="hmtb-button" <?php echo $hmtbButtonUrlTarget . $hmtbButtonUrlNofollow; ?>>
            <?php echo esc_html( $hmtbButtonTxt ); ?>
        </a>
    </div>
</div>
<?php } ?>

<?php if(get_option( HMTB_PREFIX . 'display_option') == "bottom") { ?>
<div id="hmtb-footer-bar">
    <div class="hmtb-msg-container">
        <?php echo (null != get_option(HMTB_PREFIX . 'message_content')) ? wp_kses_post(get_option( HMTB_PREFIX . 'message_content')) : esc_attr('There is no message to display right now.'); ?>
	</div>
    <div class="hmtb-btn-container">
        <a href="<?php echo esc_url( $hmtbButtonUrl ); ?>" class="hmtb-button" <?php echo $hmtbButtonUrlTarget . $hmtbButtonUrlNofollow; ?>>
            <?php echo esc_html( $hmtbButtonTxt ); ?>
        </a>
    </div>
</div>
<?php } ?>