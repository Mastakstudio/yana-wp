<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_about_post_meta_settings');
function crb_about_post_meta_settings()
{
    Container::make_post_meta("Meta Settings")
        ->where('post_type', '=', 'page')
        ->add_fields([
            Field::make_image(PREFIX.'second_img_id', 'Second image')
        ]);
}