<?php
/**
 * Related Posts Block Template Part
 *
 * This is used by a query loop to render a single "Related Post" block (similar in structure to a widget).
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>
<div class="col-12 col-md related-posts__block">
	<div class="related-posts__widget">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php median_the_featured_image( get_the_ID(), 'sixteen-nine' ); ?>
		<?php endif; ?>
		<h3 class="related-posts__widget__title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		<div class="related-posts__widget__content"><?php echo wp_kses_post( blaze_get_the_excerpt() ); ?></div>
	</div>
</div>
