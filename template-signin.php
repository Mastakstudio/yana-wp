<?php
/**
 * Template name: signIn
 */
$userManager = UserManager::getInstance();
/**@var $currentUser CustomUser*/
$currentUser = $userManager::GetCurrentUser();

if ( $currentUser::UserIsAuthorized() ){
	$userManager->RedirectToAccount();
}
$userManager->FormProcessing();

get_header();
get_template_part( '/core/views/headerView' );

?>
    <div class="wrapper">
        <div class="sign-in">
            <div class="container">
                <div class="sign-in__inner">
                    <div class="sign-in__tabs-content">
                        <input type="radio" name="toggle" checked="" id="login">
                        <input type="radio" name="toggle" id="auth">
                        <div class="sign-in__tabs">
                            <label for="login">ВОЙТИ</label>
                            <label for="auth">зарегистрироваться</label>
                            <span></span>
                        </div>
                        <div class="sign-in__content">
                            <div class="login-page">
                                <div class="sign-in__inner">
                                    <div class="sign-in__content-type">
                                        <span class="title title_blue">войти</span>
                                    </div>
                                </div>
	                            <?php $userManager->LoginForm(); ?>
                            </div>
                            <div class="auth-page">
                                <div class="sign-in__inner">
                                    <div class="sign-in__content-type">
                                        <span class="title title_blue">регистрация</span>
                                    </div>
                                </div>
                                <?php $userManager->RegistrationForm(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="image" src="/wp-content/themes/Yana/src/icons/account.png"/>
        </div>
		<?php get_template_part( '/core/views/partners' ); ?>
    </div>
<?php
get_template_part( '/core/views/footerView' );
get_footer();
