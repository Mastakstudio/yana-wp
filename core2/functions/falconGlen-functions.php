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

add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
	wp_redirect( get_home_url() );
	exit();
}

function wpse66094_no_admin_access() {
	$redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/' );
	global $current_user;
	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);
	
	if($user_role !== 'administrator' && strpos( $_SERVER['HTTP_REFERER'], 'wp-admin')){
		exit( wp_redirect( home_url( '/' ) ) );
	}
}

add_action( 'admin_init', 'wpse66094_no_admin_access', 100 );

function mainClasses(){
	$classes = '';
	if (is_checkout())
		$classes .= '';
	else{
		$classes .= ' backGrey';
	}
	return $classes;
}

/**
 * @param integer $offset
 */
function fg_get_posts($offset = 0, $queryArgs = null){
    global $post;
//    $offset =30;
    $post_query_args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'offset' => $offset
    ];
    if (!is_null($queryArgs))
        $post_query_args[ $queryArgs[ "taxonomy"]]  = $queryArgs[ "term_id"];


    $post_query = new WP_Query($post_query_args);
    if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) :
        $post_query->the_post();
        $result = preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $post->post_content, $match);

        $link_to_insta = '';
        if (count($match[0])){
            foreach ($match[0] as $link) {
                if ( strpos( $link, 'instagram' ) !== false){
                    $link_to_insta = $link;
                    break;
                }
            }
        }
    ?>
        <div class="blog__grid-item grid-item">
        <a href="<?= get_permalink() ?>"><h2><?= the_title()?></h2></a>
            <?php
            if ( !empty($link_to_insta) )
                echo apply_filters('the_content' , $link_to_insta);
            else if(has_excerpt())
                echo '<div><p>'.get_the_excerpt().'</p></div>';
            else
                the_content();
            ?>
        </div>
    <?php endwhile; else:?>
        <div><p>no posts</p></div>
    <?php
    endif;
    wp_reset_postdata();
}