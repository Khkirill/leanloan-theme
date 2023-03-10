<?php
$unique_id = wp_unique_id( 'search-form-' );
$aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
?>
<form role="search" <?php echo $aria_label; ?> method="get" class="search-form"
      action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
        <?php _e( 'Search&hellip;', 'ln' ); ?>
    </label>
	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field"
           value="<?php echo get_search_query(); ?>" name="s" />
	<input type="submit" class="search-submit"
           value="<?php echo esc_attr_x( 'Search', 'submit button', 'ln' ); ?>" />
</form>
