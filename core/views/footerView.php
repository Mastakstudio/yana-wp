<?php
if (!defined('ABSPATH')) exit();
$socialLinks = SocialLinks::getInstance();
$child_vil_link = carbon_get_theme_option(TO_SOS_CHILD_VIL);
$child_vil_link_img_id = carbon_get_theme_option(TO_SOS_CHILD_VIL_IMG_ID);
?>

<div class="footer">
    <div class="footer__content">
        <div class="footer__background">
        </div>
        <div class="footer__wrapper-content">
            <div class="footer__part"></div>
            <div class="footer__back-logo"></div>
            <div class="footer__image-wrapper"></div>
        </div>
        <div class="footer__inner-footer">
            <div class="footer__inner">
                <div class="footer__wrapper-logo">
                    <a class="footer__logo" href="/">
                        <img class="footer__image-logo" src="/wp-content/themes/Yana/src/icons/logo.svg" alt="" />
                    </a>
                </div>
                <div class="footer__wrapper">
                    <div class="container">
                        <div class="footer__inner-wrapper">
                            <?php
                            $hideSection = '';
                            $sos_logo = '';
                            if (empty($child_vil_link) || empty($child_vil_link_img_id)){
	                            $hideSection = 'style="opacity: 0; pointer-events: none"';
	                            $sos_logo = '/wp-content/themes/Yana/src/icons/sos.svg';
	                            $child_vil_link = '#';
                            }else{
	                            $sos_logo = wp_get_attachment_url($child_vil_link_img_id);
                            }?>
                            <a class="footer__inner-wrapper-link" <?= $hideSection ?> href="<?= esc_url($child_vil_link) ?>">
                                <img class="footer__inner-wrapper-image" src="<?= $sos_logo ?>" alt="" />
                            </a>
                            <?php footerMenuView(); ?>
                            <img class="footer__image" src="/wp-content/themes/Yana/src/icons/canada.svg" alt="" />
                            <div class="footer__wrapper-link">
                                <div class="social social__footer">
                                    <?php $socialLinks->getView(); ?>
                                </div>
                                <a class="footer__develop" target="_blank" href="https://mastakstudio.com/">
                                    <span class="footer__develop-title">Developed:</span>
                                    <img class="footer__develop-image" src="/wp-content/themes/Yana/src/icons/develop.svg" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>