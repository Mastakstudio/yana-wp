<?php
/**
 * Template name: faq
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
                            if(carbon_get_post_meta(get_the_ID(), 'faq_association')[0]['id']!=null){?>
                    <div class="links">
                        <div class="links__inner">
                            <a class="links__item" href="<?php echo get_permalink(carbon_get_post_meta(get_the_ID(), 'faq_association')[0]['id']); ?>">Пройти курс</a>
                            <a class="links__item links__item links__item_active" href="/faq222/">ВОПРОС-ОТВЕТ</a>
                            <a class="links__item" href="/account/">Профиль</a>
                        </div>
                    </div>
                    <?}else{ secondMenuView(); } ?>
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
