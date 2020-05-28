<?php
add_filter( 'wp_mail_content_type', 'set_html_content_type' );
function set_html_content_type() {
	return "text/html";
}

add_action( 'wp_ajax_sendFormTo', 'sendFormTo' );
add_action( 'wp_ajax_nopriv_sendFormTo', 'sendFormTo' );


function sendFormTo() {
	$formName        = empty( $_POST['formName'] ) ? '' : esc_attr( $_POST['formName'] );
	$formPhoneNumber = empty( $_POST['formPhoneNumber'] ) ? '' : esc_attr( $_POST['formPhoneNumber'] );
	$formCity        = empty( $_POST['formCity'] ) ? '' : esc_attr( $_POST['formCity'] );
	$formEmail       = empty( $_POST['formEmail'] ) ? '' : esc_attr( $_POST['formEmail'] );
	$getInfo         = empty( $_POST['getInfo'] ) ? '' : esc_attr( $_POST['getInfo'] );
	$name    = get_bloginfo( 'name' );


	$email = carbon_get_theme_option( PREFIX . 'order_contact_email' );
	if ( $getInfo ) {
		$auto_send_mail = carbon_get_theme_option( PREFIX . 'auto_send_mail' );
		if ( $auto_send_mail ) {
			getWhitheethInfo( $email, $formEmail, $formName, $formPhoneNumber, $formCity );
		}
	}
	$headers = 'From:' . $name . '<' . $email . '>' . "\r\n";

	$msg = "<p><strong>Имя: </strong><span>" . $formName . "</span></p>
			<p><strong>Телефон: </strong><span>" . $formPhoneNumber . "</span></p>
			<p><strong>Город: </strong><span>" . $formCity . "</span></p>";

	if ( ! empty( $getInfo ) ) {
		$msg     .= "<p><strong>Email: </strong><span>" . $formEmail . "</span></p>";
		$subject = $formName . '(получить презинтацию) ';
	} else {
		$subject = 'Заказ звонка от ' . $formName . '"';
	}


	if ( wp_mail( $email, $subject, $msg, $headers ) ) {
		$response['text']   = 'сообщение отправлено';
		$response['status'] = 1;
	} else {
		$response['text']   = 'ошибка при отправке';
		$response['status'] = 0;
	}

	echo json_encode( $response, JSON_UNESCAPED_UNICODE );
	wp_die();
}

function getWhitheethInfo( $from, $to, $formName, $formPhoneNumber, $formCity ) {
	$name    = get_bloginfo( 'name' );
	$headers = 'From:' . $name . '<' . $from . '>' . "\r\n";
	$subject = carbon_get_theme_option( PREFIX . 'mail_title' );

	$mail_body = carbon_get_theme_option( PREFIX . 'mail_body' );
	$msg       = apply_filters( 'the_content', $mail_body );
	$msg       = str_replace( '{{client_name}}', $formName, $msg );
	$msg       = str_replace( '{{client_phone}}', $formPhoneNumber, $msg );
	$msg       = str_replace( '{{client_email}}', $to, $msg );
	$msg       = str_replace( '{{client_city}}', $formCity, $msg );

	$attached_files = carbon_get_theme_option( PREFIX . 'attached_files' );
	$attached       = [];
	foreach ( $attached_files as $file ) {
		$attached[] = wp_get_attachment_url( $file['file'] );
	}

	return wp_mail( $to, $subject, $msg, $headers, $attached );
}