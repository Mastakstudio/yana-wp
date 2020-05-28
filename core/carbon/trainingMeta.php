<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_education_settings');
function crb_education_settings()
{
	$delivery_items_labels = array(
		'plural_name' => 'Delivery items',
		'singular_name' => 'Delivery item',
	);
	
    Container::make_post_meta("meta_blocks", "Блоки")
        ->where('post_type', '=', 'training')
	    ->add_tab('contents', [
		    Field::make_complex("blocks", "Блоки")
		         ->add_fields('base',"Базовый",[
			         Field::make_rich_text("title", "Заголовок")
			         ->set_default_value('Базовый курс'),
			         Field::make_rich_text("content", "Контент")
		         ])
		         ->add_fields('advanced',"Продвинутый",[
			         Field::make_rich_text("title", "Заголовок")
			              ->set_default_value('Продвинутый курс'),
			         Field::make_rich_text("content", "Контент")
		         ])
		         ->add_fields('business_partner',"Бизнес-партнер",[
			         Field::make_rich_text("title", "Заголовок")
			              ->set_default_value('Бизнес-партнер'),
			         Field::make_rich_text("content", "Контент")
		         ])
		         ->set_duplicate_groups_allowed( false )
		         ->set_collapsed( true )
	    ])
        ->add_tab('users',
            [
            	Field::make_complex(PREFIX.'users', 'Пользователи' )
		            ->add_fields('user',[
			            Field::make_select('user_id', 'Пользователь')
			                 ->set_options('users_list')
			                 ->set_width(40),
			            Field::make_multiselect('access_lvl', 'Уровень доступа')
			                 ->add_options([
				                 'base' => 'Базовый',
				                 'advanced' => 'Продвинутый',
				                 'business_partner' => 'Бизнес-партнер',
			                 ] )
			                 ->set_width(60)
		            ])
//	                 ->add_fields('available_trainings',[
//		                 Field::make_select('training_id', 'Тренинг')
//		                 ->set_options('training_selecting'),
//		                 Field::make_multiselect('access_lvl', 'Уровень доступа')
//			                 ->add_options([
//			                 	'base' => 'Базовый',
//			                    'advanced' => 'Продвинутый',
//			                    'business_partner' => 'Бизнес-партнер',
//			                 ] )
//	                 ])
            ]
        );
	 
}