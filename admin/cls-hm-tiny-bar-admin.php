<?php
if ( ! defined('ABSPATH') ) exit;

/**
 *	Master Class Admin
 */
class HMTB_Admin
{
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
			array($this, HMTB_PREFIX . 'content_section')
		);


		add_submenu_page(
			'hmtb-admin-panel',
			__('Styles Settings', HMTB_TEXT_DOMAIN),
			__('Styles Settings', HMTB_TEXT_DOMAIN),
			'manage_options',
			'hmtb-styles-section',
			array($this, HMTB_PREFIX . 'styles_section')
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
		wp_enqueue_style('wp-color-picker');
	}

	/**
	 *	Loading admin panel script
	 */
	public function hmtb_enqueue_script() {

		if (!wp_script_is('jquery')) {
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
	public function hmtb_content_section() {

		require_once HMTB_PATH . 'admin/view/' . $this->hmtb_assets_prefix . 'content-settings.php';
	}

	public function hmtb_styles_section() {

		require_once HMTB_PATH . 'admin/view/' . $this->hmtb_assets_prefix . 'styles-settings.php';
	}

	/**
	 *	Loading register settings
	 */
	public function hmtb_register_settings() {

		add_settings_section( $this->hmtb_option_group, esc_html__( '', HMTB_TEXT_DOMAIN ), null, 'hmtb-content-section' );
		// ==================================
		add_settings_field( 'hmtb_display_type', esc_html__( 'Display Type', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_display_type' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_display_option', esc_html__( 'Display Position', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_display_option' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_scroll_hide', esc_html__( 'Hide When Scroll?', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_scroll_hide' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_bar_height', esc_html__( 'Bar Height', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_bar_height' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_content_width', esc_html__( 'Content Width', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_content_width' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_message_content', esc_html__( 'Message / Content', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_message_content' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_button_text', esc_html__( 'Button Text', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_text' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_button_uri', esc_html__( 'Button URL', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_uri' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_button_url_is_external', esc_html__( 'Button URL Is External?', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_url_is_external' ), 'hmtb-content-section', $this->hmtb_option_group );
		add_settings_field( 'hmtb_button_url_nofollow', esc_html__( 'Button URL Nofollow?', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_url_nofollow' ), 'hmtb-content-section', $this->hmtb_option_group );

		// ==================================
		add_settings_section( $this->hmtb_option_group_styles, esc_html__( '', HMTB_TEXT_DOMAIN ), null, 'hmtb-styles-section' );
		add_settings_field( 'hmtb_background_color', esc_html__( 'Bar Background Color', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_background_color' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_message_color', esc_html__( 'Message Font Color', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_message_color' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_msg_font_size', esc_html__( 'Message Font Size', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_msg_font_size' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_button_color', esc_html__( 'Button Color', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_color' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_button_text_color', esc_html__( 'Button Font Color', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_text_color' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_button_text_size', esc_html__( 'Button Font Size', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_text_size' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );
		add_settings_field( 'hmtb_button_font_weight', esc_html__( 'Button Font Weight', HMTB_TEXT_DOMAIN ), array( &$this, 'hmtb_button_font_weight' ), 'hmtb-styles-section', $this->hmtb_option_group_styles );

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
		<input type="radio" name="hmtb_display_type" class="hmtb_display_type" value="hmtb-fixed" <?php echo ( 'hmtb-overlap' !== get_option('hmtb_display_type') ) ? 'checked' : ''; ?> >
		<label for="default-templates"><span></span><?php esc_html_e( 'Fixed', HMTB_TEXT_DOMAIN ); ?></label>
			&nbsp;&nbsp;
		<input type="radio" name="hmtb_display_type" class="hmtb_display_type" value="hmtb-overlap" <?php echo ( 'hmtb-overlap' === get_option('hmtb_display_type') ) ? 'checked' : ''; ?> >
		<label for="csutom-design"><span></span><?php esc_html_e( 'Overlap', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_display_option() {
		?>
		<input type="radio" name="hmtb_display_option" class="hmtb_display_option" value="top" <?php echo ( 'bottom' !== get_option('hmtb_display_option') ) ? 'checked' : ''; ?> >
		<label for="default-templates"><span></span><?php esc_html_e( 'Top', HMTB_TEXT_DOMAIN ); ?></label>
			&nbsp;&nbsp;
		<input type="radio" name="hmtb_display_option" class="hmtb_display_option" value="bottom" <?php echo ( 'bottom' === get_option('hmtb_display_option') ) ? 'checked' : ''; ?> >
		<label for="csutom-design"><span></span><?php esc_html_e( 'Bottom', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_scroll_hide() {
		?>
		<input type="checkbox" name="hmtb_scroll_hide" class="hmtb_scroll_hide" value="hmtb-hide" <?php echo ( 'hmtb-hide' === get_option('hmtb_scroll_hide') ) ? 'checked' : ''; ?> >
		<?php
	}

	function hmtb_bar_height() {
		?>
		<input class="gui-input options responsive width" type="number" min="12" max="150" step="1" name="hmtb_bar_height" value="<?php echo esc_attr( get_option('hmtb_bar_height') ); ?>">
		<label class="field-icon"><?php esc_html_e('px', HMTB_TEXT_DOMAIN); ?></label>
		<?php
	}

	function hmtb_content_width() {
		?>
		<input class="gui-input options responsive width" type="number" min="500" max="1500" step="1" name="hmtb_content_width" value="<?php echo esc_attr( get_option('hmtb_content_width' ) ); ?>" >
		<label class="field-icon"><?php esc_attr_e( 'px', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_message_content() {
		?>
		<textarea cols="40" style="min-height:100px;" name="hmtb_message_content"><?php echo stripslashes( get_option('hmtb_message_content')); ?></textarea>
		<br>
		<code><?php esc_html_e('Accept HTML, like: H1, H2, H3, P etc.', HMTB_TEXT_DOMAIN); ?></code>
		<?php
	}

	function hmtb_button_text() {
		?>
		<input type="text" name="hmtb_button_text" class="hmtb_button_text" id="hmtb_button_text" value="<?php echo esc_attr( get_option('hmtb_button_text') ); ?>" >
		<?php
	}

	function hmtb_button_uri() {
		?>
		<input type="text" name="hmtb_button_uri" class="hmtb_button_uri" id="hmtb_button_uri" style="width:300px;" value="<?php echo esc_attr( get_option('hmtb_button_uri') ); ?>" >
		<br>
		<code><?php esc_html_e('Start with http:// or https://', HMTB_TEXT_DOMAIN); ?></code>
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
		<input class="hmtb_background_color hmtb-wp-color" type="text" name="hmtb_background_color" id="hmtb_background_color" value="<?php echo esc_attr( get_option('hmtb_background_color') ); ?>" >
		<div id="colorpicker"></div>
		<?php
	}

	function hmtb_message_color() {
		?>
		<input class="hmtb_message_color hmtb-wp-color" type="text" name="hmtb_message_color" id="hmtb_message_color" value="<?php echo esc_attr( get_option('hmtb_message_color') ); ?>" >
		<div id="colorpicker"></div>
		<?php
	}

	function hmtb_msg_font_size() {
		?>
		<input class="gui-input options responsive width" type="number" min="10" max="48" step="1" name="hmtb_msg_font_size" value="<?php echo esc_attr( get_option('hmtb_msg_font_size') ); ?>" >
		<label class="field-icon"><?php esc_attr_e( 'px', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_button_color() {
		?>
		<input class='hmtb_button_color hmtb-wp-color' type='text' name='hmtb_button_color' id='hmtb_button_color' value='<?php echo esc_attr( get_option(HMTB_PREFIX . 'button_color') ); ?>'>
		<div id='colorpicker'></div>
		<?php
	}

	function hmtb_button_text_color() {
		?>
		<input class="hmtb_button_text_color hmtb-wp-color" type="text" name="hmtb_button_text_color" id="hmtb_button_text_color" value="<?php echo esc_attr( get_option(HMTB_PREFIX . 'button_text_color') ); ?>" >
		<div id='colorpicker'></div>
		<?php
	}

	function hmtb_button_text_size() {
		?>
		<input class="gui-input options responsive width" type="number" min="10" max="48" step="1" name="hmtb_button_text_size" value="<?php echo esc_attr( get_option('hmtb_button_text_size') ); ?>" >
		<label class="field-icon"><?php esc_attr_e( 'px', HMTB_TEXT_DOMAIN ); ?></label>
		<?php
	}

	function hmtb_button_font_weight() {
		?>
		<select name="hmtb_button_font_weight" class="hmtb_button_font_weight" id="hmtb_button_font_weight">
			<option value="normal" <?php echo ( 'noraml' == get_option('hmtb_button_font_weight' ) ) ? 'selected' : ''; ?> ><?php esc_html_e('Normal', HMTB_TEXT_DOMAIN); ?></option>
			<option value="bold" <?php echo ( 'bold' === get_option('hmtb_button_font_weight' ) ) ? 'selected' : ''; ?> ><?php esc_html_e('Bold', HMTB_TEXT_DOMAIN); ?></option>
		</select>
		<?php
	}
}
?>