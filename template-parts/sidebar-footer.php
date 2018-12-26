<?php
/**
 * Footer sidebar
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>

<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
	<div class="row sidebar__footer">
		<div class="container">
			<div class="row">
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
