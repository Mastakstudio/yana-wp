import './order.scss';
import $ from 'jquery';
import * as intlTelInput from 'intl-tel-input';
import "../../../node_modules/intl-tel-input/build/js/utils.js";
import Inputmask from "inputmask";



var input = document.querySelector("#billing_phone");
var iti = intlTelInput(input, {
    initialCountry: "ca",
    utilsScript: "../../../node_modules/intl-tel-input/build/js/utils.js",
});
var currentMask = $(input).attr('placeholder').replace(/[0-9+]/ig,'9');
Inputmask({"mask": currentMask, clearMaskOnLostFocus: true}).mask(input);




$(input).on('countrychange', function(e){

    var currentMask = $(this).attr('placeholder').replace(/[0-9+]/ig,'9');
    Inputmask({"mask": currentMask, clearMaskOnLostFocus: true}).mask(input);

});


//Отступ для контента
$(window).on('resize load', paddingResize);

function paddingResize() {
    let pt = $('.header').outerHeight();
    console.log(pt);
    $('.order').css({
        'padding-top': pt
    });
}


//Подсчет в товаре


//Обработка клика на +
$('.order__cart-item-plus').click(function(){

    var quantity = parseFloat($(this).parent().parent().parent().attr("data-quantity")).toFixed(2)*1;
    var price = parseFloat($(this).parent().parent().parent().attr("data-price")).toFixed(2)*1;

    var inp = parseFloat(quantity).toFixed(2)*1;
    var total = parseFloat(inp + 1);


    $(this).parent().parent().parent().attr("data-quantity", total);
    $(this).prev().val(total);
});



//Обработка клика на -
$('.order__cart-item-minus').click(function(){

    var quantity = parseFloat($(this).parent().parent().parent().attr("data-quantity")).toFixed(2)*1;
    var price = parseFloat($(this).parent().parent().parent().attr("data-price")).toFixed(2)*1;

    var inp = parseFloat(quantity).toFixed(2)*1;
    var total = parseFloat(inp - 1);


    if(inp==0){

    }
    else{


        $(this).parent().parent().parent().attr("data-quantity", total);
        $(this).next().val(total);

    }
});



//Табы внутренние
(function($) {
    $(function() {
        $('.order__tabs-caption').on('click', 'li:not(.active)', function() {
            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('.order__cart-content-metryc-content').find('.order__tabs-content').removeClass('active').eq($(this).index()).addClass('active');
        });
    });
})(jQuery);