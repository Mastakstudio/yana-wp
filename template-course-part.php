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
var_dump($post->post_parent);
    if ($post->post_parent) 

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
                    $coursePart->getTest();
	                $coursePart->getAdditionalInfo();
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
