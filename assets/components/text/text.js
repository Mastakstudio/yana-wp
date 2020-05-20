import './text.scss';
import $ from 'jquery';

//Отступ для контента
$(window).on('resize load', paddingResize);

function paddingResize() {
    let pt = $('.header').outerHeight();
    console.log(pt);
    $('.text').css({
        'padding-top': pt
    });
}

