<?php
if (!defined('ABSPATH')) exit();
get_header();

get_template_part('/core/views/headerView');

$second_img_id = carbon_get_post_meta(get_the_ID(), PREFIX . 'second_img_id');
?>
<?php if (have_posts()) {
    while (have_posts()) {
        the_post();
        the_content();
    }
} ?>
<? if (has_post_thumbnail()) {
    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'custom_thumbnail');
    echo '<img class="text__front-image" src="' . $img_url . '" alt="Background"/>';
}
if (isset($second_img_id) && !empty($second_img_id)) {
    $second_img_url = wp_get_attachment_image_url($second_img_id, 'custom_thumbnail');
    echo '<img class="text__front-image" src="' . $second_img_url . '" alt="postImage"/>';
} ?>
<?php
get_template_part('/core/views/footerView');
get_footer();
