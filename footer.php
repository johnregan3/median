<?php
/**
 * Footer Template File
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */
?>

<?php if ( true === median_amp_is_active() ) : ?>
	<?php get_template_part( 'template-parts/footer', 'amp' ); ?>
<?php endif; ?>

<?php wp_footer(); ?>

</body>

</html>
