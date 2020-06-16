<?php
/**
 * Template name: Homepage
 */

get_header();
get_template_part('/core/views/headerView');
get_template_part('/core/views/home/banner-main');
get_template_part('/core/views/home/tags');
get_template_part('/core/views/home/experts');
?>
    <div class="passCourse">
        <div class="container over">
            <div class="passCourse__inner">
                <div class="passCourse__title"><span class="title title_blue">Пройдя курс вы получаете</span>
                </div>
                <img class="passCourse__logo" src="/wp-content/themes/Yana/src/icons/logo-dop.png" alt=""
                     role="presentation"/>
                <div class="passCourse__content">
                    <div class="passCourse__circle">
                        <div class="passCourse__circle_second"></div>
                        <div class="passCourse__list">
                            <div class="passCourse__item">
                                <div class="passCourse__item_number"><span>1</span></div>
                                <SPAN class="passCourse__item_title">Подготовку К беременности и родам</SPAN>
                            </div>
                            <div class="passCourse__item">
                                <div class="passCourse__item_number"><span>2</span></div>
                                <SPAN class="passCourse__item_title">Практические знания</SPAN>
                            </div>
                            <div class="passCourse__item">
                                <div class="passCourse__item_number"><span>3</span></div>
                                <SPAN class="passCourse__item_title">СЕРТИФИКАТ</SPAN>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="passCourse__couple" src="/wp-content/themes/Yana/src/icons/couple.png" alt=""
                     role="presentation"/>
            </div>
        </div>
    </div>
    <div class="learn">
        <div class="container">
            <div class="learn__inner">
                <div class="learn__titile"><span class="title title_blue">как пройти обучение</span>
                </div>
                <div class="learn__list"><img class="learn__line-mobile"
                                              src="/wp-content/themes/Yana/src/icons/step-line-mobile.png" alt=""
                                              role="presentation"/><img class="learn__line-desktop"
                                                                        src="/wp-content/themes/Yana/src/icons/step-line-desktop.png"
                                                                        alt="" role="presentation"/>
                    <div class="learn__item"><span class="learn__number">1</span>
                        <div class="learn__item-content">
                            <div class="learn__item-wrapper">
                                <IMG class="learn__item-image" src="/wp-content/themes/Yana/src/icons/step1.png"
                                     alt=""></IMG>
                                <SPAN class="learn__item-title">Зарегистрируйтесь</SPAN>
                            </div>
                            <SPAN class="learn__item-text">Заполните простую форму и станьте участников онлайн курса</SPAN>
                        </div>
                    </div>
                    <div class="learn__item"><span class="learn__number">2</span>
                        <div class="learn__item-content">
                            <div class="learn__item-wrapper">
                                <IMG class="learn__item-image" src="/wp-content/themes/Yana/src/icons/step2.png"
                                     alt=""></IMG>
                                <SPAN class="learn__item-title">ПРОСМОТРИТЕ ОБУЧАЮЩЕЕ ВИДЕО и ИЗУЧИТЕ МАТЕРИАЛЫ КУРСА</SPAN>
                            </div>
                            <SPAN class="learn__item-text">Смотрите обучающее видео от наших экспертов, общайтесь на форуме, скачивайте дополнительные материалы</SPAN>
                        </div>
                    </div>
                    <div class="learn__item"><span class="learn__number">3</span>
                        <div class="learn__item-content">
                            <div class="learn__item-wrapper">
                                <img class="learn__item-image" src="/wp-content/themes/Yana/src/icons/step3.png" alt=""/>
                                <SPAN class="learn__item-title">пройдите тест</SPAN>
                            </div>
                            <SPAN class="learn__item-text">Ответьте правильнео на вопросы по тематике изложенной в видеофайле</SPAN>
                        </div>
                    </div>
                    <div class="learn__item"><span class="learn__number">4</span>
                        <div class="learn__item-content">
                            <div class="learn__item-wrapper">
                                <img class="learn__item-image" src="/wp-content/themes/Yana/src/icons/step4.png" alt=""/>
                                <span class="learn__item-title">получите сертификат</span>
                            </div>
                            <SPAN class="learn__item-text">Ответив правильно на все наши вопросы вы получаете сертификат</SPAN>
                        </div>
                    </div>
                </div>
            </div>
            <img class="learn__logo" src="/wp-content/themes/Yana/src/icons/logo-dop.png" alt="" role="presentation"/>
        </div>
        <img class="learn__girl-comp" src="/wp-content/themes/Yana/src/icons/girl-comp.png" alt="" role="presentation"/>
    </div>

<?php
get_template_part('/core/views/home/question');
get_template_part('/core/views/home/services');
get_template_part('/core/views/home/partners');
get_template_part('/core/views/footerView');
get_footer();
