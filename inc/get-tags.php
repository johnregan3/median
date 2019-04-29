<?php
/**
 * Custom Get Tags function
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

function median_get_tags() {
	$transient_name = 'median_get_tags';
	$tags = get_transient( '$transient_name' );
	if ( false !== $tags ) {
		return $tags;
	}
	$tags = get_terms( array(
		'taxonomy' => 'post_tag',
		'orderby'  => 'count',
		'order'    => 'DESC',
		'number' => 5,
	) );
	set_transient( $transient_name, $tags, HOUR_IN_SECONDS );
	return $tags;
}

function median_get_cats() {
	$transient_name = 'median_get_cats';
	$tags = get_transient( '$transient_name' );
	if ( false !== $tags ) {
		return $tags;
	}
	$tags = get_terms( array(
		'taxonomy' => 'category',
		'orderby'  => 'count',
		'order'    => 'DESC',
		'number' => 5,
	) );
	set_transient( $transient_name, $tags, HOUR_IN_SECONDS );
	return $tags;
}

