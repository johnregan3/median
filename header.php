<?php
/**
 * Header Template
 *
 * @package Median
 * @since   1.0.0
 * @author  Fervor Marketing <dev@createfervor.com>
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php // Primary Menu - Must be located here in the markup. ?>
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<amp-sidebar id="primary-menu" layout="nodisplay" side="left">
				<button class="amp-close-image trigger-button" width="20" height="20" alt="close sidebar" on="tap:primary-menu.close" role="button" tabindex="0"><i class="fas fa-times"></i></button>
				<?php get_search_form(); ?>
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<nav>
						<?php wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
							'walker'         => new \Median\Menu_Walker(),
						) );
						?>
					</nav>
				<?php endif; ?>
			</amp-sidebar>
		<?php endif; ?>

		<?php // Use `amp-position-observer` to start the animation when the user starts to scroll. ?>
		<div id="scroll-to-marker">
			<amp-position-observer on="enter:hideScrollTrigger.start; exit:showScrollTrigger.start" layout="nodisplay"></amp-position-observer>
		</div>
