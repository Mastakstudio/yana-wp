<?php
if (!defined('ABSPATH')) exit();
require_once 'TestResultManager.php';

class Course {
	/**
     * @var CoursePart[] $courseParts
     */
	private $courseParts;
	/**
     * @var CourseTestResult[] $testResult
     */
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

		$buff = CourseManager::GetCoursePartByParent( $this );
		$this->courseParts = $this->FilterPartsByUser($buff);
		$this->testResult  = TestResultManager::GetTestResultsByCourse( $this );

		foreach ( $this->courseParts as $part ) {
		    $currentPartResult = $this->HasResult( $part->getID() );
			if ( $currentPartResult == false  ) {
				$args                                = [
					'test_id'    => $part->getID(),
					'course_id'  => $this->getID(),
					'test_title' => $this->getTitle() ."_". $part->getTitle(),
                    'time_limit' => $part->getTestTimeLimit()
				];
				$currentPartResult = TestResultManager::Create( $args );
			}
			$this->testResult[ $part->getID() ] = $currentPartResult;
		}

		$this->resetIfExpired();
	}

	/**
	 * @param integer
	 *
	 * @return boolean|CourseTestResult
	 */
	private function HasResult( $part_id ) {
		foreach ( $this->testResult as $item ) {
			if ( $item->test_id == $part_id ) {
				return $item;
			}
		}

		return false;
	}

	/**
     * @return CoursePart[]
     */
	public function getParts() {
		return $this->courseParts;
	}

	/**
	 * @param $part CoursePart
	 *
	 * @return CourseTestResult
	 */
	public function getTestResultByCoursePart( $part ) {
		return $this->testResult[ $part->part->ID ];
	}

	/**
	 * @return integer
	 */
	public function getID(){
	    return $this->course->ID;
    }

	/**
	 * @return string
	 */
	public function getTitle(){
		return $this->course->post_title;
	}

    /**
     * @param $user CustomUser
     */
	public function getPartsViewByUserRole($user){
		$parts = $this->getParts();
		if ( is_array( $parts ) && count( $parts ) ) {
			foreach ( $parts as $part ) {

				$currentRoles = $user->GetUserRole();
				$targetRoles = $part->getTargetRoles();

				$displayToAdmin = in_array('administrator', $currentRoles);
				$displayToCurrentUser = false;

				foreach ( $currentRoles as $role ) {
					if (in_array( $role, $targetRoles )){
						$displayToCurrentUser = true;
						break;
					}
				}
                if ($displayToAdmin || $displayToCurrentUser){
	                $this->PartView($part);
                }
			}
		}
	}

	/**
	 * @var $parts CoursePart[]
     *
     * @return CoursePart[]
	 */
	private function FilterPartsByUser($parts){
		$userManager = UserManager::getInstance();
		$user        = $userManager->GetCurrentUser();
		$currentRoles = $user->GetUserRole();
		$result = [];
		if ( !is_array( $parts ) || count( $parts ) <= 0 )
		    return $result;

        if (is_array($currentRoles) && count($currentRoles) > 0){
	        foreach ( $parts as $part ) {


		        $targetRoles = $part->getTargetRoles();

		        $displayToAdmin = in_array('administrator', $currentRoles);
		        $displayToCurrentUser = false;

		        foreach ( $currentRoles as $role ) {
			        if (in_array( $role, $targetRoles )){
				        $displayToCurrentUser = true;
				        break;
			        }
		        }

		        if ($displayToAdmin || $displayToCurrentUser){
			        $result[] = $part;
		        }
	        }
        }
		return $result;
    }

	/**@param $part CoursePart
	 * @throws Exception
	 */
	private function PartView($part){



		$testResult = $this->getTestResultByCoursePart( $part );
		$imgUrl = $part->getImgUrl();

		$intervalTimeLimit = new DateInterval( 'P' . $part->getTestTimeLimit() . 'D' );

		$EndTime = $testResult->getEndTime( $intervalTimeLimit );

		$questionsQuantity     = $part->getQuestionsQuantity();
		$answeredQuantity      = $testResult->getAnsweredQuantity();
		$rightAnsweredQuantity = $testResult->getRightAnsweredQuantity();
		$rightP                = $rightAnsweredQuantity === 0 ? 0 : $rightAnsweredQuantity * 100 / $questionsQuantity;
		?>
        <div class="course-page__item">
            <div class="course-page__content-item">
                <a class="course-page__title" href="<?= get_permalink( $part->Part()->ID ) ?>"><?= $part->getTitle() ?></a>
                <div class="course-page__inner-content-item">
					<?php if (!empty($imgUrl)): ?>
                        <div class="course-page__image-content-item">
                            <img class="course-page__about-image" src="<?= $imgUrl ?>" alt=""/>
                        </div>
					<?php endif; ?>
                    <div class="course-page__text-content-item">
                        <div class="course-page__title-content-item">
                            <span>Освещенные темы</span>
                            <img class="course-page__button"
                                 src="/wp-content/themes/Yana/src/icons/plus.svg" alt=""/>
                        </div>
                        <div class="course-page__list-content-item">
							<?php $part->getPreviewDesc() ?>
                        </div>
                        <div class="course-page__link-to desktope-link">
                            <a class="link" href="<?= get_permalink( $part->Part()->ID ) ?>" target="_blank">Продолжить обучение</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="course-page__info-item">
                <div class="course-page__title-info-item">
                    <span>информация</span>
                    <img class="course-page__button" src="/wp-content/themes/Yana/src/icons/plus.svg" alt=""/>
                </div>
                <div class="course-page__content-info-item">
					<?php if ( $testResult->solved ): ?>
                        <span class="course-page__desc-info-item" style="margin-bottom: 1rem;">Тест выполнен</span>
					<?php else: ?>
                        <span class="course-page__desc-info-item">До окончания выполнения задания осталось:</span>
                        <div class="course-page__time-info-item" data-time="<?= $EndTime ?>">
                            <ul>
                                <li><span>Дней:</span><span class="days"></span></li>
                                <li><span>Часов:</span><span class="hours"></span></li>
                                <li><span>Минут:</span><span class="minutes"></span></li>
                            </ul>
                        </div>
					<?php endif; ?>
                    <div class="course-page__text-info-item">
                        <div class="course-page__type-text-info-item">
                            <span class="course-page__type-text-info-item-title">Вопросов всего:</span>
                            <div class="course-page__line"></div>
                            <span class="course-page__type-text-info-item-number"><?= $questionsQuantity ?></span>
                        </div>
                        <div class="course-page__type-text-info-item">
                            <span class="course-page__type-text-info-item-title">Отвечено:</span>
                            <div class="course-page__line"></div>
                            <span class="course-page__type-text-info-item-number"><?= $answeredQuantity ?></span>
                        </div>
                        <div class="course-page__type-text-info-item">
                            <span class="course-page__type-text-info-item-title">Правильно:</span>
                            <div class="course-page__line"></div>
                            <span class="course-page__type-text-info-item-number"><?= $rightAnsweredQuantity ?></span>
                        </div>
                    </div>
                    <div class="course-page__procent-info-item">
                        <div class="course-page__circle-procent-info-item"></div>
                        <span class="course-page__procent-info-item-number"><?= (integer) $rightP ?>%</span>
                        <span class="course-page__procent-info-item-text">усвоенного материала</span>
                    </div>
                    <div class="course-page__link-to mobile-link">
                        <a class="link" href="<?= get_permalink( $part->Part()->ID ) ?>" target="_blank">Продолжить обучение</a>
                    </div>
                </div>
            </div>

        </div>
		<?php
	}

	private function resetIfExpired(){
		$now = new DateTime();
		$needReset = false;
		foreach ( $this->testResult as $item ) {
		    if (!$item->started)
		        continue;

			$date = DateTime::createFromFormat('M d, Y G:i:s', $item->end_time);

			if( $date < $now ){
				$needReset = true;
				break;
			}

        }

		if ($needReset){
			foreach ( $this->testResult as $item ) {
			    TestResultManager::UpdateMeta($item, [
				    '_'.TEST_ANSWERED => 0,
				    '_'.TEST_RIGHT_ANSWERED => 0,
				    '_'.TEST_STARTED => false,
				    '_'.TEST_END_TIME => '',
				    '_'.TEST_START_TIME => '',
                    '_'.TEST_SOLVED => false
                ]);
			}
		}
	}
}


class CoursePart {
	/**@var WP_Post $part */
	public $part;
	/**@var string $preview_desc */
	private $preview_desc;
	/**@var string $subtitle */
	private $subtitle;
	/**@var array $main_info */
	private $main_info;
	/**@var array $additional_info */
	private $additional_info;
	/**@var array $test */
	private $test;
	/**@var $targetRole array*/
	private $targetRole;

	private $time_limit;

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
		$this->subtitle    = carbon_get_post_meta( $id, PREFIX . '$subtitle' );
		$this->main_info       = carbon_get_post_meta( $id, PREFIX . 'main_info' );
		$this->additional_info = carbon_get_post_meta( $id, PREFIX . 'additional_info' );
		$this->test            = carbon_get_post_meta( $id, PREFIX . 'test' );
		$this->time_limit      = carbon_get_post_meta( $id, PREFIX . 'time_limit' );
		$this->targetRole = carbon_get_post_meta($id, PREFIX.'target_roles');
	}

	/**
	 * @return integer
	 */
	public function getID(){
		return $this->part->ID;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->part->post_title;
	}

	public function getPart() {
		return $this->part;
	}


	/**
	 * @var WP_Post $part
	 * @return WP_Post|null
	 */
	public function Part( $part = null ) {
		if ( is_null( $part ) )  return $this->part;
		else $this->part = $part;
	}


	public function getAdditionalInfo() {
		if ( empty( $this->additional_info ) ) {
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

	public function getSubtitle() {
			return $this->subtitle;
	}

	public function getImgUrl() {
		return get_the_post_thumbnail_url( $this->part->ID ,'full' );
	}

	public function getTest() {
		if ( empty( $this->test ) ) {
			return;
		}
		?>

        <div class="test__content">
            <span class="title title_blue">тестирование</span>
            <div class="test__content-list">
	            <?php
	            for ( $i = 0; count( $this->test ) > $i; $i ++ ) :
		            $question = $this->test[ $i ];
		            $displayOnlyFirst = $i == 0 ? ' test__content-item_active': '';
		            ?>
                    <div class="test__content-item<?= $displayOnlyFirst ?>" data-id="question-<?= $i + 1 ?>">
                        <div class="test__content-item-head">
                            <span class="test__content-number"><?= $i + 1 ?></span>
                            <span class="test__content-title"><?= $question['text'] ?></span>
                        </div>
                        <div class="test__content-item-check">
	                        <?php
	                        for ( $j = 0; count( $question['answers'] ) > $j; $j ++ ) :
		                        $answer = $question['answers'][ $j ];
		                        $is_correct = $answer['is_correct']? 'true': 'false';
		                        ?>
                                <div class="test__content-check">
                                    <label class="test__container">
	                                    <?= $answer['text'] ?>
                                        <input type="radio" name="question-<?= $i ?>" data-is-correct="<?= $is_correct?>">
                                        <span class="test__checkmark"></span>
                                    </label>
                                </div>
	                        <?php endfor; ?>
                        </div>
                    </div>
	            <?php endfor; ?>
            </div>
        </div>
<!--        <span class="test__desc-title" style="display: none">Спасибо, Ваши ответы приняты</span>-->
<!--        test__desc-title_active     -->
        <span class="test__desc-title" >Спасибо, Ваши ответы приняты</span>
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

	public function getTestTimeLimit() {
		return $this->time_limit;
	}

	public function getQuestionsQuantity(){
	    return count($this->test);
	}

	public function getTargetRoles(){
	    return $this->targetRole;
	}
}