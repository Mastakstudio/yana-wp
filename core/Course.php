<?php


class Course {
	private $courseParts;
	private $subtitle;
	/**
	 * @var WP_Post $course
	 */
	private $course;

	/**
	 * @param $id integer
	 */
	public function __construct($id) {

		$args = array(
			'post_type' => 'course',
			'posts_per_page' => 5,
			'post__in' => [$id]
		);


		$query =  new WP_Query($args);
		if (count($query->posts) > 0){
			$this->course = $query->posts[0];
		}else{
			$this->course = null;
		}
		wp_reset_postdata();

		$this->subtitle = carbon_get_post_meta($id, PREFIX.'subtitle');

		$args = array(
			'post_type'      => 'course',
			'posts_per_page' => -1,
			'post_parent'    => $id,
			'order'          => 'ASC'
		);


		$parts = new WP_Query( $args );

		if (is_array($parts->posts) && count($parts->posts) > 0){
			foreach ($parts->posts as $part){
				$this->courseParts[] = new CoursePart($part->ID);
			}
		}
	}

	public function getParts(){
		return $this->courseParts;
	}
}


class CoursePart {
	/**@var WP_Post $part*/
	private $part;
	/**@var string $preview_desc*/
	private $preview_desc;
	/**@var array $main_info*/
	private $main_info;

	/**
	 * @param $id integer
	 * @param $post WP_Post
	 */
	public function __construct($id, $post = null) {
		if (is_null($post)){
			$args = ['post_type' => 'course','post__in' => [$id]];
			$query =  new WP_Query($args);
			if (count($query->posts) > 0){
				$this->part = $query->posts[0];
			}else{
				$this->part = null;
			}
		}else{
			$this->part = $post;
		}

		$this->preview_desc = carbon_get_post_meta($id, PREFIX.'preview_desc');
		$this->main_info = carbon_get_post_meta($id, PREFIX.'main_info');
	}

	public function getPart(){
		return $this->part;
	}
	public function getTitle(){
		return $this->part->post_title;
	}
	public function getPreviewDesc($echo = false){
		if ($echo) ob_start();

		if ($this->preview_desc[0]['_type'] == 'list'){
			for ($i = 0; $i < count($this->preview_desc[0]['yana_preview_desc']); $i++){
				$text = $this->preview_desc[0]['yana_preview_desc'][$i]['text'];
				echo '<span class="course-page__type-content-item"><div class="course-page__type-content-item-number"><span>'. (1 + $i).'</span></div><span class="course-page__type-content-item-text">'.$text.'</span></span>';
			}
		}elseif($this->preview_desc[0]['_type'] == 'editor'){
			echo '<span class="course-page__type-content-item" style="width: 100%">
<span class="course-page__type-content-item-text" style="width: 100%">'.apply_filters('the_content', $this->preview_desc[0]['text']).'</span></span>';
		}

		if ($echo) return ob_get_clean();
	}

	public function getMainInfoBlock(){
		$modalCount = 0;
		foreach ($this->main_info as $mainInfo){
			if ($mainInfo['_type'] == 'video' ){
				$modalCount++;
				$text = $mainInfo['text'];
				$link = $mainInfo['youtube_link'];
				?>
				<a class="test__head-item test__video" href="#modal<?= $modalCount ?>">
					<img src="/wp-content/themes/Yana/src/icons/play-video.svg"/>
					<div class="test__head-item-content">
						<span class="test__head-item-text"><?= $text?></span>
						<span class="test__head-item-link">(видео)</span>
						<div class="popup">
							<div class="remodal" data-remodal-id="modal<?= $modalCount ?>">
								<button class="remodal-close" data-remodal-action="close"></button>
								<iframe width="100%" height="100%"
								        src="<?= esc_url($link)?>" frameborder="0"
								        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
								        allowfullscreen=""></iframe>
							</div>
						</div>
					</div>
				</a>
				<?php
			}else if ($mainInfo['_type'] == 'link' ){
				$text = $mainInfo['text'];
				$link = $mainInfo['link'];
				?>
				<a class="test__head-item test__pdf" href="<?= esc_url($link)?>" target="_blank">
					<img src="/wp-content/themes/Yana/src/icons/pdf.svg"/>
					<div class="test__head-item-content">
						<span class="test__head-item-text"><?= $text?></span>
						<span class="test__head-item-link">(инфографика)</span>
					</div>
				</a>
				<?php
			}
		}
	}
}