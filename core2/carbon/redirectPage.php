<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_redirect_page_settings');
function crb_redirect_page_settings()
{
    Container::make_post_meta("Redirect")
        ->where('post_template', '=', 'template-redirect.php')
	    ->add_fields([
            Field::make_select(  PREFIX.'redirect_page_id', 'Redirect to page' )
                ->add_options( 'my_computation_heavy_getter_function' )
	    ]);
}

function my_computation_heavy_getter_function() {
    $my_query = new WP_Query();
    $query_posts = $my_query->query(['post_type' => 'page', 'orderby' => 'title', 'order' => "ASC", 'posts_per_page' => -1]);

    $posts_list = [];
    foreach ($query_posts as $item) {
        $posts_list[$item->ID] = $item->post_title;
    }

    $second_query = $my_query->query(['post_type' => 'post', 'orderby' => 'title', 'order' => "ASC", 'posts_per_page' => -1]);

    foreach ($second_query as $item) {
        $posts_list[$item->ID] = $item->post_title;
    }
    return $posts_list;
}