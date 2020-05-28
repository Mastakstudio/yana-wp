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
                                <SPAN class="passCourse__item_title">Подготовку  К беременности и родам</SPAN>
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
                                <IMG class="learn__item-image" src="/wp-content/themes/Yana/src/icons/step3.png"
                                     alt=""></IMG>
                                <SPAN class="learn__item-title">пройдите тест</SPAN>
                            </div>
                            <SPAN class="learn__item-text">Ответьте правильнео на вопросы по тематике изложенной в видеофайле</SPAN>
                        </div>
                    </div>
                    <div class="learn__item"><span class="learn__number">4</span>
                        <div class="learn__item-content">
                            <div class="learn__item-wrapper">
                                <IMG class="learn__item-image" src="/wp-content/themes/Yana/src/icons/step4.png"
                                     alt=""></IMG>
                                <SPAN class="learn__item-title">получите сертификат</SPAN>
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
    <div class="question">
        <div class="question__wrapper">
        </div>
        <div class="container">
            <div class="question__inner">
                <div class="question__content">
                    <div class="question__title"><span class="title title_blue">Остались вопросы?</span>
                    </div>
                    <form class="question__form" id="questionForm">
                        <div class="form-input__item">
                            <LABEL class="form-input__item-label">Имя</LABEL>
                            <INPUT class="form-input__item-input" name="name" type="text" placeholder="Имя"></INPUT>
                        </div>
                        <div class="form-input__item">
                            <LABEL class="form-input__item-label">Телефон или электронная почта</LABEL>
                            <INPUT class="form-input__item-input" name="text" type="text"
                                   placeholder="Телефон или электронная почта"></INPUT>
                        </div>
                        <div class="form-textarea__item">
                            <LABEL class="form-textarea__item-label">Сообщение</LABEL>
                            <TEXTAREA class="form-textarea__item-textarea" name="comment" type="text"
                                      placeholder="Сообщение"></TEXTAREA>
                        </div>
                        <BUTTON class="custom-button" type="submit">Отправить</BUTTON>
                    </form>
                </div>
                <img class="question__image" src="/wp-content/themes/Yana/src/icons/hand.png" alt=""
                     role="presentation"/>
            </div>
            <img class="question__logo" src="/wp-content/themes/Yana/src/icons/logo-dop.png" alt=""
                 role="presentation"/>
        </div>
    </div>
    <div class="services">
        <div class="services__wrapper">
        </div>
        <div class="container">
            <div class="services__inner">
                <div class="services__content"><span
                            class="services__desc">Больше поддержки  можно получить на</span><span
                            class="title title_white">Интерактивная карта беслпатных услуг для беременных</span>
                    <p class="text text_black">Выберите категорию необходимой поддержки и на экране появится
                        интерактивная карта бесплатных услуг с выбранными организациями Минска или Могилева, Минской или
                        Могилевской области</p>
                </div>
                <div class="services__list">
                    <div class="services__item">
                        <div class="services__item-container">
                            <IMG class="services__item-image" src="/wp-content/themes/Yana/src/icons/nurse.png"
                                 alt=""></IMG>
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
        <div class="services__image-content"><img class="services__castle"
                                                  src="/wp-content/themes/Yana/src/icons/town2.png" alt=""
                                                  role="presentation"/><img class="services__library"
                                                                            src="/wp-content/themes/Yana/src/icons/town.png"
                                                                            alt="" role="presentation"/>
        </div>
    </div>
    <div class="partners">
        <div class="container">
            <div class="partners__inner">
                <div class="partners__container swiper-container">
                    <div class="partners__wrapper swiper-wrapper">
                        <div class="partners__slide swiper-slide"><img class="partners__image"
                                                                       src="/wp-content/themes/Yana/src/icons/partner1.png"
                                                                       alt="" role="presentation"/><span
                                    class="partners__title">минский областной исполнительный комитет</span>
                        </div>
                        <div class="partners__slide swiper-slide"><img class="partners__image"
                                                                       src="/wp-content/themes/Yana/src/icons/partner2.png"
                                                                       alt="" role="presentation"/><span
                                    class="partners__title">комитет по здравоохранению мингорисполкома и комитет по труду и соцзащите мингорисполкома</span>
                        </div>
                        <div class="partners__slide swiper-slide"><img class="partners__image"
                                                                       src="/wp-content/themes/Yana/src/icons/partner3.png"
                                                                       alt="" role="presentation"/><span
                                    class="partners__title">могилевский областной исполнительный комитет</span>
                        </div>
                        <div class="partners__slide swiper-slide"><img class="partners__image"
                                                                       src="/wp-content/themes/Yana/src/icons/partner4.png"
                                                                       alt="" role="presentation"/><span
                                    class="partners__title">могилевская центральная поликлиника</span>
                        </div>
                        <div class="partners__slide swiper-slide"><img class="partners__image"
                                                                       src="/wp-content/themes/Yana/src/icons/partner5.png"
                                                                       alt="" role="presentation"/><span
                                    class="partners__title">комитет по труду и соцзащите миноблисполкома</span>
                        </div>
                        <div class="partners__slide swiper-slide"><img class="partners__image"
                                                                       src="/wp-content/themes/Yana/src/icons/partner1.png"
                                                                       alt="" role="presentation"/><span
                                    class="partners__title">минский областной исполнительный комитет</span>
                        </div>
                    </div>
                    <div class="partners__button-prev swiper-button-prev">
                    </div>
                    <div class="partners__button-next swiper-button-next">
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_template_part('/core/views/footerView');
get_footer();
