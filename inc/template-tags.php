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

	?>
	<div class="median-scaled-image__wrapper <?php echo esc_attr( $classes ); ?>">

		<?php if ( ! empty( $link_url ) && is_string( $link_url ) ) : ?>
		<a href="<?php echo esc_url( $link_url ); ?>" <?php echo wp_kses_post( ! empty( $atts['title'] ) ? 'title="' . $atts['title'] . '"' : '' ); ?>>
			<?php endif; ?>

			<div class="median-scaled-image" style="background-image: url( '<?php echo esc_url( $image_url ) ?>' )">
				<img src="<?php echo esc_url( $image_url ) ?>" style="display: none" <?php echo esc_html( ! empty( $atts['title'] ) ? 'title="' . $atts['title'] . '"' : '' ); ?> <?php echo esc_html( ! empty( $atts['alt'] ) ? 'alt="' . $atts['alt'] . '"' : '' ); ?>/>
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
