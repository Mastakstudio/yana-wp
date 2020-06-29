<?php
if (!defined('ABSPATH')) exit();
get_header();
get_template_part( '/core/views/headerView' );

global $post;
$userManager = UserManager::getInstance();
$user        = $userManager->GetCurrentUser();
$login_page = carbon_get_theme_option(PREFIX . 'login_page');

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
					if ( !$user->IsAuthorized() ):
						echo '<span class="course-page__title">Курс только для зарегистрированных пользователей</span>';
					?>
                        <div class="tags__wrap-text" id="link_to_reg">
							<?php
							if ( !$user->IsAuthorized() ) {
								if (isset($login_page) || empty($login_page) ){?>
                                    <a class="link" href="<?= get_permalink($login_page) ?>?login">Войти</a>
                                    <a class="link" href="<?= get_permalink($login_page) ?>?registration">Зарегистрироваться</a>
								<?php }
							} ?>
                        </div>
                    <?php
					else:
                        $course->getPartsViewByUserRole($user);
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
