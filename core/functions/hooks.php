<?php

if (!defined('ABSPATH')) exit();

remove_action( 'register_new_user', 'wp_send_new_user_notifications' );
add_action( 'register_new_user', 'custom_wp_new_user_notification' );