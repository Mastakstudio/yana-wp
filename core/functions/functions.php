<?php

function home_page_banner_video(){
	$link = carbon_get_post_meta(get_the_ID(), PREFIX.'banner_video_link');

	return (object)[
		'link_exist' => isset($link) && !empty($link),
		'link' => $link
	];
}
function home_page_experts_video(){
	$link = carbon_get_post_meta(get_the_ID(), PREFIX.'experts_video_link');

	return (object)[
		'link_exist' => isset($link) && !empty($link),
		'link' => $link
	];
}

function home_page_services(){
	$links = carbon_get_post_meta(get_the_ID(), PREFIX.'sos_not_alone_links');

	return (object)[
		'link_exist' => isset($links) && !empty($links),
		'links' => $links
	];
}

function home_page_partners(){
	$links = carbon_get_theme_option( PREFIX.'partners');

	return (object)[
		'link_exist' => isset($links) && !empty($links),
		'links' => $links
	];
}