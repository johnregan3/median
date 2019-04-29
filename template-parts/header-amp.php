<?php
/**
 * AMP-Enabled Header elements.
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

$recent_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 5,
		'no_found_rows'  => true,
	)
);

$recent_posts = $recent_query->posts;

$tags = median_get_tags();
$cats = median_get_cats();

?>

<?php // Header Menu - Must be located immediately following the <body> tag. ?>
<amp-sidebar id="header-menu" layout="nodisplay" side="right">
	<button class="amp-close-image trigger-button trigger-button--menu-close" on="tap:header-menu.close" role="button" tabindex="0">
		<i aria-hidden="true" class="fas fa-times" title="<?php esc_html_e( 'Close menu', 'median' ); ?>"><span class="sr-only"><?php esc_html_e( 'Close Menu', 'median' ); ?></span></i>
	</button>
	<?php if ( has_nav_menu( 'header' ) ) : ?>
		<h3><?php esc_html_e( 'Menu', 'median' ); ?></h3>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'header',
					'menu_class'     => 'header-menu ul--lines',
					'walker'         => new Median_Menu_Walker(),
				)
			);
			?>
	<?php endif; ?>

	<?php if ( is_single() ) : ?>
		<?php $related_posts = median_get_related_posts(); ?>
		<?php if ( ! empty( $related_posts ) && is_array( $related_posts ) ) : ?>
			<h3><?php esc_html_e( 'Related', 'median' ); ?></h3>
			<ul class="ul--lines">
				<?php foreach ( $related_posts as $item ) : ?>
					<li>
						<a href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>" title="<?php echo esc_attr( $item->post_title ); ?>"><?php echo wp_kses_post( $item->post_title ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>

		<?php endif; ?>
	<?php endif; ?>

	<?php if ( ! empty( $recent_posts ) && is_array( $recent_posts ) ) : ?>
		<h3><?php esc_html_e( 'Recent', 'median' ); ?></h3>
		<ul class="ul--lines">
			<?php foreach ( $recent_posts as $item ) : ?>
				<li>
					<a href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>" title="<?php echo esc_attr( $item->post_title ); ?>"><?php echo wp_kses_post( $item->post_title ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<?php if ( false ) : ?>
		<h3><?php esc_html_e( 'Top Tags', 'median' ); ?></h3>
		<ul class="ul--lines">
			<?php foreach ( $tags as $term ) : ?>
				<li>
					<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" title="<?php echo esc_attr( $term->name ); ?>"><?php echo wp_kses_post( $term->name ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>

	<?php if ( ! empty( $cats ) && is_array( $cats ) ) : ?>
		<h3><?php esc_html_e( 'Categories', 'median' ); ?></h3>
		<ul class="ul--lines">
			<?php foreach ( $cats as $term ) : ?>
				<li>
					<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" title="<?php echo esc_attr( $term->name ); ?>"><?php echo wp_kses_post( $term->name ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>

	<div class="copyright">
		&copy;<?php echo esc_html( date( 'Y' ) ); ?>, <?php bloginfo( 'name' ); ?>.
	</div>

	<!--
	<ul class="ul--social">
		<li>
			<a href="<?php echo esc_url( 'https://twitter.com/johnregan3' ); ?>" title="<?php echo esc_attr( __( '@johnregan3 on Twitter', 'median' ) ); ?>" class="ul--social--twitter"><i aria-hidden="true" class="fab fa-twitter" title="<?php esc_html_e( 'Twitter icon', 'median' ); ?>"><span class="sr-only"><?php esc_html_e( 'Twitter icon', 'median' ); ?></span></i></a>
		</li>
	</ul>
	-->

</amp-sidebar>

<?php // Scroll to Top button marker ?>
<div id="scroll-to-marker">
	<amp-position-observer on="enter:hideScrollTrigger.start; exit:showScrollTrigger.start" layout="nodisplay"></amp-position-observer>
</div>
