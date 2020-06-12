<?php
$banner_video  = home_page_banner_video();
$userManager = UserManager::getInstance();
/**@var $currentUser CustomUser*/
$currentUser = $userManager::GetCurrentUser();
?>
<div class="banner-main">
    <div class="container">
        <div class="banner-main__inner">
            <div class="banner-main__content">
                <span class="title title_blue">ОБУЧАЮЩИЙ КУРС «БЕРЕМЕННОСТЬ И РОДЫ»</span>
                <p class="text text_black">
                    Онлайн курс подготовлен в рамках проекта «Ты не одна» и ориентирован на
                    семьи, ожидающие рождение ребенка, и на молодых родителей. В курсе Вы узнаете в легкой форме,
                    как счастливо пройти всю беременность, подготовится к родам, материнству и отцовству.
                </p>
                <?php if ($banner_video->link_exist):?>
                    <a class="banner-main__link" href="#modal">
                        <span>Просмотреть приветствие</span>
                        <img src="/wp-content/themes/Yana/src/icons/play.png" alt="" role="presentation"/>
                    </a>
                    <img class="banner-main__girl-write" src="/wp-content/themes/Yana/src/icons/girl-write.png" alt="" role="presentation"/>
                <?php   endif; ?>
            </div>
            <?php if (is_null($currentUser->user))
                get_template_part('/core/views/home/ajax-login-form' ); ?>
        </div>
    </div>
    <div class="banner-main__image">
        <picture>
            <source class="banner-main__bad" srcSet="/wp-content/themes/Yana/src/icons/bad-mobile.png" media="(max-width: 560px)"/>
            <source class="banner-main__bad" srcSet="/wp-content/themes/Yana/src/icons/bad-desctop.png" media="(max-width : 768px - 1px and orientation : landscape)"/>
            <img class="banner-main__bad" src="/wp-content/themes/Yana/src/icons/bad-desctop.png" alt="" role="presentation"/>
        </picture>
        <img class="banner-main__baby" src="/wp-content/themes/Yana/src/icons/girl-with-baby.png" alt=""
             role="presentation"/>
    </div>
</div>
<?php if ($banner_video->link_exist): ?>
    <div class="popup">
        <div class="remodal" data-remodal-id="modal">
            <button class="remodal-close" data-remodal-action="close"></button>
            <iframe width="100%" height="100%" src="<?= esc_url($banner_video->link) ?>" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen=""></iframe>
        </div>
    </div>
<?php endif; ?>