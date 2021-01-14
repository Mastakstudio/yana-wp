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
        
      if($testResult!=null){
        TestResultManager::UpdateMeta($testResult, $newValues);
        
        $newAns= carbon_get_post_meta($testResult->getID(), TEST_ANSWERED);
        $newRightAns= carbon_get_post_meta($testResult->getID(), TEST_RIGHT_ANSWERED);
      }
        
    }
    $_SESSION['loginNew']='false';
    ?>
    <script>
        window.location.reload();
    </script><?php
}
?>  
    <?php
        $current_user = wp_get_current_user();
        $role = $current_user->roles[0];
        if($role!='specialist'):
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
    elseif($role=='specialist'):
    ?>
    <!--  -->

    <div class="accountMed">
        <div class="container">
          <div class="accountMed__links">
            <div class="links">
              <div class="links__inner">
                <a class="links__item" href="/course/dlya-spetsialistov-pomogayushhih-professij/">Пройти курс</a>
                <a class="links__item" href="/faq222/">ВОПРОС-ОТВЕТ</a>
                <a class="links__item links__item links__item_active" href="/account/">Профиль</a>
              </div>
            </div>
          </div>
          <div class="accountMed__inner">
            <div class="accountMed__content"><span class="title title_blue">Личный кабинет</span>
              <p class="text text_black">Здесь вы можете добавить либо изменить информацию о себе. Данная информация необходима для формирования и регистрации в базе данных официального Сертификата о прохождении курса.</p>
            </div>
          </div>
        </div>
        <div class="accountMed__wrapper">
          <IMG class="image" src="/wp-content/themes/Yana/src/icons/pers.png"></IMG>
        </div>
        <div class="container">
        <?php
                $disabled = true;
                if ( empty($currentUser->GetLastName()) || empty($currentUser->GetFirstName()) || empty($currentUser->GetSecondName()) ){
	                $disabled = false;
                }
                ?>
          <form class="accountMed__list account__item <?= $disabled ? 'disable' : ''?>" id="accountMed__form" action="<?= get_the_permalink().'?update'?>" method="post" >
            <input type="hidden" name="target_section" value="names">
            <div class="accountMed__item">
              <div class="accountMed__item-inputs">
                <div class="accountMed__item-input">
                  <div class="form-input__item">
                    <LABEL class="form-input__item-label">ФИО/ Ник</LABEL>
                    <INPUT class="form-input__item-input" name="userFio" type="text" value="<?= $currentUser->GetUserFio() ?>"></INPUT>
                  </div>
                </div>
                <div class="accountMed__item-input">
                  <div class="form-input__item">
                    <LABEL class="form-input__item-label">Место работы</LABEL>
                    <INPUT class="form-input__item-input" name="userPlace" type="text" value="<?= $currentUser->GetUserPlace() ?>"></INPUT>
                  </div>
                </div>
                <div class="accountMed__item-input">
                  <div class="form-input__item">
                    <LABEL class="form-input__item-label">Профессия</LABEL>
                    <INPUT class="form-input__item-input" name="userProf" type="text" value="<?= $currentUser->GetUserProf() ?>"></INPUT>
                  </div>
                </div>
                <div class="accountMed__item-input">
                  <div class="form-input__item">
                    <LABEL class="form-input__item-label">Специальность</LABEL>
                    <INPUT class="form-input__item-input" name="userSpec" type="text" value="<?= $currentUser->GetUserSpec() ?>"></INPUT>
                  </div>
                </div>
                <div class="accountMed__item-input">
                  <label class="accountMed__item-label">Дата рождения
                  </label>
                  <!-- <input class="accountMed__date" type="date" name="userDate" id="date" placeholder="27.10.1994"/> -->
                  <input class="account__date" type="date" name="birthday" id="date" placeholder="27.10.1994" value="<?= $currentUser->GetBirthday()?>"/>
                </div>
                <div class="accountMed__item-input">
                  <label class="accountMed__item-label">Пол
                  </label>
                  <div class="accountMed__pol-inner">
                    <?php
                      $gender = $currentUser->GetUserGender();
                    ?>
                    <label class="accountMed__pol-container">Ж
                      <input type="radio" name="userGender" value="woman" <?php if($gender=='woman'){?>checked="checked"<?php }?>><span class="accountMed__pol-checkmark"></span>
                    </label>
                    <label class="accountMed__pol-container">М
                      <input type="radio" name="userGender" value="man" <?php if($gender=='man'){?>checked="checked"<?php }?>><span class="accountMed__pol-checkmark"></span>
                    </label>
                    <label class="accountMed__pol-container">Иное
                      <input type="radio" name="userGender" value="other" <?php if($gender=='other'){?>checked="checked"<?php }?>><span class="accountMed__pol-checkmark"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="accountMed__item-head-type">
                <button class="account__item-update" type="submit">Сохранить</button>
                <button class="account__item-update enable-toggle" type="button">Исправить</button>
              </div>
            </div>
            <!--+e.item.account__passport-->
            <!--    +e.item-head-->
            <!--        +e.SPAN.item-title Паспорт-->
            <!--    +e.item-inputs-->
            <!--        +e.item-input-->
            <!--            +form-input('Серия')(name='serial' type='text')-->
            <!--        +e.item-input-->
            <!--            +form-input('Номер паспорта')(name='number' type='text')-->
            <!--        +e.item-input-->
            <!--            +form-input('Кем выдан')(name='who' type='text')-->
            <!--        +e.item-input-->
            <!--            +form-input('Когда')(name='when' type='text')-->
            <!--    +e.item-head-type-->
            <!--        +e.BUTTON.item-update Сохранить-->
            <!--        +e.BUTTON.item-update Исправить-->
            <!--+e.item-->
            <!--    +e.item-head-->
            <!--        +e.SPAN.item-title Дата рождения-->
            <!--    +e.item-inputs-->
            <!--        +e.item-input-->
            <!--            +e.LABEL.item-label Дата рождения-->
            <!--            +e.INPUT.date(type="date" name="date")-->
            <!--    +e.item-head-type-->
            <!--        +e.BUTTON.item-update Сохранить-->
            <!--        +e.BUTTON.item-update Исправить-->
            <a class="custom-button-med" href="<?= $userManager::LogOut() ?>">Выйти</a>
          </form>
          
        </div>
      </div>
    <?php
    endif;
    ?>
<?php
get_template_part( '/core/views/partners' );
get_template_part( '/core/views/footerView' );
get_footer();