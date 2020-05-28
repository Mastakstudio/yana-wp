<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_delivery_page_settings');
function crb_delivery_page_settings()
{
	$delivery_items_labels = array(
		'plural_name' => 'Delivery items',
		'singular_name' => 'Delivery item',
	);
	$delivery_steps_labels = array(
		'plural_name' => 'Delivery steps',
		'singular_name' => 'Delivery step',
	);
	$step_rows = array(
		'plural_name' => 'Step rows',
		'singular_name' => 'Step row',
	);
	
    Container::make_post_meta("Delivery Page Settings")
        ->where('post_template', '=', 'template-delivery.php')
	    ->add_fields([
		    Field::make_text(PREFIX.'subtitle','Subtitle'),
	    	Field::make_complex(PREFIX.'delivery_items', 'Delivery items' )
			    ->setup_labels( $delivery_items_labels )
			    ->add_fields('delivery_item',[
			    	Field::make_text('title', 'Item title')->set_width(70),
				    Field::make_image('img_id', 'Item image')->set_width(30),
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
			    	])
//			    ->set_layout('tabbed-vertical')
			    ->set_collapsed(true)
			    ->set_header_template( '<% if (title) { %> <%- title %> <% } %>' ),


	    ]);
}