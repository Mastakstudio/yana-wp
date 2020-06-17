<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_experts_page_settings');
function crb_experts_page_settings()
{
    Container::make_post_meta("Experts Page Fields")
        ->where('post_template', '=', 'template-experts.php')
	    ->add_fields([
		    Field::make_textarea(PREFIX.'subtitle','Подзаголовок'),
		    Field::make_text(PREFIX.'video','Ссылка на видео'),
		    Field::make_complex(PREFIX.'experts','Эксперты')
		    ->add_fields('expert',[
		    	Field::make_image('photo_id', 'Фото'),
			    Field::make_text('name', 'Имя'),
			    Field::make_text('specialization', 'Специализация')
		    ])->set_collapsed(true)
	    ]);
}