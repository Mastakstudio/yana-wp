import './account.scss';
import $ from "jquery";

//Отступ для контента
$(window).on('resize load', paddingResize);

function paddingResize() {
    let pt = $('.header').outerHeight();
    console.log(pt);
    $('.account').css({
        'padding-top': pt
    });
}


//Табы внутренние
(function($) {
    $(function() {
        $('.account__tabs-caption').on('click', 'li:not(.active)', function() {
            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('.account__cart-content-metryc-content').find('.account__tabs-content').removeClass('active').eq($(this).index()).addClass('active');
        });
    });
})(jQuery);