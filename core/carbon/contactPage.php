<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_contact_page_settings');
function crb_contact_page_settings()
{
    Container::make_post_meta("Contacts Page Settings")
        ->where('post_template', '=', 'template-contacts.php')
        ->add_fields( [
	        Field::make_textarea(PREFIX.'subtitle', 'Subtitle')->set_rows(3)
        ]);
}