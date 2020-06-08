<?php
/**
 * Template Name: course part
 * Template Post Type: course
 */

get_header();
get_template_part( '/core/views/headerView' );

global $post;

if ( have_posts() ):
	while ( have_posts() ):
		the_post();
		$coursePart = new CoursePart( get_the_ID(), $post);

		?>
        <div class="test">
            <div class="container">
                <div class="test__inner">
                    <div class="test__head">
                        <div class="test__head-text">
                            <span class="test__theme">тема занятия</span>
                            <span class="title title_blue"><?= the_title() ?></span>
                            <img class="image" src="/wp-content/themes/Yana/src/icons/test.png"/>
                        </div>
                        <div class="test__head-list">
	                        <?php $coursePart->getMainInfoBlock() ?>
                        </div>
                    </div>
                    <div class="test__dop-text">
                        <div class="test__dop-text-title">
                            <img class="test__dop-text-image" src="/wp-content/themes/Yana/src/icons/txt.svg" alt="" role="presentation"/>
                            <span>Текстовая версия раздела</span>
                            <img class="test__button" src="/wp-content/themes/Yana/src/icons/plus.svg" alt="" role="presentation"/>
                        </div>
                        <div class="test__dop-text-content">
                            <div class="experts__content">
                                <P>
                                    В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                    касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                    усвоенному материалу, для получения диплома
                                </P>
                                <P>
                                    В данном разделе вы можете в формате видео получить информацию по конкретной тематике
                                    касаемо беременности и родов, подготовки к ним, а также пройти тестирование по
                                    усвоенному материалу, для получения диплома
                                </P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="test__wrapper">
                <div class="test__wrapper-inner"></div>
                <div class="container">
                    <div class="test__content">
                        <span class="title title_blue">тестирование</span>
                        <div class="test__content-list">
                            <div class="test__content-item" data-id="question-1">
                                <div class="test__content-item-head">
                                    <span class="test__content-number">1</span>
                                    <span class="test__content-title">Нужно ли готовиться к зачатию ребенка?</span>
                                </div>
                                <div class="test__content-item-check">
                                    <div class="test__content-check correct">
                                        <label class="test__container">
                                            К зачатию ребенка не надо готовиться.
                                            <input type="radio" checked="checked" name="question-1">
                                            <span class="test__checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="test__content-check">
                                        <label class="test__container">
                                            За 2-3 месяца до планируемого зачатия будущим
                                            родителям рекомендовано принимать фолиевую кислоту, и пройти обследование
                                            состояния здоровья, вести здоровый образ жизни.
                                            <input type="radio" name="question-1">
                                            <span class="test__checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="test__content-item" data-id="question-2">
                                <div class="test__content-item-head">
                                    <span class="test__content-number">2</span>
                                    <span class="test__content-title">Беременность это</span>
                                </div>
                                <div class="test__content-item-check">
                                    <div class="test__content-check error">
                                        <label class="test__container">
                                            Болезнь, при которой надо постоянно лечится
                                            <input type="radio" checked="checked" name="question-2">
                                            <span class="test__checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="test__content-check error">
                                        <label class="test__container">
                                            Беременность – естественное физиологическое
                                            состояние, во время которого в организме женщины происходят изменения
                                            создающие условия, для вынашивания и развития ребенка.
                                            <input type="radio" name="question-2">
                                            <span class="test__checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="test__content-item" data-id="question-3">
                                <div class="test__content-item-head">
                                    <span class="test__content-number">3</span>
                                    <span class="test__content-title">
                                        У вас токсикоз первой половины беременности. Нужно ли обращаться при этом к врачу?
                                    </span>
                                </div>
                                <div class="test__content-item-check">
                                    <div class="test__content-check">
                                        <label class="test__container">
                                            Не нужно
                                            <input type="radio" checked="checked" name="question-3">
                                            <span class="test__checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="test__content-check">
                                        <label class="test__container">
                                            Нужно
                                            <input type="radio" name="question-3">
                                            <span class="test__checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="test__content-check error">
                                        <label class="test__container">
                                            Нужно, если наблюдается многократная рвота
                                            <input type="radio" name="question-3">
                                            <span class="test__checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="test__resource">
                        <span class="test__resource-title">Дополнительные ресурсы:</span>
                        <div class="test__resource-list">
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">Про беременность от подготовки до послеродового периода</span>
                                <a class="test__resource-item-link" href="">http://ffl.unicef.by/bezopasnoe_materinstvo/</a>
                                <a class="test__resource-item-link" href="">http://ffl.unicef.by/uploads/userfiles/files/24_37.pdf</a>
                                <a class="test__resource-item-link" href="">http://ffl.unicef.by/uploads/userfiles/images/04_safe_motherhood.jpg</a>
                            </div>
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">Гигиена и питание беременных</span>
                                <a class="test__resource-item-link" href="">https://bambinostory.com/gigiena-beremennyh/</a>
                            </div>
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">Отеки при беременности</span>
                                <a class="test__resource-item-link" href="">https://bambinostory.com/oteki-pri-beremennosti/</a>
                            </div>
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">Про подготовку к беременности</span>
                                <a class="test__resource-item-link" href="">http://ffl.unicef.by/planirovanie_beremennosti/</a>
                                <a class="test__resource-item-link" href="">http://ffl.unicef.by/uploads/userfiles/files/16_23.pdf</a>
                                <a class="test__resource-item-link" href="">http://ffl.unicef.by/uploads/userfiles/images/03_family_planning.jpg</a>
                            </div>
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">Питание при беременности. Общие рекомендации</span>
                                <a class="test__resource-item-link"style="" href="">http://profilaktika.tomsk.ru/?p=21548</a>
                                <a class="test__resource-item-link" href="">https://pandaland.kz/articles/beremennost-i-rody/podgotovka-k-rodam/vitaminy-dlya-beremennyh-polza-i-vred</a>
                            </div>
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">Беременность: физиологические изменения</span>
                                <a class="test__resource-item-link" href="">https://medportal.ru/enc/procreation/physiology/physiology/-</a>
                            </div>
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">Беременность по триместрам. Полезные советы акушеров-гинекологов</span>
                                <a class="test__resource-item-link" href="">https://medportal.ru/enc/procreation/reading/58/</a>
                            </div>
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">1 триместр - Витамины для беременных</span>
                                <a class="test__resource-item-link" href="">https://pandaland.kz/articles/beremennost-i-rody/zdorove-261/vitaminy-dlya-beremennyh-v-pervyj-trimestr</a>
                            </div>
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">2 триместр - Питание для беременных</span>
                                <a class="test__resource-item-link" href="">http://comfort-kitchen.ru/health/diets/pitanie-pri-beremennosti-vo-vtorom-trimestre.html</a>
                            </div>
                            <div class="test__resource-item">
                                <span class="test__resource-item-name">2-3 триместр - питание для беременных</span>
                                <a class="test__resource-item-link" href="">https://www.moirebenok.ua/pregnancy-and-birth/pitanie/pitanie-budushchej-mamy-vtoroj-i-tretij-trimestr/</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php
	endwhile;
endif;
get_template_part( '/core/views/home/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
