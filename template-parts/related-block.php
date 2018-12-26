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
		<h3 class="related-posts__widget__title"><?php the_title(); ?></h3>
		<?php if ( has_post_thumbnail() ) : ?>
			<?php median_the_featured_image( get_the_ID(), 'sixteen-nine' ); ?>
		<?php endif; ?>
	</div>
</div>
