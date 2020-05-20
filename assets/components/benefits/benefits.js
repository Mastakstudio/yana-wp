import './benefits.scss';
import $ from 'jquery';
import '../../../node_modules/jquery-viewport-checker/src/jquery.viewportchecker';


//Анимация текста
$(window).on('scroll', function() {
    $(".benefits__item").each(function() {
        if (isScrolledIntoView($(this))) {
            $(this).addClass("visible");
        }
    });
});

function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}