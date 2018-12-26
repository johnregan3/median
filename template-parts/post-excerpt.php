<?php
/**
 * Post Excerpt Template Part
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>

<div class="row align-items-stretch align-content-stretch post-excerpt">
	<div class="col-sm-<?php echo esc_attr( has_post_thumbnail() ? '9' : '12' ); ?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="post__header post__header--excerpt">
				<h2 class="post__title post__title--excerpt"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<div class="post__body post__body--excerpt">
				<?php the_excerpt() ?>
			</div>
			<div class="post__meta post__meta--excerpt">
				<div class="post__author post__author--excerpt">
					<?php the_author_posts_link(); ?>
				</div>
				<time class="post__time post__time--excerpt" datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
			</div>
		</article>
	</div>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="col-sm-3">
			<?php median_the_featured_image(); ?>
		</div>
	<?php endif; ?>
</div>
