<?php
/**
 * Theme Functions
 *
 * Base setup for the theme.
 *
 * @package Median
 * @since   1.0.0
 * @author  Fervor Marketing <dev@createfervor.com>
 */

/**
 * Autoload theme classes.
 *
 * Loads classes in the classes/ directory whose
 * file names are prefixed with "class-" and also contain the
 * "Median" namespace.
 *
 * @since 1.0.0
 *
 * @param string $class A Class name.
 */
function median_autoload( $class ) {
	$class = strtolower( $class );

	if ( false === strpos( $class, 'median' ) ) {
		return;
	}
	$class = str_replace( 'median\\', '', $class );
	$class = str_replace( '\\', '/', $class );
	$class = str_replace( '_', '-', $class );
	$path  = get_template_directory() . '/inc/classes/class-' . $class . '.php';

	if ( file_exists( $path ) && is_readable( $path ) ) {
		include $path;
	}
}

spl_autoload_register( 'median_autoload' );

if ( class_exists( '\Blaze\Singleton' ) ) {
	Median\Theme::get_instance();
}
