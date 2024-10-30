<?php
/**
 * Base class for widgets
 *
 * @link       https://developers.maxbooking.com/docs/booking-widget-for-wordpress
 * @since      1.0.0
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/widgets
 */

/**
 * Base class for widgets
 *
 * @package    Maxbooking_Booking_Widget
 * @subpackage Maxbooking_Booking_Widget/widgets
 * @author     MaxBooking.com <info@maxbooking.com>
 */
abstract class Maxbooking_Booking_Widget_Widget extends WP_Widget {

	/**
	 * Settings for widget fields
	 *
	 * @var array $fields_settings Array defining the widget fields
	 */
	protected $fields_settings = array();

	/**
	 * Widget constructor
	 *
	 * @param string $id_base         Optional Base ID for the widget, lowercase and unique. If left empty,
	 *                                a portion of the widget's class name will be used Has to be unique.
	 * @param string $name            Name for the widget displayed on the configuration page.
	 * @param array  $widget_options  Optional. Widget options. See wp_register_sidebar_widget() for information
	 *                                on accepted arguments. Default empty array.
	 * @param array  $control_options Optional. Widget control options. See wp_register_widget_control() for
	 *                                information on accepted arguments. Default empty array.
	 */
	public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() ) {
		parent::__construct( $id_base, $name, $widget_options, $control_options );
		$this->fields_settings = $this->get_initial_fields_settings();
	}

	/**
	 * Get initial settings for all fields
	 *
	 * @return array An array of fields where the field name is the key and the value is an array
	 *               of field settings in with the following values:
	 *               'label' - Field label
	 *				 'description' - Field description.
	 *               'default_value' - Field default value.
	 *               'pattern' - regex pattern for field value validation
	 *               'values' - An array of values. Only applicable for a select.
	 */
	protected abstract function get_initial_fields_settings();

	/**
	 * Display widget settings form
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$fields_settings = $this->fields_settings;
		$fields = array();
		foreach ( $this->fields_settings as $field_name => $field_settings ) {
			$fields[ $field_name ] = self::get_field_value( $instance, $field_name, $field_settings );
		}
		include 'partials/' . $this->get_widget_partials_prefix() . '-admin.php';
	}

	/**
	 * Update settings for a particular instance
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $this->fields_settings as $field_name => $field_settings ) {
			$instance[ $field_name ] = self::get_field_value( $new_instance, $field_name, $field_settings );
		}
		return $instance;
	}

	/**
	 * Get name prefix for parials files
	 *
	 * @return string Partials files prefix
	 */
	protected function get_widget_partials_prefix() {
		return str_replace( '_', '-', $this->id_base );
	}

	/**
	 * Get value of a fields from the supplied widget instance
	 *
	 * @param  array  $instance Widget instance.
	 * @param  string $field_name Field name.
	 * @param  array  $field_settings Settings for the field.
	 * @return string Field value.
	 */
	protected static function get_field_value( $instance, $field_name, $field_settings ) {
		if ( ! isset( $instance[ $field_name ] )
			|| '' === $instance[ $field_name ]
			|| ( isset( $field_settings['pattern'] )
				&& 1 !== preg_match( $field_settings['pattern'], $instance[ $field_name ] ) )
			|| ( isset( $field_settings['values'] )
				&& ! isset( $field_settings['values'][ $instance[ $field_name ] ] ) )
		) {
			return isset( $field_settings['default_value'] ) ? $field_settings['default_value'] : '';
		}
		return strip_tags( $instance[ $field_name ] );
	}

	/**
	 * Create HTML options for select with numeric values
	 *
	 * @param  int    $count Number of options.
	 * @param  string $selected_value Settings for the field.
	 * @return string String with HTML code.
	 */
	protected static function create_numeric_options_html( $count, $selected_value = '' ) {
		$options = array();
		for ( $i = 1; $i <= $count; $i++ ) {
			$options[ $i ] = $i;
		}
		return self::create_options_html( $options, $selected_value );
	}

	/**
	 * Create HTML options for a select
	 *
	 * @param  array  $options Number of options.
	 * @param  string $selected_value Settings for the field.
	 * @return string String with HTML code.
	 */
	protected static function create_options_html( $options, $selected_value = '' ) {
		$html = '';
		foreach ( $options as $value => $text ) {
			$html .= '<option value="' . esc_attr( $value ) . '"';
			if ( $value == $selected_value ) {
				$html .= ' selected="selected"';
			}
			$html .= '>' . esc_html( $text ) . '</option>';
		}
		return $html;
	}

	/**
	 * Parse list definition
	 *
	 * @param string $list_definition List definition in the following format:
	 *                                key1:label1;key2:label2
	 * @return array An array with list items
	 */
	protected static function parse_list_definition( $list_definition ) {
		$list = array();
		$pair_tokens = explode( ';', $list_definition );
		foreach ( $pair_tokens as $pair_token ) {
			$tokens = explode( ':', $pair_token );
			if ( count( $tokens ) === 2 ) {
				$list[ $tokens[0] ] = $tokens[1];
			}
		}
		return $list;
	}

}
