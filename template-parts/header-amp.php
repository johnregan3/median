<?php
/**
* AMP-Enabled Header elements.
*
* @package Median
* @since   1.0.0
* @author  John Regan <john@johnregan3.com>
*/

?>


<?php // Header Menu - Must be located immediately following the <body> tag. ?>
<?php if ( has_nav_menu( 'header' ) ) : ?>
	<amp-sidebar id="header-menu" layout="nodisplay" side="left">
		<button class="amp-close-image trigger-button trigger-button--menu-close" width="20" height="20" alt="close sidebar" on="tap:header-menu.close" role="button" tabindex="0"><i aria-hidden class="far fa-bars" title="<?php esc_html_e( 'Close menu', 'median' ); ?>"><span class="sr-only"><?php esc_html_e( 'Close Menu', 'median' ); ?></span></i></button>

		<?php if ( has_nav_menu( 'header' ) ) : ?>
			<nav>
				<?php wp_nav_menu( array(
					'theme_location' => 'header',
					'menu_class'     => 'header-menu',
				) );
				?>
			</nav>
		<?php endif; ?>

		<?php get_search_form(); ?>
	</amp-sidebar>
<?php endif; ?>


<?php // Scroll to Top button marker ?>
<div id="scroll-to-marker">
	<amp-position-observer on="enter:hideScrollTrigger.start; exit:showScrollTrigger.start" layout="nodisplay"></amp-position-observer>
</div>
