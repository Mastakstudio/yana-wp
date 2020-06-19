<?php
if (!defined( 'ABSPATH' )) exit();

add_action('init', 'trainings_init');
function trainings_init(){
	$labels = [
		'name'               => 'Курс',
		'singular_name'      => 'Курс',
		'add_new'            => 'Добавить Курс',
		'add_new_item'       => 'Добавить новый Курс',
		'edit_item'          => 'Редактировать Курс',
		'new_item'           => 'Новый Курс',
		'view_item'          => 'Посмотреть Курс',
		'search_items'       => 'Найти Курс',
		'not_found'          =>  'Курс не найдено',
		'not_found_in_trash' => 'В корзине Курсов не найдено',
		'parent_item_colon'  => 'Основной курс',
		'menu_name'          => 'Курсы'
	];
	$supports = [
		'title',
		'editor',
		'thumbnail',
		'page-attributes',
	];
	register_post_type('course', [
        'labels'             => $labels,
        'supports'           => $supports,
        'capability_type'    => 'post',
        'public'             => true,
        'publicly_queryable' => true,
        'query_var'          => true,
        'menu_position'      => null,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'rewrite'            => true,
        'has_archive'        => true,
        'hierarchical'       => true,
    ]);
}