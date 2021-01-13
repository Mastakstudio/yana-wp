<?php
/**
 * Template name: faq doctor
 */
if (!defined('ABSPATH')) exit();

$subTitle = carbon_get_post_meta(get_the_ID(), PREFIX.'subtitle');
$questions = carbon_get_post_meta(get_the_ID(), PREFIX.'questions');

get_header();
get_template_part( '/core/views/headerView' );
?>
    <div class="page-banner">
        <div class="container">
            <div class="page-banner__inner">
                <div class="page-banner__content">
                    <span class="title title_blue"><?= get_the_title() ?></span>
                    <p class="text text_black"><?= $subTitle ?></p>
                </div>
                <div class="page-banner__links">
                    <?php 
                        $menuArgs = [
                            'theme_location' => 'second_menu',
                            'container' => false,
                            'menu_class' => 'links__inner',
                            'menu_id' => '',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                            'before' => '',
                            'after' => '',
                            'link_before' => '',
                            'link_after' => '',
                            'items_wrap' => '<div class="links"><ul id="%1$s" class="%2$s">%3$s</ul></div>',
                        ];
                    
                        if (has_nav_menu('second_menu'))
                            wp_nav_menu($menuArgs);
                    ?>
                </div>
            </div>
        </div>
        <div class="page-banner__wrapper">
            <img class="image" src="/wp-content/themes/Yana/src/icons/question.png"/>
        </div>
        <div class="container">
            <div class="page-banner__list">
				<?php
				if (is_array($questions) && count($questions) > 0):
					for ($i = 0; $i < count($questions); $i++):
						$question = $questions[$i]['question_text'];
						$answer = empty($questions[$i]['answer_text'])?'': apply_filters('the_content', $questions[$i]['answer_text']);;
						?>
                        <div class="page-banner__item">
                            <div class="page-banner__content-item">
                                <div class="page-banner__number"><?= $i+1 ?></div>
                                <span class="page-banner__title"><?= $question ?></span>
                                <img class="page-banner__button" src="/wp-content/themes/Yana/src/icons/plus.svg" alt="" />
                            </div>
                            <div class="page-banner__text-item">
                                <div class="editor-content"><?= $answer ?></div>
                            </div>
                        </div>
					<?php
					endfor;
				endif;
				?>
            </div>
        </div>
    </div>
<?php
get_template_part( '/core/views/question' );
get_template_part( '/core/views/services' );
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
