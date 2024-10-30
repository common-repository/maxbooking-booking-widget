<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://developers.maxbooking.com/docs/booking-widget-for-wordpress
 * @since      1.0.0
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/public
 * @author     MaxBooking.com <info@maxbooking.com>
 */
class Maxbooking_Booking_Widget_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name       The name of the plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Function for shortcode that renders a booking widget
	 *
	 * @param array $atts Shortcode attributes.
	 */
	public function booking_widget_shortcode( $atts ) {

		$widget_type = 'property';
		$widget_class_name = 'Maxbooking_Booking_Widget_Property_Widget';
		if ( isset( $atts['type'] ) && 'group' === $atts['type'] ) {
			$widget_type = 'property_group';
			$widget_class_name = 'Maxbooking_Booking_Widget_Property_Group_Widget';
		}

		// Note:
		// Using empty values here will result in using defaults (as defined in the widget class)
		// in cases where the attribue is not supplied.
		$pairs = array(
			'property' => array(
				'unique_name' 		=> '',
				'layout'			=> '',
				'property'  		=> '',
				'arrival_date_offset' => '',
				'nights_default' 	=> '',
				'nights_max'		=> '',
				'guests_default'	=> '',
				'guests_max'		=> '',
			),
			'property_group' => array(
				'unique_name' 		=> '',
				'layout'			=> '',
				'property_group'    => '',
				'locations'			=> '',
				'arrival_date_offset' => '',
				'nights_default' 	=> '',
				'nights_max'		=> '',
				'guests_default'	=> '',
				'guests_max'		=> '',
			),
		);

		$a = shortcode_atts( $pairs[ $widget_type ], $atts );

		$unique_name = array_shift( $a );
		if ( empty( $unique_name ) ) {
			// Generate unique name if the supplied name is empty.
			$unique_name = 'maxbooking-booking-widget-widget-' . sprintf( '%06x', mt_rand( 0, 0xffffff ) );
		} else {
			// Validate the name.
			if ( 1 !== preg_match( '/^[a-z0-9_-]+$/i', $unique_name ) ) {
				return '<span>[MaxBooking.com Booking Widget: invalid unique_name attribute.]</span>';
			}
		}
		ob_start();
		the_widget( $widget_class_name, $a, array(
			'widget_id'     => $unique_name,
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		) );
	   	$output = ob_get_contents();
		ob_end_clean();
		// Filter out line breaks to prevent wpautop issues and return.
		return preg_replace( '/\s+/', ' ', $output );
	}

}
