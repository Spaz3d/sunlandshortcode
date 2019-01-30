<?php
/*
Plugin Name: Sunland Shortcodes
Description: This is the Sunland RV Resorts shortcode plugin that adds the RMS functionality to the website.
Author: Sunland RV Resorts
Author URI: http://www.sunlandrvresorts.com
Version: 3.4
License: GNU General Public License version 2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! class_exists( 'SympleShortcodes' ) ) {

	class SympleShortcodes {

		/**
		 * Main Constructor
		 *
		 * @since  2.0.0
		 * @access public
		 */
		public function __construct() {

			// Plugin version Constant
			define( 'SYMPLE_SHORTCODES_VERSION', '3.4' );
			define( 'SYMPLE_SHORTCODES_PLUGIN_SLUG', plugin_basename( __FILE__ ) );

			// Define path
			$this->dir_path = plugin_dir_path( __FILE__ );

			// Register de-activation hook
			register_deactivation_hook( __FILE__, array( $this, 'on_deactivation' ) );

			// Admin only
			if ( is_admin() ) {

				// Admin notices
				add_action( 'admin_init', array( $this, 'admin_notice_init' ) );

			}

			// Front end only
			else {

				// Front-end scripts
				add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );

				// Add responsive tag to body
				add_filter( 'body_class', array( $this, 'body_class' ) );

			}

			// Test domain
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );

			// Common functions
			require_once( $this->dir_path .'/inc/commons.php' );

			// The actual shortcode functions
			require_once( $this->dir_path .'/shortcodes/shortcodes.php' );

			// Map shortcodes to the Visual Composer
			require_once( $this->dir_path .'/visual-composer/map.php' );

		}

		/**
		 * Load Text Domain for translations
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function load_text_domain() {
			load_plugin_textdomain( 'symple', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
		}

		/**
		 * Registers/Enqueues all scripts and styles
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function load_scripts() {

			// Get options
			$options = get_option( 'symple_shortcodes' );

			// Define js directory
			$js_dir = plugin_dir_url( __FILE__ ) . 'shortcodes/js/';

			// Define CSS directory
			$css_dir = plugin_dir_url( __FILE__ ) . 'shortcodes/css/';

			// Core jQuery
			wp_enqueue_script( 'jquery' );

			// Booking
			wp_enqueue_script( 'jquery.dropkick-min', $js_dir . 'jquery.dropkick-min.js', array ( 'jquery' ), '2.2.0', true );
			wp_enqueue_script( 'symple_shortcodes_lib', $js_dir . 'symple_shortcodes_lib.js', array ( 'jquery' ), '2.2.0', true );
			wp_enqueue_script( 'moment.min', $js_dir . 'moment.min.js', array ( 'jquery' ), '2.2.0', true );
			wp_enqueue_script( 'caleran.min', $js_dir . 'caleran.min.js', array ( 'jquery' ), '2.2.0', true );

			// CSS
			wp_enqueue_style( 'symple_shortcode_styles', $css_dir . 'symple_shortcodes_styles.css' );
			wp_enqueue_style( 'caleran.min', $css_dir . 'caleran.min.css' );
			wp_enqueue_style( 'symple_dropkick_styles', $css_dir . 'dropkick.css' );
		}

		/**
		 * Add admin notice to enable the Visual Composer
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function admin_notice_init() {

			// $this->vc_notice_dismiss_delete(); // For testing

			// If dismiss meta is saved bail
			if ( get_user_meta( get_current_user_id(), 'ss_vc_notice_dismiss', true ) ) {
				return;
			}

			// If the dimiss notice icon is clicked update user meta
			if ( isset( $_GET['ssvc-dismiss'] ) ) {
				$this->vc_notice_dismiss();
				return;
			}

			// Apply filters so you can disable the notice via the theme
			$show_vc_notice = apply_filters( 'symple_shortcodes_vc_notice', true );

			// Show notice
			if ( $show_vc_notice ) {
				add_action( 'admin_notices', array( $this, 'vc_notice' ) );
			}

		}

		/**
		 * Display admin notice for the VC
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function vc_notice() { ?>

			<div class="updated notice is-dismissable symple-vc-notice">
				<a href="<?php echo esc_url( add_query_arg( 'ssvc-dismiss', '1' ) ); ?>" class="dismiss-notice" target="_parent"><span class="dashicons dashicons-no-alt" style="display:block;float:right;margin:10px 0 10px 10px;"></span></a>
				<p><?php _e( 'This plugin will require that you have WPBakery Page Builder for WordPress installed and active. There is no longer support for classic editor.' ); ?></p><p><a href="https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=wpexplorer" class="button button-primary" title="<?php _e( 'WPBakery Page Builder for WordPress', 'wpex' ); ?>" target="_blank"><?php _e( 'Purchase Now', 'wpex' ); ?></a></p>
			</div>

		<?php }

		/**
		 * Update user meta for dismissing the notice
		 *
		 * @since 2.1.0
		 */
		public function vc_notice_dismiss() {
			update_user_meta( get_current_user_id(), 'ss_vc_notice_dismiss', 1 );
		}

		/**
		 * Delete notice dismiss
		 *
		 * @since 2.1.0
		 */
		public function vc_notice_dismiss_delete() {
			delete_user_meta( get_current_user_id(), 'ss_vc_notice_dismiss' );
		}

		/**
		 * Run on plugin de-activation
		 *
		 * @since 2.1.0
		 */
		public function on_deactivation() {

			// Remove user meta for the Visual Composer notice
			$this->vc_notice_dismiss_delete();

		}

		/**
		 * Adds classes to the body tag
		 *
		 * @since 2.1.0
		 */
		public function body_class( $classes ) {
			$classes[] = 'symple-shortcodes ';
			if ( apply_filters( 'symple_shortcodes_responsive', true ) ) {
				$classes[] = 'symple-shortcodes-responsive';
			}
			return $classes;
		}

	}

	// Start things up
	$symple_shortcodes = new SympleShortcodes();

}
