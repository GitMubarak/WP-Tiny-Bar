<?php
if ( ! defined('ABSPATH') ) exit; 
settings_errors(); 
?>
<div class="wrap" id="hmtb-settings-page-wrap">

    <div class="settings-banner">
        <h1 style="width:100%; text-align:left;"><?php _e('Style Settings', HMTB_TEXT_DOMAIN); ?>:</h1>
    </div>

    <div class="hmtb-wrap">

        <div class="hmtb_personal_wrap hmtb_personal_help" style="width: 845px; float: left; margin-top: 5px;">

            <form method="post" action="options.php" class="hmtb-settings-form" id="hmtb-styles-settings-form">
                <?php
                settings_fields( HMTB_PREFIX . 'option_group_styles' );

                do_settings_sections("hmtb-styles-section");

                submit_button();
                ?>
            </form>

        </div>

        <?php $this->load_admin_sidebar(); ?>

    </div>

</div>