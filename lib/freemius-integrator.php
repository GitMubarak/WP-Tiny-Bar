<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'tb_fs' ) ) {
    
    // Create a helper function for easy SDK access.
    function tb_fs() {

        global $tb_fs;

        if ( ! isset( $tb_fs ) ) {
            // Include Freemius SDK.
            require_once HMTB_PATH . '/freemius/start.php';

            $tb_fs = fs_dynamic_init( array(
                'id'                  => '8740',
                'slug'                => 'tiny-bar',
                'type'                => 'plugin',
                'public_key'          => 'pk_d71a605b1ee9227b411483a2e0be3',
                'is_premium'          => false,
                'premium_suffix'      => '',
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'menu'                => array(
                    'slug'           => 'hmtb-admin-panel',
                    'first-path'     => 'admin.php?page=hmtb-content-section',
                ),
            ) );
        }

        return $tb_fs;
    }

    // Init Freemius.
    tb_fs();

    // Signal that SDK was initiated.
    do_action( 'tb_fs_loaded' );

    tb_fs()->add_filter('connect_message_on_update', 'hmtb_fs_custom_connect_message_on_update', 10, 6);
    function hmtb_fs_custom_connect_message_on_update(
        $message,
        $user_first_name,
        $plugin_title,
        $user_login,
        $site_link,
        $freemius_link
    ) {
        return sprintf(
            __( 'Hey %1$s' ) . ',<br>' .
            __( 'Please help us improve %2$s! If you opt-in, some data about your usage of %2$s will be sent to %5$s. If you skip this, that\'s okay! %2$s will still work just fine.', 'tiny-bar' ),
            $user_first_name,
            '<b>' . $plugin_title . '</b>',
            '<b>' . $user_login . '</b>',
            $site_link,
            $freemius_link
        );
    }

    tb_fs()->add_filter( 'support_forum_url', 'hmtb_fs_support_forum_url' );
    function hmtb_fs_support_forum_url( $wp_support_url ) {
        return 'https://wordpress.org/support/plugin/hm-testimonial/';
    }
}