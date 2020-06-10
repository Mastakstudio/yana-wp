<?php

function secondMenuView(){
	$secondMenuArgs = [
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
		'items_wrap' => '<div class="links"><div id="%1$s" class="%2$s">%3$s</div></div>',
	];

	if (has_nav_menu('second_menu'))
	    wp_nav_menu($secondMenuArgs);
}
