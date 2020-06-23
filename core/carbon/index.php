<?php
if (!defined('ABSPATH')) exit();
require __DIR__ . '/optionPage.php';
require __DIR__ . '/homePage.php';
require __DIR__ . '/faqPage.php';
require __DIR__ . '/expertsPage.php';
require __DIR__ . '/userMeta.php';
require __DIR__ . '/courseMeta.php';
require __DIR__ . '/testResultMeta.php';

add_action('after_setup_theme', 'meta_init_load');
function meta_init_load()
{
    \Carbon_Fields\Carbon_Fields::boot();
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
function course_selecting()
{
	$my_query = new WP_Query();
	$query_posts = $my_query->query(['post_type' => 'course', 'orderby' => 'title', 'order' => "ASC", 'posts_per_page' => -1]);

	$posts_list = [];
	foreach ($query_posts as $item) {
		if ($item->post_parent === 0 && $item->page_template === "default" ){
			$posts_list[$item->ID] = $item->post_title;
		}
	}
	return $posts_list;
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

function get_roles() {
	global $wp_roles;

	$all_roles = $wp_roles->roles;
	$roles = [];
	foreach ( $all_roles as $key => $role ) {
		$roles[$key] = $role['name'];
	}
	return $roles;
}