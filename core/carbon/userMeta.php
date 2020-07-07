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
	            Field::make_text(U_SECOND_NAME, "Отчество")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
                Field::make_text(U_CERTIFICATE_FIRST_NAME, "Имя для сертификата")
//                    ->set_attribute( 'readOnly', 'readOnly' )
                    ->set_default_value(""),
                Field::make_text(U_CERTIFICATE_LAST_NAME, "Фамилия для сертификата")
//                    ->set_attribute( 'readOnly', 'readOnly' )
                    ->set_default_value(""),
	            Field::make_text(U_PASSPORT_SERIES, "Серия паспорта")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
	            Field::make_text(U_PASSPORT_NUMBER, "Номер паспорта")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
	            Field::make_text(U_PASSPORT_WHEN, "Когда выдан")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
	            Field::make_text(U_PASSPORT_WHO, "Кем выдан")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value(""),
	            Field::make_text(U_BIRTHDAY, "Дата рождения")
	                 ->set_attribute( 'readOnly', 'readOnly' )
	                 ->set_default_value("")
            ]
        );

}