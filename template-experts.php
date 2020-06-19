<?php
/**
 * Template name: experts
 */
if (!defined('ABSPATH')) exit();


$subTitle = carbon_get_post_meta( get_the_ID(), PREFIX . 'subtitle' );
$video    = carbon_get_post_meta( get_the_ID(), PREFIX . 'video' );
$experts  = carbon_get_post_meta( get_the_ID(), PREFIX . 'experts' );

get_header();
get_template_part( '/core/views/headerView' );
?>
    <div class="page-experts">
        <div class="container">
            <div class="page-experts__inner">
                <div class="page-experts__content">
                    <span class="title title_blue"><?= get_the_title() ?></span>
                    <p class="text text_black"><?= $subTitle ?></p>
                    <a class="page-experts__link" href="#modal">
                        <span>Просмотреть промо-видео</span>
                        <img src="/wp-content/themes/Yana/src/icons/play.svg" alt=""/>
                    </a>
                    <img class="page-experts__image-experts" src="/wp-content/themes/Yana/src/icons/experts.png"
                         alt=""/>
                </div>
                <div class="page-experts__list">
					<?php
					if ( is_array( $experts ) && count( $experts ) > 0 ):
						foreach ( $experts as $expert ):
							$name = $expert['name'];
							$specialization = $expert['specialization'];
							$img_id = $expert['photo_id'];
						    $img_url = wp_get_attachment_image_url($img_id);
							?>
                            <div class="page-experts__item">
                                <div class="page-experts__item-image">
                                    <img src="<?= esc_url($img_url)?>" alt="<?= $name ?>"/>
                                </div>
                                <div class="page-experts__item-content">
                                    <span class="page-experts__item-title"><?= $name ?></span>
                                    <span class="page-experts__item-text"><?= $specialization ?></span>
                                </div>
                            </div>
						<?php
						endforeach;
					endif;
					?>
                </div>
            </div>
        </div>
    </div>
    <div class="popup">
        <div class="remodal" data-remodal-id="modal">
            <button class="remodal-close" data-remodal-action="close"></button>
            <iframe width="100%" height="100%" src="<?= esc_url($video) ?>" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen=""></iframe>
        </div>
    </div>
<?php
get_template_part( '/core/views/services' );
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();