<?php
$phone = carbon_get_theme_option(PREFIX . 'phone_number');
$email = carbon_get_theme_option(PREFIX . 'contact_email');
$instagram = carbon_get_theme_option(PREFIX . 'instagram_link');
$facebook = carbon_get_theme_option(PREFIX . 'facebook_link');
$twitter = carbon_get_theme_option(PREFIX . 'twitter_link');
$linkedin = carbon_get_theme_option(PREFIX . 'linkedin_link');
$pinterest = carbon_get_theme_option(PREFIX . 'pinterest_link');
$map_link = carbon_get_theme_option(PREFIX . 'map_link');
$work_hours = carbon_get_theme_option(PREFIX . 'work_hours');
$work_months = carbon_get_theme_option(PREFIX . 'work_months');


$footer_cookie_page_id = carbon_get_theme_option(PREFIX . 'footer_cookie_link');

$footer_links = carbon_get_theme_option(PREFIX . 'footer_links');
?>
<div class="footer">
	<div class="container">
		<div class="footer__inner">
			<div class="footer__soc">
				<div class="footer__title">Follow us</div>
				<div class="footer__soc-content">
					<?php if (!empty($instagram)):?>
					<a class="footer__soc-link" href="<?= esc_url($instagram)?>" target="_blank">
						<img class="footer__soc-image" src="/wp-content/themes/FalconGlen/src/icons/soc1.b639b7.svg" alt="instagram link" />
					</a>
					<?php endif;
					if (!empty($facebook)):?>
					<a class="footer__soc-link" href="<?= esc_url($facebook)?>" target="_blank">
						<img class="footer__soc-image" src="/wp-content/themes/FalconGlen/src/icons/soc2.ab016f.svg" alt="facebook link" />
					</a>
					<?php endif;
					if (!empty($twitter)):?>
					<a class="footer__soc-link" href="<?= esc_url($twitter)?>" target="_blank">
						<img class="footer__soc-image" src="/wp-content/themes/FalconGlen/src/icons/soc3.b86856.svg" alt="twitter link" />
					</a>
					<?php endif;
					if (!empty($linkedin)):?>
					<a class="footer__soc-link" href="<?= esc_url($linkedin)?>" target="_blank">
						<img class="footer__soc-image" src="/wp-content/themes/FalconGlen/src/icons/soc4.303112.svg" alt="linkedin link" />
					</a>
					<?php endif;
					if (!empty($pinterest)):?>
					<a class="footer__soc-link" href="<?= esc_url($pinterest)?>" target="_blank">
						<img class="footer__soc-image" src="/wp-content/themes/FalconGlen/src/icons/soc5.d4e6e4.svg" alt="pinterest link" />
					</a>
					<?php endif; ?>
				</div>
			</div>
			<?php if (!empty($phone) || !empty($email)) : ?>
			<div class="footer__contact">
				<div class="footer__title">Contact us</div>
				<div class="footer__contact-list">
					<?php if (!empty($phone)) : ?>
						<a class="footer__contact-link" href="tel:<?=$phone?>">
							<img class="footer__contact-image" src="/wp-content/themes/FalconGlen/src/icons/phone.c526f7.svg" alt="phone number"/>
							<span><?=$phone?></span>
						</a>
					<?php endif;
					if (!empty($email)) : ?>
						<a class="footer__contact-link" href="mailto:<?=$email?>">
							<img class="footer__contact-image" src="/wp-content/themes/FalconGlen/src/icons/mail.367161.svg" alt="contact mail"/>
							<span><?= $email ?></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<a class="footer__logo" href="/">
				<img class="footer__logo-image" src="/wp-content/themes/FalconGlen/src/icons/logo.b87542.png" alt="falconglen logo" />
			</a>
			<?php endif;
			if (!empty($work_months) || !empty($work_hours)) : ?>
				<div class="footer__work">
					<div class="footer__title">Working hours</div>
					<div class="footer__work-time">
						<span><?= $work_hours ?></span>
						<span><?= $work_months ?></span>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="footer__dev-foot">
			<div class="footer__foot">
				<?php if (is_array($footer_links) && count($footer_links)){
					foreach ($footer_links as $link) {
                        $page_id =  get_post($link["footer_link"]);
                        $link_title = $link["footer_link_title"];

                        if (empty($link["footer_link_title"])){
                            $page =  get_post($page_id);
                            $link_title = $page->post_title;
                        }
						echo '<a class="footer__terms" href="'.get_permalink($page_id).'">'.$link_title.'</a>';
					}
				}?>
			</div>
			<a class="footer__develop" href="<?= esc_url('mastakstudio.com')?>" target="_blank">
				<span class="footer__develop-title">Developed:</span>
				<img class="footer__develop-image" src="/wp-content/themes/FalconGlen/src/icons/mastak-logo.8031d2.svg" alt="Mastak logo"/>
			</a>
		</div>
	</div>
</div>
<?php
if (isset($footer_cookie_page_id) && !empty($footer_cookie_page_id)):
    /**@var $cookie_page WP_Post*/
    $cookie_page =  get_post($footer_cookie_page_id);
    $footer_cookie_link_title = carbon_get_theme_option(PREFIX . 'footer_cookie_link_title');
?>
<div class="cookie-banner" style="display: none">
    <p>Cookie Policy <br>
        We use cookies to collect information about when and how you use our website so we can create a better experience. By navigating around this site you consent to cookies being stored on your machine. To find out more, and for information on how to opt out, please see our
        <a href="<?= get_permalink($footer_cookie_page_id) ?>">
            <?= !empty($footer_cookie_link_title)? $footer_cookie_link_title : $cookie_page->post_title ?>
        </a>
    </p>
    <button class="close">&times;</button>
</div>
<?php endif; ?>