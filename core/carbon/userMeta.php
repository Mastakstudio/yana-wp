<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_user_settings');
function crb_user_settings()
{
    Container::make_post_meta("available_educations", "Доступное обучение")
        ->where('post_type', '=', 'training')
        ->add_fields(
            [
                Field::make_complex("blocks", "Блоки")
                    ->add_fields('base',"Базовый",[
                        Field::make_rich_text("content", "Контент")
                    ])
                    ->add_fields('advanced',"Продвинутый",[
                        Field::make_rich_text("content", "Контент")
                    ])
                    ->add_fields('business_partner',"Бизнес-партнер",[
                        Field::make_rich_text("content", "Контент")
                    ])
                    ->set_duplicate_groups_allowed( false )
                    ->set_collapsed( true )
            ]
        );

}