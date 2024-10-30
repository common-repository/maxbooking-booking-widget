<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://developers.maxbooking.com/docs/booking-widget-for-wordpress
 * @since             1.0.0
 * @package           Maxbooking_Booking_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       MaxBooking Booking Widget
 * Plugin URI:        https://developers.maxbooking.com/docs/booking-widget-for-wordpress
 * Description:       The Official MaxBooking.com Booking Widget.
 * Version:           1.1.3
 * Author:            MaxBooking.com
 * Author URI:        https://www.maxbooking.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       maxbooking-booking-widget
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-maxbooking-booking-widget-activator.php
 */
function activate_maxbooking_booking_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-maxbooking-booking-widget-activator.php';
	Maxbooking_Booking_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-maxbooking-booking-widget-deactivator.php
 */
function deactivate_maxbooking_booking_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-maxbooking-booking-widget-deactivator.php';
	Maxbooking_Booking_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_maxbooking_booking_widget' );
register_deactivation_hook( __FILE__, 'deactivate_maxbooking_booking_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-maxbooking-booking-widget.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_maxbooking_booking_widget() {

	$plugin = new Maxbooking_Booking_Widget();
	$plugin->run();

}
run_maxbooking_booking_widget();
