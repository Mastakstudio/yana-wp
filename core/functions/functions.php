<?php

function home_page_banner_video(){
	$link = carbon_get_post_meta(get_the_ID(), PREFIX.'banner_video_link');

	return (object)[
		'link_exist' => isset($link) && !empty($link),
		'link' => $link
	];
}