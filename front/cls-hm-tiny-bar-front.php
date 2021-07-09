<?php
if ( ! defined('ABSPATH') ) exit;

/**
*	Front CLS
*/
class HMTB_Front 
{	
	private $hmtb_version;

	public function __construct( $version ) {
		$this->hmtb_version = $version;
		$this->hmtb_assets_prefix = substr(HMTB_PREFIX, 0, -1) . '-';
	}
	
	public function hmtb_front_styles() {

		wp_enqueue_style(	'hmtb_front_style',
							HMTB_ASSETS . 'css/' . $this->hmtb_assets_prefix . 'front-style.css',
							array(),
							$this->hmtb_version,
							FALSE );

	}
	
	public function hmtb_front_scripts() {
		
		wp_enqueue_script(	'hmtb_front_script',
							HMTB_ASSETS . 'js/' . $this->hmtb_assets_prefix . 'front-script.js',
							array(),
							$this->hmtb_version,
							FALSE );
	}
	
	public function hmtb_display_content() {
		
		include HMTB_PATH . 'front/view/' . $this->hmtb_assets_prefix . 'front-view.php';
	}
}
?>