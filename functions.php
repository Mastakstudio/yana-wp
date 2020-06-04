<?php
if (!defined('ABSPATH')) exit();

define('PREFIX', 'yana_');
define('THEME_NAME', get_template());
define('BASE_URL', '/wp-content/themes/' . THEME_NAME);

require_once __DIR__ . '/utils/Assets.php';

$falconGlen = (object)[
    'main' => require 'core/class-yana.php'
];

require 'core/wordpressShims.php';
require 'core/functions/functions.php';
require 'core/customPostType/index.php';
require 'core/functions/hooks.php';
require 'core/CustomUser.php';
require 'core/UserManager.php';
require 'core/Course.php';

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/core/carbon/index.php';
    require_once __DIR__ . '/vendor/autoload.php';
}