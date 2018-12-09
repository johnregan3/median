<?php
/**
 * Base Index file
 *
 * @package Median
 * @since   1.0.0
 * @author  Fervor Marketing <dev@createfervor.com>
 */

get_header();

?>

	<main id="main" class="row no-gutters">

		<div id="primary" class="col-12 col-md-8">
			<div class="content__header"><?php the_archive_title(); ?></div>

			<div class="content__column">
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php blaze_get_template_part( 'templates/excerpt' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>

				<?php blaze_get_template_part( 'templates/post-nav' ); ?>

			</div><!-- .content__column -->
		</div><!-- primary -->
		<?php blaze_get_template_part( 'templates/secondary' ); ?>
	</main>
<?php

get_footer();
