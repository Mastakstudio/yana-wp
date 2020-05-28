<?php
$link = carbon_get_post_meta(get_the_ID(), PREFIX.'about_link');
$text = carbon_get_post_meta(get_the_ID(), PREFIX .'about_link_text');
$subtitle = carbon_get_post_meta(get_the_ID(), PREFIX.'home_about_subtitle');
$content = carbon_get_post_meta(get_the_ID(), PREFIX.'home_about_content');
?>
<div class="about-main">
	<div class="about-main__inner">
		<div class="about-main__container">
			<div class="container">
				<img class="about-main__title" src="/wp-content/themes/FalconGlen/src/icons/about-main-title.be7e20.png" alt="Background"/>
			</div>
			<div class="about-main__outer">
				<div class="about-main__wrapper">
					<div class="container">
						<span class="about-main__description"><strong>We</strong> proudly grow</span>
						<span class="about-main__text"><?= $subtitle ?></span>
						<span class="about-main__subtext"><?= $content ?></span>
						<a class="about-main__more" href="<?= empty($link)? "#" : get_permalink($link) ?>"><span> <?= $text ?></span></a>
					</div>
				</div>
				<div class="about-main__image">
					<img class="about-main__image-back" src="/wp-content/themes/FalconGlen/src/icons/about-main.56b626.png" alt="Background"/>
					<img class="about-main__image-men" src="/wp-content/themes/FalconGlen/src/icons/about-men.13fedb.png" alt="Background"/>
				</div>
			</div>
		</div>
	</div>
</div>