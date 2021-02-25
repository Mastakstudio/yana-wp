import './doctors-banner.scss';
import $ from 'jquery';



if ($(window).width() < 768) {
    $(".doctors-banner__list-item").click(function (){
        $(this).find(".doctors-banner__list-item-text").slideToggle();
        $(this).find(".doctors-banner__list-item-content").slideToggle();
        $(this).toggleClass("doctors-banner__list-item_active");
    });
}