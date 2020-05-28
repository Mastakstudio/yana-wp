<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_about_page_settings');
function crb_about_page_settings()
{
    Container::make_post_meta("accordion", "Дополнительные поля")
	    ->where('post_template', '=', 'template-delivery.php')
	    ->add_fields([
		    Field::make_complex(PREFIX.'accordion', 'Аккордеон')
		         ->add_fields('element', 'Элемент', [
			         Field::make_text('title', 'Заголовок'),
			         Field::make_rich_text('content', 'Контетн'),
		         ]),
	    ]);
}