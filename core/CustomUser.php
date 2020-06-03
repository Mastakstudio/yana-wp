<?php


class CustomUser {

	/**@var WP_User $user*/
	public $user = null;
	public $second_name = "";
	public $passport_series = "";
	public $passport_number = "";
	public $passport_when = "";
	public $passport_who = "";
	public $birthday = "";

	public $authorized = false;

	public function __construct() {
		/**@var WP_User $tryGetUser*/
		$tryGetUser = static::UserIsAuthorized();
		if ($tryGetUser !== false){
			$this->user = $tryGetUser;
			$this->authorized = true;

			$this->second_name = $this->CarbonMeta("second_name" );
			$this->passport_series = $this->CarbonMeta("passport_series" );
			$this->passport_number = $this->CarbonMeta("passport_number" );
			$this->passport_when = $this->CarbonMeta("passport_when" );
			$this->passport_who = $this->CarbonMeta("passport_who" );
			$this->birthday = $this->CarbonMeta("birthday" );
		}

	}

	public function GetSecondName(){
		return $this->second_name;
	}
	public function getPassportSeries(){
		return $this->passport_series;
	}
	public function GetPassportNumber(){
		return $this->passport_number;
	}
	public function GetPassportWhen(){
		return $this->passport_when;
	}
	public function GetPassportWho(){
		return $this->passport_who;
	}
	public function GetBirthday(){
		return $this->birthday;
	}

	public static function UserIsAuthorized(){
		$tryGetUser = wp_get_current_user();
		return $tryGetUser->get_site_id() !== 0? $tryGetUser : false;
	}

	private function CarbonMeta($key){
		return carbon_get_user_meta($this->user->get_site_id(), PREFIX.$key );
	}
}