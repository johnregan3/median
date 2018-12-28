<?php
/**
 * Helper Functions
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

/**
 * Check if the AMP Plugin is active.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function median_amp_is_active() {
	if ( is_admin() && is_plugin_active( 'amp/amp.php' ) ) {
		return true;
	} elseif ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
		return true;
	}
	return false;
}
