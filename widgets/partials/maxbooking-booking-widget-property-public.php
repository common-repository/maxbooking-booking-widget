<?php echo $args['before_widget']; ?>
<?php if ( ! empty( $instance['title'] ) ) : ?>
<?php echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>
<?php endif; ?>
<form class="maxbooking-booking-widget-widget <?php echo ! empty( $layout ) ? 'maxbooking-booking-widget-' . esc_attr( $layout ) : '' ?>"
	target="_blank" method="post" action="https://book.maxbooking.com/index.php?mod=Step1&amp;id=<?php echo isset( $property_id ) ? esc_attr( $property_id ) : key( $property_list ); ?>">
	<?php if ( isset( $property_select_options ) ) : ?>
		<div class="maxbooking-booking-widget-control-group maxbooking-booking-widget-property">
			<label for="<?php echo esc_attr( $args['widget_id'] ); ?>-property-select"><?php esc_html_e( 'Location', 'maxbooking-booking-widget' ); ?></label>
			<select name="property" id="<?php echo esc_attr( $args['widget_id'] ); ?>-property-select">
				<?php echo $property_select_options; ?>
			</select>
		</div>	
	<?php endif; ?>
	<?php include 'maxbooking-booking-widget-common-fields.php'; ?>
	<div class="maxbooking-booking-widget-control-group maxbooking-booking-widget-search">
		<button type="submit" name="submit_widget1"><?php esc_html_e( 'Search', 'maxbooking-booking-widget' ); ?></button>
	</div>
</form>
<?php echo $args['after_widget']; ?>
