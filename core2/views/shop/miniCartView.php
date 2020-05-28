<?php
if ( ms_is_woocommerce_activated() ) :
	/**@var WC_Cart $cart*/
    $cart = WC()->cart;
?>
    <div class="container">
        <div class="header__cart-inner">
	<?= ajax_loader()?>
	<div class="container">
		<div class="header__cart-content">
			<div class="header__cart-content-text">
				<span class="header__cart-content-title">Cart</span>
				<div class="header__cart-content-close"></div>
			</div>
			<div class="header__cart-content-change">
				<div class="header__cart-content-metryc-inner" id="mini-cart-items-list">
					<?php if(! $cart->is_empty() ): $cartItems = sortCartItemsByParent( $cart->get_cart() ); ?>
						<div class="header__cart-content-metryc-content active">
							<?php foreach ($cartItems as $parentId => $product) : ?>
								<div class="header__cart-content-inner" data-parent-id="<?= $parentId ?>" id="parent-<?=$parentId?>">
									<span class="header__cart-content-title"><?= str_replace(["<br />","<br>"], " ", $product['name']) ?></span>
                                    <?php
                                    if ($product['stock_status'] == "onbackorder"){
	                                    $preorder_text = carbon_get_post_meta( $product['parentId'], PREFIX . 'preorder_text' );
	                                    if ( empty( $preorder_text ) ) {
		                                    $preorder_text = 'Fresh Season 2020 (July-August) pre-order now at 2019 prices!';
	                                    }
	                                    echo ' <span class="header__add-link">'.$preorder_text.'</span>';
                                    }


                                    foreach ($product['variations'] as $cart_item_key => $cart_item) {
										FgCartVariation($cart_item, $cart_item_key);
									}?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
                <div class="header__cart-order">
                    <div class="header__cart-order-content">
                        <span class="header__cart-order-total">Total:</span>
                        <span class="header__cart-order-price" id="cart-total"> <?= $cart->get_totals()['subtotal'] + $cart->get_totals()['subtotal_tax']?></span>
                        <span class="header__cart-order-price-name">&#160;<?= get_woocommerce_currency()?></span>
                    </div>
                    <div class="header__cart-order-buttons">
                        <a class="header__cart-order-button" id="continue" href="<?= get_permalink( wc_get_page_id( 'shop' ) ) ?>">Shop more</a>
                        <a class="header__cart-order-button" href="<?= wc_get_checkout_url() ?>">Checkout</a>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
    </div>
<?php endif;