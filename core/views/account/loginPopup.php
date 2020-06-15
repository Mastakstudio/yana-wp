<?php
?>
<div class="popup">
	<div class="popup__inner">
		<div class="popup__blur"></div>
		<div class="popup__content">
			<?= ajax_loader(['background'=> '#00000047']) ?>
			<img id="close-reg-log-popup" class="popup__close" src="/wp-content/themes/FalconGlen/src/icons/popup-image.a32cf8.png" alt="Background" title=""/>
			<div class="popup__title">Account</div>
			<div class="popup__cart-content-metryc-content active">
				<ul class="popup__tabs-caption">
					<li class="active">Login</li>
					<?php if ( get_option( 'users_can_register' ) ) :?>
						<li>Register</li>
					<?php endif; ?>
				</ul>
				<div class="popup__tabs-inner">
					<div class="popup__tabs-content active">
						<form class="popup__form" method="post" id="form_login_modal">
							<input class="popup__input" id="username" type="text" placeholder="E-mail" name="username" autocomplete="username"/>
							<input class="popup__input" id="password" type="password" placeholder="Password" name="password" autocomplete="current-password"/>
							<a class="popup__forget" href="<?php echo esc_url(wp_lostpassword_url()); ?>">Forgot password</a>
							<button type="submit" class="popup__button">Sign In</button>
						</form>
						<div class="result-wrapper"><div class="result"></div></div>
					</div>
					<?php if ( get_option( 'users_can_register' ) ) :?>
						<div class="popup__tabs-content">
							<form class="popup__form"  id="form_registration_modal">
								<input class="popup__input" type="text" placeholder="E-mail" name="email"/>
								<input class="popup__input" type="password" placeholder="Password" name="password"/>
								<input class="popup__input" type="password" placeholder="Confirm password" name="password_again"/>
                                <?php do_action( 'login_form' ); ?>
								<button type="submit" class="popup__button">Registration</button>
							</form>
							<div class="result-wrapper"><div class="result"></div></div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
