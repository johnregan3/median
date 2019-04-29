<?php
/**
 * Contact Form Template Part
 *
 * @package Median
 * @since   1.0.0
 * @author  John Regan <john@johnregan3.com>
 */

?>
<form class="comment-form" method="post" action-xhr="<?php echo esc_url( admin_url( 'admin-ajax.php?action=amp_contact_form' ) ); ?>" target="_top">
	<p style="font-weight: 300">Instead of a comments section, I prefer direct messages to me.  Please send me your thoughts and I'll get back to you soon.</p>
	<input type="text" name="name" placeholder="Name">
	<input type="email" name="email" placeholder="Email">
	<input type="tel" name="phone" placeholder="Don't fill this out.">
	<textarea name="comment"></textarea>
	<input type="hidden" name="post-id" value="<?php the_ID(); ?>">
	<?php wp_nonce_field( 'mx_val', 'security' ); ?>
	<input type="submit" value="Send">
	<div submit-success>
		<template type="amp-mustache">
			<p>{{message}}</p>
		</template>
	</div>
	<div submit-error>
		<template type="amp-mustache">
			{{#verifyErrors}}
				<p>{{message}}</p>
			{{/verifyErrors}}
			{{^verifyErrors}}
				<p>Error Message:</p>
				<p>{{message}}</p>
			{{/verifyErrors}}
			<p>Submission failed</p>
		</template>
	</div>
</form>

