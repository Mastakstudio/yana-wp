<?php
if (!defined('ABSPATH')) exit();

class UserManager {

	private static $accountPage = '';
	private static $signinPage = '';
	private static $mainCoursePage = '';
	private static $instances = [];
	private static $errors = [];

	private function __construct() {
		$accountPageId = carbon_get_theme_option( TO_ACCOUNT_PAGE );
		$signinPage    = carbon_get_theme_option( TO_SIGNIN_PAGE );
		$mainCoursePage    = carbon_get_theme_option( PREFIX . 'main_course_page' );

		add_filter( 'auth_redirect_scheme', [ $this, 'AuthRedirectScheme' ], 10, 1 );

		self::$accountPage = get_permalink( $accountPageId );
		self::$signinPage  = get_permalink( $signinPage );
		self::$mainCoursePage  = get_permalink( $mainCoursePage );
	}

	public function Registration() {
		if ( ! isset( $_POST['user_email'] ) || ! isset( $_POST['pwd'] ) || ! isset( $_POST['confirmpwd'] ) ) {
			return [
				'invalidForm' => 'registration',
				'error'       => 'invalid form data'
			];
		}

		$pwd    = $_POST['pwd'];
		$errors = register_new_user( $_POST['user_email'], $_POST['user_email'] );
		$regUser = null;

		if ( is_wp_error( $errors ) ) {
			return $errors;
		}else{
			$regUser = new WP_User($errors);
		}

		if ( is_multisite() ){
			add_user_to_blog( get_current_blog_id(), $errors, 'parent' );
        }else{
			$regUser->set_role('parent');
        }

		wp_set_password( $_POST['pwd'], $errors );
		update_user_meta( $errors, 'show_admin_bar_front', 'false' );

		$loginResult = wp_authenticate_username_password( null, $_POST['user_email'], $pwd );
		wp_set_current_user( $loginResult->ID, $loginResult->user_email );
		wp_set_auth_cookie( $loginResult->ID );

//		$this->RedirectToAccount();
		$this->RedirectToCourse();
	}

	public function LogIn() {
		if ( ! isset( $_POST['log'] ) || ! isset( $_POST['pwd'] ) ) {
			return [
				'invalidForm' => 'login',
				'error'       => 'invalid form data'
			];
		}
		$log = $_POST['log'];
		$pwd = $_POST['pwd'];

		$loginResult = wp_authenticate_username_password( null, $log, $pwd );
		if ( $loginResult instanceof WP_Error ) {
			return $loginResult;
		}
		wp_set_current_user( $loginResult->ID, $loginResult->user_email );
		wp_set_auth_cookie( $loginResult->ID );

//		$loginResult = wp_authenticate( $log, $pwd );

		$result = [];
		if ( $loginResult instanceof WP_User ) {
			$this->RedirectToAccount();
            $this->current_user = new CustomUser();
		} elseif ( $loginResult instanceof WP_Error ) {
			//User login failed
			/* @var WP_Error $loginResult */
			$result['result'] = false;
			$result['error']  = $loginResult->get_error_message();
		} else {
			//Undefined Error
			$result['result'] = false;
			$result['error']  = 'An undefined error has ocurred';
		}

		return $result;
	}

	public static function LogOut() {
        return esc_url(wp_logout_url(home_url()));
	}

	public function LoginForm() {
		?>
        <form class="sign-in__list" action="<?= get_the_permalink() . '?login' ?>" method="post">
			<?php
			self::ShowErrors( 'login' );
			?>
            <div class="sign-in__item">
                <div class="sign-in__item-head">
                    <span class="sign-in__item-title">Через социальные сети</span>
	                <?php
	                if (function_exists('oa_social_login_render_login_form_wp_login')){
		                oa_social_login_render_login_form_wp_login();
	                }?>
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
	        <?php
            if (!isset( $_GET['checkemail'] ) || !$_GET['checkemail'] === 'confirm')
                echo '<a href="'.self::$signinPage.'?action=lostpassword" class="lostpasslink">Забыли пароль?</a>';
            ?>
            <button class="custom-button">Войти</button>
        </form>
		<?php
	}

	public function RegistrationForm() {
		?>
        <form class="sign-in__list" action="<?= get_the_permalink() . '?registration' ?>" method="post"
              novalidate="novalidate">
			<?php
			self::ShowErrors( 'regError' );
			?>

            <div class="sign-in__item">
                <div class="sign-in__item-head">
                   <span class="sign-in__item-title">Через социальные сети</span>
                    <?php
	                        if (function_exists('oa_social_login_render_login_form_wp_registration')){
		                        oa_social_login_render_login_form_wp_registration();
	                        } ?>
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
                            <input class="form-input__item-input" name="user_email" id="log"/>
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
            <button class="custom-button">Зарегистрироваться</button>
        </form>
		<?php
	}

	public function LostPasswordForm(){
	    ?>
        <form name="lostpasswordform" id="lostpasswordform" class="sign-in__list"
              action="<?php echo esc_url( network_site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
            <div class="sign-in__item">

                <div class="sign-in__item-inputs">

                    <div class="sign-in__item-input">
                        <div class="form-input__item">
                            <label class="form-input__item-label" for="user_login">Ваш e-mail</label>
                            <input class="form-input__item-input" type="text" name="user_login" id="user_login" value="" size="20" autocapitalize="off" />
                        </div>
                    </div>

                </div>
            </div>
			<?php
			do_action( 'lostpassword_form' );
			?>
            <input type="hidden" name="redirect_to" value="<?= self::$signinPage.'?checkemail=confirm' ?>" />
            <p class="submit">
                <button type="submit" name="wp-submit" id="wp-submit" class="custom-button">
	                <?php esc_attr_e( 'Get New Password' ); ?>
                </button>
            </p>
        </form>
        <?php
	}

	public function FormProcessing() {
		$result = null;
		if ( isset( $_REQUEST['login'] ) ) {
			$result = $this->LogIn();
			if ( $result instanceof WP_Error ) {
				self::$errors['loginError'] = $result;
			}
		} elseif ( isset( $_REQUEST['registration'] ) ) {
			$result = $this->Registration();
			if ( $result instanceof WP_Error ) {
				self::$errors['regError'] = $result;
			}
		} elseif ( isset( $_REQUEST['update'] ) ) {
			$result = $this->Update();
			if ( $result instanceof WP_Error ) {
				self::$errors['update'] = $result;
			}
		}
	}

	public static function ShowErrors( $section ) {
		if ( is_array( self::$errors ) ) {
			foreach ( self::$errors as $sectionName => $errorList ) {
				if ( $sectionName == $section ) {
					foreach ( $errorList->errors as $error ) {
						foreach ( $error as $value ) {
							echo '<p style="color: red">' . $value . '</p>';
						}
					}
				}
			}
		}

	}

	public function RedirectToAccount() {
		if ( wp_redirect( static::$accountPage ) ) {
			exit;
		}
	}
	public function RedirectToCourse() {
		if ( wp_redirect( static::$mainCoursePage ) ) {
			exit;
		}
	}

	public function RedirectToSignIn() {
		if ( wp_redirect( static::$signinPage ) ) {
			exit;
		}
	}

	private function AuthRedirectScheme() {
		return static::$accountPage;
	}

	public function __wakeup() {
		throw new \Exception( "Cannot unserialize a singleton." );
	}

	public static function getInstance(): UserManager {
		$cls = static::class;
		$userClass = CustomUser::class;
		if ( ! isset( self::$instances[ $cls ] ) ) {
			self::$instances[ $cls ] = new static;
			self::$instances[ $userClass ] = new CustomUser();
		}

		return self::$instances[ $cls ];
	}

	/**@return CustomUser*/
	public function GetCurrentUser() {
		return self::$instances[CustomUser::class];
	}

	private function Update() {
		$user = $this->GetCurrentUser();
		$userID = $user->GetID();
		if ( !$user->IsAuthorized()  )
			return false;

		switch ( $_POST['target_section'] ) {
			case 'names':
				$newData = [
					'ID' => $userID
				];
				$resultUserUpdate = null;
				if ( ! empty( $_POST['userFirstName'] ) )
					$newData['first_name'] = $_POST['userFirstName'];
				if ( ! empty( $_POST['userLastName'] ) )
					$newData['last_name'] = $_POST['userLastName'];

				$resultUserUpdate = wp_update_user( $newData );
				if ( $resultUserUpdate instanceof WP_Error )
					return $resultUserUpdate;


				$resultUserUpdateMeta = null;
				if ( ! empty( $_POST['userSecondName'] ) )
					$resultUserUpdateMeta = update_user_meta($userID, '_'.U_SECOND_NAME, $_POST['userSecondName']);
                if ( $resultUserUpdateMeta instanceof WP_Error )
                    return $resultUserUpdateMeta;

                $resultUserUpdateMeta = null;
                if ( ! empty( $_POST['birthday'] ) )
                    $resultUserUpdateMeta = update_user_meta($userID, '_'.U_BIRTHDAY, $_POST['birthday']);
                if ( $resultUserUpdateMeta instanceof WP_Error )
                    return $resultUserUpdateMeta;

                break;

		}
		$this->RedirectToAccount();
	}

	protected function __clone() {}



}