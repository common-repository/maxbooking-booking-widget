<?php echo $args['before_widget']; ?>
<?php if ( ! empty( $instance['title'] ) ) : ?>
<?php echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>
<?php endif; ?>
<form class="maxbooking-booking-widget-widget <?php echo ! empty( $layout ) ? 'maxbooking-booking-widget-' . esc_attr( $layout ) : '' ?>" 
	target="_blank" method="post" action="https://book.maxbooking.com/search.php?id=<?php echo esc_attr( $property_group ); ?>">	
	<?php if ( ! empty( $location_select_options ) ) : ?>
	<div class="maxbooking-booking-widget-control-group maxbooking-booking-widget-location">
		<label for="<?php echo esc_attr( $args['widget_id'] ); ?>-location-select"><?php esc_html_e( 'Location', 'maxbooking-booking-widget' ); ?></label>
		<select name="location" id="<?php echo esc_attr( $args['widget_id'] ); ?>-location-select">
			<?php echo $location_select_options; ?>
		</select>
	</div>
	<?php endif; ?>
	<?php include 'maxbooking-booking-widget-common-fields.php'; ?>
	<div class="maxbooking-booking-widget-control-group maxbooking-booking-widget-search">
		<button type="submit" name="submit_search"><?php esc_html_e( 'Search', 'maxbooking-booking-widget' ); ?></button>
	</div>
</form>
<?php echo $args['after_widget']; ?>
