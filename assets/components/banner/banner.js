import './banner.scss';
import $ from 'jquery';


//Отступ для контента
$(window).on('resize load', paddingResize);

function paddingResize() {
    let pt = $('.header').outerHeight();
    console.log(pt);
    $('.banner').css({
        'padding-top': pt
    });
}

//Ховер на картинки

$( ".banner" ).hover(
    function() {
    }, function() {
        $(".banner__blueberries").addClass("banner__blueberries_active");
    }
);

$( ".banner__blueberries" ).hover(
    function() {
        $(".banner__blueberries").addClass("banner__blueberries_active");
        $(".banner__banner-image").removeClass("banner__banner-image_active");
        $(".banner__bush-second").removeClass("banner__bush-second_active");
        $(".banner__bush-first").removeClass("banner__bush-first_active");

    }, function() {
        $(".banner__blueberries").removeClass("banner__blueberries_active");
    }
);

$( ".banner__banner-image" ).hover(
    function() {
        $(".banner__blueberries").removeClass("banner__blueberries_active");
        $(".banner__banner-image").addClass("banner__banner-image_active");
        $(".banner__bush-second").removeClass("banner__bush-second_active");
        $(".banner__bush-first").removeClass("banner__bush-first_active");
    }, function() {
        $(".banner__banner-image").removeClass("banner__banner-image_active");
    }
);

$( ".banner__bush-second" ).hover(
    function() {
        $(".banner__blueberries").removeClass("banner__blueberries_active");
        $(".banner__banner-image").removeClass("banner__banner-image_active");
        $(".banner__bush-second").addClass("banner__bush-second_active");
        $(".banner__bush-first").addClass("banner__bush-first_active");
    }, function() {
        $(".banner__bush-second").removeClass("banner__bush-second_active");
        $(".banner__bush-first").removeClass("banner__bush-first_active");
    }
);

$( ".banner__bush-first" ).hover(
    function() {
        $(".banner__blueberries").removeClass("banner__blueberries_active");
        $(".banner__banner-image").removeClass("banner__banner-image_active");
        $(".banner__bush-second").addClass("banner__bush-second_active");
        $(".banner__bush-first").addClass("banner__bush-first_active");
    }, function() {
        $(".banner__bush-second").removeClass("banner__bush-second_active");
        $(".banner__bush-first").removeClass("banner__bush-first_active");
    }
);