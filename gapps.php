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
	echo '<input type="text" name="forsale-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["forsale-name"] ) ? esc_attr( $_POST["forsale-name"] ) : '' ) . '" size="40" required />';
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
	echo 'Property Info <br/>';
	echo '<textarea rows="10" cols="35" name="forsale-propinfo">' . ( isset( $_POST["forsale-propinfo"] ) ? esc_attr( $_POST["forsale-propinfo"] ) : '' ) . '</textarea>';
	echo '</p>';

	echo '<p>';
	echo 'Estimation Value <br/>';
	echo '<input type="text" name="forsale-value" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["forsale-value"] ) ? esc_attr( $_POST["forsale-value"] ) : '' ) . '" size="30" />';
	echo '</p>';

	echo '<p>';
	echo 'Asking Price <br/>';
	echo '<input type="text" name="forsale-price" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["forsale-price"] ) ? esc_attr( $_POST["forsale-price"] ) : '' ) . '" size="10" />';
	echo '</p>';


	echo '<p>';
	echo 'Notes <br/>';
	echo '<textarea rows="10" cols="35" name="forsale-notes">' . ( isset( $_POST["forsale-notes"] ) ? esc_attr( $_POST["forsale-notes"] ) : '' ) . '</textarea>';
	echo '</p>';

	echo '<p><input type="submit" name="forsale-submitted" value="Send"></p>';
	echo '</form>';
}

function insert_db() {

	echo 'Insert Section!';

	// if the submit button is clicked, send the email
	if ( isset( $_POST['forsale-submitted'] ) ) {

		// sanitize form values
		$name    = sanitize_text_field( $_POST["forsale-name"] );
		$phone    = sanitize_text_field( $_POST["forsale-phone"] );
		$email   = sanitize_email( $_POST["forsale-email"] );
		$propinfo = esc_textarea( $_POST["forsale-propinfo"] );
		$marketvalue = sanitize_text_field( $_POST["forsale-value"] );
		$price = sanitize_text_field( $_POST["forsale-price"] );
		$notes = esc_textarea( $_POST["forsale-notes"] );

		$now = 'now()';

		//insert to db
		global $wpdb;

		$wpdb->insert( 
			'forsale', 
			array( 
				'name' => $name, 
				'phone' => $phone,
				'email' => $email,
				'propinfo' => $propinfo,
				'marketvalue' => $marketvalue,
				'price' => $price,
				'notes' => $notes,
				'date_create' => $now
			 ), 
			array( 
				'%s', 
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			) 
		);

/*
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
		}*/
	}
}

function forsale_shortcode() {
	ob_start();
	insert_db();
	forsale_form();

	return ob_get_clean();
}

add_shortcode( 'gapps_forsale_form', 'forsale_shortcode' );

?>