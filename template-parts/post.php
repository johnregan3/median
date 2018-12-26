<?php
/**
 * Post Excerpt Template Part
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>

<div class="row">
	<div class="col-12">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'post--single' ); ?>>
			<header class="post__header">
				<h1 class="post__title"><?php the_title(); ?></h1>
				<div class="post__meta">
					<div class="post__author">
						<?php the_author_posts_link(); ?>
					</div>
					<time class="post__time" datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
				</div>
			</header>
			<?php if ( has_post_thumbnail() ) : ?>
				<?php median_the_featured_image(); ?>
			<?php endif; ?>
			<div class="post__body ">
				<?php the_content(); ?>
			</div>
		</article>
	</div>

</div>
