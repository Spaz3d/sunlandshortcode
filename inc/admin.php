<?php
/**
 * Adds admin panel with basic Sunland Shortcode Settings
 *
 * @package   Sunland Shortcodes
 * @author    Sunland RV Resorts
 * @copyright Copyright (c) 2017, Sunlandrvresorts.com
 * @link      http://www.sunlandrvresorts.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Symple_Shortcodes_Admin' ) ) {

	class Symple_Shortcodes_Admin {

		/**
		 * Start things up
		 */
		public function __construct() {
			add_action( 'admin_menu', array( 'Symple_Shortcodes_Admin', 'add_page' ) );
			add_action( 'admin_init', array( 'Symple_Shortcodes_Admin', 'register_page_options' ) );
		}

		/**
		 * Add sub menu page
		 *
		 * @since 2.1.0
		 */
		public static function add_page() {
			add_submenu_page(
				'options-general.php',
				'Sunland Shortcodes',
				'Sunland Shortcodes',
				'administrator',
				'symple-shortcodes',
				array( 'Symple_Shortcodes_Admin', 'create_admin_page' )
			);
		}

		/**
		 * Function that will register admin page options.
		 *
		 * @since 2.1.0
		 */
		public static function register_page_options() {

			// Register Setting
			register_setting( 'symple_shortcodes', 'symple_shortcodes', array( 'Symple_Shortcodes_Admin', 'sanitize' ) );

			// Add main section to our options page
			add_settings_section( 'symple_shortcode_main', false, array( 'Symple_Shortcodes_Admin', 'section_main_callback' ), 'symple-shortcodes' );

			add_settings_field(
				'symple_shortcodes_rms_booking_link',
				esc_html__( 'RMS Booking Link', 'symple' ),
				array( 'Symple_Shortcodes_Admin', 'rms_booking_link' ),
				'symple-shortcodes',
				'symple_shortcode_main'
			);

		}

		/**
		 * Sanitization callback
		 *
		 * @since 2.1.0
		 */
		public static function sanitize( $options ) {
			return $options;
		}

		/**
		 * Main Settings section callback
		 *
		 * @since 2.1.0
		 */
		public static function section_main_callback() {
			// Leave blank
		}

		/**
		 * Fields callback functions
		 *
		 * @since 2.1.0
		 */

		// RMS Booking Link
		public static function rms_booking_link() {
			$options = get_option( 'symple_shortcodes' );
			$val = isset( $options['rms_bookings_link'] ) ? $options['rms_bookings_link'] : ''; ?>
			<input style="padding: 10px 4px;width:80%;" type="text" name="symple_shortcodes[rms_bookings_link]" value="<?php echo esc_attr( $val ); ?>">
			<br />
			<small>Add the RMS booking link for your property here. ie: https://bookings.rmscloud.com/obookings3/Search/Index/5633/90/?Rd=1</small>
		<?php }

		/**
		 * Settings page output
		 *
		 * @since 2.1.0
		 */
		public static function create_admin_page() { ?>
			<div class="wrap">
				<h2 style="padding-right:0;"><?php echo esc_html__( 'Sunland Shortcodes V3.9', 'symple' ); ?></h2>
				<form method="post" action="options.php">
					<?php settings_fields( 'symple_shortcodes' ); ?>
					<?php do_settings_sections( 'symple-shortcodes' ); ?>
					<?php submit_button(); ?>
				</form>
			</div>
		<?php }


	}

	new Symple_Shortcodes_Admin();

}
