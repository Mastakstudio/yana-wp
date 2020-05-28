<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_prod_settings');
function crb_prod_settings()
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
	
    Container::make_post_meta("Meta")
        ->where('post_type', '=', 'product')
       ->add_fields([
	       Field::make_text('short_desc_title', 'Дополнительно'),
       ]);
	 
}