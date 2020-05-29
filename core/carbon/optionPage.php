<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
    Container::make_theme_options( 'theme_settings','Настройки темы')
        ->set_page_file('theme-options')
        ->set_page_menu_title('Theme Settings')
        ->set_icon('dashicons-admin-generic')
        ->add_tab(__('Main options'), [
            Field::make_image(PREFIX . 'main_logo', 'Logo'),
	        Field::make_separator('contact_order_mail', 'Email для заказа звонка'),
	        Field::make_separator('contact_info_separator', 'Контакты'),
	        Field::make_text(PREFIX . 'phone_number', 'Phone')->set_width(50),
	        Field::make_text(PREFIX . 'contact_email', 'Email')->set_width(50),
	        Field::make_text(PREFIX . 'viber_number', 'Viber')->set_width(50),
	        Field::make_text(PREFIX . 'whatsapp_number', 'whatsapp')->set_width(50),
	        Field::make_text(PREFIX . 'instagram_link', 'Instagram'),
	        Field::make_text(PREFIX . 'address', 'Адресс'),
        ])
        ->add_tab(__('email'), [
	        Field::make_text(PREFIX . 'order_contact_email', 'Email для получения писем'),
	        Field::make_checkbox(PREFIX . 'auto_send_mail', 'Автоматичеси отчечать на запрс презинтации'),
	        Field::make_text(PREFIX . 'mail_title', 'Заголовок письма'),
	        Field::make_rich_text(PREFIX . 'mail_body', 'Содиржание письма')
	             ->help_text("{{client_name}} - имя из формы, {{client_phone}} - телефон из формы, {{client_email}} - email из формы, {{client_city}}- город из формы"),
	        Field::make_complex(PREFIX.'attached_files', 'Прикреплённые файлы')
	        ->add_fields([
	        	Field::make_file('file')
	        ])->set_layout('tabbed-horizontal')

        ])
        ->add_tab(' partners', [
		    Field::make_complex(PREFIX.'partners', 'Партнёры')
		         ->add_fields('card', 'Карточки',[
			         Field::make_image('img_id', 'Иконка'),
			         Field::make_text('title', 'Заголовок'),
			         Field::make_text('link', 'Ссылка')
		         ])
		         ->set_layout('tabbed-vertical')
	    ]);
}
