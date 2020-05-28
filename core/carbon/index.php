<?php
require __DIR__ . '/optionPage.php';
//require __DIR__ . '/homePage.php';
//require __DIR__ . '/aboutPage.php';
//require __DIR__ . '/contactPage.php';
//require __DIR__ . '/businessPage.php';
//require __DIR__ . '/productMeta.php';
//require __DIR__ . '/trainingMeta.php';

//function product_selecting()
//{
//    $my_query = new WP_Query();
//    $query_posts = $my_query->query(['post_type' => 'product', 'orderby' => 'title', 'order' => "ASC"]);
//
//    $posts_list = [];
//    foreach ($query_posts as $item) {
//        $posts_list[$item->ID] = $item->post_title;
//    }
//    return $posts_list;
//}
//function training_selecting()
//{
//    $my_query = new WP_Query();
//    $query_posts = $my_query->query(['post_type' => 'training', 'orderby' => 'title', 'order' => "ASC"]);
//
//    $posts_list = [];
//    foreach ($query_posts as $item) {
//        $posts_list[$item->ID] = $item->post_title;
//    }
//    return $posts_list;
//}

//function users_list(){
//	$users = get_users();
//	$user_by_id =[];
//
//	foreach ( $users as $user ) {
//		$user_by_id[$user->ID] = $user->user_email;
//	}
//	return $user_by_id;
//}

//function shipping_methods_list()
//{
//	$zones = WC_Shipping_Zones::get_zones();
//
//	$selected_data = [ 0 => '---' ];
//	foreach ($zones as $zone) {
////		$zone_id = $zone['zone_id'];
////		$zone_name = $zone['zone_name'];
//		$formatted_zone_location = $zone['formatted_zone_location'];
//		foreach ($zone['shipping_methods'] as $method){
////			$method_id = ((Array)$method)['id'];
//			$method_title = ((Array)$method)['method_title'];
//			$current_method_id = $method->get_rate_id();
//
//			$selected_data[$current_method_id] = $formatted_zone_location." (".$method_title.")";
//		}
//	}
//	return $selected_data;
//}

add_action('after_setup_theme', 'meta_init_load');
function meta_init_load()
{
    \Carbon_Fields\Carbon_Fields::boot();
}

