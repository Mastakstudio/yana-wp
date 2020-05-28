import './menu.scss';
import $ from 'jquery';


//Открытие меню

$(".header__burger").click(function () {
    $(".header").toggleClass("header_active");
    $(".menu").toggleClass("menu_active");
    $(".header__burger").toggleClass("header__burger_active");
});