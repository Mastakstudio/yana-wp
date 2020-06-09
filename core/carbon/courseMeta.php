<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_course_settings');
function crb_course_settings()
{
    Container::make_post_meta("Meta")
        ->where('post_type', '=', 'course')
        ->where('post_template', '=', 'default')
       ->add_fields([
	       Field::make_textarea(PREFIX.'subtitle', 'Подзаголовок'),
       ]);
	Container::make_post_meta("Course Part")
	         ->where('post_type', '=', 'course')
	         ->where('post_template', '=', 'template-course-part.php')
	         ->add_fields([
		         Field::make_text(PREFIX.'order', 'Приоритет')
			         ->set_default_value(0)
			         ->set_attribute('type', 'number'),
		         Field::make_complex(PREFIX.'preview_desc', 'Превью описание')
		              ->add_fields('list',[
			              Field::make_complex(PREFIX.'preview_desc', 'Превью описание')
			                   ->add_fields('items',[
			                   	Field::make_textarea('text', 'Текст')
			                   ])
			                   ->set_layout('tabbed-vertical')
		              ])
			         ->add_fields('editor',[
				         Field::make_rich_text('text', 'Текст')
			         ])->set_max(1),
		         Field::make_complex(PREFIX.'main_info', 'Главная информация')
		              ->add_fields('video', 'Видео',[
			              Field::make_text('text', 'Текст ссылки'),
			              Field::make_text('youtube_link', 'Ссылка на youtube'),
		              ])
		              ->add_fields('link', 'Ссылка',[
			              Field::make_text('text', 'Текст ссылки'),
			              Field::make_text('link', 'Ссылка'),
		              ])
		              ->set_collapsed(true),
		         Field::make_complex(PREFIX.'additional_info', 'Дополнительные ресурсы')
		              ->add_fields('section', 'Секция', [
		              	  Field::make_text('text', 'Заголовок секции'),
			              Field::make_complex('links', 'Ссылки')
			                   ->add_fields('link', 'link',[
			                   	    Field::make_text('text', 'link'),
				                   ])->set_layout('tabbed-vertical')
		               ])
	         ]);
	Container::make_post_meta("Тест")
	         ->where('post_type', '=', 'course')
	         ->where('post_template', '=', 'template-course-part.php')
	         ->add_fields([
		         Field::make_complex(PREFIX.'test', 'Вопросы')
		              ->add_fields('questions', 'Вопрос',[
			              Field::make_textarea('text'),
			              Field::make_complex('answers', 'Ответ')
			                   ->add_fields('answer', 'Ответ',[
				                   Field::make_textarea('text'),
				                   Field::make_checkbox('is_correct', 'Верный')
			                   ])

		              ])

	         ]);
}

function course_part_selecting()
{
	$my_query = new WP_Query();
	$query_posts = $my_query->query(['post_type' => 'course', 'orderby' => 'title', 'order' => "ASC", 'posts_per_page' => -1]);

	$posts_list = [];
	foreach ($query_posts as $item) {
		if ($item->post_parent === 0 && $item->page_template !== "default" ){
			$posts_list[$item->ID] = $item->post_title;
		}
	}
	return $posts_list;
}