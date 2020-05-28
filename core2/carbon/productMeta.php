<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_prod_settings');
function crb_prod_settings()
{
	$delivery_steps_labels = array(
		'plural_name' => 'Delivery steps',
		'singular_name' => 'Delivery step',
	);
	$step_rows = array(
		'plural_name' => 'Step rows',
		'singular_name' => 'Step row',
	);
	
    Container::make_post_meta("Product images")
        ->where('post_type', '=', 'product')
        ->add_fields(
            [
                Field::make_image(PREFIX .'card_image', 'Home page')->set_width(50),
                Field::make_image(PREFIX .'card_archive_image', 'Archive page page')->set_width(50),
                Field::make_textarea(PREFIX .'text_under_the_order_button', 'text under the order button'),
	            Field::make_separator(PREFIX.'delivery', 'Delivery' ),
	            Field::make_textarea(PREFIX .'preorder_text', 'Text for preorder'),
	            Field::make_complex('steps', 'Delivery steps')
		            ->setup_labels( $delivery_steps_labels )
		            ->set_layout('tabbed-horizontal')
		            ->add_fields('step',[
			            Field::make_text('title', 'Step title'),
			            Field::make_complex('rows', 'Rows')
				            ->set_layout('tabbed-vertical')
				            ->add_fields('regular',[ Field::make_text('text') ])
				            ->set_header_template( '<% if (text) { %> <%- text %> <% } %>' )
				            ->add_fields('bold',[ Field::make_text('text') ])
				            ->set_header_template( '<% if (text) { %> <%- text %> <% } %>' )
				            ->add_fields('with_dots',[ Field::make_text('text') ])
				            ->set_header_template( '<% if (text) { %> <%- text %> <% } %>' )
				            ->setup_labels( $step_rows )
		            ])
		            ->set_collapsed(true)
		            ->set_header_template( '<% if (title) { %> <%- title %> <% } %>' )
//			    ->set_layout('tabbed-vertical')
//		            ->set_collapsed(true)
//		            ->set_header_template( '<% if (title) { %> <%- title %> <% } %>' ),
            ]
        );
	 
}