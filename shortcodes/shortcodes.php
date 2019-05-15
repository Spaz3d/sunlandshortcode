<?php
/**
 * Map all shortcodes to the Visual Composer
 *
 * @package   Sunland Shortcodes
 * @author    Sunland RV Resorts
 * @copyright Copyright (c) 2017, Sunlandrvresorts.com
 * @link      http://www.sunlandrvresorts.com
 * @since     1.0.0
 */

// Widget Support -------------------------------------------------------------------------- >
add_filter( 'widget_text', 'do_shortcode' );


// "Fix" Shortcodes -------------------------------------------------------------------------- >
function symple_fix_shortcodes($content){
	$array = array (
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
add_filter( 'the_content', 'symple_fix_shortcodes' );

// Booking Box Shortcode -------------------------------------------------------------------------- >
function symple_bookingbox_shortcode( $atts, $content = null  ) {

		extract( shortcode_atts( array(
			'buttontext'	=> 'Book Now',
			'fontcolor'		=> 'light',
			'font_size'		=> '',
			'text_transform'  => '',
			'toppertext' => 'Select Your Dates',
		), $atts ) );

		// Inline styles
		$style_attr = '';
		if ( $font_size ) {
			$style_attr .= 'font-size: '. $font_size .';';
		}
		if ( $text_transform ) {
			$style_attr .= 'text-transform: '. $text_transform .';';
		}
		if ( $style_attr ) {
			$style_attr = 'style="'. esc_attr( $style_attr ) .'"';
		}

		// Get The RMS Booking Link
		$options = get_option( 'symple_shortcodes' );
		$rms_key = isset( $options['rms_bookings_link'] ) ? $options['rms_bookings_link'] : '';
		$rms_key = apply_filters( 'symple_shortcodes_rms_bookings_link', $rms_key );

		// This is the booking box form
			$output = '<div class="booking-wrap '. $fontcolor .' cf"><div class="bookingform">
<form class="b-form" action="'. $rms_key .'" id="myform" method="GET" target="_blank">
<h6 '. $style_attr .'>'. $toppertext .'</h6>
<div class="dateblock tutuclass symple-col-2 padding_right_10 float_left"><input type="text" readonly="true" id="caleran-start" name="A" placeholder="ARRIVE"><i class="fa fa-calendar"></i></div>
<div class="dateblock symple-col-2 float_left tutuclass"><input type="text" readonly="true" id="caleran-end" name="D" placeholder="DEPART"><i class="fa fa-calendar"></i></div>
<div><h6>Have a Promo Code? Enter Below:</h6>
<input type="text" id="Pc" name="Pc" placeholder="Optional"></div>
<div class="bookbtn"><button type="submit" value="Submit" id="submit" class="booksub">'. $buttontext .'</button></div>
</form><p class="miniicon"><i class="fa fa-lock"></i> 100% secure booking process</p></div>
</div> ';

		// Return shortcode output
		return $output;

	}

add_shortcode( 'symple_bookingbox', 'symple_bookingbox_shortcode' );

// Booking Fullwidth Shortcode -------------------------------------------------------------------------- >
function symple_bookinghorz_shortcode( $atts, $content = null  ) {

		extract( shortcode_atts( array(
			'buttontext'	=> 'Book Now',
			'fontcolor'		=> 'light',
		), $atts ) );

		// Get The RMS Booking Link
		$options = get_option( 'symple_shortcodes' );
		$rms_key = isset( $options['rms_bookings_link'] ) ? $options['rms_bookings_link'] : '';
		$rms_key = apply_filters( 'symple_shortcodes_rms_bookings_link', $rms_key );

		// This shows the horizontal booking form
			$output = '<div class="booking-wrap-horz '. $fontcolor .' cf">	<div class="bookingform cf">
	<form class="b-form" action="'. $rms_key .'" id="myform" method="GET" target="_blank">
						<div class="dateblock symple-col-4 padding_right_10 float_left tutuclass"><input type="text" readonly="true" id="caleran-start" name="A" placeholder="ARRIVE"><i class="fa fa-calendar"></i></div>
            <div class="dateblock symple-col-4 float_left tutuclass"><input type="text" readonly="true" id="caleran-end" name="D" placeholder="DEPART"><i class="fa fa-calendar"></i></div>
            <div class="symple-col-4 padding_10 float_left"><input type="text" id="Pc" name="Pc" placeholder="Promo Code"></div>
						<div class="bookbtn symple-col-4 padding_10 float_left">
						<button type="submit" value="Submit" id="submit" class="booksub">'. $buttontext .'</button>
					</div>
				</form>
	</div></div>';

		// Return shortcode output
		return $output;

	}

add_shortcode( 'symple_bookinghorz', 'symple_bookinghorz_shortcode' );


// Full Booking Form -------------------------------------------------------------------------- >
	function symple_fullbook_shortcode( $atts, $content = null  ) {

		extract( shortcode_atts( array(
			'buttontext'	=> 'Proceed to Select Site',
			'fontcolor'		=> 'light',
		), $atts ) );

		// Get The RMS Booking Link
		$options = get_option( 'symple_shortcodes' );
		$rms_key = isset( $options['rms_bookings_link'] ) ? $options['rms_bookings_link'] : '';
		$rms_key = apply_filters( 'symple_shortcodes_rms_bookings_link', $rms_key );

		// This is the full booking code
		$output = '<div class="bookingform '. $fontcolor .' cf">
		<form class="b-form requr" action="'. $rms_key .'" id="myform" method="get" target="_blank">
            <div class="bottomspan cf">
            	<h6>step 1: Select Your Date Range</h6>
            <div class="dateblock symple-col-2 padding_right_10 float_left tutuclass"><input type="text" readonly="true" id="caleran-start" name="A" placeholder="ARRIVE"><i class="fa fa-calendar"></i></div>
            <div class="dateblock symple-col-2 float_left tutuclass"><input type="text" readonly="true" id="caleran-end" name="D" placeholder="DEPART"><i class="fa fa-calendar"></i></div>
            </div>
            <div class="bottomspan cf">
            	<h6>step 2: enter guest(s) details</h6>
            	<div class="symple-col-3  float_left padding_right_10">
	<span class="formlabel">Adults</span>
						<select name="Ad" id="adults" class="dk">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					<div class="symple-col-3  float_left padding_right_10">
						<span class="formlabel">Children</span>
						<select name="C" id="child" class="dk">
							<option selected disabled>none</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					<div class="symple-col-3  float_left padding_right_10">
						<span class="formlabel">Pets (2 Max)</span>
						<select name="A1" id="pets" class="dk">
							<option selected disabled>none</option>
							<option value="1">1</option>
							<option value="2">2</option>
						</select>
					</div></div>
          <div class="bottomspan cf">
					  <div class="symple-col-2 padding_right_10 float_left">
            <span class="formlabel">Promo Code</span>
                                <input id="Pc" name="Pc" placeholder="Optional" type="text" />
                                <p>Promo codes are case sensitive. Any problems please call the front desk and mention your promo code.</p>
                            </div>
           <div class="symple-col-2 float_left">
           	<span class="formlabel">Next Step: Select Your Site Type</span>
           	<button type="submit" value="Submit" id="submit" class="booksub">'. $buttontext .'</button>
           	<p>You will be sent to our secure online booking system to select your rate and site type and complete your order.</p></div>
          </div>
            </form>
            <div class="bottomspan cf">
            <div class="symple-col-3  float_left secureicon padding_10"><i class="fa fa-credit-card fa-3x"></i> <p>all major credit cards accepted</p></div>
            <div class="symple-col-3  float_left secureicon padding_10"><i class="fa fa-lock fa-3x"></i> <p>100% secure booking process</p></div>
            <div class="symple-col-3  float_left secureicon padding_10"><i class="fa fa-shield fa-3x"></i> <p>We protect personal information</p></div>
            </div>
            </div>';

		// Return shortcode output
		return $output;

	}
add_shortcode( 'symple_fullbook', 'symple_fullbook_shortcode' );

// We Done Here -------------------------------------------------------------------------- >
