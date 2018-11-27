<?php
/**
 * Map all shortcodes to the Visual Composer
 *
 * @package   Sunland Shortcodes
 * @author    Sunland RV Resorts
 * @copyright Copyright (c) 2018, Sunlandrvresorts.com
 * @link      http://www.sunlandrvresorts.com
 * @since     1.0.0
 */

function symple_shortcodes_vc_map() {

	// Store data -------------------------------------------------------------------------- >
	$order_by = array(
		 __( 'Date', 'symple' )           => 'date',
		 __( 'Name', 'symple' )          => 'name',
		 __( 'Modified', 'symple' )       => 'modified',
		 __( 'Author', 'symple' )        => 'author',
		 __( 'Random', 'symple' )         => 'random',
		 __( 'Comment Count', 'symple' ) => 'comment_count',
	);

	// Booking Box -------------------------------------------------------------------------- >
	vc_map( array(
		'name'				=> __( 'Booking Box Form', 'symple' ),
		'base'				=> 'symple_bookingbox',
		'description'		=> __( 'Adds booking box form', 'symple' ),
		'category'			=> __( 'Sunland Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-calendar',
		'params'			=> array(
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Font Color', 'symple' ),
				'param_name'	=> 'fontcolor',
				'value'			=> array(
					 __( 'Light', 'symple' )		=> 'light',
					 __( 'Dark', 'symple' )	=> 'dark',
				),
			  'description'	=> __( 'Select light for darker backgrounds', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Booking URL', 'symple' ),
				'param_name'	=> 'bookingurl',
				'value'			=> 'https://bookings.rmscloud.com/obookings3/Search/Index/5632/90/?Rd=1',
				'description'	=> __( 'Add the booking form target', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Button Text', 'symple' ),
				'param_name'	=> 'buttontext',
				'value'			=> 'Book Now',
				'description'	=> __( 'Custom text for button', 'symple' )
			),
		)
	) );

	// Booking Horz -------------------------------------------------------------------------- >
	vc_map( array(
		'name'				=> __( 'Booking Horizontal Form', 'symple' ),
		'base'				=> 'symple_bookinghorz',
		'description'		=> __( 'Adds booking horizontal form', 'symple' ),
		'category'			=> __( 'Sunland Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-calendar-check-o',
		'params'			=> array(
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Font Color', 'symple' ),
				'param_name'	=> 'fontcolor',
				'value'			=> array(
					 __( 'Light', 'symple' )		=> 'light',
					 __( 'Dark', 'symple' )	=> 'dark',
				),
			  'description'	=> __( 'Select light for darker backgrounds', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Booking URL', 'symple' ),
				'param_name'	=> 'bookingurl',
				'value'			=> 'https://bookings.rmscloud.com/obookings3/Search/Index/5632/90/?Rd=1',
				'description'	=> __( 'Add the booking form target', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Button Text', 'symple' ),
				'param_name'	=> 'buttontext',
				'value'			=> 'Book Now',
				'description'	=> __( 'Custom text for button', 'symple' )
			),
		)
	) );
	// Full Booking Form -------------------------------------------------------------------------- >
		vc_map( array(
		'name'				=> __( 'Full Booking Form', 'symple' ),
		'base'				=> 'symple_fullbook',
		'description'		=> __( 'Adds the full booking form', 'symple' ),
		'category'			=> __( 'Sunland Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-calendar-o',
		'params'			=> array(
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Booking URL', 'symple' ),
				'param_name'	=> 'bookingurl',
				'value'			=> 'https://bookings.rmscloud.com/obookings3/Search/Index/5632/90/?Rd=1',
				'description'	=> __( 'Add the booking form target', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Button Text', 'symple' ),
				'param_name'	=> 'buttontext',
				'value'			=> 'Proceed to Select Site',
				'description'	=> __( 'Custom text for button', 'symple' )
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Font Color', 'symple' ),
				'param_name'	=> 'fontcolor',
				'value'			=> array(
					 __( 'Light', 'symple' )		=> 'light',
					 __( 'Dark', 'symple' )	=> 'dark',
				),
			  'description'	=> __( 'Select dark for light backgrounds and light for dark backgrounds.', 'symple' )
			),
		)
	) );
// Newsletter Horz -------------------------------------------------------------------------- >
	vc_map( array(
		'name'				=> __( 'Newsletter Horizontal Form', 'symple' ),
		'base'				=> 'symple_newsletterhorz',
		'description'		=> __( 'Adds newsletter horizontal form', 'symple' ),
		'category'			=> __( 'Sunland Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-envelope-open-o',
		'params'			=> array(
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Font Color', 'symple' ),
				'param_name'	=> 'emailinput',
				'value'			=> 'cm-jhiikj-jhiikj',
			  'description'	=> __( 'You need to have the correct email input name according to the list you have added.', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Campaign Monitor List URL', 'symple' ),
				'param_name'	=> 'listurl',
				'value'			=> 'https://sunlandrvresorts.createsend.com',
				'description'	=> __( 'Add the booking form target. You can find this in your account', 'symple' )
			),			
		)
	) );

// Do not remove below this line
}
add_action( 'vc_before_init', 'symple_shortcodes_vc_map' );

function symple_shortcodes_vc_admin_css() {
	if ( class_exists( 'Vc_Manager' ) ) {
		wp_enqueue_style( 'symple-shortcodes-vc', plugin_dir_url( __FILE__ ) . 'css/symple-shortcodes-vc.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'symple_shortcodes_vc_admin_css' );
