<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
    $themeSettings = Container::make_theme_options( 'theme_settings','Настройки темы')
        ->set_page_file('theme-options')
        ->set_page_menu_title('Настройки темы')
        ->set_icon('dashicons-admin-generic')
        ->add_tab(__('Main options'), [
            Field::make_image(TO_MAIN_LOGO, 'Logo'),
	        Field::make_separator('contact_info_separator', 'Контакты'),
	        Field::make_text(TO_INSTAGRAM_LINK, 'Instagram'),
	        Field::make_text(TO_FACEBOOK_LINK, 'Facebook'),
	        Field::make_text(TO_VK_LINK, 'В контакте'),
	        Field::make_text(TO_YOUTUBE_LINK, 'Youtube'),
	        Field::make_text(TO_SOS_CHILD_VIL, 'SOS Детские деревни'),
        ])
        ->add_tab(__('email'), [
	        Field::make_text(TO_QUESTION_CONTACT_EMAIL, 'Email для получения писем'),
	        Field::make_text(PREFIX . 'mail_title', 'Заголовок письма'),
	        Field::make_rich_text(PREFIX . 'mail_body', 'Содиржание письма')
	        ->help_text('{{Имя}},{{Контактная информация}},{{Сообщение}}'),
        ])
        ->add_tab(' partners', [
		    Field::make_complex(TO_PARTNERS, 'Партнёры')
		         ->add_fields('card', 'Карточки',[
			         Field::make_image('img_id', 'Иконка'),
			         Field::make_text('title', 'Заголовок'),
			         Field::make_text('link', 'Ссылка')
		         ])
		         ->set_layout('tabbed-vertical')
	    ])
        ->add_tab('services',[
		    Field::make_complex(PREFIX.'sos_not_alone_links', 'Ссылки на sos-notalone')
		         ->add_fields('card', 'Карточки',[
			         Field::make_image('img_id', 'Иконка'),
			         Field::make_text('title', 'Заголовок'),
			         Field::make_text('link', 'Ссылка')
		         ])
		         ->set_layout('tabbed-vertical')
    ]);

    Container::make_theme_options('social_settings', 'Авторизация и пользователи')
	    ->set_page_parent($themeSettings)
	    ->add_tab('Страницы',[
	    	Field::make_select(TO_ACCOUNT_PAGE, 'Страница акаунта')
		         ->set_options(page_selecting()),
		    Field::make_select(PREFIX.'signin_page', 'Страница авторизации')
		         ->set_options(page_selecting()),
		    Field::make_select(PREFIX . 'login_page', 'Login Page')
		         ->set_options(page_selecting()),
		    Field::make_select(PREFIX . 'main_course_page', 'Страница курса')
		         ->set_options(course_selecting()),
	    ])
	    ->add_tab('сертификат',[
		    Field::make_complex(PREFIX."certificate_role")
		         ->add_fields( 'item', [
			         Field::make_multiselect('target_roles','Целевая аудитория')
			              ->set_options(get_roles())
			              ->set_required(true),
		         		Field::make_file('certificate_id', 'Сертификат')
			                 ->set_required(true)
		            ])
	    ]);
}