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
	 * @return CoursePart[]
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


	/**
	 * @param $part WP_Post
	 * @return array
	 */
	public static function getNextPartLink($part){
		$currentID = $part->ID;
		$parentID = $part->post_parent;

		$nextPart = [
			'last' => true
		];

		$args = [
			'post_type'      => 'course',
			'posts_per_page' => -1,
			'post_parent'    => $parentID,
			'order'          => 'ASC'
		];

		$parts = new WP_Query( $args );

		if (is_array($parts->posts) && count($parts->posts) > 0){
			for ($i = 0; $i < count($parts->posts); $i++ ){
				/**@var $checkedPart WP_Post*/
				$checkedPart = $parts->posts[$i];

				if ($checkedPart->ID === $currentID){
					if (isset($parts->posts[$i+1])){
						$needetPart = $parts->posts[$i+1];
						$nextPart['title'] = $needetPart->post_title;
						$nextPart['id'] = $needetPart->ID;
						$nextPart[ 'last' ] = false;
						break;
					}
				}
			}
		}
		wp_reset_postdata();



		return $nextPart;
	}


}