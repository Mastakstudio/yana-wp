<?php
if (!defined( 'ABSPATH' )) exit();

add_action('init', 'trainings_init');
function trainings_init(){
	register_post_type('course', [
        'labels'             => [
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
            'parent_item_colon'  => '',
            'menu_name'          => 'Курсы'
        ],
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => true,
        'menu_position'      => null,
        'supports'           => ['title', 'editor'],
        'show_in_rest'       => true,
    ]);
}