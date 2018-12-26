<?php
/**
 * Recent Posts Template Part
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

$query = new WP_Query(
	array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 3,
		'no_found_rows'  => true,
	)
);

if ( $query->have_posts() ) : ?>
	<div class="row related-posts related-posts--related">
		<div class="container">
			<div class="row">
				<?php while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<?php get_template_part( 'template-parts/related-block' ); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
