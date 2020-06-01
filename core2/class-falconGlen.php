<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The main FalconGlen class
 */
class FalconGlen{
    public function __construct(){
        add_action('after_setup_theme', [ $this, 'setup' ]);
        add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ], 10 );
        add_action( 'widgets_init', [ $this, 'widgets_init' ] );
        add_filter( 'body_class', [ $this, 'body_classes' ] );
        add_filter( 'nav_menu_css_class', [$this, 'set_menu_classes' ], 1, 3 );
        add_filter( 'nav_menu_submenu_css_class', [$this, 'set_submenu_classes' ], 10, 3 );
        add_filter( 'walker_nav_menu_start_el', [$this, 'change_product_menu_item' ], 10, 3);
    }

    public function setup(){
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'home-banner', 725, 285, true );
	    add_image_size( 'custom_thumbnail', 444, 388, true );
	    add_image_size( 'product-gallery', 846, 632, true );
	    add_image_size( 'delivery_page_image', 150, 120, true );
	    add_image_size( 'for_byers_page', 690, 460, true );

        /**
         * Register menu locations.
         */
        register_nav_menus([
            'main_menu' => 'Main Menu',
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
	    global $wp;
        /**
         * Styles
         */
        if (file_exists( get_template_directory()."/src/assets.json")) {
            wp_enqueue_style('commons', Assets::getCss('common'), false, null);
            wp_enqueue_style('style-common', BASE_URL.'/style.css' , false, null);
	        wp_enqueue_style('style-common2', BASE_URL.'/src_fix/style.css' , false, null);

            if (is_page_template('template-homepage.php') ) {
                wp_enqueue_style('home', Assets::getCss('index'), false, null);
            }
            else if (is_page_template('template-contacts.php') ) {
                wp_enqueue_style('contact', Assets::getCss('contact'), false, null);
            }
            else if (is_page_template('template-about.php') ) {
                wp_enqueue_style('aboutFalconGlen', Assets::getCss('about'), false, null);
            }
            else if (is_page_template('template-blog.php') || is_page_template('template-redirect.php') ) {
	            wp_enqueue_style('blog', Assets::getCss('blog'), false, null);
            }
            else if (is_page_template('template-buyers.php') ) {
	            wp_enqueue_style('buyers', Assets::getCss('buyers'), false, null);
            }
            else if (is_page_template('template-delivery.php') ) {
	            wp_enqueue_style('delivery', Assets::getCss('delivery'), false, null);
            }
            else if (is_page_template('template-order.php') ) {
	            wp_enqueue_style('order', Assets::getCss('order'), false, null);
            }
            else if (is_page_template('template-text.php') ) {
	            wp_enqueue_style('text', Assets::getCss('text'), false, null);
            }
            else if (is_404() ) {
                wp_enqueue_style('page404', Assets::getCss('page404'), false, null);
            }
            else if (is_tag() || is_category() ) {
                wp_enqueue_style('blog', Assets::getCss('blog'), false, null);
            }
            else if(ms_is_woocommerce_activated() ){
		        if ( is_view_order_page() || is_order_received_page()) {
			        wp_enqueue_style('accountInfo', Assets::getCss('accountInfo'), false, null);
		        }
                else if ( is_post_type_archive('product') || is_product_category()) {
                    wp_enqueue_style('products', Assets::getCss('products'), false, null);
                }
                else if ( is_singular('product') ) {
                    wp_enqueue_style('product', Assets::getCss('product'), false, null);
                }
		        else if (is_account_page() || isset( $wp->query_vars['lost-password'] )){
			        wp_enqueue_style('account', Assets::getCss('account'), false, null);
                    wp_enqueue_style('order', Assets::getCss('order'), false, null);
		        }
		        else if (is_checkout() ){
			        wp_enqueue_style('order', Assets::getCss('order'), false, null);
		        }
                else if ( is_archive() || is_author() ) {
                    wp_enqueue_style('blog', Assets::getCss('blog'), false, null);
                }
		        else wp_enqueue_style('text', Assets::getCss('text'), false, null);
	        }
            else if ( is_archive() || is_author() ) {
                wp_enqueue_style('blog', Assets::getCss('blog'), false, null);
            }
            else{
	            wp_enqueue_style('text', Assets::getCss('text'), false, null);
            }
        }

        /**
         * Scripts
         */
        if (file_exists(get_template_directory() . "/src/assets.json")) {
            $params = [
                'ajax_url' =>  admin_url( 'admin-ajax.php', 'minicart' ),
                'cart_url' => ms_is_woocommerce_activated() ? MINICART_AJAX::get_endpoint('%%endpoint%%'):'',
                'account_url' => ms_is_woocommerce_activated() ?  ACCOUNT_AJAX::get_endpoint('%%endpoint%%'):'',
            ];
	        $currencies_data = get_currency_data();
	        
	        wp_enqueue_script('commons', Assets::getJs('common'), false, null, true);
            wp_localize_script('commons', 'mastak_ajax', $params);
	        wp_localize_script('commons', 'currencies_data', $currencies_data);

            if ( is_page_template('template-homepage.php') ) {
                wp_enqueue_script('home', Assets::getJs('index'), false, null, true);
            }
            else if ( is_page_template('template-contacts.php') ) {
                wp_enqueue_script('contact', Assets::getJs('contact'), false, null, true);
            }
            else if ( is_page_template('template-about.php') ) {
                wp_enqueue_script('aboutFalconGlen', Assets::getJs('about'), false, null, true);
            }
            else if (is_page_template('template-blog.php') || is_page_template('template-redirect.php') ) {
	            wp_enqueue_script('blog', Assets::getJs('blog'), false, null, true);
            }
            else if (is_page_template('template-buyers.php') ) {
	            wp_enqueue_script('buyers', Assets::getJs('buyers'), false, null, true);
            }
            else if (is_page_template('template-delivery.php') ) {
	            wp_enqueue_script('delivery', Assets::getJs('delivery'), false, null, true);
            }
            else if (is_page_template('template-order.php') ) {
	            wp_enqueue_script('order', Assets::getJs('order'), false, null, true);
            }
            else if (is_page_template('template-text.php') ) {
	            wp_enqueue_script('text', Assets::getJs('text'), false, null, true);
            }
            else if (is_404() ) {
                wp_enqueue_script('page404', Assets::getJs('page404'), false, null, true);
            }
            else if (is_tag() || is_category() ) {
                wp_enqueue_script('blog', Assets::getJs('blog'), false, null, true);
            }
            else if(ms_is_woocommerce_activated()){
            	if (is_view_order_page()  || is_order_received_page()) {
		            wp_enqueue_script('accountInfo', Assets::getJs('accountInfo'), false, null, true);
	            }
                else if ( is_post_type_archive('product') || is_product_category()) {
                    wp_enqueue_script('products', Assets::getJs('products'), false, null, true);
                }
                else if ( is_singular('product') ) {
                    wp_enqueue_script('product', Assets::getJs('product'), false, null, true);
                }
	            else if (is_account_page() || isset( $wp->query_vars['lost-password'] )){
		            wp_enqueue_script('account', Assets::getJs('account'), false, null, true);
	            }
	            else if (is_checkout()  ){
                    wp_enqueue_script('order', Assets::getJs('order'), false, null, true);
                }
                else if ( is_archive() ) {
                    wp_enqueue_script('blog', Assets::getJs('blog'), false, null, true);
                }
	            else wp_enqueue_script('text', Assets::getJs('text'), false, null, true);
            }
            else if ( is_archive() ) {
                wp_enqueue_script('blog', Assets::getJs('blog'), false, null, true);
            }
            else{
		        wp_enqueue_script('text', Assets::getJs('text'), false, null, true);
	        }
        }
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

        /** Adds a class when WooCommerce is not active.
         * @todo Refactor child themes to remove dependency on this class. */
//            $classes[] = 'no-wc-breadcrumb';

        /**
         * What is this?!
         * Take the blue pill, close this file and forget you saw the following code.
         * Or take the red pill, filter storefront_make_me_cute and see how deep the rabbit hole goes...
         */
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
	    if (is_404()) return $classes;
	    
        $classes[] = 'app';
        if (is_page_template('template-homepage.php')) return $classes;
	    if (is_cart()) $classes[] = 'woo_cart';;
//        else if(ms_is_woocommerce_activated()){
//        	if (is_account_page()){
//		        $classes[] = 'backGrey';
//		        return $classes;
//	        }
//        }
        
//	    if (is_page_template('template-homepage.php')) return $classes;
        
        $classes[] = 'body-background';
        return $classes;
    }


    public function set_menu_classes($classes, $item, $args){
        if ($args->theme_location === 'main_menu') {
            if ($item->menu_item_parent == 0) {
                $classes[] = 'header__menu-item';
//                if (in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-parent', $classes ))
//                    $classes[] = 'header__menu-item_active';
                
            } else {
                $classes[] = 'header__menu-item-inner-li';
                if (in_array( 'current-menu-item', $classes ))
                    $classes[] = 'header__menu-item-inner-li_active';
            }

        }
        return $classes;
    }

	public function set_submenu_classes($classes){
        $classes[] = 'header__menu-item-inner';
		return $classes;
	}

	public function change_product_menu_item( $item_output, $item ){
		if ( (int)$item->menu_item_parent === 0 ){
            $link_classes = ['header__menu-item-link'];
            if (in_array( 'current-menu-item', $item->classes ) )
                $link_classes[] = 'header__menu-item-link_active';

            return '<a class="'.implode(" ", $link_classes).'" href="'.$item->url.'">'.$item->title.'</a>';
        }

		$title = '<div class="header__menu-item-inner-title">'.$item->title.'</div>';
	    if ($item->object !== 'product')
	    	return '<a class="header__menu-item-inner-link" href="'.$item->url.'">'.$title.'</a>';

        $product_id = $item->object_id;
        $thumbnail_url = get_the_post_thumbnail_url($product_id);
        $thumbnail = empty($thumbnail_url)
            ? ''
            : '<div class="header__menu-item-inner-container"><img class="header__menu-item-inner-image" src="'.$thumbnail_url.'" /></div>';

        return '<a href="'.$item->url.'">'.$thumbnail.$title.'</a>';
    }
}

return new FalconGlen();