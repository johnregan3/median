<?php
/**
 * Related Posts Template Part
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

global $post;
$posts = median_get_related_posts();

if ( ! empty( $posts ) && is_array( $posts ) ) : ?>
	<div class="row related-posts related-posts--related">
		<div class="container">
			<div class="row">
				<?php foreach ( $posts as $post ) : ?>
					<?php setup_postdata( $post ); ?>
					<?php get_template_part( 'template-parts/related-block' ); ?>
					<?php wp_reset_postdata(); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
