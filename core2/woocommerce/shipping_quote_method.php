<?php

/**
 * Plugin Name: Shop Custom Shipping Method
 * Plugin URI:
 * Description: Custom Shipping Method for WooCommerce
 * Version: 1.0.0
 * Author:
 * Author URI:
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path:
 * Text Domain:
 */

if ( ! defined( 'WPINC' ) ) { die; }

// Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    add_action( 'woocommerce_shipping_init', 'quote_shipping_method' );
    function quote_shipping_method() {
        if ( ! class_exists( 'WC_Quote_Shipping_Method' ) ) {
            class WC_Quote_Shipping_Method extends WC_Shipping_Method {

                public function __construct( $instance_id = 0 ) {
                    $this->instance_id 	  = absint( $instance_id );
                    $this->id                 = 'shipping_quote';//this is the id of our shipping method
                    $this->method_title       = 'Shipping quote';
                    //add to shipping zones list
                    $this->supports = array(
                        'shipping-zones',
                        //'settings', //use this for separate settings page
                        'instance-settings',
                        'instance-settings-modal',
                    );
                    //make it always enabled
                    $this->title = 'Shipping quote';
                    $this->enabled = 'yes';
                    $this->init();
                }

                function init() {
                    // Load the settings API
                    $this->init_form_fields();
                    $this->init_settings();
                    // Save settings in admin if you have any defined
                    add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
                }

                //Fields for the settings page
                function init_form_fields() {
                    //fileds for the modal form from the Zones window
                    $this->instance_form_fields = array(
                        'title' => array(
                            'title' => 'Name',
                            'type' => 'text',
                            'default' => 'Shipping quote'
                        ),
                        'selected_payment' => [
                            'title'       => 'Displayed payment',
                            'type'        => 'select',
                            'default'     => '---',
                            'options'     => $this->get_available_payments(),
                        ],
                    );
                    //$this->form_fields - use this with the same array as above for setting fields for separate settings page
                }

                public function calculate_shipping( $package = array()) {
                    //as we are using instances for the cost and the title we need to take those values drom the instance_settings
                    $intance_settings =  $this->instance_settings;
                    // Register the rate
                    $this->add_rate( array(
                            'id'      => $this->id,
                            'label'   => $intance_settings['title'],
                            'cost'    => $intance_settings['cost'],
                            'package' => $package,
                            'taxes'   => false,
                        )
                    );
                }

                private function get_available_payments(){
                    $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
                    $result = [];

                    foreach ($available_gateways as $key => $gateway) {
                        $result[$key] = $gateway->title;
                    }
                    return $result;
                }
            }
        }

        //add your shipping method to WooCommers list of Shipping methods
        add_filter( 'woocommerce_shipping_methods', 'add_shipping_quote_method' );
        function add_shipping_quote_method( $methods ) {
            $methods['shipping_quote'] = 'WC_Quote_Shipping_Method';
            return $methods;
        }
    }
}