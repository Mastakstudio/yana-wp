<?php
if (!defined('ABSPATH')) exit();

?>
<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="header__info-cart header__info-item">
    <div class="header__info-cart-span">
        <img class="header__info-cart-image" src="<?= SRC_URL ?>images/user.svg" alt="account"/>
    </div>
</a>
