<?php
get_header();
get_template_part( '/core/views/headerView' );

global $post;
$userManager = UserManager::getInstance();
/**@var $user CustomUser*/
$user        = $userManager::GetCurrentUser();

if ( have_posts() ):
	while ( have_posts() ):
		the_post();
		$course    = new Course( get_the_ID(), $post );
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

					if ( $user::UserIsAuthorized() ):
						echo '<span class="course-page__title">Курс только для зарегисстрированных пользователей</span>';
					else:
                        $course->getPartsView();
					endif;
					?>
                </div>
            </div>
        </div>
	<?php
	endwhile;
endif;
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
