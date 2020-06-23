<?php
global $post;
$nextPart = CourseManager::getNextPartLink($post);
$testResultManager = TestResultManager::getInstance();
$currentTestResult = $testResultManager::getCurrentTestResult();
$coursePart = new CoursePart( get_the_ID(), $post );
?>
<div class="remodal footer__remodal" data-remodal-id="success" id="modal_next_part">
    <div class="mastak_loader_wrapper">
        <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
	<button class="remodal-close" data-remodal-action="close">Закрыть</button>
	<div class="footer__remodal-content">
		<div class="footer__remodal-wrapper-inner">
			<span class="footer__remodal-title">Вы успешно cдали</span>
			<span class="footer__remodal-desc"><?= $post->post_title?></span>
			<?php if ($nextPart['last']) {
				echo '<span class="footer__remodal-text">Вы можете получить сертификат о прохождении данного курса заполнив форму с данными</span>';
				echo '<a class="link" href="'.get_permalink(carbon_get_theme_option(TO_ACCOUNT_PAGE)).'" id="go_to_next" target="_blank">Получить сертификат</a>';
			}
			else{
			    echo '<span class="footer__remodal-text">Вы можете перейти к следующей части</span>';
				echo '<a class="link" href="'.get_permalink($nextPart['id']).'" id="go_to_next" >Перейти</a>';
			}?>
		</div>
		<div class="footer__remodal-image">
			<img src="/wp-content/themes/Yana/src/icons/girl-write.png" alt=""/>
		</div>
	</div>
</div>

<div class="remodal footer__remodal" data-remodal-id="error" id="modal_failed">
	<button class="remodal-close" data-remodal-action="close">Закрыть</button>
	<div class="footer__remodal-content">
		<div class="footer__remodal-wrapper-inner">
			<span class="footer__remodal-title">Вы не прошли</span>
			<span class="footer__remodal-desc"><?= $post->post_title?></span>
			<span class="footer__remodal-text">Попробуйте пройти еще раз внимательно изучив материалы</span>
			<a class="link" src="#" id="restart_test">Попробовать снова</a>
		</div>
		<div class="footer__remodal-image">
			<img src="/wp-content/themes/Yana/src/icons/gg.png" alt=""/>
		</div>
	</div>
</div>
