<?php
require __DIR__ . '/optionPage.php';
require __DIR__ . '/homePage.php';
require __DIR__ . '/aboutPage.php';
require __DIR__ . '/productMeta.php';
require __DIR__ . '/contactPage.php';
require __DIR__ . '/buyersPage.php';
require __DIR__ . '/deliveryPage.php';
require __DIR__ . '/editorBlocks.php';
require __DIR__ . '/redirectPage.php';
require __DIR__ . '/defaultPage.php';


function product_selecting()
{
    $my_query = new WP_Query();
    $query_posts = $my_query->query(['post_type' => 'product', 'orderby' => 'title', 'order' => "ASC"]);

    $posts_list = [];
    foreach ($query_posts as $item) {
        $posts_list[$item->ID] = $item->post_title;
    }
    return $posts_list;
}
function page_selecting()
{
    $my_query = new WP_Query();
    $query_posts = $my_query->query(['post_type' => 'page', 'orderby' => 'title', 'order' => "ASC", 'posts_per_page' => -1]);

    $posts_list = [];
    foreach ($query_posts as $item) {
        $posts_list[$item->ID] = $item->post_title;
    }
    return $posts_list;
}

function product_category_selector(){
    $args = [
        'taxonomy'     => 'product_cat',
        'orderby'      => 'name',
        'hide_empty'   => 0
    ];

    $all_categories = get_categories( $args );
    $categories_list = [];
    foreach ($all_categories as $cat) {
        if($cat->category_parent == 0) {
            $category_id = $cat->term_id;
//            get_term_link($cat->slug, 'product_cat') ;
            $categories_list[$category_id] = $cat->name ;
        }
    }
    return $categories_list;
}

add_action('after_setup_theme', 'meta_init_load');
function meta_init_load()
{
    \Carbon_Fields\Carbon_Fields::boot();
}


function shipping_methods_list()
{
    $zones = WC_Shipping_Zones::get_zones();




    $selected_data = [ 0 => '---' ];
    foreach ($zones as $zone) {
        $formatted_zone_location = $zone['formatted_zone_location'];
        foreach ($zone['shipping_methods'] as $method){
            $method_title = ((Array)$method)['method_title'];
            $current_method_id = $method->title;

            $selected_data[$method->get_rate_id()] = $formatted_zone_location." (".$current_method_id.")";
        }
    }
    return $selected_data;
}