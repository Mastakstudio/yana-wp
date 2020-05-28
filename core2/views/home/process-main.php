<?php
$orderSteps = carbon_get_post_meta(get_the_ID(), PREFIX.'home_steps');
if (is_array($orderSteps) && !empty($orderSteps)):
?>
<div class="process-main">
	<div class="process">
		<div class="process__inner">
			<div class="container">
				<div class="process__heading"><span>Are you</span><span>&#32; ready &#32;</span><span>to order?</span></div>
			</div>
			<div class="process__swiper-container swiper-container">
				<div class="process__swiper-wrapper swiper-wrapper">
					<?php
					$counter = 1;
					foreach ($orderSteps as $orderStep) :
						$title = $orderStep['title'];
                        $content = $orderStep['content'];
                        $imgId = $orderStep['img_id'];
                        $imgUrl = wp_get_attachment_image_url($imgId, 'full');
						?><div class="process__swiper-slide swiper-slide">
							<div class="process__slide-inner">
								<div class="process__icon">
									<img class="process__icon-pic" src="<?=$imgUrl?>" alt="Icon"/>
								</div>
								<div class="process__title-inner">
									<div class="process__title-number"><?= $counter ?></div>
									<div class="process__title-description"><?=$title?></div>
								</div>
								<div class="process__description">
									<?= apply_filters("the_content", $content) ?>
								</div>
								<?php if($counter++ < 3) echo '<img class="process__image" src="/wp-content/themes/FalconGlen/src/icons/aar.7aaa16.png" alt="Icon" title=""/>' ;?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>