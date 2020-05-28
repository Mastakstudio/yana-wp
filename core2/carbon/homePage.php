<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_home_page_settings');
function crb_home_page_settings()
{

    $link_labels = [
        'plural_name' => 'links',
        'singular_name' => 'link',
    ];
    Container::make_post_meta("Home Page Settings")
        ->where('post_template', '=', 'template-homepage.php')
        ->add_tab('links', [
            Field::make_select(PREFIX .'banner_link', 'banner link')
                ->add_options('page_selecting'),
            Field::make_text(PREFIX .'banner_link_text', 'Link Text')
                ->set_default_value('Learn more'),
            Field::make_select(PREFIX .'about_link', 'about link')
                ->add_options('page_selecting'),
            Field::make_text(PREFIX .'about_link_text', 'Link Text')
                ->set_default_value('Learn more'),
            Field::make_select(PREFIX .'wholesale_link', 'for wholesale buyers link')
                ->add_options('page_selecting'),
            Field::make_text(PREFIX .'wholesale_link_text', 'Link Text')
                ->set_default_value('Learn more')
        ])
        ->add_tab('products', [
            Field::make_textarea('learn_more_card_title', 'Learn more card title'),
            Field::make_image('learn_more_card_img_id', 'Learn more card background')->set_width(30),
            Field::make_complex(PREFIX .'products_link_select','Link in products section')
                ->add_fields('page',[
                    Field::make_select('link')->add_options('page_selecting')
                ])->add_fields('product',[
                    Field::make_select('link')->add_options('product_selecting')
                ])->add_fields('product_category',[
                    Field::make_select('link')->add_options('product_category_selector')
                ])->add_fields('custom_link',[
                    Field::make_text('link')
                ])->set_max(1)->set_width(70) ->setup_labels( $link_labels )->set_collapsed( true )
        ])
        ->add_tab('benefits', [
            Field::make_complex(PREFIX.'home_benefits', 'Benefits list')
                ->add_fields('benefit',
                    [
                        Field::make_textarea('title', 'Title')->set_rows(2)->set_width(50),
                        Field::make_complex('images_list')
                            ->add_fields('image','image',[
                                Field::make_image('img_id', 'Image')
                            ])->set_layout('tabbed-horizontal')->set_width(50),
                        Field::make_rich_text('benefit_content', 'Content')
                    ])
                ->set_layout('tabbed-horizontal'),
        ])
        ->add_tab('steps of order', [
            Field::make_complex(PREFIX.'home_steps', 'Steps of order')
                ->add_fields('step', [
                    Field::make_text('title', 'Title')->set_width(50),
                    Field::make_image('img_id', 'Image')->set_width(50),
                    Field::make_rich_text('content', 'Content')
                ])
                ->set_layout('tabbed-horizontal')
                ->set_max(3),
                ])
        ->add_tab('about', [
            Field::make_text(PREFIX.'home_about_subtitle', 'Subtitle'),
            Field::make_textarea(PREFIX.'home_about_content', 'Content')->set_rows(7),
        ]);
}

add_action('carbon_fields_post_meta_container_saved','test_hook', 20, 2);
function test_hook(){
	$aaaa = 'aaaa';
}