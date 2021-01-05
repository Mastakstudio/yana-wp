import './doctors.scss';
import $ from 'jquery';



if ($(window).width() < 768) {
    $(".doctors__list-item").click(function (){
        $(this).find(".doctors__list-item-text").slideToggle();
        $(this).find(".doctors__list-item-content").slideToggle();
        $(this).toggleClass("doctors__list-item_active");
    });
}