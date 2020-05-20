import './accountInfo.scss';
import $ from "jquery";

//Отступ для контента
$(window).on('resize load', paddingResize);

function paddingResize() {
    let pt = $('.header').outerHeight();
    console.log(pt);
    $('.accountInfo').css({
        'padding-top': pt
    });
}