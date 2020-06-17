<?php
/**
 * Template name: account
 */



$userManager = UserManager::getInstance();
/**@var $currentUser CustomUser*/
$currentUser = $userManager::GetCurrentUser();
if ( !$currentUser::UserIsAuthorized() ){
	$userManager->RedirectToSignIn();
}
$userManager->FormProcessing();

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
	                <?php secondMenuView() ?>
                </div>
            </div>
        </div>
        <div class="account__wrapper">
            <img class="image" src="/wp-content/themes/Yana/src/icons/account.png" />
        </div>
        <div class="container">
            <div class="account__list">
                <?php
                $disabled = true;
                if (empty($currentUser->user->last_name) ||empty($currentUser->user->first_name) ||empty($currentUser->second_name) ){
	                $disabled = false;
                }
                ?>
                <form class="account__item <?= $disabled ? 'disable' : ''?>"  action="<?= get_the_permalink().'?update'?>" method="post" >

                    <input type="hidden" name="target_section" value="names">
                    <div class="account__item-head">
                        <span class="account__item-title">ФИО</span>
                        <button class="account__item-update" <?= $disabled ? 'disabled' : ''?>>Исправить</button>
                    </div>
                    <div class="account__item-inputs">
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Фамилия</label>
                                <input class="form-input__item-input" name="userLastName" type="text" value="<?= $currentUser->user->last_name ?>" />
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Имя</label>
                                <input class="form-input__item-input" name="userFirstName" type="text" value="<?= $currentUser->user->first_name ?>"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Отчество</label>
                                <input class="form-input__item-input" name="userSecondName" type="text" value="<?= $currentUser->second_name ?>"/>
                            </div>
                        </div>
                    </div>
                </form>

	            <?php
	            $disabled = true;
	            if (empty($currentUser->passport_series) ||empty($currentUser->passport_number) || empty($currentUser->passport_who) || empty($currentUser->passport_when) ){
		            $disabled = false;
	            }
	            ?>
                <form class="account__item account__passport <?= $disabled ? 'disable' : ''?>"  action="<?= get_the_permalink().'?update'?>" method="post" >
                    <input type="hidden" name="target_section" value="passport">
                    <div class="account__item-head">
                        <span class="account__item-title">Паспорт</span>
                        <button class="account__item-update"  <?= $disabled ? 'disabled' : ''?>>Исправить</button>
                    </div>
                    <div class="account__item-inputs">
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Серия</label>
                                <input class="form-input__item-input" name="serial" type="text" value="<?= $currentUser->passport_series?>"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Номер паспорта</label>
                                <input class="form-input__item-input" name="number" type="text" value="<?= $currentUser->passport_number?>"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Кем выдан</label>
                                <input class="form-input__item-input" name="who" type="text" value="<?= $currentUser->passport_who?>"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Когда</label>
                                <input class="form-input__item-input" name="when" type="text" value="<?= $currentUser->passport_when?>"/>
                            </div>
                        </div>
                    </div>
                </form>
	            <?php
	            $disabled = true;
	            if (empty($currentUser->birthday) ){
		            $disabled = false;
	            }
	            ?>
                <form class="account__item <?= $disabled ? 'disable' : ''?>"  action="<?= get_the_permalink().'?update'?>" method="post" >
                    <input type="hidden" name="target_section" value="birthday">
                    <div class="account__item-head">
                        <span class="account__item-title">Дата рождения</span>
                        <button class="account__item-update"  <?= $disabled ? 'disabled' : ''?>>Исправить</button>
                    </div>
                    <div class="account__item-inputs">
                        <div class="account__item-input">
                            <label class="account__item-label">Дата рождения</label>
                            <input class="account__date" type="date" name="birthday" value="<?= $currentUser->birthday?>"/>
                        </div>
                    </div>
                </form>

                <a class="custom-button" href="<?= $userManager::LogOut() ?>">Выйти</a>
            </div>
        </div>
    </div>
<?php
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();
