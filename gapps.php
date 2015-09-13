<?php
/*
Plugin Name: Gohartanah Apps (GAPPS)
Plugin URI: http://gapps.gohartanah.com
Description: Plugin for gohartanah.com 
Version: 1.0
Author: Mister Ijoi
Author URI: http://www.gohartanah.com
*/

function forsale_form() {
	echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
	echo '<p>';
	echo ' Name (required) <br/>';
	echo '<input type="text" name="forsale-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["forsale-name"] ) ? esc_attr( $_POST["forsale-name"] ) : '' ) . '" size="40" />';
	echo '</p>';

	echo '<p>';
	echo ' Phone (required) <br/>';
	echo '<input type="text" name="forsale-phone" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["forsale-phone"] ) ? esc_attr( $_POST["forsale-phone"] ) : '' ) . '" size="20" />';
	echo '</p>';
	

	echo '<p>';
	echo 'Your Email (required) <br/>';
	echo '<input type="email" name="forsale-email" value="' . ( isset( $_POST["forsale-email"] ) ? esc_attr( $_POST["forsale-email"] ) : '' ) . '" size="40" />';
	echo '</p>';

	echo '<p>';
	echo 'Property Detail <br/>';
	echo '<textarea rows="10" cols="35" name="forsale-propdetail">' . ( isset( $_POST["forsale-propdetail"] ) ? esc_attr( $_POST["forsale-propdetail"] ) : '' ) . '</textarea>';
	echo '</p>';

	echo '<p>';
	echo 'Estimation Value <br/>';
	echo '<input type="text" name="forsale-value" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["forsale-value"] ) ? esc_attr( $_POST["forsale-value"] ) : '' ) . '" size="10" />';
	echo '</p>';

	echo '<p>';
	echo 'Asking Price <br/>';
	echo '<input type="text" name="forsale-price" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["forsale-price"] ) ? esc_attr( $_POST["forsale-price"] ) : '' ) . '" size="10" />';
	echo '</p>';


	echo '<p>';
	echo 'Notes <br/>';
	echo '<textarea rows="10" cols="35" name="forsale-notes">' . ( isset( $_POST["forsale-notes"] ) ? esc_attr( $_POST["forsale-notes"] ) : '' ) . '</textarea>';
	echo '</p>';

	echo '<p><input type="submit" name="forsale-submitted" value="Send"></p>';
	echo '</form>';
}

/*function deliver_mail() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['forsale-submitted'] ) ) {

		// sanitize form values
		$name    = sanitize_text_field( $_POST["forsale-name"] );
		$email   = sanitize_email( $_POST["forsale-email"] );
		$subject = sanitize_text_field( $_POST["forsale-subject"] );
		$message = esc_textarea( $_POST["forsale-message"] );

		// get the blog administrator's email address
		$to = get_option( 'admin_email' );

		$headers = "From: $name <$email>" . "\r\n";

		// If email has been process for sending, display a success message
		if ( wp_mail( $to, $subject, $message, $headers ) ) {
			echo '<div>';
			echo '<p>Thanks for contacting me, expect a response soon.</p>';
			echo '</div>';
		} else {
			echo 'An unexpected error occurred';
		}
	}
}*/

function forsale_shortcode() {
	ob_start();
	//deliver_mail();
	forsale_form();

	return ob_get_clean();
}

add_shortcode( 'gapps_forsale_form', 'forsale_shortcode' );

?>