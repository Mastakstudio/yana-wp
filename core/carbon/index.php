<?php
require __DIR__ . '/optionPage.php';
require __DIR__ . '/homePage.php';

add_action('after_setup_theme', 'meta_init_load');
function meta_init_load()
{
    \Carbon_Fields\Carbon_Fields::boot();
}
