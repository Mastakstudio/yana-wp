<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link href="<?= BASE_URL ?>/style.css">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<main class="main">
<?php
get_template_part('/core/views/loginPopup');
wp_body_open();
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */


//<script>
//  window.fbAsyncInit = function() {
//    FB.init({
//      appId      : '{your-app-id}',
//      cookie     : true,
//      xfbml      : true,
//      version    : 'v7.0'
//    });
//
//    FB.AppEvents.logPageView();
//
//  };
//
//  (function(d, s, id){
//     var js, fjs = d.getElementsByTagName(s)[0];
//     if (d.getElementById(id)) {return;}
//     js = d.createElement(s); js.id = id;
//     js.src = "https://connect.facebook.net/en_US/sdk.js";
//     fjs.parentNode.insertBefore(js, fjs);
//   }(document, 'script', 'facebook-jssdk'));
//</script>