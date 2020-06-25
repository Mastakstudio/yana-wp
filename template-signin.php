<?php
/**
 * Template name: signIn
 */
if (!defined('ABSPATH')) exit();
$userManager = UserManager::getInstance();
$currentUser = $userManager->GetCurrentUser();

if (!current_user_can('administrator')){
	if ( $currentUser->IsAuthorized() ){
		$userManager->RedirectToAccount();
	}
}

$userManager->FormProcessing();

get_header();
get_template_part( '/core/views/headerView' );
if (isset($_GET['action']) && $_GET['action'] === 'lostpassword'):
?>
    <div class="wrapper">
        <div class="sign-in">
            <div class="container">
                <div class="sign-in__inner">
                    <div class="sign-in__tabs-content">
                        <input type="radio" name="toggle" checked="" id="login">

                        <div class="sign-in__content">
                            <div class="login-page">
                                <div class="sign-in__inner">
                                    <div class="sign-in__content-type">
                                        <span class="title title_blue">Забыли пароль?</span>
                                    </div>
                                </div>
								<?php $userManager->LostPasswordForm(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="image" src="/wp-content/themes/Yana/src/icons/account.png"/>
        </div>
		<?php get_template_part( '/core/views/partners' ); ?>
    </div>
<?php else:

	$message ='';
    $loaspass = false;
    if (isset( $_GET['checkemail'] ) && 'confirm' === $_GET['checkemail']){
	    $message ='<span>'.__( 'Check your email for the confirmation link.' ).'</span>';
	    $loaspass = true;
    }


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
                                <?= $message ?>
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
                        <div class="partners__button-prev swiper-button-prev">
                        </div>
                        <div class="partners__button-next swiper-button-next">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
get_template_part( '/core/views/footerView' );
get_footer();
