<?php
/**
 * Template Tags
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

/**
 * Render a scaled image.
 *
 * This is a element that hides the image and uses the same image as the background
 * so that the image will scale to fit the provided area.
 *
 * To change the aspect ratio, use a percentage on the bottom padding of the .median-scaled-image element.
 *
 * Example CSS:
 *
 * // 3:4 aspect ratio.
 * .scaled-image {
 *      padding-bottom: 75%;
 * }
 *
 * The "classes" attribute should be a string.
 *
 * @since 1.0.0
 *
 * @param string $image_url An Image URL.
 * @param string $link_url  Optional. A link URL.
 * @param array  $atts      Array of attributes ('alt', 'title', and 'classes' )
 */
function median_scaled_image( $image_url, $link_url = '', $atts = array() ) {
	if ( empty( $image_url ) ) {
		return;
	}
	$classes = '';
	if ( ! empty( $atts['classes'] ) && is_string( $atts['classes'] ) ) {
		$classes = $atts['classes'];
	} elseif ( ! empty( $atts['classes'] ) && is_string( $atts['classes'] ) ) {
		$classes = implode( ' ', $atts['classes'] );
	}

	$title = ! empty( $atts['title'] ) ? $atts['title'] : '';
	$alt = ! empty( $atts['alt'] ) ? $atts['alt'] : '';

	?>
	<div class="median-scaled-image__wrapper <?php echo esc_attr( $classes ); ?>">

		<?php if ( ! empty( $link_url ) && is_string( $link_url ) ) : ?>
		<a href="<?php echo esc_url( $link_url ); ?>" <?php echo wp_kses_post( ! empty( $atts['title'] ) ? 'title="' . $atts['title'] . '"' : '' ); ?>>
			<?php endif; ?>

			<div class="median-scaled-image" style="background-image: url( '<?php echo esc_url( $image_url ) ?>' )">
				<img src="<?php echo esc_url( $image_url ) ?>" style="display: none" title="<?php echo esc_attr( $title ); ?>" alt="<?php echo esc_attr( $alt ); ?>" />
			</div>

			<?php if ( ! empty( $link_url ) && is_string( $link_url ) ) : ?>
		</a>
	<?php endif; ?>

	</div>
	<?php
}

function median_the_featured_image( $post_id = 0, $classes = '' ) {
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	if ( empty( $post_id ) ) {
		return;
	}

	if ( true !== has_post_thumbnail( $post_id ) ) {
		return;
	}
	$img_id = get_post_thumbnail_id( $post_id );
	if ( empty( $img_id ) ) {
		return;
	}
	$image_alt   = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
	$image_title = get_post_meta( $img_id, '_wp_attachment_image_title', true );
	$image_alt   = ( ! empty( $image_alt ) ) ? $image_alt : get_the_title( $post_id );
	$image_title = ( ! empty( $image_title ) ) ? $image_title : get_the_title( $post_id );

	median_scaled_image( get_the_post_thumbnail_url( $post_id ), get_permalink( $post_id ), array(
		'alt'   => $image_alt,
		'title' => $image_title,
		'classes' => 'median-featured-image ' . $classes,
	) );

}


/**
 * Generate a pagination partial template for Bootstrap 4
 * Mostly based on http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/
 *
 * @since 1.0.0
 */
function median_archive_pagination() {
	if ( is_singular() ) {
		return;
	}

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	$links = array();

	/**    Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	/**    Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<nav aria-label="Page navigation"><ul class="archive-pagination">' . "\n";

	/**    Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links, true ) ) {
		$class = ( 1 === $paged ) ? ' class="active page-item"' : ' class="page-item"';

		printf( '<li %s><a class="page-link page-link--icon page-link--icon--back" href="%s"><i class="far fa-step-backward" aria-hidden="true" title="' . __( 'First page', 'median' ) . '"><span class="sr-only">' . __( 'First page', 'median' ) . '</span></i></a></li>' . "\n",
			$class, esc_url( get_pagenum_link( 1 ) ), '1' );

		/**    Previous Post Link */
		if ( get_previous_posts_link() ) {
			printf( '<li class="page-item page-item-direction page-item-prev"><span class="page-link">%1$s</span></li> ' . "\n",
				get_previous_posts_link( '<i class="far fa-angle-double-left" aria-hidden="true" title="' . __( 'Previous page', 'median' ) . '"></i><span class="sr-only">' . __( 'Previous page', 'median' ) . '</span>' ) );
		}

		if ( ! in_array( 2, $links, true ) ) {
			echo '<li class="page-item"></li>';
		}
	}

	// Link to current page, plus 2 pages in either direction if necessary.
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged === $link ? ' class="active page-item"' : ' class="page-item"';
		printf( '<li %s><a href="%s" class="page-link">%s</a></li>' . "\n", $class,
			esc_url( get_pagenum_link( $link ) ), $link );
	}

	// Next Post Link.
	if ( get_next_posts_link() ) {
		printf( '<li class="page-item page-item-direction page-item-next"><span class="page-link">%s</span></li>' . "\n",
			get_next_posts_link( '<i class="far fa-angle-double-right" aria-hidden="true" title="' . __( 'Next page', 'median' ) . '"></i><span class="sr-only">' . __( 'Next page', 'median' ) . '</span>' ) );
	}

	// Link to last page, plus ellipses if necessary.
	if ( ! in_array( $max, $links, true ) ) {
		if ( ! in_array( $max - 1, $links, true ) ) {
			echo '<li class="page-item"></li>' . "\n";
		}

		$class = ( $paged === $max ) ? ' class="active "' : ' class="page-item"';
		printf( '<li %1$s><a class="page-link page-link--icon page-link--icon-forward" href="%2$s" aria-label="Next"><i class="far fa-step-forward" aria-hidden="true" title="' . __( 'Last page', 'median' ) . '"></i><span class="sr-only">%s</span></a></li>' . "\n",
			$class . '', esc_url( get_pagenum_link( esc_html( $max ) ) ), esc_html( $max ) );
	}

	echo '</ul></nav>' . "\n";

}

