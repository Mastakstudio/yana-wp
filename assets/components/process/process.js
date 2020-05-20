import './process.scss';
import Swiper from 'swiper';
import $ from "jquery";
import '../../../node_modules/jquery-viewport-checker/src/jquery.viewportchecker';

if(innerWidth<768) {
    let swiper = new Swiper('.process__swiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 10,
    });
}

function viewPortchecker(arr) {
    for(let i=0; i<arr.length; i++) {

        $(arr[i]).viewportChecker({
            classToAdd: 'process__viewport_active',
        });
    }

}


(function () {
    let arr = $('.process__icon');
    viewPortchecker(arr);
}());

(function () {
    let arr = $('.process__title-inner');
    viewPortchecker(arr);
}());

(function () {
    let arr = $('.process__description');
    viewPortchecker(arr);
}());
