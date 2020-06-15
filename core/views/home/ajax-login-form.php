<?php


?>
<div class="banner-main__form">
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
									<span>Нажимая кнопку "Войти" я<a href="">принимаю пользовательское соглашение</a></span>
								</div>
							</form>
						</div>
					</div>
					<?php if ( get_option( 'users_can_register' ) ) :?>
                        <div class="auth-content">
                            <div class="logUp">
                                <form id="sign-up">
                                    <div class="form-input__item">
                                        <label class="form-input__item-label">Логин</label>
                                        <input class="form-input__item-input" name="login" type="text"/>
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
                                        <div class="logUp__container">Запомнить<input type="checkbox">
                                            <span class="logUp__checkmark"></span>
                                        </div>
                                    </div>
                                    <div class="logUp__type">
                                        <button class="custom-button" type="submit">Зарегестрироваться</button>
                                        <span>Нажимая кнопку "Войти" я<a href="">принимаю пользовательское соглашение</a></span>
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
