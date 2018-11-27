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
			'bookingurl'	=> 'https://bookings.rmscloud.com/obookings3/Search/Index/5632/90/?Rd=1',
			'buttontext'	=> 'Book Now',
			'fontcolor'		=> 'light',
		), $atts ) );

		// This is the booking box form
			$output = '<div class="booking-wrap '. $fontcolor .' cf"><div class="bookingform">
<form class="b-form" action="'. $bookingurl .'" id="myform" method="GET" target="_blank">
<h2>SELECT YOUR DATES</h2>
<div class="dateblock tutuclass"><input type="text" readonly="true" id="caleran-start" name="A" placeholder="ARRIVE"><i class="fa fa-calendar"></i></div>
<div class="dateblock tutuclass"><input type="text" readonly="true" id="caleran-end" name="D" placeholder="DEPART"><i class="fa fa-calendar"></i></div>
<div><h3>Have a Promo Code? Enter Below:</h3>
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
			'bookingurl'	=> 'https://bookings.rmscloud.com/obookings3/Search/Index/5632/90/?Rd=1',
			'buttontext'	=> 'Book Now',
			'fontcolor'		=> 'light',
		), $atts ) );

		// This shows the horizontal booking form
			$output = '<div class="booking-wrap-horz '. $fontcolor .' cf">	<div class="bookingform cf">
	<form class="b-form" action="'. $bookingurl .'" id="myform" method="GET" target="_blank">
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
			'bookingurl'	=> 'https://bookings.rmscloud.com/obookings3/Search/Index/5632/90/?Rd=1',
			'buttontext'	=> 'Proceed to Select Site',
			'fontcolor'		=> 'light',
		), $atts ) );

		// This is the full booking code
		$output = '<div class="bookingform '. $fontcolor .' cf">
		<form class="b-form requr" action="'. $bookingurl .'" id="myform" method="get" target="_blank">
            <div class="bottomspan cf">
            	<h2>step 1: Select Your Date Range</h2>
            <div class="dateblock symple-col-2 padding_right_10 float_left tutuclass"><input type="text" readonly="true" id="caleran-start" name="A" placeholder="ARRIVE"><i class="fa fa-calendar"></i></div>
            <div class="dateblock symple-col-2 float_left tutuclass"><input type="text" readonly="true" id="caleran-end" name="D" placeholder="DEPART"><i class="fa fa-calendar"></i></div>
            </div>
            <div class="bottomspan cf">
            	<h2>step 2: enter Guest(s) Details</h2>
            	<div class="symple-col-3  float_left padding_right_10">
	<h3 class="formlabel">Adults</h3>
						<select name="Ad" id="adults" class="dk">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					<div class="symple-col-3  float_left padding_right_10">
						<h3 class="formlabel">Children</h3>
						<select name="C" id="child" class="dk">
							<option selected disabled>none</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					<div class="symple-col-3  float_left padding_right_10">
						<h3 class="formlabel">Pets (2 Max)</h3>
						<select name="A1" id="pets" class="dk">
							<option selected disabled>none</option>
							<option value="1">1</option>
							<option value="2">2</option>
						</select>
					</div></div>
          <div class="bottomspan cf">
					  <div class="symple-col-2 padding_right_10 float_left">
            <h3 class="formlabel">Promo Code</h3>
                                <input id="Pc" name="Pc" placeholder="Optional" type="text" />
                                <p>Promo codes are case sensitive. Any problems please call the front desk and mention your promo code.</p>
                            </div>
           <div class="symple-col-2 float_left">
           	<h3 class="formlabel">Next Step: Select Your Site Type</h3>
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

// Join Our Newsletter Horizontal -------------------------------------------------------------------------- >
function symple_newsletterhorz_shortcode( $atts, $content = null  ) {

		extract( shortcode_atts( array(
			'listurl'	=> 'https://sunlandrvresorts.createsend.com/t/d/s/jhiikj/',
			'emailinput'		=> 'cm-jhiikj-jhiikj',
		), $atts ) );

		// This shows the horizontal newsletter form
			$output = '<div class="newsletter">
			<div class="newsletterinner"><form action="'. $listurl .'" method="post">
			<div class="symple-col-3 padding_10 float_left"><input id="fieldName" name="cm-name" required="" type="text" placeholder="First Name" /></div>
			<div class="symple-col-3 padding_10 float_left"><input id="fieldEmail" name="'. $emailinput .'" required="" type="email" placeholder="Email Address" /></div>
			<div class="symple-col-3 padding_10 float_left"><button type="submit">Subscribe</button></div>
			</form></div>
			</div>';

		// Return shortcode output
		return $output;

	}

add_shortcode( 'symple_newsletterhorz', 'symple_newsletterhorz_shortcode' );

// We Done Here -------------------------------------------------------------------------- >
