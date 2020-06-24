<?php
/**
 * Template name: account
 */
if (!defined('ABSPATH')) exit();



$userManager = UserManager::getInstance();

$currentUser = $userManager->GetCurrentUser();
if ( !$currentUser->IsAuthorized() ){
	$userManager->RedirectToSignIn();
}
$userManager->FormProcessing();

$testResultsManager = TestResultManager::getInstance();
$results = $testResultsManager::GetTestResultsByUser();


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
                <div class="account__links"><?php secondMenuView() ?></div>
            </div>
        </div>
        <div class="account__wrapper">
            <img class="image" src="/wp-content/themes/Yana/src/icons/account.png" />
        </div>
        <div class="container">
            <div class="account__list">


                <?php
                $disabled = true;
                if ( empty($currentUser->GetLastName()) || empty($currentUser->GetFirstName()) || empty($currentUser->GetSecondName()) ){
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
                                <input class="form-input__item-input" name="userLastName" type="text" value="<?= $currentUser->GetLastName() ?>" />
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Имя</label>
                                <input class="form-input__item-input" name="userFirstName" type="text" value="<?= $currentUser->GetFirstName() ?>"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Отчество</label>
                                <input class="form-input__item-input" name="userSecondName" type="text" value="<?= $currentUser->GetSecondName() ?>"/>
                            </div>
                        </div>
                    </div>
                </form>

	            <?php
	            $disabled = true;
	            if (empty($currentUser->GetPassportSeries())
                    || empty($currentUser->GetPassportNumber())
                    || empty($currentUser->GetPassportWho())
                    || empty($currentUser->GetPassportWhen()) ){
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
                                <input class="form-input__item-input" name="serial" type="text" value="<?= $currentUser->GetPassportSeries()?>"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Номер паспорта</label>
                                <input class="form-input__item-input" name="number" type="text" value="<?= $currentUser->GetPassportNumber()?>"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Кем выдан</label>
                                <input class="form-input__item-input" name="who" type="text" value="<?= $currentUser->GetPassportWho()?>"/>
                            </div>
                        </div>
                        <div class="account__item-input">
                            <div class="form-input__item">
                                <label class="form-input__item-label">Когда</label>
                                <input class="form-input__item-input" name="when" type="text" value="<?= $currentUser->GetPassportWhen()?>"/>
                            </div>
                        </div>
                    </div>
                </form>
	            <?php
	            $disabled = true;
	            if (empty($currentUser->GetBirthday()) ){
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
                            <input class="account__date" type="date" name="birthday" value="<?= $currentUser->GetBirthday()?>"/>
                        </div>
                    </div>
                </form>

                <div class="account__item">
                    <span class="account__item-title">Результаты тестов</span>
		            <?php $currentUser->TestResultsView(); ?>
                </div>

                <a class="custom-button" href="<?= $userManager::LogOut() ?>">Выйти</a>
            </div>
        </div>
    </div>
<?php
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();