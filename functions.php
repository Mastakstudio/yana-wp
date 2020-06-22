<?php
if (!defined('ABSPATH')) exit();


date_default_timezone_set('Europe/Minsk');
define('PREFIX', 'yana_');
define('THEME_NAME', get_template());
define('BASE_URL', '/wp-content/themes/' . THEME_NAME);

require_once __DIR__ . '/utils/Assets.php';

$falconGlen = (object)[
    'main' => require 'core/class-yana.php'
];
require 'core/define.php';
require 'core/viewFunctions/includes.php';
require 'core/wordpressShims.php';
require 'core/functions/functions.php';
require 'core/functions/hooks.php';
require 'core/customPostType/includes.php';
require 'core/includes.php';
require 'core/ajax/index.php';

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/core/carbon/index.php';
    require_once __DIR__ . '/vendor/autoload.php';
}

remove_role( 'editor' );
remove_role( 'contributor' );
remove_role( 'author' );
remove_role( 'expert' );

$specialist_capabilities = [
	'delete_posts',
	'edit_posts',
	'read',
];
add_role('specialist', __('specialist'), $specialist_capabilities);

$parent_capabilities = [
	'delete_posts',
	'edit_posts',
	'read',
];
add_role('parent', __('parent'), $parent_capabilities);