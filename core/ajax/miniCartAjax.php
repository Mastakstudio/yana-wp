<?php

class MINICART_AJAX {

	/**
	 * Hook in ajax handlers.
	 */
	public static function init() {
		self::add_ajax_events();
		add_action( 'template_redirect', array( __CLASS__, 'do_prosuhsi_ajax' ), 0 );
	}

	/**
	 * Get WC Ajax Endpoint.
	 *
	 * @param string $request Optional.
	 *
	 * @return string
	 */
	public static function get_endpoint( $request = '' ) {
		return esc_url_raw(
			add_query_arg( 'prosushi_minicart-ajax', $request,
				remove_query_arg( [
					'remove_item',
					'add-to-cart',
					'order_again',
					'_wpnonce'
				],
					home_url( '/', 'minicart' ) ) ) );
	}

	/**
	 * Set WC AJAX constant and headers.
	 */
	public static function define_ajax() {
		if ( ! empty( $_GET['prosushi_minicart-ajax'] ) ) {
			if ( ! defined( 'DOING_AJAX' ) ) {
				define( 'DOING_AJAX', true );
			}
			if ( ! defined( 'PROSUSHI_DOING_AJAX' ) ) {
				define( 'PROSUSHI_DOING_AJAX', true );
			}
			if ( ! WP_DEBUG || ( WP_DEBUG && ! WP_DEBUG_DISPLAY ) ) {
				@ini_set( 'display_errors', 0 );
			}

			$GLOBALS['wpdb']->hide_errors();
		}
	}

	/**
	 * Hook in methods - uses WordPress ajax handlers (admin-ajax).
	 */
	public static function add_ajax_events() {
		$ajax_events_nopriv = [
			'add_to_cart',
			'remove_from_cart',
			'remove_from_order',
			'change_cart_item_quantity',
			'change_cart_item_quantity_checkout',
		];

		foreach ( $ajax_events_nopriv as $ajax_event ) {
			add_action( 'wp_ajax_prosushi_' . $ajax_event, array( __CLASS__, $ajax_event ) );
			add_action( 'wp_ajax_nopriv_prosushi_' . $ajax_event, array( __CLASS__, $ajax_event ) );

			// WC AJAX can be used for frontend ajax requests.
			add_action( 'prosushi_ajax_' . $ajax_event, array( __CLASS__, $ajax_event ) );
		}
	}

	/**
	 * Send headers for WC Ajax Requests.
	 *
	 * @since 2.5.0
	 */
	private static function prosushi_ajax_headers() {
		if ( ! headers_sent() ) {
			send_origin_headers();
			send_nosniff_header();
			wc_nocache_headers();
			header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
			header( 'X-Robots-Tag: noindex' );
			status_header( 200 );
		} elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			headers_sent( $file, $line );
			trigger_error( "prosushi_ajax_headers cannot set headers - headers already sent by {$file} on line {$line}", E_USER_NOTICE ); // @codingStandardsIgnoreLine
		}
	}

	/**
	 * Check for WC Ajax request and fire action.
	 */
	public static function do_prosuhsi_ajax() {
		global $wp_query;

		if ( ! empty( $_GET['prosushi_minicart-ajax'] ) ) {
			$wp_query->set( 'prosushi_minicart-ajax', sanitize_text_field( wp_unslash( $_GET['prosushi_minicart-ajax'] ) ) );
		}

		$action = $wp_query->get( 'prosushi_minicart-ajax' );

		if ( $action ) {
			self::prosushi_ajax_headers();
			$action = sanitize_text_field( $action );
			do_action( 'prosushi_ajax_' . $action );
			wp_die();
		}
	}

	public static function generate_mini_cart_item( $cart_item_key, $cart_item ) {
		ob_start();
		ms_cart_item_view( $cart_item_key, $cart_item );

		return ob_get_clean();
	}

	/**
	 * AJAX add to cart.
	 */
	public static function add_to_cart() {
		if ( ! isset( $_POST['product_id'] ) ) {
			return;
		}
		/**@var WC_Cart $cart */
		$cart         = WC()->cart;
		$product_id   = absint( $_POST['product_id'] );
		$variation_id = 0;
		$variation    = array();
		$product      = wc_get_product( $product_id );

		if ( ! $product ) {
			wp_send_json_error( 'product d\'not exist' );

			return;
		}

		if ( isset( $_POST['variation_id'] ) && ! empty( $_POST['variation_id'] ) ) {
			foreach ( $_POST as $key => $value ) {
				if ( $key === 'product_id' || $key === 'variation_id' || $key === 'quantity' ) {
					continue;
				}
				$variation[ $key ] = $value;
			}
			$variation_id     = $_POST['variation_id'];
			$product_cart_key = $cart->generate_cart_id( $product_id, $variation_id, $variation );
		} else {
			$product_cart_key = $cart->generate_cart_id( $product_id );
		}


		$in_cart = $cart->find_product_in_cart( $product_cart_key );


		try {
			$cart_item_key = $cart->add_to_cart( $product_id, 1, $variation_id, $variation );
		} catch ( Exception $e ) {
			wp_send_json_error( 'woocommerce cart error' );

			return;
		}

		$cart_item = $cart->get_cart_item( $cart_item_key );
		$data      = [
			'product_cart_key' => $product_cart_key,
			'product_id'       => $product_id,
			'cart_total'       => $cart->get_cart_total(),
			'line_total'       => get_woocommerce_currency_symbol() . $cart_item['line_total'],
			'is_new_item'      => ! $in_cart,
			'view' => self::generate_mini_cart_item( $cart_item_key, $cart_item )
		];

		wp_send_json_success( $data );

		return;
	}

	/**
	 * AJAX remove from cart.
	 */
	public static function remove_from_cart() {
		/**@var WC_Cart $cart */
		$cart = WC()->cart;

		$cart_item_key = wc_clean( isset( $_POST['cart_item_key'] ) ? wp_unslash( $_POST['cart_item_key'] ) : '' );
		if ( $cart_item_key && false !== $cart->remove_cart_item( $cart_item_key ) ) {
			$data = [
				'cart_total' => $cart->get_cart_total(),
			];

			if (isset($_POST['cart_item_key']) && $_POST['cart_item_key']){
				ob_start();
				get_template_part('/core/views/checkoutTotal');
				$data['total-checkout-wrapper'] = ob_get_clean();
			}
			wp_send_json_success( $data );
		} else {
			wp_send_json_error();
		}
	}

	/**
	 * AJAX cart item change quantity
	 */
	public static function change_cart_item_quantity() {
		/**@var WC_Cart $cart */
		$cart = WC()->cart;

		$cart_item_key = wc_clean( isset( $_POST['cart_item_key'] ) ? wp_unslash( $_POST['cart_item_key'] ) : '' );
		$quantity      = wc_clean( isset( $_POST['quantity'] ) ? wp_unslash( $_POST['quantity'] ) : '' );

		$cart->set_quantity( $cart_item_key, $quantity, true );
		$cartItem = $cart->cart_contents[ $cart_item_key ];

		$product = $cartItem['data'];
		ob_start();
		get_template_part( '/core/views/checkoutTotal' );
		$cartTotals = ob_get_clean();
		ob_start();
		checkOutProductView( $cart_item_key, $cartItem );
		$prodView = ob_get_clean();

		$data = [
			'fragments' => [
				'cartTotals' => $cartTotals,
				'prod'       => $prodView
			]
		];
        wp_send_json_success( $data );
    }

	/**
	 * AJAX cart item change quantity
	 */
	public static function change_cart_item_quantity_checkout() {
		/**@var WC_Cart $cart */
		$cart = WC()->cart;

		$cart_item_key = wc_clean( isset( $_POST['cart_item_key'] ) ? wp_unslash( $_POST['cart_item_key'] ) : '' );
		$product_id    = wc_clean( isset( $_POST['product_id'] ) ? wp_unslash( $_POST['product_id'] ) : '' );
		$quantity      = wc_clean( isset( $_POST['quantity'] ) ? wp_unslash( $_POST['quantity'] ) : '' );

		if ( empty( $cart_item_key ) && empty( $product_id ) && empty( $quantity ) ) {
			wp_send_json_error();
		}

		$cart->set_quantity( $cart_item_key, $quantity, true );


		$data = [ 'cartTotals' => self::getCartTotals() ];

		$cartItem = $cart->cart_contents[ $cart_item_key ];

		/**@var WC_Product_Simple $product */
		$product                   = $cartItem['data'];
		$data['item']              = $cartItem;
		$data['item']['quantity']  = $cartItem['quantity'];
		$data['item']['subtotals'] = '<span>' . $cartItem['line_subtotal'] . '<span>' . getBelRubCurrency() . '</span><span>/</span><span>' . $product->get_weight() * $cartItem['quantity'] . '</span><span>г.</span></span>';
		$minimal_order_sum         = carbon_get_theme_option( 'minimal_order_sum' );


		$data['available_methods'] = self::get_available_methods();

		wp_send_json_success( $data );
	}

	public static function get_available_methods() {
		$available_methods = [];
		$packages          = WC()->shipping()->get_packages();
		foreach ( $packages as $i => $package ) {
			/**@var WC_Shipping_Rate $rate */
			foreach ( $package['rates'] as $rate ) {
				if ( ! empty( $minimal_order_sum ) && (integer) $minimal_order_sum > 0 ) {
					if ( (integer) $minimal_order_sum > WC()->cart->get_subtotal() ) {
						if ( $rate->get_method_id() !== 'local_pickup' ) {
							continue;
						}
					}
				}

				$methods                                     = [
					'name'        => 'shipping_method[' . $i . ']',
					'data-index'  => $i,
					'id'          => 'shipping_method_' . $i . '_' . esc_attr( sanitize_title( $rate->id ) ),
					'id_sanitize' => esc_attr( sanitize_title( $rate->id ) ),
					'value'       => esc_attr( $rate->id ),
					'data-cost'   => $rate->get_cost(),
					'method_id'   => $rate->get_method_id(),
					'label'       => $rate->get_label()
				];
				$available_methods[ $rate->get_method_id() ] = $methods;
			}
		}

		return $available_methods;
	}
}

MINICART_AJAX::init();