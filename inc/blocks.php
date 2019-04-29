<?php
/**
 * Do Blocks stuff.
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */


/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @since 1.0.0
 */
function median_editor_assets() {
	wp_enqueue_script(
		'median-blocks-js', get_template_directory_uri() . '/js/blocks.js', array(
		'wp-blocks',
		'wp-i18n',
		'wp-element',
		'wp-editor',
	) );
	wp_enqueue_style( 'median-blocks-css', get_template_directory_uri() . '/css/blocks.css', array( 'wp-edit-blocks' ) );
}
add_action( 'enqueue_block_editor_assets', 'median_editor_assets' );
