<?php

add_action( 'wp_ajax_amp_contact_form', 'median_process_contact_form' );
add_action( 'wp_ajax_nopriv_amp_contact_form', 'median_process_contact_form' );

function median_process_contact_form() {
	if ( ! empty( $_POST ) ) { // PHPCS: Input var okay.
		header( 'access-control-allow-credentials:true' );
		header( 'access-control-allow-headers:Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token' );
		header( 'access-control-allow-methods:POST, GET, OPTIONS' );
		header( 'access-control-allow-origin:' . $_SERVER['HTTP_ORIGIN'] ); // PHPCS: input var okay.
		header( 'access-control-expose-headers:AMP-Access-Control-Allow-Source-Origin' );
		header( 'amp-access-control-allow-source-origin:' . $_SERVER['HTTP_ORIGIN'] ); // PHPCS: input var okay.

		if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'mx_val' ) || ! empty( $_POST['phone'] ) ) { // PHPCS: input var okay.
			header( 'HTTP/1.0 401 Unauthorized', true, 401 );

			echo wp_json_encode( array( 'message' => 'This method of submitting the form is unauthorized.' ) );
			die();
		}

		$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : ''; // PHPCS: input var okay.
		$email   = isset( $_POST['email'] ) ? sanitize_text_field( wp_unslash( $_POST['email'] ) ) : ''; // PHPCS: input var okay.
		$comment = isset( $_POST['comment'] ) ? sanitize_text_field( wp_unslash( $_POST['comment'] ) ) : ''; // PHPCS: input var okay.
		$post_id = isset( $_POST['post-id'] ) ? sanitize_text_field( wp_unslash( $_POST['post-id'] ) ) : 0; // PHPCS: input var okay.

		if ( empty( $name ) || empty( $email ) || empty( $comment ) ) {
			header( 'HTTP/1.0 412 Precondition Failed', true, 412 );

			echo wp_json_encode( array( 'message' => 'Please complete all form fields. Thanks!' ) );
			die();
		}

		$message = 'From: ' . $name . ' (' . $email . ' )
Post: ' . get_the_title( $post_id ) . '
' . get_permalink( $post_id ) . '
' . $comment;

		$result = wp_mail( 'john.m.regan@gmail.com', 'John, here is New Message from Mixing Metaphors Website', $message );

		if ( ! empty( $result ) ) {
			header( 'Content-Type: application/json' );
			echo wp_json_encode( array( 'message' => 'Thank you for your thoughts, ' . $name . '. Your message has been successfully sent!' ) );
		} else {
			echo wp_json_encode( array( 'message' => 'An unknown error occurred.  Please try again. Sorry!' ) );
		}
		die();
	}
}
