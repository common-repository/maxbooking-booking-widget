<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://developers.maxbooking.com/docs/booking-widget-for-wordpress
 * @since      1.0.0
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/includes
 * @author     MaxBooking.com <info@maxbooking.com>
 */
class Maxbooking_Booking_Widget_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'maxbooking-booking-widget',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
