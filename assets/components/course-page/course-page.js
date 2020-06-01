import './course-page.scss';
import $ from 'jquery';
import viewportChecker from './../../../node_modules/jquery-viewport-checker/src/jquery.viewportchecker';


$(document).ready(function(){
    $('.course-page__image-content-item').viewportChecker();
});

//Таймер

const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

$('.course-page__time-info-item').each(function(i,elem) {

    let time = $(this).data("time").toString();
    let countDown = new Date(time).getTime(),
        x = setInterval(function() {

            let now = new Date().getTime(),
                distance = countDown - now;


            document.getElementsByClassName('days')[i].innerText = Math.floor(distance / (day)),
                document.getElementsByClassName('hours')[i].innerText = Math.floor((distance % (day)) / (hour)),
                document.getElementsByClassName('minutes')[i].innerText = Math.floor((distance % (hour)) / (minute));

        }, second)

});




//Аккардеон в мобилке

if ($(window).width() < 1023) {

    $('.course-page__title-content-item').click(function () {

        $(this).next().slideToggle();
        $(this).find(".course-page__button").toggleClass('course-page__button_active')

    })


    $('.course-page__title-info-item').click(function () {

        $(this).next().slideToggle();
        $(this).find(".course-page__button").toggleClass('course-page__button_active')

    })




}