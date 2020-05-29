<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_home_page_settings');
function crb_home_page_settings()
{
    Container::make_post_meta("Home Page Settings")
        ->where('post_template', '=', 'template-homepage.php')
	    ->add_tab("welcome",[
		    Field::make_text(PREFIX.'banner_video_link','Видео «БЕРЕМЕННОСТЬ И РОДЫ»'),
		    Field::make_text(PREFIX.'experts_video_link', 'Видео "МНЕНИЯ ЭКСПЕРТОВ"'),
		    Field::make_complex(PREFIX.'sos_not_alone_links', 'Ссылки на sos-notalone')
		    ->add_fields('card', 'Карточки',[
			    Field::make_image('img_id', 'Иконка'),
			    Field::make_text('title', 'Заголовок'),
			    Field::make_text('link', 'Ссылка')
		    ])
		    ->set_layout('tabbed-vertical')
	    ]);
}