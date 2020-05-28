<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
	$weight_units = [ 'kg' => 'kg', 'g' => 'g' , 'lb' => 'lb' , 'oz' => 'oz' ];
    Container::make_theme_options( 'theme_settings',__('Theme Settings'))
        ->set_page_file('theme-options')
        ->set_page_menu_title('Theme Settings')
        ->set_icon('dashicons-admin-generic')
        ->add_tab(__('Main options'), [
            Field::make_image(PREFIX . 'main_logo', 'Logo'),
	        Field::make_complex(PREFIX .'footer_links', 'Footer Links')
		        ->add_fields('link',[
			        Field::make_text('footer_link_title', 'Title'),
			        Field::make_select('footer_link', 'Link')
                        ->add_options('page_selecting')
		        ])
		        ->setup_labels( [
			        'plural_name' => 'Links',
			        'singular_name' => 'Link',
		        ] )
		        ->set_layout('tabbed-vertical')
		        ->set_header_template( '<% if (footer_link_title) { %> <%- footer_link_title %> <% } %>' ),
            Field::make_separator(PREFIX . 'footer_cookie_separator', 'Link to cookie page'),
            Field::make_text(PREFIX . 'footer_cookie_link_title', 'Title'),
            Field::make_select(PREFIX . 'footer_cookie_link', 'Link')
                ->add_options('page_selecting')
        ])
        ->add_tab(__('contact info'), [
            Field::make_separator('contact_info_separator', 'Contacts'),
            Field::make_text(PREFIX . 'phone_number', 'Phone')->set_width(50),
            Field::make_text(PREFIX . 'contact_email', 'Email')->set_width(50),
	        Field::make_text(PREFIX . 'address', 'Address'),
            Field::make_text(PREFIX . 'instagram_link', 'Instagram'),
            Field::make_text(PREFIX . 'facebook_link', 'Facebook'),
            Field::make_text(PREFIX . 'twitter_link', 'Twitter'),
            Field::make_text(PREFIX . 'linkedin_link', 'Linked In'),
            Field::make_text(PREFIX . 'pinterest_link', 'Pinterest'),

            Field::make_text(PREFIX . 'map_link', 'Map'),

            Field::make_separator('work_time_info_separator', 'Working hours'),
            Field::make_text(PREFIX . 'work_hours', 'Working hours'),
            Field::make_text(PREFIX . 'work_months', 'Working months')
        ])
        ->add_tab('woocommerce', [
            Field::make_separator(PREFIX.'prod_global_settings_separator', 'Switch of weight units'),
	        Field::make_text(PREFIX . 'first_button_text', 'Text of the first button')
		        ->set_width(50)
		        ->set_default_value('Metric System')
		        ->help_text('Display default weight unit'),
	        Field::make_text(PREFIX . 'second_button_text', 'Text of the second button')
		        ->set_width(50)
		        ->set_default_value('U.S. System')
		        ->help_text('Display custom weight unit'),
	        Field::make_select(PREFIX.'second_weight_unit', 'Default second weight unit')
	        ->add_options($weight_units)
	        ->set_default_value('kg')
		        ->set_width(50),
	        Field::make_checkbox(PREFIX.'display_custom_weight_val', 'Display custom weight value' )
		        ->help_text('Display custom weight unit instead of the built-in Converter')
		        ->set_width(50),
	        Field::make_checkbox(PREFIX.'_activate_auto_update_currency', 'Auto Update Currency Rate' )
		        ->help_text('Currency Rate will be updated automatically.'),
            Field::make_select(PREFIX.'main_category_id', 'Main Category')->add_options('product_category_selector'),
            Field::make_complex(PREFIX .'additional_shipping_text', 'Shipping Methods')
                ->add_fields('method', 'Метод',[
                    Field::make_textarea('text', 'Description'),
                    Field::make_select(PREFIX.'target_method', 'Target Method')
                        ->add_options(shipping_methods_list())
                        ->set_default_value('---')
                        ->set_width(80),
                ])
                ->set_layout('tabbed-vertical'),
        ]);
}


add_action('carbon_fields_theme_options_container_saved','check_need_do_auto_update', 20, 2);
function check_need_do_auto_update($user_data, $container){
	
	$fields = $container->get_fields();
	$need_auto_update = false;
	foreach ($fields as $field){
		if ($field->get_base_name() !== PREFIX.'_activate_auto_update_currency')
			continue;
		
		if (!empty($field->get_value()) && $field->get_value() === 'yes')
			$need_auto_update = true;
	}
	
	if (!$need_auto_update){
		deactivation_auto_update_currency();
		remove_action( 'admin_head', 'activation_auto_update_currency' );
	}else{
		add_action( 'admin_head', 'activation_auto_update_currency' );
	}
}

function deactivation_auto_update_currency() {
	wp_unschedule_hook( 'my_new_event' );
}

function activation_auto_update_currency() {
	wp_unschedule_hook( 'my_new_event' );
	wp_schedule_event( time(), 'five_min' , 'my_new_event' );
	
//	wp_schedule_event( time(), 'daily' , 'my_new_event' );
	// time() + 3600 = 1 час с текущего момента.

}

add_action( 'my_new_event','do_auto_update_currency' );
function do_auto_update_currency(){
	$wmc_settings = get_option( 'woo_multi_currency_params', [] );
	
	$original_price    = $wmc_settings['currency_default'];
	$other_currency = '';
	foreach ($wmc_settings['currency'] as $item) {
		if ($item === $wmc_settings['currency_default'])
			continue;
		else{
			$other_currency = $item;
			break;
		}
	}
	
	$currency_data = WOOMULTI_CURRENCY_F_Data::get_ins();
	$rates = $currency_data->get_exchange( $original_price, $other_currency );
	
	$result['currency_rate'] = [];
	foreach ($wmc_settings['currency'] as $currency) {
		$result['currency_rate'][] = $rates[$currency];
	}
	$args = wp_parse_args( $result, $wmc_settings );
	
	update_option( 'woo_multi_currency_params', $args );
}

// регистрируем 5минутный интервал
add_filter( 'cron_schedules', 'cron_add_five_min' );
function cron_add_five_min( $schedules ) {
	$schedules['five_min'] = array(
		'interval' => 60 * 5,
		'display' => 'Раз в 5 минут'
	);
	return $schedules;
}

function canada_provinces(){
    return["---" => "---",
        "ON" => "Ontario",
        "QC" => "Quebec",
        "NS" => "Nova Scotia",
        "NB" => "New Brunswick",
        "MB" => "Manitoba",
        "BC" => "British Columbia",
        "PE" => "Prince Edward Island",
        "SK" => "Saskatchewan",
        "AB" => "Alberta",
        "NL" => "Newfoundland and Labrador"];
}

function british_columbia_regional_districts(){
    return[
    "Alberni-Clayoquot"=>"Alberni-Clayoquot",
    "Bulkley-Nechako"=>"Bulkley-Nechako",
    "Capital"=>"Capital",
    "Cariboo"=>"Cariboo",
    "Central Coast"=>"Central Coast",
    "Central Kootenay"=>"Central Kootenay",
    "Central Okanagan"=>"Central Okanagan",
    "Columbia-Shuswap"=>"Columbia-Shuswap",
    "Comox Valley"=>"Comox Valley",
    "Cowichan Valley"=>"Cowichan Valley",
    "East Kootenay"=>"East Kootenay",
    "Fraser Valley"=>"Fraser Valley",
    "Fraser-Fort George"=>"Fraser-Fort George",
    "Kitimat-Stikine"=>"Kitimat-Stikine",
    "Kootenay Boundary"=>"Kootenay Boundary",
    "Metro Vancouver"=>"Metro Vancouver",
    "Mount Waddington"=>"Mount Waddington",
    "Nanaimo"=>"Nanaimo",
    "North Okanagan"=>"North Okanagan",
    "Northern Rockies"=>"Northern Rockies",
    "Okanagan-Similkameen"=>"Okanagan-Similkameen",
    "Peace Riverqathet"=>"Peace Riverqathet",
    "Stikine Region"=>"Stikine Region",
    "North Coast"=>"North Coast",
    "Squamish-Lillooet"=>"Squamish-Lillooet",
    "Strathcona"=>"Strathcona",
    "Sunshine Coast"=>"Sunshine Coast",
    "Thompson-Nicol"=>"Thompson-Nicola"
    ];
}