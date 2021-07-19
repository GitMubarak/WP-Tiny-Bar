<?php
if ( ! defined('ABSPATH') ) exit;

include HMTB_PATH . 'common/hmtb-common.php';

/**
 *	Master Class Admin
 */
class HMTB_Admin
{
	use Hmtb_Common;

	private $hmtb_version;
	private $hmtb_option_group;
	private $hmtb_assets_prefix;

	function __construct( $version ) {

		$this->hmtb_version = $version;
		$this->hmtb_option_group = HMTB_PREFIX . 'options_group';
		$this->hmtb_option_group_styles = HMTB_PREFIX . 'option_group_styles';
		$this->hmtb_assets_prefix = substr(HMTB_PREFIX, 0, -1) . '-';
	}

	/**
	 *	Loading the admin menu
	 */
	function hmtb_admin_menu() {

		add_menu_page(
			__('Tiny Bar', HMTB_TEXT_DOMAIN),
			__('Tiny Bar', HMTB_TEXT_DOMAIN),
			'',
			'hmtb-admin-panel',
			'',
			'dashicons-minus',
			100
		);

		add_submenu_page(
			'hmtb-admin-panel',
			__('Content Settings', HMTB_TEXT_DOMAIN),
			__('Content Settings', HMTB_TEXT_DOMAIN),
			'manage_options',
			'hmtb-content-section',
			array( $this, HMTB_PREFIX . 'content_section' )
		);


		add_submenu_page(
			'hmtb-admin-panel',
			__('Styles Settings', HMTB_TEXT_DOMAIN),
			__('Styles Settings', HMTB_TEXT_DOMAIN),
			'manage_options',
			'hmtb-styles-section',
			array( $this, HMTB_PREFIX . 'styles_section' )
		);
	}

	/**
	 *	Loading admin panel assets
	 */
	function hmtb_enqueue_style() {

		wp_enqueue_style('wp-color-picker');

		wp_enqueue_style(
			$this->hmtb_assets_prefix . 'admin-style',
			HMTB_ASSETS . 'css/' . $this->hmtb_assets_prefix . 'admin-style.css',
			array(),
			$this->hmtb_version,
			FALSE
		);
	}

	/**
	 *	Loading admin panel script
	 */
	function hmtb_enqueue_script() {

		if ( ! wp_script_is('jquery') ) {
			wp_enqueue_script('jquery');
		}

		wp_enqueue_script('wp-color-picker');

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
	function hmtb_content_section() {

		require_once HMTB_PATH . 'admin/view/' . $this->hmtb_assets_prefix . 'content-settings.php';
	}

	function hmtb_styles_section() {

		require_once HMTB_PATH . 'admin/view/' . $this->hmtb_assets_prefix . 'styles-settings.php';
	}

	/**
	 *	Loading register settings
	 */
	function hmtb_register_settings() {

		add_settings_section( $this->hmtb_option_group, '', null, 'hmtb-content-section' );
		// ==================================
		add_settings_field( 'hmtb_display_type', __( 'Display Type', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_display_type' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_display_option', __( 'Display Position', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_display_option' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_scroll_hide', __( 'Hide When Scroll?', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_scroll_hide' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_bar_height', __( 'Bar Height', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_bar_height' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_content_width', __( 'Content Width', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_content_width' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_message_content', __( 'Message / Content', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_message_content' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_button_text', __( 'Button Text', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_text' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_button_uri', __( 'Button URL', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_uri' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_button_url_is_external', __( 'Button URL Is External?', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_url_is_external' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_button_url_nofollow', __( 'Button URL Nofollow?', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_url_nofollow' ), 'hmtb-content-section', $this->hmtb_option_group );

		// ==================================
		add_settings_section( $this->hmtb_option_group_styles, '', null, 'hmtb-styles-section' );
		add_settings_field( 'hmtb_background_color', __( 'Bar Background Color', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_background_color' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_message_color', __( 'Message Font Color', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_message_color' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_msg_font_size', __( 'Message Font Size', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_msg_font_size' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_button_color', __( 'Button Color', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_color' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_button_text_color', __( 'Button Font Color', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_text_color' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_button_text_size', __( 'Button Font Size', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_text_size' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_button_font_weight', __( 'Button Font Weight', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_font_weight' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );

		// Content Settings
		register_setting( $this->hmtb_option_group, 'hmtb_display_type' );
		register_setting( $this->hmtb_option_group, 'hmtb_display_option' );
		register_setting( $this->hmtb_option_group, 'hmtb_scroll_hide' );
		register_setting( $this->hmtb_option_group, 'hmtb_bar_height' );
		register_setting( $this->hmtb_option_group, 'hmtb_content_width' );
		register_setting( $this->hmtb_option_group, 'hmtb_message_content' );
		register_setting( $this->hmtb_option_group, 'hmtb_button_text' );
		register_setting( $this->hmtb_option_group, 'hmtb_button_uri' );
		register_setting( $this->hmtb_option_group, 'hmtb_button_url_is_external' );
		register_setting( $this->hmtb_option_group, 'hmtb_button_url_nofollow' );

		// Style Settings
		register_setting( $this->hmtb_option_group_styles, 'hmtb_background_color' );
		register_setting( $this->hmtb_option_group_styles, 'hmtb_message_color' );
		register_setting( $this->hmtb_option_group_styles, 'hmtb_msg_font_size' );
		register_setting( $this->hmtb_option_group_styles, 'hmtb_button_color' );
		register_setting( $this->hmtb_option_group_styles, 'hmtb_button_text_color' );
		register_setting( $this->hmtb_option_group_styles, 'hmtb_button_text_size' );
		register_setting( $this->hmtb_option_group_styles, 'hmtb_button_font_weight' );
	}

	function hmtb_display_type() {
		?>
		<input type="radio" name="hmtb_display_type" id="hmtb_display_type_fixed" value="hmtb-fixed" <?php echo ( 'hmtb-overlap' !== get_option('hmtb_display_type') ) ? 'checked' : ''; ?> >
		<label for="hmtb_display_type_fixed"><span></span><?php _e( 'Fixed', HMTB_TEXT_DOMAIN ); ?></label>
			&nbsp;&nbsp;
		<input type="radio" name="hmtb_display_type" id="hmtb_display_type_overlap" value="hmtb-overlap" <?php echo ( 'hmtb-overlap' === get_option('hmtb_display_type') ) ? 'checked' : ''; ?> >
		<label for="hmtb_display_type_overlap"><span></span><?php _e( 'Overlap', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_display_option() {
		?>
		<input type="radio" name="hmtb_display_option" id="hmtb_display_option_top" value="top" <?php echo ( 'bottom' !== get_option('hmtb_display_option') ) ? 'checked' : ''; ?> >
		<label for="hmtb_display_option_top"><span></span><?php _e( 'Top', HMTB_TEXT_DOMAIN ); ?></label>
			&nbsp;&nbsp;
		<input type="radio" name="hmtb_display_option" id="hmtb_display_option_bottom" value="bottom" <?php echo ( 'bottom' === get_option('hmtb_display_option') ) ? 'checked' : ''; ?> >
		<label for="hmtb_display_option_bottom"><span></span><?php _e( 'Bottom', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_scroll_hide() {
		?>
		<input type="checkbox" name="hmtb_scroll_hide" class="hmtb_scroll_hide" value="hmtb-hide" <?php echo ( 'hmtb-hide' === get_option('hmtb_scroll_hide') ) ? 'checked' : ''; ?> >
		<?php
	}

	function hmtb_bar_height() {
		?>
		<input class="gui-input options responsive width" type="number" min="12" max="150" step="1" name="hmtb_bar_height" value="<?php esc_attr_e( get_option('hmtb_bar_height') ); ?>">
		<label class="field-icon"><?php _e('px', HMTB_TEXT_DOMAIN); ?></label>
		<?php
	}

	function hmtb_content_width() {
		?>
		<input class="gui-input options responsive width" type="number" min="500" max="1500" step="1" name="hmtb_content_width" value="<?php esc_attr_e( get_option('hmtb_content_width' ) ); ?>" >
		<label class="field-icon"><?php _e( 'px', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_message_content() {
		?>
		<textarea cols="40" style="min-height:100px;" name="hmtb_message_content"><?php echo stripslashes( get_option('hmtb_message_content')); ?></textarea>
		<br>
		<code><?php _e('Accept HTML, like: H1, H2, H3, P etc.', HMTB_TEXT_DOMAIN); ?></code>
		<?php
	}

	function hmtb_button_text() {
		?>
		<input type="text" name="hmtb_button_text" class="hmtb_button_text" id="hmtb_button_text" value="<?php esc_attr_e( get_option('hmtb_button_text') ); ?>" >
		<?php
	}

	function hmtb_button_uri() {
		?>
		<input type="text" name="hmtb_button_uri" class="hmtb_button_uri" id="hmtb_button_uri" style="width:300px;" value="<?php esc_attr_e( get_option('hmtb_button_uri') ); ?>" >
		<br>
		<code><?php _e('Start with http:// or https://', HMTB_TEXT_DOMAIN); ?></code>
		<?php
	}

	function hmtb_button_url_is_external() {
		?>
		<input type="checkbox" name="hmtb_button_url_is_external" class="hmtb_button_url_is_external" value="true" <?php echo ( 'true' === get_option('hmtb_button_url_is_external') ) ? 'checked' : ''; ?> >
		<?php
	}

	function hmtb_button_url_nofollow() {
		?>
		<input type="checkbox" name="hmtb_button_url_nofollow" class="hmtb_button_url_nofollow" value="true" <?php echo ( 'true' === get_option('hmtb_button_url_nofollow') ) ? 'checked' : ''; ?> >
		<?php
	}

	/*
	* Styling ==============================
	*/
	function hmtb_background_color() {
		?>
		<input class="hmtb_background_color hmtb-wp-color" type="text" name="hmtb_background_color" id="hmtb_background_color" value="<?php esc_attr_e( get_option('hmtb_background_color') ); ?>" >
		<div id="colorpicker"></div>
		<?php
	}

	function hmtb_message_color() {
		?>
		<input class="hmtb_message_color hmtb-wp-color" type="text" name="hmtb_message_color" id="hmtb_message_color" value="<?php esc_attr_e( get_option('hmtb_message_color') ); ?>" >
		<div id="colorpicker"></div>
		<?php
	}

	function hmtb_msg_font_size() {
		?>
		<input class="gui-input options responsive width" type="number" min="10" max="48" step="1" name="hmtb_msg_font_size" value="<?php esc_attr_e( get_option('hmtb_msg_font_size') ); ?>" >
		<label class="field-icon"><?php _e( 'px', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_button_color() {
		?>
		<input class='hmtb_button_color hmtb-wp-color' type='text' name='hmtb_button_color' id='hmtb_button_color' value='<?php esc_attr_e( get_option(HMTB_PREFIX . 'button_color') ); ?>'>
		<div id='colorpicker'></div>
		<?php
	}

	function hmtb_button_text_color() {
		?>
		<input class="hmtb_button_text_color hmtb-wp-color" type="text" name="hmtb_button_text_color" id="hmtb_button_text_color" value="<?php esc_attr_e( get_option(HMTB_PREFIX . 'button_text_color') ); ?>" >
		<div id='colorpicker'></div>
		<?php
	}

	function hmtb_button_text_size() {
		?>
		<input class="gui-input options responsive width" type="number" min="10" max="48" step="1" name="hmtb_button_text_size" value="<?php esc_attr_e( get_option('hmtb_button_text_size') ); ?>" >
		<label class="field-icon"><?php _e( 'px', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_button_font_weight() {
		?>
		<select name="hmtb_button_font_weight" class="hmtb_button_font_weight" id="hmtb_button_font_weight">
			<option value="normal" <?php echo ( 'noraml' == get_option('hmtb_button_font_weight' ) ) ? 'selected' : ''; ?> ><?php _e('Normal', HMTB_TEXT_DOMAIN); ?></option>
			<option value="bold" <?php echo ( 'bold' === get_option('hmtb_button_font_weight' ) ) ? 'selected' : ''; ?> ><?php _e('Bold', HMTB_TEXT_DOMAIN); ?></option>
		</select>
		<?php
	}

	function hmtb_get_help() {

		include HMTB_PATH . 'admin/view/' . $this->hmtb_assets_prefix . 'help-usage.php';
	}
}
?>