<?php

// Add custom field input @ Product Data > Variations > Single Variation
add_action( 'woocommerce_variation_options_dimensions', 'bbloomer_add_custom_field_to_variations', 10, 3 );
function bbloomer_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
    $first_weight_unit   = get_post_meta( $variation->ID, 'first_weight_unit', true );
    $second_weight_unit  = get_post_meta( $variation->ID, 'second_weight_unit', true );
	$second_weight_val   = get_post_meta( $variation->ID, 'second_weight_val', true );
	$default_second_weight_unit = get_option('_falconglensecond_weight_unit', 'g');
	$default_val = get_post_meta( $variation->ID, 'product_packaging_type', true );

	$weight_units = [ 'kg' => 'kg', 'g' => 'g' , 'lbs' => 'lbs' , 'oz' => 'oz' ];

    woocommerce_wp_select([
        'id' => 'first_weight_unit[' . $loop . ']',
        'label' => 'first weight unit',
        'value' => empty($first_weight_unit)? $default_second_weight_unit : $first_weight_unit,
        'wrapper_class' => 'form-row form-row-last',
        'options' => $weight_units ]);

    woocommerce_wp_text_input([
        'id' => 'second_weight_val[' . $loop . ']',
	    'label' => 'second weight val',
        'class' => 'short',
        'wrapper_class' => 'form-row form-row-first',
        'value' => empty($second_weight_val)? 0 : $second_weight_val  ]);

    woocommerce_wp_select([
        'id' => 'second_weight_unit[' . $loop . ']',
	    'label' => 'second weight unit' ,
        'value' => empty($second_weight_unit)? $default_second_weight_unit : $second_weight_unit,
        'wrapper_class' => 'form-row form-row-last',
	    'options' => $weight_units ]);
	
    woocommerce_wp_radio([
	    'id' => 'product_packaging_type[' . $loop . ']',
	    'label' => 'product packaging type' ,
	    'value' =>  !empty($default_val)? $default_val : 'box',
	    'options' =>[
	    	'box' => 'box',
		    'bag' => 'bag'
	    ]]);
    
    woocommerce_wp_checkbox([
	    'id' => 'only_pickup[' . $loop . ']',
	    'label' => 'This variation is only pickup',
	    'value' => get_post_meta( $variation->ID, 'only_pickup', true )
	    
    ]);
}

// Save custom field on product variation save
add_action( 'woocommerce_save_product_variation', 'bbloomer_save_custom_field_variations', 10, 2 );
function bbloomer_save_custom_field_variations( $variation_id, $i ) {
    $first_weight_unit = $_POST['first_weight_unit'][$i];
    if ( isset( $first_weight_unit ) && !empty($first_weight_unit)){
        update_post_meta( $variation_id, 'first_weight_unit', esc_attr( $first_weight_unit ) );
    }else{
        $unit =  get_option('woocommerce_weight_unit') ;
        update_post_meta( $variation_id, 'first_weight_unit', $unit);
    }

    $second_weight_val = $_POST['second_weight_val'][$i];
    if ( isset( $second_weight_val ) ) {
        update_post_meta( $variation_id, 'second_weight_val', esc_attr( $second_weight_val ) );
    }

    $second_weight_unit = $_POST['second_weight_unit'][$i];
    if ( isset( $second_weight_unit ) && !empty($second_weight_unit)){
        update_post_meta( $variation_id, 'second_weight_unit', esc_attr( $second_weight_unit ) );
    }else{
        $unit =  carbon_get_theme_option(PREFIX.'second_weight_unit') ;
        update_post_meta( $variation_id, 'second_weight_unit', $unit);
    }

	$product_packaging_type = $_POST['product_packaging_type'][$i];
	if ( isset( $product_packaging_type ) ){
        update_post_meta( $variation_id, 'product_packaging_type', esc_attr( $product_packaging_type ) );
    }
	
	$only_pickup = $_POST['only_pickup'][$i];
	if ( isset( $only_pickup ) ){
		update_post_meta( $variation_id, 'only_pickup', esc_attr( $only_pickup ) );
	} else{
		update_post_meta( $variation_id, 'only_pickup', 'no' );
	}
}

// Store custom field value into variation data
add_filter( 'woocommerce_available_variation', 'bbloomer_add_custom_field_variation_data' );
function bbloomer_add_custom_field_variation_data( $variations ) {
    $variations['first_weight_unit'] = get_post_meta( $variations[ 'variation_id' ], 'first_weight_unit', true ) ;
	$variations['second_weight_unit'] = get_post_meta( $variations[ 'variation_id' ], 'second_weight_unit', true ) ;
    $variations['second_weight_val'] = (float)get_post_meta( $variations[ 'variation_id' ], 'second_weight_val', true ) ;
    
    $product_packaging_type = get_post_meta( $variations[ 'variation_id' ], 'product_packaging_type', true );
	$variations['product_packaging_type'] = !empty($product_packaging_type)? $product_packaging_type: 'N/A' ;
	$variations['only_pickup'] = get_post_meta( $variations[ 'only_pickup' ], 'only_pickup', true );
    return $variations;
}

function sortCartItemsByParent($cartItems){
    $result = [];

    foreach ($cartItems as $cart_item_key => $cartItem) {
        /**@var WC_Product_Variable $_product*/
        $_product = apply_filters('woocommerce_cart_item_product', $cartItem['data'], $cartItem, $cart_item_key);

        $parentId = $_product->get_parent_id();
        if (!array_key_exists($parentId, $result)){
            $title = $_product->get_title();
            $result[ $parentId ] = [
                'parentId' => $parentId,
                'name' => $title,
                'variations' => []
            ];
            $result[ $parentId ]['stock_status'] = '';
        }
        $result[ $parentId ]['stock_status'] = $_product->get_stock_status() === 'onbackorder'? 'onbackorder' : '';
        $result[ $parentId ]['variations'][$cart_item_key] = $cartItem;
    }

    return $result;
}

