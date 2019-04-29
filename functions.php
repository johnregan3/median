<?php
/**
 * Theme Functions
 *
 * Base setup for the theme.
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

include get_stylesheet_directory() . '/inc/helpers.php';
include get_stylesheet_directory() . '/inc/class-median-menu-walker.php';
include get_stylesheet_directory() . '/inc/template-tags.php';
include get_stylesheet_directory() . '/inc/related-posts.php';
include get_stylesheet_directory() . '/inc/get-tags.php';
include get_stylesheet_directory() . '/inc/blocks.php';
include get_stylesheet_directory() . '/inc/contact-form.php';

/**
 * Initialize the theme.
 *
 * @since  1.0.0
 * @action after_setup_theme.
 */
function median_init() {
	add_image_size( 'median-amp-img', 1200, 1600 );
	add_theme_support( 'menus' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Define the languages directory.
	load_theme_textdomain( 'median', get_template_directory() . '/languages' );

	// Register the navigation menus.
	register_nav_menu( 'header', __( 'Header Menu', 'median' ) );
}

add_action( 'after_setup_theme', 'median_init' );

/**
 * Enqueue scripts.
 *
 * @since  1.0.0
 * @action wp_enqueue_scripts
 */
function median_enqueue() {
	// Register and Enqueue Google Fonts.
	wp_register_style( 'median-google-fonts', 'https://fonts.googleapis.com/css?family=Signika:300,400,600|Martel:400,600,700' );
	wp_enqueue_style( 'median-google-fonts' );

	// Register Bootstrap Reset and Grid.
	wp_register_style( 'median-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.0' );

	// Register and Enqueue Theme styles.
	wp_register_style( 'median-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array( 'median-bootstrap' ), '1.0.0' );
	wp_enqueue_style( 'median-styles' );

}

add_action( 'wp_enqueue_scripts', 'median_enqueue' );

/**
 * Customize the excerpt "More" text.
 *
 * @since  1.0.0
 * @filter excerpt_more
 *
 * @return string The new "More" string.
 */
function median_excerpt_more() {
	return '&hellip;';
}

add_filter( 'excerpt_more', 'median_excerpt_more' );

/**
 * Customize the excerpt length.
 *
 * @since  1.0.0
 * @filter excerpt_length
 *
 * @return int The new excerpt length.
 */
function median_excerpt_length() {
	return 40;
}

add_filter( 'excerpt_length', 'median_excerpt_length', 99 );
