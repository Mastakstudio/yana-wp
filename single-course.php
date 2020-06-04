<?php
get_header();
get_template_part( '/core/views/headerView' );
?>
    <div class="course-page">
        <div class="container">
            <div class="course-page__inner">
                <div class="course-page__content">


					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							$sub_title = carbon_get_post_meta( get_the_ID(), PREFIX . 'subtitle' ) ?>
                            <span class="title title_blue"><?php the_title() ?></span>
                            <p class="text text_black"><?= $sub_title ?></p>
						<?php }
					} ?>
                </div>
                <div class="course-page__links">
                    <div class="links">
                        <div class="links__inner">
                            <a class="links__item">Пройти курс</a>
                            <a class="links__item links__item links__item_active">ВОПРОС-ОТВЕТ</a>
                            <a class="links__item">Профиль</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="course-page__wrapper">
            <img class="image" src="/wp-content/themes/Yana/src/icons/course-page.png"/>
        </div>
        <div class="container">
            <div class="course-page__list">
                <div class="course-page__item">
                    <div class="course-page__content-item">
                        <span class="course-page__title">Психология беременности, родов и родительства</span>
                        <div class="course-page__inner-content-item">
                            <div class="course-page__image-content-item">
                                <img class="course-page__about-image" src="/wp-content/themes/Yana/src/icons/course1.png" alt="" role="presentation"/>
                            </div>
                            <div class="course-page__text-content-item">
                                <div class="course-page__title-content-item">
                                    <span>Освещенные темы</span>
                                    <img class="course-page__button" src="/wp-content/themes/Yana/src/icons/button.png" alt="" role="presentation"/>
                                </div>
                                <div class="course-page__list-content-item">
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>1</span></div>
                                        <span class="course-page__type-content-item-text">Кормление двойни</span>
                                    </span>
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>2</span></div>
                                        <span class="course-page__type-content-item-text">Мамино молоко. Сцеживание и хранение</span>
                                    </span>
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>3</span></div>
                                        <span class="course-page__type-content-item-text">Основы грудного вскармливания</span>
                                    </span>
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>4</span></div>
                                        <span class="course-page__type-content-item-text">Позиции для кормления</span>
                                    </span>
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>5</span></div>
                                        <span class="course-page__type-content-item-text">Преимущества грудного вскрамливания</span>
                                    </span>
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>6</span></div>
                                        <span class="course-page__type-content-item-text">Принципы успешного грудного вскармливания</span>
                                    </span>
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>7</span></div>
                                        <span class="course-page__type-content-item-text">Рацион кормящей мамы</span>
                                    </span>
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>8</span></div>
                                        <span class="course-page__type-content-item-text">Техника грудного вскармливания</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-page__info-item">
                        <div class="course-page__title-info-item">
                            <span>информация</span>
                            <img class="course-page__button" src="/wp-content/themes/Yana/src/icons/button.png" alt="" role="presentation"/>
                        </div>
                        <div class="course-page__content-info-item">
                            <span class="course-page__desc-info-item">До окончания выполнения задания осталось:</span>
                            <div class="course-page__time-info-item" data-time="Jun 30, 2020 00:00:00">
                                <ul>
                                    <li><span>Дней:</span><span class="days"></span></li>
                                    <li><span>Часов:</span><span class="hours"></span></li>
                                    <li><span>Минут:</span><span class="minutes"></span></li>
                                </ul>
                            </div>
                            <div class="course-page__text-info-item">
                                <div class="course-page__type-text-info-item">
                                    <span class="course-page__type-text-info-item-title">Вопросов всего:</span>
                                    <div class="course-page__line"></div>
                                    <span class="course-page__type-text-info-item-number">7</span>
                                </div>
                                <div class="course-page__type-text-info-item">
                                    <span class="course-page__type-text-info-item-title">Отвечено:</span>
                                    <div class="course-page__line"></div>
                                    <span class="course-page__type-text-info-item-number">4</span>
                                </div>
                                <div class="course-page__type-text-info-item">
                                    <span class="course-page__type-text-info-item-title">Правильно:</span>
                                    <div class="course-page__line"></div>
                                    <span class="course-page__type-text-info-item-number">2</span>
                                </div>
                            </div>
                            <div class="course-page__procent-info-item">
                                <div class="course-page__circle-procent-info-item"></div>
                                <span class="course-page__procent-info-item-number">70%</span>
                                <span class="course-page__procent-info-item-text">усвоенного материала</span>
                            </div>
                        </div>
                        <div class="course-page__link-to">
                            <a class="link">Продолжить обучение</a>
                        </div>
                    </div>
                </div>
                <div class="course-page__item">
                    <div class="course-page__content-item">
                        <span class="course-page__title">Первый год жизни малыша</span>
                        <div class="course-page__inner-content-item">
                            <div class="course-page__image-content-item">
                                <img class="course-page__about-image" src="/wp-content/themes/Yana/src/icons/course2.png" alt="" role="presentation"/>
                            </div>
                            <div class="course-page__text-content-item">
                                <div class="course-page__title-content-item">
                                    <span>Освещенные темы</span>
                                    <img class="course-page__button" src="/wp-content/themes/Yana/src/icons/button.png" alt="" role="presentation"/>
                                </div>
                                <div class="course-page__list-content-item">
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>1</span></div>
                                        <span class="course-page__type-content-item-text">Адаптация малыша после родов</span>
                                    </span>
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>2</span></div>
                                        <span class="course-page__type-content-item-text">Особенности периодна новорожденности</span>
                                    </span>
                                    <span class="course-page__type-content-item">
                                        <div class="course-page__type-content-item-number"><span>3</span></div>
                                        <span class="course-page__type-content-item-text">Уход за новорожденным в роддоме</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-page__info-item">
                        <div class="course-page__title-info-item">
                            <span>информация</span>
                            <img class="course-page__button" src="/wp-content/themes/Yana/src/icons/button.png" alt="" role="presentation"/>
                        </div>
                        <div class="course-page__content-info-item">
                            <span class="course-page__desc-info-item">До окончания выполнения задания осталось:</span>
                            <div class="course-page__time-info-item" data-time="Jun 21, 2020 00:00:00">
                                <ul>
                                    <li><span>Дней:</span><span class="days"></span></li>
                                    <li><span>Часов:</span><span class="hours"></span></li>
                                    <li><span>Минут:</span><span class="minutes"></span></li>
                                </ul>
                            </div>
                            <div class="course-page__text-info-item">
                                <div class="course-page__type-text-info-item">
                                    <span class="course-page__type-text-info-item-title">Вопросов всего:</span>
                                    <div class="course-page__line"></div>
                                    <span class="course-page__type-text-info-item-number">7</span>
                                </div>
                                <div class="course-page__type-text-info-item">
                                    <span class="course-page__type-text-info-item-title">Отвечено:</span>
                                    <div class="course-page__line"></div>
                                    <span class="course-page__type-text-info-item-number">4</span>
                                </div>
                                <div class="course-page__type-text-info-item">
                                    <span class="course-page__type-text-info-item-title">Правильно:</span>
                                    <div class="course-page__line"></div>
                                    <span class="course-page__type-text-info-item-number">2</span>
                                </div>
                            </div>
                            <div class="course-page__procent-info-item">
                                <div class="course-page__circle-procent-info-item"></div>
                                <span class="course-page__procent-info-item-number">70%</span>
                                <span class="course-page__procent-info-item-text">усвоенного материала</span>
                            </div>
                        </div>
                        <div class="course-page__link-to">
                            <a class="link">Продолжить обучение</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_template_part( '/core/views/home/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
