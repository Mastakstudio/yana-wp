<?php
$login_page = carbon_get_theme_option(PREFIX . 'login_page');

$userManager = UserManager::getInstance();
/**@var $currentUser CustomUser*/
$currentUser = $userManager::GetCurrentUser();
?>

<div class="tags">
    <div class="container">
        <div class="tags__inner">
            <div class="tags__first">
                <div class="tags__mobile-first tags__animate">
                    <img src="/wp-content/themes/Yana/src/icons/tags-mobile-first.png">
                </div>
                <div class="tags__item tags__left">
                    <span class="tags__item-title">Испытываешь</span>
                    <span class="tags__item-title">Страх</span>
                    <span class="tags__item-title">Раздражительность</span>
                    <span class="tags__item-title">Подавленность</span>
                    <span class="tags__item-title">Сомнения</span>
                    <span class="tags__item-title">стресс</span>
                </div>
            </div>
            <div class="tags__content">
                <span class="title title_orange">Мы поможем получить всесторонние знания</span>
                <p class="text text_white">
                    А также дадим возможность сравнить мнения, проанализировать разный опыт и даже познакомится с документальными кадрами рождения
                </p>
                <?php
                if ( is_null($currentUser->user) ) {
	                if (isset($login_page) || empty($login_page) ){
		                echo '<a class="link" href="'.get_permalink($login_page).'">Зарегистрироваться</a>';
	                }
                } ?>
            </div>
            <div class="tags__second">
                <div class="tags__mobile-second tags__animate">
                    <img src="/wp-content/themes/Yana/src/icons/tags-mobile-second.png">
                </div>
                <div class="tags__item tags__right">
                    <span class="tags__item-title">родительство</span>
                    <span class="tags__item-title">готовность к родам</span>
                    <span class="tags__item-title">открываю новое</span>
                    <span class="tags__item-title">опыт</span>
                    <span class="tags__item-title">осознанность</span>
                    <span class="tags__item-title">радость</span>
                    <span class="tags__item-title">знания</span>
                    <span class="tags__item-title">поддержка</span>
                    <span class="tags__item-title">я не одна</span>
                    <span class="tags__item-title">у меня все получается</span>
                </div>
            </div>
            <img class="tags__logo" src="/wp-content/themes/Yana/src/icons/logo-dop.png" alt=""
                 role="presentation"/>
        </div>
    </div>
</div>