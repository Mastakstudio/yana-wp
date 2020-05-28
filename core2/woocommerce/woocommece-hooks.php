<?php
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'fg_woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );


remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );
add_action( 'fg_woocommerce_order_again', 'woocommerce_order_again_button' );

remove_action( 'woocommerce_account_content', 'woocommerce_output_all_notices', 5 );
add_action( 'fg_woocommerce_account_content', 'woocommerce_output_all_notices', 5 );


//add_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );


remove_action( 'woocommerce_before_checkout_form_cart_notices', 'woocommerce_output_all_notices', 10 );