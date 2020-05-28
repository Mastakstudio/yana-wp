<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_buyers_page_settings');
function crb_buyers_page_settings()
{
    Container::make_post_meta("Buyers Page Settings")
        ->where('post_template', '=', 'template-buyers.php')
	    ->add_fields([
	    	Field::make_complex(PREFIX.'slider', 'Slider' )
			    ->add_fields('slide',[
			    	Field::make_image('img_id', 'Slide Image')
			    	])
			    ->set_layout('tabbed-horizontal'),
		    Field::make_separator(PREFIX.'sep_card_after_content','Card after content'),
		    Field::make_checkbox(PREFIX.'display_card', 'Display card'),
		    Field::make_text(PREFIX.'card_title', 'Title'),
		    Field::make_textarea(PREFIX.'card_content','Content'),
		    Field::make_checkbox(PREFIX.'display_theme_contact', 'Display contact info from theme settings')->set_default_value(false),
		    Field::make_text(PREFIX.'card_phone', 'Phone number'),
		    Field::make_text(PREFIX.'card_email', 'Email'),
	    ]);
}