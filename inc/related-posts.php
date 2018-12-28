<?php
/**
 * Functions to find related posts
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

/**
 * Get related posts.
 *
 * To set the count of posts returned, add a "posts_per_page" value to the $args array.
 * The default number of posts returned is three.
 *
 * @since 1.0.0
 *
 * @param int   $post_id A \WP_Post ID.
 * @param array $args    Array of \WP_Query args.
 * @param       $count   int The number of posts to retrieve.
 *
 * @return array An array of posts.
 */

function median_get_related_posts( $post_id = 0, $args = array(), $count = 3 ) {

	// Make sure we have a good post_id.  If not, grab the current post.
	if ( empty( $post_id ) || ! is_numeric( $post_id ) ) {
		$post_id = get_the_ID();
	}

	// If we still don't have a good ID, bail.
	if ( empty( $post_id ) ) {
		return array();
	}

	$transient_name = median_related_transient_name( $args );
	$output         = get_transient( $transient_name );

	// Don't check if not empty, as the saved value may be an empty array.
	if ( is_array( $output ) ) {

		// Return what we have saved.
		return $output;
	}

	/*
	 * Start by filtering the input $args.
	 * wp_parse_args() allows us to set default arguments
	 * that can be overriden by input.
	 *
	 * Note that we get the post type of the requested post,
	 * and we set the author of the current post.
	 */
	$args = wp_parse_args( $args, array(
		'posts_per_page' => $count,
		'orderby'        => 'title',
		'post_type'      => get_post_type( $post_id ),
		'post_status'    => 'publish',
		'author'         => get_post_field( 'post_author', $post_id ),
	) );

	// Set up a taxonomy query.
	$post = get_post( $post_id );

	// Get all taxonomies (e.g., "Tags," "Categories") that this post has.
	$taxonomies = get_object_taxonomies( $post, 'names' );

	/*
	 * Sanity check.
	 * Limit the number of taxonomies to prevent getting creating a heavy query.
	 */
	$taxonomies = array_slice( $taxonomies, 0, 3 );

	/*
	 * Get each term associated with the post and set
	 * a taxonomy query for it.
     */
	foreach ( $taxonomies as $taxonomy ) {
		// Get each term (e.g., single tag or single category) that this post has.
		$terms = get_the_terms( $post_id, $taxonomy );
		if ( empty( $terms ) ) {
			continue;
		}
		$term_list           = wp_list_pluck( $terms, 'slug' );
		$args['tax_query'][] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $term_list,
		);
	}

	/*
	 * If we have more than one taxonomy, use "OR"
	 * to basically say the posts can use any of the terms.
	 *
	 * Otherwise, "AND" will mean that we will only look for posts
	 * that contain all of the same terms of the current post, which
	 * can be quite specific and restrictive.
	 */
	if ( isset( $args['tax_query'] ) && count( $args['tax_query'] ) > 1 ) {
		$args['tax_query']['relation'] = 'OR';
	}

	// Make sure the current post is not part of what we get back.
	$args['post__not_in'] = array( $post_id );

	// Run the query.
	$posts = median_related_posts_get( $args );

	if ( ! empty( $posts ) && count( $posts ) >= $count ) {
		$posts = array_slice( $posts, 0, $count );
		set_transient( $transient_name, $posts, HOUR_IN_SECONDS );

		return $posts;
	}

	// Since we're continuing, don't duplicate any posts.
	$args['post__not_in'] = wp_list_pluck( $posts, 'ID' );

	// Remove the author arg and try again.
	unset( $args['author'] );
	$posts                = median_related_posts_get( $args, $posts );
	$args['post__not_in'] = wp_list_pluck( $posts, 'ID' );
	if ( ! empty( $posts ) && count( $posts ) >= $count ) {
		$posts = array_slice( $posts, 0, $count );
		set_transient( $transient_name, $posts, HOUR_IN_SECONDS );

		return $posts;
	}

	// Remove tax query arg and try again.
	unset( $args['tax_query'] );
	$posts = median_related_posts_get( $args, $posts );

	// We're not going to remove any more args, just return what we have.
	if ( ! empty( $posts ) && is_array( $posts ) ) {
		$posts = array_slice( $posts, 0, $count );
		set_transient( $transient_name, $posts, HOUR_IN_SECONDS );

		return $posts;
	}

	return $posts;
}

/**
 * Run a simple \WP_Query using the provided args.
 *
 * @since 1.0.0
 *
 * @param array $args An array of query args.
 *
 * @return array An array of posts, else an empty array.
 */
function median_related_get_posts_by_args( $args = array() ) {
	if ( empty( $args ) || ! is_array( $args ) ) {
		return array();
	}

	// Create the transient name.
	$transient_name = median_related_transient_name( $args );
	$posts = get_transient( $transient_name );

	// Don't check if not empty, as the saved value may be an empty array.
	if ( ! is_array( $posts ) ) {
		$posts = array();

		// Don't use get_posts as the WP_Query object will be cached.
		$query = new WP_Query( $args );
		if ( ! empty( $query->posts ) && is_array( $query->posts ) ) {
			$posts = $query->posts;
		}
		set_transient( $transient_name, $posts, HOUR_IN_SECONDS );
	}

	return $posts;
}

/**
 * Get some posts using the provided $args.
 *
 * @since 1.0.0
 *
 * @param array $args  An array of \WP_Query args.
 * @param array $posts An array of posts.
 *
 * @return array An updated array of posts.
 */
function median_related_posts_get( $args, $posts = array() ) {
	$new_posts = median_related_get_posts_by_args( $args );
	if ( is_array( $new_posts ) && ! empty( $new_posts ) ) {
		$posts = $posts + $new_posts;
	}

	return $posts;
}

function median_related_transient_name( $args = array() ) {
	return 'median_rel_' . md5( maybe_serialize( $args ) );
}
