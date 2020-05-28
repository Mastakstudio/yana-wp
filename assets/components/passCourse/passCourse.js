import './passCourse.scss';
import $ from 'jquery';
import viewportChecker from './../../../node_modules/jquery-viewport-checker/src/jquery.viewportchecker';

//Анимация

$(document).ready(function(){
    $('.passCourse__content').viewportChecker({
        classToAdd: 'addAnimate',
    });
});