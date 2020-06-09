<?php

class UserManager {

	private static $accountPage = '';
	private static $signinPage = '';
	private static $current_user = [];
	private static $instances = [];

	private function __construct() {
		add_filter( 'auth_redirect_scheme', [$this, 'AuthRedirectScheme'], 10, 1 );
	}

	private function AuthRedirectScheme(){
	    return static::$accountPage;
    }

	public function LogIn(){
		if (!isset($_POST['log']) || !isset($_POST['pwd'])){
            return [
                    'invalidForm' => 'login',
                    'error' => 'invalid form data'
            ];
        }
		$log = $_POST['log'];
		$pwd = $_POST['pwd'];

		$loginResult = wp_authenticate_username_password(NULL, $log , $pwd );
		wp_set_current_user($loginResult->ID, $loginResult->user_email);
		wp_set_auth_cookie($loginResult->ID);

//		$loginResult = wp_authenticate( $log, $pwd );

		$result = [];
		if ( strtolower(get_class($loginResult)) == 'wp_user' ) {
			$this->RedirectToAccount();
		} elseif ( strtolower(get_class($loginResult)) == 'wp_error' ) {
			//User login failed
			/* @var WP_Error $loginResult */
			$result['result'] = false;
			$result['error'] = $loginResult->get_error_message();
		} else {
			//Undefined Error
			$result['result'] = false;
			$result['error'] = 'An undefined error has ocurred';
		}

		return $result;
	}
	public function LogOut(){

	}
	public function Registration(){
		if (!isset($_POST['user_email']) || !isset($_POST['pwd']) || !isset($_POST['confirmpwd'])){
			return [
				'invalidForm' => 'registration',
				'error' => 'invalid form data'
			];
		}
		$pwd = $_POST['pwd'];
		$errors = register_new_user( $_POST['user_email'], $_POST['user_email']);

		$result = [];
		if ( is_wp_error($errors) ){
			//Something's wrong
			$result['result'] = false;
			$result['error'] = $errors->get_error_message();
			$result['action'] = 'register';
			return $result;
		}

		if( is_multisite() ){
		    add_user_to_blog(get_current_blog_id(), $errors, get_option('default_role'));
		}
		wp_set_password($_POST['pwd'], $errors);
		update_user_meta( $errors, 'show_admin_bar_front', 'false' );

		$loginResult = wp_authenticate_username_password(NULL, $_POST['user_email'] , $pwd );
		wp_set_current_user($loginResult->ID, $loginResult->user_email);
		wp_set_auth_cookie($loginResult->ID);

		$this->RedirectToAccount();
	}

	public function RedirectToAccount(){
		if ( wp_redirect( static::$accountPage ) )
			exit;
	}
	public function RedirectToSignIn(){
		if ( wp_redirect( static::$signinPage ) )
			exit;
	}

	public function Init(){
		if (isset($_REQUEST['login'])){
			$this->LogIn();
		}elseif (isset($_REQUEST['registration'])){
			$this->Registration();
		}else{

		}

	}

	public function RegistrationForm(){
		?>
		<form class="sign-in__list" action="<?= get_the_permalink().'?registration' ?>" method="post" novalidate="novalidate">

			<div class="sign-in__item">
				<div class="sign-in__item-head">
					<span class="sign-in__item-title">Через социальные сети</span>
					<div class="social social social_account">
						<div class="social__list"><a class="social__item" href="">
								<svg class="social__image" width="29" height="30" viewbox="0 0 29 30" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M28.5408 14.8921C28.5408 23.1168 22.1517 29.7842 14.2704 29.7842C6.38907 29.7842 0 23.1168 0 14.8921C0 6.66742 6.38907 0 14.2704 0C22.1517 0 28.5408 6.66742 28.5408 14.8921ZM9.39166 14.8886C9.39166 12.0757 11.5758 9.79386 14.2737 9.79386C16.9692 9.79386 19.1558 12.0732 19.1558 14.8886C19.1558 17.7016 16.9716 19.9833 14.2737 19.9833C11.5782 19.9833 9.39166 17.704 9.39166 14.8886ZM11.1049 14.8886C11.1049 16.7154 12.5224 18.1955 14.2737 18.1955C16.025 18.1955 17.4433 16.7154 17.4425 14.8886C17.4425 13.0618 16.0242 11.5817 14.2737 11.5817C12.5232 11.5817 11.1049 13.0618 11.1049 14.8886ZM18.193 5.02666C16.4425 4.94144 12.1066 4.94558 10.3546 5.02666C8.81493 5.10195 7.45687 5.48997 6.36201 6.63251C4.72463 8.34122 4.73974 10.5812 4.76102 13.7373V13.7374C4.76352 14.1082 4.7661 14.4917 4.7661 14.8885C4.7661 15.2598 4.7642 15.6187 4.76236 15.9658V15.9658C4.74503 19.228 4.73326 21.4448 6.36201 23.1445C8.00239 24.8556 10.1726 24.8387 13.1628 24.8155H13.1628C13.5211 24.8128 13.8911 24.8099 14.2734 24.8099H14.3249C17.9512 24.8099 19.2107 24.8099 20.5008 24.2887C22.2632 23.5747 23.5935 21.9308 23.7235 18.978C23.806 17.1504 23.8012 12.6266 23.7235 10.7981C23.5666 7.31258 21.774 5.19874 18.193 5.02666ZM20.9638 21.8811C19.8591 23.0339 18.3604 23.0303 15.1232 23.0226C14.8454 23.0219 14.5547 23.0212 14.2504 23.0212L13.7059 23.0215C10.1376 23.0241 8.64218 23.0252 7.53694 21.8687C6.38711 20.6745 6.40612 18.8575 6.43372 16.2205C6.43819 15.7938 6.44288 15.3457 6.44288 14.8752C6.44288 14.4763 6.43945 14.0872 6.43612 13.7089V13.7088C6.40132 9.75289 6.37703 6.99175 10.3894 6.7773L10.4349 6.77562C11.409 6.73969 11.7353 6.72766 14.2393 6.72766L14.2749 6.75248C14.637 6.75248 14.9923 6.74909 15.3395 6.74578C19.0449 6.71043 21.8315 6.68385 22.0135 10.8776C22.0587 11.9241 22.069 12.2385 22.069 14.8877C22.0689 15.1254 22.0691 15.355 22.0693 15.5768V15.5781C22.0726 19.1693 22.074 20.7171 20.9638 21.8811ZM20.4899 9.59334C20.4899 10.251 19.9792 10.7841 19.3491 10.7841C18.719 10.7841 18.2083 10.251 18.2083 9.59334C18.2083 8.93571 18.719 8.40259 19.3491 8.40259C19.9792 8.40259 20.4899 8.93571 20.4899 9.59334Z" fill="white"/>
								</svg>
							</a>
							<a class="social__item" href="">
								<svg class="social__image" width="29" height="30" viewbox="0 0 29 30" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M28.5408 14.8921C28.5408 23.1168 22.1517 29.7842 14.2704 29.7842C6.38907 29.7842 0 23.1168 0 14.8921C0 6.66742 6.38907 0 14.2704 0C22.1517 0 28.5408 6.66742 28.5408 14.8921ZM15.3115 15.4753H17.8579L18.195 12.0571H15.3118V10.0434C15.3118 9.28814 15.79 9.1108 16.1301 9.1108H18.2036V5.78969L15.3459 5.77722C12.1742 5.77722 11.4536 8.2565 11.4536 9.8398V12.0539H9.61869V15.4753H11.4536V25.2109H15.3115V15.4753Z" fill="white" />
								</svg>
							</a>
							<a class="social__item" href="">
								<svg class="social__image" width="29" height="30" viewbox="0 0 29 30" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M28.5408 14.8921C28.5408 23.1168 22.1517 29.7842 14.2704 29.7842C6.38907 29.7842 0 23.1168 0 14.8921C0 6.66742 6.38907 0 14.2704 0C22.1517 0 28.5408 6.66742 28.5408 14.8921ZM14.8515 21.4239H13.7315C13.7315 21.4239 11.2601 21.5792 9.08389 19.2147C6.71049 16.6356 4.61437 11.5179 4.61437 11.5179C4.61437 11.5179 4.49353 11.1823 4.6248 11.0201C4.77234 10.8378 5.17426 10.8261 5.17426 10.8261L7.85165 10.8078C7.85165 10.8078 8.104 10.8518 8.28461 10.9901C8.43343 11.1043 8.51686 11.3177 8.51686 11.3177C8.51686 11.3177 8.94957 12.4598 9.5227 13.493C10.6412 15.51 11.1622 15.9513 11.542 15.7352C12.0953 15.42 11.9294 12.8837 11.9294 12.8837C11.9294 12.8837 11.9396 11.9631 11.6509 11.5532C11.4273 11.2354 11.0055 11.1428 10.8193 11.1168C10.6687 11.0958 10.916 10.7308 11.2365 10.567C11.7183 10.3206 12.5692 10.3066 13.5745 10.3174C14.3578 10.3257 14.5831 10.3766 14.8894 10.4539C15.6 10.6329 15.5778 11.2067 15.53 12.4446C15.5158 12.8145 15.4992 13.2437 15.4992 13.7394C15.4992 13.8509 15.4961 13.9698 15.4929 14.092C15.4763 14.726 15.4573 15.4519 15.8571 15.7216C16.0621 15.8597 16.5638 15.7423 17.8184 13.519C18.4131 12.4654 18.8591 11.2264 18.8591 11.2264C18.8591 11.2264 18.9565 11.0055 19.1079 10.9108C19.2628 10.8141 19.4716 10.8439 19.4716 10.8439L22.2892 10.8256C22.2892 10.8256 23.1358 10.7202 23.2729 11.1189C23.4166 11.5375 22.9564 12.515 21.8054 14.1161C20.7097 15.64 20.1786 16.198 20.2313 16.6938C20.2695 17.0533 20.6147 17.3802 21.2742 18.019C22.6611 19.3624 23.0307 20.0678 23.1186 20.2355C23.1257 20.2491 23.131 20.2591 23.1348 20.2657C23.7555 21.3398 22.4464 21.4239 22.4464 21.4239L19.944 21.4603C19.944 21.4603 19.4063 21.5715 18.6986 21.0642C18.3285 20.7991 17.9666 20.3662 17.6219 19.9538C17.0949 19.3233 16.6078 18.7405 16.1921 18.8781C15.4946 19.109 15.5165 20.6774 15.5165 20.6774C15.5165 20.6774 15.5216 21.0124 15.3626 21.1908C15.1899 21.3852 14.8515 21.4239 14.8515 21.4239Z" fill="white" />
								</svg>
							</a>
							<a class="social__item" href="">
								<svg class="social__image" width="35" height="25" viewbox="0 0 35 25" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M30.4981 1.05834C31.934 1.46193 33.0663 2.64334 33.4528 4.14213C34.171 6.87972 34.1434 12.586 34.1434 12.586C34.1434 12.586 34.1434 18.2633 33.4531 21.0011C33.0663 22.4997 31.9343 23.6813 30.4981 24.0847C27.8746 24.8054 17.3809 24.8054 17.3809 24.8054C17.3809 24.8054 6.91458 24.8054 4.26372 24.0561C2.82754 23.6525 1.69548 22.4708 1.30875 20.9723C0.618408 18.2633 0.618408 12.5572 0.618408 12.5572C0.618408 12.5572 0.618408 6.87972 1.30875 4.14213C1.69522 2.64361 2.85517 1.4331 4.26347 1.02978C6.88696 0.309082 17.3807 0.309082 17.3807 0.309082C17.3807 0.309082 27.8746 0.309082 30.4981 1.05834ZM22.7658 12.5571L14.0395 17.8025V7.31181L22.7658 12.5571Z" fill="white"/>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="sign-in__item">
				<div class="sign-in__item-head">
					<span class="sign-in__item-title">Или через e-mail</span>
				</div>
				<div class="sign-in__item-inputs">
					<div class="sign-in__item-input">
						<div class="form-input__item">
							<label class="form-input__item-label" for="user_email">Ваш e-mail</label>
							<input class="form-input__item-input" name="user_email" id="log" />
						</div>
					</div>
					<div class="sign-in__item-input">
						<div class="form-input__item">
							<label class="form-input__item-label">Придумайте пароль (минимум 8 символов)</label>
							<input class="form-input__item-input" name="pwd" type="password"/>
						</div>
					</div>
					<div class="sign-in__item-input">
						<div class="form-input__item">
							<LABEL class="form-input__item-label">Повторите пароль</LABEL>
							<input class="form-input__item-input" name="confirmpwd" type="password"/>
						</div>
					</div>
				</div>
			</div>
			<button class="custom-button">Зарегестрироваться</button>
		</form>
		<?php
	}
	public function LoginForm(){
		?>
		<form class="sign-in__list" action="<?= get_the_permalink().'?login' ?>" method="post">

			<div class="sign-in__item">
				<div class="sign-in__item-head">
					<span class="sign-in__item-title">Через социальные сети</span>
					<div class="social social social_account">
						<div class="social__list">
							<a class="social__item" href="">
								<svg class="social__image" width="29" height="30" viewbox="0 0 29 30" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M28.5408 14.8921C28.5408 23.1168 22.1517 29.7842 14.2704 29.7842C6.38907 29.7842 0 23.1168 0 14.8921C0 6.66742 6.38907 0 14.2704 0C22.1517 0 28.5408 6.66742 28.5408 14.8921ZM9.39166 14.8886C9.39166 12.0757 11.5758 9.79386 14.2737 9.79386C16.9692 9.79386 19.1558 12.0732 19.1558 14.8886C19.1558 17.7016 16.9716 19.9833 14.2737 19.9833C11.5782 19.9833 9.39166 17.704 9.39166 14.8886ZM11.1049 14.8886C11.1049 16.7154 12.5224 18.1955 14.2737 18.1955C16.025 18.1955 17.4433 16.7154 17.4425 14.8886C17.4425 13.0618 16.0242 11.5817 14.2737 11.5817C12.5232 11.5817 11.1049 13.0618 11.1049 14.8886ZM18.193 5.02666C16.4425 4.94144 12.1066 4.94558 10.3546 5.02666C8.81493 5.10195 7.45687 5.48997 6.36201 6.63251C4.72463 8.34122 4.73974 10.5812 4.76102 13.7373V13.7374C4.76352 14.1082 4.7661 14.4917 4.7661 14.8885C4.7661 15.2598 4.7642 15.6187 4.76236 15.9658V15.9658C4.74503 19.228 4.73326 21.4448 6.36201 23.1445C8.00239 24.8556 10.1726 24.8387 13.1628 24.8155H13.1628C13.5211 24.8128 13.8911 24.8099 14.2734 24.8099H14.3249C17.9512 24.8099 19.2107 24.8099 20.5008 24.2887C22.2632 23.5747 23.5935 21.9308 23.7235 18.978C23.806 17.1504 23.8012 12.6266 23.7235 10.7981C23.5666 7.31258 21.774 5.19874 18.193 5.02666ZM20.9638 21.8811C19.8591 23.0339 18.3604 23.0303 15.1232 23.0226C14.8454 23.0219 14.5547 23.0212 14.2504 23.0212L13.7059 23.0215C10.1376 23.0241 8.64218 23.0252 7.53694 21.8687C6.38711 20.6745 6.40612 18.8575 6.43372 16.2205C6.43819 15.7938 6.44288 15.3457 6.44288 14.8752C6.44288 14.4763 6.43945 14.0872 6.43612 13.7089V13.7088C6.40132 9.75289 6.37703 6.99175 10.3894 6.7773L10.4349 6.77562C11.409 6.73969 11.7353 6.72766 14.2393 6.72766L14.2749 6.75248C14.637 6.75248 14.9923 6.74909 15.3395 6.74578C19.0449 6.71043 21.8315 6.68385 22.0135 10.8776C22.0587 11.9241 22.069 12.2385 22.069 14.8877C22.0689 15.1254 22.0691 15.355 22.0693 15.5768V15.5781C22.0726 19.1693 22.074 20.7171 20.9638 21.8811ZM20.4899 9.59334C20.4899 10.251 19.9792 10.7841 19.3491 10.7841C18.719 10.7841 18.2083 10.251 18.2083 9.59334C18.2083 8.93571 18.719 8.40259 19.3491 8.40259C19.9792 8.40259 20.4899 8.93571 20.4899 9.59334Z" fill="white"/>
								</svg>
							</a>
							<a class="social__item" href="">
								<svg class="social__image" width="29" height="30" viewbox="0 0 29 30" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M28.5408 14.8921C28.5408 23.1168 22.1517 29.7842 14.2704 29.7842C6.38907 29.7842 0 23.1168 0 14.8921C0 6.66742 6.38907 0 14.2704 0C22.1517 0 28.5408 6.66742 28.5408 14.8921ZM15.3115 15.4753H17.8579L18.195 12.0571H15.3118V10.0434C15.3118 9.28814 15.79 9.1108 16.1301 9.1108H18.2036V5.78969L15.3459 5.77722C12.1742 5.77722 11.4536 8.2565 11.4536 9.8398V12.0539H9.61869V15.4753H11.4536V25.2109H15.3115V15.4753Z" fill="white"/>
								</svg>
							</a>
							<a class="social__item" href="">
								<svg class="social__image" width="29" height="30" viewbox="0 0 29 30" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M28.5408 14.8921C28.5408 23.1168 22.1517 29.7842 14.2704 29.7842C6.38907 29.7842 0 23.1168 0 14.8921C0 6.66742 6.38907 0 14.2704 0C22.1517 0 28.5408 6.66742 28.5408 14.8921ZM14.8515 21.4239H13.7315C13.7315 21.4239 11.2601 21.5792 9.08389 19.2147C6.71049 16.6356 4.61437 11.5179 4.61437 11.5179C4.61437 11.5179 4.49353 11.1823 4.6248 11.0201C4.77234 10.8378 5.17426 10.8261 5.17426 10.8261L7.85165 10.8078C7.85165 10.8078 8.104 10.8518 8.28461 10.9901C8.43343 11.1043 8.51686 11.3177 8.51686 11.3177C8.51686 11.3177 8.94957 12.4598 9.5227 13.493C10.6412 15.51 11.1622 15.9513 11.542 15.7352C12.0953 15.42 11.9294 12.8837 11.9294 12.8837C11.9294 12.8837 11.9396 11.9631 11.6509 11.5532C11.4273 11.2354 11.0055 11.1428 10.8193 11.1168C10.6687 11.0958 10.916 10.7308 11.2365 10.567C11.7183 10.3206 12.5692 10.3066 13.5745 10.3174C14.3578 10.3257 14.5831 10.3766 14.8894 10.4539C15.6 10.6329 15.5778 11.2067 15.53 12.4446C15.5158 12.8145 15.4992 13.2437 15.4992 13.7394C15.4992 13.8509 15.4961 13.9698 15.4929 14.092C15.4763 14.726 15.4573 15.4519 15.8571 15.7216C16.0621 15.8597 16.5638 15.7423 17.8184 13.519C18.4131 12.4654 18.8591 11.2264 18.8591 11.2264C18.8591 11.2264 18.9565 11.0055 19.1079 10.9108C19.2628 10.8141 19.4716 10.8439 19.4716 10.8439L22.2892 10.8256C22.2892 10.8256 23.1358 10.7202 23.2729 11.1189C23.4166 11.5375 22.9564 12.515 21.8054 14.1161C20.7097 15.64 20.1786 16.198 20.2313 16.6938C20.2695 17.0533 20.6147 17.3802 21.2742 18.019C22.6611 19.3624 23.0307 20.0678 23.1186 20.2355C23.1257 20.2491 23.131 20.2591 23.1348 20.2657C23.7555 21.3398 22.4464 21.4239 22.4464 21.4239L19.944 21.4603C19.944 21.4603 19.4063 21.5715 18.6986 21.0642C18.3285 20.7991 17.9666 20.3662 17.6219 19.9538C17.0949 19.3233 16.6078 18.7405 16.1921 18.8781C15.4946 19.109 15.5165 20.6774 15.5165 20.6774C15.5165 20.6774 15.5216 21.0124 15.3626 21.1908C15.1899 21.3852 14.8515 21.4239 14.8515 21.4239Z" fill="white"/>
								</svg>
							</a>
							<a class="social__item" href="">
								<svg class="social__image" width="35" height="25" viewbox="0 0 35 25" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M30.4981 1.05834C31.934 1.46193 33.0663 2.64334 33.4528 4.14213C34.171 6.87972 34.1434 12.586 34.1434 12.586C34.1434 12.586 34.1434 18.2633 33.4531 21.0011C33.0663 22.4997 31.9343 23.6813 30.4981 24.0847C27.8746 24.8054 17.3809 24.8054 17.3809 24.8054C17.3809 24.8054 6.91458 24.8054 4.26372 24.0561C2.82754 23.6525 1.69548 22.4708 1.30875 20.9723C0.618408 18.2633 0.618408 12.5572 0.618408 12.5572C0.618408 12.5572 0.618408 6.87972 1.30875 4.14213C1.69522 2.64361 2.85517 1.4331 4.26347 1.02978C6.88696 0.309082 17.3807 0.309082 17.3807 0.309082C17.3807 0.309082 27.8746 0.309082 30.4981 1.05834ZM22.7658 12.5571L14.0395 17.8025V7.31181L22.7658 12.5571Z" fill="white"/>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="sign-in__item">
				<div class="sign-in__item-head">
					<span class="sign-in__item-title">Или через e-mail</span>
				</div>
				<div class="sign-in__item-inputs">
					<div class="sign-in__item-input">
						<div class="form-input__item">
							<label class="form-input__item-label" for="user_login">Ваш e-mail</label>
							<input class="form-input__item-input" name="log" value="" autocapitalize="off"/>
						</div>
					</div>
					<div class="sign-in__item-input">
						<div class="form-input__item">
							<label class="form-input__item-label" for="user_pass">Пароль</label>
							<input class="form-input__item-input" name="pwd" id="user_pass" type="password"/>
						</div>
					</div>
				</div>
			</div>
			<button class="custom-button">Войти</button>
		</form>
		<?php
	}

	public static function GetCurrentUser(){
	    return self::$current_user[0];
	}

	protected function __clone() { }

	public function __wakeup()
	{
		throw new \Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): UserManager
	{
		$cls = static::class;
		if (!isset(self::$instances[$cls])) {
			self::$instances[$cls] = new static;
			$accountPageId = carbon_get_theme_option(PREFIX.'account_page');
			$signinPage = carbon_get_theme_option(PREFIX.'signin_page');

			self::$accountPage = get_permalink($accountPageId);
			self::$signinPage = get_permalink($signinPage);

			if (count(self::$current_user) === 0){
				self::$current_user[] = new CustomUser();
			}
		}
		return self::$instances[$cls];
	}
}