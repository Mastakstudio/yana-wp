<?php 

add_filter('woocommerce_update_order_review_fragments', 'add_custom_fragment_update_order_review', 20, 1);
function add_custom_fragment_update_order_review( $fragments ){
    ob_start();
    wc_cart_totals_shipping_html();
    $shipping_methods = ob_get_clean();


    $fragments['#shipping_methods_wrapper'] = $shipping_methods;
    return $fragments;
}