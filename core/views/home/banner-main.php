<?php
$banner_video  = home_page_banner_video();
?>
<div class="banner-main">
    <div class="container">
        <div class="banner-main__inner">
            <div class="banner-main__content">
                <span class="title title_blue">ОБУЧАЮЩИЙ КУРС «БЕРЕМЕННОСТЬ И РОДЫ»</span>
                <p class="text text_black">
                    Онлайн курс подготовлен в рамках проекта «Ты не одна» и ориентирован на
                    семьи, ожидающие рождение ребенка, и на молодых родителей. В курсе Вы узнаете в легкой форме,
                    как счастливо пройти всю беременность, подготовится к родам, материнству и отцовству.
                </p>
                <?php if ($banner_video->link_exist):?>
                    <a class="banner-main__link" href="#modal">
                        <span>Просмотреть приветствие</span>
                        <img src="/wp-content/themes/Yana/src/icons/play.png" alt="" role="presentation"/>
                    </a>
                    <img class="banner-main__girl-write" src="/wp-content/themes/Yana/src/icons/girl-write.png" alt="" role="presentation"/>
                <?php   endif; ?>
            </div>
            <div class="banner-main__form">
                <div class="form">
                    <div class="form__inner">
                        <div class="form__tabs-content">
                            <input type="radio" name="toggle" checked="" id="login">
                            <input type="radio" name="toggle" id="auth">
                            <div class="form__tabs">
                                <label for="login">ВОЙТИ</label>
                                <label for="auth">зарегистрироваться</label>
                                <span></span>
                            </div>
                            <div class="form__content">
                                <div class="login-content">
                                    <div class="logIn">
                                        <form id="sign-in">
                                            <div class="form-input__item">
                                                <label class="form-input__item-label">Логин</label>
                                                <input class="form-input__item-input" name="login" type="text" />
                                            </div>
                                            <div class="form-input__item">
                                                <LABEL class="form-input__item-label">Пароль</LABEL>
                                                <input class="form-input__item-input" name="password" type="password"/>
                                            </div>
                                            <div class="logIn__remember">
                                                <div class="logIn__container">Запомнить
                                                    <input type="checkbox">
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
                                <div class="auth-content">
                                    <div class="logUp">
                                        <form id="sign-up">
                                            <div class="form-input__item">
                                                <label class="form-input__item-label">Логин</label>
                                                <input class="form-input__item-input" name="login"
                                                       type="text"/>
                                            </div>
                                            <div class="form-input__item">
                                                <label class="form-input__item-label">Пароль</label>
                                                <input class="form-input__item-input" name="password"
                                                       type="password"/>
                                            </div>
                                            <div class="form-input__item">
                                                <label class="form-input__item-label">Подтвердить пароль</label>
                                                <input class="form-input__item-input" name="confirmPassword"
                                                       type="password"/>
                                            </div>
                                            <div class="logUp__remember">
                                                <div class="logUp__container">Запомнить
                                                    <input type="checkbox">
                                                    <span class="logUp__checkmark"></span>
                                                </div>
                                            </div>
                                            <div class="logUp__type">
                                                <button class="custom-button" type="submit">Зарегестрироваться
                                                </button>
                                                <span>Нажимая кнопку "Войти" я<a href="">принимаю пользовательское соглашение</a></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-main__image">
        <picture>
            <source class="banner-main__bad" srcSet="/wp-content/themes/Yana/src/icons/bad-mobile.png" media="(max-width: 560px)"/>
            <source class="banner-main__bad" srcSet="/wp-content/themes/Yana/src/icons/bad-desctop.png" media="(max-width : 768px - 1px and orientation : landscape)"/>
            <img class="banner-main__bad" src="/wp-content/themes/Yana/src/icons/bad-desctop.png" alt="" role="presentation"/>
        </picture>
        <img class="banner-main__baby" src="/wp-content/themes/Yana/src/icons/girl-with-baby.png" alt=""
             role="presentation"/>
    </div>
</div>
<?php if ($banner_video->link_exist): ?>
    <div class="popup">
        <div class="remodal" data-remodal-id="modal">
            <button class="remodal-close" data-remodal-action="close"></button>
            <iframe width="100%" height="100%" src="<?= esc_url($banner_video->link) ?>" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen=""></iframe>
        </div>
    </div>
<?php endif; ?>