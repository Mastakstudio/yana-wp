<?php
$benefits = carbon_get_post_meta(get_the_ID(), PREFIX.'home_benefits');
if (is_array($benefits) && !empty($benefits)):
?>
<div class="benefits">
	<div class="benefits__inner">
		<div class="benefits__image">
			<img class="benefits__image-background" src="/wp-content/themes/FalconGlen/src/icons/benefits-background.f087b1.png" alt="Background" />
			<img class="benefits__image-bee" src="/wp-content/themes/FalconGlen/src/icons/flower.dc74fc.png" alt="Background" />
		</div>
		<div class="benefits__content">
			<div class="container">
				<img class="benefits__title" src="/wp-content/themes/FalconGlen/src/icons/benefits-title.ed70e3.png" alt="Background" />
				<div class="benefits__list">
					<?php foreach ($benefits as $benefit) :
						$title = $benefit['title'];
						$cont = $benefit['benefit_content'];
						$images = $benefit['images_list'];
						?><div class="benefits__item">
							<div class="benefits__item-content">
								<div class="benefits__item-content-title"><?=$title?></div>
								<div class="benefits__item-content-list">
									<?php foreach ($images as $image) {
										$img_url = wp_get_attachment_image_url($image['img_id'], 'full');
                                        echo "<img class='benefits__item-content-image' src='$img_url' alt='Background' />" ;
									}?>
								</div>
							</div>
							<span class="benefits__item-text"><?= apply_filters('the_content', $cont);?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif;