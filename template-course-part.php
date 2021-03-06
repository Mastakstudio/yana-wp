<?php
/**
 * Template Name: course part
 * Template Post Type: course
 */
if (!defined('ABSPATH')) exit();
session_start();
$userManager = UserManager::getInstance();
$user = $userManager->GetCurrentUser();
// if (! $user->IsAuthorized()){
// 	$userManager->RedirectToSignIn();
// }


get_header();
get_template_part( '/core/views/headerView' );

global $post;
$nextPart = CourseManager::getNextPartLink($post);
$testResultManager = TestResultManager::getInstance();
$currentTestResult = $testResultManager::getCurrentTestResult();

$coursePart = new CoursePart( get_the_ID(), $post );

if (!$currentTestResult->started)
    $testResultManager->startTest($currentTestResult, $coursePart->getTestTimeLimit());


if ( have_posts() ):
	while ( have_posts() ):
        the_post();
		if ( $post->post_parent ) {
		}
		?>
        <div class="test" id="test-wrapper" data-test_id="<?= $coursePart->part->ID ?>">
            <div class="container">
                <div class="test__inner">
                    <div class="test__head">
                        <div class="test__head-text">
                            <span class="test__theme">тема занятия  </span>
                            <span class="title title_blue"><?= the_title() ?></span>
                            <a class="test__desc-text" href="<?= get_permalink($post->post_parent)?>">вернуться ко всем темам</a>

                            <p class="text text_black visible"><?= $coursePart->getSubtitle() ?></p>
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
            <?php if(carbon_get_post_meta( get_the_ID(), 'course_audio' )!=null): ?>
            <div class="header__switch container">
                <label class="lbl-off" for="switch-orange">Off</label>
                <input class="switch test_audio_button" id="switch-orange" type="checkbox">
                <label class="lbl-on" for="switch-orange">On</label>
            </div>
            <script>
                var audio = new Audio(); 
                audio.src = '<?php echo carbon_get_post_meta( get_the_ID(), 'course_audio' ); ?>'; 
                audio.autoplay = true; 
                document.querySelector('.test_audio_button').onclick = function(){
                    if(this.checked){
                        audio.play(); 
                    }else{
                        audio.pause(); 
                    }   
                }

            </script>
            <?php endif; ?>
            <div class="test__wrapper">
                <div class="test__wrapper-inner"></div>
                <div class="container">
					<?php
                    $coursePart->getTest();
                    $coursePart->getAdditionalInfo();
                    ?>
                </div>
            </div>
        </div>
	<?php
	endwhile;
endif;
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/remodals' );
get_template_part( '/core/views/footerView' );
get_footer();
