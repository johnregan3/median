<?php
/**
 * Masthead template file
 *
 * This contains the logo and main menu.
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>

<header id="#masthead" class="site-header">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-4 site-header__left">
				<h1 class="site-header__title">
					<a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
				</h1>
			</div>

			<div class="col-sm-12 col-md-8 site-header__right">
				<?php if ( true !== median_amp_is_active() ) : ?>
					<?php get_search_form(); ?>
				<?php elseif ( ( true === median_amp_is_active() ) && ( true === has_nav_menu( 'header' ) ) ) : ?>
					<button on="tap:header-menu.toggle" class="trigger-button trigger-button--menu">
						<i aria-hidden class="far fa-bars" title="<?php esc_html_e( 'Open menu', 'median' ); ?>"><span class="sr-only"><?php esc_html_e( 'Open Menu', 'median' ); ?></span></i>
					</button>
				<?php endif; ?>
			</div>

		</div>

		<?php if ( true !== median_amp_is_active() ) : ?>
			<div class="row">
				<div class="col-12 site-header__menu">
					<?php if ( has_nav_menu( 'header' ) ) : ?>
						<nav>
							<?php wp_nav_menu( array(
								'theme_location' => 'header',
								'menu_class'     => 'nav--header header-menu',
							) );
							?>
						</nav>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
</header>
