<?php
$mainMenuArgs = [
    'theme_location' => 'main_menu',
    'container' => false,
    'menu_class' => 'header__menu-list',
    'menu_id' => '',
    'echo' => true,
    'fallback_cb' => 'wp_page_menu',
    'before' => '',
    'after' => '',
    'link_before' => '',
    'link_after' => '',
    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
//    'items_wrap' => '<div class="%2$s"><ul id="%1$s">%3$s</ul></div>',
];

if (has_nav_menu('main_menu')) :?>
	<?php 	get_template_part('/core/views/account/account-enter', 'aside'); ?>
	<?php wp_nav_menu($mainMenuArgs);
endif; ?>