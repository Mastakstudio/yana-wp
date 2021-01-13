<?php
$userMng = UserManager::getInstance();
$user = $userMng->GetCurrentUser();

$mainCoursePage    = carbon_get_theme_option( PREFIX . 'main_course_page' );
?>

<div class="banner-main__form" id="banner-main__form">
    <div class="form">
        <div class="form__inner <?= $user->IsAuthorized()?'main__form_hidden':'' ?>" id="main-banner-forms" >
            <div class="form__tabs-content">
                <input type="radio" name="toggle" checked="" id="signId">
                <input type="radio" name="toggle" id="auth">
                <div class="form__tabs">
                    <label for="signId">ВОЙТИ</label>
					<?php if ( get_option( 'users_can_register' ) ) {
						echo '<label for="auth">зарегистрироваться</label>';
					} ?>
                    <span></span>
                </div>
                <div class="form__content">
                    <div class="signId-content">
                        <div class="signIn">
                            <form id="sign-in">
                                <div class="form-input__item">
                                    <label class="form-input__item-label">Логин</label>
                                    <input class="form-input__item-input" id="username" type="text" placeholder="E-mail" name="username" autocomplete="username"/>
                                </div>
                                <div class="form-input__item">
                                    <label class="form-input__item-label">Пароль</label>
                                    <input class="form-input__item-input" id="password" type="password" placeholder="Password" name="password" autocomplete="current-password"/>
                                </div>
								<div class="signUp__remember">
                                        <div class="signUp__container" style="padding-left: 0;">
                                            <a style="display: block; " href="/signin/?action=lostpassword" class="lostpasslink">Забыли пароль?</a>
                                        </div>
                                    </div>
								
								
                                <div class="signIn__type">
									<div class="form__dop-types">
                                <button class="custom-button" type="submit">Войти</button><a class="link link__dop" href="/course/onlajn-kurs-beremennost-i-rody/">Подробнее о курсе</a>
                              </div>
									
									<?php
									$privacy_policy_url = get_privacy_policy_url();
									if ( ! empty( $privacy_policy_url ) ): ?>
                                        <span>Нажимая кнопку "Войти" я&nbsp;<a href="<?= $privacy_policy_url ?>">принимаю пользовательское соглашение</a></span>
									<?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
					<?php if ( get_option( 'users_can_register' ) ) : ?>
                        <div class="auth-content">
                            <div class="signUp">
                                <form id="sign-up">
                                    <div class="form-input__item">
                                        <label class="form-input__item-label">Email</label>
                                        <input class="form-input__item-input" name="email" type="text"/>
                                    </div>
                                    <div class="form-input__item">
                                        <label class="form-input__item-label">Пароль</label>
                                        <input class="form-input__item-input" name="password" type="password"/>
                                    </div>
                                    <div class="form-input__item">
                                        <label class="form-input__item-label">Подтвердить пароль</label>
                                        <input class="form-input__item-input" name="confirmPassword" type="password"/>
                                    </div>
                                    <div class="signUp__remember">
                                        <div class="signUp__container">
                                            <label for="remembermeReg">Запомнить</label>
                                            <input name="rememberme" type="checkbox" id="remembermeReg" value="forever">
                                            <span class="signUp__checkmark"></span>
                                        </div>
                                    </div>
                                    <div class="signUp__type">
                                        <button class="custom-button" type="submit">Зарегистрироваться</button>
										<?php
										$privacy_policy_url = get_privacy_policy_url();
										if ( ! empty( $privacy_policy_url ) ): ?>
                                            <span>Нажимая кнопку "Войти" я&nbsp;<a href="<?= $privacy_policy_url ?>"> принимаю пользовательское соглашение</a></span>
										<?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form__inner form__dop-link <?= $user->IsAuthorized()?'':'main__form_hidden' ?>" id="main-banner-to-course">
            <div class="form__tabs-content">
                <div class="form__content">
                    <div class="signId-content">
                        <div class="signIn">
                            <form id="sign-in">
                                <div class="form__dop-content">
                                    <IMG src="/wp-content/themes/Yana/src/icons/grom.png"></IMG>
                                </div>
                                <a class="link" href="<?= get_permalink($mainCoursePage) ?>">Перейти к обучению</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="banner-main__wrap-text">
    <a href="/course/onlajn-kurs-ty-ne-odna/" class="link" src="/course/onlajn-kurs-ty-ne-odna/" target="_blank">Перейти к обучению</a>
</div>