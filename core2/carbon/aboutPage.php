<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_about_page_settings');
function crb_about_page_settings()
{
    Container::make_post_meta("About Page Settings")
        ->where('post_template', '=', 'template-about.php')
        ->add_tab('about content', [
            Field::make_complex(PREFIX.'content', 'Main Content')
                ->add_fields('subtitle', [
                    Field::make_textarea('content', 'Subtitle')->set_rows(3)
                ])->add_fields('paragraph', [
                    Field::make_textarea('paragraph', 'Paragraph')->set_rows(5)
                ])->add_fields('quotation', [
                    Field::make_textarea('quotation', 'Quotation')->set_rows(4),
                    Field::make_text('author', 'Author'),
                    Field::make_text('desc', 'Description'),
                ])
                ->set_layout('tabbed-horizontal')
                ->set_max(4),
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
                ]);
}