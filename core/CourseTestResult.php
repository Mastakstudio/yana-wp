<?php


class CourseTestResult {
	private $post = null;
	private $test_result_id;
	private $test_id;
	private $user_id;
	private $answered;

	/**
	 * @param array
	 *  'test_result'
	 *  'user_id'
	 *  'test_id'
	 */
	public function __construct($args = null) {
		if ($args['test_result'] !== null){
			$post = $args['test_result'];
			$this->post = $post;
			$this->test_result_id = $post->ID;
		}
		if (isset($args['test_id']) && !empty($args['test_id']))
			$this->test_id = $args['test_id'];

		if (isset($args['user_id']) && !empty($args['user_id']))
			$this->user_id = $args['user_id'];


	}

	public function save(){
		$test_results = [
			'your_custom_key1' => 'your_custom_value1',
			'your_custom_key2' => 'your_custom_value2'
		];

		$post_id = wp_insert_post([
			'post_title' => $this->user_id.'_'.$this->test_id,
			'post_type' => 'course_test_result',
			'post_status' => 'publish',

			'meta_input' => $test_results
		]);

		if ($post_id) {
			// it worked :)
		}
	}

}