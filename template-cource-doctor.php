<?php
/**
 * Template name: course doctor
 * Template Post Type: course
 */
if (!defined('ABSPATH')) exit();

$subTitle = carbon_get_post_meta(get_the_ID(), PREFIX.'subtitle');
$questions = carbon_get_post_meta(get_the_ID(), PREFIX.'questions');

get_header();
get_template_part( '/core/views/headerView' );
?>


<div class="doctor-test">
  <div class="doctor-test__inner">
    <IMG class="image" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"></IMG>
    <div class="container">
      <div class="doctor-test__head">
        <div class="doctor-test__head-text"><a class="doctor-test__desc-text" href="#">вернуться ко всем темам</a>
        <span class="title title_blue"><?php echo get_the_title(get_the_ID()); ?></span>
          <p class="text text_black"><?php echo carbon_get_post_meta(get_the_ID(), COURSE_SUBTITLE); ?></p>
        </div>
        <div class="doctor-test__list-inner">
          <div class="doctor-test__list-item"><span class="doctor-test__list-item-title">Цель курса:</span>
            <div class="doctor-test__list-item-text">
             <?php echo carbon_get_post_meta(get_the_ID(), 'course_aim'); ?>
            </div>
          </div>
          <div class="doctor-test__list-item"><span class="doctor-test__list-item-title">Целевая группа курса (специалисты помогающих профессий):</span>
            <div class="doctor-test__list-item-content">
                <?php
                  $groups = carbon_get_post_meta(get_the_ID(), 'course_aim_groups');
                  foreach($groups as $group):
                ?>
                <div class="doctors__list-item-content-type"><img class="doctors__list-item-content-image" src="/wp-content/themes/Yana/src/icons/c.svg" alt="" role="presentation"/>
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
    </div>
  </div>
  <div class="doctor-test__wrapper">
    <div class="doctor-test__wrapper-inner">
      <div class="container">
        <div class="doctor-test__wrap">
          <div class="doctor-test__head-list">
            <span class="doctor-test__head-list-title">Материалы для ознакомления</span>
            <?php 
              $materials = carbon_get_post_meta(get_the_ID(), COURSE_MAIN_INFO);
              $count = 0;
              foreach($materials as $material):
                $type=$material['_type'];
                $text=$material['text'];

                if($type=='video'):
                  $youtube_link=$material['youtube_link'];
                  $count++;
            ?>
            <a class="doctor-test__head-item test__video" href="#modal<?php echo $count;?>">
              <IMG src="/wp-content/themes/Yana/src/icons/play-video.svg"></IMG>
              <div class="doctor-test__head-item-content">
                <span class="doctor-test__head-item-text"><?php echo $text;?></span>
                <span class="doctor-test__head-item-link">(видео)</span>
                <div class="popup">
                  <div class="remodal" data-remodal-id="modal<?php echo $count;?>">
                    <button class="remodal-close" data-remodal-action="close"></button>
                    <iframe class="youtube-video" width="100%" height="100%" src="<?php echo $youtube_link; ?>" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                  </div>
                </div>
              </div>
            </a>
            <?php
                endif;
                if($type=='link'):
                  $link=$material['link'];
                  $count++;
            ?>
            <a class="doctor-test__head-item test__pdf" href="<?php echo $link; ?>">
              <IMG src="/wp-content/themes/Yana/src/icons/pd.svg"></IMG>
              <div class="doctor-test__head-item-content">
                <span class="doctor-test__head-item-text"><?php echo $text;?></span>
                <span class="doctor-test__head-item-link">(инфографика)</span>
              </div>
            </a>
            <?php
                endif;
              endforeach;
            ?>

            
          </div>
          <div class="doctor-test__dop-text">
            <div class="doctor-test__dop-text-title"><img class="doctor-test__dop-text-image" src="/wp-content/themes/Yana/src/icons/txt.svg" alt="" role="presentation"/>
              <div class="doctor-test__dop-text-content">
                <span class="doctor-test__dop-text-content-title">Текстовая версия раздела</span>
                <span class="doctor-test__dop-text-content-desc">улучшение качества поддержки беременных женщин и женщин с детьми в трудной жизненной ситуации посредством совершенствования гибких (мягких, soft) навыков специалистов помогающих профессий.</span>
                <a class="doctor-test__dop-text-content-link" href="">подробнее</a>
              </div>
            </div>
          </div>
          <div class="doctor-test__resource"><span class="doctor-test__resource-title">Дополнительные ресурсы:</span>
            <div class="doctor-test__resource-list">
              <?php
                $resources = carbon_get_post_meta(get_the_ID(), COURSE_ADDITIONAL_INFO);
                foreach($resources as $resource):
              ?>
              <div class="doctor-test__resource-item">
                <span class="doctor-test__resource-item-name"><?php echo $resource['text'] ?></span>
                  <?php
                    $links = $resource['links'];
                    foreach($links as $link):
                  ?>
                  <a class="doctor-test__resource-item-link" href=""><?php echo $link['text'] ?></a>
                  <?php
                    endforeach;
                  ?>
              </div>
              <?php
                endforeach;
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      

<?
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
