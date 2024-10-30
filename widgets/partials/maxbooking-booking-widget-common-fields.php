<div class="maxbooking-booking-widget-control-group maxbooking-booking-widget-arrival">
	<label for="<?php echo esc_attr( $args['widget_id'] ); ?>-arrival-input"><?php esc_html_e( 'Arrival', 'maxbooking-booking-widget' ); ?></label>
	<input type="text" name="arrival_date"
		id="<?php echo esc_attr( $args['widget_id'] ); ?>-arrival-input"
		placeholder="<?php esc_html_e( 'Arrival date...', 'maxbooking-booking-widget' ); ?>"
		data-arrival-date-offset="<?php echo esc_attr( $arrival_date_offset ); ?>" />
	<input type="hidden" name="ad_tt" />
	<input type="hidden" name="ad_mm" />
	<input type="hidden" name="ad_yyyy" />
</div>
<?php if ( 'vertical' === $layout ) : ?>
<div class="maxbooking-booking-widget-nights-guests-block">
<?php endif; ?>
	<div class="maxbooking-booking-widget-control-group maxbooking-booking-widget-nights">
		<label for="<?php echo esc_attr( $args['widget_id'] ); ?>-nights-select"><?php esc_html_e( 'Nights', 'maxbooking-booking-widget' ); ?></label>
		<select name="lengthofstay" id="<?php echo esc_attr( $args['widget_id'] ); ?>-nights-select">
			<?php echo $nights_select_options; ?>
		</select>
	</div>
	<div class="maxbooking-booking-widget-control-group maxbooking-booking-widget-guests">
		<label for="<?php echo esc_attr( $args['widget_id'] ); ?>-guests-select"><?php esc_html_e( 'Guests', 'maxbooking-booking-widget' ); ?></label>
		<select name="persons" id="<?php echo esc_attr( $args['widget_id'] ); ?>-guests-select">
			<?php echo $guests_select_options; ?>
		</select>
	</div>
<?php if ( 'vertical' === $layout ) : ?>	
</div>
<?php endif; ?>
