<?php
/**
* AMP-Enabled Header elements.
*
* @package Median
* @since   1.0.0
* @author  John Regan <john@johnregan3.com>
*/

?>


<?php // Primary Menu - Must be located immediately following the <body> tag. ?>
<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<amp-sidebar id="primary-menu" layout="nodisplay" side="left">
		<button class="amp-close-image trigger-button" width="20" height="20" alt="close sidebar" on="tap:primary-menu.close" role="button" tabindex="0"><i class="fas fa-times"></i></button>

		<?php get_search_form(); ?>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav>
				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class'     => 'primary-menu',
					'walker'         => new Median_Menu_Walker(),
				) );
				?>
			</nav>
		<?php endif; ?>
	</amp-sidebar>
<?php endif; ?>


<?php // Scroll to Top button marker ?>
<div id="scroll-to-marker">
	<amp-position-observer on="enter:hideScrollTrigger.start; exit:showScrollTrigger.start" layout="nodisplay"></amp-position-observer>
</div>
