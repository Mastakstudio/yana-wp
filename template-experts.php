<?php
/**
 * Template name: experts
 */
//
//$userManager = UserManager::getInstance();
///**@var CustomUser $currentUser*/
//$currentUser = $userManager::GetCurrentUser();
//if ( ! $currentUser ) {
//	$userManager->RedirectToSignIn();
//}
//var_dump( $currentUser );

get_header();
get_template_part( '/core/views/headerView' );
?>
    <div class="page-experts">
        <div class="container">
            <div class="page-experts__inner">
                <div class="page-experts__content"><span class="title title_blue">наши ЭКСПЕРТы</span>
                    <p class="text text_black">Наша команда провела более 50-ти интервью и документальных съёмок с экспертами в области акушерства и гинекологии, неонатологии, педиатрии, психологиии и педагогики, юриспруденции. </p><a class="page-experts__link" href="#modal"><span>Просмотреть промо-видео</span><img src="/wp-content/themes/Yana/src/icons/play.png" alt="" role="presentation"/></a><img class="page-experts__image-experts" src="/wp-content/themes/Yana/src/icons/experts.png" alt="" role="presentation"/>
                </div>
                <div class="page-experts__list">
                    <div class="page-experts__item">
                        <div class="page-experts__item-image">
                            <IMG src="/wp-content/themes/Yana/src/icons/expert1.png" alt=""></IMG>
                        </div>
                        <div class="page-experts__item-content"><span class="page-experts__item-title">Дмитрий трофимчик</span><span class="page-experts__item-text">врач акушер-гинеколог</span>
                        </div>
                    </div>
                    <div class="page-experts__item">
                        <div class="page-experts__item-image">
                            <IMG src="/wp-content/themes/Yana/src/icons/expert2.png" alt=""></IMG>
                        </div>
                        <div class="page-experts__item-content"><span class="page-experts__item-title">Татьяна гетман</span><span class="page-experts__item-text">врач стоматолог-терапевт</span>
                        </div>
                    </div>
                    <div class="page-experts__item">
                        <div class="page-experts__item-image">
                            <IMG src="/wp-content/themes/Yana/src/icons/expert3.png" alt=""></IMG>
                        </div>
                        <div class="page-experts__item-content"><span class="page-experts__item-title">Оксана коротких</span><span class="page-experts__item-text">врач акушер-гинеколог</span>
                        </div>
                    </div>
                    <div class="page-experts__item">
                        <div class="page-experts__item-image">
                            <IMG src="/wp-content/themes/Yana/src/icons/expert4.png" alt=""></IMG>
                        </div>
                        <div class="page-experts__item-content"><span class="page-experts__item-title">светлана брашевец</span><span class="page-experts__item-text">врач акушер-гинеколог, консультант по ГВ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popup">
        <div class="remodal" data-remodal-id="modal">
            <button class="remodal-close" data-remodal-action="close"></button>
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/jemgIOAjGDw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        </div>
    </div>
    <div class="services">
        <div class="services__wrapper">
        </div>
        <div class="container">
            <div class="services__inner">
                <div class="services__content"><span class="services__desc">Больше поддержки  можно получить на</span><span class="title title_white">Интерактивная карта беслпатных услуг для беременных</span>
                    <p class="text text_black">Выберите категорию необходимой поддержки и на экране появится интерактивная карта бесплатных услуг с выбранными организациями Минска или  Могилева, Минской или Могилевской области</p>
                </div>
                <div class="services__list">
                    <div class="services__item">
                        <div class="services__item-container">
                            <IMG class="services__item-image" src="/wp-content/themes/Yana/src/icons/nurse.png" alt=""></IMG>
                        </div>
                        <SPAN class="services__item-title">Медицинская поддержка</SPAN>
                    </div>
                    <div class="services__item">
                        <IMG class="services__item-image" src="/wp-content/themes/Yana/src/icons/chat.png" alt=""></IMG>
                        <SPAN class="services__item-title">психологическая поддержка</SPAN>
                    </div>
                    <div class="services__item">
                        <IMG class="services__item-image" src="/wp-content/themes/Yana/src/icons/home.png" alt=""></IMG>
                        <SPAN class="services__item-title">социальная поддержка</SPAN>
                    </div>
                    <div class="services__item">
                        <IMG class="services__item-image" src="/wp-content/themes/Yana/src/icons/law.png" alt=""></IMG>
                        <SPAN class="services__item-title">юридическая поддержка</SPAN>
                    </div>
                    <div class="services__item">
                        <IMG class="services__item-image" src="/wp-content/themes/Yana/src/icons/book.png" alt=""></IMG>
                        <SPAN class="services__item-title">саморазвитие</SPAN>
                    </div>
                </div>
            </div>
        </div>
        <div class="services__image-content"><img class="services__castle" src="/wp-content/themes/Yana/src/icons/town2.png" alt="" role="presentation"/><img class="services__library" src="/wp-content/themes/Yana/src/icons/town.png" alt="" role="presentation"/>
        </div>
    </div>
<?php
get_template_part( '/core/views/home/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
