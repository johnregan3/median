<?php
/**
 * Archive Template file
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

get_header();

$title = ( is_tag() ) ? single_tag_title( '', false ) . ' ' . __( 'Archive', 'median' ) : get_the_archive_title();

?>

	<main id="main">
		<div id="primary" class="container">

			<?php if ( have_posts() ) : ?>

				<div class="row justify-content-center">
					<h1 class="archive__title"><?php echo esc_html( $title ); ?></h1>
				</div>

					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<?php get_template_part( 'template-parts/post', 'excerpt' ); ?>

					<?php endwhile; ?>

					<?php endif; ?>

					<?php get_template_part( 'template-parts/post', 'nav' ); ?>
		</div>
	</main>
<?php

get_footer();
