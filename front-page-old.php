<?php
/**
 * Base Index file
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

global $wp_query;

get_header();

$i = 1;

?>

	<main id="main">
		<div id="primary" class="container">
			<div class="row justify-content-center align-items-stretch align-content-stretch">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php if ( 0 === get_query_var( 'paged' ) && 1 === $i ) : ?>

							<?php get_template_part( 'template-parts/post', 'excerpt-front-first' ); ?>

						<?php elseif ( 0 === get_query_var( 'paged' ) && $i < 4 ) : ?>

							<?php get_template_part( 'template-parts/post', 'excerpt-front' ); ?>

						<?php else : ?>

							<?php get_template_part( 'template-parts/post', 'excerpt-front-brief' ); ?>

						<?php endif; ?>

						<?php $i ++; ?>

					<?php endwhile; ?>

				<?php endif; ?>

			</div>

			<div class="row">

				<?php get_template_part( 'template-parts/post', 'nav' ); ?>

			</div>
		</div>
	</main>
<?php

get_footer();
