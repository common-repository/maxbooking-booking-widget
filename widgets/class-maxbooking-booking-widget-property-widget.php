<?php
/**
 * Booking widget for a property
 *
 * @link       https://developers.maxbooking.com/docs/booking-widget-for-wordpress
 * @since      1.0.0
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/widgets
 */

/**
 * Booking widget for a property
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/widgets
 * @author     MaxBooking.com <info@maxbooking.com>
 */
class Maxbooking_Booking_Widget_Property_Widget extends Maxbooking_Booking_Widget_Widget {

	public function __construct() {
		parent::__construct(
			'maxbooking_booking_widget_property',
			__( 'Booking Widget', 'maxbooking-booking-widget' ),
			array(
				'description' => __( 'A widget for booking through MaxBooking.com', 'maxbooking-booking-widget' ),
			)
		);
	}

	/**
	 * Public display of the widget
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {
		$property_string = self::get_field_value( $instance, 'property', $this->fields_settings['property'] );
		if ( empty( $property_string ) ) {
			echo '<p>[MaxBooking.com booking widget not configured.]</p>';
			return;
		}
		if ( false === strpos( $property_string, ':' ) ) {
			// Single ID Provided.
			$property_id = $property_string;
		} else {
			$property_list = self::parse_list_definition( $property_string );
			$property_select_options = self::create_options_html( $property_list );
		}
		$arrival_date_offset = self::get_field_value( $instance, 'arrival_date_offset', $this->fields_settings['arrival_date_offset'] );
		$guests_select_options = self::create_numeric_options_html(
			self::get_field_value( $instance, 'guests_max', $this->fields_settings['guests_max'] ),
			self::get_field_value( $instance, 'guests_default', $this->fields_settings['guests_default'] )
		);
		$nights_select_options = self::create_numeric_options_html(
			self::get_field_value( $instance, 'nights_max', $this->fields_settings['nights_max'] ),
			self::get_field_value( $instance, 'nights_default', $this->fields_settings['nights_default'] )
		);
		$layout = self::get_field_value( $instance, 'layout', $this->fields_settings['layout'] );
		$layout = 'none' !== $layout ?  $layout : '';
		include 'partials/' . $this->get_widget_partials_prefix() . '-public.php';
	}

	/**
	 * Get default fields settings array
	 * Note: This is done through a method because of the transalte function.
	 */
	protected function get_initial_fields_settings() {
		return array(
			'layout' => array(
				'label' => __( 'Widget Style', 'maxbooking-booking-widget' ),
				'description'	=> __( 'Select which style (if any) should be applied to the widget.', 'maxbooking-booking-widget' ),
				'default_value' => 'vertical',
				'values' => array(
					'none' 			=> __( 'None', 'maxbooking-booking-widget' ),
					'vertical' 		=> __( 'Verical', 'maxbooking-booking-widget' ),
					'horizontal' 	=> __( 'Horizontal', 'maxbooking-booking-widget' ),
				),
			),
			'title' => array(
				'label'         => __( 'Title', 'maxbooking-booking-widget' ),
				'description'	=> __( 'Optional.', 'maxbooking-booking-widget' ),
			),
			'property' => array(
				'label'     => __( 'Property', 'maxbooking-booking-widget' ),
				'description' => __( 'The ID of the property as defined in Max. To use more properties in the same widget input the properties in the following format: [property_id1]:[property_name1];[property_id2]:[property_name2] , example: 12345:Our First Hostel;45678:Our Second Hostel', 'maxbooking-booking-widget' ),
				'required'  => true,
				'pattern'   => '/^((\d+)|(\d+:.[^;]+(;\d+:[^;]+)*))$/',
			),
			'arrival_date_offset' => array(
			    'label'         => __( 'Default arrival date' ),
				'description'	=> __( 'Select what date should appear by default in the arrival field (if any).', 'maxbooking-booking-widget' ),
			    'default_value' => 'none',
				'values'		=> array(
					'none'  => __( 'None', 'maxbooking-booking-widget' ),
					'0'		=> __( 'Today', 'maxbooking-booking-widget' ),
					'1'		=> __( 'Today + 1', 'maxbooking-booking-widget' ),
					'2'		=> __( 'Today + 2', 'maxbooking-booking-widget' ),
					'3'		=> __( 'Today + 3', 'maxbooking-booking-widget' ),
				),
			),
			'nights_default' => array(
				'label'         => __( 'Default number of nights', 'maxbooking-booking-widget' ),
				'default_value' => '3',
			),
			'nights_max' => array(
				'label'         => __( 'Maximum number of nights', 'maxbooking-booking-widget' ),
				'default_value' => '14',
			),
			'guests_default' => array(
				'label'         => __( 'Default number of guests', 'maxbooking-booking-widget' ),
				'default_value' => '2',
			),
			'guests_max' => array(
				'label'         => __( 'Maximum number of guests', 'maxbooking-booking-widget' ),
				'default_value' => '10',
			),
		);
	}

}
