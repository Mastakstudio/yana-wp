<?php
$logo = carbon_get_theme_option(PREFIX.'main_logo');
$phone_number = carbon_get_theme_option(PREFIX.'phone_number');
$contact_email = carbon_get_theme_option(PREFIX.'contact_email');
$map = carbon_get_theme_option(PREFIX.'map_link');
?>
<div class="header" >
	<div class="header__back"></div>
	<div class="header__blur">
		<img class="header__blur-image1" src="/wp-content/themes/FalconGlen/src/icons/image1.53e6c4.png" alt="Background" />
		<img class="header__blur-image2" src="/wp-content/themes/FalconGlen/src/icons/image2.20f340.png" alt="Background" />
		<img class="header__blur-image3" src="/wp-content/themes/FalconGlen/src/icons/image3.206a47.png" alt="Background" />
		<img class="header__blur-image4" src="/wp-content/themes/FalconGlen/src/icons/image4.341786.png" alt="Background" />
		<img class="header__blur-image5" src="/wp-content/themes/FalconGlen/src/icons/image5.d06d8f.png" alt="Background" />
	</div>
	<div class="header__menu-inner">
		<div class="container">
			<div class="header__menu-close"><span></span><span></span></div>
            <?php get_template_part('/core/views/menu/mainMenuView');?>
		</div>
	</div>
    <?php get_template_part('/core/views/shop/miniCartView');?>
	<div class="container">
		<div class="header__inner">
			<?php if (!empty($logo)): ?>
				<a class="header__logo" href="/" id="menu">
					<img class="header__logo-image" src="<?= wp_get_attachment_image_url($logo, 'main-logo') ?>" alt="logo" />
				</a>
			<?php endif; ?>
			<div class="header__part">
				<div class="header__menu">
					<div class="header__menu-burger"><span></span><span></span></div>
				</div>
				<?php if (!empty($map)): ?>
					<a class="header__map" href="<?= esc_url($map)?>" target="_blank">
						<img class="header__map-image" src="/wp-content/themes/FalconGlen/src/icons/map.d15dee.svg" alt="Background" />
						<span>view on map</span>
					</a>
				<?php endif;
				if (!empty($phone_number)): ?>
					<a class="header__phone header__desctop" href="tel:<?=$phone_number?>">
						<img class="header__phone-image" src="/wp-content/themes/FalconGlen/src/icons/phone.c526f7.svg" alt="Background" />
						<span><?=$phone_number?></span>
					</a>
				<?php endif; ?>
			</div>
			<div class="header__part">
				<?php if (!empty($contact_email)): ?>
					<a class="header__mail" href="mailto:<?=$contact_email?>">
						<img class="header__mail-image" src="/wp-content/themes/FalconGlen/src/icons/mail.367161.svg" alt="Background" />
						<span><?=$contact_email?></span>
					</a>
				<?php endif;
				if (!empty($phone_number)): ?>
					<a class="header__phone header__mobile" href="tel:<?=$phone_number?>">
						<img class="header__phone-image" src="/wp-content/themes/FalconGlen/src/icons/phone.c526f7.svg" alt="Background" />
						<span><?=$phone_number?></span>
					</a>
				<?php endif; ?>
				
				<?php get_template_part('/core/views/account/account-enter','header');?>
				<?php if (ms_is_woocommerce_activated()):
					$cart = WC()->cart;
					$hide_prod_count = $cart->get_cart_contents_count() > 0 ? 'block':'none';
					?>
					<div class="header__cart">
						<span class="header__cart-number" style="display: <?= $hide_prod_count ?>" id="cart-items"><?= $cart->get_cart_contents_count() ?></span>
						<img class="header__cart-image" src="/wp-content/themes/FalconGlen/src/icons/cart.1f37db.svg" alt="Background" />
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>