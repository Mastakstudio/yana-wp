<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_home_page_settings');
function crb_home_page_settings()
{
    Container::make_post_meta("Home Page Settings")
        ->where('post_template', '=', 'template-homepage.php')
        ->add_fields([
	        Field::make_textarea(THEME_NAME.'_desc', 'Текст перед видео'),
        ]);
}

add_action('carbon_fields_post_meta_container_saved','test_hook', 20, 2);
function test_hook(){
	$aaaa = 'aaaa';
}