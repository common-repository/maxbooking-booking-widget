<?php
/**
 * The widgets functionality of the plugin.
 *
 * @link       https://developers.maxbooking.com/docs/booking-widget-for-wordpress
 * @since      1.0.0
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/widgets
 */

/**
 * The widgets functionality of the plugin.
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/widgets
 * @author     MaxBooking.com <info@maxbooking.com>
 */
class Maxbooking_Booking_Widget_Widgets {

	/**
	 * The name of this plugin.
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
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the individal widgets
	 *
	 * @since    1.0.0
	 */
	public function register_widgets() {
		register_widget( 'Maxbooking_Booking_Widget_Property_Widget' );
		register_widget( 'Maxbooking_Booking_Widget_Property_Group_Widget' );
	}

	/**
	 * Register the JavaScript for widgets
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$locale = get_locale();
		wp_enqueue_script(
			'maxbooking-booking-widget-pickadate-fix',
			plugin_dir_url( __FILE__ ) . 'js/maxbooking-booking-widget-pickadate-fix.js',
			array( 'jquery' ),
			$this->version,
			false
		);
		wp_enqueue_script(
			'pickadate',
			'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.js',
			array( 'maxbooking-booking-widget-pickadate-fix' ),
			null,
			null
		);
		wp_enqueue_script(
			'pickadate-date',
			'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.date.js',
			array( 'pickadate' ),
			null,
			null
		);
		if ( ! empty( $locale ) && 'en_' !== substr( $locale, 0, 3 ) ) {
			wp_enqueue_script(
				'pickadate-translation',
				'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/translations/' . $locale . '.js',
				array( 'pickadate-date' ),
				null,
				null
			);
			wp_enqueue_script(
				'maxbooking-booking-widget-property-widget',
				plugin_dir_url( __FILE__ ) . 'js/maxbooking-booking-widget-property-widget-public.js',
				array( 'jquery', 'pickadate-date', 'pickadate-translation' ),
				$this->version,
				false
			);
		} else {
			wp_enqueue_script(
				'maxbooking-booking-widget-property-widget',
				plugin_dir_url( __FILE__ ) . 'js/maxbooking-booking-widget-property-widget-public.js',
				array( 'jquery', 'pickadate-date' ),
				$this->version,
				false
			);
		}
	}

	/**
	 * Register the stylesheets for widgets
	 *
	 * @todo     Load jQuery UI theme based on plugin settings
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'pickadate-normalize', plugin_dir_url( __FILE__ ) . 'css/pickadate-normalize.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'pickadate-default', 'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/default.css', array( 'pickadate-normalize' ), null, 'all' );
		wp_enqueue_style( 'pickadate-default-date', 'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/default.date.css' , array( 'pickadate-default' ), null, 'all' );
		wp_enqueue_style( $this->plugin_name . '-base-widget', plugin_dir_url( __FILE__ ) . 'css/maxbooking-booking-widget-base-widget.css', array( 'pickadate-default-date' ), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-vertical-widget', plugin_dir_url( __FILE__ ) . 'css/maxbooking-booking-widget-vertical-widget.css', array( $this->plugin_name . '-base-widget' ), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-horizontal-widget', plugin_dir_url( __FILE__ ) . 'css/maxbooking-booking-widget-horizontal-widget.css', array( $this->plugin_name . '-base-widget' ), $this->version, 'all' );
	}

}
