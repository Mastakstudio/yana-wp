<?php

if (!defined('ABSPATH')) exit();

remove_action( 'register_new_user', 'wp_send_new_user_notifications' );