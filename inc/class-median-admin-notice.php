<?php
/**
 * AMP Plugin recommendation admin notification
 *
 * Based on the "Persist Admin Notices Dismissal" plugin by Collins Agbonghama.
 *
 * @link    https://github.com/collizo4sky/persist-admin-notices-dismissal
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

/**
 * Class Median_Admin_Notice
 *
 * @package Median
 * @since   1.0.0
 */
class Median_Admin_Notice {

	/**
	 * The feature name, used as a label throughout.
	 */
	const FEATURE_NAME = 'median-notice';

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue' ) );
		add_action( 'wp_ajax_median_admin_notice', array( __CLASS__, 'dismiss_admin_notice' ) );
		add_action( 'admin_notices', array( __CLASS__, 'maybe_render_admin_notice' ) );
	}

	/**
	 * Render the Admin Notice if not dismissed.
	 *
	 * @since  1.0.0
	 * @action admin_notices
	 *
	 * @return void
	 */
	public static function maybe_render_admin_notice() {
		if ( true !== self::is_admin_notice_active() ) {
			return;
		}
		?>
		<div id="median-notice" class="notice notice-warning is-dismissible">
			<p>
				<?php echo wp_kses_post( sprintf(
					// translators: The URL to the AMP Plugin.
					__( 'You\'re missing out on features for the Median theme.  Install the <a href="%s">AMP plugin</a> to get them all!', 'median' ),
					'https://wordpress.org/plugins/amp/'
				) ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Enqueue javascript and variables.
	 *
	 * @since  1.0.0
	 * @action admin_enqueue_scripts
	 */
	public static function enqueue() {
		if ( is_customize_preview() ) {
			return;
		}

		wp_register_script( self::FEATURE_NAME, get_stylesheet_directory_uri() . '/js/admin.min.js', array(
			'jquery',
			'common',
		) );

		wp_localize_script(
			self::FEATURE_NAME,
			'medianNotice',
			array(
				'nonce'  => wp_create_nonce( self::FEATURE_NAME ),
				'action' => 'median_admin_notice',
			)
		);

		wp_enqueue_script( self::FEATURE_NAME );
	}

	/**
	 * Handle Ajax request to dismiss the notice.
	 *
	 * @since 1.0.0
	 * @action wp_ajax_median_admin_notice
	 *
	 * @uses  check_ajax_referer
	 */
	public static function dismiss_admin_notice() {
		check_ajax_referer( self::FEATURE_NAME, 'nonce' );
		update_option( self::FEATURE_NAME, 1 );
		wp_die();
	}

	/**
	 * Check if the Admin Notice is active.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public static function is_admin_notice_active() {
		return ( empty( get_option( self::FEATURE_NAME ) ) && true !== median_amp_is_active() );
	}
}
