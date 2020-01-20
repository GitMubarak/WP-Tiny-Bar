<?php settings_errors(); ?>
<div class="wrap" id="hmtb-settings-page-wrap">
    <div class="settings-banner">
        <h1 class="dashicons dashicons-archive" style="width:100%; text-align:left;">&nbsp;<?php esc_attr_e('TinyBar Admin Settings', HMTB_TEXT_DOMAIN); ?></h1>
    </div>
    <form method="post" action="options.php" class="hmtb-settings-form" id="hmtb-settings-form">
        <?php
        //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
        settings_fields( HMTB_PREFIX . 'options_group' );
        // all the add_settings_field callbacks is displayed here
        do_settings_sections("hmtb-admin-panel");
        submit_button();
        ?>
    </form>
</div>