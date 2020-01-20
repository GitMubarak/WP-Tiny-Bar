<?php
/**
*	Admin Panel Parent CLS
*/
class HMTB_Admin 
{	
	private $hmtb_version;
	private $hmtb_option_group;
	private $hmtb_assets_prefix;

	public function __construct( $version ) {
		$this->hmtb_version = $version;
		$this->hmtb_option_group = HMTB_PREFIX . 'options_group';
		$this->hmtb_assets_prefix = substr(HMTB_PREFIX, 0, -1) . '-';
	}
	
	/**
	*	Loading the admin menu
	*/
	public function hmtb_admin_menu() {
		
		add_menu_page(	esc_html__('Tiny Bar', HMTB_TEXT_DOMAIN),
						esc_html__('Tiny Bar', HMTB_TEXT_DOMAIN),
						'manage_options', // area of the admin panel
						'hmtb-admin-panel',
						array( $this, HMTB_PREFIX . 'load_admin_panel' ),
						'dashicons-archive',
						100 
					);
	}
	
	/**
	*	Loading admin panel assets
	*/
	public function hmtb_enqueue_style() {
		
		wp_enqueue_style(
			$this->hmtb_assets_prefix . 'admin-style',
			HMTB_ASSETS . 'css/' . $this->hmtb_assets_prefix . 'admin-style.css',
			array(),
			$this->hmtb_version,
			FALSE
		);
		wp_enqueue_style( 'wp-color-picker');
	}

	/**
	*	Loading admin panel script
	*/
	public function hmtb_enqueue_script() {
		
		wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_script(
			$this->hmtb_assets_prefix . 'admin-script',
			HMTB_ASSETS . 'js/' . $this->hmtb_assets_prefix . 'admin-script.js',
			array(),
			$this->hmtb_version,
			FALSE
		);
	}
	
	/**
	*	Loading admin panel view/forms
	*/
	public function hmtb_load_admin_panel() {
		require_once HMTB_PATH . 'admin/view/' . $this->hmtb_assets_prefix . 'admin-settings.php';
	}
	
	/**
	*	Loading register settings
	*/
	public function hmtb_register_settings() {
		
		add_settings_section( $this->hmtb_option_group, esc_html__( '', HMTB_TEXT_DOMAIN ), null, "hmtb-admin-panel" );
		add_settings_field( "hmtb_display_option", esc_html__( 'Bar Position', HMTB_TEXT_DOMAIN ), array(&$this, "hmtb_display_option"), "hmtb-admin-panel", $this->hmtb_option_group );
		add_settings_field( "hmtb_scroll_hide", esc_html__( 'Hide When Scroll?', HMTB_TEXT_DOMAIN ), array(&$this, "hmtb_scroll_hide"), "hmtb-admin-panel", $this->hmtb_option_group );
		add_settings_field( "hmtb_background_color", esc_html__( 'Bar Background Color', HMTB_TEXT_DOMAIN ), array(&$this, "hmtb_background_color"), "hmtb-admin-panel", $this->hmtb_option_group );
		add_settings_field( "hmtb_bar_height", esc_html__( 'Bar Height', HMTB_TEXT_DOMAIN ), array(&$this, "hmtb_bar_height"), "hmtb-admin-panel", $this->hmtb_option_group );
		
		add_settings_field( "hmtb_message_content", esc_html__( 'Message / Content', HMTB_TEXT_DOMAIN ), array(&$this, "hmtb_message_content"), "hmtb-admin-panel", $this->hmtb_option_group );
		add_settings_field( "hmtb_message_color", esc_html__( 'Message Color', HMTB_TEXT_DOMAIN ), array(&$this, "hmtb_message_color"), "hmtb-admin-panel", $this->hmtb_option_group );
		
		add_settings_field( "hmtb_button_text", esc_html__( 'Button Text', HMTB_TEXT_DOMAIN ), array(&$this, "hmtb_button_text"), "hmtb-admin-panel", $this->hmtb_option_group );
		add_settings_field( "hmtb_button_color", esc_html__( 'Button Color', HMTB_TEXT_DOMAIN ), array(&$this, "hmtb_button_color"), "hmtb-admin-panel", $this->hmtb_option_group );
		add_settings_field( "hmtb_button_uri", esc_html__( 'Button URL', HMTB_TEXT_DOMAIN ), array(&$this, "hmtb_button_uri"), "hmtb-admin-panel", $this->hmtb_option_group );
		
		// Basic Settings
		register_setting( $this->hmtb_option_group, HMTB_PREFIX . 'display_option' );
		register_setting( $this->hmtb_option_group, HMTB_PREFIX . 'scroll_hide' );
		register_setting( $this->hmtb_option_group, HMTB_PREFIX . 'background_color' );
		register_setting( $this->hmtb_option_group, HMTB_PREFIX . 'bar_height' );
		
		// Message Settings
		register_setting( $this->hmtb_option_group, HMTB_PREFIX . 'message_content' );
		register_setting( $this->hmtb_option_group, HMTB_PREFIX . 'message_color' );
		
		// Button Settings
		register_setting( $this->hmtb_option_group, HMTB_PREFIX . 'button_text' );
		register_setting( $this->hmtb_option_group, HMTB_PREFIX . 'button_color' );
		register_setting( $this->hmtb_option_group, HMTB_PREFIX . 'button_uri' );
	}

	function hmtb_display_option() { 
		?>
		<input type="radio" name="hmtb_display_option" class="hmtb_display_option" value="top" <?php if(get_option('hmtb_display_option') == "top") { echo 'checked'; } ?>>
		<label for="default-templates"><span></span><?php esc_attr_e('Top', HMTB_TEXT_DOMAIN); ?></label>
		&nbsp;&nbsp;
		<input type="radio" name="hmtb_display_option" class="hmtb_display_option" value="bottom" <?php if(get_option('hmtb_display_option') == "bottom") { echo 'checked'; } ?>>
		<label for="csutom-design"><span></span><?php esc_attr_e('Bottom', HMTB_TEXT_DOMAIN); ?></label>
		<?php 
	}

	function hmtb_scroll_hide() {
		?>
		<input type="checkbox" name="hmtb_scroll_hide" class="hmtb_scroll_hide" value="hide" <?php if(get_option('hmtb_scroll_hide') == "hide") { echo 'checked'; } ?>>
		<?php
	}

	function hmtb_background_color() {
		?>
		<input class="hmtb_background_color hmtb-wp-color" type="text" name="hmtb_background_color" id="hmtb_background_color" value="<?php echo get_option( HMTB_PREFIX . 'background_color' ); ?>">
		<div id="colorpicker"></div>
		<?php
	}

	function hmtb_bar_height() {
		?>
		<input class="gui-input options responsive width" type="number" min="12" max="150" step="1" name="hmtb_bar_height" value="<?php echo sanitize_text_field(get_option( HMTB_PREFIX . 'bar_height' )); ?>">
		<label class="field-icon"><?php esc_attr_e('px', HMTB_TEXT_DOMAIN); ?></label>
		<?php
	}

	function hmtb_message_content() {
		?>
		<textarea cols="40" style="min-height:100px;" name="hmtb_message_content"><?php echo stripslashes(get_option( HMTB_PREFIX . 'message_content' )); ?></textarea>
		<br>
		<label class="field-icon"><?php esc_attr_e('Accept HTML, like: H1, H2, H3, P etc.', HMTB_TEXT_DOMAIN); ?></label>
		<?php
	}

	function hmtb_message_color() {
		?>
		<input class="hmtb_message_color hmtb-wp-color" type="text" name="hmtb_message_color" id="hmtb_message_color" value="<?php echo get_option( HMTB_PREFIX . 'message_color' ); ?>">
		<div id="colorpicker"></div>
		<?php
	}

	function hmtb_button_text() {
		?>
		<input type="text" name="hmtb_button_text" class="hmtb_button_text" id="hmtb_button_text" value="<?php echo sanitize_text_field(get_option( HMTB_PREFIX . 'button_text' )); ?>">
		<?php
	}

	function hmtb_button_color() {
		?>
		<input class="hmtb_button_color hmtb-wp-color" type="text" name="hmtb_button_color" id="hmtb_button_color" value="<?php echo get_option( HMTB_PREFIX . 'button_color' ); ?>">
		<div id="colorpicker"></div>
		<?php
	}

	function hmtb_button_uri() {
		?>
		<input type="text" name="hmtb_button_uri" class="hmtb_button_uri" id="hmtb_button_uri" style="width:300px;" value="<?php echo sanitize_text_field(get_option( HMTB_PREFIX . 'button_uri' )); ?>">
		<br>
		<label class="field-icon"><?php esc_attr_e('Use http:// or https://', HMTB_TEXT_DOMAIN); ?></label>
		<?php
	}
}
?>