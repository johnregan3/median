<?php
/**
 * Front Page Post Excerpt Template Part
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>

<div class="col-12">

	<div class="post-excerpt post-excerpt--front post-excerpt--front--first">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post__image__wrap">
				<?php median_the_featured_image( '', 'four-one' ); ?>
			</div>
		<?php endif; ?>
		<div>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="post__header post__header--excerpt">
					<h2 class="post__title post__title--excerpt"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
