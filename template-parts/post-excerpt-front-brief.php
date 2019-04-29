<?php
/**
 * Front Page First Post Excerpt Template Part
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>

<div class="col-12">
	<div class="row justify-content-center align-items-stretch align-content-stretch post-excerpt post-excerpt--front post-excerpt--front--brief">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="col-12 col-md-6 col-lg-4">
				<?php median_the_featured_image( '', 'sixteen-nine' ); ?>
			</div>
		<?php endif; ?>
		<div class="col-12 col-md-<?php echo esc_attr( has_post_thumbnail() ? '6' : '12' ); ?> col-lg-<?php echo esc_attr( has_post_thumbnail() ? '8' : '12' ); ?>">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="post__header post__header--excerpt">
					<h2 class="post__title post__title--excerpt">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="post__meta post__meta--excerpt">
						<time class="post__time post__time--excerpt" datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
					</div>
				</header>
				<div class="post__body post__body--excerpt">
					<?php the_excerpt() ?>
					<p><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'median' ); ?></a></p>
				</div>
			</article>
		</div>
	</div>
</div>
