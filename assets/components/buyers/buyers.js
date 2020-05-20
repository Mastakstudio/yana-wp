import './buyers.scss';
import $ from 'jquery';
import Swiper from "swiper";
import '../../../node_modules/jquery-viewport-checker/src/jquery.viewportchecker';

//Отступ для контента
$(window).on('resize load', paddingResize);

function paddingResize() {
    let pt = $('.header').outerHeight();
    console.log(pt);
    $('.buyers').css({
        'padding-top': pt
    });
}


//Подключение свайпера

var mySwiper = new Swiper('.buyers__swiper-container', {
    speed: 400,
    spaceBetween: 100,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
});


//Анимация черники
$(document).ready(function(){
    $('.wholesale__item').viewportChecker({
        classToAdd: 'wholesale__item_active',
        callbackFunction: function(elem, action){

            setTimeout(function(){
                $('.wholesale__item.wholesale__item_active').addClass('wholesale__item_move');
            },1000);
        },
    });

});