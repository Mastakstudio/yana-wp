<?php
/**
 * Template name: 404
 */
//
//$userManager = UserManager::getInstance();
///**@var CustomUser $currentUser*/
//$currentUser = $userManager::GetCurrentUser();
//if ( ! $currentUser ) {
//	$userManager->RedirectToSignIn();
//}
//var_dump( $currentUser );

get_header();
get_template_part( '/core/views/headerView' );
?>
    <div class="page404">
        <div class="page404__inner">
            <div class="page404__content"><span class="page404__title">404</span><span class="page404__desc">Страница не найдена</span><span class="page404__text">Неправильно набран адрес, или такой страницы на сайте не существует. Начните с главной страницы или воспользуйтесь меню.</span>
            </div><img class="page404__image" src="/wp-content/themes/Yana/src/icons/page404.png" alt="" role="presentation"/>
        </div>
    </div>
<?php
get_template_part( '/core/views/home/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
