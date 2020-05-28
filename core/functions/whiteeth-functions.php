<?php
/**
 * Query WooCommerce activation
 */
function ms_is_woocommerce_activated()
{
    return class_exists('WooCommerce') ? true : false;
}

/**@param array $wrapperStyles
 * @param array $wrapperClasses
 * @param array $loaderClasses
 * @return string
 */
function ajax_loader($wrapperStyles = [], $wrapperClasses = [], $loaderClasses= []){
	$wrapperStylesResult = '';
	if (count($wrapperStyles) > 0)
		foreach ($wrapperStyles as $key => $style) {
			$wrapperStylesResult .= $key . ' : ' . $style . '; ';
		}
	$wrapperClassesResult = count($wrapperClasses) > 0 ? implode(' ', $wrapperClasses) : '';
	$loaderClassesResult = count( $loaderClasses) > 0 ? implode(' ',  $loaderClasses) : '';
	
	return '<div class="ajax_loader_wrapper ' . $wrapperClassesResult . '" style="' . $wrapperStylesResult . '"><div class="ajax_loader ' . $loaderClassesResult . '"></div></div>';
}

//add_action('wp_logout','ps_redirect_after_logout');
//function ps_redirect_after_logout(){
//	wp_redirect( get_home_url() );
//	exit();
//}

//function wpse66094_no_admin_access() {
//	$redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/' );
//	global $current_user;
//	$user_roles = $current_user->roles;
//	$user_role = array_shift($user_roles);
//
//	if($user_role !== 'administrator' && strpos( $_SERVER['HTTP_REFERER'], 'wp-admin')){
//		exit( wp_redirect( home_url( '/' ) ) );
//	}
//}

//add_action( 'admin_init', 'wpse66094_no_admin_access', 100 );

//function mainClasses(){
//	$classes = '';
//	if (is_checkout())
//		$classes .= '';
//	else{
//		$classes .= ' backGrey';
//	}
//	return $classes;
//}