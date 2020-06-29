<?php
$expert_video  = home_page_experts_video();
?>

<div class="experts">
    <div class="experts__inner">
        <div class="container">
            <div class="experts__content">
                <span class="title title_blue">МНЕНИЯ ЭКСПЕРТОВ</span>
                <p class="text text_black">
                    Наша команда провела более 50-ти интервью и документальных съёмок с
                    экспертами в области акушерства и гинекологии, неонатологии, педиатрии, психологиии и
                    педагогики, юриспруденции.
                </p>
            </div>
            <img class="experts__logo" src="/wp-content/themes/Yana/src/icons/logo-dop.png" alt="" role="presentation"/>
        </div>
        <div class="experts__text">
            <div class="container">
                <div class="experts__video_wrapper">
                    <div class="experts__video">
                        <div class="experts__video_inner">
	                        <?php if ($expert_video->link_exist):?>
                            <a class="experts__video_link" href="#modal-experts">
                                <img src="/wp-content/themes/Yana/src/icons/experts-arrow.png" alt="">
                                <span>смотреть</span>
                            </a>
	                        <?php   endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <img class="experts__girl-business" src="/wp-content/themes/Yana/src/icons/girl-business.png" alt="" role="presentation"/>
        </div>
    </div>
	<?php if ($expert_video->link_exist): ?>
    <div class="popup">
        <div class="remodal" data-remodal-id="modal-experts">
            <button class="remodal-close" data-remodal-action="close"></button>
            <iframe width="100%" height="100%" src="<?= esc_url($expert_video->link) ?>" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen=""></iframe>
        </div>
    </div>
	<?php endif; ?>
</div>