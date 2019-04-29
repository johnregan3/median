<?php
/**
 * Single Page Template Part
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>

<div class="row justify-content-center post__item">
	<div class="col-12 col-md-10 col-xl-6">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'post--single' ); ?>>
			<header class="post__header">
				<h1 class="post__title"><?php the_title(); ?></h1>
			</header>
			<?php if ( has_post_thumbnail() ) : ?>
				<?php median_the_featured_image(); ?>
			<?php endif; ?>
			<div class="post__body ">
				<?php the_content(); ?>
			</div>
		</article>
	</div>

</div>
