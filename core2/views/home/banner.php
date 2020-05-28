<?php
$link = carbon_get_post_meta(get_the_ID(), PREFIX .'banner_link');
$text = carbon_get_post_meta(get_the_ID(), PREFIX .'banner_link_text');
?>

<div class="banner">
    <div class="banner__banner-image">
    </div>
    <div class="container">
        <div class="banner__inner">
			<img class="banner__bush-first" src="/wp-content/themes/FalconGlen/src/icons/kust1.4ea9e5.png" alt="Background"/>
			<img class="banner__bush-second" src="/wp-content/themes/FalconGlen/src/icons/kust2.4ea9e5.png" alt="Background"/>
			<img class="banner__blueberries banner__blueberries banner__blueberries_active" src="/wp-content/themes/FalconGlen/src/icons/blue.6203c8.png" alt="Background"/>
            <div class="banner__content">
                <h1 class="banner__title">
					<strong>Premium</strong> quality
					<br>
					<strong> organic</strong> products
                </h1><span class="banner__subtitle">from our farm to your table</span>
                <a class="banner__more" href="<?= empty($link)? "#" : get_permalink($link) ?>"><span> <?= $text ?></span></a>
            </div>
        </div>
    </div>
</div>