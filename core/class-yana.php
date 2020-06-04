<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Yana{
    public function __construct(){
        add_action('after_setup_theme', [ $this, 'setup' ]);
        add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ], 10 );
        add_action( 'widgets_init', [ $this, 'widgets_init' ] );
        add_action( 'wp_head', [ $this, 'header_meta' ], 999 );
        add_filter( 'body_class', [ $this, 'body_classes' ] );
        add_filter( 'nav_menu_css_class', [$this, 'set_menu_classes' ], 1, 3 );
//        add_filter( 'nav_menu_submenu_css_class', [$this, 'set_submenu_classes' ], 10, 3 );
//        add_filter( 'walker_nav_menu_start_el', [$this, 'change_product_menu_item' ], 10, 3);
    }

    public function setup(){
        add_theme_support( 'post-thumbnails' );
//        add_image_size( 'home-banner', 725, 285, true );
//	    add_image_size( 'custom_thumbnail', 444, 388, true );
//	    add_image_size( 'product-gallery', 846, 632, true );
//	    add_image_size( 'delivery_page_image', 150, 120, true );
//	    add_image_size( 'for_byers_page', 690, 460, true );

        /**
         * Register menu locations.
         */
        register_nav_menus([
            'main_menu' => 'Main Menu',
//            'mobile_menu' => 'Mobile Menu',
        ]);

        /*
         * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
         * to output valid HTML5.
         */
        add_theme_support( 'html5'
//                , apply_filters(
//                    'storefront_html5_args',[
//                    'search-form',
//                    'comment-form',
//                    'comment-list',
//                    'gallery',
//                    'caption',
//                    'widgets',
//                ])
        );
        /**
         * Declare support for title theme feature.
         */
        add_theme_support( 'title-tag' );
        add_theme_support( 'responsive-embeds' );
    }

    public function scripts() {
        /**
         * Styles
         */

	    wp_enqueue_style(PREFIX.'theme-common', BASE_URL.'/style.css', false, null);
        if (file_exists( get_template_directory()."/src/assets.json")) {
            wp_enqueue_style(PREFIX.'common', Assets::getCss('common'), false, null);
            if (is_page_template('template-homepage.php')) {
                wp_enqueue_style(PREFIX.'home', Assets::getCss('index'), false, null);
            }
            elseif (is_404() || is_page_template('template-404.php')){
	            wp_enqueue_style(PREFIX.'page404', Assets::getCss('page404'), false, null);
            }
            elseif (is_page_template('template-faq.php')){
	            wp_enqueue_style(PREFIX.'questionPage', Assets::getCss('questionPage'), false, null);
            }
            elseif (is_singular('course') || is_page_template('template-course.php')){
	            wp_enqueue_style(PREFIX.'course', Assets::getCss('course'), false, null);
            }
            elseif (is_page_template('template-experts.php')){
	            wp_enqueue_style(PREFIX.'experts', Assets::getCss('experts'), false, null);
            }
            elseif (is_page_template('template-account.php')){
	            wp_enqueue_style(PREFIX.'account', Assets::getCss('account'), false, null);
            }
            elseif (is_page_template('template-signin.php')){
	            wp_enqueue_style(PREFIX.'signIn', Assets::getCss('signIn'), false, null);
            }
        }
        /**
         * Scripts
         */
        $params = [
        	'ajax_url' =>  admin_url( 'admin-ajax.php', 'minicart' ),
	        'url' => admin_url( 'admin-ajax.php' ),
	        ];
        if (file_exists( get_template_directory()."/src/assets.json")) {
            wp_enqueue_script(PREFIX.'commons', Assets::getJs('common'), false, null, true);
            if (is_page_template('template-homepage.php')) {
                wp_enqueue_script(PREFIX.'index', Assets::getJs('index'), false, null, true);
            }
            elseif (is_404() || is_page_template('template-404.php')){
	            wp_enqueue_script(PREFIX.'page404', Assets::getJs('page404'), false, null, true);
            }
            elseif (is_page_template('template-faq.php')){
	            wp_enqueue_script(PREFIX.'questionPage', Assets::getJs('questionPage'), false, null, true);
            }
            elseif (is_singular('course') || is_page_template('template-course.php')){
	            wp_enqueue_script(PREFIX.'course', Assets::getJs('course'), false, null, true);
            }
            elseif (is_page_template('template-experts.php')){
	            wp_enqueue_script(PREFIX.'experts', Assets::getJs('experts'), false, null, true);
            }
            elseif (is_page_template('template-account.php')){
	            wp_enqueue_script(PREFIX.'account', Assets::getJs('account'), false, null, true);
            }
            elseif (is_page_template('template-signin.php')){
	            wp_enqueue_script(PREFIX.'signIn', Assets::getJs('signIn'), false, null, true);
            }
        }

//	    if ( is_singular('product') ) {
//
//	    }elseif(is_checkout()){
//
//	    }  else{
//
//	    }




    }

    /**
     * Register widget area.
     * @link https://codex.wordpress.org/Function_Reference/register_sidebar
     */
    public function widgets_init() {
        register_sidebar( [
	        'name' => __( 'Header Sidebar' ),
	        'id' => 'header-sidebar',
	        'before_widget' => '<div>',
	        'after_widget' => '</div>',
	        'before_title' => '<h1>',
	        'after_title' => '</h1>',
        ] );
    }

    public function body_classes( $classes ) {
//            if ( is_multi_author() ) $classes[] = 'group-blog';

//            $classes[] = 'no-wc-breadcrumb';

//            $cute = apply_filters( 'storefront_make_me_cute', false );

//            if ( true === $cute ) $classes[] = 'storefront-cute';

        // If our main sidebar doesn't contain widgets, adjust the layout to be full-width.
//            if ( ! is_active_sidebar( 'sidebar-1' ) ) $classes[] = 'storefront-full-width-content';

        // Add class when using homepage template + featured image.
//            if ( is_page_template( 'template-homepage.php' ) && has_post_thumbnail() ) $classes[] = 'has-post-thumbnail';

        // Add class when Secondary Navigation is in use.
//            if ( has_nav_menu( 'secondary' ) ) $classes[] = 'storefront-secondary-navigation';

        // Add class if align-wide is supported.
//            if ( current_theme_supports( 'align-wide' ) ) $classes[] = 'storefront-align-wide';
//	    if (is_404()) return $classes;
//
//        $classes[] = 'app';
//        if (is_page_template('template-homepage.php')) return $classes;
//	    if (is_cart()) $classes[] = 'woo_cart';;
//        else if(ms_is_woocommerce_activated()){
//        	if (is_account_page()){
//		        $classes[] = 'backGrey';
//		        return $classes;
//	        }
//        }
        
//	    if (is_page_template('template-homepage.php')) return $classes;
        
        $classes[] = 'app';
        return $classes;
    }


    public function set_menu_classes($classes, $item, $args){
        if ($args->theme_location === 'main_menu') {
            if ($item->menu_item_parent == 0) {
                $classes[] = 'header__menu-item';
                if (in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-parent', $classes ))
                    $classes[] = 'active';
                
            } else {
                $classes[] = 'header__menu-item-inner-li';
                if (in_array( 'current-menu-item', $classes ))
                    $classes[] = 'header__menu-item-inner-li_active';
            }

        }elseif($args->theme_location === 'mobile_menu'){
	        if (in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-parent', $classes ))
		        $classes[] = 'active';
        }
        return $classes;
    }

	public function set_submenu_classes($classes){
        $classes[] = 'header__menu-item-inner';
		return $classes;
	}

	public function header_meta(){
        ?>
        <meta property="og:image" content="">
        <meta property="og:title" content="">
        <meta property="og:url" content="">
        <meta name="description" content="">
        <meta name="Keywords" content="">
        <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
        <link rel="canonical" href="">
        <meta property="og:locale" content="ru_RU">
        <meta property="og:type" content="website">
        <meta property="og:title" content="">
        <meta property="og:description" content="">
        <meta property="og:url" content="">
        <meta property="og:site_name" content="">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:description" content="">
        <meta name="twitter:title" content="">
        <?php
    }
}

return new Yana();