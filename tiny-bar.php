<?php

/**
 * Plugin Name: 	Tiny Bar
 * Plugin URI:		http://wordpress.org/plugins/tiny-bar/
 * Description: 	This Tiny Bar plugin display a bar to your website. You can place it at top or bottom of your webpage. It overlaps and hides when you scroll. Tiny Bar allows you to display a message to your visitors with a custom button.
 * Version: 		1.5
 * Author: 			HM Plugin
 * Author URI: 		https://hmplugin.com
 * Text Domain: 	tiny-bar
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined('ABSPATH') ) exit;

define('HMTB_PATH', plugin_dir_path(__FILE__));
define('HMTB_ASSETS', plugins_url('/assets/', __FILE__));
define('PGC_LANG', plugins_url('/languages/', __FILE__));
define('HMTB_SLUG', plugin_basename(__FILE__));
define('HMTB_PREFIX', 'hmtb_');
define('HMTB_TEXT_DOMAIN', 'tiny-bar');
define('HMTB_CLS_PREFIX', 'cls-hm-tiny-bar');
define('HMTB_VERSION', '1.5');

require_once HMTB_PATH . 'inc/' . HMTB_CLS_PREFIX . '-master.php';
$hmtb = new HMTB_Master();
$hmtb->HMTB_run();


register_activation_hook(__FILE__, array($hmtb, HMTB_PREFIX . 'register_settings'));

// Donation link to plugin description
add_filter( 'plugin_row_meta', 'hmtb_plugin_row_meta', 10, 2 );
function hmtb_plugin_row_meta( $links, $file ) {

    if ( HMTB_SLUG === $file ) {
        $row_meta = array(
          'hmtb_donation'    => '<a href="' . esc_url( 'https://www.paypal.me/mhmrajib/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Plugin Additional Links', HMTB_TEXT_DOMAIN ) . '" style="color:green; font-weight: bold;">' . esc_html__( 'Donate us', HMTB_TEXT_DOMAIN ) . '</a>'
        );
 
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}