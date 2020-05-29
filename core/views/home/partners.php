<?php
$links = home_page_partners();

?>


<div class="partners">
    <div class="container">
        <div class="partners__inner">
            <div class="partners__container swiper-container">
                <div class="partners__wrapper swiper-wrapper">
	                <?php
	                if ( $links->link_exist ) {
		                foreach ( $links->links as $item ) {
			                $img = wp_get_attachment_image_url( $item['img_id'], 'full' );
			                ?>
                            <div class="partners__slide swiper-slide"  >
                                <img class="partners__image" src="<?= $img ?>" alt="<?= $item['title'] ?>"/>
                                <span class="partners__title"><?= $item['title'] ?></span>
                            </div>
		                <?php }
	                }
	                ?>
                </div>
                <div class="partners__button-prev swiper-button-prev"></div>
                <div class="partners__button-next swiper-button-next"></div>
            </div>
        </div>
    </div>
</div>