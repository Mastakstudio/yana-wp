<?php
if (!defined('ABSPATH')) exit();

$logo = carbon_get_theme_option(PREFIX.'main_logo');

/**@var WP_User $user*/
$user = wp_get_current_user();

$account_page = get_permalink(carbon_get_theme_option(PREFIX.'account_page'));
$signin_page = get_permalink(carbon_get_theme_option(PREFIX.'signin_page'));

$socialLinks = SocialLinks::getInstance();
?>
<div class="header">
    <div class="header__line"></div>
    <div class="header__square"></div>
    <div class="header__inner">
        <div class="container">
            <div class="header__content">
                <div class="header__burger"><span></span><span></span></div>
                <a class="header__logo-link" href="/">
                    <div class="header__logo-oval"></div>
                    <div class="header__logo-wrapper">
                        <img class="header__logo" src="/wp-content/themes/Yana/src/icons/logo.svg" alt="logo" role="presentation" />
                    </div>
                </a>
                <a class="header__auth" href="<?= $user->get_site_id() === 0 ? $signin_page : $account_page ?>">
                    <span><?= $user->get_site_id() === 0 ? 'войти/зарегистрироваться': $user->display_name ?></span>
                </a>
                <div class="header__desktop">
                    <div class="header__switch">
                        <label class="lbl-off" for="switch-orange">родитель</label>
                        <input class="switch" id="switch-orange" type="checkbox" <?php if($_SESSION['ROLE']=='specialist'){?> checked="checked" <?php } ?> >
                        <label class="lbl-on" for="switch-orange">специалист</label>
                    </div>
                    <a class="header__login" id="user_name" href="<?= $account_page ?>"><?= $user->display_name ?></a>
                    <div class="social social_blue">
	                    <?php $socialLinks->getView(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu">
        <div class="container">
            <div class="menu__inner">
                <div class="menu__type">
                    <?php if($user->get_site_id() === 0): ?>
                    <a class="menu__auth" href="<?=  $signin_page ?>">
                        <span>войти / зарегистрироваться</span>
                    </a>
                    <?php endif; ?>
                    <!-- <div class="menu__switch" style="visibility: hidden">
                        <label class="lbl-off" for="switch-orange">родитель</label>
                        <input class="switch" id="switch-orange" type="checkbox">
                        <label class="lbl-on" for="switch-orange">специалист</label>
                    </div> -->
                </div>
                <?php mainMenuView();?>
                <div class="social social social_menu">
	                <?php $socialLinks->getView(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
