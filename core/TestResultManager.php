<?php


class TestResultManager {
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
	 * @param CoursePart $part
	 *
	 * @return CourseTestResult
	 */
	public static function GetTestResultsByCoursePart($part){
		$id = $part->part->ID;
		$userManager = UserManager::getInstance();
		/**@var $user CustomUser*/
		$user = $userManager::GetCurrentUser();

		$args = [
			'post_type'      => 'course_test_result',
			'posts_per_page' => 1,
			'meta_query' => [
				[
					'key' => PREFIX.'course_id',
					'value' => $id,
					'compare' => '=',
				],
				[
					'key' => PREFIX.'user_id',
					'value' => $user->user->ID,
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
	 * @param integer $id
	 *
	 * @return array
	 */
	public static function GetTestResultsByCourseID($id) {
		$userManager = UserManager::getInstance();
		/**@var $user CustomUser*/
		$user = $userManager::GetCurrentUser();

		$args = [
			'post_type'      => 'course_test_result',
			'posts_per_page' => -1,
			'meta_query' => [
				[
					'key' => PREFIX.'course_id',
					'value' => $id,
					'compare' => '=',
				],
				[
					'key' => PREFIX.'user_id',
					'value' => $user->user->ID,
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

	/**@param array
	 * @return WP_Post|null
	 */
	public static function Create($args){

		$userManager = UserManager::getInstance();
		/**@var $user CustomUser*/
		$user = $userManager::GetCurrentUser();

		$test_results = [
			PREFIX.'answered' => 0,
			PREFIX.'right_answered' => 0,
			PREFIX.'test_id' => $args['test_id'],
			PREFIX.'course_id' => $args['course_id'],
			PREFIX.'user_id' =>  $user->user->ID,
			PREFIX.'started' => false,
			PREFIX.'time_left' => ''
		];

		$post_id = wp_insert_post([
			'post_title' => $user->user->display_name.'_'.$args['test_title'],
			'post_type' => 'course_test_result',
			'post_status' => 'publish',

			'meta_input' => $test_results
		], true);

		$result = null;
		if ($post_id) {
			$result = get_post($post_id);
		}
		return $result;
	}

	/**@param array*/
	public static function Save($args){
		$test_results = [
			'your_custom_key1' => 'your_custom_value1',
			'your_custom_key2' => 'your_custom_value2'
		];

		$post_id = wp_update_post([
			'post_title' => $args['user_id'].'_'.$args['test_id'],
			'post_type' => 'course_test_result',
			'post_status' => 'publish',

			'meta_input' => $test_results
		]);

		if ($post_id) {
			// it worked :)
		}
	}

}