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

	<main id="main" class="row">
		<div id="primary" class="container-fluid">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/post' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>

				<?php get_template_part( 'template-parts/sidebar-footer' ); ?>
				<?php get_template_part( 'template-parts/recent' ); ?>
				<?php get_template_part( 'template-parts/related' ); ?>

		</div>
	</main>
<?php

get_footer();
