import './header.scss';
import $ from 'jquery';

$(".header__menu-scroll-item").click(function (){
    $(".header__menu-scroll-item").removeClass("header__menu-scroll-item_active");
    $(".header__menu-scroll-roll").toggleClass("header__menu-scroll-roll_active");
    $(this).addClass("header__menu-scroll-item_active");
});


$("#page1").click(function (){
    $(".banner-main").css("display","block")
    $(".doctors-banner").css("display","none")
    $(".tags").css("display","block")
    $(".experts").css("display","block")
    $(".passCourse").css("display","block")
    $(".learn").css("display","block")
    $(".header__menu-list").css("display","flex")

});



$("#page2").click(function (){
    $(".banner-main").css("display","none");
    $(".doctors-banner").css("display","block")
    $(".tags").css("display","none")
    $(".experts").css("display","none")
    $(".passCourse").css("display","none")
    $(".learn").css("display","none")
    $(".header__menu-list").css("display","none")
    $(".doctors-banner .title").addClass("visible full-visible")
    $(".doctors-banner .text").addClass("visible full-visible")
});


$(document).ready(function(){
    // Add smooth scrolling to all links
    $(".header__menu-item a").on('click', function(event) {

        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top-80
            }, 800, function(){

                window.location.hash = hash;
            });
        }
    });
});