import './partners.scss';
import $ from 'jquery';
import Swiper from "swiper";

//Подключение свайпера

var mySwiper = new Swiper('.partners__container', {
    slidesPerView: 1,
    breakpointsInverse: true,
    spaceBetween: 40,
    navigation: {
        nextEl: '.partners__button-next',
        prevEl: '.partners__button-prev',
    },
    loop:true,
    breakpoints: {
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    }
});