<?php
/**
 * AMP-Enabled Footer elements.
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

// Scroll To Top Button.
// @todo a11y the buttons.

?>

<?php // The Scroll to Top Button markup.  ?>
<button id="scroll-to-button" on="tap:scroll-to-marker.scrollTo(duration=200)" class="trigger-button trigger-button--scroll-to">
	<i class="fas fa-chevron-up"></i></button>

<?php // Show the Button. ?>
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

<?php // Hide the Button. ?>
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
