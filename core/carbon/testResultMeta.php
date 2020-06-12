<?php
if (!defined('ABSPATH')) exit();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_test_result_settings');
function crb_test_result_settings()
{
    Container::make_post_meta("Meta")
        ->where('post_type', '=', 'course_test_result')
       ->add_fields([
//	       Field::make_text(TEST_ID, 'Тест ID'),
//	       Field::make_text(TEST_COURSE_ID, 'TEST_COURSE_ID'),
//	       Field::make_text(TEST_USER_ID, 'TEST_USER_ID'),
//	       Field::make_text(TEST_ANSWERED, 'TEST_ANSWERED'),
//	       Field::make_text(TEST_RIGHT_ANSWERED, 'TEST_RIGHT_ANSWERED'),
//	       Field::make_text(TEST_STARTED, 'TEST_STARTED'),
//	       Field::make_text(TEST_END_TIME, 'TEST_END_TIME'),
//	       Field::make_text(TEST_START_TIME, 'TEST_START_TIME'),
	       Field::make_text(TEST_ID, 'Тест ID')
	            ->set_attribute( 'readOnly', 'readOnly' ),
	       Field::make_text(TEST_COURSE_ID, 'TEST_COURSE_ID')
	            ->set_attribute( 'readOnly', 'readOnly' ),
	       Field::make_text(TEST_USER_ID, 'TEST_USER_ID')
	            ->set_attribute( 'readOnly', 'readOnly' ),
	       Field::make_text(TEST_ANSWERED, 'TEST_ANSWERED')
	            ->set_attribute( 'readOnly', 'readOnly' ),
	       Field::make_text(TEST_RIGHT_ANSWERED, 'TEST_RIGHT_ANSWERED')
	            ->set_attribute( 'readOnly', 'readOnly' ),
	       Field::make_text(TEST_STARTED, 'TEST_STARTED')
	            ->set_attribute( 'readOnly', 'readOnly' ),
	       Field::make_text(TEST_END_TIME, 'TEST_END_TIME')
	            ->set_attribute( 'readOnly', 'readOnly' ),
	       Field::make_text(TEST_START_TIME, 'TEST_START_TIME')
	            ->set_attribute( 'readOnly', 'readOnly' ),
       ]);
}