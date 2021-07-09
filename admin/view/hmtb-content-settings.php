<?php
if ( ! defined('ABSPATH') ) exit;
settings_errors(); 
?>
<div class="wrap" id="hmtb-settings-page-wrap">
    <div class="settings-banner">
        <h1 style="width:100%; text-align:left;"><?php _e('Content Settings', HMTB_TEXT_DOMAIN); ?>:</h1>
    </div>
    <form method="post" action="options.php" class="hmtb-settings-form" id="hmtb-content-settings-form">
        <?php
        settings_fields( HMTB_PREFIX . 'options_group' );
        do_settings_sections("hmtb-content-section");
        submit_button();
        ?>
    </form>
</div>