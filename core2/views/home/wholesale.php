<?php
$link = carbon_get_post_meta(get_the_ID(), PREFIX.'wholesale_link');
$text = carbon_get_post_meta(get_the_ID(), PREFIX .'wholesale_link_text');
?>
<div class="wholesale">
    <div class="wholesale__inner">
        <div class="container">
			<img class="wholesale__blueberry1 wholesale__item" src="/wp-content/themes/FalconGlen/src/icons/blueberry1.099553.png" alt="Background"/>
			<img class="wholesale__blueberry2 wholesale__item" src="/wp-content/themes/FalconGlen/src/icons/blueberry2.20f340.png" alt="Background"/>
			<img class="wholesale__blueberry3 wholesale__item" src="/wp-content/themes/FalconGlen/src/icons/blueberry3.5b3ace.png" alt="Background"/>
			<img class="wholesale__blueberry4 wholesale__item" src="/wp-content/themes/FalconGlen/src/icons/blueberry4.d06d8f.png" alt="Background"/>
			<img class="wholesale__title" src="/wp-content/themes/FalconGlen/src/icons/wholesale-title.0d1861.png" alt="Background"/>
            <div class="wholesale__content">
				<span class="wholesale__text">Get detailed information by clicking on the link</span>
				<a class="wholesale__link" href="<?= empty($link)? "#" : get_permalink($link)?>"> <?= $text ?></a>
            </div>
        </div>
    </div>
</div>
