<?php
/**
 * Base Index file
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

get_header();

?>

	<main id="main">
		<div id="primary" class="container">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/post', 'excerpt' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>

				<?php get_template_part( 'template-parts/post', 'nav' ); ?>
		</div>
	</main>
<?php

get_footer();
