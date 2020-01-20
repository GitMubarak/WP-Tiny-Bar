<?php
/**
 * Our main plugin CLS
*/
class HMTB_Master 
{
	protected $hmtb_loader;
	protected $hmtb_version;
	
	/**
	 * CLS Constructor
	*/
	public function __construct(){
		$this->hmtb_version = HMTB_VERSION;
		add_action( 'plugins_loaded', array($this, HMTB_PREFIX . 'load_plugin_textdomain') );
		$this->hmtb_load_dependencies();
		$this->hmtb_trigger_admin_hooks();
		$this->hmtb_trigger_front_hooks();
	}

	function hmtb_load_plugin_textdomain() {
		load_plugin_textdomain( HMTB_TEXT_DOMAIN, FALSE, HMTB_TEXT_DOMAIN . '/languages/' );
	}

	private function hmtb_load_dependencies(){
		require_once HMTB_PATH . 'admin/' . HMTB_CLS_PREFIX . '-admin.php';
		require_once HMTB_PATH . 'front/' . HMTB_CLS_PREFIX . '-front.php';
		
		require_once HMTB_PATH . 'inc/' . HMTB_CLS_PREFIX . '-loader.php';
		$this->hmtb_loader = new HMTB_Loader();
	}
	
	private function hmtb_trigger_admin_hooks(){

		$hmtb_admin = new HMTB_Admin( $this->hmtb_version() );
		$this->hmtb_loader->add_action( 'admin_menu', $hmtb_admin, HMTB_PREFIX . 'admin_menu' );
		$this->hmtb_loader->add_action( 'admin_enqueue_scripts', $hmtb_admin, HMTB_PREFIX . 'enqueue_style' );
		$this->hmtb_loader->add_action( 'admin_footer', $hmtb_admin, HMTB_PREFIX . 'enqueue_script', 10 );
		$this->hmtb_loader->add_action( 'admin_init', $hmtb_admin, HMTB_PREFIX . 'register_settings' );
	}
	
	private function hmtb_trigger_front_hooks(){

		$hmtb_front = new HMTB_Front( $this->hmtb_version() );
		$this->hmtb_loader->add_action( 'wp_head', $hmtb_front, 'hmtb_front_styles' );
		$this->hmtb_loader->add_action( 'wp_head', $hmtb_front, 'hmtb_front_scripts' );
		$this->hmtb_loader->add_action( 'wp_footer', $hmtb_front, 'hmtb_display_content' );
	}
	
	function hmtb_run(){
		$this->hmtb_loader->hmtb_run();
	}
	
	function hmtb_version(){
		return $this->hmtb_version;
	}

	function hmtb_register_settings(){
		update_option('hmtb_display_option', 'top');	
		update_option('hmtb_background_color', '#1F334A');
		update_option('hmtb_button_color', '#00A9CE');
	}

	function hmtb_unregister_settings(){
		global $wpdb;
	
		$tbl = $wpdb->prefix . 'options';
		$search_string = HMTB_PREFIX .'%';
		
		$sql = $wpdb->prepare( "SELECT option_name FROM $tbl WHERE option_name LIKE %s", $search_string );
		$options = $wpdb->get_results( $sql , OBJECT );
	
		if(is_array($options) && count($options)){
			foreach( $options as $option ) {
				delete_option( $option->option_name );
				delete_site_option( $option->option_name );
			}
		}
	}
}
?>