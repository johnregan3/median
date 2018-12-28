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
		<div id="primary" class="container-fluid">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/page' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>

				<?php get_template_part( 'template-parts/sidebar-footer' ); ?>

		</div>
	</main>
<?php

get_footer();
