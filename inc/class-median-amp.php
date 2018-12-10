<?php
/**
 * AMP Compatibility Handler
 *
 * Used to determine if the AMP plugin is active, and how to handle the theme accordingly.
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */


/**
 * Class Median_AMP.
 *
 * @package Median
 * @since   1.0.0
 */
class Median_AMP {

	public function __construct() {
		if ( true !== self::is_plugin_active() ) {
			// maybe throw admin message.
		}
	}

	/**
	 * Check if the AMP plugin is active.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public static function is_plugin_active() {
		return is_plugin_active( 'amp/amp.php' );
	}

	public function enqueue() {
		$components = array(
			'position-observer-0.1',
		);

		foreach ( $components as $component ) {
			$handle = 'median-' . $component;
			wp_register_script( $handle, 'https://cdn.ampproject.org/v0/amp-' . $component . '.js' );
			wp_enqueue_script( $handle );
		}
	}

	public function filter_component_script_tags( $tag, $handle, $src ) {
		if  ( false === strpos( 'amp', $src ) ) {
			return $tag;
		}

		/*
		 * Determine if we are using an amp component script.
		 * If so, capture the component name.
		 *
		 * Example, find "/{ CAPTURING GROUP )0.1.js
		 * The capturing group will contain a string of lowercase letters and hyphens, starting with "amp", and may end in a hyphen.
		 */
		$regex = '\/(amp-[\-a-z]*)[\d*\.\d]*.js';

		preg_match( $regex, $src, $matches );
		if ( ! is_array( $matches ) || empty( $matches[0] ) ) {
			return $tag;
		}

		// Trim off any ending hyphen.
		$component_name = rtrim( $matches[0], '-' );

		return str_replace( ' src', ' async="async" custom-element="' . esc_attr( $component_name ) . '" src', $tag );
	}

}
