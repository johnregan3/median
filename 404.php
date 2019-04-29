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

			<div class="row justify-content-center post__item">
				<div class="col-12 col-md-8">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post--single' ); ?>>
						<header class="post__header">
							<h1 class="post__title"><?php esc_html_e( 'Page not found', 'median' ); ?></h1>
						</header>
						<div class="post__body ">
							<p><a href="<?php home_url('/'); ?>" title="<?php echo esc_attr( 'Return to the Home Page', 'median' ); ?>"><?php esc_html_e( 'Return to the Home Page', 'median' ); ?></a></p>
						</div>
					</article>
				</div>

			</div>

		</div>
	</main>
<?php

get_footer();
