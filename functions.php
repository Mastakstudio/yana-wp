<?php
if (!defined('ABSPATH')) exit();

define('PREFIX', 'yana_');
define('THEME_NAME', get_template());
define('BASE_URL', '/wp-content/themes/' . THEME_NAME);

require_once __DIR__ . '/utils/Assets.php';

$falconGlen = (object)[
    'main' => require 'core/class-yana.php'
];

require 'core/functions/functions.php';
//require 'core/ajax/getPosts.php';
//require 'inc/storefront-template-hooks.php';
//require 'inc/storefront-template-functions.php';
//require 'core/wordpress-shims.php';




if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/core/carbon/index.php';
    require_once __DIR__ . '/vendor/autoload.php';
}

//function wpse_lost_password_redirect() {
//    wp_redirect( home_url('#login-button') );
//    exit;
//}
//add_action('woocommerce_customer_reset_password', 'wpse_lost_password_redirect');
//
//function redirect_after_save_address(){
//    wp_redirect( get_permalink(wc_get_page_id("myaccount")) );
//    exit;
//}
//add_action('woocommerce_customer_save_address', 'redirect_after_save_address');