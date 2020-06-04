<?php
/**
 * Template name: faq
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
    <div class="page-banner">
        <div class="container">
            <div class="page-banner__inner">
                <div class="page-banner__content"><span class="title title_blue">ВОПРОС-ответ</span>
                    <p class="text text_black">В данном разделе вы можете получить ответ на наиболее часто возникающие вопросы касательно онлайн курса &quot;БЕРЕМЕННОСТЬ И РОДЫ&quot;</p>
                </div>
                <div class="page-banner__links">
                    <div class="links">
                        <div class="links__inner"><a class="links__item">Пройти курс</a><a class="links__item links__item links__item_active">ВОПРОС-ОТВЕТ</a><a class="links__item">Профиль</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-banner__wrapper">
            <IMG class="image" src="/wp-content/themes/Yana/src/icons/question.png"></IMG>
        </div>
        <div class="container">
            <div class="page-banner__list">
                <div class="page-banner__item">
                    <div class="page-banner__content-item">
                        <div class="page-banner__number">1
                        </div><span class="page-banner__title">Как зарегистрироваться на онлайн курс?</span><img class="page-banner__button" src="/wp-content/themes/Yana/src/icons/button.png" alt="" role="presentation"/>
                    </div>
                    <div class="page-banner__text-item">
                        <div class="editor-content">
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике касаемо беременности и родов, подготовки к ним, а также пройти тестирование по усвоенному материалу, для получения диплома</P>
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике касаемо беременности и родов, подготовки к ним, а также пройти тестирование по усвоенному материалу, для получения диплома</P>
                        </div>
                    </div>
                </div>
                <div class="page-banner__item">
                    <div class="page-banner__content-item">
                        <div class="page-banner__number">2
                        </div><span class="page-banner__title">Что я получу пройдя онлайн курс?</span><img class="page-banner__button" src="/wp-content/themes/Yana/src/icons/button.png" alt="" role="presentation"/>
                    </div>
                    <div class="page-banner__text-item">
                        <div class="editor-content">
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике касаемо беременности и родов, подготовки к ним, а также пройти тестирование по усвоенному материалу, для получения диплома</P>
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике касаемо беременности и родов, подготовки к ним, а также пройти тестирование по усвоенному материалу, для получения диплома</P>
                        </div>
                    </div>
                </div>
                <div class="page-banner__item">
                    <div class="page-banner__content-item">
                        <div class="page-banner__number">3
                        </div><span class="page-banner__title">Как зарегистрироваться на онлайн курс?</span><img class="page-banner__button" src="/wp-content/themes/Yana/src/icons/button.png" alt="" role="presentation"/>
                    </div>
                    <div class="page-banner__text-item">
                        <div class="editor-content">
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике касаемо беременности и родов, подготовки к ним, а также пройти тестирование по усвоенному материалу, для получения диплома</P>
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике касаемо беременности и родов, подготовки к ним, а также пройти тестирование по усвоенному материалу, для получения диплома</P>
                        </div>
                    </div>
                </div>
                <div class="page-banner__item">
                    <div class="page-banner__content-item">
                        <div class="page-banner__number">4
                        </div><span class="page-banner__title">Как зарегистрироваться на онлайн курс?</span><img class="page-banner__button" src="/wp-content/themes/Yana/src/icons/button.png" alt="" role="presentation"/>
                    </div>
                    <div class="page-banner__text-item">
                        <div class="editor-content">
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике касаемо беременности и родов, подготовки к ним, а также пройти тестирование по усвоенному материалу, для получения диплома</P>
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике касаемо беременности и родов, подготовки к ним, а также пройти тестирование по усвоенному материалу, для получения диплома</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <INPUT class="form-input__item-input" name="text" type="text" placeholder="Телефон или электронная почта"></INPUT>
                        </div>
                        <div class="form-textarea__item">
                            <LABEL class="form-textarea__item-label">Сообщение</LABEL>
                            <TEXTAREA class="form-textarea__item-textarea" name="comment" type="text" placeholder="Сообщение"></TEXTAREA>
                        </div>
                        <BUTTON class="custom-button" type="submit">Отправить</BUTTON>
                    </form>
                </div><img class="question__image" src="/wp-content/themes/Yana/src/icons/hand.png" alt="" role="presentation"/>
            </div><img class="question__logo" src="/wp-content/themes/Yana/src/icons/logo-dop.png" alt="" role="presentation"/>
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
