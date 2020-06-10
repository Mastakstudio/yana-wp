<?php


class CourseTestResult {
	public $post = null;
	public $test_id;
	public $course_id;
	public $user_id;
	public $answered;
	public $right_answered;
	public $started;
	public $time_left;

	/**
	 * @param WP_Post
	 */
	public function __construct( $post ) {
		$this->post = $post;

		$this->answered = get_post_meta($post->ID, PREFIX.'answered',true);
		$this->right_answered = get_post_meta($post->ID, PREFIX.'right_answered',true);
		$this->time_left = get_post_meta($post->ID, PREFIX.'time_left',true);
		$this->course_id = get_post_meta($post->ID, PREFIX.'course_id',true);
		$this->test_id = get_post_meta($post->ID, PREFIX.'test_id',true);

	}

}