<?php

if (!defined('ABSPATH')) exit();

function home_page_banner_video(){
	$link = carbon_get_post_meta(get_the_ID(), PREFIX.'banner_video_link');

	return (object)[
		'link_exist' => isset($link) && !empty($link),
		'link' => $link
	];
}
function home_page_experts_video(){
	$link = carbon_get_post_meta(get_the_ID(), PREFIX.'experts_video_link');

	return (object)[
		'link_exist' => isset($link) && !empty($link),
		'link' => $link
	];
}

function home_page_services(){
	$links = carbon_get_theme_option(PREFIX.'sos_not_alone_links');

	return (object)[
		'link_exist' => isset($links) && !empty($links),
		'links' => $links
	];
}

function home_page_partners(){
	$links = carbon_get_theme_option( PREFIX.'partners');

	return (object)[
		'link_exist' => isset($links) && !empty($links),
		'links' => $links
	];
}

/**
 * @param int    $user_id    User ID.
 * @param null   $deprecated Not used (argument deprecated).
 * @param string $notify     Optional. Type of notification that should happen. Accepts 'admin' or an empty
 *                           string (admin only), 'user', or 'both' (admin and user). Default empty.
 */
function custom_wp_new_user_notification( $user_id, $deprecated = null, $notify = 'both' ) {
	if ( $deprecated !== null ) {
		_deprecated_argument( __FUNCTION__, '4.3.1' );
	}

	// Accepts only 'user', 'admin' , 'both' or default '' as $notify
	if ( ! in_array( $notify, array( 'user', 'admin', 'both', '' ), true ) ) {
		return;
	}

	$user = get_userdata( $user_id );

	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
	// we want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

	if ( 'user' !== $notify ) {
		$switched_locale = switch_to_locale( get_locale() );

		/* translators: %s: Site title. */
		$message = sprintf( __( 'New user registration on your site %s:' ), $blogname ) . "\r\n\r\n";
		/* translators: %s: User login. */
		$message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
		/* translators: %s: User email address. */
		$message .= sprintf( __( 'Email: %s' ), $user->user_email ) . "\r\n";

		$wp_new_user_notification_email_admin = array(
			'to'      => get_option( 'admin_email' ),
			/* translators: New user registration notification email subject. %s: Site title. */
			'subject' => __( '[%s] New User Registration' ),
			'message' => $message,
			'headers' => '',
		);

		/**
		 * Filters the contents of the new user notification email sent to the site admin.
		 * @param array   $wp_new_user_notification_email_admin {
		 *     Used to build wp_mail().
		 *
		 *     @type string $to      The intended recipient - site admin email address.
		 *     @type string $subject The subject of the email.
		 *     @type string $message The body of the email.
		 *     @type string $headers The headers of the email.
		 * }
		 * @param WP_User $user     User object for new user.
		 * @param string  $blogname The site title.
		 */
		$wp_new_user_notification_email_admin = apply_filters( 'wp_new_user_notification_email_admin', $wp_new_user_notification_email_admin, $user, $blogname );

		wp_mail(
			$wp_new_user_notification_email_admin['to'],
			wp_specialchars_decode( sprintf( $wp_new_user_notification_email_admin['subject'], $blogname ) ),
			$wp_new_user_notification_email_admin['message'],
			$wp_new_user_notification_email_admin['headers']
		);

		if ( $switched_locale ) {
			restore_previous_locale();
		}
	}

	// `$deprecated was pre-4.3 `$plaintext_pass`. An empty `$plaintext_pass` didn't sent a user notification.
	if ( 'admin' === $notify || ( empty( $deprecated ) && empty( $notify ) ) ) {
		return;
	}

	$switched_locale = switch_to_locale( get_user_locale( $user ) );

	/* translators: %s: User login. */
	$message = 'Вы зарегистрировались на сайте '. $blogname . "\r\n\r\n";
	$message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";


	$wp_new_user_notification_email = array(
		'to'      => $user->user_email,
		/* translators: Login details notification email subject. %s: Site title. */
		'subject' => __( 'Уведомление от %s' ),
		'message' => $message,
		'headers' => '',
	);

	wp_mail(
		$wp_new_user_notification_email['to'],
		wp_specialchars_decode( sprintf( $wp_new_user_notification_email['subject'], $blogname ) ),
		$wp_new_user_notification_email['message'],
		$wp_new_user_notification_email['headers']
	);

	if ( $switched_locale ) {
		restore_previous_locale();
	}
}