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
include get_stylesheet_directory() . '/inc/class-median-admin-notice.php';
// include get_stylesheet_directory() . '/inc/class-median-amp.php';
include get_stylesheet_directory() . '/inc/class-median-menu-walker.php';

/**
 * Initialize the theme.
 *
 * @since 1.0.0
 * @action after_setup_theme.
 */
function median_init() {
	add_theme_support( 'menus' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Define the languages directory.
	load_theme_textdomain( 'median', get_template_directory() . '/languages' );

	// Register the navigation menus.
	register_nav_menus( array(
		'header' => __( 'Header Menu', 'median' ),
		'footer' => __( 'Footer Menu', 'median' ),
	) );

	// Initialize the AMP Plugin Admin Notice feature.
	Median_Admin_Notice::init();
}
add_action( 'after_setup_theme', 'median_init' );

/**
 * Enqueue scripts.
 *
 * @since 1.0.0
 * @action wp_enqueue_scripts
 */
function median_enqueue() {
	// Register and Enqueue Google Fonts.
	wp_register_style( 'median-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Martel:400,500,700' );
	wp_enqueue_style( 'median-google-fonts' );

	// Register Bootstrap Reset and Grid.
	wp_register_style( 'median-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), filemtime( get_stylesheet_directory_uri() . '/css/bootstrap.min.css' ) );

	// Register and Enqueue Theme styles.
	wp_register_style( 'median-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array( 'median-bootstrap' ), filemtime( get_stylesheet_directory_uri() . '/css/theme.min.css' ) );
	wp_enqueue_style( 'median-styles' );


}
add_action( 'wp_enqueue_scripts', 'median_enqueue' );

function median_enqueue_admin() {
	if ( is_customize_preview() ) {
		return;
	}

	// Register and Enqueue the Admin script.
	wp_register_script( 'median-admin', get_stylesheet_directory_uri() . '/js/admin.min.js', array( 'jquery', 'common' ), filemtime( get_stylesheet_directory_uri() . '/js/admin.min.js' ) );
	wp_enqueue_script( 'median-admin' );
	wp_localize_script(
		'median-admin',
		'notice',
		array(
			'nonce' => wp_create_nonce( 'dismissible-notice' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'median_enqueue_admin' );


/**
 * Register sidebars.
 *
 * @since 1.0.0
 * @action widgets_init
 */
function median_register_sidebars() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'median' ),
		'id'            => 'primary-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
