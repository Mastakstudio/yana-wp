<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_course_settings');
function crb_course_settings()
{
    Container::make_post_meta("Meta")
        ->where('post_type', '=', 'course')
        ->where( 'post_level', 'CUSTOM', function( $post_level ) { return ( $post_level === 1 ); } )
       ->add_fields([
	       Field::make_textarea(PREFIX.'subtitle', 'Подзаголовок'),
	       Field::make_complex('parts', 'занятия')
		       ->add_fields('lesson',[
			       Field::make_select('lesson_id', 'Занятие')
			       ->set_options(course_part_selecting())
		       ])
		       ->set_layout('tabbed-horizontal')
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