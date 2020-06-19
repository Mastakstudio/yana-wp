<?php
if (!defined('ABSPATH')) exit();


class CustomUser {

	/**@var WP_User $user*/
	private $user = null;
	/**@var string $_secondName*/
	private $_secondName = "";
	/**@var string $_passportSeries*/
	private $_passportSeries = "";
	/**@var string $_passportNumber*/
	private $_passportNumber = "";
	/**@var string $_passportWhen*/
	private $_passportWhen = "";
	/**@var string $_passportWho*/
	private $_passportWho = "";
	/**@var string $_birthday*/
	private $_birthday = "";
	/** @var $_courseTestResults CourseTestResult[] */
	private $_courseTestResults = [];
	/** @var $_allSolved boolean */
	private $_allSolved = true;

	/**@deprecated */
	public $authorized = false;

	public function __construct() {

		$user = $this->GetCurrentUser();
		if (!is_null($user) && $user->ID !== 0){
			$this->user = $user;

			$this->_secondName = $this->CarbonMeta(U_SECOND_NAME );
			$this->_passportSeries = $this->CarbonMeta(U_PASSPORT_SERIES );
			$this->_passportNumber = $this->CarbonMeta(U_PASSPORT_NUMBER );
			$this->_passportWhen = $this->CarbonMeta(U_PASSPORT_WHEN );
			$this->_passportWho = $this->CarbonMeta(U_PASSPORT_WHO );
			$this->_birthday = $this->CarbonMeta(U_BIRTHDAY );


			$course_test_result_args =[
				'post_type' => 'course_test_result',
				'posts_per_page' => -1,
				'meta_query' => [
					[
						'key' => '_'.TEST_USER_ID,
						'value' => $user->ID,
						'compare' => '=',
					]
				]
			];
			$query = new WP_Query($course_test_result_args);
			foreach ($query->posts as $course_test_result){
				$buff =  new CourseTestResult($course_test_result);
				$this->_courseTestResults[] = $buff;

				if (!$buff->solved) $this->_allSolved = false;
			}
		}

	}
	/**@return string*/
	public function GetSecondName(){
		return $this->_secondName;
	}
	/**@return string*/
	public function GetPassportSeries(){
		return $this->_passportSeries;
	}
	/**@return string*/
	public function GetPassportNumber(){
		return $this->_passportNumber;
	}
	/**@return string*/
	public function GetPassportWhen(){
		return $this->_passportWhen;
	}
	/**@return string*/
	public function GetPassportWho(){
		return $this->_passportWho;
	}
	/**@return string*/
	public function GetBirthday(){
		return $this->_birthday;
	}
	/**@return string*/
	public function GetFirstName(){
		return $this->user->first_name;
	}
	/**@return string*/
	public function GetLastName(){
		return $this->user->last_name;
	}
	/**@return integer*/
	public function GetID(){
		return $this->user->ID;
	}
	/**@return string*/
	public function GetDisplayName(){
		return $this->user->display_name;
	}

	public function TestResultsView(){
		if ($this->_allSolved):
		?>
			<p>ваш сертификат</p>
		<?php
		else:
			foreach ( $this->_courseTestResults as $result ) {
				echo '<p>'.$result->post->post_title.'</p>';
				echo '<p>результат :<span>'.($result->solved?'пройден':'активен').'</span></p>';
			}
		endif;
	}

	public function LogOut(){
		$this->user = null;
	}

	/**@return WP_User|null */
	public function GetCurrentUser(){
		$tryGetUser = wp_get_current_user();
		if ($tryGetUser->ID === 0) return null;
		else return $tryGetUser;
	}

	/**@return boolean*/
	public function IsAuthorized(){
		if (!is_null($this->user))
			return true;

		$user = $this->GetCurrentUser();
		if (is_null($user))
			return false;

		$this->user = $user;
		return true;
	}

	/**
	 * @param $key string
	 * @return string
	 */
	private function CarbonMeta($key){
		return carbon_get_user_meta($this->user->ID, $key );
	}


	/** @deprecated */
	public static function UserIsAuthorized(){
		$tryGetUser = wp_get_current_user();
		return $tryGetUser->get_site_id() !== 0? $tryGetUser : false;
	}
}