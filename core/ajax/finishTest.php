<?php
add_filter( 'wp_mail_content_type', 'set_html_content_type' );
function set_html_content_type() {
	return "text/html";
}

add_action( 'wp_ajax_finishTest', 'finishTest' );
add_action( 'wp_ajax_nopriv_finishTest', 'finishTest' );


function finishTest() {

	$answered = empty( $_POST['answered'] ) ? 0 : (integer)esc_attr( $_POST['answered'] );
	$right    = empty( $_POST['right'] ) ? 0 : (integer)esc_attr( $_POST['right'] );
	$test_id  = empty( $_POST['test_id'] ) ? 0 : (integer)esc_attr( $_POST['test_id'] );

	if ($test_id == 0) {
		wp_send_json_error(['text' => 'тест не найден']);
		wp_die();
	}
	TestResultManager::getInstance();
	$testResult = TestResultManager::GetTestResultsByCoursePartId($test_id);
	$newValues = [
		'_'.TEST_SOLVED => 'yes',
		'_'.TEST_RIGHT_ANSWERED => $right,
		'_'.TEST_ANSWERED => $answered
	];
	TestResultManager::UpdateMeta($testResult, $newValues);

	$newAns= carbon_get_post_meta($testResult->getID(), TEST_ANSWERED);
	$newRightAns= carbon_get_post_meta($testResult->getID(), TEST_RIGHT_ANSWERED);
	$newSolved= carbon_get_post_meta($testResult->getID(), TEST_SOLVED);

	if ($newAns != $answered || $newRightAns != $right ){
		wp_send_json_error(['text' => 'ошибка сохранения теста']);
		wp_die();
	}

	wp_send_json_success();
	wp_die();
}