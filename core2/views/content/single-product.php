<?php
/**@var WeightConverter $weightConverter*/
/**@var WC_Product_Variable $product*/
$weightConverter = WeightConverter::getInstance();
global $product;

$available_variations = $product->get_available_variations();
$delivery = carbon_get_post_meta(get_the_ID(),'steps');

$text_under_the_order_button = carbon_get_post_meta(get_the_ID(), PREFIX .'text_under_the_order_button');

$gallery = [];
$imgsIds = $product->get_gallery_image_ids();
if (!empty($imgsIds))
	foreach ($imgsIds as $imgsId) {
		$gallery[] = wp_get_attachment_image_url( $imgsId, 'product-gallery' );
	}
?>
<div class="product">
	<div class="container">
		<div class="product__inner">
			<h1 class="product__title"><?= $product->get_title() ?></h1>
			<div class="product__content">
				<div class="product__wrapper-inner">
					<div class="product__cart-content-change-text">
<!--						<div class="product__cart-content-change-text-inner">-->
<!--							<div class="product__cart-content-currency-chose">Choose currency</div>-->
<!--							<div class="product__cart-content-currency">--><?//= fg_currency_selector() ?><!--</div>-->
<!--						</div>-->
						<?php WeightConverter::weightToggleView('product'); ?>
					</div>
					<div class="product__cart-content-metryc-inner">
						<div class="product__cart-content-metryc-content active">
							<div class="product__list">
								<div class="product__item" data-product-id="<?=$product->get_id()?>">
									<div class="product__wrapper">
										<div class="product__item-list">
											<?php if (count($available_variations) > 0):
												variationsView($available_variations, 'product');
											?>
												<div class="product__add">
													<div class="product__cart-order">
														<div class="product__cart-order-content">
															<span class="product__cart-order-total">Total:</span>
															<span class="product__cart-order-price"> 0</span>
															<span class="product__cart-order-price-name">&#160;<?= get_woocommerce_currency()?></span>
														</div>
													</div>
                                                    <?php
                                                    if ($product->get_stock_status() == "onbackorder"){
	                                                    $preorder_text = carbon_get_post_meta( $product->get_id(), PREFIX . 'preorder_text' );
	                                                    if ( empty( $preorder_text ) ) {
		                                                    $preorder_text = 'Fresh Season 2020 (July-August) pre-order now at 2019 prices!';
	                                                    }
	                                                    echo '<span class="product__add-link">'.$preorder_text.'</span>';
	                                                    ?>
                                                        <?php if (isset($text_under_the_order_button) && !empty($text_under_the_order_button) ):?>
                                                            <div class="product__dop-text product__dop-text product__dop-text_mobile">
                                                                <img class="product__dop-text-image" src="/wp-content/themes/FalconGlen/src/icons/vosk.339f6b.svg" alt="Background" title=""/>
                                                                <span class="product__dop-text-content"><?= $text_under_the_order_button ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php
                                                    }
                                                    ?>
													<div class="product__more ms_add_to_cart ms_add_to_cart" style="position: relative;">
														<span>Add to cart</span>
														<?= ajax_loader() ?>
													</div>
												</div>
											<?php else: ?>
												<div class="products__cart-item">
													<div class="products__cart-item-content">
														<span class="product__cart-item-content-title">no product</span> 
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <?php if (isset($text_under_the_order_button) && !empty($text_under_the_order_button) ):?>
                    <div class="product__dop-text product__dop-text product__dop-text_desktope">
                        <img class="product__dop-text-image" src="/wp-content/themes/FalconGlen/src/icons/vosk.339f6b.svg" alt="Background" title=""/>
                        <span class="product__dop-text-content"><?= $text_under_the_order_button ?></span>
                    </div>
                    <?php endif; ?>
				</div>
				<div class="product__gallery">
					<div class="product__swiper-container swiper-container">
						<div class="product__swiper-wrapper swiper-wrapper">
							<?php if (!empty($gallery)): foreach ($gallery as $item) :
								echo "<img class='product__swiper-slide swiper-slide' src='$item' alt='Background'/>";
							endforeach; endif; ?>
						</div>
                        <div class="product__swiper-pagination swiper-pagination"></div>
					</div>
				</div>
			</div>
			<?php if (is_array($delivery) && count($delivery) > 0): $counter = 1; ?>
				<div class="product__wrapper">
					<span class="product__wrapper-title">Pickup and delivery</span>
					<div class="product__wrapper-list">
						<?php foreach ($delivery as $step) :
							$step_title = $step['title'];
							?>
							<div class="product__wrapper-item">
								<div class="product__wrapper-item-title">
									<span class="product__wrapper-item-title-number"><?= $counter++ ?></span>
									<span class="product__wrapper-item-title-text"><?= $step_title ?></span>
								</div>
								<?php if (is_array($step['rows']) && count($step['rows']) > 0) :?>
								<div class="product__wrapper-item-content">
									<?php foreach ($step['rows'] as $row) {
										if ($row["_type"] === 'regular')
											printf("<span class=\"product__wrapper-item-content-text\">%s</span>", $row['text']);
										elseif ($row["_type"] === 'bold')
											printf("<span class=\"product__wrapper-item-content-title\">%s</span>", $row['text']);
										elseif ($row["_type"] === 'with_dots')
											printf("<span class=\"product__wrapper-item-content-text\">•	%s</span>", $row['text']);
									}?>
								</div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="product__about">
		<div class="container">
			<div class="product__about-wrapper">
				<img class="product__blur-image1" src="/wp-content/themes/FalconGlen/src/icons/image1.53e6c4.png" alt="Background"/>
				<img class="product__blur-image2" src="/wp-content/themes/FalconGlen/src/icons/image2.20f340.png" alt="Background"/>
				<img class="product__blur-image3" src="/wp-content/themes/FalconGlen/src/icons/image3.206a47.png" alt="Background"/>
				<img class="product__blur-image4" src="/wp-content/themes/FalconGlen/src/icons/image4.341786.png" alt="Background"/>
				<img class="product__blur-image5" src="/wp-content/themes/FalconGlen/src/icons/image5.d06d8f.png" alt="Background"/>
				<?php if (strlen($product->get_description()) > 0 ): ?>
						<span class="product__wrapper-title">About</span>
						<div class="product__about-text editor"><?php the_content();?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>