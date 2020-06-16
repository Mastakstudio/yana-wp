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
                    <p class="text text_black">В данном разделе вы можете получить ответ на наиболее часто возникающие
                        вопросы касательно онлайн курса &quot;БЕРЕМЕННОСТЬ И РОДЫ&quot;</p>
                </div>
                <div class="page-banner__links">
					<?php secondMenuView() ?>
                </div>
            </div>
        </div>
        <div class="page-banner__wrapper">
            <img class="image" src="/wp-content/themes/Yana/src/icons/question.png"/>
        </div>
        <div class="container">
            <div class="page-banner__list">
                <div class="page-banner__item">
                    <div class="page-banner__content-item">
                        <div class="page-banner__number">1
                        </div>
                        <span class="page-banner__title">Как зарегистрироваться на онлайн курс?</span><img
                                class="page-banner__button" src="/wp-content/themes/Yana/src/icons/button.png" alt=""
                                role="presentation"/>
                    </div>
                    <div class="page-banner__text-item">
                        <div class="editor-content">
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                усвоенному материалу, для получения диплома</P>
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                усвоенному материалу, для получения диплома</P>
                        </div>
                    </div>
                </div>
                <div class="page-banner__item">
                    <div class="page-banner__content-item">
                        <div class="page-banner__number">2
                        </div>
                        <span class="page-banner__title">Что я получу пройдя онлайн курс?</span><img
                                class="page-banner__button" src="/wp-content/themes/Yana/src/icons/button.png" alt=""
                                role="presentation"/>
                    </div>
                    <div class="page-banner__text-item">
                        <div class="editor-content">
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                усвоенному материалу, для получения диплома</P>
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                усвоенному материалу, для получения диплома</P>
                        </div>
                    </div>
                </div>
                <div class="page-banner__item">
                    <div class="page-banner__content-item">
                        <div class="page-banner__number">3
                        </div>
                        <span class="page-banner__title">Как зарегистрироваться на онлайн курс?</span><img
                                class="page-banner__button" src="/wp-content/themes/Yana/src/icons/button.png" alt=""
                                role="presentation"/>
                    </div>
                    <div class="page-banner__text-item">
                        <div class="editor-content">
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                усвоенному материалу, для получения диплома</P>
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                усвоенному материалу, для получения диплома</P>
                        </div>
                    </div>
                </div>
                <div class="page-banner__item">
                    <div class="page-banner__content-item">
                        <div class="page-banner__number">4
                        </div>
                        <span class="page-banner__title">Как зарегистрироваться на онлайн курс?</span><img
                                class="page-banner__button" src="/wp-content/themes/Yana/src/icons/button.png" alt=""
                                role="presentation"/>
                    </div>
                    <div class="page-banner__text-item">
                        <div class="editor-content">
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                усвоенному материалу, для получения диплома</P>
                            <P>В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                усвоенному материалу, для получения диплома</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_template_part( '/core/views/question' );
get_template_part( '/core/views/services' );
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
