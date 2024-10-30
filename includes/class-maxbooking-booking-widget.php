<?php
/**
 * The file that defines the core plugin class
 *
 * @link       https://developers.maxbooking.com/docs/booking-widget-for-wordpress
 * @since      1.0.0
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/includes
 * @author     MaxBooking.com <info@maxbooking.com>
 */
class Maxbooking_Booking_Widget {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Maxbooking_Booking_Widget_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'maxbooking-booking-widget';
		$this->version = '1.1.3';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_public_hooks();
		$this->define_widgets_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Maxbooking_Booking_Widget_Loader. Orchestrates the hooks of the plugin.
	 * - Maxbooking_Booking_Widget_i18n. Defines internationalization functionality.
	 * - Maxbooking_Booking_Widget_Admin. Defines all hooks for the admin area.
	 * - Maxbooking_Booking_Widget_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-maxbooking-booking-widget-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-maxbooking-booking-widget-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-maxbooking-booking-widget-public.php';

		/**
		 * Widgets
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-maxbooking-booking-widget-widgets.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-maxbooking-booking-widget-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-maxbooking-booking-widget-property-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-maxbooking-booking-widget-property-group-widget.php';

		$this->loader = new Maxbooking_Booking_Widget_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Maxbooking_Booking_Widget_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Maxbooking_Booking_Widget_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Maxbooking_Booking_Widget_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_shortcode( 'maxbookingwidget', $plugin_public, 'booking_widget_shortcode' );

	}

	/**
	 * Register all of the hooks related to the widgets functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_widgets_hooks() {

		$plugin_widgets = new Maxbooking_Booking_Widget_Widgets( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'widgets_init', $plugin_widgets, 'register_widgets' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_widgets, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_widgets, 'enqueue_styles' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Maxbooking_Booking_Widget_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
