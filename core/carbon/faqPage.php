<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_faq_page_settings');
function crb_faq_page_settings()
{
    Container::make_post_meta("Faq Page Fields")
        ->where('post_template', '=', 'template-faq.php')
	    ->add_fields([
		    Field::make_textarea(PREFIX.'subtitle','Подзаголовок'),
		    Field::make_complex(PREFIX.'questions','Вопросы')
		    ->add_fields('question',[
		    	Field::make_textarea('question_text', 'Вопрос'),
			    Field::make_rich_text('answer_text', 'Ответ')
		    ])->set_collapsed(true)
	    ]);
}