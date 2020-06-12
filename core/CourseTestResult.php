<?php

class CourseTestResult {
	/**@var $post WP_Post*/
	public $post = null;
	public $test_id;
	public $course_id;
	public $user_id;
	private $answered;
	private $right_answered;
	public $started;
	public $end_time;
	public $start_time;
	public $solved;

	/**
	 * @param WP_Post
	 */
	public function __construct( $post ) {
		$this->post = $post;
		$this->test_id = (integer)carbon_get_post_meta($post->ID, TEST_ID);
		$this->course_id = (integer)carbon_get_post_meta($post->ID, TEST_COURSE_ID);
		$this->user_id = (integer)carbon_get_post_meta($post->ID, TEST_USER_ID);

		$this->answered = (integer)carbon_get_post_meta($post->ID, TEST_ANSWERED);
		$this->right_answered = (integer)carbon_get_post_meta($post->ID, TEST_RIGHT_ANSWERED);
		$this->started = (boolean)carbon_get_post_meta($post->ID, TEST_STARTED);
		$this->end_time = carbon_get_post_meta($post->ID, TEST_END_TIME);
		$this->start_time = carbon_get_post_meta($post->ID, TEST_START_TIME);
		$this->solved = carbon_get_post_meta($post->ID, TEST_SOLVED);

	}

	public function getEndTime($time_limit){
		$newDate = null;
		if ($this->started){
			$newDate = DateTime::createFromFormat('M d, Y G:i:s', $this->start_time);
		}else{
			$newDate = new DateTime();
			update_post_meta($this->post->ID, TEST_STARTED, $newDate->format('M d, Y G:i:s'));
		}
		$newDate = $newDate->add($time_limit);
		return $newDate->format('M d, Y G:i:s');
	}

	public function getID(){
		return $this->post->ID;
	}

	public function getAnsweredQuantity(){
		return $this->answered;
	}
	public function getRightAnsweredQuantity(){
		return $this->right_answered;
	}

}