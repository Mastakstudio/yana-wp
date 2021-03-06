<?php
if (!defined('ABSPATH')) exit();


class TestResultManager {

	private static $current_test_result = [];
	private static $instances = [];

	private function __construct() {
		self::$current_test_result[0] = null;
	}

	/**
	 * @param Course $course
	 *
	 * @return array
	 */
	public static function GetTestResultsByCourse($course){
		$id = $course->course->ID;

		return self::GetTestResultsByCourseID($id);
	}

	/**
	 * @param integer $id
	 *
	 * @return CourseTestResult[]
	 */
	public static function GetTestResultsByCourseID($id) {
		$userManager = UserManager::getInstance();
		/**@var $user CustomUser*/
		$user = $userManager->GetCurrentUser();

		$args = [
			'post_type'      => 'course_test_result',
			'posts_per_page' => -1,
			'meta_query' => [
				[
					'key' => '_'.TEST_COURSE_ID,
					'value' => $id,
					'compare' => '=',
				],
				[
					'key' => '_'.TEST_USER_ID,
					'value' => $user->GetID(),
					'compare' => '=',
				]
			]
		];

		$parts = new WP_Query( $args );

		$result = [];
		if (is_array($parts->posts) && count($parts->posts) > 0){
			/**@var $part WP_Post */
			foreach ($parts->posts as $part){
				$buff = new CourseTestResult( $part );
				$result[$buff->test_id] = $buff;
			}
		}
		return $result;
	}

	/**
	 * @return CourseTestResult[]
	 */
	public static function GetTestResultsByUser() {
		$userManager = UserManager::getInstance();
		$user = $userManager->GetCurrentUser();
		$args = [
			'post_type'      => 'course_test_result',
			'posts_per_page' => -1,
			'meta_query' => [
				[
					'key' => '_'.TEST_USER_ID,
					'value' => $user->GetID(),
					'compare' => '=',
				]
			]
		];

		$parts = new WP_Query( $args );

		$result = [];
		if (is_array($parts->posts) && count($parts->posts) > 0){
			/**@var $part WP_Post */
			foreach ($parts->posts as $part){
				$buff = new CourseTestResult( $part );
				$result[$buff->test_id] = $buff;
			}
		}
		return $result;
	}

	/**
	 * @param CoursePart $part
	 *
	 * @return CourseTestResult
	 */
	public static function GetTestResultsByCoursePart($part){
		$id = $part->part->ID;
		return self::GetTestResultsByCoursePartId($id);
	}

	/**
	 * @param integer $partId
	 *
	 * @return CourseTestResult
	 */
	public static function GetTestResultsByCoursePartId($partId){
		$id = $partId;
		$userManager = UserManager::getInstance();
		/**@var $user CustomUser*/
		$user = $userManager->GetCurrentUser();

		$args = [
			'post_type'      => 'course_test_result',
			'posts_per_page' => 1,
			'meta_query' => [
				[
					'key' => '_'.TEST_ID,
					'value' => $id,
					'compare' => '=',
				],
				[
					'key' => '_'.TEST_USER_ID,
					'value' => $user->GetID(),
					'compare' => '=',
				]
			]
		];
		$parts = new WP_Query( $args );

		if (is_array($parts->posts) && isset($parts->posts[0]))
			return new CourseTestResult( $parts->posts[0] );

		return null;
	}

	/**
	 * @return null|CourseTestResult
	 */
	public static function getCurrentTestResult() {
		$part = get_post(Get_the_ID());

		if ($part->page_template === "template-course-part.php"){
			if (is_null(self::$current_test_result[0])){
				self::$current_test_result[0] = self::GetTestResultsByCoursePartId($part->ID);
			}
		}else{
			return null;
		}
		return self::$current_test_result[0];
	}

	/**
	 * @param CourseTestResult $testResult
	 * @param integer $timeLimit
	 */
	public function startTest( $testResult , $timeLimit){
		$intervalTimeLimit = new DateInterval( 'P' . $timeLimit . 'D' );
		$date = new DateTime();

		$startDate = $date->format('M d, Y G:i:s');
		$endDate = $date->add($intervalTimeLimit);

		$updateMetaArgs = [
			'_'.TEST_STARTED => true,
			'_'.TEST_START_TIME => $startDate,
			'_'.TEST_END_TIME => $endDate->format('M d, Y G:i:s'),
		];
		TestResultManager::UpdateMeta($testResult, $updateMetaArgs);
	}

//	CRUD start

	/**@param array
	 * @return CourseTestResult|WP_Post|null
	 */
	public static function Create($args){

		$userManager = UserManager::getInstance();
		/**@var $user CustomUser*/
		$user = $userManager->GetCurrentUser();



		$test_results = [
			'_'.TEST_ANSWERED => 0,
			'_'.TEST_RIGHT_ANSWERED => 0,
			'_'.TEST_ID => $args['test_id'],
			'_'.TEST_COURSE_ID => $args['course_id'],
			'_'.TEST_USER_ID =>  $user->GetID(),
			'_'.TEST_STARTED => false,
			'_'.TEST_END_TIME => '',
			'_'.TEST_START_TIME => ''
		];


		$post_id = wp_insert_post([
			'post_title' => $user->GetDisplayName().'_'.$args['test_title'],
			'post_type' => 'course_test_result',
			'post_status' => 'publish',
			'meta_input' => $test_results
		], true);

		$result = null;
		if ($post_id) {
			$result = get_post($post_id);
			$result = new CourseTestResult($result);
		}
		return $result;
	}

	/**
	 * @param $fields array
	 * @param $target CourseTestResult
	 */
	public static function UpdateMeta($target, $fields){
		if (is_array($fields) && count($fields) > 0){
			foreach ( $fields as $key => $value ) {
				update_post_meta($target->getID(), $key,$value);
			}
		}
	}

//	CRUD end

	protected function __clone() { }

	public function __wakeup()
	{
		throw new \Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): TestResultManager
	{
		$cls = static::class;
		if (!isset(self::$instances[$cls])) {
			self::$instances[$cls] = new static;
		}
		return self::$instances[$cls];
	}
}