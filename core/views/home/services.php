<?php
$links = home_page_services();
?>
<div class="services">
    <div class="services__wrapper">
    </div>
    <div class="container">
        <div class="services__inner">
            <div class="services__content">
                <span class="services__desc">Больше поддержки можно получить на</span>
                <span class="title title_white">Интерактивная карта беслпатных услуг для беременных</span>
                <p class="text text_black">
                    Выберите категорию необходимой поддержки и на экране появится интерактивная карта бесплатных услуг с выбранными организациями Минска или Могилева, Минской или Могилевской области
                </p>
            </div>

			<?php
			if ( $links->link_exist ) {
				echo '<div class="services__list">';
				foreach ( $links->links as $item ) {
					$img = wp_get_attachment_image_url( $item['img_id'], 'full' );
					?>
                    <a class="services__item" href="<?= esc_url( $item['link'] ) ?>">
                        <div class="services__item-container">
                            <img class="services__item-image" src="<?= $img ?>" alt="<?= $item['title'] ?>"/>
                        </div>
                        <SPAN class="services__item-title"><?= $item['title'] ?></SPAN>
                    </a>
				<?php }
				echo '</div>';
			}
			?>
        </div>
    </div>
    <div class="services__image-content">
        <img class="services__castle" src="/wp-content/themes/Yana/src/icons/town2.png" alt="" role="presentation"/>
        <img class="services__library" src="/wp-content/themes/Yana/src/icons/town.png" alt="" role="presentation"/>
    </div>
</div>