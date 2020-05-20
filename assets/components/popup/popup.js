import './popup.scss';
import $ from 'jquery';

//Табы внутренние
(function($) {
    $(function() {
        $('.popup__tabs-caption').on('click', 'li:not(.active)', function() {
            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('.popup__cart-content-metryc-content').find('.popup__tabs-content').removeClass('active').eq($(this).index()).addClass('active');
        });
    });
})(jQuery);


//Открытие попапа
$(".log-in").click(function () {
    $(".popup").addClass("popup_active");
    setTimeout(function(){
        $('.popup_active').addClass('popup_move');
    },1000);
    $("body").addClass("body_active");
});


//Закрытие попапа
$(".popup__close").click(function () {
    $(".popup").removeClass("popup_active");
    $(".popup").removeClass("popup_move");
    $("body").removeClass("body_active");
});