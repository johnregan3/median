<?php
/**
 * Footer Template File
 *
 * @package Median
 * @since   1.0.0
 * @author  Fervor Marketing <dev@createfervor.com>
 */
?>

<?php // Scroll To Top Button. ?>
<button id="scroll-to-button" on="tap:top-page.scrollTo(duration=200)" class="trigger-button trigger-button--scroll-to"><i class="fas fa-chevron-up"></i></button>
<?php // Show the button. ?>
<amp-animation id="showScrollTrigger" layout="nodisplay">
	<script type="application/json">
		{
			"duration": "200ms",
			"fill": "both",
			"iterations": "1",
			"direction": "alternate",
			"animations": [
				{
					"selector": "#scroll-to-button",
					"keyframes": [
						{
							"opacity": "1",
							"visibility": "visible"
						}
					]
				}
			]
		}
	</script>
</amp-animation>
<?php // Hide the button. ?>
<amp-animation id="hideScrollTrigger" layout="nodisplay">
	<script type="application/json">
		{
			"duration": "200ms",
			"fill": "both",
			"iterations": "1",
			"direction": "alternate",
			"animations": [
				{
					"selector": "#scroll-to-button",
					"keyframes": [
						{
							"opacity": "0",
							"visibility": "hidden"
						}
					]
				}
			]
		}
	</script>
</amp-animation>

<?php // Primary Menu Button. Don't move this. The menu overlay styles depend on this being the last item in the body. ?>
<?php if ( has_nav_menu( 'primary' ) ) : ?>
<button on="tap:primary-menu.toggle" class="trigger-button trigger-button--menu"><i class="fas fa-bars"></i></button>
<?php endif; ?>

<?php wp_footer(); ?>

</body>

</html>
