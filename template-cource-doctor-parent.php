<?php
/**
 * Template name: course doctor parent
 * Template Post Type: course
 */
if (!defined('ABSPATH')) exit();

$subTitle = carbon_get_post_meta(get_the_ID(), PREFIX.'subtitle');
$questions = carbon_get_post_meta(get_the_ID(), PREFIX.'questions');

get_header();
get_template_part( '/core/views/headerView' );
?>

<div class="doctors">
        <div class="container">
          <div class="doctors__inner">
            <div class="doctors__links">
              <div class="links">
                <div class="links__inner">
                  <a class="links__item links__item links__item_active" target="_blank" href="">Пройти курс</a>
                  <a class="links__item" target="_blank" href="/faq222/">ВОПРОС-ОТВЕТ</a>
                  <a class="links__item" target="_blank" href="/account/">Профиль</a>
                </div>
              </div>
            </div>
            <div class="doctors__content"><span class="title title_blue">Онлайн курс </span>
              <p class="text text_black"><?php the_title();?></p>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="doctors__list-inner">
            <div class="doctors__list-item"><span class="doctors__list-item-title">Цель курса:</span>
              <div class="doctors__list-item-text">
                <?php
                 echo carbon_get_post_meta(get_the_ID(), 'course_aim');
                ?>
              </div>
            </div>
            <div class="doctors__list-item"><span class="doctors__list-item-title">Целевая группа курса (специалисты помогающих профессий):</span>
              <div class="doctors__list-item-content">
                <?php
                  $groups = carbon_get_post_meta(get_the_ID(), 'course_aim_groups');
                  foreach($groups as $group):
                ?>
                <div class="doctors__list-item-content-type">
                  <img class="doctors__list-item-content-image" src="/wp-content/themes/Yana/src/icons/c.svg" alt="" role="presentation"/>
                  <div class="doctors__list-item-content-dop"><?php echo $group['text'];?>
                  </div>
                </div>
                <?php
                  endforeach;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="doctors__wrapper">
          <IMG class="image" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"></IMG>
        </div>
        <div class="doctors__list">

          <?php
            $parts = get_posts(array(
              'post_status' => 'publish',
              'post_type' => 'course',
              'orderby' => 'publish_date',
              'order' => 'DESC',
              'numberposts' => -1,
              'post_parent' => get_the_ID()
            ));

            foreach($parts as $part):
          ?>
          <div class="doctors__item">
            <div class="doctors__item-wrapper">
            <img class="doctors__item-image" src="<?php echo get_the_post_thumbnail_url($part->ID,'full'); ?>" alt="" role="presentation"/>
            
              <div class="doctors__item-wrapper-content">
                <span class="doctors__item-title"><?php echo get_the_title($part->ID); ?></span>
                <span class="doctors__item-desc"><?php echo carbon_get_post_meta($part->ID, COURSE_SUBTITLE); ?></span>
              </div>
            </div>
            <div class="container">
              <div class="doctors__item-types">
                <?php 
                  $types = carbon_get_post_meta($part->ID, COURSE_PREVIEW_DESC)[0]['yana_preview_desc'];
                  if($types):
                    foreach($types as $type):
                ?>
                <div class="doctors__item-types-content">
                  <SPAN>
                    <?php
                      echo $type['text'];
                    ?>
                  </SPAN>
                </div>
                <?php
                    endforeach;
                  endif;
                ?>
              </div><a class="doctors__item-button" href="<?php echo get_permalink($part->ID); ?>">
              <SPAN>Перейти к изучению материала</SPAN></a>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
      

<?
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
