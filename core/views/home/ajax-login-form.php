<?php


?>
<div class="banner-main__form" id="banner-main__form">
	<div class="form">
		<div class="form__inner">
			<div class="form__tabs-content">
				<input type="radio" name="toggle" checked="" id="login">
				<input type="radio" name="toggle" id="auth">
				<div class="form__tabs">
					<label for="login">ВОЙТИ</label>
					<?php if ( get_option( 'users_can_register' ) ) {
						echo '<label for="auth">зарегистрироваться</label>';
					}?>
					<span></span>
				</div>
				<div class="form__content">
					<div class="login-content">
						<div class="logIn">
							<form id="sign-in" >
                                <div id="login_errors" style="color: red; position: unset; visibility: unset;"></div>
								<div class="form-input__item">
									<label class="form-input__item-label">Логин</label>
									<input class="form-input__item-input" id="username" type="text" placeholder="E-mail" name="username" autocomplete="username"/>
								</div>
								<div class="form-input__item">
									<label class="form-input__item-label">Пароль</label>
									<input class="form-input__item-input" id="password" type="password" placeholder="Password" name="password" autocomplete="current-password"/>
								</div>
								<div class="logIn__remember">
									<div class="logIn__container">
                                        <label for="rememberme">Запомнить</label>
                                        <input name="rememberme" type="checkbox" id="rememberme" value="forever">
                                        <span class="logIn__checkmark"></span>
									</div>
								</div>
                                <div class="logIn__type">
                                    <button class="custom-button" type="submit">Войти</button>
                                    <?php
                                    $privacy_policy_url = get_privacy_policy_url();
                                    if (!empty($privacy_policy_url)): ?>
                                        <span>Нажимая кнопку "Войти" я&nbsp;<a href="<?= $privacy_policy_url ?>">принимаю пользовательское соглашение</a></span>
                                    <?php endif; ?>
                                </div>
							</form>
						</div>
					</div>
					<?php if ( get_option( 'users_can_register' ) ) :?>
                        <div class="auth-content">
                            <div class="logUp">
                                <form id="sign-up">
                                    <div id="reg_errors" style="color: red"></div>
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
                                    <div class="logUp__remember">
                                        <div class="logUp__container"> <label for="remembermeReg">Запомнить</label>
                                            <input name="rememberme" type="checkbox" id="remembermeReg" value="forever">
                                            <span class="logUp__checkmark"></span>
                                        </div>
                                    </div>
                                    <div class="logUp__type">
                                        <button class="custom-button" type="submit">Зарегестрироваться</button>
	                                    <?php
	                                    $privacy_policy_url = get_privacy_policy_url();
	                                    if (!empty($privacy_policy_url)): ?>
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
	</div>
</div>
