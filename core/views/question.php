<?php

?>
<div class="question">
    <div class="question__wrapper"></div>
    <div class="container">
        <div class="question__inner">
            <div class="question__content">
                <div class="question__title">
                    <span class="title title_blue">Остались вопросы?</span>
                </div>
                <form class="question__form" id="questionForm">
                    <div class="form-input__item">
                        <label class="form-input__item-label">Имя</label>
                        <input class="form-input__item-input" name="name" type="text" placeholder="Имя"/>
                    </div>
                    <div class="form-input__item">
                        <label class="form-input__item-label">Телефон или электронная почта</label>
                        <input class="form-input__item-input" name="text" type="text" placeholder="Телефон или электронная почта"/>
                    </div>
                    <div class="form-textarea__item">
                        <label class="form-textarea__item-label">Сообщение</label>
                        <textarea class="form-textarea__item-textarea" name="comment" type="text" placeholder="Сообщение"></textarea>
                    </div>
                    <div class="form-textarea__item">
                        <p id="question_result"></p>
                    </div>
                    <button class="custom-button" type="submit">Отправить</button>
                </form>
            </div>
            <img class="question__image" src="/wp-content/themes/Yana/src/icons/hand.png" alt="" />
        </div>
        <img class="question__logo" src="/wp-content/themes/Yana/src/icons/logo-dop.png" alt="" />
    </div>
</div>