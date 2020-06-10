<?php
require_once 'TestResultManager.php';

class Course {
	/** @var array $courseParts */
	private $courseParts;
	/** @var array $testResult */
	private $testResult;
	/** @var string $subtitle */
	private $subtitle;
	/** @var WP_Post $course */
	public $course;

	/**
	 * @param $id integer
	 * @param  $post WP_Post
	 */
	public function __construct( $id, $post = null ) {

		if ( is_null( $post ) ) {
			$this->course = get_post( $id );
		} else {
			$this->course = $post;
		}


		$this->subtitle = carbon_get_post_meta( $id, PREFIX . 'subtitle' );

		$this->courseParts = CourseManager::GetCoursePartByParent( $this );
		$this->testResult  = TestResultManager::GetTestResultsByCourse( $this );

		foreach ( $this->courseParts as $part ) {
			if ( ! $this->HasResult( $part->part->ID ) ) {
				$args                                = [
					'test_id'    => $part->part->ID,
					'course_id'  => $this->course->ID,
					'test_title' => $this->course->post_title,
				];
				$this->testResult[ $part->part->ID ] = TestResultManager::Create( $args );
			}
		}

	}

	/**
	 * @param integer
	 *
	 * @return boolean
	 */
	private function HasResult( $part_id ) {
		/**@var $item CourseTestResult */
		foreach ( $this->testResult as $item ) {
			if ( $item->test_id == $part_id ) {
				return true;
			}
		}

		return false;
	}

	public function getParts() {
		return $this->courseParts;
	}
}


class CoursePart {
	/**@var WP_Post $part */
	public $part;
	/**@var string $preview_desc */
	private $preview_desc;
	/**@var array $main_info */
	private $main_info;
	/**@var array $additional_info */
	private $additional_info;
	/**@var array $test */
	private $test;

	/**
	 * @param $id integer
	 * @param $post WP_Post
	 */
	public function __construct( $id, $post = null ) {
		if ( is_null( $post ) ) {
			$args  = [ 'post_type' => 'course', 'post__in' => [ $id ] ];
			$query = new WP_Query( $args );
			if ( count( $query->posts ) > 0 ) {
				$this->part = $query->posts[0];
			} else {
				$this->part = null;
			}
		} else {
			$this->part = $post;
		}

		$this->preview_desc    = carbon_get_post_meta( $id, PREFIX . 'preview_desc' );
		$this->main_info       = carbon_get_post_meta( $id, PREFIX . 'main_info' );
		$this->additional_info = carbon_get_post_meta( $id, PREFIX . 'additional_info' );
		$this->test            = carbon_get_post_meta( $id, PREFIX . 'test' );
	}

	public function getTitle() {
		return $this->part->post_title;
	}

	public function getPart() {
		return $this->part;
	}


	/**
	 * @return mixed|WP_Post|null
	 * @var WP_Post $part
	 */
	public function Part( $part = null ) {
		if ( is_null( $part ) ) {
			return $this->part;
		} else {
			$this->part = $part;
		}
	}

	public function getAdditionalInfo() {
		if ( ! is_array( $this->additional_info ) || empty( $this->additional_info ) ) {
			return;
		}
		?>
        <div class="test__resource">
            <span class="test__resource-title">Дополнительные ресурсы:</span>
            <div class="test__resource-list">
				<?php
				foreach ( $this->additional_info as $section ) {
					echo '<div class="test__resource-item"><span class="test__resource-item-name">' . $section['text'] . '</span>';

					foreach ( $section['links'] as $link ) {
						echo '<a class="test__resource-item-link" href="' . esc_url( $link['text'] ) . '"  target="_blank">' . esc_url( $link['text'] ) . '</a>';
					}

					echo '</div>';
				} ?>
            </div>
        </div>
		<?php
	}

	public function getTest() {
		if ( ! is_array( $this->test ) || empty( $this->test ) ) {
			return;
		}
		?>
        <div class="test__content">
            <span class="title title_blue">тестирование</span>
            <div class="test__content-list">

				<?php
				for ( $i = 0; count( $this->test ) > $i; $i ++ ) {
					$question = $this->test[ $i ];
					?>
                    <div class="test__content-item" data-id="question-<?= $i + 1 ?>">
                        <div class="test__content-item-head">
                            <span class="test__content-number"><?= $i + 1 ?></span>
                            <span class="test__content-title"><?= $question['text'] ?></span>
                        </div>
                        <div class="test__content-item-check">
							<?php
							for ( $j = 0; count( $question['answers'] ) > $j; $j ++ ) {
								$answer = $question['answers'][ $j ];
								?>
                                <div class="test__content-check ">  <!-- correct error -->
                                    <label class="test__container">
										<?= $answer['text'] ?>
                                        <input type="radio" checked="checked" name="question-<?= $i ?>">
                                        <span class="test__checkmark"></span>
                                    </label>
                                </div>
							<?php } ?>
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
		<?php
	}

	public function getPreviewDesc( $echo = false ) {
		if ( $echo ) {
			ob_start();
		}

		if ( $this->preview_desc[0]['_type'] == 'list' ) {
			for ( $i = 0; $i < count( $this->preview_desc[0]['yana_preview_desc'] ); $i ++ ) {
				$text = $this->preview_desc[0]['yana_preview_desc'][ $i ]['text'];
				echo '<span class="course-page__type-content-item"><div class="course-page__type-content-item-number"><span>' . ( 1 + $i ) . '</span></div><span class="course-page__type-content-item-text">' . $text . '</span></span>';
			}
		} elseif ( $this->preview_desc[0]['_type'] == 'editor' ) {
			echo '<span class="course-page__type-content-item" style="width: 100%"><span class="course-page__type-content-item-text" style="width: 100%">' . apply_filters( 'the_content', $this->preview_desc[0]['text'] ) . '</span></span>';
		}

		if ( $echo ) {
			return ob_get_clean();
		}
	}

	public function getMainInfoBlock() {
		$modalCount = 0;
		foreach ( $this->main_info as $mainInfo ) {
			if ( $mainInfo['_type'] == 'video' ) {
//				if (false ){
				$modalCount ++;
				$text = $mainInfo['text'];
				$link = $mainInfo['youtube_link'];
				?>
                <a class="test__head-item test__video" href="#modal<?= $modalCount ?>">
                    <img src="/wp-content/themes/Yana/src/icons/play-video.svg"/>
                    <div class="test__head-item-content">
                        <span class="test__head-item-text"><?= $text ?></span>
                        <span class="test__head-item-link">(видео)</span>
                        <div class="popup">
                            <div class="remodal" data-remodal-id="modal<?= $modalCount ?>">
                                <button class="remodal-close" data-remodal-action="close"></button>
                                <iframe width="100%" height="100%"
                                        src="<?= esc_url( $link ) ?>" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                </a>
				<?php
			} else if ( $mainInfo['_type'] == 'link' ) {
				$text = $mainInfo['text'];
				$link = $mainInfo['link'];
				?>
                <a class="test__head-item test__pdf" href="<?= esc_url( $link ) ?>" target="_blank">
                    <img src="/wp-content/themes/Yana/src/icons/pdf.svg"/>
                    <div class="test__head-item-content">
                        <span class="test__head-item-text"><?= $text ?></span>
                        <span class="test__head-item-link">(инфографика)</span>
                    </div>
                </a>
				<?php
			}
		}
	}
}