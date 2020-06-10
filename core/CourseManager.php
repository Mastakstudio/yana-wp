<?php


class CourseManager {
	/**
	 * @param Course $course
	 *
	 * @return array
	 */
	public static function GetCoursePartByParent($course){
		$id = $course->course->ID;

		return self::GetCoursePartByParentID($id);
	}
	/**
	 * @param integer $id
	 *
	 * @return array
	 */
	public static function GetCoursePartByParentID($id) {

		$args = [
			'post_type'      => 'course',
			'posts_per_page' => -1,
			'post_parent'    => $id,
			'order'          => 'ASC'
		];

		$parts = new WP_Query( $args );

		$result = [];
		if (is_array($parts->posts) && count($parts->posts) > 0){
			foreach ($parts->posts as $part){
				$result[] = new CoursePart($part->ID);
			}
		}
		wp_reset_postdata();

		return $result;
	}


}