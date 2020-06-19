<?php
if (!defined('ABSPATH')) exit();

class CourseTestResult {
	/**@var $post WP_Post*/
	public $post = null;
	/**@var $test_id integer*/
	public $test_id;
	/**@var $course_id integer*/
	public $course_id;
	/**@var $user_id integer*/
	public $user_id;
	/**@var $answered integer*/
	private $answered;
	/**@var $right_answered integer*/
	private $right_answered;
	/**@var $started boolean*/
	public $started;
	/**@var $end_time string*/
	public $end_time;
	/**@var $start_time string*/
	public $start_time;
	/**@var $solved boolean*/
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
		$this->solved = (boolean)carbon_get_post_meta($post->ID, TEST_SOLVED);

	}

	/**
	 * @param $time_limit DateInterval
	 * @return string
	 */
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

	/**
	 * @return integer
	 */
	public function getID(){
		return $this->post->ID;
	}
	/**
	 * @return integer
	 */
	public function getAnsweredQuantity(){
		return $this->answered;
	}

	/**
	 * @return integer
	 */
	public function getRightAnsweredQuantity(){
		return $this->right_answered;
	}
}