<?php
/**
 * Template name: account
 */

$UserManager = UserManager::getInstance();
$currentUser = $userManager::GetCurrentUser();
if ( ! $currentUser ) {
	$UserManager->RedirectToSignIn();
}
var_dump( $currentUser );

get_header();
get_template_part( '/core/views/headerView' );
?>
    <div class="account">
        <div class="container">
            <div class="account__inner">
                <div class="account__content"><span class="title title_blue">личный кабинет</span>
                    <p class="text text_black">
                        Здесь вы можете добавить либо изменить информацию о себе. Данная информация необходима для формирования и регистрации в базе данных Сертификата о прохождении курса.
                    </p>
                </div>
                <div class="account__links">
                    <div class="links">
                        <div class="links__inner">
                            <a class="links__item">Пройти курс</a>
                            <a class="links__item links__item links__item_active">ВОПРОС-ОТВЕТ</a>
                            <a class="links__item">Профиль</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="account__wrapper">
            <img class="image" src="/wp-content/themes/Yana/src/icons/account.png" />
        </div>
        <div class="container">
            <div class="account__list">
                <div class="account__item disable">
                    <div class="account__item-head">
                        <span class="account__item-title">ФИО</span>
                        <button class="account__item-update">Исправить</button>
                    </div>
                    <div class="account__item-inputs">
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Фамилия</label>
                                <input class="form-input__item-input" name="surname" type="text" value="Эллоида" />
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Имя</label>
                                <input class="form-input__item-input" name="name" type="text"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Отчество</label>
                                <input class="form-input__item-input" name="secondName" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account__item account__passport">
                    <div class="account__item-head"><span class="account__item-title">Паспорт</span>
                        <button class="account__item-update">Исправить
                        </button>
                    </div>
                    <div class="account__item-inputs">
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Серия</label>
                                <input class="form-input__item-input" name="serial" type="text"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Номер паспорта</label>
                                <input class="form-input__item-input" name="number" type="text"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Кем выдан</label>
                                <input class="form-input__item-input" name="who" type="text"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Когда</label>
                                <input class="form-input__item-input" name="when" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account__item">
                    <div class="account__item-head"><span class="account__item-title">Дата рождения</span>
                        <button class="account__item-update">Исправить</button>
                    </div>
                    <div class="account__item-inputs">
                        <div class="account__item-input">
                            <label class="account__item-label">Дата рождения</label>
                            <input class="account__date" type="date" name="date"/>
                        </div>
                    </div>
                </div>
                <button class="custom-button">Сохранить</button>
            </div>
        </div>
    </div>
<?php
get_template_part( '/core/views/home/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
