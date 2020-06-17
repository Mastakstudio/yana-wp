<?php
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