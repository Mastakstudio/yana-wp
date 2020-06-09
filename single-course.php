<?php
get_header();
get_template_part( '/core/views/headerView' );



if ( have_posts() ):
	while ( have_posts() ):
		the_post();
		$course = new Course( get_the_ID() );
		$sub_title = carbon_get_post_meta( get_the_ID(), PREFIX . 'subtitle' );
		?>
        <div class="course-page">
            <div class="container">
                <div class="course-page__inner">
                    <div class="course-page__content">
                        <span class="title title_blue"><?php the_title() ?></span>
                        <p class="text text_black"><?= $sub_title ?></p>
                    </div>
                    <div class="course-page__links">
						<?php secondMenuView() ?>
                    </div>
                </div>
            </div>
            <div class="course-page__wrapper">
                <img class="image" src="/wp-content/themes/Yana/src/icons/course-page.png"/>
            </div>
            <div class="container">
                <div class="course-page__list">
					<?php
					$parts = $course->getParts();
					if ( is_array( $parts ) && count( $parts ) ):
						/**@var CoursePart $part */
						foreach ( $parts as $part ) :
							?>
                            <div class="course-page__item">

                                <div class="course-page__content-item">
                                    <span class="course-page__title"><?= $part->getTitle() ?></span>
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
	                                            <?php $part->getPreviewDesc() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-page__info-item">
                                    <div class="course-page__title-info-item">
                                        <span>информация</span>
                                        <img class="course-page__button"
                                             src="/wp-content/themes/Yana/src/icons/button.png" alt=""
                                             role="presentation"/>
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
                                        <a class="link" href="<?= get_permalink( $part->getPart()->ID )?>" >Продолжить обучение</a>
                                    </div>
                                </div>

                            </div>
						<?php
						endforeach;
					endif;
					?>
                </div>
            </div>
        </div>
	<?php
	endwhile;
endif;
get_template_part( '/core/views/home/partners' );
get_template_part( '/core/views/footerView' );
get_footer();