<?php
/**
 * Post Excerpt Template Part
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
				<div class="post__meta">
					<time class="post__time" datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
					<div class="post__tags"><?php the_category( ',' ); ?></div>
				</div>
			</header>
			<?php if ( has_post_thumbnail() ) : ?>
				<?php median_the_featured_image(); ?>
			<?php endif; ?>
			<div class="post__body ">
				<?php the_content(); ?>
			</div>
			<div class="post__footer">
				<div class="post__footer__tags">
					<?php the_tags( '' ); ?>
				</div>
				<a on="tap:header-menu.toggle" class="discover-trigger">
					<?php esc_html_e( 'Discover More', 'median' ); ?>
				</a>
			</div>
			<?php get_template_part( 'template-parts/post-form' ); ?>
		</article>
	</div>

</div>
