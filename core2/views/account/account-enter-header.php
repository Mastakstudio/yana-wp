<?php
if (is_user_logged_in()) {
    /** @var WP_User $current_user */
    $user = wp_get_current_user();
	
	$userName =  isset($user->first_name) && !empty($user->first_name) ? $user->first_name : '';
	$userName .=  isset($user->last_name) && !empty($user->last_name)? ' '. $user->last_name : '';
	$userName =  !empty($userName)? $userName : $user->display_name;
	$displayName = !empty($userName) ? $userName :  $user->user_email;
}
?>
<a id="login-button" class="header__login log-in header__desctop" <?= empty($user)?'':'style="display: none !important"'?> >
	<img class="header__login-image" src="/wp-content/themes/FalconGlen/src/icons/login.9ab70f.svg" alt="Background" />
	<span>Login</span>
</a>
<?php if ( get_option( 'users_can_register' ) ) :?>
<a id="go-to-acc-button" class="header__login account-img header__desctop"
   href="<?= get_permalink(wc_get_page_id("myaccount")) ?>" <?= !empty($user)?'':'style="display: none !important"' ?>>
	<img class="header__login-image" src="/wp-content/themes/FalconGlen/src2/account.png" alt="Background" />
	<span id="header__cabinet-text"><?= $displayName ?></span>
</a>
<?php endif; ?>