<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_business_page_settings');
function crb_business_page_settings()
{
    Container::make_post_meta("Settings")
        ->where('post_template', '=', 'template-businnes.php')
        ->add_fields( [
	        Field::make_textarea(PREFIX.'subtitle', 'Заголовок')->set_rows(3),
	        Field::make_complex(PREFIX.'offers', 'offers')
	             ->add_fields('offer',
		             [
			             Field::make_textarea('text', 'text')->set_rows(2),
		             ])
	             ->set_max(3)
	             ->set_layout('tabbed-horizontal'),
	        Field::make_complex(PREFIX.'benefits', 'Benefits')
	             ->add_fields('benefit',
		             [
			             Field::make_textarea('text', 'text')->set_rows(2),
			             Field::make_image('img_id', 'Image')
		             ])
	             ->set_max(3)
	             ->set_layout('tabbed-horizontal'),
        ]);
}