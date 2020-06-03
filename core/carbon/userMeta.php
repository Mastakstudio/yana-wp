<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_user_settings');
function crb_user_settings()
{
    Container::make_user_meta("user_meta", "Доступное информация")
        ->add_fields(
            [
	            Field::make_text(PREFIX."second_name", "Отчество")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
	            Field::make_text(PREFIX."passport_series", "Серия паспорта")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
	            Field::make_text(PREFIX."passport_number", "Номер паспорта")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
	            Field::make_text(PREFIX."passport_when", "Когда выдан")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
	            Field::make_text(PREFIX."passport_who", "Кем выдан")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
	            Field::make_text(PREFIX."birthday", "Дата рождения")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value("")
            ]
        );

}