<?php
if (!defined( 'ABSPATH' )) exit();

add_action('init', 'course_test_result_init');
function course_test_result_init(){
	$labels = [
		'name'               => 'CourseTestResult',
		'singular_name'      => 'CourseTestResult',
		'add_new'            => 'Добавить CourseTestResult',
		'add_new_item'       => 'Добавить новый CourseTestResult',
		'edit_item'          => 'Редактировать CourseTestResult',
		'new_item'           => 'Новый CourseTestResult',
		'view_item'          => 'Посмотреть CourseTestResult',
		'search_items'       => 'Найти CourseTestResult',
		'not_found'          =>  'CourseTestResult не найдено',
		'not_found_in_trash' => 'В корзине CourseTestResult не найдено',
		'parent_item_colon'  => '',
		'menu_name'          => 'CourseTestResult'
	];

	$args =[
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => false,
		'show_in_menu'       => false,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => [],
		'show_in_rest'       => true,
	];

	register_post_type('course_test_results', $args);
}