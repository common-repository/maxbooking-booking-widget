<?php foreach ( $fields as $field_name => $field_value ) : ?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( $field_name ) ); ?>"><?php echo esc_attr( $fields_settings[ $field_name ]['label'] ); ?></label> 
		<?php if ( isset( $fields_settings[ $field_name ]['values'] ) ) : ?>
			<select id="<?php echo esc_attr( $this->get_field_id( $field_name ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( $field_name ) ); ?>">
				<?php foreach ( $fields_settings[ $field_name ]['values'] as $key => $label ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php echo (string) $key === $field_value ? 'selected="selected"' : ''; ?>><?php echo esc_attr( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		<?php else : ?>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $field_name ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $field_name ) ); ?>" type="text" value="<?php echo esc_attr( $field_value ); ?>">
		<?php endif; ?>
		<?php if ( isset( $fields_settings[ $field_name ]['description'] ) ) : ?>
			<span class="description"><?php echo esc_html( $fields_settings[ $field_name ]['description'] ); ?></span>
		<?php endif;?>
	</p>
<?php endforeach; ?> 
