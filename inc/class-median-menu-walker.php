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
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$atts['title']  = ! empty( $item->title ) ? $item->title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->rel ) ? $item->rel : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$output .= '<li' . $id . $class_names . '><a href="' . esc_url( $item->url ) . '" title="' . esc_attr( $atts['title'] ) . '">' . esc_attr( $atts['title'] );
	}

	/**
	 * @inheritdoc
	 */
	function end_el( &$output, $item, $depth = 0, $args = [] ) {
		$output .= '</a></li>';
	}
}
