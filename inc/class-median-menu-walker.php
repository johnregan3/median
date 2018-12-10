<?php
/**
 * Median Nav Menu Walker.
 *
 * A barebones nav menu walker.
 *
 * @link    https://gist.github.com/alexstandiford/a03615c2ddefa5974955bb6e66d24f60
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

/**
 * Class Median_Menu_Walker
 *
 * @package Median
 * @since   1.0.0
 */
class Median_Menu_Walker extends \Walker_Nav_Menu {

	/**
	 * @inheritdoc
	 */
	function start_lvl( &$output, $depth = 0, $args = [] ) {
		$output .= '<ul>';
	}

	/**
	 * @inheritdoc
	 */
	function end_lvl( &$output, $depth = 0, $args = [] ) {
		$output .= '</ul>';
	}

	/**
	 * @inheritdoc
	 *
	 * @todo use atts correctly.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$title  = ! empty( $item->title ) ? strip_tags( $item->title ) : $item->title;
		$output .= '<li><a href="' . esc_url( $item->url ) . '" title="' . esc_attr( $title ) . '">' . esc_attr( $item->title );
	}

	/**
	 * @inheritdoc
	 */
	function end_el( &$output, $item, $depth = 0, $args = [] ) {
		$output .= '</a></li>';
	}
}
