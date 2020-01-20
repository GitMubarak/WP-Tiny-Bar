<?php settings_errors(); ?>
<div class="wrap" id="hmtb-settings-page-wrap">
    <div class="settings-banner">
        <h1 class="dashicons dashicons-archive" style="width:100%; text-align:left;">&nbsp;<?php esc_attr_e('TinyBar Styles Settings', HMTB_TEXT_DOMAIN); ?></h1>
    </div>
    <form method="post" action="options.php" class="hmtb-settings-form" id="hmtb-styles-settings-form">
        <?php
        //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
        settings_fields( HMTB_PREFIX . 'option_group_styles' );
        // all the add_settings_field callbacks is displayed here
        do_settings_sections("hmtb-styles-section");
        submit_button();
        ?>
    </form>
</div>