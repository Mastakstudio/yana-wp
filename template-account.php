<?php
/**
 * Template name: account
 */
if (!defined('ABSPATH')) exit();

if (isset($_GET['certificate'])){
	$certificateMng = CertificateManager::getInstance();
	$certificateMng::createPersonalCertificate();
}

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
session_start();

if($_SESSION['loginNew']=='true' && is_user_logged_in()){
    $categoryId=48;
    $posts = get_posts(array(
        'post_status' => 'publish',
        'post_type' => 'course',
        'orderby' => 'ID',
        'order' => 'asc',
        'numberposts' => -1,
        'post_parent' => $categoryId,
    ));
    

    foreach($posts as $part){
        $test_id  = $part->ID;
        if($_SESSION['t'.$test_id]['answered']!=null){
            $answered = $_SESSION['t'.$test_id]['answered'];
        }else{
            $answered = 0;
        }
        if($_SESSION['t'.$test_id]['right']!=null){
            $right    = $_SESSION['t'.$test_id]['right'];
        }else{
            $right    = 0;
        }
        
        

        TestResultManager::getInstance();
        $testResult = TestResultManager::GetTestResultsByCoursePartId($test_id);
        
	    $newValues = [
	    	'_'.TEST_SOLVED => $answered === $right ? 'yes':'',
	    	'_'.TEST_RIGHT_ANSWERED => $right,
	    	'_'.TEST_ANSWERED => $answered
        ];
        
        TestResultManager::UpdateMeta($testResult, $newValues);
        
	    $newAns= carbon_get_post_meta($testResult->getID(), TEST_ANSWERED);
	    $newRightAns= carbon_get_post_meta($testResult->getID(), TEST_RIGHT_ANSWERED);
    }
    $_SESSION['loginNew']='false';
    ?>
    <script>
        window.location.reload();
    </script><?php
}
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
                        <span class="account__item-title">ДАННЫЕ ПОЛЬЗОВАТЕЛЯ</span>
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
                        <div class="account__item-input">
                            <label class="account__item-label">Дата рождения</label>
                            <input class="account__date" type="date" name="birthday" id="date" placeholder="27.10.1994" value="<?= $currentUser->GetBirthday()?>"/>
                        </div>
                    </div>
                    <div class="account__item-head-type">
                        <button class="account__item-update" type="submit">Сохранить</button>
                        <button class="account__item-update enable-toggle" type="button">Исправить</button>
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