<?php

function secondMenuView(){
	$menuArgs = [
		'theme_location' => 'second_menu',
		'container' => false,
		'menu_class' => 'links__inner',
		'menu_id' => '',
		'echo' => true,
		'fallback_cb' => 'wp_page_menu',
		'before' => '',
		'after' => '',
		'link_before' => '',
		'link_after' => '',
		'items_wrap' => '<div class="links"><ul id="%1$s" class="%2$s">%3$s</ul></div>',
	];

	if (has_nav_menu('second_menu'))
	    wp_nav_menu($menuArgs);
}


function mainMenuView(){
	$menuArgs = [
		'theme_location' => 'main_menu',
		'container' => false,
		'menu_class' => 'menu__list',
		'menu_id' => '',
		'echo' => true,
		'fallback_cb' => 'wp_page_menu',
		'before' => '',
		'after' => '',
		'link_before' => '',
		'link_after' => '',
		'items_wrap' => '<ul  id="%1$s" class="%2$s">%3$s</ul>',
	];

	if (has_nav_menu('second_menu'))
		wp_nav_menu($menuArgs);
}