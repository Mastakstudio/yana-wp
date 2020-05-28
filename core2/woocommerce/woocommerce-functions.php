<?php
function fg_currency_selector($elementId = '') {
	if(! is_plugin_active( 'woo-multi-currency/woo-multi-currency.php' )) return;
	if (! class_exists('WOOMULTI_CURRENCY_F_Data')) return;

	
	$settings = WOOMULTI_CURRENCY_F_Data::get_ins();
	ob_start();
	$current_currency = $settings->get_current_currency();
	$links            = $settings->get_links();
	?>
	<div class="woo-multi-currency wmc-shortcode plain-horizontal falcon-glen-multi-currency" >
		<?php foreach ( $links as $k => $link ) :
			if ( $current_currency ) {
				if ( $current_currency == $k ) $class = "wmc-active";
				else $class = '';
			} ?>
			<div class="wmc-currency <?php echo esc_attr( $class ) ?>">
				<a rel="nofollow" href="<?php echo $class ? '' : esc_url( $link ) ?><?=empty($elementId)?'':'#'.$elementId?>">
					<?php echo esc_html( $k ) ?>
				</a>
			</div>
		<?php  endforeach; ?>
	</div>
	<?php return ob_get_clean();
}

function fg_second_currency_selector() {
	if(! is_plugin_active( 'woo-multi-currency/woo-multi-currency.php' ) || ! class_exists('WOOMULTI_CURRENCY_F_Data'))
		return;
	
	
	$settings = WOOMULTI_CURRENCY_F_Data::get_ins();
	ob_start();
	$current_currency = $settings->get_current_currency();
	$currencies            = $settings->get_currencies();
	?>
	<div class="woo-multi-currency wmc-shortcode plain-horizontal falcon-glen-multi-currency">
		<?php foreach ( $currencies as $currency ) :
			if ( $current_currency )
				$class = $current_currency == $currency ? "wmc-active" : ''; ?>
			<div class="wmc-currency <?php echo esc_attr( $class ) ?>" data-currency-symbol="<?= $currency ?>">
				<span ><?php echo esc_html( $currency ) ?></span>
			</div>
		<?php  endforeach; ?>
	</div>
	<?php return ob_get_clean();
}

function get_currency_data(){
	if(! is_plugin_active( 'woo-multi-currency/woo-multi-currency.php' )) return [];
	if (! class_exists('WOOMULTI_CURRENCY_F_Data')) return [];
	
	$settings = WOOMULTI_CURRENCY_F_Data::get_ins();
	return [
		'currencies' => $settings->get_list_currencies(),
		'default' => $settings->get_default_currency(),
	];
}

add_filter( 'product_type_selector', 'remove_product_types', 10, 1 );

function remove_product_types( $types ){
	unset( $types['grouped'] );
	unset( $types['external'] );
	unset( $types['simple'] );
	
	return $types;
}

function is_selected_shipping_pickup(){
	$chosen_shipping_method_ids = wc_get_chosen_shipping_method_ids();
	
	foreach ($chosen_shipping_method_ids as $chosen_shipping) {
		if (strpos($chosen_shipping, 'pickup') !== false)
			return true;
	}
	return false;
}

function disable_make_order(){
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		
		$only_pickup = get_post_meta( $_product->get_id(), 'only_pickup', true );
		if (!is_selected_shipping_pickup() && $only_pickup ==='yes')
			return 'disabled';
	}
	return '';
}

function fg_woocommerce_form_field( $key, $args, $value = null ) {
	$defaults = [
		'type'              => 'text',
		'label'             => '',
		'description'       => '',
		'placeholder'       => '',
		'maxlength'         => false,
		'required'          => false,
		'autocomplete'      => false,
		'id'                => $key,
		'class'             => ['order__tabs-ship-item'],
		'label_class'       => ['order__tabs-ship-label'],
		'input_class'       => ['order__tabs-container-item-input'],
		'return'            => false,
		'options'           => [],
		'custom_attributes' => [],
		'validate'          => [],
		'default'           => '',
		'autofocus'         => '',
		'priority'          => '',
	];

	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

	if ( $args['required'] ) {
		$args['class'][] = 'validate-required';
		$required        = '&nbsp;<abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
	} else
		$required = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
	
	if ( is_string( $args['label_class'] ) ){
		$args['label_class'] = [ $args['label_class'] ];
	}
	$args['label_class'][] = 'order__tabs-ship-label';
	
	if ( is_null( $value ) )
		$value = $args['default'];
	
	// Custom attribute handling.
	$custom_attributes         = [];
	$args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );
	
	if ( $args['maxlength'] )
		$args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
	
	if ( ! empty( $args['autocomplete'] ) )
		$args['custom_attributes']['autocomplete'] = $args['autocomplete'];
	
	if ( true === $args['autofocus'] )
		$args['custom_attributes']['autofocus'] = 'autofocus';
	
	if ( $args['description'] )
		$args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
	
	if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) )
		foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
		}
	
	if ( ! empty( $args['validate'] ) )
		foreach ( $args['validate'] as $validate ) {
			$args['class'][] = 'validate-' . $validate;
		}
	
	
	$field           = '';
	$label_id        = $args['id'];
	$sort            = $args['priority'] ? $args['priority'] : '';
	$field_container = '<div class="order__tabs-ship-item %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</div>';
	
	switch ( $args['type'] ) {
		case 'country':
			$countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

			if ( 1 === count( $countries ) ) {

				$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

				$field .= '<input type="hidden" name="' . esc_attr( $key )
					. '" id="' . esc_attr( $args['id'] )
					. '" value="' . current( array_keys( $countries ) ) . '" '
					. implode( ' ', $custom_attributes )
					. ' class="country_to_state" readonly="readonly" />';

			} else {

				$field = '<div class="order__tabs-container-item-inner-tab"><select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="order__tabs-ship-item-select country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . '><option value="">' . esc_html__( 'Select a country&hellip;', 'woocommerce' ) . '</option>';

				foreach ( $countries as $ckey => $cvalue ) {
					$field .= '<option class="order__tabs-ship-item-option" value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
				}

				$field .= '</select></div>';

				$field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'woocommerce' ) . '">' . esc_html__( 'Update country', 'woocommerce' ) . '</button></noscript>';

			}

			break;
		case 'state':
			$args['class'][] = 'input';
			/* Get country this state field is representing */
			$for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
			$states      = WC()->countries->get_states( $for_country );

			if ( is_array( $states ) && empty( $states ) ) {

				$field_container = '<p class="form-row order__tabs-ship-item %1$s" id="%2$s" style="display: none">%3$s</p>';

				$field .= '<div class="order__tabs-container-item-inner-tab"><input type="hidden" class="hidden" name="' . esc_attr( $key )
					. '" id="' . esc_attr( $args['id'] )
					. '" value="" ' . implode( ' ', $custom_attributes )
					. ' placeholder="' . esc_attr( $args['placeholder'] )
					. '" readonly="readonly" data-input-classes="'
					. esc_attr( implode( ' ', $args['input_class'] ) ) . '"/></div>';

			} elseif ( ! is_null( $for_country ) && is_array( $states ) ) {

				$field .= '<p class="form-row order__tabs-container-item-inner-tab"><select name="' . esc_attr( $key )
					. '" id="' . esc_attr( $args['id'] )
					. '" class="state_select order__tabs-ship-item-select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" '
					. implode( ' ', $custom_attributes )
					. ' data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_html__( 'Select an option&hellip;', 'woocommerce' ) )
					. '"  data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '">
						<option class="order__tabs-ship-item-option" value="">' . esc_html__( 'Select an option&hellip;', 'woocommerce' ) . '</option>';

				foreach ( $states as $ckey => $cvalue ) {
					$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
				}
				$field .= '</select></p>';
			} else {
				$field .= '<p class="form-row order__tabs-container-item-inner-tab"><input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) )
					. '" value="' . esc_attr( $value )
					. '"  placeholder="' . esc_attr( $args['placeholder'] )
					. '" name="' . esc_attr( $key )
					. '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes )
					. ' data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '"/></p>';

			}

			break;
		case 'textarea':
			$args['class'][] = 'input';
			$field .= '<div class="order__tabs-container-item-inner-tab"><textarea  name="' . esc_attr( $key )
				. '" class="input-text input-textarea ' . esc_attr( implode( ' ', $args['input_class'] ) )
				. '" id="' . esc_attr( $args['id'] )
				. '" placeholder="' . esc_attr( $args['placeholder'] ) . '" '
				. ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' )
				. implode( ' ', $custom_attributes ) . ' >' . esc_textarea( $value ) . '</textarea></div>';
            $required = '';
			break;
		case 'checkbox':
			$args['class'][] = 'input';
			$field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) .
				'><div class="order__tabs-container-item-inner-tab"><input type="' . esc_attr( $args['type'] )
				. '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) )
				. '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] )
				. '" value="1" ' . checked( $value, 1, false ) . ' /> </div>' . $args['label'] . $required . '</label>';
			
			break;
		case 'text':
		case 'password':
		case 'datetime':
		case 'datetime-local':
		case 'date':
		case 'month':
		case 'time':
		case 'week':
		case 'number':
		case 'email':
		case 'url':
		case 'tel':
		    $desc = '';
		    if($key ==='order_delivery_time'){
		        $desc = '<span class="order__agree-text">Morning / Afternoon</span></br>';
		    }
			$args['class'][] = 'input';
			$field .= '<div class="order__tabs-container-item-inner-tab"><input type="' . esc_attr( $args['type'] )
				. '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) )
				. '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] )
				. '" placeholder="' . esc_attr( $args['placeholder'] )
				. '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />'.$desc.'</div>';
			
			break;
		case 'select':
			$field   = '';
			$options = '';
			
			if ( ! empty( $args['options'] ) ) {
				foreach ( $args['options'] as $option_key => $option_text ) {
					if ( '' === $option_key ) {
						// If we have a blank option, select2 needs a placeholder.
						if ( empty( $args['placeholder'] ) ) {
							$args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
						}
						$custom_attributes[] = 'data-allow_clear="true"';
					}
					$options .= '<option class="order__tabs-ship-item-option" value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
				}
				
				$field .= '<div class="order__tabs-container-item-inner-tab"><select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select order__tabs-ship-item-select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select></div>';
			}
			
			break;
		case 'radio':
			$args['class'][] = 'input';
			$label_id .= '_' . current( array_keys( $args['options'] ) );
			
			if ( ! empty( $args['options'] ) ) {
				foreach ( $args['options'] as $option_key => $option_text ) {
					$field .= '<div class="order__tabs-container-item-inner-tab"><input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) )
						. '" value="'. esc_attr( $option_key )
						. '" name="' . esc_attr( $key )
						. '" '. implode( ' ', $custom_attributes )
						. ' id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' /></div>';
					
					$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . '</label>';
				}
			}
			
			break;
	}
	

    if(array_search("form-row",$args['class'],false) !== false){
        $args['class'][array_search("form-row",$args['class'],false)] = "form-row-wide";
    }

	if ( ! empty( $field ) ) {
		$field_html = '';

		if ($key === 'billing_address_2' || $key === 'shipping_address_2'){
            $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '" > ' . $args['placeholder'] . '</label>';
        }elseif ( $args['label'] && 'checkbox' !== $args['type'] ){
            $is_required = $args['required'] ? $required : '';
            $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] .  $is_required . '</label>';
		}

		
		$field_html .= $field;
		
		if ( $args['description'] )
			$field_html .= '<span class="description" id="' . esc_attr( $args['id'] ) . '-description" aria-hidden="true">' . wp_kses_post( $args['description'] ) . '</span>';
		
		$container_class = esc_attr( implode( ' ', $args['class'] ) );
		$container_id    = esc_attr( $args['id'] ) . '_field';
		$field           = sprintf( $field_container, $container_class, $container_id, $field_html );
	}
	
	if ( $args['return'] ){
		return $field;
	}
	else{
		echo $field;
	}
}

function change_text_form_field($paramField, $key, $args, $value){
	$field           = '';
	$label_id        = $args['id'];
	$sort            = $args['priority'] ? $args['priority'] : '';
	$field_container = '<div class="order__tabs-ship-item %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</div>';

    $desc = '';
	if ($key === 'e_deliverydate'){
        $field_container .= '';
		$desc = '<span class="order__agree-text">Same day pickup or local delivery may not be available - please call us to confirm</span></br>';

	}elseif($key ==='order_delivery_time'){
		$desc = '<span class="order__agree-text">morning / afternoon</span></br>';
	}
	// Custom attribute handling.
	$custom_attributes         = [];
	if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) )
		foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
		}
	
	if ( $args['required'] ) {
		$args['class'][] = 'validate-required';
		$required        = '&nbsp;<abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
	} else
		$required = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
	
	if ( is_string( $args['label_class'] ) ){
		$args['label_class'] = [ $args['label_class'] ];
	}
	$args['label_class'][] = 'order__tabs-ship-label';
	
	$args['input_class'][] = 'order__tabs-container-item-input';
	$args['class'][] = 'input';



	$field .= '<div class="order__tabs-container-item-inner-tab"><input type="' . esc_attr( $args['type'] )
		. '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) )
		. '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] )
		. '" placeholder="' . esc_attr( $args['placeholder'] )
		. '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />'.$desc.'</div>';

	if ( ! empty( $field ) ) {
		$field_html = '';

		if ( $args['label'] && 'checkbox' !== $args['type'] ){
            if ($key === 'billing_address_2' || $key === 'shipping_address_2'){
				$field_html .= '<span for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '" > ' . $args['label'] . '</span>';
			} else{
                $is_required = $args['required'] ? $required : '';
				$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] .  $is_required . '</label>';
			}

		}
		$field_html .= $field;

		$container_class = esc_attr( implode( ' ', $args['class'] ) );
		$container_id    = esc_attr( $args['id'] ) . '_field';
		$field           = sprintf( $field_container, $container_class, $container_id, $field_html );
	}
	
	return $field;
}

add_filter( 'woocommerce_form_field_text' , 'change_text_form_field', 10, 4);

remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );
add_action( 'woocommerce_checkout_terms_and_conditions', 'fg_terms_and_conditions_page_link', 35 );
function fg_terms_and_conditions_page_link() {
    $terms_page_id = wc_terms_and_conditions_page_id();

    if ( ! $terms_page_id )
        return;

    $page = get_post( $terms_page_id );

//    if ( $page && 'publish' === $page->post_status && $page->post_content && ! has_shortcode( $page->post_content, 'woocommerce_checkout' ) ) {
//        echo '<span><a href="'.get_permalink($terms_page_id).'">' . $page->post_title . '</a><span>';
//    }
}

remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20 );
add_action( 'woocommerce_checkout_terms_and_conditions', 'fg_checkout_privacy_policy_text', 25 );
function fg_checkout_privacy_policy_text() {
    wc_privacy_policy_text( 'checkout' );
}


add_filter( 'woocommerce_checkout_fields', 'change_woocommerce_checkout_fields' );
function change_woocommerce_checkout_fields( $fields ) {
    $fields['order']['order_comments']['placeholder'] = '';
//    $fields['order']['order_comments']['label'] = 'Pre-order for July or August?';
    return $fields;
}

/* Add custom field to the checkout page */
//add_action('ms_woocommerce_custom_order_fields', 'custom_checkout_field');
//function custom_checkout_field($checkout){
//    woocommerce_form_field('pre_order_data',
//        [
//        'type' => 'text',
//        'class' => [ 'my-field-class form-row-wide' ] ,
//        'label' => 'Pre-order for July or August?'
//            ] ,
//        $checkout->get_value('pre_order_data'));
//}

add_filter( 'default_checkout_billing_country', 'change_default_checkout_country' );
add_filter( 'default_checkout_billing_state', 'change_default_checkout_state' );

function change_default_checkout_country() {
    return 'CA'; // country code
}

function change_default_checkout_state() {
    return 'BC'; // state code
}


add_action( 'woocommerce_before_checkout_process', 'check_is_selected_shipping_method' );
function check_is_selected_shipping_method(){
    if (!isset($_POST['shipping_method']) || empty($_POST['shipping_method'])){
        throw new Exception(  'select the delivery method'   );
    }
    if (strpos($_POST['shipping_method'][0], "flat_rate") === 0 ){
	    if (isset($_POST['ship_to_different_address'])){
		    if ($_POST['shipping_country'] !== "CA" || $_POST['shipping_state'] !== "BC"){
			    throw new Exception(  'The addresses you provided are outside of our local delivery area, please contact us at orders@falconglen.ca  or call +1-(778)-859-2743 for help.'   );
		    }
	    }else{
		    if ($_POST['billing_country'] !== "CA" || $_POST['billing_state'] !== "BC"){
			    throw new Exception(  'You are outside of our local delivery area, please enter a different address that is located in the Vancouver / GVRD / Fraser Valley area only. Please use the Ship / deliver to a different address?'   );
		    }
	    }
    }
}
