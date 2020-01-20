<?php
/**
 * Plugin Name: 	Tiny Bar
 * Plugin URI:		http://wordpress.org/plugins/tiny-bar/
 * Description: 	This Tiny Bar plugin display a bar to your website. You can place it at top or bottom of your webpage. It overlaps and hides when you scroll. Tiny Bar allows you to display a message to your visitors with a custom button.
 * Version: 		1.3
 * Author: 			Hossni Mubarak
 * Author URI: 		http://www.hossnimubarak.com
 * Text Domain: 	tiny-bar
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'WPINC' ) ) { die; }
if ( ! defined('ABSPATH') ) { exit; }

define( 'HMTB_PATH', plugin_dir_path( __FILE__ ) );
define( 'HMTB_ASSETS', plugins_url( '/assets/', __FILE__ ) );
define( 'PGC_LANG', plugins_url( '/languages/', __FILE__ ) );
define( 'HMTB_SLUG', plugin_basename( __FILE__ ) );
define( 'HMTB_PREFIX', 'hmtb_' );
define( 'HMTB_TEXT_DOMAIN', 'tiny-bar' );
define( 'HMTB_CLS_PREFIX', 'cls-hm-tiny-bar' );
define( 'HMTB_VERSION', '1.2' );

require_once HMTB_PATH . 'inc/' . HMTB_CLS_PREFIX . '-master.php';
$hmtb = new HMTB_Master();
register_activation_hook( __FILE__, array($hmtb, HMTB_PREFIX . 'register_settings') );
$hmtb->HMTB_run();
register_deactivation_hook( __FILE__, array($hmtb, HMTB_PREFIX . 'unregister_settings') );

