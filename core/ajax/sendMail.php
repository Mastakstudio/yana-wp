<?php


add_action( 'wp_ajax_sendFormTo', 'sendFormTo' );
add_action( 'wp_ajax_nopriv_sendFormTo', 'sendFormTo' );


function sendFormTo() {
	$formName        = empty( $_POST['formName'] ) ? '' : esc_attr( $_POST['formName'] );
	$formPhoneNumber = empty( $_POST['formPhoneNumber'] ) ? '' : esc_attr( $_POST['formPhoneNumber'] );
	$comment        = empty( $_POST['comment'] ) ? '' : esc_attr( $_POST['comment'] );
	$name    = get_bloginfo( 'name' );


	$email = carbon_get_theme_option( TO_QUESTION_CONTACT_EMAIL );
	$subject = carbon_get_theme_option( PREFIX . 'mail_title' );
	$mail_body = carbon_get_theme_option( PREFIX . 'mail_body' );

	$headers = 'From:' . $name . '<' . $email . '>' . "\r\n";

	$msg       = apply_filters( 'the_content', $mail_body );
	$msg       = str_replace( '{{Имя}}', $formName, $msg );
	$msg       = str_replace( '{{Контактная информация}}', $formPhoneNumber, $msg );
	$msg       = str_replace( '{{Сообщение}}', $comment, $msg );

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