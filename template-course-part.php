<?php
/**
 * Template Name: course part
 * Template Post Type: course
 */

get_header();
get_template_part( '/core/views/headerView' );

global $post;
$nextPart = CourseManager::getNextPartLink($post);

$testResultManager = TestResultManager::getInstance();
$currentTestResult = $testResultManager::getCurrentTestResult();

if (!$currentTestResult->started){
    $startDate = new DateTime();
	$updateMetaArgs = [
        '_'.TEST_STARTED => true,
        '_'.TEST_START_TIME => $startDate->format('M d, Y G:i:s')
    ];
    $testResultManager::UpdateMeta($currentTestResult, $updateMetaArgs);
}



if ( have_posts() ):
	while ( have_posts() ):
		the_post();
		if ( $post->post_parent ) {
			$coursePart = new CoursePart( get_the_ID(), $post );
		}
		?>
        <div class="test" id="test-wrapper" data-test_id="<?= $coursePart->part->ID ?>">
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
                            <img class="test__dop-text-image" src="/wp-content/themes/Yana/src/icons/txt.svg" alt=""
                                 role="presentation"/>
                            <span>Текстовая версия раздела</span>
                            <img class="test__button" src="/wp-content/themes/Yana/src/icons/plus.svg" alt=""
                                 role="presentation"/>
                        </div>
                        <div class="test__dop-text-content">
                            <div class="experts__content">
								<?php the_content() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="test__wrapper">
                <div class="test__wrapper-inner"></div>
                <div class="container">
					<?php
                    if (!$currentTestResult->solved){
	                    $coursePart->getTest();
                    }else{
                        echo ' <div class="test__content"><span class="title title_blue">тестирование пройдено</span></div>';
                    }
					$coursePart->getAdditionalInfo();
					?>
                </div>

                <div class="modal__wrapper" id="modal_next_part">
                    <div class="modal__next_part">
                        <h2><?= $nextPart['last']? 'Получить аттестат' : 'К следующей части' ?></h2>
                        <div class="btn__wrapper">
                            <span id="close_modal" class="btn btn-warning">Закрыть</span>
	                        <?php
                            $linkTo = !$nextPart['last'] ? get_permalink($nextPart['id']) : get_permalink(carbon_get_theme_option(TO_ACCOUNT_PAGE));
	                        echo '<a href="'.$linkTo.'" id="go_to_next" class="btn btn-primary">Перейти</a>';
	                        ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
	<?php
	endwhile;
endif;
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
