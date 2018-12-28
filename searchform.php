<?php
/**
 * Search Form template
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>
<form role="search" method="get" class="search-form form-small" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text sr-only"><?php esc_html_e( 'Search for:', 'median' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( __( 'Search &hellip;', 'median' ) ); ?>" value="<?php get_search_query(); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit btn-secondary" value="<?php echo esc_attr( __( 'Search', 'median' ) ); ?>" />
</form>
