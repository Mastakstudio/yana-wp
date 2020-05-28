<?php

/**@var WC_Product_Variable $productParam */
function HomePageProductView( $productParam ) {
	$prefix = 'product-main';
	global $product;
	$product = $productParam;

	$imgId                = carbon_get_post_meta( $product->get_id(), PREFIX . 'card_image' );
	$prodImg              = wp_get_attachment_image_url( $imgId, 'full' );
	$available_variations = $product->get_available_variations();
	?>
    <div class="<?= $prefix ?>__item" data-product-id="<?= $product->get_id() ?>"
         id="home-prod-<?= $product->get_id() ?>">
        <div class="product-main__item-image" style="background-image:url(<?= $prodImg ?>)"></div>
        <span class="<?= $prefix ?>__item-titile"><?= $product->get_name() ?></span>
        <a class="<?= $prefix ?>__item-link" href="<?= $product->get_permalink() ?>">Learn more</a>
        <div class="<?= $prefix ?>__item-more ms_add_to_cart">
            <img class="<?= $prefix ?>__item-more-plus" src="/wp-content/themes/FalconGlen/src/icons/plus1.8f3027.png"
                 alt="Background" title=""/>
            <span class="<?= $prefix ?>__item-more-text ">Add to cart</span>
			<?= ajax_loader() ?>
        </div>
        <div class="<?= $prefix ?>__cart-content">
            <div class="<?= $prefix ?>__item-close"></div>
            <div class="<?= $prefix ?>__cart-content-change">
				<?php if ( count( $available_variations ) > 0 ): ?>
                    <div class="<?= $prefix ?>__cart-content-metryc-inner">
                        <div class="<?= $prefix ?>__cart-content-metryc-content active">
							<?php if ( count( $available_variations ) > 0 ) {
								variationsView( $available_variations, $prefix );
							} ?>
                        </div>
                    </div>
                    <div class="<?= $prefix ?>__cart-order">
                        <div class="<?= $prefix ?>__cart-order-content">
                            <span class="<?= $prefix ?>__cart-order-total">Total:&#160;</span>
                            <span class="<?= $prefix ?>__cart-order-price">0</span>
                            <span class="<?= $prefix ?>__cart-order-price-name">&#160;<?= get_woocommerce_currency() ?></span>
                        </div>
						<?php if ( $product->get_stock_status() === 'onbackorder' ) {
							$preorder_text = carbon_get_post_meta( $product->get_id(), PREFIX . 'preorder_text' );
							if ( empty( $preorder_text ) ) {
								$preorder_text = 'Fresh Season 2020 (July-August) pre-order now at 2019 prices!';
							}
							echo '<a class="product-main__add-link">'.$preorder_text.'</a>';
						}
						?>
                    </div>
				<?php else: ?>
                    <div class="<?= $prefix ?>__cart-order">
                        <div class="<?= $prefix ?>__cart-order-content">
                            <span class="<?= $prefix ?>__cart-order-total">no product</span>
                        </div>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
	<?php
}

function ArchiveProductMetricSystem() {
	$prefix = 'products';
	global $product;
	$imgId                = carbon_get_post_meta( $product->get_id(), PREFIX . 'card_archive_image' );
	$prodImg              = wp_get_attachment_image_url( $imgId, 'full' );
	$available_variations = $product->get_available_variations();
	?>
    <div class="<?= $prefix ?>__item" data-product-id="<?= $product->get_id() ?>">
        <div class="<?= $prefix ?>__wrapper">
            <div class="<?= $prefix ?>__item-inner" style="background-image:url(<?= $prodImg ?>)">
                <div class="<?= $prefix ?>__item-title"><?= $product->get_name() ?></div>
                <a class="<?= $prefix ?>__item-more" href="<?= $product->get_permalink() ?>"><span>Learn more</span></a>
            </div>
            <div class="<?= $prefix ?>__item-list">
				<?php if ( count( $available_variations ) > 0 ):
					variationsView( $available_variations, $prefix ); ?>
                    <div class="products__add">
						<?php if ( $product->get_stock_status() == "onbackorder" ):
							$preorder_text = carbon_get_post_meta( $product->get_id(), PREFIX . 'preorder_text' );
							if ( empty( $preorder_text ) ) {
								$preorder_text = 'Fresh Season 2020 (July-August) pre-order now at 2019 prices!';
							}
							?>
                            <span class="products__add-link"><?= $preorder_text ?></span>
						<?php else: ?>
                            <div class="products__cart-order">
                                <div class="products__cart-order-content">
                                    <span class="products__cart-order-total">Total:</span>
                                    <span class="products__cart-order-price"> 0</span>
                                    <span class="products__cart-order-price-name"> <?= get_woocommerce_currency_symbol() ?></span>
                                </div>
                            </div>
						<?php endif; ?>
                        <div class="<?= $prefix ?>__more ms_add_to_cart" style=" position: relative; ">
                            <span>Add to cart</span>
							<?= ajax_loader() ?>
                        </div>
                    </div>
				<?php else: ?>
                    <div class="<?= $prefix ?>__cart-item">
                        <div class="<?= $prefix ?>__cart-item-content">
                            <span class="<?= $prefix ?>__cart-item-content-title">no product</span>
                        </div>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
	<?php
}

function FgMiniCartItemAjaxView( $data ) {
	/**@var WC_Cart $cart */
	$cart = WC()->cart;
	if ( $data['generate_parent_wrapper'] ) {
		echo "<div class=\"header__cart-content-inner\" data-parent-id=\"" . $data['product_id'] . "\"  id=\"parent-" . $data['product_id'] . "\">";
		echo "<span class=\"header__cart-content-title\">" . str_replace( [
				"<br />",
				"<br>"
			], " ", $data['product_name'] ) . "</span>";
	}
	foreach ( $data['variations'] as $cart_item_key ) {
		$cart_item = $cart->get_cart_item( $cart_item_key );
		FgCartVariation( $cart_item, $cart_item_key );
	}
	if ( $data['generate_parent_wrapper'] ) {
		echo '</div>';
	}
}

function FgCartVariation( $cart_item, $cart_item_key ) {
	$prefix = 'header';
	/**@var WeightConverter $weightConverter */
	$weightConverter = WeightConverter::getInstance();
	/**@var WC_Product_Variable $_product */
	$_product          = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) :
		$quantity = $cart_item['quantity'];
		$price         = wc_get_price_to_display( $_product );
		$line_subtotal = $price * $quantity;
		$id            = $_product->get_id();

		$ConverterArgs = [
			'weight'             => $_product->get_weight(),
			'second_weight_val'  => get_post_meta( $id, 'second_weight_val', true ),
			'second_weight_unit' => get_post_meta( $id, 'second_weight_unit', true ),
			'first_weight_unit'  => get_post_meta( $id, 'first_weight_unit', true )
		];

		$weight = $weightConverter->getCurrentWeight( $ConverterArgs );

		$packaging_type = get_post_meta( $id, 'product_packaging_type', true );
		$packaging_type = ! empty( $packaging_type ) ? $packaging_type : 'N/A';
		?>
        <div class="<?= $prefix ?>__cart-item"
             id="cart-item-key-<?= $cart_item_key ?>"
             data-price="<?= $price ?>"
             data-quantity="<?= $quantity ?>"
             data-total="<?= $line_subtotal ?>"
             data-variation-id="<?= $id ?>"
             data-cart-item-key="<?= $cart_item_key ?>">
            <div class="<?= $prefix ?>__cart-item-close"></div>
            <div class="<?= $prefix ?>__cart-item-content">
				<span class="<?= $prefix ?>__cart-item-content-title">
					<span class="variation-weight"
                          data-weight='<?= $weightConverter->jsonWeightVariation( $ConverterArgs ) ?>'>
						<?= $weight ?>
					</span>
					<span>/&#160;<?= $packaging_type ?></span>
				</span>
                <span class="<?= $prefix ?>__cart-item-content-price-total">
					<span class="<?= $prefix ?>__cart-item-content-price real-price"><?= $line_subtotal ?></span>
					<span class="<?= $prefix ?>__cart-item-content-price"><?= get_woocommerce_currency() ?></span>
				</span>
            </div>
            <div class="<?= $prefix ?>__cart-item-cost">
                <span class="<?= $prefix ?>__cart-item-minus">–</span>
                <input class="<?= $prefix ?>__cart-item-number" type="number" readonly="readonly"
                       value="<?= $quantity ?>" placeholder="0"/>
                <span class="<?= $prefix ?>__cart-item-plus">+</span>
            </div>
        </div>
	<?php endif;
}

function variationsView( $available_variations, $prefix ) {
	/**@var WeightConverter $weightConverter */
	$weightConverter = WeightConverter::getInstance();

	foreach ( $available_variations as $available_variation ) :
//        if (!$available_variation['is_in_stock']) continue; 
//        var_dump($available_variation);

		$variation_id = $available_variation['variation_id'];
		$price       = $available_variation['display_price'];

		$weight = $weightConverter->getCurrentWeight( $available_variation );

		$packaging_type = $available_variation['product_packaging_type'];
		$packaging_type = ! empty( $packaging_type ) ? $packaging_type : 'N/A';
		?>
        <div class="<?= $prefix ?>__cart-item"
             data-price="<?= $price ?>"
             data-quantity="0"
             data-total="0"
             data-variation-id="<?= $variation_id ?>">
            <div class="<?= $prefix ?>__cart-item-content">
				<span class="<?= $prefix ?>__cart-item-content-title">
					<span class="variation-weight"
                          data-weight='<?= $weightConverter->jsonWeightVariation( $available_variation ) ?>'>
						<?= $weight ?>
					</span>
					<span>/&#160;<?= $packaging_type ?></span>
				</span>
                <span class="<?= $prefix ?>__cart-item-content-price-total price-currency">
					<span class="<?= $prefix ?>__cart-item-content-price price"><?= $price ?></span> <span
                            class="<?= $prefix ?>__cart-item-content-price currency"><?= get_woocommerce_currency() ?></span>
				</span>
            </div>
            <div class="<?= $prefix ?>__cart-item-cost">
				<?php if ( $available_variation['is_in_stock'] ): ?>
                    <span class="<?= $prefix ?>__cart-item-minus">–</span>
                    <input class="<?= $prefix ?>__cart-item-number" type="number" readonly="readonly" value="0"
                           placeholder="0"/>
                    <span class="<?= $prefix ?>__cart-item-plus">+</span>
				<?php else: ?>
                    <span class="<?= $prefix ?>__cart-item-content-title">
                        <span class="<?= $prefix ?>__cart-order-total"
                              style="color: #7e7e7e"><?= $available_variation["availability_html"] ?></span>
                    </span>
				<?php endif; ?>
            </div>
        </div>
	<?php endforeach;
}