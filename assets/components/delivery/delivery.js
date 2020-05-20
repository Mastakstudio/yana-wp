import './delivery.scss';
import $ from 'jquery';

//Отступ для контента
$(window).on('resize load', paddingResize);

function paddingResize() {
    let pt = $('.header').outerHeight();
    console.log(pt);
    $('.delivery').css({
        'padding-top': pt
    });
}