import './partners.scss';
import $ from 'jquery';
import Swiper from "swiper";

//Подключение свайпера

var mySwiper = new Swiper('.partners__container', {
    slidesPerView: 'auto',
    navigation: {
        nextEl: '.partners__button-next',
        prevEl: '.partners__button-prev',
    },
    breakpoints: {
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 4,
        },
        1280: {
            slidesPerView: 5,
        },
        1920: {
            slidesPerView: 5,
        },
    }
});