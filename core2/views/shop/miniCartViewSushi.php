<?php
?>
<div class="header__cart">
    <img class="header__cart-image c1" src="/wp-content/themes/prosushi-new/src/icons/cart.309de0.svg" alt="cart"/>
    <img class="header__cart-image c2 cl-image" src="/wp-content/themes/prosushi-new/src/icons/cartHov.12ee95.svg"
         alt="cart"/>
    <span class="header__menu__counter" id="header__menu__counter"><?= WC()->cart->get_cart_contents_count() ?></span>
    <div class="header__cart-content"  id="header__cart-content"
         data-price-all="<?= WC()->cart->get_totals()['subtotal'] ?>"
         data-weight-all="<?= WC()->cart->cart_contents_weight ?>">
        <div class="header__cart-content-list" id="header-mini-cart-content-list">
            <?php
            if (!WC()->cart->is_empty()) :
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                    /**@var WC_Product_Simple $_product */
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    $portion_value = carbon_get_post_meta($cart_item['product_id'], PREFIX . 'portion_value');

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                        $product_name = $_product->get_name();
                        $thumbnail = apply_filters(
                            'woocommerce_cart_item_thumbnail',
                            $_product->get_image('prosushi-cart-miniature', ['class' => 'header__cart-content-item-image-image']),
                            $cart_item,
                            $cart_item_key);
                        ?>
                        <div class="header__cart-content-item prosushi-mini-cart-item"
                             data-id="<?= $_product->get_id() ?>"
                             data-quantity="<?= $cart_item['quantity'] ?>"
                             data-price="<?= $_product->get_price() ?>"
                             data-step="<?= $portion_value ? '0.5' : '1' ?>"
                             data-total="<?= $_product->get_price() * $cart_item['quantity'] ?>"
                             data-weight="<?= $_product->get_weight() ?>"
                             data-totalWeight="<?= $_product->get_weight() * $cart_item['quantity'] ?>"
                             data-cart-item-key="<?= $cart_item_key ?>"
                        >
                            <a href="#" class="header__cart-content-item-close prosushi-remove-cart-item">
                                <img class="header__cart-content-item-close-image"
                                     src="/wp-content/themes/prosushi-new/src/icons/cl.af2e28.svg" alt="close"/>
                            </a>
                            <?php if (!empty($thumbnail)) : ?>
                                <div class="header__cart-content-item-image"><?php echo $thumbnail; ?></div>
                            <?php endif; ?>
                            <div class="header__cart-content-item-text">
                                <div class="header__cart-content-title"><?= $product_name ?></div>
                                <div class="header__cart-content-product">
                                    <div class="header__cart-content-number">
                                        <div class="header__cart-content-minus">–</div>
                                        <input class="header__cart-content-num" value="<?= $cart_item['quantity'] ?>" type="text"/>
                                        <div class="header__cart-content-plus">+</div>
                                    </div>
                                    <div class="header__cart-content-price">
                                        <span class="price-item"><?= $_product->get_price() * $cart_item['quantity'] ?></span>
                                        <span> by</span>
                                        <span>/</span>
                                        <span class="gramm-item"><?= $_product->get_weight() * $cart_item['quantity'] ?></span>
                                        <span>г</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;
                endforeach;
            endif;
            ?>
        </div>
        <div class="header__cart-content-width">
            <div class="header__cart-content-width-text">
                <span class="price-total"><?= WC()->cart->get_totals()['subtotal'] ?></span>
                <span> by</span>
                <span>/</span>
                <span class="gram-total"><?= WC()->cart->cart_contents_weight ?></span>
                <span>г</span>
            </div>
            <a class="header__cart-content-width-link" href="<?= wc_get_page_permalink('checkout') ?>">
                <span><?php echo('View shopping cart')?></span>
            </a>
        </div>
    </div>
</div>
